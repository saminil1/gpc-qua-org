<?php
include_once('./_common.php');
include_once(G5_LIB_PATH.'/json.lib.php');
include_once(G5_LIB_PATH.'/register.lib.php');
/*****************************
* 신청내역 확인 ajax 
	- SETP1 과 신청완료 페이지에서 인증번호를 통한 신청내역 확인 인증을 거치는 페이지
	- iso_mode 값을 가지고 아이디 / 비밀번호 인지 인증번호인지 여부를 따져서 인증한다.
*****************************/

$iso_mode		= isset($_POST['iso_mode'])	? clean_xss_tags($_POST['iso_mode']) : '';// 유형 제목

if(!$iso_mode) die(json_encode(array('error' => '잘못된 접근입니다.')));

if($iso_mode == 'login') {// 회원 로그인
	$mb_id			= isset($_POST['mb_id'])	? clean_xss_tags($_POST['mb_id']) : '';// 유형 제목
	$mb_password	= isset($_POST['mb_password'])	? clean_xss_tags($_POST['mb_password']) : '';// 유형 제목
	
	//$mb_id			= trim($_POST['mb_id']);
	//$mb_password    = trim($_POST['mb_password']);

	
	if(!$mb_id) die(json_encode(array('error' => '회원아이디가 넘어오지 않았습니다.')));
	if(!$mb_password) die(json_encode(array('error' => '비밀번호가 넘어오지 않았습니다.')));
	//if ($msg = empty_mb_id($mb_id)) die(json_encode(array('error' => $msg)));// 값 존재 유무
	//if ($msg = valid_mb_id($mb_id)) die(json_encode(array('error' => $msg)));// 정규식(이메일로 넘어올 수도 있으므로 주석)
	//if ($msg = count_mb_id($mb_id)) die(json_encode(array('error' => $msg)));// 최소 글자 수
	//if ($msg = reserve_mb_id($mb_id)) die(json_encode(array('error' => $msg)));// 예약된 단어 금지
	//if ($msg = exist_mb_id($mb_id)) die(json_encode(array('error' => $msg)));// 이미 사용중인지 여부
	
	//$mb = get_member($mb_id);
	$sql = " select * from {$g5['member_table']} where mb_id = TRIM('$mb_id') or mb_email = TRIM('$mb_id') ";
	$mb = sql_fetch($sql);

	if (!$mb['mb_id'] || !login_password_check($mb, $mb_password, $mb['mb_password'])) {
		run_event('password_is_wrong', 'login', $mb);
		die(json_encode(array('error' => '가입된 회원아이디가 아니거나 비밀번호가 틀립니다. 비밀번호는 대소문자를 구분합니다.')));
	}
	
	/* 차단된 아이디인가?
	if ($mb['mb_intercept_date'] && $mb['mb_intercept_date'] <= date("Ymd", G5_SERVER_TIME)) {
		$date = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})/", "\\1년 \\2월 \\3일", $mb['mb_intercept_date']);
		die(json_encode(array('error' => '회원님의 아이디는 접근이 금지되어 있습니다.\n처리일 : '.$date)));
	}
	*/
	/* 탈퇴한 아이디인가?
	if ($mb['mb_leave_date'] && $mb['mb_leave_date'] <= date("Ymd", G5_SERVER_TIME)) {
		$date = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})/", "\\1년 \\2월 \\3일", $mb['mb_leave_date']);
		die(json_encode(array('error' => '탈퇴한 아이디이므로 접근하실 수 없습니다.\n탈퇴일 : '.$date)));
	}
	*/

	// 아이디를 가지고 신청내역을 가져온다.
	$sql = " select * from {$g5['iso_apply_table']} where mb_id = '{$mb['mb_id']}' ";	
	$result = sql_query($sql);
	$iso_count = 0;	
	for ($i=1; $row=sql_fetch_array($result); $i++) {
		$iso_count++;
		$iso_arr[$i]['name_kr'] = get_text($row['name_kr']);// 이름
		$iso_arr[$i]['od_id'] = get_text($row['od_id']);// 인증번호
		$iso_arr[$i]['standard'] = get_text($row['standard']);// 신청규격
		$iso_arr[$i]['grade'] = get_text($row['grade']);// 등급
		$iso_arr[$i]['type'] = get_text($row['type']);// 유형
		$iso_arr[$i]['state'] = get_text($row['state']);// 상태
		$iso_arr[$i]['datetime'] = get_text($row['datetime']);// 등록일	
	}



} else if($iso_mode == 'certification') {// 인증번호
	$scode	= isset($_POST['scode'])	? clean_xss_tags($_POST['scode']) : '';// 유형 제목
	if(!$scode) die(json_encode(array('error' => '인증번호가 넘어오지 않았습니다.')));

	$sql = " select * from {$g5['iso_apply_table']} where od_id = TRIM('$scode') ";
	$mb = sql_fetch($sql);

	if (!$mb['mb_id']) {
		die(json_encode(array('error' => '등록되지 않은 인증번호 입니다.')));
	}

	// 인증번호를 가지고 신청내역을 가져온다.
	$sql = " select * from {$g5['iso_apply_table']} where od_id = '{$scode}' ";
	$result = sql_query($sql);
	$iso_count = 0;	
	for ($i=1; $row=sql_fetch_array($result); $i++) {
		$iso_count++;
		$iso_arr[$i]['name_kr'] = get_text($row['name_kr']);// 이름
		$iso_arr[$i]['od_id'] = get_text($row['od_id']);// 인증번호
		$iso_arr[$i]['standard'] = get_text($row['standard']);// 신청규격
		$iso_arr[$i]['grade'] = get_text($row['grade']);// 등급
		$iso_arr[$i]['type'] = get_text($row['type']);// 유형
		$iso_arr[$i]['state'] = get_text($row['state']);// 상태
		$iso_arr[$i]['datetime'] = get_text($row['datetime']);// 등록일	
	}

} else {
	die(json_encode(array('error' => '잘못된 접근입니다.')));
}

ob_start();
include_once (G5_THEME_PATH.'/apply/ajax.apply_confirm_list.php');
?>


<?php
$content = ob_get_contents();
ob_end_clean();

//die(json_encode(array('result' => '잘못된 접근입니다.')));
die(json_encode(array('result' => 'y', 'content' => $content)));
?>