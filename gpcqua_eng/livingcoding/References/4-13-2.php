<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>Conditional : Uses </title>
    <link rel="stylesheet" href="css1.css">
</head>
<body>
  
     <hr><hr>
   <h1><a href="index1.php">id값에 따라 제목 출력 ==> GIC인증원</a></h1>
     <hr><hr>
   <ol>
       <li><a href="index1.php?id=IGC.html">IGC</a></li>
       <li><a href="index1.php?id=RUSTEST.html">RUSTEST</a></li>
       <li><a href="index1.php?id=DNA.html">DNA</a></li>
       <li><a href="index1.php?id=GICERT.html">GICERT</a></li>
   </ol>
   
   <hr>
   

   <?php
        if(isset($_GET['id'])){//설정된 변수인지 확인하는 함수,$var가 설정되었는지 확인하고, 설정되었으면 TRUE, 설정되지 않았으면 FALSE를 반환합니다.
            echo $_GET['id'];
        } else {
            echo "(주)아이지씨인증원입니다.";
        }
    ?>
    
    <hr>
    
    <?php
        if(isset($_GET['id'])){//설정된 변수인지 확인하는 함수,$var가 설정되었는지 확인하고, 설정되었으면 TRUE, 설정되지 않았으면 FALSE를 반환합니다.
            echo file_get_contents("data/".$_GET['id']);
        } else {
            echo "안녕하세요. (주)지아이씨인증원입니다.";
        }
    ?>

    
</body>
</html>