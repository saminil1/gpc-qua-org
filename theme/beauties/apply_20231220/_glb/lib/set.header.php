<?php
header("Content-type: text/html; charset=UTF-8");
//header("Cache-Control:no-cache");
//header("Pragma:no-cache");

@session_start();

session_cache_limiter("private");
ini_set("session.cookie_lifetime", 3600);
ini_set("session.cache_expire", 3600);
ini_set("session.gc_maxlifetime", 3600);

error_reporting(E_ALL & ~E_NOTICE);
ini_set("display_errors", 1);

$_SET = Array();

$_SET['Config']['key']				= 'kr.wioz.tank';
$_SET['Path']['lib'] 				= $_SERVER['DOCUMENT_ROOT']."/_lib";
$_SET['Path']['inc'] 				= $_SERVER['DOCUMENT_ROOT']."/_inc";
$_SET['Path']['adm_inc'] 			= $_SERVER['DOCUMENT_ROOT']."/adm/_inc";
$_SET['Path']['data'] 				= $_SERVER['DOCUMENT_ROOT']."/_data";
$_SET['Path']['class'] 				= $_SERVER['DOCUMENT_ROOT']."/_class";
$_SET['Path']['common'] 			= $_SERVER['DOCUMENT_ROOT']."/common";

$_SET['Body']['charset']			= "UTF-8";
$_SET['Body']['brand']				= "법무법인 혜안";
$_SET['Body']['domain']				= $_SERVER['HTTP_HOST'];

$_SET['Body']['domain_full']		= "http://".$_SERVER['HTTP_HOST'];
$_SET['Body']['cookie_domain']		= ".".preg_replace( array('/www./') ,"",$_SERVER['HTTP_HOST']);

$_SET['Body']['admin_name']			= "운영자";
$_SET['Body']['admin_email']		= "admin@wioz.kr";

$_SET['Nav']['pageurl']				= $_SERVER['PHP_SELF'];
$_SET['Nav']['pagefile']			= basename($_SERVER['PHP_SELF']);
list($_SET['Nav']['pagename'],$_SET['Nav']['pageext']) = explode('.',$_SET['Nav']['pagefile']);
$_SET['Nav']['tmp']					= explode("/", dirname($_SERVER['PHP_SELF']));
$_SET['Nav']['pagefolder']			= $_SET['Nav']['tmp'][count( $_SET['Nav']['tmp'] )-1];

$_SET['Conn']['referer']			= $_SERVER['HTTP_REFERER'];
$_SET['Conn']['referer']			= str_replace("http://","",$_SERVER['HTTP_REFERER']);
$_SET['Conn']['referer']			= str_replace($_SERVER['HTTP_HOST'],"",$_SET['Conn']['referer']);
$_SET['Conn']['userAgent']			= $_SERVER['HTTP_USER_AGENT'];
$_SET['Conn']['ipAdd']				= $_SERVER['REMOTE_ADDR'];	$ary_ip = explode('.',$_SERVER['REMOTE_ADDR']);
$_SET['Conn']['ipAbt']				= $ary_ip[0].".".$ary_ip[1].".".$ary_ip[2];
$_SET['Conn']['roughipAbt']			= $ary_ip[0].".".$ary_ip[1];

$_SET['Conn']['isAjax']				= isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';


?>
