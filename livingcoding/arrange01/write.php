<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>PHP변수 $_POST- write.php</title>
</head>
<body>
   <form id="frm" name="frm" action="save.php" method="post">
    <p>회사명:<input type="text" name="name" id="name" value=""></p>
    <p>제목란:<input type="text" name="title" id="title" value=""></p>
    <p>본문란:<textarea name="description" id="" cols="30" rows="10"></textarea></p>
    
    <button onclick="javascript:saveThis();">submit</button>
   </form>
</body> 
</html>


<script>
function saveThis(){
    document.frm.submit();
}

</script>