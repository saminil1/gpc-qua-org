<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <?php
    /* 디렉토리 경로 정의 */
$dir = '../';
/* 가져올 파일의 확장자 정의 정규식 */
$ext = '/.log$/u';
/* 제외할 파일들 정의 */
$ignored = array('.', '..', '.svn', '.htaccess');
/* scandir 함수를 이용하여 리스트 가져옴 */
$scan = array_values(array_diff(scandir($dir), $ignored));
/* 파일 리스트를 임시로 담을 변수 */
$tmpFiles = array();
/* 가져온 파일을 foreach 문으로 조회 */
foreach ($scan as $item) {
    /* 가져온 파일이 검사하기 위해 파일이름에 경로를 합침 */
    $scanFile = $dir . $item;
    /* 디렉토리가 아니고 파일이 맞는치 체크 */
    if (!is_dir($scanFile)) {
        /* 확장자 매치 체크 */
        if (preg_match($ext, $item)) {
            /* 파일 이름에서 확장자 제거 */
            $name = preg_replace($ext, '', $item);
            /* filetime 함수를 이용해서 파일의 수정 날짜 추출, 그리고 tmpFiles 변수에 담기 */
            $tmpFiles[$name] = filemtime($scanFile);
        }
    }
}
/* 날짜를 기준으로 내림 차순 정렬 */
arsort($tmpFiles);
/* tmpFiles 변수의 키값만 추출 하여 files 변수에 담기 */
$files = array_keys($tmpFiles);

echo json_encode($files);

    
    ?>
</body>
</html>