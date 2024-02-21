<?php
if( $_SET['isLogin']['admin'] != 1 && $_SET['Nav']['pagename'] != 'login' ) {
	goUrl( $_SET['Path']['root'].'/login.html' );
}

if( $_SET['isLogin']['admin'] == 1 && $_SET['Nav']['pagename'] == 'login' ) {
	goUrl( $_SET['Path']['root'].'/' );
}

?>