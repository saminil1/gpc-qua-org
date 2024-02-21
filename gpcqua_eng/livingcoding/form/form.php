<?php
// 아래 두 줄은 form.php 페이지에 직접 출력하는 방법
echo "<p>Title:".$_GET['title']."</p";
print('<br><br>');
echo "<p>Description:".$_GET['description']."</p>";

//아래 한 줄은 data 폴더에 파일을 생성하고 저장하는 Code
file_put_contents("data/".$_GET['title'],$_GET['description']);
?>