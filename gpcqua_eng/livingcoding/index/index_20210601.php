<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title></title>
    </head>
    <body>
        <h1><a href="index.html">WEB</a></h1>
        <ol>
            <?php
                $list = scandir('./data');
                $i = 0;
                while($i < count($list)) {
                    if($list[$i] != '.') {
                        if($list[$i] != '..') {
                            ?>
                            <li><a href=\"index.php?id=<?=$list[$i]?>"><?=$list[$i]?></a></li>
                            <?php
                        }
                    }
                    $i = $i + 1;
                }
            ?>
       </ol>
       <h2>HTML이란 무엇인가?</h2>
       <p>PHP is a popular general-purpose scripting language that is especially suited to web development. Fast, flexible and pragmatic, PHP powers everything from your blog to the most popular websites in the world.</p>
   </body>
</html>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title></title>
    </head>
    <body>
        <h1><a href="index.php">WEB</a></h1>
        <ol>
            <?php
                $list = scandir('data');
                $i = 0;
                while($i < count($list)) {
                    if($list[$i] != '.') {
                        if($list[$i] != '..') {
                            ?>
                            <li><a href="index.php?id=<?=$list[$i]?>"><?=$list[$i]?></a></li>
                            <?php
                        }
                    }
                    $i = $i + 1;
                }
            ?>
        </ol>
        <h2>
            <?php
                if(isset($_GET['id'])) {
                    echo $_GET['id'];
                } else {
                    echo "Welcome";
                }
            ?>
        </h2>
        <?php
            if(isset($_GET['id'])) {
                echo file_get_contents("data/".$_GET['id']);
            } else {
                echo "Hello, PHP";
            }
        ?>
    </body>
</html>