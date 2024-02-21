<?php
echo "<p>Title:".$_GET['title']."</p>";
echo "<p>Description:".$_GET['description']."</p>";

file_put_contents("data/".$_GET['title'],$_GET['description']);

header('Location: ./index_20210624_01.php');//Redirction

?>