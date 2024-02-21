<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>생활코딩5.2 PHP 문자열</title>
</head>
<body>
    <h1>(주)아이지씨인증원</h1> <br>
    <h1>목표 : PHP 기본 데이터 타입인 숫자와 문자열 과정, 각 데이터 타입의 특징과 사용</h1>
   <h2>4-5-6.php string.php 파일 생성</h2>
   <?php 
        "(주)아이지씨인증원"
    ?>
    
    <h2>echo를 이용해 출력</h2>
    <?php
        echo "(주)아이지씨인증원";
        print "<br>";//<br>이 출력되지 않고 줄바꿈됩니다. html 기능 적용합니다.
        print "ERP 개발 계획(안)";
        print "<br><br>";
    
    
        echo "<h1>제목 : '를 문자로 표현</h1>";
    
        print "<br><br>";
        echo "(주)아이지씨인증원 'ERP'개발 일정"; //'를 문자로 표현하는 방법
    
        print "<br><br>";
    
        echo "안에 가 있으면 예외 상황 발생함";
    
         print "<br><br>";
        echo "<h1>String & String Operator(역슬래시를 사용해 ''를 문자로 사용함)</h1>";
        echo "ERP \"CRM\"IGC";//역슬래시를 사용해 "를 문자로 사용함
    ?>
    
    <?php 
        $name = "(주)아이지씨인증원";
        print "<h1>php 안의 html</h1>";
        echo "<table>";
        echo "<tr>";
        echo "<td>ERP/CRM/Group Ware</td>";
        echo "<br><br>";// 불 바꿈하려는 데 결과값은 아님.
        echo "<td>".$name."</td>";//문자열과 문자열을 결합시켜는 점
        echo "</tr>";
        echo "</table>";
    ?>
    
</body>
</html>