<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if($csconfig['cf_counsel']){

	$addre	= $_POST['Nzip']."|".$_POST['Naddre1']."|".$_POST['Naddre2']."|".$_POST['Naddre3']."|".$_POST['Naddre_jibeon'];
	$tel	= $_POST['Ntel'];
	$hphone = $_POST['Nhphone'];

	$oaddre = $_POST['Nozip']."|".$_POST['Noaddre1']."|".$_POST['Noaddre2']."|".$_POST['Noaddre3']."|".$_POST['Noaddre_jibeon'];
	$otel	= $_POST['Notel'];

	$fax	= $_POST['Nfax'];
	$ename	= $_POST['Nename'];
	$sex	= $_POST['Nsex'];
	$birth	= $_POST['Nyear'].'-'.$_POST['Nmonth'].'-'.$_POST['Nday'];
	$merry	= $_POST['Nmerry'];

	$grade	= $_POST['Ngrade'];
	$bizno	= $_POST['Nbizno'];
	$job	= $_POST['Njob'];
	$duty	= $_POST['Nduty'];
	$likes	= $_POST['Nlikes'];
	$emailok = $_POST['Nemailok'];
	$rcid	= $_POST['Nrcid'];

	//input1,input2,input3,input4,input5,
	$input1 = $_POST['Ninput1'];
	$input2 = $_POST['Ninput2'];
	$input3 = $_POST['Ninput3'];
	$input4 = $_POST['Ninput4'];
	$input5 = $_POST['Ninput5'];
	$input6 = $_POST['Ninput6'];
	$input7 = $_POST['Ninput7'];
	$input8 = $_POST['Ninput8'];
	$input9 = $_POST['Ninput9'];
	$input10 = $_POST['Ninput10'];

	//select1,select2,select3,select4,select5,
	$select1 = $_POST['Nselect1'];
	$select2 = $_POST['Nselect2'];
	$select3 = $_POST['Nselect3'];
	$select4 = $_POST['Nselect4'];
	$select5 = $_POST['Nselect5'];
	$select6 = $_POST['Nselect6'];
	$select7 = $_POST['Nselect7'];
	$select8 = $_POST['Nselect8'];
	$select9 = $_POST['Nselect9'];
	$select10 = $_POST['Nselect10'];

	//radio1,radio2,radio3,radio4,radio5,
	$radio1 = $_POST['Nradio1'];
	$radio2 = $_POST['Nradio2'];
	$radio3 = $_POST['Nradio3'];
	$radio4 = $_POST['Nradio4'];
	$radio5 = $_POST['Nradio5'];
	$radio6 = $_POST['Nradio6'];
	$radio7 = $_POST['Nradio7'];
	$radio8 = $_POST['Nradio8'];
	$radio9 = $_POST['Nradio9'];
	$radio10 = $_POST['Nradio10'];
    $radio11 = $_POST['Nradio11'];
    $radio12 = $_POST['Nradio12'];

	//check1,check2,check3,check4,check5,
	for ($s=0 ; $s<=sizeof($_POST['Ncheck1']); $s++){
		$check1 .= ($s)?"|":"";
		$check1 .= $Ncheck1[$s];
	}
	for ($s=0 ; $s<=sizeof($_POST['Ncheck2']); $s++){
		$check2 .= ($s)?"|":"";
		$check2 .= $Ncheck2[$s];
	}
	for ($s=0 ; $s<=sizeof($_POST['Ncheck3']); $s++){
		$check3 .= ($s)?"|":"";
		$check3 .= $Ncheck3[$s];
	}
	for ($s=0 ; $s<=sizeof($_POST['Ncheck4']); $s++){
		$check4 .= ($s)?"|":"";
		$check4 .= $Ncheck4[$s];
	}
	for ($s=0 ; $s<=sizeof($_POST['Ncheck5']); $s++){
		$check5 .= ($s)?"|":"";
		$check5 .= $Ncheck5[$s];
	}
	for ($s=0 ; $s<=sizeof($_POST['Ncheck6']); $s++){
		$check6 .= ($s)?"|":"";
		$check6 .= $Ncheck6[$s];
	}
	for ($s=0 ; $s<=sizeof($_POST['Ncheck7']); $s++){
		$check7 .= ($s)?"|":"";
		$check7 .= $Ncheck7[$s];
	}
	for ($s=0 ; $s<=sizeof($_POST['Ncheck8']); $s++){
		$check8 .= ($s)?"|":"";
		$check8 .= $Ncheck8[$s];
	}
	for ($s=0 ; $s<=sizeof($_POST['Ncheck9']); $s++){
		$check9 .= ($s)?"|":"";
		$check9 .= $Ncheck9[$s];
	}
	for ($s=0 ; $s<=sizeof($_POST['Ncheck10']); $s++){
		$check10 .= ($s)?"|":"";
		$check10 .= $Ncheck10[$s];
	}

	// txt1,txt2,txt3
	$txt1 = '';
	if (isset($_POST['Ntxt1'])) {
		$txt1 = substr(trim($_POST['Ntxt1']),0,65536);
		$txt1 = preg_replace("#[\\\]+$#", "", $txt1);
	}

	$txt2 = '';
	if (isset($_POST['Ntxt2'])) {
		$txt2 = substr(trim($_POST['Ntxt2']),0,65536);
		$txt2 = preg_replace("#[\\\]+$#", "", $txt2);
	}

	$txt3 = '';
	if (isset($_POST['Ntxt3'])) {
		$txt3 = substr(trim($_POST['Ntxt3']),0,65536);
		$txt3 = preg_replace("#[\\\]+$#", "", $txt3);
	}

	$txt4 = '';
	if (isset($_POST['Ntxt4'])) {
		$txt4 = substr(trim($_POST['Ntxt4']),0,65536);
		$txt4 = preg_replace("#[\\\]+$#", "", $txt4);
	}

	$txt5 = '';
	if (isset($_POST['Ntxt5'])) {
		$txt5 = substr(trim($_POST['Ntxt5']),0,65536);
		$txt5 = preg_replace("#[\\\]+$#", "", $txt5);
	}

	if($csconfig['cf_remail'] && $csconfig['cf_admin_email'] && $w == ''){

		// 심사원등록메일 관리자에게 발송

		include_once(G5_LIB_PATH.'/mailer.lib.php');

		$subject = '['.$wr_subject.'] '.$wr_name.'님 심사원등록 메일입니다.';

		ob_start();
		include_once ($board_skin_path.'/write_mail.skin.php');
		$content = ob_get_contents();
		ob_end_clean();

		mailer($wr_name, $wr_email, $csconfig['cf_admin_email'], $subject, $content, 1);

	}

	$sql1  = " update $write_table set
		addre = '$addre', tel = '$tel', hphone = '$hphone', oaddre = '$oaddre', otel = '$otel',
		fax = '$fax', ename = '$ename', sex = '$sex', birth = '$birth', merry = '$merry',
		grade = '$grade', bizno = '$bizno', job = '$job', duty = '$duty', likes = '$likes', emailok = '$emailok', rcid = '$rcid',
		input1 = '$input1', input2 = '$input2', input3 = '$input3', input4 = '$input4', input5 = '$input5',
		input6 = '$input6', input7 = '$input7', input8 = '$input8', input9 = '$input9', input10 = '$input10',
		select1 = '$select1', select2 = '$select2', select3 = '$select3', select4 = '$select4', select5 = '$select5',
		select6 = '$select6', select7 = '$select7', select8 = '$select8', select9 = '$select9', select10 = '$select10',
		radio1 = '$radio1', radio2 = '$radio2', radio3 = '$radio3', radio4 = '$radio4', radio5 = '$radio5',
		radio6 = '$radio6', radio7 = '$radio7', radio8 = '$radio8', radio9 = '$radio9', radio10 = '$radio10', radio11 = '$radio11', radio12 = '$radio12',
		check1 = '$check1', check2 = '$check2', check3 = '$check3', check4 = '$check4', check5 = '$check5',
		check6 = '$check6', check7 = '$check7', check8 = '$check8', check9 = '$check9', check10 = '$check10',
		txt1 = '$txt1', txt2 = '$txt2', txt3 = '$txt3', txt4 = '$txt4', txt5 = '$txt5', effect = '$effect' where wr_id = '$wr_id' ";

	if(sql_query($sql1)){


		if($w == ''){
			$csconfig['cf_okmsg'] = ($csconfig['cf_okmsg'])?$csconfig['cf_okmsg']:'정상적으로 접수되었습니다.';

			if($csconfig['cf_callback_url']) alert($csconfig['cf_okmsg'],$csconfig['cf_callback_url']);
			else alert($csconfig['cf_okmsg'],"./write.php?bo_table=".$bo_table);
		}


	}
}

?>