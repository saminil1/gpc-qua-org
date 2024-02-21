<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

include_once(G5_LIB_PATH.'/counsel.lib.php');

$g5['counsel_opt_table']	= G5_TABLE_PREFIX . 'counsel_opt';		// 고객심사원등록 옵션 테이블
$g5['counsel_item_table']	= G5_TABLE_PREFIX . 'counsel_items';	// 고객심사원등록 아이템 테이블

$csconfig	= sql_fetch(" select * from {$g5['counsel_opt_table']} ");
?>