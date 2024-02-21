<?php
$DBHost_Base = "localhost";
$DBUser_Base = "engmovEdu";
$DBPass_Base = "8010@info";
$DBSele_Base = "wioz_kr_eng";


$DBUser = $DBUser_Base;
$DBPass = $DBPass_Base;

$Mysql_Base = new DataBase;
$Mysql_Base->DB_Host = $DBHost_Base;
$Mysql_Base->DB_User = $DBUser_Base;
$Mysql_Base->DB_Pass = $DBPass_Base;
$Mysql_Base->DB_Sele = $DBSele_Base;
$Mysql_Base->Conn();

?>
