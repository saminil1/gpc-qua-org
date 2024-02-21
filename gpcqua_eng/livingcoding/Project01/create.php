<?php
function print_title(){
  if(isset($_GET['id'])){
    echo $_GET['id'];
    } else {
      echo "인증서 번호를 입력하세요.";
    }   
}

function print_description(){
  if(isset($_GET['id'])){
    echo file_get_contents("data/".$_GET['id']);
    } else {
      echo "인증서 내용이 없습니다. 내용을 입력해주세요. ";
    }
}


function print_list(){
    $list = scandir('data');
    $i = 0;
    while($i<count($list)){
        if($list[$i] !='.'){
            if($list[$i] !='..'){
                ?>
                 <li><a href="index.php?id=<?=$list[$i]?>"><?=$list[$i]?></a></li>
                <?php
            }
        }
        $i = $i + 1;
    }
}

?>


<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>CRUP-PHP</title>
</head>
<body>
    <h1><a href="index.php">(주)지아이씨인증원</a></h1>
<!--   Title 출력  -->
    
    <?php echo "<br><br>"; ?>
    

    <h4> <?php print_list(); ?></h4>
    
    <?php echo "<br><br>"; ?>
       
    <h3>C.R.U.D.</h3>
    <a href="create.php">Create</a>
    <?php
        if(isset($_GET['id'])){ ?>
          <a href="update.php?id=<?php echo $_GET['id']?>">Update</a>  
        <?php    
        }
        ?>
    
    
    <h2><?php print_title();?></h2> 
      
       
    <?php
     print_description();
    ?>
    <form action="create_process.php" method="get">
       <p><input type="text" name="title" placeholder="제목을 입력하세요."></p>
       <p><textarea name="description" id="" placeholder="견적내용을 입력해주세요." cols="30" rows="10"></textarea></p>
       <p><input type="submit"></p>
    </form>
</body>
</html>