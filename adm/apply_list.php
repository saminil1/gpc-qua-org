<?php
$sub_menu = "200120";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$sql_common = " from {$g5['iso_apply_table']} ";

$sql_search = " where (1) and mb_id <> '' ";
if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        case 'mb_point' :
            $sql_search .= " ({$sfl} >= '{$stx}') ";
            break;
        case 'mb_level' :
            $sql_search .= " ({$sfl} = '{$stx}') ";
            break;
        case 'mb_tel' :
        case 'mb_hp' :
            $sql_search .= " ({$sfl} like '%{$stx}') ";
            break;
        default :
            $sql_search .= " ({$sfl} like '{$stx}%') ";
            break;
    }
    $sql_search .= " ) ";
}

// 신청규격
if($s_standard) {
	$sql_search .= " and standard = '{$s_standard}' ";
}
// 등급
if($s_grade) {
	$sql_search .= " and grade = '{$s_grade}' ";
}
// 유형
if($s_type) {
	$sql_search .= " and type = '{$s_type}' ";
}
// 상태
if($s_type) {
	$sql_search .= " and state = '{$s_state}' ";
}


if (!$sst) {
    $sst = "datetime";
    $sod = "desc";
}

$sql_order = " order by {$sst} {$sod} ";

$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$qstr .= ($qstr ? '&amp;' : '').'s_standard='.$s_standard.'&amp;s_grade='.$s_grade.'&amp;s_type='.$s_type.'&amp;s_state='.$s_state;

$listall = '<a href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall">전체목록</a>';

$g5['title'] = '등록정보관리';
include_once('./admin.head.php');

$sql = " select * {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);

$colspan = 13;
?>

<div class="local_ov01 local_ov">
    <?php echo $listall ?>
    <span class="btn_ov01"><span class="ov_txt">총건수 </span><span class="ov_num"> <?php echo number_format($total_count) ?>건 </span></span>
</div>

<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">
<select name="s_standard" id="s_standard">
	<option value="">신청규격</option>
	<?php foreach ($iso_standard_arr as $key => $val) { ?>
	<option value="<?php echo $key ?>" <?php echo get_selected($s_standard, $key) ?>><?php echo $val ?></option>
	<?php } ?>
</select>

<select name="s_grade" id="s_grade">
	<option value="">등급</option>
	<?php foreach ($iso_grade_arr as $key => $val) { ?>
	<option value="<?php echo $key ?>" <?php echo get_selected($s_grade, $key) ?>><?php echo $val ?></option>
	<?php } ?>
</select>

<select name="s_type" id="s_type">
	<option value="">유형</option>
	<?php foreach ($iso_type_arr as $key => $val) { ?>
	<option value="<?php echo $key ?>" <?php echo get_selected($s_type, $key) ?>><?php echo $val ?></option>
	<?php } ?>
</select>
<select name="s_state" id="s_state">
	<option value="">상태</option>
	<?php foreach ($iso_state_arr as $key => $val) { ?>
	<option value="<?php echo $key ?>" <?php echo get_selected($s_state, $key) ?>><?php echo $val ?></option>
	<?php } ?>
</select>

<label for="sfl" class="sound_only">검색대상</label>
<select name="sfl" id="sfl">
    <option value="name_kr"<?php echo get_selected($_GET['sfl'], "name_kr"); ?>>이름(한)</option>
    <option value="name_en"<?php echo get_selected($_GET['sfl'], "name_en"); ?>>이름(영)</option>
	<option value="mb_id"<?php echo get_selected($_GET['sfl'], "mb_id"); ?>>아이디</option>
	<option value="od_id"<?php echo get_selected($_GET['sfl'], "od_id"); ?>>신청번호</option>
    <option value="hp"<?php echo get_selected($_GET['sfl'], "hp"); ?>>핸드폰번호</option>
    <option value="email"<?php echo get_selected($_GET['sfl'], "email"); ?>>이메일</option>
    <option value="mb_tel"<?php echo get_selected($_GET['sfl'], "mb_tel"); ?>>비용</option>
    <option value="req_memo"<?php echo get_selected($_GET['sfl'], "req_memo"); ?>>요청사항</option>
    <option value="app_info"<?php echo get_selected($_GET['sfl'], "app_info"); ?>>발행연락처</option>
    <option value="datetime"<?php echo get_selected($_GET['sfl'], "datetime"); ?>>등록일시</option>
    <option value="ip"<?php echo get_selected($_GET['sfl'], "ip"); ?>>IP</option>
</select>
<label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
<input type="text" name="stx" value="<?php echo $stx ?>" id="stx" required class="required frm_input">
<input type="submit" class="btn_submit" value="검색">
</form>
<!--
<div class="local_desc01 local_desc">
    <p></p>
</div>
-->

<form name="fapplylist" id="fapplylist" action="./apply_list_update.php" onsubmit="return fapplylist_submit(this);" method="post">
<input type="hidden" name="sst" value="<?php echo $sst ?>">
<input type="hidden" name="sod" value="<?php echo $sod ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="token" value="">

<div class="tbl_head01 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?> 목록</caption>
    <thead>
    <tr>
        <th scope="col" id="mb_list_chk">
            <label for="chkall" class="sound_only">전체</label>
            <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
        </th>
        <th scope="col"><?php echo subject_sort_link('od_id', '', 'desc') ?>신청번호</a></th>
        <th scope="col"><?php echo subject_sort_link('mb_id') ?>아이디</a></th>
		<th scope="col">신청규격</th>
		<th scope="col">등급</th>
		<th scope="col">유형</th>
        <th scope="col">이름(한)</th>
        <th scope="col">핸드폰번호</th>
        <th scope="col">이메일</th>
        <th scope="col"><?php echo subject_sort_link('price', '', 'desc') ?>비용(원)</a></th>
        <th scope="col"><?php echo subject_sort_link('datetime', '', 'desc') ?>등록일시</a></th>
        <th scope="col">상태</th>
        <th scope="col">관리</th>
    </tr>
    </thead>
    <tbody>
    <?php
    for ($i=0; $row=sql_fetch_array($result); $i++) {
		$s_mod = '<a href="./apply_form.php?'.$qstr.'&amp;w=u&amp;ia_no='.$row['ia_no'].'" class="btn btn_03">수정</a>';
		$s_del = '<a href="./apply_list_update.php?'.$qstr.'&amp;w=d&amp;ia_no='.$row['ia_no'].'" onclick="return delete_confirm(this);" class="btn btn_02">삭제</a>';

        $address = $row['mb_zip1'] ? print_address($row['mb_addr1'], $row['mb_addr2'], $row['mb_addr3'], $row['mb_addr_jibeon']) : '';

        $bg = 'bg'.($i%2);        
    ?>

    <tr class="<?php echo $bg; ?>">
        <td  class="td_chk">
            <input type="hidden" name="ia_no[<?php echo $i ?>]" value="<?php echo $row['ia_no'] ?>" id="ia_no_<?php echo $i ?>">
            <label for="chk_<?php echo $i; ?>" class="sound_only"><?php echo $row['ia_no']; ?></label>
            <input type="checkbox" name="chk[]" value="<?php echo $i ?>" id="chk_<?php echo $i ?>">
        </td>
        <td class="td_num_c3"><?php echo $row['od_id'] ?></td>
		<td class="td_id"><a href="./member_form.php?w=u&mb_id=<?php echo get_text($row['mb_id']) ?>"><?php echo get_text($row['mb_id']) ?></a></td>
		<td class="">
			<select name="standard[<?php echo $i; ?>]" id="standard_[<?php echo $i; ?>]">
				<?php foreach ($iso_standard_arr as $key => $val) { ?>
				<option value="<?php echo $key ?>" <?php echo get_selected($row['standard'], $key) ?>><?php echo $val ?></option>
				<?php } ?>
			</select>
		</td>
		<td class="">
			<select name="grade[<?php echo $i; ?>]" id="grade_[<?php echo $i; ?>]">
				<?php foreach ($iso_grade_arr as $key => $val) { ?>
				<option value="<?php echo $key ?>" <?php echo get_selected($row['grade'], $key) ?>><?php echo $val ?></option>
				<?php } ?>
			</select>
		</td>
		<td class="">
			<select name="type[<?php echo $i; ?>]" id="type_[<?php echo $i; ?>]">
				<?php foreach ($iso_type_arr as $key => $val) { ?>
				<option value="<?php echo $key ?>" <?php echo get_selected($row['type'], $key) ?>><?php echo $val ?></option>
				<?php } ?>
			</select>
		</td>
		<td class=""><?php echo get_text($row['name_kr']) ?></td>
		<td class=""><?php echo get_text($row['hp']) ?></td>
		<td class=""><?php echo get_text($row['email']) ?></td>
		<td class=""><?php echo number_format($row['price']) ?></td>
		<td class="td_date"><?php echo substr($row['datetime'],2,8); ?></td>
        <td class="">
			<select name="state[<?php echo $i; ?>]" id="state_[<?php echo $i; ?>]">
				<?php foreach ($iso_state_arr as $key => $val) { ?>
				<option value="<?php echo $key ?>" <?php echo get_selected($row['state'], $key) ?>><?php echo $val ?></option>
				<?php } ?>
			</select>
        </td>
        <td class="td_mng"><?php echo $s_mod ?><?php echo $s_del ?></td>
    </tr>
    <?php
    }
    if ($i == 0)
        echo "<tr><td colspan=\"".$colspan."\" class=\"empty_table\">자료가 없습니다.</td></tr>";
    ?>
    </tbody>
    </table>
</div>

<div class="btn_fixed_top">
    <input type="submit" name="act_button" value="선택수정" onclick="document.pressed=this.value" class="btn btn_02">
    <input type="submit" name="act_button" value="선택삭제" onclick="document.pressed=this.value" class="btn btn_02">
	<!--
    <?php if ($is_admin == 'super') { ?>
    <a href="./apply_form.php" id="apply_add" class="btn btn_01">등록추가</a>
    <?php } ?>
	-->
</div>
</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&amp;page='); ?>

<script>
function fapplylist_submit(f)
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
include_once ('./admin.tail.php');
?>
