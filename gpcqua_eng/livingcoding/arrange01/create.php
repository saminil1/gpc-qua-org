<?php
   function print_title(){
    if(isset($_GET['id'])) {
                echo $_GET['id'];
                } else {
                    echo "견적 내용을 상세히 적어주세요...";
                }
}

function print_descript(){
    if(isset($_GET['id'])) {
                echo file_get_contents("data/".$_GET['id']);
            } else {
                echo "담당자가 확인 후 $name 고객님께 연락드리겠습니다.";
            }
}

function print_list(){
    $list = scandir('data');
       $i = 0;
       while($i<count($list)){  
           if($list[$i] != '.'){
               if($list[$i] != '..'){
                   ?>
<li><a href="index_20210624_01.php?id=<?=$list[$i]?>"><?=$list[$i]?></a></li>
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
    <title>GIC인증원 : 견적 받기 프로그래밍</title>
    <!--    <link href="./css.css" rel="stylesheet" type="text/css" />-->
    <style>
/*
        h4 {
            border-top-left-radius: 2em 0.5em;
            border-top-right-radius: 2em 0.5em;
            border-bottom-right-radius: 4em 0.5em;
            border-bottom-left-radius: 4em 0.5em;
        }
*/
        h4 {border-width: 5px;} /* all four borders are thin */
        h4 {border-style: double;} /* all four borders are dotted */
        h4 {border-color: darkcyan



    </style>
</head>

<body>
    <h1><a href="index_20210624_01.php">
            GIC인증원 : 견적 받기(내용입력)</a></h1>
    <ol>
        <?php
        print_list();
       ?>
    </ol>
    <hr>
    <hr>
    <h2>
        <?php print_title(); ?>
    </h2>
    <hr>
    <?php print_descript("\n"); ?>

   
 <h1>견적받기/글쓰기 페이지</h1> 
   <form action="create_process.php" method="get">
    <p><input type="text" name="title" placeholder="제목쓰기"></p>
    <p><textarea name="description" id="" placeholder="내용을 입력해주세요." cols="30" rows="10"></textarea></p>
    <p><input type="submit"></p>
   </form>

<h4></h4>
</body>

</html>
