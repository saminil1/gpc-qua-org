<?php
$sub_menu = '300930';
include_once('./_common.php');

auth_check($auth[$sub_menu], "r");

$g5['title'] = '상담관리';
include_once (G5_ADMIN_PATH.'/admin.head.php');

if(!$csconfig['cf_bo_table']){
	alert("완라인 환경설정 > 환경설정 > 게시판명을 입력하세요.", "counsel_config.php");
}

$is_category = false;
$category_option = '';
if ($board['bo_use_category']) {
    $category_option = get_category_option($bo_table, $sca);
    $is_category = true;
}

$where = " where ";
$sql_search = "";
if ($stx != "") {
    if ($sfl != "") {
        $sql_search .= " $where $sfl like '%$stx%' ";
        $where = " and ";
    }
    if ($save_stx != $stx)
        $page = 1;
}

if(!$sst)
    $sst  = "wr_num, wr_reply";

if ($sst) {
    $sql_order = " order by {$sst} {$sod} ";
}

if ($sca != "") {
    $sql_search .= " and ca_id like '$sca%' ";
}

$sql_common = "  from {$csconfig['cf_bo_table']} ";
$sql_common .= $sql_search;

// 테이블의 전체 레코드수만 얻음
$sql = " select count(*) as cnt " . $sql_common;
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql  = " select *
          $sql_common
          {$sql_order}
          limit $from_record, $rows ";
$result = sql_query($sql);

//$qstr = 'page='.$page.'&amp;sst='.$sst.'&amp;sod='.$sod.'&amp;stx='.$stx;
$qstr .= ($qstr ? '&amp;' : '').'sca='.$sca.'&amp;save_stx='.$stx;

$listall = '<a href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall">전체목록</a>';
?>

<div class="local_ov01 local_ov">
    <?php echo $listall; ?>
    전체 내역 <?php echo $total_count; ?>건<?php echo $url22;?>
</div>

<form name="flist" class="local_sch01 local_sch">
<input type="hidden" name="page" value="<?php echo $page; ?>">
<input type="hidden" name="save_stx" value="<?php echo $stx; ?>">

<?php if ($is_category) { ?>
<label for="sca" class="sound_only">분류선택</label>
<select name="sca" id="sca" required class="required" >
	<option value="">선택하세요</option>
	<?php echo $category_option ?>
</select>
<?}?>

<label for="sfl" class="sound_only">검색대상</label>
<select name="sfl" id="sfl">
	<option value="wr_subject"<?php echo get_selected($sfl, 'wr_subject', true); ?>>제목</option>
	<option value="wr_content"<?php echo get_selected($sfl, 'wr_content'); ?>>내용</option>
	<option value="wr_subject||wr_content"<?php echo get_selected($sfl, 'wr_subject||wr_content'); ?>>제목+내용</option>
	<option value="mb_id,1"<?php echo get_selected($sfl, 'mb_id,1'); ?>>회원아이디</option>
	<option value="mb_id,0"<?php echo get_selected($sfl, 'mb_id,0'); ?>>회원아이디(코)</option>
	<option value="wr_name,1"<?php echo get_selected($sfl, 'wr_name,1'); ?>>글쓴이</option>
	<option value="wr_name,0"<?php echo get_selected($sfl, 'wr_name,0'); ?>>글쓴이(코)</option>
</select>

<label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
<input type="text" name="stx" value="<?php echo $stx; ?>" required class="frm_input required">
<input type="submit" value="검색" class="btn_submit">

</form>

<form name="fitemuselist" method="post" action="./counsel_listupdate.php" onsubmit="return fitemuselist_submit(this);" autocomplete="off">
<input type="hidden" name="sca" value="<?php echo $sca; ?>">
<input type="hidden" name="sst" value="<?php echo $sst; ?>">
<input type="hidden" name="sod" value="<?php echo $sod; ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl; ?>">
<input type="hidden" name="stx" value="<?php echo $stx; ?>">
<input type="hidden" name="page" value="<?php echo $page; ?>">

<div class="tbl_head01 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?> 목록</caption>
    <thead>
    <tr>
        <th scope="col">
            <label for="chkall" class="sound_only">상담 전체</label>
            <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
        </th>
        <th scope="col"><?php echo subject_sort_link('wr_subject') ?>상담제목</a></th>
        <th scope="col"><?php echo subject_sort_link('wr_name') ?>글쓴이</a></th>
        <th scope="col">날짜</th>
        <th scope="col">처리</th>
        <th scope="col">관리</th>
    </tr>
    </thead>
    <tbody>
    <?php
    for ($i=0; $row=sql_fetch_array($result); $i++) {

		$row['wr_subject'] = conv_subject($row['wr_subject'], 40, '…');

		// 당일인 경우 시간으로 표시함
		$row['datetime'] = substr($row['wr_datetime'],0,10);
		$row['datetime2'] = $row['wr_datetime'];
		if ($row['datetime'] == G5_TIME_YMD)
			$row['datetime2'] = substr($row['datetime2'],11,5);
		else
			$row['datetime2'] = substr($row['datetime2'],5,5);

        $bg = 'bg'.($i%2);
    ?>

    <tr class="<?php echo $bg; ?>">
        <td class="td_chk">
            <label for="chk_<?php echo $i; ?>" class="sound_only"><?php echo get_text($row['wr_subject']) ?> 상담</label>
            <input type="checkbox" name="chk[]" value="<?php echo $i ?>" id="chk_<?php echo $i; ?>">
            <input type="hidden" name="wr_id[<?php echo $i; ?>]" value="<?php echo $row['wr_id']; ?>">
        </td>
        <td class="td_subject">
			<?if ($is_category && $row['ca_name']) { echo "[".$row['ca_name']."]"; } ?>
			<?php echo $row['wr_subject'] ?>
		</td>
        <td class="td_name sv_use"><?php echo $row['wr_name'] ?></td>
        <td class="td_date">
            <?php echo $row['datetime2'] ?>
        </td>
        <td class="td_num">
            <label for="score_<?php echo $i; ?>" class="sound_only">처리</label>
            <select name="is_score[<?php echo $i; ?>]" id="score_<?php echo $i; ?>">
            <option value="0" <?php echo get_selected($row['effect'], "0"); ?>>접수</option>
            <option value="1" <?php echo get_selected($row['effect'], "1"); ?>>완료</option>
			<option value="2" <?php echo get_selected($row['effect'], "2"); ?>>취소</option>
            </select>
        </td>
        <td class="td_mngsmall">
            <a href="./counsel_form.php?w=u&amp;wr_id=<?php echo $row['wr_id']; ?>&amp;<?php echo $qstr; ?>"><span class="sound_only"><?php echo get_text($row['wr_subject']); ?> </span>수정</a>
        </td>
    </tr>

    <?php
    }

    if ($i == 0) {
        echo '<tr><td colspan="6" class="empty_table">자료가 없습니다.</td></tr>';
    }
    ?>
    </tbody>
    </table>
</div>

<div class="btn_list01 btn_list">
    <input type="submit" name="act_button" value="선택수정" onclick="document.pressed=this.value">
    <input type="submit" name="act_button" value="선택삭제" onclick="document.pressed=this.value">
</div>
</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, "{$_SERVER['SCRIPT_NAME']}?$qstr&amp;page="); ?>

<script>
function fitemuselist_submit(f)
{
    if (!is_checked("chk[]")) {
        alert(document.pressed+" 하실 항목을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "선택삭제") {
        if(!confirm("선택한 자료를 정말 삭제하시겠습니까?")) {
            return false;
        }
    }

    return true;
}

</script>

<?php
include_once (G5_ADMIN_PATH.'/admin.tail.php');
?>
