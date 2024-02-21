<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Conditional : Uses </title>
    <link rel="stylesheet" href="css1.css">
</head>
<body>
  
     <hr><hr>
   <h1><a href="index1.php">(주)아이지씨인증원==> GIC인증원</a></h1>
     <hr><hr>
   <ol>
       <li><a href="index1.php?id=HTML">HTML</a></li>
       <li><a href="index1.php?id=CSS">CSS</a></li>
       <li><a href="index1.php?id=JavaScript">JavaScript</a></li>
   </ol>
   
   <hr>
   

   <?php
        echo $_GET['id'];
    ?>
    
    <hr>
    
    <?php
        echo file_get_contents("data/".$_GET['id']);
    ?>

    
</body>
</html>