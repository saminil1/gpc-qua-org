<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>function.php 파일 생성</title>
</head>
<body>
    <h1>function01 (주)지시피인증원 인증서 검색 프로그램 개발</h1>
    <?php
        $str = "Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
        Iste dolorem rerum officiis pariatur, esse sunt commodi deleniti, 
        quam possimus nobis aliquam eaque omnis illum aut minus voluptatibus 
        asperiores sapiente veniam!";
        echo $str;
    ?>
    <h1>function01 인증서검색 프로그램 개발(인증서 갯수 검색 기능)</h1>
        <h2>Function strlen() & 특정 문자열 호출 기능,code에서의 줄 바꿈 기능</h2>
    <?php 
        echo strlen($str);
    ?>

    <h2>nl2br()-wn-줄바꿈 : 브라우저, 코드 모두 적용</h2>
    <?php 
        echo nl2br($str);
    ?>
</body>
</html>