<?php
include_once('./_common.php');
$g5['title'] = '등록 신청';
include_once(G5_THEME_PATH.'/head.php');
add_javascript(G5_POSTCODE_JS, 0);    //다음 주소 js
add_javascript('<script src="'.G5_JS_URL.'/apply.js?ver='.time().'"></script>', 0);
?>

<!doctype html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>GPC인증신청신청 프로그램 시스템 연동-PHP</title>
</head>
<body>
<?php
    $a = 5;
    $a += 3;
    $c = "(주)지피씨인증원은";
    $c .="미국의 인정기관 IAS로부터 ISO/IEC 17024에 기반하여 인정을 취득한 개인인증기관";
    $d = $a >> 2;

    echo "$c <b> \n $d 입니다...";

?>
</body>
</html>

<?php
include_once(G5_THEME_PATH.'/tail.php');
?>