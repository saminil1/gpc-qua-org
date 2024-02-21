<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title></title>
    </head>
    <body>
        <h1><a href="index.php">WEB</a></h1>
<!-- data 디렉토리에 있는 파일의 목록을 가져오세요.
       그 파일의 목록 하나하나를 li와 a 태그를 이용해  글 목록을 만들어주세요.-->
        <ol>
            <?php
                $list = scandir('data');//php폴더 다루기, scandir () 함수는 지정된 디렉토리의 파일 및 디렉토리의 배열을 반환=해당 폴더에 있는 파일과 폴더를 보여준다.
                $i = 0;
                while($i < count($list)) {
                    if($list[$i] != '.') {
                        if($list[$i] != '..') {
                            ?>
                            <li><a href="index.php?id=<?=$list[$i]?>"><?=$list[$i]?></a></li>
                            <?php
                        }
                    }
                    $i = $i + 1;
                }
            ?>
        </ol>
        <h2>
            <?php
                if(isset($_GET['id'])) {
                    echo $_GET['id'];
                } else {
                    echo "Welcome";
                }
            ?>
        </h2>
        <?php
            if(isset($_GET['id'])) {
                echo file_get_contents("data/".$_GET['id']);
            } else {
                echo "Hello, PHP";
            }
        ?>
        
        <h2>scandir() 함수 원형</h2>
        <?php
        
        
        
        ?>
        
        
    </body>
</html>
