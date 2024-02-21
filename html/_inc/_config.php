<?php
header("Content-type: text/html; charset=UTF-8");
header("Cache-Control:no-cache");
header("Pragma:no-cache");
//header('Access-Control-Allow-Origin: *');

@session_start();

session_cache_limiter("private");
ini_set("session.cookie_lifetime", 3600);
ini_set("session.cache_expire", 3600);
ini_set("session.gc_maxlifetime", 3600);

error_reporting(E_ALL & ~E_NOTICE);
ini_set("display_errors", 1);


$_SET = array();
//$_SET['Config']['host'][0]			= "amina1020.iwinv.net";
$_SET['Config']['host'][0]			= "gpcert.org";
//$_SET['Config']['host'][1]			= "amina1020.iwinv.net";
$_SET['Config']['host'][1]			= "gpcert.org";
$_SET['Config']['lang']				= "KR";
$_SET['Config']['key']				= "gpcert.org";
$_SET['Config']['encrypt_key']		= "kby2DdaFOs7BRIRGmNBOSwqHgp9AgCOV";

$_SET['Path']['lib'] 				= $_SERVER['DOCUMENT_ROOT']."/html/_glb/lib";
$_SET['Path']['js'] 				= "../_glb/js";
$_SET['Path']['css'] 				= "../_glb/css";

$_SET['Path']['inc'] 				= $_SERVER['DOCUMENT_ROOT']."/html/_inc";
$_SET['Path']['data'] 				= $_SERVER['DOCUMENT_ROOT']."/html/_data";

$_SET['Path']['in_js'] 				= "../_inc/js";
$_SET['Path']['in_css'] 			= "../_inc/css";
$_SET['Path']['root'] 				= "/html";

$_SET['Body']['charset']			= "UTF-8";
$_SET['Body']['title']				= "관리자페이지";
$_SET['Body']['brand']				= "alcon";
$_SET['Body']['company']			= "alcon";
$_SET['Body']['domain']				= $_SERVER['HTTP_HOST'];
$_SET['Body']['cookie_domain']		= ".".preg_replace( array('/www./') ,"",$_SERVER['HTTP_HOST']);


$_SET['Conn']['referer']			= $_SERVER['HTTP_REFERER'];
$_SET['Conn']['referer']			= str_replace("http://","",$_SERVER['HTTP_REFERER']);
$_SET['Conn']['referer']			= str_replace("https://","",$_SET['Conn']['referer']);
$_SET['Conn']['referer']			= str_replace($_SERVER['HTTP_HOST'],"",$_SET['Conn']['referer']);

$_SET['Conn']['userAgent']			= $_SERVER['HTTP_USER_AGENT'];
$_SET['Conn']['ipAdd']				= $_SERVER['REMOTE_ADDR'];	$ary_ip = explode('.',$_SERVER['REMOTE_ADDR']);
$_SET['Conn']['ipAbt']				= $ary_ip[0].".".$ary_ip[1].".".$ary_ip[2];
$_SET['Conn']['roughipAbt']			= $ary_ip[0].".".$ary_ip[1];

$_SET['Conn']['isAjax']				= isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';

//require_once "/home1/amina1020/public_html/html/_glb/lib/func.common.php";
//require_once "/home1/amina1020/public_html/html/_glb/lib/class.mysql_dqg.php";
require_once "/gicertorg1/www/html/_glb/lib/func.common.php";
require_once "/gicertorg1/www/html/_glb/lib/class.mysql_dqg.php";


$_CONFIGS_db = new stdClass();
$_CONFIGS_db->type = 'mysql';         // DB type
$_CONFIGS_db->host = '127.0.0.1';     // DB host
$_CONFIGS_db->username = 'gicertorg1'; // DB user_id
$_CONFIGS_db->password = 'ikongboo26341@'; // DB password
$_CONFIGS_db->database = 'gicertorg1'; // DB database name
$_CONFIGS_db->port = 3306; // DB port
//$_CONFIGS_db->charset = 'utf8mb4'; // DB charset
$_CONFIGS_db->charset = 'utf8_general_ci'; // DB charset

$Mysql_Base = new mysql( $_CONFIGS_db );


require_once $_SET['Path']['lib']."/class.fileup.php";
require_once $_SET['Path']['inc']."/_config.var.php";
require_once $_SET['Path']['inc']."/_config.var.address.php";
//require_once $_SET['Path']['inc']."/_config.function.php";


if($_SESSION['login']['email']==""){
	//echo "<script>location.href='login.html';</script>";
}
?>