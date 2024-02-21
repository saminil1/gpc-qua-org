<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가;

// 아래 주석을 풀면 사용안함
// return;

if(!defined('CHECK_WRITEPAGE_SPAM_INPUT_NAME')){
    // 아래 상수값 영문소문자+숫자로 되어 있는 부분을 반드시 영문소문자+숫자로 마음대로 변경해주세요.
    define('CHECK_WRITEPAGE_SPAM_INPUT_NAME', 'dlcnsrhsakfmzh0407wkfgksek');
}

if(!defined('CHECK_WRITEPAGE_SPAM_INPUT_VALUE')){
    // 아래 상수값 한글로 되어 있는 부분을 반드시 한글로 마음대로 변경해주세요.
    define('CHECK_WRITEPAGE_SPAM_INPUT_VALUE', '지피시인증원보안강화일차입니다팀장요청건');
}

add_event('bbs_write', 'g5_check_spam_write_page', 1, 2);

function g5_check_spam_write_page($board, $wr_id){
    add_event('tail_sub', 'g5_add_script_write_page_input');
}

function g5_add_script_write_page_input(){
?>
<script>
jQuery(function ($) {
    $('<input>').attr({
        type: 'hidden',
        name: '<?php echo CHECK_WRITEPAGE_SPAM_INPUT_NAME; ?>',
        value: '<?php echo CHECK_WRITEPAGE_SPAM_INPUT_VALUE; ?>'
    }).appendTo('form[name=fwrite]');
});
</script>
<?php
}

add_event('write_update_before', 'g5_check_spam_write_update_before', 1, 2);

function g5_check_spam_write_update_before($board, $wr_id){
    if( isset($_POST[CHECK_WRITEPAGE_SPAM_INPUT_NAME]) && $_POST[CHECK_WRITEPAGE_SPAM_INPUT_NAME] === CHECK_WRITEPAGE_SPAM_INPUT_VALUE ){
        return;
    } else {
        alert("고객님의 글쓰기가 스펨공격이 의심됩니다!!!. 안녕히 가세요.");
    }
}