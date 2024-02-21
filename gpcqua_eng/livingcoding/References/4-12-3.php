<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>if가 false일 때</title>
</head>
<body>
   <h1>Conditional if==> false</h1>
   <?php
        echo '1<br>';
        echo '2<br>';
        echo '3<br>';
    ?>
    
    <h2>if가 true</h2>
    <?php
        echo '1<br>';
        if(true){
            echo '2<br>';
        }
        echo '3<br>';
    ?>
    
    <h2>if가 false</h2>
    <?php
        echo '1<br>';
        if(false){
            echo '2<br>';
        }
        echo '3<br>';
    ?>
    
    <h2>if/else(true)</h2>
    <?php
        echo '1<br>';
        if(true){
            echo '2-1<br>';
    }   else {
            echo '2-2<br>';
        }
        echo "3<br>";
    ?>
    
    <h2>if/else(false)</h2>
    <?php
        echo '1<br>';
        if(false){
            echo '2-1<br>';
    }   else {
            echo '2-2<br>';
        }
        echo "3<br>";
    ?>    
</body>
</html>