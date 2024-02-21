<?php
$sub_menu = '200120';
include_once('./_common.php');

auth_check($auth[$sub_menu], "w");

if ($w == '')
{
    $html_title = '추가';	
	$row['price'] = $iso_price;
	$row['settle_case'] = $iso_bank_info;
}
else if ($w == 'u')
{
	$html_title = " 수정";
    $sql = " select * from {$g5['iso_apply_table']} where ia_no = '{$ia_no}' ";
	$row = sql_fetch($sql);
    if (! (isset($row['ia_no']) && $row['ia_no'])) alert("등록된 자료가 없습니다.");
}
else
    alert('제대로 된 값이 넘어오지 않았습니다.');

$g5['title'] .= '자격정보 '.$html_title;
include_once (G5_ADMIN_PATH.'/admin.head.php');
add_javascript(G5_POSTCODE_JS, 0);    //다음 주소 js
?>
<!--
<div class="local_desc01 local_desc">
    <p>관리자에서는 이메일 중복여부를 따지지 않는다. 이유는 회원가입을 시키는게 아니기 때문</p>
</div>
-->
<form name="fapply" id="fapply" action="./apply_form_update.php" onsubmit="return fapply_submit(this);" method="post" enctype="multipart/form-data">
<input type="hidden" name="w" value="<?php echo $w ?>">
<input type="hidden" name="ia_no" value="<?php echo $ia_no ?>">
<input type="hidden" name="sca" value="<?php echo $sca ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="sst" value="<?php echo $sst ?>">
<input type="hidden" name="sod" value="<?php echo $sod ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="token" value="">

<div class="tbl_frm01 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?></caption>
    <colgroup>
        <col class="grid_4">
        <col>
        <col class="grid_4">
        <col>
    </colgroup>
    <tbody>
    <tr>
        <th scope="row"><label for="standard">신청규격<strong class="sound_only">필수</strong></label></th>
        <td colspan="3">
			<div style="width: 80%;display: grid;grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));">
				<?php foreach($iso_standard_arr as $key => $val) { ?>
				<label for="standard_<?php echo $key ?>"><input type="radio" name="standard" value="<?php echo $key ?>" id="standard_<?php echo $key ?>" <?php echo get_checked($key, $row['standard']); ?>> <?php echo $val ?> </label>
				<?php }	?>
			</div>
		</td>
    </tr>
	<tr>
        <th scope="row"><label for="grade">등급<strong class="sound_only">필수</strong></label></th>
        <td colspan="3">
			<?php foreach($iso_grade_arr as $key => $val) { ?>
			<label for="grade_<?php echo $key ?>"><input type="radio" name="grade" value="<?php echo $key ?>" id="grade_<?php echo $key ?>" <?php echo get_checked($key, $row['grade']); ?>> <?php echo $val ?> </label>
			<?php } ?>
		</td>
    </tr>
	<tr>
        <th scope="row"><label for="type">유형<strong class="sound_only">필수</strong></label></th>
        <td colspan="3">
			<?php foreach($iso_type_arr as $key => $val) { ?>
			<label for="type_<?php echo $key ?>"><input type="radio" name="type" value="<?php echo $key ?>" id="type_<?php echo $key ?>" <?php echo get_checked($key, $row['type']); ?>> <?php echo $val ?> </label>
			<?php } ?>
		</td>
    </tr>
	<tr>
        <th scope="row"><label for="name_kr">이름(한)<strong class="sound_only">필수</strong></label></th>
		<td><input type="text" name="name_kr" value="<?php echo get_text($row['name_kr']) ?>" id="name_kr" class="frm_input" size="30" maxlength="20"></td>
		<th scope="row"><label for="name_en">이름(영)</label></th>
		<td><input type="text" name="name_en" value="<?php echo get_text($row['name_en']) ?>" id="name_en" class="frm_input" size="30" maxlength="20"></td>
    </tr>
	<tr>
        <th scope="row"><label for="hp">핸드폰번호<strong class="sound_only">필수</strong></label></th>
		<td><input type="text" name="hp" value="<?php echo get_text($row['hp']) ?>" id="hp" class="frm_input" size="30" maxlength="20"></td>
		<th scope="row"><label for="email">이메일</label></th>
		<td><input type="text" name="email" value="<?php echo get_text($row['email']) ?>" id="email" class="frm_input" size="50" maxlength="100"></td>
    </tr>
	<!--
	<tr>
        <th scope="row"><label for="mb_id">아이디<strong class="sound_only">필수</strong></label></th>
		<td><input type="text" name="mb_id" value="<?php echo get_text($row['mb_id']) ?>" id="mb_id" class="frm_input" size="30" maxlength="20"></td>
		<th scope="row"><label for="mb_password">비밀번호</label></th>
		<td><input type="text" name="mb_password" value="<?php echo get_text($row['mb_password']) ?>" id="mb_password" class="frm_input" size="30" maxlength="20"></td>
    </tr>
	-->
	<tr>
        <th scope="row">수령 주소</th>
        <td colspan="3" class="td_addr_line">
            <label for="zipcode" class="sound_only">우편번호</label>
            <input type="text" name="zipcode" value="<?php echo $row['zip1'].$row['zip2']; ?>" id="zipcode" class="frm_input readonly" size="5" maxlength="6">
            <button type="button" class="btn_frmline" onclick="win_zip('fapply', 'zipcode', 'address1', 'address2', 'address3', 'addr_jibeon');">주소 검색</button><br>
            <input type="text" name="address1" value="<?php echo $row['address1'] ?>" id="address1" class="frm_input readonly" size="60">
            <label for="address1">기본주소</label><br>
            <input type="text" name="address2" value="<?php echo $row['address2'] ?>" id="address2" class="frm_input" size="60">
            <label for="address2">상세주소</label>
            <br>
            <input type="text" name="address3" value="<?php echo $row['address3'] ?>" id="address3" class="frm_input" size="60">
            <label for="address3">참고항목</label>
            <input type="hidden" name="addr_jibeon" value="<?php echo $row['addr_jibeon']; ?>"><br>
        </td>
    </tr>
	<tr>
        <th scope="row">제출문서</th>
        <td colspan="3">
			<input type="checkbox" name="doc_chk_01" value="Y" id="doc_chk_01" <?php echo get_checked($row['doc_chk_01'], 'Y'); ?>> <label for="doc_chk_01">이력서(실무경력포함)</label>
			<input type="checkbox" name="doc_chk_02" value="Y" id="doc_chk_02" <?php echo get_checked($row['doc_chk_02'], 'Y'); ?>> <label for="doc_chk_02">심사일지(심사원 5맨데이, 선임 8맨데이)</label>
			<input type="checkbox" name="doc_chk_03" value="Y" id="doc_chk_03" <?php echo get_checked($row['doc_chk_03'], 'Y'); ?>> <label for="doc_chk_03">교육훈련수료증(교육수료)</label>
			<input type="checkbox" name="doc_chk_04" value="Y" id="doc_chk_04" <?php echo get_checked($row['doc_chk_04'], 'Y'); ?>> <label for="doc_chk_04">학력증명서(고등학교졸업이상)</label>
		</td>
    </tr>
	<?php for ($i=1; $i<=1; $i++) { ?>
	<tr>
		<th scope="row"><label for="up_file_<?php echo $i ?>">파일업로드</label></th>
		<td colspan="3">
		<input type="file" name="up_file[<?php echo $i; ?>]" id="up_file_<?php echo $i ?>" title="파일첨부 :  용량 <?php echo $iso_upload_size; ?> 바이트 이하만 업로드 가능">
		<?php if($w == 'u' && $row['file'.$i]) { ?>
		<input type="checkbox" id="up_file_del<?php echo $i ?>" name="up_file_del[<?php echo $i;  ?>]" value="1"> <label for="up_file_del<?php echo $i ?>"><?php echo $row['source'.$i];  ?> 파일 삭제</label>
		<a href="<?php echo G5_THEME_URL ?>/apply/download.php?ia_no=<?php echo $row['ia_no'] ?>&no=<?php echo $i ?>" class="btn btn_02">다운로드</a>
		<?php
		$srcfile = G5_DATA_PATH.'/interior/'.$row['file'.$i];
			if(preg_match("/\.({$config['cf_image_extension']})$/i", $srcfile) && is_file($srcfile)) {// 이미지라면
				$srcurl = G5_DATA_URL.'/apply/'.$row['file'.$i];
				$size = @getimagesize($srcfile);
				if($size[0] && $size[0] > 150)
					$img_width = 150;
				else
					$img_width = $size[0];
				$srcurl = str_replace(G5_PATH, G5_URL, $srcfile);
		?>
		<br><br><a href="<?php echo $srcurl ?>" target="_blank"><img src="<?php echo $srcurl ?>" width="<?php echo $img_width ?>" alt="이미지"></a>
		<?php
			}
		}
		?>
		</td>
	</tr>
	<?php } ?>
	<tr>
        <th scope="row">비용(부가세포함)</th>
		<td>
			<?php foreach($iso_price_arr as $key => $val) { ?>
			<label for="price_<?php echo $key ?>"><input type="radio" name="price" value="<?php echo $key ?>" id="price_<?php echo $key ?>" <?php echo get_checked($key, (int)$row['price']); ?>> <?php echo $val ?> 원 </label>
			<?php } ?>
		<?php// echo number_format($row['price']) ?>
		</td>
		<th scope="row">결제수단</th>
		<td><?php echo $row['settle_case'] ?></td>
    </tr>

	<tr>
        <th scope="row">현금영수증</th>
        <td colspan="3" class="td_addr_line">
			<?php foreach($iso_cash_receipt_arr as $key => $val) { ?>
			<label for="app_way_<?php echo $key ?>"><input type="radio" name="app_way" value="<?php echo $key ?>" id="app_way_<?php echo $key ?>" <?php echo get_checked($key, $row['app_way']); ?>> <?php echo $val ?> </label>
			<?php } ?>
			<br>
			<input type="text" name="app_info" value="<?php echo get_text($row['app_info']) ?>" id="app_info" class="frm_input" size="30" maxlength="20" placeholder="발행 연락처">
        </td>
    </tr>
	<tr>
        <th scope="row"><label for="req_memo">요청사항</label></th>
        <td colspan="3"><textarea name="req_memo" id="req_memo" disabled><?php echo $row['req_memo'] ?></textarea></td>
    </tr>
	<tr>
        <th scope="row"><label for="mb_id">아이디<strong class="sound_only">필수</strong></label></th>
		<td><input type="text" name="mb_id" value="<?php echo get_text($row['mb_id']) ?>" id="mb_id" <?php echo ($w == 'u') ? 'readonly' : '' ?> class="frm_input" size="30" maxlength="20"></td>		
    </tr>
	<tr>
        <th scope="row"><label for="state">상태</label></th>
        <td colspan="3">
		<select name="state" id="state">
			<?php foreach($iso_state_arr as $key => $val) { ?>
			<option value="<?php echo $key ?>"<?php echo get_selected($row['state'], $key) ?>><?php echo $val ?></option>
			<?php } ?>
		</select>
        </td>
    </tr>
    <?php if ($w == 'u') { ?>
    <tr>
        <th scope="row">등록일</th>
        <td><?php echo $row['datetime'] ?></td>
        <th scope="row">등록아이피</th>
        <td><?php echo $row['ip'] ?></td>
    </tr>
    <?php } ?>    
    </tbody>
    </table>
</div>

<div class="btn_fixed_top">
    <a href="./apply_list.php?<?php echo $qstr ?>" class="btn btn_02">목록</a>
    <input type="submit" value="확인" class="btn_submit btn" accesskey='s'>
</div>
</form>

<script>
function fapply_submit(f)
{
	if(!$('input:radio[name="standard"]').is(':checked')) {
		alert("신청규격을 선택하세요.");
		return false;
	}
	
	if(!$('input:radio[name="grade"]').is(':checked')) {
		alert("등급을 선택하세요.");
		return false;
	}
	
	if(!$('input:radio[name="type"]').is(':checked')) {
		alert("유형을 선택하세요.");
		return false;
	}	

	return;
}
</script>

<?php
include_once(G5_ADMIN_PATH.'/admin.tail.php');
?>