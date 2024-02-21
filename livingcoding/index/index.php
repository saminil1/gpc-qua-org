<?php
   function print_title(){
    if(isset($_GET['id'])) {//isset()함수 : 해당 변수에 값이 존재하는 지(null값인지) 채크함, null과 그 외 값으로 구분한다. SET상태인 값이 true 아닌 값(null) 값은 false를 리턴한다.
                echo $_GET['id'];
                } else {
                    echo "인증서검색: 올바른 인증서 번호를 입력해주세요.";
                }
}

function print_descript(){
    if(isset($_GET['id'])) {
                echo file_get_contents("data/".$_GET['id']);
            } else {
                echo "인증서 목록이 없습니다. 먼저 인증서 목록을 확인해주시기 바랍니다.";
            }
}

function print_list(){
    $list = scandir('data');
       $i = 0;
       while($i<count($list)){  
           if($list[$i] != '.'){
               if($list[$i] != '..'){
                   ?>
                   <li><a href="index.php?id=<?=$list[$i]?>"><?=$list[$i]?></a></li>
                   <?php
               }
           }
           $i = $i + 1;
       }    
}


function copy_file01(){
    $file = 'data/IGC.html';
        $newfile = 'data/IGC.html.bak';
        if(!copy($file,$newfile)){
            echo "$file 복사를 하지 못하였습니다...\n";
        }
    
}

?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>01.목록생성 애플리케이션</title>
    <link href="./css.css" rel="stylesheet" type="text/css" />
</head>
<body>
   <h1><a href="index.php">(주)지아이씨인증원|관리자 페이지 리뉴얼</a></h1>
   <ol>
       <?php
        print_list();
       ?>
   </ol>
                  <hr> <hr>
           <h2>
            <?php
                print_title();
            ?>
        </h2>
        <hr>
        <?php
            print_descript("\n");
        ?>
   
    <hr>
    파일을 복사합니다.!!@!
    <hr>
    
    
    

    <?php
        copy_file01();
    ?>
          
<hr>
    ISO 9001:2015 품질경영시스템 인증/텍스트로 만들어진 파일을 읽을 때 사용합니다.
<hr> 
    <?php
        $GIC_homepage =  "http://gicert.cafe24.com/theme/gicert/service/01_system.php";
        
        $return_page = file_get_contents($GIC_homepage);
        echo $return_page;

    ?>
   
<hr>
    파일 추가 01
<hr>  
  <?php
    $file = './data/write06.txt';//기존 컨텐츠를 가져오기 위해 파일을 연다.
    $current = file_get_contents($file);
    $current .= "(주)지아씨인증원 웹사이트 관리자 페이지 \n";//파일에 새로운 내용을 추가한다.
        file_put_contents($file, $current);  //내용을 다시 파일에 기록한다.
  ?>
   //파일을 생성할 때 사용하는 로직임
   //$current 파일 내용을 $file에 전달한다.
   //코드에서는 write06.txt 파일 내용에    (주)지아씨인증원 웹사이트 관리자 페이지 \n을 추가하여 변수에 넣겠다는 내용이다.
        
<hr>
    파일 추가02
<hr>
    <?php
        $file = './data/write04.txt';
        file_put_contents($file, 'ISO 9001:2015 품질경영시스템 인증,ISO 9001:2015 품질경영시스템 인증,ISO 9001:2015 품질경영시스템 인증,ISO 9001:2015 품질경영시스템 인증');
    ?>
    
    
<hr>
 php 폴더(folder) 다루기/현재 작업 중인 디텍토리  경로를 얻어온다.
<hr>
   <?php
        echo getcwd()."<br>";
        chdir('./data');//현재 디렉토리 변경하기==> 현재 디렉터리에 'tmp'가 있다면, [chdir('./tmp')]
        echo getcwd().'<br>';
    ?>
    
    
    
<hr>
 <p>해당 폴더에 있는 파일&폴더를 보여준다. 두 번째 인자는 출력될 정렬방식이다.</p>
 <p>scandir()함수를 사용할 경우, print_r()함수를 활용하여 배열로 출력되는 확인이 가능하다.</p>
<hr>
   <?php
        $dir = '../data';
        $files1 = scandir($dir);
        $files2 = scandir($dir, 1);
        print_r($files1).'<br>';
        print_r($files2).'<br>';
    ?>
    
    <br><br>
    
</body>
</html>