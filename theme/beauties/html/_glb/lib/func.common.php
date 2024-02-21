<?php
/**
 *
 * @file func.common.php
 * @author wioz
 * @version 0.1.0
 * @modified wioz  2019.09.05
 */

$datetime = date('Y-m-d H:i:s');
$date = date('Y-m-d');



function aes_encrypt($data) {
	global $_SET;
	$key = $_SET['Config']['encrypt_key'];
	return base64_encode(openssl_encrypt($data, "aes-256-cbc", $key, true, str_repeat(chr(0), 16)));
}

function aes_decrypt($data) {
	global $_SET;
	$key = $_SET['Config']['encrypt_key'];
	$data = str_replace(' ','+',$data);
	return openssl_decrypt(base64_decode($data), "aes-256-cbc", $key, true, str_repeat(chr(0), 16));
}

function paramChk($pattern, $param){
	$result = preg_match($pattern, $param);
	return $result;
}

function weekOfMonth($vdate) {
	$mydate = strtotime("monday this week, +2 days", strtotime($vdate)); //수요일을 기준으로 "wednesday this week"으로 해도 될 듯...
	$month1 = date("m", $mydate);
	$firstOfMonth = strtotime(date("Y-m-01", $mydate)); //그달의 첫날
	//일요일을 한주의 시작으로 간주하는 경우 만일 그 달의 시작일이 일요일이면 이전 주(달)로 계산되기 때문에 임시로 하루를 증가시킴. (심지어 2017-01-01(일)은 2016년 12월로 계산되기도 함)
	if( date("w",$firstOfMonth) == 0 ) {
		$firstOfMonth = strtotime("tomorrow",$firstOfMonth);
	}
	$weekOfMonth = intval(date("W",$mydate)) - intval(date("W",$firstOfMonth)) + 1; //전체주수-그달 첫날의 주수 +1
	// 그달의 시작일이 수요일 이후 즉, 목금토일 때는 한주를 줄임
	if( date("w",$firstOfMonth ) > 3) {
		$weekOfMonth -= 1;
	}

	return $weekOfMonth;
}




function tag_split($str) {

	$str = str_replace(" #","#", $str);
	$str = str_replace("#"," #", $str);
	$str = " ".$str." ";
	$str = str_replace("\n", " \n", $str);
	$str = str_replace("\r", " \r", $str);

	//preg_match_all("/#([\.0-9a-z가-힣-]+)*/i",$str,$match);
	preg_match_all("/[^\&]#([\.0-9a-z가-힣-]+)*/i",$str,$match);


	$result = array_filter($match[1]);

	$tags_ary = array();
	foreach($result as $v) {
		if( !empty($v) ) {
			$tags_ary[] = $v;
		}
	}

	return array_unique($tags_ary);
}

function tag_split_in_qry($str) {

	//if( substr($str, 0, 1) == "#" )
		$str = " ".$str." ";
	$str = str_replace("\n", " \n", $str);
	$str = str_replace("\r", " \r", $str);

	//preg_match_all("/#([\.0-9a-z가-힣-]+)*/i",$str,$match);
	preg_match_all("/[^\&]#([\.0-9a-z가-힣-]+)*/i",$str,$match);


	$result = array_filter($match[1]);

	$result_qry = "";
	foreach($result as $v)
	{
		if( !empty($v) )
		{
			if( !empty($result_qry) )	$result_qry .= ",";

			$result_qry .= "'".$v."'";
		}
	}

	return $result_qry;
}


function duplicateFileName( $path, $filenm ) {
	if( is_file($path.$filenm) ) {
		$ext = explode(".",$filenm);
		$ext_size = sizeof($ext)-1;
		$ii=0;
		$filenm = $now_time."_".$ii.".".strtolower($ext[$ext_size]);

		while(is_file($path.$filenm)) {   // duplicate check
			$ii++;
			$filenm = $now_time."_".$ii.".".strtolower($ext[$ext_size]);
		}
	}
	return $filenm;
}

function ForceFlush() {
	ob_start();
	ob_end_clean();
	ob_end_flush();
}

function getLastValue( $c_value, $c_separator ) {
	$tmp_ary = explode($c_separator,$c_value);
	$k = sizeof($tmp_ary)-1;
	return $tmp_ary[$k];
}

function calculationTax( $i_val ) {
	$result = 0;
	if( intval($i_val) > 50000 ) {
		$result = round(intval($i_val) * 0.22, -2);
	}
	return $result;
}

function getYoutubeInfo( $c_url ) {
	$tmp_url = str_replace( 'https://youtu.be/', '', $c_url );
	$url_id = str_replace( 'https://www.youtube.com/embed/', '', $tmp_url );
	$url = "http://gdata.youtube.com/feeds/api/videos/". $url_id;
	$doc = new DOMDocument;
	$doc->load($url);
	$result = array();
	$result['title'] = $doc->getElementsByTagName("title")->item(0)->nodeValue;
	$result['duration'] = $doc->getElementsByTagName('duration')->item(0)->getAttribute('seconds');
	$result['thum_path'] = "https://img.youtube.com/vi/".$url_id."/0.jpg";
	return $result;
}

function strPercent($val) {
	$result = sprintf("%2.2f" ,round($val*100, 2));
	return $result;
}

function strHidden($val) {
	$tmp_cnt = mb_strlen($val, "UTF-8");
	$tmp_val = mb_strcut($val, 0, $tmp_cnt-2, "UTF-8");
	$tmp_val .= "**";
	return $tmp_val;
}

function strHiddenHP($val) {
	$val = func_splitHPNumber($val);
	$val_ary = explode('-', $val);
	if( strlen($LIST[$ary_i]['phone_number'][1]) == 3 ) {
		$tmp_val = $val_ary[0].'-***-'.$val_ary[2];
	} else {
		$tmp_val = $val_ary[0].'-****-'.$val_ary[2];
	}
	return $tmp_val;
}

function strHiddenName($val) {
	$tmp_val = substr($val,0,3)."*".substr($val,-3);
	return $tmp_val;
}

function strHiddenEmail($val) {
	$val_ary = explode('@', $val);
	$tmp_val = substr($val_ary[0],0,-3)."***@".$val_ary[1];
	return $tmp_val;
}

function getHost( $c_str ) {
    $regExp = "^([a-z://]*[^/?]*)([^$]*)";
    @ereg($regExp, $c_str, $result);
    return $result[1];
}

function echoSqlimplodeComma( $c_DATA ) {
	$result = implode(" , ", $c_DATA);
	return $result;
}

function echoSqlimplodeComma_in( $c_DATA ) {
	if( $c_DATA ) {
		$result = "'".implode("' , '", $c_DATA)."'";
	}
	if( !$result ) $result = 0;
	return $result;
}

function echoSqlimplodeAnd( $c_DATA ) {
	$result = implode(" and ", $c_DATA);
	if( !$result ) $result = 1;
	return $result;
}

function echoSqlimplodeOr( $c_DATA ) {
	$result = implode(" or ", $c_DATA);
	if( !$result ) $result = 1;
	return $result;
}

function getUuid( $c_DATA ) {
  $hash = md5( $c_DATA );
  $uuid_hash = substr($hash, 0, 8)."-".substr($hash, 8, 4)."-".substr($hash, 12, 4)."-".substr($hash, 16, 4) . "-" . substr($hash, 20, 8);
  return $uuid_hash;
}

function getFileMime($path) {
	$finfo = finfo_open(FILEINFO_MIME_TYPE);
	$mime = finfo_file($finfo,$path);
	finfo_close($finfo);
	return $mime;
}

function getFileType($mime) {
	$type = 'file';
	if ($mime == 'image/svg+xml') {
		$type = 'svg';
	} elseif ($mime == 'image/x-icon') {
		$type = 'icon';
	} elseif (preg_match('/^image/',$mime) == true) {
		$type = 'image';
	} elseif (preg_match('/^video/',$mime) == true) {
		$type = 'video';
	}
	return $type;
}

function getAge($birth) {
	$rtn = '';
	if( !$birth || substr($birth, 0, 4) == '0000' ) {

	} else {
		$birth = str_replace('-','',$birth);
		$birth = date('Ymd', strtotime($birth));
		$now = date('Ymd');
		$rtn = floor( ($now - $birth) / 10000 );
	}
	return $rtn;
}

function Encoder($value,$key='') {
	global $_SET;
	$key = $key ? (strlen($key) == 32 ? $key : md5($key)) : md5($_SET['Config']['key']);
	$padSize = 16 - (strlen($value) % 16);
	$value = $value.str_repeat(chr($padSize),$padSize);
	//$output = mcrypt_encrypt(MCRYPT_RIJNDAEL_128,$key,$value,MCRYPT_MODE_CBC,str_repeat(chr(0),16));
	$output = openssl_encrypt($value,"AES-256-CBC",$key,0,str_repeat(chr(0),16));
	return base64_encode($output);
}

function Decoder($value,$key='') {
	global $_SET;
	$key = $key ? (strlen($key) == 32 ? $key : md5($key)) : md5($_SET['Config']['key']);
	$value = base64_decode($value);
	//$output = mcrypt_decrypt(MCRYPT_RIJNDAEL_128,$key,$value,MCRYPT_MODE_CBC,str_repeat(chr(0),16));
	$output = openssl_decrypt($value,"AES-256-CBC",$key,0,str_repeat(chr(0),16));
	$valueLen = strlen($output);
	if ($valueLen % 16 > 0) { return false; }

	$padSize = ord($output{$valueLen - 1});
	if (($padSize < 1) || ($padSize > 16)) { return false; }

	for ($i=0;$i<$padSize;$i++) {
		if (ord($output{$valueLen - $i - 1}) != $padSize) { return false; }
	}

	return substr($output,0,$valueLen-$padSize);
}

function Encrypt($str, $secret_key='', $secret_iv='#@$%^&*()_+=-') {
	global $_SET;
	if( !$secret_key ) {
		$secret_key = $_SET['Config']['key'];
	}

    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, 32)    ;

    return str_replace("=", "", base64_encode(
                 @openssl_encrypt($str, "AES-256-CBC", $key, 0, $iv))
    );
}

function Decrypt($str, $secret_key='', $secret_iv='#@$%^&*()_+=-') {
	global $_SET;
	if( !$secret_key ) {
		$secret_key = $_SET['Config']['key'];
	}

    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, 32);

    return @openssl_decrypt(
            base64_decode($str), "AES-256-CBC", $key, 0, $iv
    );
}

function func_splitBusinessNumber( $prm_number ) {
	if( !$prm_number || strlen($prm_number) < 8 ) { return ""; }
	$prm_number = preg_replace( '/[^\d\n]+/' , '' , $prm_number ) ;
	return substr( $prm_number , 0 , 3 )."-".substr( $prm_number , 3 , 2 )."-".substr( $prm_number , 5 );
}

function func_splitPhoneNumber( $prm_number ) {
	if( !$prm_number || strlen($prm_number) < 8 ) { return ""; }
	$prm_number = preg_replace( '/[^\d\n]+/' , '' , $prm_number ) ;
	if ( ( substr( $prm_number , 0 , 1 ) != "0" ) && ( strlen( $prm_number ) > 8 ) ) { $prm_number = "0".$prm_number; }
	$Pn3 = substr( $prm_number , -4 ) ;
	if ( substr( $prm_number , 0 , 2 ) == "01" ) { $Pn1 = substr( $prm_number , 0 , 3 ); }
	else if ( substr( $prm_number , 0 , 2 ) == "02" ) { $Pn1 = substr( $prm_number , 0 , 2 ); }
	else if ( substr( $prm_number , 0 , 1 ) =="0" ) { $Pn1 = substr( $prm_number , 0 , 3 ); }
	$Pn2 = substr( $prm_number , strlen( $Pn1 ) , -4 );
	$_Rtn = ( ! $Pn1 ) ? $Pn2."-".$Pn3 : $Pn1."-".$Pn2."-".$Pn3;
	return $_Rtn ;
}

function func_splitHPNumber( $prm_number ) {
	if( !$prm_number ) { return ""; }
	$prm_number = str_replace( " " , "" , $prm_number ) ;
	$prm_number = str_replace( "--" , "" , $prm_number ) ;
	$prm_number = str_replace( "-" , "" , $prm_number ) ;
	if ( strlen( $prm_number ) < 10 ) { return func_splitPhoneNumber( $prm_number ); }
	$_middleLen = ( strlen( $prm_number ) == 10 ) ? 3 : 4;
	$prm_arrayRtn[0] = substr( $prm_number , 0 , 3 );
	$prm_arrayRtn[1] = substr( $prm_number , 3 , $_middleLen );
	$prm_arrayRtn[2] = substr( $prm_number , ( 3 + $_middleLen ) , 4 );
	return $prm_arrayRtn[0]."-".$prm_arrayRtn[1]."-".$prm_arrayRtn[2];
}

function createColumnsArray($end_column, $first_letters = '') {
  $columns = array();
  $length = strlen($end_column);
  $letters = range('A', 'Z');
  foreach ($letters as $letter) {
      $column = $first_letters . $letter;
      $columns[] = $column;
      if ($column == $end_column) { return $columns; }
  }
  foreach ($columns as $column) {
      if (!in_array($end_column, $columns) && strlen($column) < $length) {
          $new_columns = createColumnsArray($end_column, $column);
          $columns = array_merge($columns, $new_columns);
      }
  }
  return $columns;
}

function xlsTotColumnStyle( $column_ary,  $row_no ) {
	global $sheetIndex;
	foreach( $column_ary as $v ) {
		$sheetIndex->getStyle($v.$row_no)->getFill()->getStartColor()->setRGB('eeeeee');
		$sheetIndex->getStyle($v.$row_no)->getFont()->setBold(true);
	}
}

function strDateKr( $v ) {
	$ymd = '';
	if( !empty($v) ) {
		list($m,$d,$y) = explode('-',$v);
		$ymd = $y.'-'.$m.'-'.$d;
	}
	return $ymd;
}

function strToDatetime( $v ) {
	return date("Y-m-d H:i:s", $v);
}

function echoPrintArr( $r ) {
	echo "<pre>".print_r($r)."</pre>";
}

function setUrlStr( $url ) {
	if( (strpos( $url, "http://" ) !== false) || (strpos( $url, "https://" ) !== false) ) {
		$result = $url;
	} else {
		if( $url ) { $result = "http://".$url; } else { $result = ""; }
	}
	return $result;
}

function getOS($agent) {
    $agent = strtolower($agent);
    if (preg_match("/windows 98/", $agent))                 { $s = "Windows98"; }
    else if(preg_match("/iphone/", $agent))                 { $s = "iPhone"; } //iPhone
    else if(preg_match("/ipad/", $agent))                   { $s = "iPad"; } //iPad
    else if(preg_match("/iPod/", $agent))                   { $s = "iPod"; } //iPod
    else if(preg_match("/android/", $agent))                { $s = "Android"; } //Android
    else if(preg_match("/windows 95/", $agent))             { $s = "Windows95"; }
    else if(preg_match("/windows nt 4\.[0-9]*/", $agent))   { $s = "WindowsNT"; }
    else if(preg_match("/windows nt 5\.0/", $agent))        { $s = "Windows2000"; }
    else if(preg_match("/windows nt 5\.1/", $agent))        { $s = "WindowsXP"; }
    else if(preg_match("/windows nt 5\.2/", $agent))        { $s = "Windows2003"; }
    else if(preg_match("/windows nt 6\.0/", $agent))        { $s = "WindowsVista"; }
    else if(preg_match("/windows nt 6\.1/", $agent))        { $s = "Windows7"; }
    else if(preg_match("/windows 9x/", $agent))             { $s = "WindowsME"; }
    else if(preg_match("/windows ce/", $agent))             { $s = "WindowsCE"; }
	else if(preg_match("/windows nt 7\.[0-9]*/", $agent))   { $s = "Windows7"; }
	else if(preg_match("/windows nt 8\.[0-9]*/", $agent))   { $s = "Windows8"; }
	else if(preg_match("/windows nt 9\.[0-9]*/", $agent))   { $s = "Windows9"; }
	else if(preg_match("/windows nt 10\.[0-9]*/", $agent))   { $s = "Windows10"; }
	else if(preg_match("/windows nt 11\.[0-9]*/", $agent))   { $s = "Windows11"; }
	else if(preg_match("/windows nt 12\.[0-9]*/", $agent))   { $s = "Windows12"; }
	else if(preg_match("/windows nt 13\.[0-9]*/", $agent))   { $s = "Windows13"; }
    else if(preg_match("/linux/", $agent))                  { $s = "Linux"; }
    else if(preg_match("/sunos/", $agent))                  { $s = "sunOS"; }
    else if(preg_match("/irix/", $agent))                   { $s = "IRIX"; }
    else if(preg_match("/phone/", $agent))                  { $s = "Phone"; }
    else if(preg_match("/bot|slurp/", $agent))              { $s = "Robot"; }
    else if(preg_match("/internet explorer/", $agent))      { $s = "IE"; }
    else if(preg_match("/mozilla/", $agent))                { $s = "Mozilla"; }
    else if(preg_match("/macintosh/", $agent))              { $s = "Mac"; }
    else { $s = "기타"; }
    return $s;
}

function autoLink($str) {
	$body = preg_replace('/((http|https):\/\/[\w-]+(\.[\w-]+)+([\w.,@?^=%&:\/~+#-]*[\w@?^=%&\/~+#-])?)/', '<a href="\1" class="tag_cls" target="_blank">\1</a>', $str);
	return $body;
}

function file_get_contents_curl($url) {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}

function get_meta($url) {
	$html = file_get_contents_curl($url);

	//parsing begins here:
	$doc = new DOMDocument();
	@$doc->loadHTML($html);
	$nodes = $doc->getElementsByTagName('title');

	//get and display what you need:
	$title = $nodes->item(0)->nodeValue;

	$metas = $doc->getElementsByTagName('meta');

	$tmp_val = array();

	//$tmp_val['title'] = $title;
	for ($i = 0; $i < $metas->length; $i++) {
	    $meta = $metas->item($i);

		$tmp_val[$meta->getAttribute('property')] = $meta->getAttribute('content');
		/*
	    if($meta->getAttribute('name') == 'description') {
	        $description = $meta->getAttribute('content');
	    } else if($meta->getAttribute('name') == 'keywords') {
	        $keywords = $meta->getAttribute('content');
		} else if($meta->getAttribute('name') == 'keywords') {
		}
		*/
	}

	return $tmp_val;
}

function splitNickname($str) {
	preg_match_all("/@([\.0-9a-z가-힣-]+)*/i",$str,$match);
	$result = array_filter($match[1]);
	$result_qry = "";
	foreach($result as $v) {
		if( !empty($v) ) {
			if( !empty($result_qry) ) {	$result_qry .= ","; }
			$result_qry .= "'".$v."'";
		}
	}
	return $result_qry;
}

function splitTags($str) {
	preg_match_all("/#([\.0-9a-z가-힣-]+)*/i",$str,$match);
	$result = array_filter($match[1]);
	$result_qry = "";
	foreach($result as $v) {
		if( !empty($v) ) {
			if( !empty($result_qry) ) { $result_qry .= ","; }
			$result_qry .= $v;
		}
	}
	return $result_qry;
}

function arraySearchOpt($str_ary, $str_val) {
	$result_ary = array();
	$result_ary['opt_html'] = '';
	$result_ary['concat_qry'] = '';
	if( $str_ary ) {
		$result_ary['opt_html'] .= '<option value="" '.echoChk( '', $str_val, 'selected' ).' >전체</option>';
		$result_ary['concat_qry'] .= " concat( '|&|'";
		foreach( $str_ary as $k => $v ) {
			$result_ary['opt_html'] .= '<option value="'.$k.'" '.echoChk( $k, $str_val, 'selected' ).' >'.$v.'</option>';
			$result_ary['concat_qry'] .= ",ifnull(".$k.",''),'|&|'";
		}
		$result_ary['concat_qry'] .= ")";
	}
	return $result_ary;
}

function imgRotateR($img_path) {
	$image = @ImageCreateFromJPEG($img_path);
	$image_func = '@ImageJPEG';
	if( !$image ) { $image = @ImageCreateFromGIF($img_path); $image_func = '@ImageGIF'; }
	if( !$image ) { $image = @ImageCreateFromPNG($img_path); $image_func = '@ImagePNG'; }
	if( !$image ) { $image = @ImageCreateFromBMP($img_path); $image_func = '@ImageBMP'; }
	if( !$image ) { $image = @ImageCreateFromWBMP($img_path); $image_func = '@ImageWBMP'; }
	if( !$image ) { $image = @ImageCreateFromXBM($img_path); $image_func = '@ImageXBM'; }
	$exif = @exif_read_data($img_path);
	if(!empty($exif['Orientation'])) {
		switch($exif['Orientation']) {
			case 8:
				$image = @imagerotate($image,90,0);
				break;
			case 3:
				$image = @imagerotate($image,180,0);
				break;
			case 6:
				$image = @imagerotate($image,-90,0);
				break;
		}
	}
	if( $image_func == '@ImageJPEG' ) {
		@ImageJPEG($image, $img_path);
	} else if( $image_func == '@ImageGIF' ) {
		@ImageGIF($image, $img_path);
	} else if( $image_func == '@ImagePNG' ) {
		@ImagePNG($image, $img_path);
	} else if( $image_func == '@ImageBMP' ) {
		@ImageBMP($image, $img_path);
	} else if( $image_func == '@ImageWBMP' ) {
		@ImageWBMP($image, $img_path);
	} else if( $image_func == '@ImageXBM' ) {
		@ImageXBM($image, $img_path);
	}
	@ImagePNG($image, $img_path);
	@imagedestroy($image);
	return 1;
}

function imgWHrate($img_path) {
	$img_path_c = @ImageCreateFromJPEG($img_path);
	if( !$img_path_c ) { $img_path_c = @ImageCreateFromGIF($img_path); }
	if( !$img_path_c ) { $img_path_c = @ImageCreateFromPNG($img_path); }
	if( !$img_path_c ) { $img_path_c = @ImageCreateFromBMP($img_path); }
	if( !$img_path_c ) { $img_path_c = @ImageCreateFromWBMP($img_path); }
	if( !$img_path_c ) { $img_path_c = @ImageCreateFromXBM($img_path); }
	$w = @imagesx($img_path_c);
	$h = @imagesy($img_path_c);
	if($w < $h) { $return = intval(@round(@($h/$w),2)*100); } else { $return = intval(@round(@($w/$h),2)*100); }
	return $return;
}

function imgWHsize($img_path) {
	$img_path_c = @ImageCreateFromJPEG($img_path);
	if( !$img_path_c ) { $img_path_c = @ImageCreateFromGIF($img_path); }
	if( !$img_path_c ) { $img_path_c = @ImageCreateFromPNG($img_path); }
	if( !$img_path_c ) { $img_path_c = @ImageCreateFromBMP($img_path); }
	if( !$img_path_c ) { $img_path_c = @ImageCreateFromWBMP($img_path); }
	if( !$img_path_c ) { $img_path_c = @ImageCreateFromXBM($img_path); }
	$w = @imagesx($img_path_c);
	$h = @imagesy($img_path_c);
	return $w;
}

function imgInfo($img_path) {
	$img_path_c = @ImageCreateFromJPEG($img_path);
	if( !$img_path_c ) { $img_path_c = @ImageCreateFromGIF($img_path); }
	if( !$img_path_c ) { $img_path_c = @ImageCreateFromPNG($img_path); }
	if( !$img_path_c ) { $img_path_c = @ImageCreateFromBMP($img_path); }
	if( !$img_path_c ) { $img_path_c = @ImageCreateFromWBMP($img_path); }
	if( !$img_path_c ) { $img_path_c = @ImageCreateFromXBM($img_path); }
	$w = @imagesx($img_path_c);
	$h = @imagesy($img_path_c);
	$r = $g = $b = 0;
	for($y = 0; $y < $h; $y++) {
		for($x = 0; $x < $w; $x++) {
			$rgb = @imagecolorat($img_path_c, $x, $y);
			$r += $rgb >> 16;
			$g += $rgb >> 8 & 255;
			$b += $rgb & 255;
		}
	}
	$pxls = $w * $h;
	$r = dechex(@round($r / $pxls));
	$g = dechex(@round($g / $pxls));
	$b = dechex(@round($b / $pxls));
	if(strlen($r) < 2) { $r = 0 . $r; }
	if(strlen($g) < 2) { $g = 0 . $g; }
	if(strlen($b) < 2) { $b = 0 . $b; }
	$img_color = "#".$r.$g.$b;
	$wh_rate = round($h/$w,2);
	return $img_color."|".$w."|".$h."|".$wh_rate;
}



function strDiffTime( $rtime ){
	$cur_time = time();
    $ref_time = strtotime($rtime);
    $cur_date = floor($cur_time / 86400);
    $ref_date = floor($ref_time / 86400);
    $datetimediff = $cur_time - $ref_time;
    $datedist = $cur_date - $ref_date;
    $datediff = floor($datetimediff / 86400);
    $weekdiff = floor($datediff / 7);
    $timediff = $datetimediff % 86400;
    $hour = floor($timediff / 3600);
    $min = floor($timediff % 3600 / 60);
    $sec = floor($timediff % 3600 % 60);
	$result = "";
	if($datedist>34) {
		$result = date("Y년 m월 d일", $ref_time);
	} else if($weekdiff>0) {
		$result = $weekdiff . "주 전";
	} else {
		if($datediff>0) {
			$result = $datedist . "일 전";
		} else if($timediff<=0) {
			$result = "방금 전";
		} else {
			if($hour) {
				$result = $hour . "시간 전";
			} else if( $min > 5 ) {
				$result = $min . "분 전";
			} else {
				//$result = $sec . "초 전";
				$result = "방금 전";
			}
		}
	}
	return $result;
}

function strWeekDay( $s_date ) {
	$str_week_day = array("일","월","화","수","목","금","토");
	return str_replace('-', '. ', $s_date)." (".$str_week_day[date('w', strtotime($s_date))].")";
}

function strDiffMonth( $rtime ){
	$cur_time = time();
    $ref_time = strtotime($rtime);
    $cur_date = floor($cur_time / 86400);
    $ref_date = floor($ref_time / 86400);
    $datetimediff = $cur_time - $ref_time;
    $datedist = $cur_date - $ref_date;
    $datediff = floor($datetimediff / 86400);
    $weekdiff = floor($datediff / 7);
    $monthdiff = floor($datediff / 31);
    $timediff = $datetimediff % 86400;
    $hour = floor($timediff / 3600);
    $min = floor($timediff % 3600 / 60);
    $sec = floor($timediff % 3600 % 60);
	$result = "";
	if($datedist>31) {
		$result = $monthdiff."개월";
	} else {
		$result = "최근 1개월";
	}
	return $result;
}

function strDiffDay( $rtime ) {
    $datetime = date('Y-m-d H:i:s');
    $date1 = new DateTime($rtime);
	$date2 = new DateTime($datetime);



	$diff = date_diff($date1, $date2);

	$result = '';
	if( $diff->y > 0 ) { $result .= $diff->y."년 "; }
	if( $diff->m > 0 ) { $result .= $diff->m."개월 "; }
	if( $diff->d > 0 ) { $result .= $diff->d."일"; }
	if( !$result ) { $result = $diff->h."시간"; }

	return $result;
}

function strDiffstrDay( $rtime ) {

    $datetime = date('Y-m-d H:i:s');
    $date1 = new DateTime($rtime);
	$date2 = new DateTime($datetime);
	$diff = date_diff($date1, $date2);

	$result = '';
	if( $diff->y > 0 ) { $result .= $diff->y."년 "; }
	if( $diff->m > 0 ) { $result .= $diff->m."개월 "; }
	if( $diff->d > 0 ) { $result .= $diff->d."일"; }
	if( !$result ) { $result = $diff->h."시간"; }

	return $diff->days.'일';
}

function diffTime( $rtime ) {
	$cur_time = time();
    $ref_time = strtotime($rtime);
    $datetimediff = $cur_time - $ref_time;
	return $datetimediff;
}

function diffTimeRev( $rtime ) {
	$cur_time = time();
    $ref_time = strtotime($rtime);
    $datetimediff = $ref_time - $cur_time;
	return $datetimediff;
}

function formMail() {
	global $EMAIL;
	$mail_to = $EMAIL['to'];
	$mail_from = $EMAIL['from_email'];
	$mail_name = trim($EMAIL['from_name']);
	$mail_title = trim($EMAIL['title']);
	$mail_text = trim($EMAIL['text']);
	$Headers .= "Return-Path: ".$mail_from."\r\n";
	$Headers .= "From: ".$mail_name." <".$mail_from.">\r\n";
	$headers .= 'MIME-Version: 1.0' . "\r\n";
	$Headers .= "X-Mailer: Gfew Interface\r\n";
	$Headers .= "Reply-To: ".$mail_from." \r\n";
	$Headers .= "Content-Type: text/html; charset=EUC-KR \r\n";
	$subject = $mail_title;
	$contents = $mail_text;
	if( @mail($mail_to , $subject , $contents , $Headers) ) { return 1; } else { return 0; }
}

function floatFloor( $val ) {
	return floor($val*100)/100;
}

function isImage( $img_val ) {
	$extAry = array( ".jpeg", ".jpg", ".gif", ".png", ".bmp" );
	$i = 0; foreach($extAry as $k => $v) {
		if( preg_match("/".$v."/i", $img_val) ) { $i++; }
	}
	$i = intval($i);
    return $i;
}

function isPageCheck() {
	global $_PAGE;
	$i = 0; foreach($_PAGE as $key => $val) {
		if( !is_file( $val ) ) { $i++; }
	}
	$i = intval($i);
    return $i;
}

function ImageBlur($img_path, $rate = '10') {
	$image = @ImageCreateFromJPEG($img_path);
	$image_func = 'ImageJPEG';
	if( !$image ) { $image = @ImageCreateFromGIF($img_path); $image_func = 'ImageGIF'; }
	if( !$image ) { $image = @ImageCreateFromPNG($img_path); $image_func = 'ImagePNG'; }
	if( !$image ) { $image = @ImageCreateFromBMP($img_path); $image_func = 'ImageBMP'; }
	if( !$image ) { $image = @ImageCreateFromWBMP($img_path); $image_func = 'ImageWBMP'; }
	if( !$image ) { $image = @ImageCreateFromXBM($img_path); $image_func = 'ImageXBM'; }
	for ($i = 0; $i < $rate; $i++) {
		@imagefilter($image, IMG_FILTER_GAUSSIAN_BLUR);
	}
	$image_func($image, $img_path);
	@imagedestroy($image);
	return $img_path;
}

function getRealExt($imagetype) {
	$ext = image_type_to_extension($imagetype);
	$ext = str_replace("jpeg", "jpg", $ext);
	$ext = str_replace(".", "", $ext);
	return $ext;
}

function cutStr( $val, $size ) {
	$result = mb_strimwidth( $val, 0, intval($size), "...", "utf-8" );
    return $result;
}

function strMobile( $str ) {
	$str = str_replace("-","",trim($str));
	return $str;
}

function winOpen( $url ) {
	$result = '<a style="cursor:pointer;" onclick="window.open(\''.$url.'\');">'.cutStr( $url, 80 ).'</a>';
    return $result;
}

function isMobile( $prm_httpUserAgent ) {
	$_MOBILE_AGENT_ARRAY = array ( 'iphone', 'ipod', 'iemobile', 'mobile', 'android', 'ppc' );
	$user_agent = strtolower( $prm_httpUserAgent ) ;
	$iOS_tmp = array("iPhone","iPod","OS 5","OS 4","OS 3","OS 6","OS 7","OS 8","OS 9","OS 10","OS 11","OS 12","OS 13","OS 14","OS 15","OS 16","OS 17");
	$result = "D";
	foreach( $_MOBILE_AGENT_ARRAY AS $key ) {
		if ( strpos( $user_agent , $key ) ) {
			$result = "A";
			foreach($iOS_tmp as $val) {
				if( strstr($prm_httpUserAgent,  strtolower($val)) ) {
					$result = "I";
				}
			}
		}
	}
	return $result;
}

function goUrl( $url, $msg="" ) {
	global $_SET;
	echo "<meta http-equiv='content-type' content='text/html; charset=".$_SET['Body']['charset']."'>";
	if( !empty( $msg ) ) { $alert_script = " alert( '".$msg."' ); "; }
	echo "
	<script>
		".$alert_script."
		if ( ( window.parent == undefined ) || ( typeof( window.parent ) == undefined ) ) {
			document.location.href='".$url."';
		} else {
			parent.document.location.href='".$url."';
		}
	</script>
		";
	exit;
}

function Msg( $msg ) {
	global $_SET;
	echo "<meta http-equiv='content-type' content='text/html; charset=".$_SET['Body']['charset']."'>";
	echo "<script>alert( '".$msg."' ) ;</script>" ;
}


function MsgAct( $act, $msg = "" ) {
	global $_SET;
	if( !empty( $msg ) ) { $alert_script = " alert( '".$msg."' ); "; }
	echo "<meta http-equiv='content-type' content='text/html; charset=".$_SET['Body']['charset']."'>";
	echo "
	<script>
		".$alert_script."
		".$act."
	</script>
		";
}

function stringDate( $datetime ) {
	$result = str_replace( "-",".", substr( $datetime, 0, 10 ) );
    return $result;
}

function stringDateSch( $datetime ) {
	$result = str_replace( "-",".", substr( $datetime, 0, 16 ) );
    return $result;
}

function stringDateTime( $datetime ) {
	$result = str_replace( "-", ".", $datetime );
    return $result;
}

function stringDateTimeBr( $datetime ) {
	$result = str_replace( " ", "<br>", $datetime );
    return $result;
}

function euckr($val) {
	return iconv('utf-8','euc-kr',$val);
}

function utf8($val) {
	return iconv('euckr','utf8',$val);
}

function numForm($num) {
	$how_num = "";
	if($num < 1024) { $how_num = "<span class='unit_opt'>B</span>"; }
	if($num > 1024) { $num = $num / 1024; $how_num = "<span class='unit_opt'>K</span>"; }
	if($num > 1024) { $num = $num / 1024; $how_num = "<span class='unit_opt'>M</span>"; }
	if($num > 1024) { $num = $num / 1024; $how_num = "<span class='unit_opt'>G</span>"; }
	if($num > 1024) { $num = $num / 1024; $how_num = "<span class='unit_opt'>T</span>"; }
	$num = number_format($num,1);
	return $num.$how_num;
}

function replaceSpecialTags($source) {
	$source = trim($source);
	$source = str_replace("<","&#60;",$source);
	$source = str_replace(">","&#62;",$source);
	return $source;
}

function removeEvilTags($source) {
	$allowedTags = "<h1><b><i><a><ul><ol><li><pre><hr><blockquote><img><embed><font><br><p>".
					"<span><table><tr><td><th><blockquote><div><br><strong><EM><U>";
	$source = strip_tags($source, $allowedTags);
	return preg_replace('/<(.*?)>/ie', "'<'.removeEvilAttributes('\\1').'>'", $source);
}

function removeEvilAttributes($tagSource) {
	$stripAttrib = "javascript:|onclick|ondblclick|onmousedown|onmouseup|onmouseover|".
					"onmousemove|onmouseout|onkeypress|onkeydown|onkeyup|alert";
	return stripslashes(preg_replace("/$stripAttrib/i", 'forbidden', $tagSource));
}

function joinPostAuth($keys) {
	global $_SESSION;
	$init_auth_chk = 0;
	if( $_SESSION['joinInfo'] ) {
		foreach( $_SESSION['joinInfo'] as $k => $v ) {
			if( in_array( $k, $keys ) ) {
				$init_auth_chk ++;
			}
		}
	}
	if( count($keys) != $init_auth_chk ) {
		MsgAct( "window.history.go(-1);", "비정상적인 접근입니다." );
	}
}


function onlyNumber( $val ) {
	$str = preg_replace("/[^0-9]*/s", "", $val);
    return intval($str);
}

function echoChk($field,$value,$var) {
	if($field == $value) {
		return $var;
	} else {
		return '';
	}
}

function echoChkArr($field,$value_ary,$var) {
	if( is_array($value_ary) ) {
		if( in_array( $field , $value_ary ) ) {
			return $var;
		} else {
			return '';
		}
	} else {
		return '';
	}
}

function echoChkBit($field,$value,$var) {
	if( intval($field) & intval($value) ) {
		return $var;
	} else {
		return '';
	}
}

function Paging() {
	global $pg, $tot_count, $one_page_num, $one_block_num, $get_qry;
	$total_page = ceil($tot_count/$one_page_num);
	$now_block	= ceil($pg/$one_block_num);
	$prev_block = $one_block_num*($now_block-1);
	$url = $_SERVER['PHP_SELF'];
	if ($prev_block < 1) { $prev_block = 1; }

	if( $tot_count > 0 ) {
		$html.= '	<a class="num" onclick="get_breakdown( \''.$prev_block.'\' );" ><</a>';
		for ($i=1;$i<=$one_block_num;$i++) {
			$page_num = ($one_block_num*($now_block-1)+$i);
			if ($page_num > $total_page) {
				break;
			} else {
				if ($pg == $page_num) {
					$html.= '	<a class="num_on">'.$page_num.'</a>';
				} else {
					$html.= '	<a class="num" onclick="get_breakdown( \''.$page_num.'\' );">'.$page_num.'</a>';
				}
			}
		}
		$next_page = $page_num+1;
		if ($next_page > $total_page) {
			$next_page = $total_page;
		}
		$html.= '	<a class="num" onclick="get_breakdown( \''.$next_page.'\' );">></a>';
	}
	return $html;
}

function getGraphAverage( $ary_data ) {
	$ary_j = 1;
	$ary_k = 2;
	for($ary_i=0; $ary_i < count($ary_data); $ary_i++) 	{
		$tmp_aver = 0;
		$tmp_aver = round( ($ary_data[$ary_i] + $ary_data[$ary_k]) / 2 );
		if( $tmp_aver > ($ary_data[$ary_j]+49) ) {
			$ary_data[$ary_j] = $tmp_aver;
		}
		$ary_j++;
		$ary_k++;
	}
	return $ary_data;
}

function splitTime( $second ) {
	$day = floor($second / 86400);
    $hour = floor(($second % 86400) / 3600);
    $min = floor(($second % 86400) % 3600 / 60);
    $sec = floor(($second % 86400) % 3600 % 60);
	if( $day > 0 ) {
		$result = $day."|".sprintf("%02d", $hour).":".sprintf("%02d", $min).":".sprintf("%02d", $sec);
	} else {
		$result = sprintf("%02d", $hour).":".sprintf("%02d", $min).":".sprintf("%02d", $sec);
	}
	return $result;
}
?>
