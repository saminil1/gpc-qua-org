<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css1.css">
</head>
<body>
   <hr>
    <h1>(주)아이지씨인증원</h1>
    <ol>
        <li><a href="index1.php?id=IGC.html">(주)아이지씨인증원</a></li>
        <li><a href="index1.php?id=DNA.html">(주)디엔에이테크퍼시픽</a></li>
        <li><a href="index1.php?id=RUSTEST.html">(주)러스테스트</a></li>
        <li><a href="index1.php?id=GICERT.html">(주)지아이지씨인증원</a></li>
        <li><a href="index1.php?id=IGCACADEMY.html">IGC Academy</a></li>
    </ol>
    <br><br>
       <hr>
    <h1 style="font-size:3rem;color:blue;">
        <?php 
         echo $_GET["id"];
        ?>
    </h1>
       <hr>
    <?php 
     //data/id 값에 해당하는 파일의 내용을 읽어서 echo
        echo file_get_contents("form.html");//전체 파일을 문자열로 읽어서 출력하기, form.html 폼 애플리케이션 출력합니다.
    
        echo "<br><br><hr><hr>";//상하 여백
    
        echo file_get_contents("data/".$_GET['id']);//id 값에 따라 적당한 파일 가져와 출력하기
//    $home = file_get_contents('https://www.php.net/');
//    echo $home;
    ?>
</body>
</html>