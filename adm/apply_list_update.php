<?php
$sub_menu = "200120";
include_once('./_common.php');

auth_check($auth, $sub_menu, 'w');

//check_admin_token();

$dir_name	= 'apply';
$act_button	= isset($_POST['act_button'])	? clean_xss_tags(trim($_POST['act_button'])) : '선택삭제';// 버튼으로 안넘어오면 삭제로 간주

$tmp_array = array();
if($w == 'd') {// 건별삭제
	$tmp_array[0] = $ia_no;
} else {
	$tmp_array = (isset($_POST['chk']) && is_array($_POST['chk'])) ? $_POST['chk'] : array();
}

$count = count($tmp_array);


if(!$count)
    alert($act_button." 하실 항목을 하나 이상 체크하세요.");

$msg = '';

if ($act_button == "선택수정") {
	
	for ($i=0; $i<$count; $i++) {
		
		// 실제 번호를 넘김
		$k = isset($_POST['chk'][$i]) ? (int) $_POST['chk'][$i] : 0;
		$post_ia_no			= isset($_POST['ia_no'][$k]) ? (int) $_POST['ia_no'][$k] : 0;		
		$post_standard		= (isset($_POST['standard'][$k]) && $iso_standard_arr[$_POST['standard'][$k]]) ? $_POST['standard'][$k] : '';
		$post_grade			= (isset($_POST['grade'][$k]) && $iso_grade_arr[$_POST['grade'][$k]]) ? $_POST['grade'][$k] : '';
		$post_type			= (isset($_POST['type'][$k]) && $iso_type_arr[$_POST['type'][$k]]) ? $_POST['type'][$k] : '';
		$post_state			= (isset($_POST['state'][$k]) && $iso_state_arr[$_POST['state'][$k]]) ? $_POST['state'][$k] : '';

		$sql = " select * from {$g5['iso_apply_table']} where ia_no = '{$post_ia_no}' ";
		$row = sql_fetch($sql);
		if(!$row['ia_no'])
			continue;
		
		$sql = " update {$g5['iso_apply_table']}
					set standard = '".$post_standard."',
						grade = '".$post_grade."',
						type = '".$post_type."',
						state = '".$post_state."'
					where ia_no = '".$post_ia_no."' ";
		sql_query($sql);		
	}

	$msg = '수정되었습니다.';

} else if ($act_button == "선택삭제") {

    for ($i=0; $i<$count; $i++)
    {
        // 실제 번호를 넘김
        $k = isset($_POST['chk'][$i]) ? (int) $_POST['chk'][$i] : 0;
		
		$post_ia_no	= isset($_POST['ia_no'][$k]) ? (int) $_POST['ia_no'][$k] : (int) $tmp_array[$i];

		$sql = " select * from {$g5['iso_apply_table']} where ia_no = '{$post_ia_no}' ";
		$row = sql_fetch($sql);
		if(!$row['ia_no'])
			continue;
		
		// 첨부파일 삭제
		for($k=1; $k<=1; $k++) {
			@unlink(G5_DATA_PATH.'/'.$dir_name.'/'.clean_relative_paths($row['file'.$k]));
			// 썸네일삭제
			if(preg_match("/\.({$config['cf_image_extension']})$/i", $row['file'.$k])) {
				delete_thumbnail($dir_name, $row['file'.$k]);
			}
		}

		// 글삭제
		sql_query(" delete from {$g5['iso_apply_table']} where ia_no = '{$post_ia_no}' ");
    }
	
	$msg = '삭제되었습니다.';
}

$qstr .= ($qstr ? '&amp;' : '').'s_standard='.$s_standard.'&amp;s_grade='.$s_grade.'&amp;s_type='.$s_type.'&amp;s_state='.$s_state;

alert($msg, './apply_list.php?'.$qstr);
?>