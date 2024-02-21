<?php
require_once "./_inc/_config.php";

if( $_POST['hand'] == "reg" ) {

		if( $_POST['name_ko']!="" ) {

			$REPLACE_QRY = array();
			$REPLACE_QRY[] = " 	kind       = '".$_POST['kind']."' ";
			$REPLACE_QRY[] = " 	name_ko    = '".$_POST['name_ko']."' ";
			$REPLACE_QRY[] = " 	name_en    = '".$_POST['name_en']."' ";
			$REPLACE_QRY[] = " 	hp         = '".$_POST['hp']."' ";
			$REPLACE_QRY[] = " 	email      = '".$_POST['email']."' ";
			$REPLACE_QRY[] = " 	address1   = '".$_POST['address1']."' "; 
			$REPLACE_QRY[] = " 	address2   = '".$_POST['address2']."' "; 
			$REPLACE_QRY[] = " 	chk1       = '".$_POST['chk1']."' "; 
			$REPLACE_QRY[] = " 	chk2       = '".$_POST['chk2']."' "; 
			$REPLACE_QRY[] = " 	chk3       = '".$_POST['chk3']."' "; 
			$REPLACE_QRY[] = " 	chk4       = '".$_POST['chk4']."' ";
			$REPLACE_QRY[] = " 	chk5       = '".$_POST['chk5']."' "; 
			$REPLACE_QRY[] = " 	chk6       = '".$_POST['chk6']."' "; 
			$REPLACE_QRY[] = " chk7       = '".$_POST['chk7']."' "; 
			$REPLACE_QRY[] = "  reg_date    = '".date("Y-m-d H:i:s")."' ";

			//echo " insert into tbl_iso set ".echoSqlimplodeComma($REPLACE_QRY)." "; 
						
			$Mysql_Base->Query_normal(" insert into tbl_iso set ".echoSqlimplodeComma($REPLACE_QRY)." "); //테이블 명 일치 여부 확인


			$REQ_DATA['idx'] = $Mysql_Base->Get_insert_id();
			$RTN_DATA['msg'] = "데이터가 등록되었습니다.";

		} else {

			$RTN_DATA['msg'] = "입력항목을 확인해주세요.";
			$RTN_DATA['code_no'] = 1002;
			$RTN_DATA['code'] = "ERR";

		}


}


$RTN_DATA['msg'] = "";
$RTN_DATA['code_no'] = 0;
$RTN_DATA['code'] = "OK";
$RTN_DATA['ary_data'] = array(); 

//echo json_encode($RTN_DATA, JSON_UNESCAPED_UNICODE);

echo "Y";

?>
