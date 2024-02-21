<?php
function setServerfile() {

	global $ATT_INFO, $FTP;

	$result = array();
	for($ary_i=0; $ary_i < $ATT_INFO['cnt']; $ary_i++) {

		$ATT_INFO['tmp_ary'] = explode("/",$ATT_INFO['att_file_path'][$ary_i]);
		$ATT_INFO['file_key'] = sizeof($ATT_INFO['tmp_ary'])-1;
		$ATT_INFO['file_name'] = $ATT_INFO['tmp_ary'][$ATT_INFO['file_key']];

		$ext = explode(".",$ATT_INFO['file_name']);
		$ext_size = sizeof($ext)-1;
		$ATT_INFO['file_name_hash'] = md5($ext[0]).'.'.$ext[$ext_size];

		if( !$ATT_INFO['file_del'][$ary_i] ) {
			if( strpos( $ATT_INFO['att_file_path'][$ary_i], 'tmp' ) !== false ) { // 새로 첨부한 파일이 있으면

				$ATT_INFO['month_path'] = date('Ym').'/';

				if( !is_dir($ATT_INFO['local_path'].$ATT_INFO['month_path']) ) {
					@mkdir($ATT_INFO['local_path'].$ATT_INFO['month_path'], 0777);
					@chmod($ATT_INFO['local_path'].$ATT_INFO['month_path'], 0777);
				}

				if( @copy( $ATT_INFO['path'].$ATT_INFO['file_name'] , $ATT_INFO['local_path'].$ATT_INFO['month_path'].$ATT_INFO['file_name_hash'] ) ) {
					$result[$ary_i] = $ATT_INFO['month_path'].$ATT_INFO['file_name_hash'];
				}
			} else {
				if( $ATT_INFO['file_name'] ) {
					$result[$ary_i] = $ATT_INFO['tmp_ary'][0].'/'.$ATT_INFO['file_name'];
				}
			}
		} else { // 첨부파일 삭제일때
			$result[$ary_i] = '';
			//@unlink( $ATT_INFO['local_path'].$ATT_INFO['file_name'] );
		}
	}

	return $result;
}

function tmpPassword() {
	$tmp_str = array('a','b','c','d','e','f','g','h','k','m','n','p','q','r','s','t','u','v','w','x','z');
	$result = rand(1,9).$tmp_str[rand(0,20)].rand(1,9).$tmp_str[rand(0,20)].rand(1,9).$tmp_str[rand(0,20)].rand(1,9).$tmp_str[rand(0,20)];
	return $result;
}

function sendSMS( $a_DATA ) {
	global $_SET, $SnSclient;

	try {
		$r = $SnSclient->publish([
			'Message' => $a_DATA['msg'],
			'PhoneNumber' => $a_DATA['hp'],
		]);
		$result['code'] = 'OK';
		$result['data'] = $r;
	} catch (AwsException $e) {
		error_log($e->getMessage());
		$result['code'] = 'ERR';
		$result['data'] = $e;
	}

	return $result;
}

function get_ranking_index($tab) {
	global $_SET, $Mysql_Base;
	if ($tab=='today') {
		$sql = '(SELECT idx, title, type, read_count, regist_time FROM `living_culture` WHERE edate > NOW() AND gpsX is not null ORDER BY read_count DESC LIMIT 20)';
		$sql = $sql.' UNION ';
		$sql = $sql.'(SELECT idx, title, type, read_count, regist_time FROM `living_festival` WHERE edate > NOW() AND gpsX is not null ORDER BY read_count DESC LIMIT 20)';
		$sql = $sql.' ORDER BY read_count DESC LIMIT 20';
	} else if ($tab=='restaurant') {
		$sql = 'SELECT idx, title, type, read_count, regist_time, theme FROM living_restaurant WHERE 1 ORDER BY read_count DESC LIMIT 20';
	}

	$tmp_q = $Mysql_Base->Query_normal($sql);

	$data = array();
	while( $tmp_l = @mysqli_fetch_array($tmp_q) ) {
		$data[] = $tmp_l;
	}

	return $data;
}

function get_update_index($tab) {
	global $_SET, $Mysql_Base;

	if ($tab=='today') {
		$sql = '(SELECT idx, title, type, read_count, regist_time FROM `living_culture` WHERE edate > NOW() AND gpsX is not null ORDER BY idx DESC LIMIT 20)';
		$sql = $sql.' UNION ';
		$sql = $sql.'(SELECT idx, title, type, read_count, regist_time FROM `living_festival` WHERE edate > NOW() AND gpsX is not null ORDER BY idx DESC LIMIT 20)';
		$sql = $sql.' ORDER BY regist_time DESC LIMIT 20';
	} else if ($tab=='restaurant') {
		$sql = 'SELECT idx, title, type, read_count, regist_time, theme FROM living_restaurant WHERE 1 ORDER BY idx DESC LIMIT 20';
	}

	$tmp_q = $Mysql_Base->Query_normal($sql);

	$data = array();
	while( $tmp_l = @mysqli_fetch_array($tmp_q) ) {
		$data[] = $tmp_l;
	}

	return $data;
}

function make_signature($secretKey, $method, $baseString, $timestamp, $accessKey) {
	$space = " ";
	$newLine = "\n";
	$hmac = $method.$space.$baseString.$newLine.$timestamp.$newLine.$accessKey;
	$signautue = base64_encode(hash_hmac('sha256', $hmac, $secretKey,true));
	return $signautue;
}

function get_millisecond() {
	return round(microtime(true) * 1000);
}

function log_index() {
	global $_SET, $Mysql_Base;

	$connect_device = isMobile($_SET['Conn']['userAgent']);
	$user_os = getOS($_SET['Conn']['userAgent']);
	$user_browser = '';
	$pre_uri = $_SERVER['HTTP_REFERER'];
	$user_ip = $_SET['Conn']['ipAdd'];

	$geo = get_geoLocation();

	$geo_re = array(
		'city' => $geo['geoLocation']['r1'],
		'gu' => $geo['geoLocation']['r2'],
		'dong' => $geo['geoLocation']['r3'],
		'country' => $geo['geoLocation']['country'],
	);

	//$this->session->set_userdata($geo_re);//세션만들기

	// 로그 Insert
	//$result = $this->logs->insert_connectLog($connect_device, $user_os, $user_browser, $user_ip, $geo_re, $pre_uri);
	return $result;


}

function get_geoLocation() {
	global $_SET, $Mysql_Base;

	$ncp_access_key = "D4e5mBw5CNB93vxwlNCL";
	$ncp_secret_key = "6Hs5HmsUZlagU87sfxEsuXGSJLZ6ckMASha24xSY";

	// [20190729] NCP geoLocation API 를 통해 유저 지역 정보를 가져옴 : bgkwon
	$host = "https://geolocation.apigw.ntruss.com";
	$request = "/geolocation/v2/geoLocation";
	$timestamp = get_millisecond();
	$baseString = $request."?ip=".$_SET['Conn']['ipAdd']."&ext=t&responseFormatType=json";
	$signautue = make_signature($ncp_secret_key,"GET",$baseString,$timestamp,$ncp_access_key);
	$url = $host.$baseString;

	// curl
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$headers = array();
	$headers[] = "X-NCP-APIGW-TIMESTAMP: " .$timestamp;
	$headers[] = "X-NCP-IAM-ACCESS-KEY: " .$ncp_access_key;
	$headers[] = "X-NCP-APIGW-SIGNATURE-V2: " .$signautue;

	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	$result = curl_exec($ch);
	$result = json_decode($result, true);
	return $result;

}



function setPoint( $a_DATA ) {
	global $_SET, $Mysql_Base;

	$prev_point = $Mysql_Base->Query_result(" select SUM(pp_point) from ri_pay_point where mb_seq = '".$a_DATA['mb_seq']."'and pp_open & 1 ");
	$is_point = $prev_point + $a_DATA['pp_point'];
	$a_DATA['pp_data']['remain_point'] = floatval($is_point);

	$REPLACE_QRY = array();
	$REPLACE_QRY[] = " pp_type = '".$a_DATA['pp_type']."' ";
	$REPLACE_QRY[] = " pp_code = '".$a_DATA['pp_code']."' ";
	$REPLACE_QRY[] = " mb_seq = '".intval($a_DATA['mb_seq'])."' ";
	$REPLACE_QRY[] = " pp_point = '".floatval($a_DATA['pp_point'])."' ";
	$REPLACE_QRY[] = " pp_ref = '".intval($a_DATA['pp_ref'])."' ";
	$REPLACE_QRY[] = " pp_tit = '".$a_DATA['pp_tit']."' ";
	$REPLACE_QRY[] = " pp_data = '".json_encode( $a_DATA['pp_data'], JSON_UNESCAPED_UNICODE )."' ";
	$REPLACE_QRY[] = " pp_opt = '1' ";
	$REPLACE_QRY[] = " pp_open = '1' ";
	$REPLACE_QRY[] = " pp_date_in = now() ";

	$Mysql_Base->Query_normal(" insert into ri_pay_point set ".echoSqlimplodeComma($REPLACE_QRY)." ");
	$result = $Mysql_Base->Get_insert_id();

	$REPLACE_QRY = array();
	$REPLACE_QRY[] = " mbv_point = '".$a_DATA['pp_data']['remain_point']."' ";
	$Mysql_Base->Query_normal(" update rac_member_value set ".echoSqlimplodeComma($REPLACE_QRY)." where mb_seq = '".$a_DATA['mb_seq']."' ");

	return $result;
}

function setItem( $a_DATA ) {
	global $_SET, $_VAR, $Mysql_Base;

	$prev_item = $Mysql_Base->Query_result(" select SUM(pi_item) from ri_pay_item where mb_seq = '".$a_DATA['mb_seq']."'and pi_open & 1 ");
	$is_item = $prev_item + $a_DATA['pi_item'];
	$a_DATA['pi_data']['remain_item'] = intval($is_item);

	$REPLACE_QRY = array();
	$REPLACE_QRY[] = " pi_type = '".$a_DATA['pi_type']."' ";
	$REPLACE_QRY[] = " pi_code = '".$a_DATA['pi_code']."' ";
	$REPLACE_QRY[] = " mb_seq = '".intval($a_DATA['mb_seq'])."' ";
	$REPLACE_QRY[] = " pi_item = '".intval($a_DATA['pi_item'])."' ";
	$REPLACE_QRY[] = " pi_ref = '".intval($a_DATA['pi_ref'])."' ";
	$REPLACE_QRY[] = " pi_tit = '".$a_DATA['pi_tit']."' ";
	$REPLACE_QRY[] = " pi_data = '".json_encode( $a_DATA['pi_data'], JSON_UNESCAPED_UNICODE )."' ";
	$REPLACE_QRY[] = " pi_opt = '1' ";
	$REPLACE_QRY[] = " pi_open = '1' ";
	$REPLACE_QRY[] = " pi_date_in = now() ";

	$Mysql_Base->Query_normal(" insert into ri_pay_item set ".echoSqlimplodeComma($REPLACE_QRY)." ");
	$result = $Mysql_Base->Get_insert_id();

	$REPLACE_QRY = array();
	$REPLACE_QRY[] = " mbv_item = '".$a_DATA['pi_data']['remain_item']."' ";
	$Mysql_Base->Query_normal(" update rac_member_value set ".echoSqlimplodeComma($REPLACE_QRY)." where mb_seq = '".$a_DATA['mb_seq']."' ");

	if( $a_DATA['pi_data']['remain_item'] < intval($_VAR['SERVICE_SET']['penalty_item_qty']) ) { // 기본패널티 수량보다 작으면 구매예약 해제
		$REPLACE_QRY = array();
		$REPLACE_QRY[] = " gr_open = 2 ";
		$REPLACE_QRY[] = " gr_date_chg = now() ";
		$Mysql_Base->Query_normal(" update rp_goods_reserve set ".echoSqlimplodeComma($REPLACE_QRY)." where mb_seq = '".$a_DATA['mb_seq']."' and gr_date_to > now() and !(gr_opt & 8) ");
	}

	return $result;
}

function getNextMatchingTime() {
	global $_SET, $_VAR;

	$datetime = date('Y-m-d H:i:s');
	$date = date('Y-m-d');

	$today_matching_time =  $date.' '.$_VAR['SERVICE_SET']['matching_term_hour_finish'].':00:00';
	$nxday_matching_time =  date("Y-m-d", strtotime("+1 day", strtotime($date))).' '.$_VAR['SERVICE_SET']['matching_term_hour_finish'].':00:00';

	if( $datetime < $today_matching_time ) {
		$result = $today_matching_time;
	} else {
		$result = $nxday_matching_time;
	}

	if( intval($_VAR['SERVICE_SET']['reserve_max_day']) > 0 ) {
		$tmp_add_day = intval($_VAR['SERVICE_SET']['reserve_max_day']) - 1;
		$result =  date("Y-m-d H:i:s", strtotime("+".$tmp_add_day." day", strtotime($result)));
	}

	return $result;
}

function getItemLock( $i_SEQ ) {
	global $_SET, $Mysql_Base;

	$tot_sum_fee = $Mysql_Base->Query_result(" select sum(g_fee_item) from rp_goods where g_open & 1 limit 1 ");
	$reserve_cnt = $Mysql_Base->Query_result(" select count(*) from rp_goods_reserve where mb_seq = '".$i_SEQ."' and gr_date_to > now() and gr_open & 1 limit 1 ");
	$waiting_cnt = $Mysql_Base->Query_result(" select count(*) from rp_goods_reserve a
															left join rp_goods_deal b on (a.gr_seq = b.gr_seq)
	 															where a.mb_seq = '".$i_SEQ."' and a.gr_date_to <= now() and a.gr_open & 1 and b.gd_step < 4 and b.gd_step & 1  limit 1 ");

	$result = $tot_sum_fee * ($reserve_cnt + $waiting_cnt);
	return $result;
}

function getPointLock( $i_SEQ ) {
	global $_SET, $Mysql_Base;

	$result = $Mysql_Base->Query_result(" select sum(gd_price) from rp_goods_deal where mb_seq = '".$i_SEQ."' and !(gd_step & 4) limit 1 ");
	return $result;
}

function setGoodsLockRemove( $i_SEQ, $c_CODE ) {
	global $_SET, $Mysql_Base;

	$mbv_temp = $Mysql_Base->Query_result(" select mbv_temp from rac_member_value where mb_seq = '".$i_SEQ."' limit 1 ");
	$mbv_temp_ary = array();
	if( $mbv_temp ) {
		$tmp_ary = explode(',',$mbv_temp);
		if( $tmp_ary ) {
			foreach( $tmp_ary as $v ) {
				if( $v != $c_CODE ) {
					$mbv_temp_ary[] = $v;
				}
			}
		}
	}
	$Mysql_Base->Query_normal(" update rac_member_value set mbv_temp = '".implode(',',$mbv_temp_ary)."' where mb_seq = '".$i_SEQ."' ");
}

function setGoodsLockAdd( $i_SEQ, $c_CODE ) {
	global $_SET, $Mysql_Base;

	$mbv_temp = $Mysql_Base->Query_result(" select mbv_temp from rac_member_value where mb_seq = '".$i_SEQ."' limit 1 ");
	$mbv_temp_ary = array();
	if( $mbv_temp ) {
		$mbv_temp_ary = explode(',',$mbv_temp);
	}
	$mbv_temp_ary[] = $c_CODE;
	array_unique($mbv_temp_ary);

	$Mysql_Base->Query_normal(" update rac_member_value set mbv_temp = '".implode(',',$mbv_temp_ary)."' where mb_seq = '".$i_SEQ."' "); //매칭상품을 소유로 잡는다.
}
?>
