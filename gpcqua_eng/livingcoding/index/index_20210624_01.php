<?php
   function print_title(){
    if(isset($_GET['id'])) {
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
    <title><? print_title(); ?></title>
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
            <? print_title(); ?></a></h1>
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
    <?php
            print_descript("\n");
        ?>
<h1><a href="create.php">Create</a></h1>
    <hr>
    <p> 1)Parameter:매개변수===>함수를 호출할 때 인수로 전달된 값을 함수 내부에서 사용할 수 있게 해주는 변수=인수로 전달받은 값을 함수에서 사용하기 위해 사용합니다. 함수는 여러 개의 매개변수를 가질 수 있으며, 쉼표(,)를 사용하여 구분합니다.</p>
    <p> 2)Arguement:인수===>함수가 호출될 때 함수로 값을 전달해주는 변수</p>
    <p> 3)대부분의 함수는 하나 이상의 매개변수를 가지며, 매개변수가 없는 함수도 존재합니다.</p>
    <p>4)http://tcpschool.com/php/php_function_parameter</p>
    <hr>
    <?php
    function basic(){
        print("Lorem ipsum dolorl01<br>");
        print("Lorem ipsum dolorl02<br>"); 
    }
    basic();
    basic();
    basic();
?>

    <h2>parameter(매개변수) & arguement(인자)</h2>
    <?php
  function sum($left, $right){
//    print($left/$right);
      print($left*$right);
      print('<br>');
  }  
$sum = sum(2,4);//함수 sum()을 호출하면서, 인수로 2와 4를 전달함.  함수의 호출이 끝난 뒤에는, 반환값을 변수 $sum에 대입함.
$sum = sum(4,6);
    //위의 예제에서 인수(argument)로 전달된 숫자 1과 2는 함수에서 정의된 매개변수(parameter) x와 y에 각각 대입됩니다. 따라서 호출된 함수의 내부에서는 매개변수 x와 y로 해당 값을 사용할 수 있습니다.
?>
    
    
<h4>함수의 값 반환</h4>
<?php
 function sum1($x, $y){//함수의 이름은 sum1()이며, 변수 x, y를 매개변수로 가지는 함수를 정의함.
   return $x + $y;//매개변수 x, y를 더한 값을 반환함.
   
   }   
   
echo sum1(1,2);//sum1() 함수에 숫자 1와 2을 인수로 전달하여 호출함.
    
print("<br>");
echo "<br>";
print("약한 강도로 함수의 반환 타입을 설정");  
print("<br>");
echo "PHP 7부터는 함수의 반환값을 원하는 타입으로 반환받을 수 있도록, 반환값의 타입을 직접 지정할 수 있습니다.
또한, 반환값의 타입을 지정할 때 그 강도도 설정할 수 있습니다. 기본값인 약한 강도에서는 타입이 일치하지 않으면, 자동 타입 변환을 통해 명시된 타입으로 변환된 반환값을 반환합니다. 하지만 강한 강도에서는 반환값의 타입이 일치하지 않으면, 오류를 발생시킵니다.";
print("<br><br>");
function sum2($x, $y):float{//반환값의 타입을 float 타입으로 설정함.
    return $x + $y;
    }
    var_dump(sum2(3+4));  
    
    
?>
 <h4>return : LivingCoding</h4>
<?php
 function sum3($left, $right){
   return $left*$right;
   }
   print(sum3(2,4));
   file_put_contents('result.txt', sum3(2,4));     
?>


<h4></h4>
</body>

</html>
