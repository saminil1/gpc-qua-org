<form method="post" action="session_generate.php">
   <p>아이디란: &nbsp; &nbsp;<input type="text" name="id" id="id" value=""></p>
   <p>비밀번호: &nbsp; &nbsp;<input type="password" name="pwd" id="pwd" value=""></p>
   <button onclick="javascript:document.frm.submit();">로그인</button>
</form>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charssset="UTF-8">
    <title>sessioninput.php</title>
</head>
<body>
    
</body>
</html>
<script>
function saveThis(){
    document.frm.submit();
}

</script>