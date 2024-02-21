<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>save.php</title>
</head>
<body>
    <?php
    //입력 값
    
    echo "첫 번째 파일"; print("<br><br>");
    
    echo "이름 : ".$_GET["title"];print("<br><br>");
    echo "제목 : ".$_GET["name"];print("<br><br>");
    echo "내용 :<br> ".$_GET["description"];print("<br><br>");
    
    echo "<br><br>";
    
    echo "이름 : ".$_FILES['files1']['name'];print("<br><br>");
    echo "타입 : ".$_FILES['files1']['type'];print("<br><br>");
    echo "크기 : ".$_FILES['files1']['size'];print("<br><br>");
    echo "임시이름 : ".$_FILES['files1']['tm_name'];print("<br><br>");
    echo "에러 : ".$_FILES['files1']['error'];print("<br><br>");
    
    echo "<br><br>";
    
    echo "두 번째 파일";
    
    echo "이름 : ".$_FILES['files2']['name'];print("<br><br>");
    echo "타입 : ".$_FILES['files2']['type'];print("<br><br>");
    echo "크기 : ".$_FILES['files2']['size'];print("<br><br>");
    echo "임시이름 : ".$_FILES['files2']['tm_name'];print("<br><br>");
    echo "에러 : ".$_FILES['files2']['error'];print("<br><br>");
    
    
    
    //?>
</body>
</html>