<?php

$_SET['Apath']['sub_path'] = skinPagePath( $_SET['now_page_name'] );
$_SET['Apath']['left_path'] = skinSubMenuPath( $_SET['now_page_name'] );

$_PAGE = Array(
				"top"			=> $_SET['Apath']['skin_common']."/_inc_top.html",
				"top_menu"		=> $_SET['Apath']['skin_common']."/_inc_top_menu.html",
				"left_menu"		=> $_SET['Apath']['skin_common'].$_SET['Apath']['left_path'],
				"contents"		=> $_SET['Apath']['skin_root'].$_SET['Apath']['sub_path'],
				"tail_menu"		=> $_SET['Apath']['skin_common']."/_inc_tail_menu.html",
				"tail"			=> $_SET['Apath']['skin_common']."/_inc_tail.html",
				);

if( isPageCheck() > 0 )
{
	Msg( "HTML 스킨이 없습니다." );
	exit;
}

?>