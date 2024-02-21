<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>Test01.html</title>
</head>
<body>
    <?php
        $homepage = file_get_contents('https://gicert.ortg');
        echo $homepage;

    ?>
</body>
</html>