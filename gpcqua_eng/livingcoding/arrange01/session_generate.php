<?php
session_start();
$_SESSION["sess_id"] = $_POST["in"];
echo "세션값:".$_SESSION["sess_id"];
?>



<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    
</body>
</html>