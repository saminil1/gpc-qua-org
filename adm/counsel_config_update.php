<?php
$sub_menu = "300900";
include_once('./_common.php');

check_demo();

auth_check($auth[$sub_menu], 'w');

if ($is_admin != 'super')
    alert('최고관리자만 접근 가능합니다.');

if($_POST['cf_bo_table'] && $_POST['cf_counsel']){

	//게시판 칼럼추가
    sql_query(" ALTER TABLE `{$cf_bo_table}`
		ADD `addre` varchar(255) NOT NULL DEFAULT '' AFTER `wr_10` ,
		ADD `tel` varchar(20) NOT NULL DEFAULT '' AFTER `addre` ,
		ADD `hphone` varchar(20) NOT NULL DEFAULT '' AFTER `tel` ,
		ADD `oaddre` varchar(255) NOT NULL DEFAULT '' AFTER `hphone` ,
		ADD `otel` varchar(20) NOT NULL DEFAULT '' AFTER `oaddre` ,
		ADD `fax` varchar(20) NOT NULL DEFAULT '' AFTER `otel` ,
		ADD `ename` varchar(50) NOT NULL DEFAULT '' AFTER `fax` ,
		ADD `sex` char(1) DEFAULT '2' AFTER `ename` ,
		ADD `birth` varchar(20) NOT NULL DEFAULT '' AFTER `sex` ,
		ADD `merry` varchar(10) NOT NULL DEFAULT '' AFTER `birth` ,
		ADD `grade` varchar(20) NOT NULL DEFAULT '' AFTER `merry` ,
		ADD `bizno` varchar(15) NOT NULL DEFAULT '' AFTER `grade` ,
		ADD `job` varchar(30) NOT NULL DEFAULT '' AFTER `bizno` ,
		ADD `duty` varchar(30) NOT NULL DEFAULT '' AFTER `job` ,
		ADD `likes` varchar(50) NOT NULL DEFAULT '' AFTER `duty` ,
		ADD `emailok` char(1) DEFAULT '0' AFTER `likes` ,
		ADD `rcid` varchar(20) NOT NULL DEFAULT '' AFTER `emailok` ,
		ADD `input1` varchar(100) NOT NULL DEFAULT '' AFTER `rcid` ,
		ADD `input2` varchar(100) NOT NULL DEFAULT '' AFTER `input1` ,
		ADD `input3` varchar(100) NOT NULL DEFAULT '' AFTER `input2` ,
		ADD `input4` varchar(100) NOT NULL DEFAULT '' AFTER `input3` ,
		ADD `input5` varchar(100) NOT NULL DEFAULT '' AFTER `input4` ,
		ADD `input6` varchar(100) NOT NULL DEFAULT '' AFTER `input5` ,
		ADD `input7` varchar(100) NOT NULL DEFAULT '' AFTER `input6` ,
		ADD `input8` varchar(100) NOT NULL DEFAULT '' AFTER `input7` ,
		ADD `input9` varchar(100) NOT NULL DEFAULT '' AFTER `input8` ,
		ADD `input10` varchar(100) NOT NULL DEFAULT '' AFTER `input9` ,
		ADD `select1` varchar(100) NOT NULL DEFAULT '' AFTER `input10` ,
		ADD `select2` varchar(100) NOT NULL DEFAULT '' AFTER `select1` ,
		ADD `select3` varchar(100) NOT NULL DEFAULT '' AFTER `select2` ,
		ADD `select4` varchar(100) NOT NULL DEFAULT '' AFTER `select3` ,
		ADD `select5` varchar(100) NOT NULL DEFAULT '' AFTER `select4` ,
		ADD `select6` varchar(100) NOT NULL DEFAULT '' AFTER `select5` ,
		ADD `select7` varchar(100) NOT NULL DEFAULT '' AFTER `select6` ,
		ADD `select8` varchar(100) NOT NULL DEFAULT '' AFTER `select7` ,
		ADD `select9` varchar(100) NOT NULL DEFAULT '' AFTER `select8` ,
		ADD `select10` varchar(100) NOT NULL DEFAULT '' AFTER `select9` ,
		ADD `radio1` varchar(100) NOT NULL DEFAULT '' AFTER `select10` ,
		ADD `radio2` varchar(100) NOT NULL DEFAULT '' AFTER `radio1` ,
		ADD `radio3` varchar(100) NOT NULL DEFAULT '' AFTER `radio2` ,
		ADD `radio4` varchar(100) NOT NULL DEFAULT '' AFTER `radio3` ,
		ADD `radio5` varchar(100) NOT NULL DEFAULT '' AFTER `radio4` ,
		ADD `radio6` varchar(100) NOT NULL DEFAULT '' AFTER `radio5` ,
		ADD `radio7` varchar(100) NOT NULL DEFAULT '' AFTER `radio6` ,
		ADD `radio8` varchar(100) NOT NULL DEFAULT '' AFTER `radio7` ,
		ADD `radio9` varchar(100) NOT NULL DEFAULT '' AFTER `radio8` ,
		ADD `radio10` varchar(100) NOT NULL DEFAULT '' AFTER `radio9` ,
        ADD `radio11` varchar(100) NOT NULL DEFAULT '' AFTER `radio10` ,
        ADD `radio12` varchar(100) NOT NULL DEFAULT '' AFTER `radio11` ,
		ADD `check1` varchar(100) NOT NULL DEFAULT '' AFTER `radio12` ,
		ADD `check2` varchar(100) NOT NULL DEFAULT '' AFTER `check1` ,
		ADD `check3` varchar(100) NOT NULL DEFAULT '' AFTER `check2` ,
		ADD `check4` varchar(100) NOT NULL DEFAULT '' AFTER `check3` ,
		ADD `check5` varchar(100) NOT NULL DEFAULT '' AFTER `check4` ,
		ADD `check6` varchar(100) NOT NULL DEFAULT '' AFTER `check5` ,
		ADD `check7` varchar(100) NOT NULL DEFAULT '' AFTER `check6` ,
		ADD `check8` varchar(100) NOT NULL DEFAULT '' AFTER `check7` ,
		ADD `check9` varchar(100) NOT NULL DEFAULT '' AFTER `check8` ,
		ADD `check10` varchar(100) NOT NULL DEFAULT '' AFTER `check9` ,
		ADD `txt1` text NOT NULL AFTER `check10` ,
		ADD `txt2` text NOT NULL AFTER `txt1` ,
		ADD `txt3` text NOT NULL AFTER `txt2` ,
		ADD `txt4` text NOT NULL AFTER `txt3` ,
		ADD `txt5` text NOT NULL AFTER `txt4` ,
		ADD `effect` tinyint(4) NOT NULL DEFAULT '0' AFTER `txt5` ", false);

	$sql = " CREATE TABLE IF NOT EXISTS {$g5['counsel_opt_table']} (
			  `num` int(11) NOT NULL AUTO_INCREMENT,
			  `cf_bo_table` varchar(20) DEFAULT NULL,
			  `cf_counsel` char(1) DEFAULT '0',
			  `cf_callback_url` varchar(50) DEFAULT NULL,
			  `cf_okmsg` varchar(50) DEFAULT NULL,
			  `cf_remail` char(1) DEFAULT '0',
			  `cf_admin_email` varchar(50) DEFAULT NULL,
			  `cf_txt_editor` char(1) DEFAULT '0',
			  `cf_agree` char(1) DEFAULT '0',
			  `cf_stipulation` text,
			  `cf_effect` char(1) DEFAULT '0',
			  `cf_subject` char(1) DEFAULT '0',
			  `cf_link` char(1) DEFAULT '0',
			  `cf_files` char(1) DEFAULT '0',
			  `sex` char(1) DEFAULT '2',
			  `addre` char(1) DEFAULT '2',
			  `tel` char(1) DEFAULT '2',
			  `oaddre` char(1) DEFAULT '1',
			  `otel` char(1) DEFAULT '1',
			  `hphone` char(1) DEFAULT '1',
			  `fax` char(1) DEFAULT '1',
			  `ename` char(1) DEFAULT '1',
			  `birth` char(1) DEFAULT '1',
			  `merry` char(1) DEFAULT '1',
			  `grade` char(1) DEFAULT '1',
			  `bizno` char(1) DEFAULT '1',
			  `job` char(1) DEFAULT '1',
			  `duty` char(1) DEFAULT '1',
			  `likes` char(1) DEFAULT '1',
			  `emailok` char(1) DEFAULT '1',
			  `rcid` char(1) DEFAULT '1',
			  `input1` char(1) DEFAULT '0',
			  `input2` char(1) DEFAULT '0',
			  `input3` char(1) DEFAULT '0',
			  `input4` char(1) DEFAULT '0',
			  `input5` char(1) DEFAULT '0',
			  `input6` char(1) DEFAULT '0',
			  `input7` char(1) DEFAULT '0',
			  `input8` char(1) DEFAULT '0',
			  `input9` char(1) DEFAULT '0',
			  `input10` char(1) DEFAULT '0',
			  `select1` char(1) DEFAULT '0',
			  `select2` char(1) DEFAULT '0',
			  `select3` char(1) DEFAULT '0',
			  `select4` char(1) DEFAULT '0',
			  `select5` char(1) DEFAULT '0',
			  `select6` char(1) DEFAULT '0',
			  `select7` char(1) DEFAULT '0',
			  `select8` char(1) DEFAULT '0',
			  `select9` char(1) DEFAULT '0',
			  `select10` char(1) DEFAULT '0',
			  `radio1` char(1) DEFAULT '0',
			  `radio2` char(1) DEFAULT '0',
			  `radio3` char(1) DEFAULT '0',
			  `radio4` char(1) DEFAULT '0',
			  `radio5` char(1) DEFAULT '0',
			  `radio6` char(1) DEFAULT '0',
			  `radio7` char(1) DEFAULT '0',
			  `radio8` char(1) DEFAULT '0',
			  `radio9` char(1) DEFAULT '0',
			  `radio10` char(1) DEFAULT '0',
              `radio11` char(1) DEFAULT '0',
              `radio12` char(1) DEFAULT '0',
			  `check1` char(1) DEFAULT '0',
			  `check2` char(1) DEFAULT '0',
			  `check3` char(1) DEFAULT '0',
			  `check4` char(1) DEFAULT '0',
			  `check5` char(1) DEFAULT '0',
			  `check6` char(1) DEFAULT '0',
			  `check7` char(1) DEFAULT '0',
			  `check8` char(1) DEFAULT '0',
			  `check9` char(1) DEFAULT '0',
			  `check10` char(1) DEFAULT '0',
			  `txt1` char(1) DEFAULT '0',
			  `txt2` char(1) DEFAULT '0',
			  `txt3` char(1) DEFAULT '0',
			  `txt4` char(1) DEFAULT '0',
			  `txt5` char(1) DEFAULT '0',
			  PRIMARY KEY (`num`)
			) ENGINE=MyISAM DEFAULT CHARSET=utf8; ";
	sql_query($sql, false);

	$sql = " INSERT INTO {$g5['counsel_opt_table']} set num='1', cf_bo_table='$cf_bo_table', cf_counsel='$cf_counsel', cf_callback_url='', cf_okmsg='', cf_remail='0', cf_admin_email='', cf_txt_editor='0', cf_agree='0', cf_stipulation='', cf_effect='0', cf_subject='0', cf_link='0', cf_files='0', sex='1', addre='2', tel='2', oaddre='1', otel='1', hphone='1', fax='1',
			ename='1', birth='1', merry='1', grade='1', bizno='1', job='1', duty='1', likes='1', emailok='1', rcid='1',
			input1='1', input2='0', input3='0', input4='0', input5='0', input6='0', input7='0', input8='0', input9='0', input10='0',
			select1='1', select2='0', select3='0', select4='0', select5='0', select6='0', select7='0', select8='0', select9='0', select10='0',
			radio1='1', radio2='0', radio3='0', radio4='0', radio5='0', radio6='0', radio7='0', radio8='0', radio9='0', radio10='0', radio11='0', radio12='0',
			check1='1', check2='0', check3='0', check4='0', check5='0', check6='0', check7='0', check8='0', check9='0', check10='0',
			txt1='1', txt2='0', txt3='0', txt4='0', txt5='0'";
    sql_query($sql, false);

	$sql = " CREATE TABLE IF NOT EXISTS {$g5['counsel_item_table']} (
			  `num` int(11) NOT NULL AUTO_INCREMENT,
			  `mno` int(11) NOT NULL DEFAULT '0',
			  `icode` varchar(10) DEFAULT NULL,
			  `iname` varchar(50) DEFAULT NULL,
			  `size` char(3) DEFAULT NULL,
			  `size2` char(3) DEFAULT NULL,
			  `type` char(2) DEFAULT NULL,
			  `bigo` varchar(254) DEFAULT NULL,
			  `it1` varchar(50) DEFAULT NULL,
			  `it2` varchar(50) DEFAULT NULL,
			  `it3` varchar(50) DEFAULT NULL,
			  `it4` varchar(50) DEFAULT NULL,
			  `it5` varchar(50) DEFAULT NULL,
			  `it6` varchar(50) DEFAULT NULL,
			  `it7` varchar(50) DEFAULT NULL,
			  `it8` varchar(50) DEFAULT NULL,
			  `it9` varchar(50) DEFAULT NULL,
			  `it10` varchar(50) DEFAULT NULL,
			  `it11` varchar(50) DEFAULT NULL,
			  `it12` varchar(50) DEFAULT NULL,
			  `it13` varchar(50) DEFAULT NULL,
			  `it14` varchar(50) DEFAULT NULL,
			  `it15` varchar(50) DEFAULT NULL,
			  `it16` varchar(50) DEFAULT NULL,
			  `it17` varchar(50) DEFAULT NULL,
			  `it18` varchar(50) DEFAULT NULL,
			  `it19` varchar(50) DEFAULT NULL,
			  `it20` varchar(50) DEFAULT NULL,
			  `it21` varchar(50) DEFAULT NULL,
			  `it22` varchar(50) DEFAULT NULL,
			  `it23` varchar(50) DEFAULT NULL,
			  `it24` varchar(50) DEFAULT NULL,
			  `it25` varchar(50) DEFAULT NULL,
			  `it26` varchar(50) DEFAULT NULL,
			  `it27` varchar(50) DEFAULT NULL,
			  `it28` varchar(50) DEFAULT NULL,
			  `it29` varchar(50) DEFAULT NULL,
			  `it30` varchar(50) DEFAULT NULL,
			  PRIMARY KEY (`num`)
			) ENGINE=MyISAM DEFAULT CHARSET=utf8; ";
	sql_query($sql, false);

	sql_query(" INSERT INTO {$g5['counsel_item_table']} set num = '1', mno = '1', icode = 'ename', iname = '영문이름', size = '30', type = '11' ", false);
	sql_query(" INSERT INTO {$g5['counsel_item_table']} set num = '2', mno = '2', icode = 'tel', iname = '전화번호', size = '30', type = '12' ", false);
	sql_query(" INSERT INTO {$g5['counsel_item_table']} set num = '3', mno = '3', icode = 'hphone', iname = '휴대폰번호', size = '30', type = '14' ", false);
	sql_query(" INSERT INTO {$g5['counsel_item_table']} set num = '4', mno = '4', icode = 'addre', iname = '주소', size = '60', type = '17' ", false);
	sql_query(" INSERT INTO {$g5['counsel_item_table']} set num = '5', mno = '5', icode = 'otel', iname = '직장전화번호', size = '30', type = '13' ", false);
	sql_query(" INSERT INTO {$g5['counsel_item_table']} set num = '6', mno = '6', icode = 'fax', iname = 'FAX', size = '30', type = '19' ", false);
	sql_query(" INSERT INTO {$g5['counsel_item_table']} set num = '7', mno = '7', icode = 'oaddre', iname = '직장주소', size = '60', type = '18' ", false);
	sql_query(" INSERT INTO {$g5['counsel_item_table']} set num = '8', mno = '8', icode = 'bizno', iname = '심사원등록번호', size = '30', type = '16' ", false);
	sql_query(" INSERT INTO {$g5['counsel_item_table']} set num = '9', mno = '9', icode = 'rcid', iname = '추천인아이디', size = '30', type = '15' ", false);
	sql_query(" INSERT INTO {$g5['counsel_item_table']} set num = '10', mno = '10', icode = 'grade', iname = '최종학력', size = '2', type = '2', it1 = '학력1', it2 = '학력2', it3 = '학력3' ", false);
	sql_query(" INSERT INTO {$g5['counsel_item_table']} set num = '11', mno = '11', icode = 'job', iname = '직업', size = '2', type = '2', it1 = '직업1', it2 = '직업2', it3 = '직업3' ", false);
	sql_query(" INSERT INTO {$g5['counsel_item_table']} set num = '12', mno = '12', icode = 'duty', iname = '직종', size = '2', type = '2', it1 = '직종1', it2 = '직종2', it3 = '직종3' ", false);
	sql_query(" INSERT INTO {$g5['counsel_item_table']} set num = '13', mno = '13', icode = 'likes', iname = '관심영역', size = '2', type = '2', it1 = '관심영역1', it2 = '관심영역2', it3 = '관심영역3' ", false);
	sql_query(" INSERT INTO {$g5['counsel_item_table']} set num = '14', mno = '14', icode = 'birth', iname = '생년월일', size = '6', type = '21' ", false);
	sql_query(" INSERT INTO {$g5['counsel_item_table']} set num = '15', mno = '15', icode = 'emailok', iname = '메일수신여부', size = '6', type = '41' ", false);
	sql_query(" INSERT INTO {$g5['counsel_item_table']} set num = '16', mno = '16', icode = 'merry', iname = '결혼여부', size = '6', type = '32' ", false);
	sql_query(" INSERT INTO {$g5['counsel_item_table']} set num = '17', mno = '17', icode = 'sex', iname = '성별', size = '6', type = '31' ", false);
	sql_query(" INSERT INTO {$g5['counsel_item_table']} set num = '18', mno = '18', icode = 'input1', iname = '입력형1', size = '30', type = '1' ", false);
	sql_query(" INSERT INTO {$g5['counsel_item_table']} set num = '23', mno = '23', icode = 'select1', iname = '선택형1', size = '2', type = '2', it1 = '옵션1', it2 = '옵션2', it3 = '옵션3' ", false);
	sql_query(" INSERT INTO {$g5['counsel_item_table']} set num = '28', mno = '28', icode = 'radio1', iname = '라디오박스형1', size = '10', type = '3', it1 = '옵션1', it2 = '옵션2', it3 = '옵션3' ", false);
	sql_query(" INSERT INTO {$g5['counsel_item_table']} set num = '33', mno = '33', icode = 'check1', iname = '체크박스형1', size = '10', type = '4', it1 = '옵션1', it2 = '옵션2', it3 = '옵션3' ", false);
	sql_query(" INSERT INTO {$g5['counsel_item_table']} set num = '38', mno = '38', icode = 'txt1', iname = '긴문장입력형1', size = '10', size2 = '5', type = '5' ", false);

}else{

	sql_query(" ALTER TABLE `{$cf_bo_table}`
		DROP `addre`, DROP `tel`, DROP `hphone`, DROP `oaddre`, DROP `otel`, DROP `fax`,
		DROP `ename`, DROP `sex`, DROP `birth`, DROP `merry`, DROP `grade`, DROP `bizno`,
		DROP `job`, DROP `duty`, DROP `likes`, DROP `emailok`, DROP `rcid` ,
		DROP `input1`, DROP `input2`, DROP `input3`, DROP `input4`, DROP `input5` ,
		DROP `input6`, DROP `input7`, DROP `input8`, DROP `input9`, DROP `input10` ,
		DROP `select1`, DROP `select2`, DROP `select3`, DROP `select4`, DROP `select5` ,
		DROP `select6`, DROP `select7`, DROP `select8`, DROP `select9`, DROP `select10` ,
		DROP `radio1`, DROP `radio2`, DROP `radio3`, DROP `radio4`, DROP `radio5` ,
		DROP `radio6`, DROP `radio7`, DROP `radio8`, DROP `radio9`, DROP `radio10`, DROP `radio11`, DROP `radio12`,
		DROP `check1`, DROP `check2`, DROP `check3`, DROP `check4`, DROP `check5`,
		DROP `check6`, DROP `check7`, DROP `check8`, DROP `check9`, DROP `check10`,
		DROP `txt1`, DROP `txt2`, DROP `txt3`, DROP `txt4`, DROP `txt3`, DROP `effect` ", false);
	sql_query(" DROP TABLE IF EXISTS {$g5['counsel_opt_table']} ", false);
	sql_query(" DROP TABLE IF EXISTS {$g5['counsel_item_table']} ", false);

}

$sql = " update {$g5['counsel_opt_table']}
            set cf_bo_table='$cf_bo_table',
			cf_counsel='$cf_counsel',
			cf_callback_url='$cf_callback_url',
			cf_okmsg='$cf_okmsg',
			cf_remail='$cf_remail',
			cf_admin_email='$cf_admin_email',
			cf_txt_editor='$cf_txt_editor',
			cf_agree='$cf_agree',
			cf_stipulation='$cf_stipulation',
			cf_effect='$cf_effect',
			cf_subject='$cf_subject',
			cf_link='$cf_link',
			cf_files='$cf_files' ";
sql_query($sql);


goto_url('./counsel_config.php', false);
?>