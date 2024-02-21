<?php
$sub_menu = '300930';
include_once('./_common.php');
include_once(G5_PLUGIN_PATH.'/counsel/config.php');

$write_counsel_table = $csconfig['cf_bo_table']; // 게시판 테이블 전체이름
$bo_table = str_replace($g5['write_prefix'], '', $csconfig['cf_bo_table']);

check_demo();

check_admin_token();

if (!count($_POST['chk'])) {
    alert($_POST['act_button']." 하실 항목을 하나 이상 체크하세요.");
}

if ($_POST['act_button'] == "선택수정") {
    auth_check($auth[$sub_menu], 'w');
} else if ($_POST['act_button'] == "선택삭제") {
    auth_check($auth[$sub_menu], 'd');
} else {
    alert("선택수정이나 선택삭제 작업이 아닙니다.");
}

for ($i=0; $i<count($_POST['chk']); $i++)
{
    $k = $_POST['chk'][$i]; // 실제 번호를 넘김

    if ($_POST['act_button'] == "선택수정")//접수, 상담완료, 취소를 관리자페이지의 "심사원등록관리"에서 설정가능하게 변경함. 2021년8월17일
    {
        $sql = "update {$write_counsel_table}
                   set effect   = '{$_POST['is_score'][$k]}'
                 where wr_id      = '{$_POST['wr_id'][$k]}' ";
        sql_query($sql);
    }
    else if ($_POST['act_button'] == "선택삭제")
    {

		$write = sql_fetch(" select * from {$write_counsel_table} where wr_id = '{$_POST['wr_id'][$k]}' ");

		$sql = " select wr_id, mb_id, wr_is_comment, wr_content from {$write_counsel_table} where wr_parent = '{$write['wr_id']}' order by wr_id ";
		$result = sql_query($sql);
		while ($row = sql_fetch_array($result))
		{
			// 원글이라면
			if (!$row['wr_is_comment'])
			{
				// 원글 포인트 삭제
				if (!delete_point($row['mb_id'], $bo_table, $row['wr_id'], '쓰기'))
					insert_point($row['mb_id'], $board['bo_write_point'] * (-1), "{$board['bo_subject']} {$row['wr_id']} 글 삭제");

				// 업로드된 파일이 있다면
				$sql2 = " select * from {$g5['board_file_table']} where bo_table = '{$bo_table}' and wr_id = '{$row['wr_id']}' ";
				$result2 = sql_query($sql2);
				while ($row2 = sql_fetch_array($result2)) {
					// 파일삭제
					@unlink(G5_DATA_PATH.'/file/'.$bo_table.'/'.$row2['bf_file']);

					// 썸네일삭제
					if(preg_match("/\.({$config['cf_image_extension']})$/i", $row2['bf_file'])) {
						delete_board_thumbnail($bo_table, $row2['bf_file']);
					}
				}

				// 에디터 썸네일 삭제
				delete_editor_thumbnail($row['wr_content']);

				// 파일테이블 행 삭제
				sql_query(" delete from {$g5['board_file_table']} where bo_table = '{$bo_table}' and wr_id = '{$row['wr_id']}' ");

				$count_write++;
			}
			else
			{
				// 코멘트 포인트 삭제
				if (!delete_point($row['mb_id'], $bo_table, $row['wr_id'], '댓글'))
					insert_point($row['mb_id'], $board['bo_comment_point'] * (-1), "{$board['bo_subject']} {$write['wr_id']}-{$row['wr_id']} 댓글삭제");

				$count_comment++;
			}
		}

        $sql = "delete from {$write_counsel_table} where wr_id = '{$_POST['wr_id'][$k]}' ";
        sql_query($sql);

		// 게시글 삭제
		sql_query(" delete from {$write_counsel_table} where wr_parent = '{$write['wr_id']}' ");

		// 최근게시물 삭제
		sql_query(" delete from {$g5['board_new_table']} where bo_table = '{$bo_table}' and wr_parent = '{$write['wr_id']}' ");

		// 스크랩 삭제
		sql_query(" delete from {$g5['scrap_table']} where bo_table = '{$bo_table}' and wr_id = '{$write['wr_id']}' ");

    }

}

// 글숫자 감소
if ($count_write > 0 || $count_comment > 0)
    sql_query(" update {$g5['board_table']} set bo_count_write = bo_count_write - '$count_write', bo_count_comment = bo_count_comment - '$count_comment' where bo_table = '{$bo_table}' ");


goto_url("./counsel_list.php?sca=$sca&amp;sst=$sst&amp;sod=$sod&amp;sfl=$sfl&amp;stx=$stx&amp;page=$page");
?>
