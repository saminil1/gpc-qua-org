<?php
include_once('./_common.php');

// clean the output buffer
ob_end_clean();

$no		= isset($_REQUEST['no']) ? (int) $_REQUEST['no'] : 0;
$ia_no = isset($_REQUEST['ia_no']) ? (int) $_REQUEST['ia_no'] : 0;

// 쿠키에 저장된 ID값과 넘어온 ID값을 비교하여 같지 않을 경우 오류 발생
// 다른곳에서 링크 거는것을 방지하기 위한 코드
if(!$is_admin) {
	if (!get_session('ss_interior_view_'.$ia_no))
		alert('잘못된 접근입니다.');
}
	
$sql = " select file{$no}, source{$no} from {$g5['iso_apply_table']} where ia_no = '$ia_no' ";
$file = sql_fetch($sql);
if (!$file['file'.$no])
	alert('파일 정보가 존재하지 않습니다.');

$filepath = G5_DATA_PATH.'/apply/'.$file['file'.$no];
$filepath = addslashes($filepath);
$file_exist_check = (!is_file($filepath) || !file_exists($filepath)) ? false : true;

if ( false === run_replace('interior_download_file_exist_check', $file_exist_check, $file) ){
	alert('파일이 존재하지 않습니다.');
}

$source_name = $file['source'.$no];

$g5['title'] = '다운로드 &gt; '.conv_subject($file['source'.$no], 255);

run_event('download_file_header', $file, $file_exist_check);

$original = urlencode($source_name);

if(preg_match("/msie/i", $_SERVER['HTTP_USER_AGENT']) && preg_match("/5\.5/", $_SERVER['HTTP_USER_AGENT'])) {
    header("content-type: doesn/matter");
    header("content-length: ".filesize($filepath));
    header("content-disposition: attachment; filename=\"$original\"");
    header("content-transfer-encoding: binary");
} else {
    header("content-type: file/unknown");
    header("content-length: ".filesize($filepath));
    header("content-disposition: attachment; filename=\"$original\"");
    header("content-description: php generated data");
}
header("pragma: no-cache");
header("expires: 0");
flush();

$fp = fopen($filepath, 'rb');

// 4.00 대체
// 서버부하를 줄이려면 print 나 echo 또는 while 문을 이용한 방법보다는 이방법이...
//if (!fpassthru($fp)) {
//    fclose($fp);
//}

$download_rate = 10;

while(!feof($fp)) {
    //echo fread($fp, 100*1024);
    /*
    echo fread($fp, 100*1024);
    flush();
    */

    print fread($fp, round($download_rate * 1024));
    flush();
    usleep(1000);
}
fclose ($fp);
flush();
?>