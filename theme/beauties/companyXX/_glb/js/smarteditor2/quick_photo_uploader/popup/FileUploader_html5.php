<?php
 	$sFileInfo = '';
	$headers = array();
	foreach ($_SERVER as $k => $v){

		if(substr($k, 0, 9) == "HTTP_FILE"){
			$k = substr(strtolower($k), 5);
			$headers[$k] = $v;
		}
	}

	$file = new stdClass;
	$file->name = rawurldecode($headers['file_name']);
	$file->size = $headers['file_size'];
	$file->content = file_get_contents("php://input");

	$newName = time().'_'.rand(1000,9999);

	$newPath = $_SERVER['DOCUMENT_ROOT'].'/_data/editor/'.iconv("utf-8", "cp949", $file->name);
	$newPath = $_SERVER['DOCUMENT_ROOT'].'/_data/editor/'.$newName;

	if(file_put_contents($newPath, $file->content)) {
		$sFileInfo .= "&bNewLine=true";
		$sFileInfo .= "&sFileName=".$newName;
		$sFileInfo .= "&sFileURL=/_data/editor/".$newName;
	}
	echo $sFileInfo;
 ?>
