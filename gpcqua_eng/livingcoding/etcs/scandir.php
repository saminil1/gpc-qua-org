<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <h2>
     Directory(Folder) 안에 있는 파일 목록들을 가져오는 알고리즘
    </h2>
     
     <p>https://junny1909.tistory.com/333</p>
     
     
<?php

//1.디렉토리 경로 정의
$dir = 'data';
 
//2.가져올 파일의 확장자 정의 정규식
//$ext = '/.log$/u';
 
//3.제외할 파일 정의
//$ignored = array('.', '..', '.svn', '.htaccess');
 
//4.scandir 함수를 이용하여 목록을 가져옴
$scan = array_values(array_diff(scandir($dir), $ignored));
 
//5.파일 목록을 임시로 담을 수 있는 변수
$tmpFiles = array();
 
//6.가져온 파일들을 foreach문으로 조회
foreach ($scan as $item){

//가져온 파일을 검사하기 위해 파일이름에 경로를 합침
$scanFile = $dir . $item;

//디렉토리가 아니고 파일이 맞는 지 체크함
      if(!is_dir($scanFile)){

 	//확장자 맞는지 체크함
 	if(preg_match($ext, $item)){

    	//파일 이름에서 확장자 제거함
   	$name = preg_replace($ext, '', $item);

    	//filetime 함수를 사용하여 파일의 수정 날짜 추출, 그리고 tmpFiles 변수에 담는다.
   	$tmpFiles[$name] = filetime($scanFile);

 	}
   }
}
//7.날짜를 기준으로 내림 차순 정렬
arsort($tmpFiles);
 
//8.tmpFiles 변수의 키값만 추출하여 files 변수에 담기
$files = array_keys($tmpFiles);
 
echo json_encode($files);
    
?>
      
</body>
</html>




