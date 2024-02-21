
<?php
//타이틀 출력
function print_title(){
    if(isset($_GET['id'])){
        echo $_GET['id'];
    } else {
        echo "<h1>Welcome, 제목이 없습니다.</h1>";
    }
}



//본문 출력
function print_description(){
    if(isset($_GET['id'])){
        echo file_get_contents('data/'.$_GET['id']);
    } else {
        echo "<h1>Hello, 내용이 없습니다.</h1>";
    }
}


//파일 목록 출력
function print_list(){
    $list = scandir('data');
    $i=0;
    while($i<count($list)){
        if($list[$i] !='.'){
            if($list[$i] !='..'){
                ?>
        <li><a href="index.php?id=<?php echo $list[$i]?>"><?php echo $list[$i]?></a></li>
                <?php
            }
        }
        $i = $i + 1;
    }
    
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Index.php</title>
    <link rel="stylesheet" href="css.inic.css">

</head>
<body>
 
 <h2><a href="index.php"> Titl(id)</a></h2>
 

 <hr>첫 번째 Code:<br>
  <?php
    print_title();
  ?>
    
    <hr><hr>
   <br><br><p></p>
   
  <?php
    print_description();
  ?>
  
  <?php 
    print("<hr>");
    echo "세번째 Code:";

    print("<h3>data 폴더 파일 목록검색 결과</h3>");
    
    print("<p></p>");
    
    //파일 목록
   print_list();
   ?>
   <hr>
   <h2>게시판 글쓰기</h2>
   <form action="create.php" method="get">
     <div class="counsel">
        <p><label for="useCompnay">회사: </label><input type="text" name="useCompnay" placeholder="회사명" id="useCompnay" class="input_text" cols="23" /></p>
        <p><label for="useEmail">메일: </label><input type="text" name="useEmail" placeholder="이메일" id="useEmail" class="input_text" cols="23" /></p>
        <p><label for="usePhone">전화: </label><input type="text" name="usePhone" placeholder="전화 번호" id="usePhone" class="input_text" cols="23" /></p>
        <p><label for="useId">제목: </label><input type="text" name="useId" placeholder="제목 입력" id="useId" class="input_text" cols="23" /></p>
        <p><label for="useContent">내용 : </label><textarea name="useContent" placeholder="내용 입력" id="useContent" cols="50" rows="10" class="input_text"></textarea></p>
        <p><input type="submit" value="글쓰기"></p>
     </div>
   </form>
</body>
</html>