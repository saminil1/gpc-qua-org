<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>
	<form  name="fwrite" id="fwrite" action="<?php echo $register_action_url ?>" onsubmit="return fregister_submit(this);" method="POST" autocomplete="off">

	<p>심사원등록 내용에 동의하셔야 심사원등록 하실 수 있습니다.</p>
    <section id="fregister_term">
        <h2>심사원등록약관</h2>
        <textarea readonly><?php echo get_text($csconfig['cf_stipulation']) ?></textarea>
        <fieldset class="fregister_agree">
            <label for="agree">심사원등록약관의 내용에 동의합니다.</label>
            <input type="checkbox" name="agree" value="1" id="agree">
        </fieldset>
    </section>

    <div class="btn_confirm">
        <input type="submit" class="btn_submit" value="심사원등록">
    </div>

    </form>

	<script>
		function fregister_submit(f) {
			if (!f.agree.checked) {
				alert("약관에 동의하셔야 심사원등록 하실 수 있습니다.");
				f.agree.focus();
				return false;
			}

			return true;
		}
	</script>