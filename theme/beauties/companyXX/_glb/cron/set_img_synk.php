#!/usr/local/php/bin/php -q
<?php
//		Ver 1.0.0.1
//		Neo....

//error_reporting(E_ALL);
//ini_set('error_reporting', 'E_ALL');
//ini_set('display_errors', 1);

$n2_data['Fname'] = basename(__FILE__);
$n2_data['fullpath'] = realpath(__FILE__);
$n2_data['whr'] = preg_replace( "/".$n2_data['Fname']."/", "", $n2_data['fullpath'] );

if( substr( $n2_data['whr'], -1 ) == "/" )
	$n2_data['whr'] = substr( $n2_data['whr'], 0, -1 );
$n2_data['whr'] = substr( $n2_data['whr'], 0, strrpos( $n2_data['whr'], "/" ) )."/";

define('__DEBUG', 1); //	디버그 모드..



function Write_log_out( $c_MSG, $i_auc_no = 0 ) {

	if( __DEBUG ) echo $c_MSG."\n";

}


Write_log_out("==============================================" );
Write_log_out("               Synk start             " );
Write_log_out("==============================================" );

Write_log_out( $n2_data['whr'] );


include_once $n2_data['whr']."_lib/FtpClient/FtpClient.php";
include_once $n2_data['whr']."_lib/FtpClient/FtpException.php";
include_once $n2_data['whr']."_lib/FtpClient/FtpWrapper.php";


$ftp = new \FtpClient\FtpClient();

$ftp->connect("115.41.238.2");
$ftp->login("autoup", "kspsoft!999");

$d = dir( $n2_data['whr']."data/work/");
while (false !== ($entry = $d->read())) {

	if( strlen( $entry ) == 17 ) {
		$c_year = substr($entry, 0, 4 );
		$c_month = substr($entry, 4, 2 );

		$c_tmp_file = $n2_data['whr']."data/work/".$entry;
		$c_mov_file = $n2_data['whr']."data/work_mov/".$entry;

		if( file_exists( $c_tmp_file ) ) {
			if( rename($c_tmp_file, $c_mov_file) ) {
				Write_log_out( " move ok --- " );
				$c_tar_path = '/image_server/fileSave/InstallPicture/'.$c_year;
				$rtn = $ftp->mkdir($c_tar_path);

				//$c_tar_path .= '/'.$c_month."_b";
				$c_tar_path .= '/'.$c_month;
				$rtn = $ftp->mkdir($c_tar_path);

				//Write_log_out( $c_tar_path.'/tmp_'.$entry );
				//$ftp->put($c_tar_path.'/tmp_'.$entry, $c_mov_file, FTP_BINARY );
				$ftp->put($c_tar_path.'/InstallPicture_'.$entry, $c_mov_file, FTP_BINARY );
				@$ftp->chmod(0777, $c_tar_path.'/InstallPicture_'.$entry); //퍼미션..

				@unlink( $c_mov_file );
				// 임시폴더에 있는 것을 삭제한다.
			} else {
				Write_log_out( " move fail --- " );
			}
		}
		echo $entry." >> ".$c_year." >> ".$c_month."\n";
	}
}
$d->close();






Write_log_out("====================================" );
Write_log_out("             Synk End             " );
Write_log_out("====================================" );


exit;


?>
