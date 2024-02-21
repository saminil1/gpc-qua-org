<?php 
function print_list(){
    $list = scandir('data');
        $i = 0;
        while($i < count($list)){
            if($list[$i] !='.'){
                if($list[$i] !='..'){
                    ?>
                    <li><a href="form-test01.php?id=<?=$list[$i]?>"><?=$list[$i]?></a></li>
                    <?php
                }
            }
            $i = $i + 1;
        }
}

function print_title(){
    if(isset($_GET['id'])){
        echo $_GET['id'];
    } else {
        echo " 제목이 없습니다. 파일이름을 입력해주세요.";
    }
}


function print_description(){
    if(isset($_GET['id'])){
        echo file_get_contents("data/".$_GET['id']);
    } else {
        echo "파일 안에 내용이 없습니다. 내용을 입력하세요.";
    }
}

?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>(주)이지씨인증원</title>
    <style>
    a { text-decoration: none; }
    </style>
</head>
<body>
   
   <h1><a href="form-test01.php">견적받기/글쓰기페이지입니다.</a></h1>
    <ol>
      <?php print_list(); ?>
    </ol>

       
   <h2><?php print_title();  ?></h2>
       
    <h1><a href="create.php">견적받기 글쓰기</a></h1>
    <p><input type="text" name="title" placeholder="제목을 입력해주세요."></p>
    <p><textarea name="description" id="" cols="30" rows="10" placeholder="견적 내용을 입력해주세요."></textarea></p>
    <p><input type="submit"></p>

<hr><p></p><p></p><hr>
    <p>
    <?php print_description()  ?>
    </p>

</body>
</html>