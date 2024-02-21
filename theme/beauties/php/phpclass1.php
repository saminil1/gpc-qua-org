<?php
include_once('./_common.php');
$g5['title'] = '등록 신청';
include_once(G5_THEME_PATH.'/head.php');
add_javascript(G5_POSTCODE_JS, 0);    //다음 주소 js
add_javascript('<script src="'.G5_JS_URL.'/apply.js?ver='.time().'"></script>', 0);
?>
<style>
    table, th {
    color:#fff;
        margin : 5px;
    }

    tr{
        margin : 10px;
    }
    h1 {
        font-size : 3em;
    }
    h3{
        font-size : 1.3em;
        color:blueviolet;
    }

    hr{
        border:3px;
        color:#878787;
        width:100%;
    }
</style>

<hr border="1">
<h1>본문 내용이 들어갈 영역입니다.</h1>
<br>
<?php
echo "<hr style='border:1px solid#878787; height: 1px !important; display: block !important; width: 100% !important;'/>";
?>

<?php
$num1 = 10;
$num2 = 20;
$sum = $num1 + $num2;
echo "<br><hr>";
echo "$sum";
echo "<br><br><hr>";
?>

<font size="5" color="blue" face="굴림체">
<?php
    echo "규격을 추가하셔야 합니다.";
?>
</font><br><br><br>

<?php
    $kor=80;
    $eng=70;
    $math=90;
    $iso9001=3.14;
    $iso27001="개인정보보안경영시스템";

    $sum=$kor+$eng+$math;
    $avg=$sum/3;
    echo "<br>======= 변수 데이터 타입은 gettype()<br>\n";
    echo gettype($eng);
    echo "<br>";
    echo gettype($kor);
    print "<br>";
    echo gettype($iso9001);
    print "<br><br>\n";
    echo gettype($iso27001);
?>
<br><br><br>

<?php
echo "<h1>문자열 안에서의 변수 해석</h1>";
    echo "===========================<br>";
    $name = "(주)지피씨인증원";
    $tel = "010-2299-5655";
    $address ="서울특별시 금천구 서부샛길 638 대륭테크노타운7차 402-1";

    echo "<h3>안녕하세요, 저희는 $name 입니다. 전화번호는 $tel 이며, 주소는 $address 입니다. </h3><br><br>\n ";

?>
<br><br>
<table border="1" bordercolor="red" width="500px" bgcolor="#007777">
    <tr><th>과목1</th><th>과목2</th><th>과목3</th></tr>
    <tr><td>규격7 : <? echo "$kor";?></td><td>규격1 : <? echo "$kor";?></td><td>규격4 : <? echo "$kor";?></td></tr>
    <tr><td>규격8 : <? echo "$eng";?></td><td>규격2 : <? echo "$kor";?></td><td>규격5 : <? echo "$kor";?></td></tr>
    <tr><td>규격9 : <? echo "$math";?></td><td>귝격3 : <? echo "$kor";?></td><td>규격6 : <? echo "$kor";?></td></tr>
    <tr><td>총점 : <? echo "$sum";?></td><td>총점 : <? echo "$kor";?></td><td>총점 : <? echo "$kor";?></td></tr>
    <tr><td>평균 : <? echo "$avg";?></td><td>평균 : <? echo "$kor";?></td><td>평균 : <? echo "$kor";?></td></tr>

</table>
<?php echo "<br><br>"; ?>
<?php echo "<hr style='border:1px solid#878787; height: 1px !important; display: block !important; width: 100% !important;'/>"; ?>
<br>
<?php echo "<hr style='border:1px solid#878787; height: 1px !important; display: block !important; width: 100% !important;'/>"; ?>
<h2>테이블 영역</h2>
<br>
<table border="1" bordercolor="red" width="500px" bgcolor="#007777">
    <tr>
        <td>0001</td><td>0002</td><td>0003</td><td>0004</td><td>0005</td>
    </tr>
    <tr>
        <td>0001</td><td>0002</td><td>0003</td><td>0004</td><td>0005</td>
    </tr>
    <tr>
        <td>0001</td><td>0002</td><td>0003</td><td>0004</td><td>0005</td>
    </tr>
    <tr>
        <td>0001</td><td>0002</td><td>0003</td><td>0004</td><td>0005</td>
    </tr>
</table>
<hr>
<?php echo "<hr style='border:1px solid#878787; height: 1px !important; display: block !important; width: 100% !important;'/>"; ?>
<br>
<?php echo "<hr style='border:1px solid#878787; height: 1px !important; display: block !important; width: 100% !important;'/>"; ?>
<?php
    echo "<h1><b>비트, 문자열 혼합연산</b></h1>\n";
    echo "======================<br>";
    $a=5;
    $a +=3;
    $c = "고객님께서는";
    $c .="인증신청 접수하신 지 약";
    $d = $a >> 3;

    echo "$c $d 시간째 입니다.";
?>

<hr>
<?php echo "<hr style='border:1px solid#878787; height: 1px !important; display: block !important; width: 100% !important;'/>"; ?>
<br>
<?php echo "<hr style='border:1px solid#878787; height: 1px !important; display: block !important; width: 100% !important;'/>"; ?>

<?php
    echo "<h1>PHP제어문</h1><br>";
    echo "<h2>순차적이 아닌, 어떤 조건에 따라 명령을 처리할 때 사용함</h2>";
    echo "<h3>if문, switch문</h3>";
$a = 3;
if($a == 0){
    echo "변수 a는 숫자 0 <b> case 0: 변환</b><br>";
}elseif($a == 1){
    echo "변수 a는 숫자 1 <b> case 1: 변환</b><br>";
}elseif($a == 2){
    echo "변수 a는 숫자 2 <b> case 2: 변환</b><br>";
}elseif($a == 3){
    echo "변수 a는 숫자 3 <b> case 3: 변환</b><br>";
}else{
    echo "변수 a = {$a}는 0, 1, 2, 3 이회의 숫자...<br>";
}
?>

<br><br>
<?php echo "<hr style='border:1px solid#878787; height: 1px !important; display: block !important; width: 100% !important;'/>"; ?>
<br>
<?php echo "<hr style='border:1px solid#878787; height: 1px !important; display: block !important; width: 100% !important;'/>"; ?>

<?php
    echo "<h1><b>♣변수 a = 3을 선언, switch문으로 대체 가능함</h1><br>";

    $a = 3;
    switch($a){
        case 0:
            echo "변수 a는 숫자 0 <b> case 0 : 적용 <b><br>";
            break;
        case 1:
            echo "변수 a는 숫자 1 <b> case 1 : 적용 <b><br>";
            break;
        case 2 :
            echo "변수 a는 숫자 2 <b> case 2 : 적용 <b><br>";
            break;
        case 3 :
            echo "변수 a는 숫자 3 <b> case 3 : 적용 <b><br>";
            break;
        default:
            echo "변수 a = {$a}는 0, 1, 2, 3 이외의 숫자 ...<br>";
    }
?>

<br><br>
<?php echo "<hr style='border:1px solid#878787; height: 1px !important; display: block !important; width: 100% !important;'/>"; ?>
<br>
<?php echo "<hr style='border:1px solid#878787; height: 1px !important; display: block !important; width: 100% !important;'/>"; ?>
<?php
    echo "<h1><b>반복문</h1></b><br>\n";
    echo "<h3><b>▣ 1부터 10까지 for 반복문 이용하여 누적 합계 구하기</b><br>";
    echo "================================<br>";

    $sum = 0;// 누적 합 저장 변수
    for ($a = 1; $a <= 10; ++$a ){
        $sum += $a; //$sum = $sum + $a
        echo "{$a}까지 누적합계 = {$sum} ({$a})<br><br>";
    }


?>

<?php
include_once(G5_THEME_PATH.'/tail.php');
?>
