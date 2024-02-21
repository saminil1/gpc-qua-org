<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>While 반복</title>
</head>
<body>
   <h1>while</h1>
    <?php
        echo '1<br>';
    while(5<1){
        echo '2<br>';
    }
    echo '3<br>';
    ?>
    
    
    <h1>while 반복-변수 i의 값이 1씩 증가</h1>
    <?php
        echo '1<br>';
        $i = 0;
    while(false){
        echo '2<br>';
        $i = $i + 1;
    }
    echo "3<br>";
    ?>
</body>
</html>