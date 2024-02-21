<?php
$sub_menu = "300900";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

if ($is_admin != 'super')
    alert('최고관리자만 접근 가능합니다.');



$g5['title'] = '심사원등록 환경설정';
include_once ('./admin.head.php');

$pg_anchor = '<ul class="anchor">
	<li><a href="#anc_cf_setup">설치</a></li>
    <li><a href="#anc_cf_basic">기본환경</a></li>
    <li><a href="#anc_cf_desige">디자인설정</a></li>
    <li><a href="#anc_cf_agree">약관설정</a></li>
	<li><a href="#anc_cf_list">목록설정</a></li>
    <li><a href="#anc_cf_write">쓰기설정</a></li>
</ul>';

$frm_submit = '<div class="btn_confirm01 btn_confirm">
    <input type="submit" value="확인" class="btn_submit" accesskey="s">
    <a href="'.G5_URL.'/">메인으로</a>
</div>';

?>

<form name="fconfigform" id="fconfigform" method="post" onsubmit="return fconfigform_submit(this);">
<input type="hidden" name="token" value="" id="token">

<section id="anc_cf_setup">
    <h2 class="h2_frm">심사원등록 설치</h2>
    <?php echo $pg_anchor ?>

    <div class="tbl_frm01 tbl_wrap">
        <table>
        <caption>심사원등록 설치</caption>
        <colgroup>
            <col class="grid_4">
            <col>
            <col class="grid_4">
            <col>
        </colgroup>
        <tbody>
		<tr>
            <th scope="row"><label for="cf_bo_table">게시판선택<strong class="sound_only">필수</strong></label></th>
            <td>
				<?php echo help('심사원등록 스킨을 적용한 게시판을 선택하세요.');?>
				<?php echo get_board_id_select('cf_bo_table', $csconfig['cf_bo_table'], 'required') ?>
			</td>
        </tr>
		<tr>
            <th scope="row"><label for="cf_counsel">설치</label></th>
            <td colspan="3"><select name="cf_counsel" id="cf_counsel">
				<option value=""<?php echo get_selected('', $csconfig['cf_counsel']);?>>삭제</option>
				<option value="1"<?php echo get_selected('1', $csconfig['cf_counsel']);?>>설치</option>
			</select></td>
        </tr>
        </tbody>
        </table>
    </div>
</section>

<?php echo $frm_submit; ?>

<section id="anc_cf_basic">
    <h2 class="h2_frm">기본환경</h2>
    <?php echo $pg_anchor ?>

    <div class="tbl_frm01 tbl_wrap">
        <table>
        <caption>기본환경 설정</caption>
        <colgroup>
            <col class="grid_4">
            <col>
            <col class="grid_4">
            <col>
        </colgroup>
        <tbody>
		<tr>
            <th scope="row"><label for="cf_callback_url">CallBack URL</label></th>
            <td colspan="3">
				<?php echo help('URL이 없을 경우 쓰기페이지(write.php?bo_table='.$bo_table.')로 이동합니다.');?>
				<input type="text" name="cf_callback_url" id="cf_callback_url" value="<?php echo $csconfig['cf_callback_url'];?>" size="50" class="frm_input" placeholder="심사원등록신청완료후 이동URL">
			</td>
        </tr>
		<tr>
            <th scope="row"><label for="cf_okmsg">심사원등록완료 메세지</label></th>
            <td colspan="3"><input type="text" name="cf_okmsg" id="cf_okmsg" value="<?php echo $csconfig['cf_okmsg'];?>" size="40" class="frm_input" placeholder="정상적으로 접수되었습니다."></td>
        </tr>
		<tr>
            <th scope="row"><label for="cf_remail">메일로받기</label></th>
            <td colspan="3"><input type="checkbox" name="cf_remail" id="cf_remail" value="1"<?php echo get_checked($csconfig['cf_remail'], '1');?>> 사용(관리메일로 심사원등록신청내용 받기)</label></td>
        </tr>
		<tr>
            <th scope="row"><label for="cf_admin_email">관리메일</label></th>
            <td colspan="3"><input type="text" name="cf_admin_email" id="cf_admin_email" value="<?php echo $csconfig['cf_admin_email'];?>" size="40" class="frm_input" placeholder="통보받을 메일주소를 넣어주세요."></td>
        </tr>
        </tbody>
        </table>
    </div>
</section>

<?php echo $frm_submit; ?>

<section id="anc_cf_desige">
    <h2 class="h2_frm">디자인</h2>
    <?php echo $pg_anchor ?>

    <div class="tbl_frm01 tbl_wrap">
        <table>
        <caption>게시판 기본 설정</caption>
        <colgroup>
            <col class="grid_4">
            <col>
            <col class="grid_4">
            <col>
        </colgroup>
        <tbody>
		<tr>
            <th scope="row"><label for="cf_txt_editor">에디터</label></th>
            <td colspan="3"><select name="cf_txt_editor" id="cf_txt_editor">
				<option value=""<?php echo get_selected('', $csconfig['cf_txt_editor']);?>>미사용</option>
				<option value="1"<?php echo get_selected('1', $csconfig['cf_txt_editor']);?>>사용</option>
			</select> 긴문장입력형 에디터사용유무설정</td>
        </tr>
        </tbody>
        </table>
    </div>
</section>

<?php echo $frm_submit; ?>

<section id="anc_cf_agree">
    <h2 class="h2_frm">약관설정</h2>
    <?php echo $pg_anchor ?>

    <div class="tbl_frm01 tbl_wrap">
        <table>
        <caption>약관설정</caption>
        <colgroup>
            <col class="grid_4">
            <col>
            <col class="grid_4">
            <col>
        </colgroup>
        <tbody>
		<tr>
            <th scope="row"><label for="cf_agree">약관사용</label></th>
            <td colspan="3"><select name="cf_agree">
				<option value=""<?php echo get_selected('', $csconfig['cf_agree']);?>>미사용</option>
				<option value="1"<?php echo get_selected('1', $csconfig['cf_agree']);?>>사용(분리)</option>
				<option value="2"<?php echo get_selected('2', $csconfig['cf_agree']);?>>사용(통합)</option>
			</select></td>
        </tr>
		<tr>
            <th scope="row"><label for="cf_stipulation">약관내용</label></th>
            <td colspan="3">
				<?php echo help('심사원등록 약관내용을 입력합니다.'); ?>
                <textarea name="cf_stipulation" id="cf_stipulation"><?php echo $csconfig['cf_stipulation']; ?></textarea>
			</td>
        </tr>
        </tbody>
        </table>
    </div>
</section>

<?php echo $frm_submit; ?>

<section id="anc_cf_list">
    <h2 class="h2_frm">목록 설정</h2>
    <?php echo $pg_anchor ?>

    <div class="tbl_frm01 tbl_wrap">
        <table>
        <caption>목록 설정</caption>
        <colgroup>
            <col class="grid_4">
            <col>
        </colgroup>
        <tbody>
        <tr>
            <th scope="row"><label for="cf_effect">결과</label></th>
            <td colspan="3"><input type="checkbox" name="cf_effect" id="cf_effect" value="1"<?php echo get_checked($csconfig['cf_effect'], '1');?>> 사용(리스트에 결과출력)</label></td>
        </tr>
        </tbody>
        </table>
    </div>
</section>

<?php echo $frm_submit; ?>

<section id="anc_cf_write">
    <h2 class="h2_frm">쓰기설정</h2>
    <?php echo $pg_anchor ?>

    <div class="tbl_frm01 tbl_wrap">
        <table>
        <caption>쓰기설정</caption>
        <colgroup>
            <col class="grid_4">
            <col>
            <col class="grid_4">
            <col>
        </colgroup>
        <tbody>
		<tr>
            <th scope="row"><label for="cf_subject">제목</label></th>
            <td colspan="3"><select name="cf_subject" id="cf_subject">
				<option value=""<?php echo get_selected('', $csconfig['cf_subject']);?>>미사용</option>
				<option value="1"<?php echo get_selected('1', $csconfig['cf_subject']);?>>사용</option>
			</select></td>
        </tr>
		<tr>
            <th scope="row"><label for="cf_link">링크</label></th>
            <td colspan="3"><select name="cf_link" id="cf_link">
				<option value=""<?php echo get_selected('', $csconfig['cf_link']);?>>미사용</option>
				<option value="1"<?php echo get_selected('1', $csconfig['cf_link']);?>>사용</option>
			</select></td>
        </tr>
		<tr>
            <th scope="row"><label for="cf_files">첨부파일</label></th>
            <td colspan="3"><select name="cf_files" id="cf_files">
				<option value=""<?php echo get_selected('', $csconfig['cf_files']);?>>미사용</option>
				<option value="1"<?php echo get_selected('1', $csconfig['cf_files']);?>>사용</option>
			</select></td>
        </tr>
        </tbody>
        </table>
    </div>
</section>

<?php echo $frm_submit; ?>

</form>

<script>

function fconfigform_submit(f)
{
    f.action = "./counsel_config_update.php";
    return true;
}
</script>

<?php
include_once ('./admin.tail.php');
?>
