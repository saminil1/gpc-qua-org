<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>if, else 조건문의 문법, 사용</title>
</head>
<body>
   <h2>Conditional 01</h2>
    <?php 
        echo '1<br>';
        echo '2<br>';
        echo '3<br>';
    ?>
    
    <h2>if가 true일 때,</h2>
    <?php 
    echo '1<br>';
    if(true){
        echo '2<br>';
    }
    echo '3<br>';
    ?>
    
    <h2>if가 false일 때.</h2>
    <?php 
        echo '1<br>';
        if(false){
            echo '2<br>';
        }
        echo '3<br>';
    ?>
    
    
    <h2>if/else, true</h2>
    <?php 
        echo '1<br>';
        if(true){
            echo "2-1<br>";
        } else {
            echo '2-2<br>';
        }
        echo "3<br>";
    
    ?>
    
    <h2>if/else, false</h2>
    <?php 
        echo '1<br>';
        if(false){
            echo '2-1<br>';
        } else {
            echo '2-2<br>';
        }
        echo "3<br>";
    
    ?>
    
    
    
    
</body>
</html>