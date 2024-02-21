<?php
//$_GET['title'] 연관배열이다, 숫자 대신 문자로 이름을 줄 수 있는 배열도 있다.
echo "<p>제목(Title) : ".$_GET['title']."</p>";
echo "<p>내용(Description) : ".$_GET['description']."</p>";

// php에서 파일을 저장할 때 사용하는 함수는? ===> file_put_contents()
file_put_contents('php/'.$_POST['title'],$_POST['description']); //첫번째 인자로 title, 두번째 인자로 description 줌
?>