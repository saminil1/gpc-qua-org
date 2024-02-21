<?php
/**
 *
 * @file class.fileup.php
 * @author wioz
 * @version 0.1.0
 * @modified wioz  2019.09.05
 */

// # 파일 업로드 클래스
class upload
{
	var $file; // ' 업로드 파일
	var $upload_path; // ' 파일을 저장할 경로
	var $file_size; // ' 파일 크기
	var $file_name; // ' 파일의 이름
	var $file_front_name; // ' 확장명을 제외한 이름
	var $file_ext_name; // ' 파일의 확장자
	var $imgname;
	var $save_file_name;


	// # 클래스 초기화
	// ' $up_file : 업로드 파일
	// ' $up_file_name : 업로드 파일의 이름
	// ' $up_file_size : 업로드 파일의 크기
	// ' $up_save_path : 업로드할 경로

	function init($up_file, $up_file_name, $up_file_size )
	{
		$this->file = $up_file;
		//$this->upload_path = $up_save_path;
		$this->file_name = $up_file_name;
		$this->file_size = $up_file_size;
		// ' 파일의 확장자와 이름을 구분한다.
		$this->file_front_name = $this->cutFileName("name"); // ' 확장자를 제외한 이름
		$this->file_ext_name = $this->cutFileName("ext"); // ' 파일의 확장자
	}

	// # 파일 이름 구분 함수
	// ' $mode="ext" : 확장자명을 반환해 준다.
	// ' $mode="name" : 확장자를 제외한 이름을 반환해준다.
	function cutFileName($mode)
	{
		//$len = strlen($this->file_name);
		//$dot = strpos($this->file_name,".");

		$ext = explode(".",$this->file_name);
		$ext_size = sizeof($ext)-1;

		if($mode == "ext"){
			//return substr($this->file_name,$dot+1,$len);
			return $ext[$ext_size];
		}
		else if($mode == "name"){
			//return substr($this->file_name,0,$dot);
			return str_replace( ".".$ext[$ext_size], "", $this->file_name );
		}
	}

	// # 파일의 크기를 제한하는 함수
	// ' $limit_size : 제한할 크기(1024*2000 = 2MB)
	function limitSize($limit_size)
	{
		if($this->file_size > $limit_size)
		{
			return false;
		}
		else
		{
			return true;
		}
	}

	// # 확장자 제한 함수
	// ' $exmode="normal" : 프로그램 파일 업로드 금지때
	// ' $exmode="img" : 이미지만 업로드 시킬때
	function limitExt($exmode)
	{
		if($exmode == "normal")
		{
			if( preg_match('/\.php/i', $this->file_name ) ||
				preg_match('/\.shtml/i', $this->file_name ) ||
				preg_match('/\.html/i', $this->file_name ) ||
				preg_match('/\.htm/i', $this->file_name ) ||
				preg_match('/\.cgi/i', $this->file_name ) ||
				preg_match('/\.igz/i', $this->file_name ) ||
				preg_match('/\.inc/i', $this->file_name ) ||
				preg_match('/\.class/i', $this->file_name )  )
			{
				return false;
			}
			else
			{
				return true;
			}
		}
		else if($exmode == "zip")
		{
			if( $this->file_ext_name == "zip" ||
			    $this->file_ext_name == "tar")
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else if($exmode == "img")
		{
			if( strtolower($this->file_ext_name) == "gif" ||
			    strtolower($this->file_ext_name) == "jpg" ||
			    strtolower($this->file_ext_name) == "jpeg" ||
			    strtolower($this->file_ext_name) == "png" ||
			    strtolower($this->file_ext_name) == "wbmp" ||
				strtolower($this->file_ext_name) == "mmg" ||
				strtolower($this->file_ext_name) == "webp" ||
			    strtolower($this->file_ext_name) == "bmp")
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	}

	// ' 파일 중복 체크후 새로운 이름 반환 함수
	// ' $smode = "d" : "날짜형으로 파일이름 반환
	// ' $smode = "c" : "파일이름_숫자"형으로 파일이름 반환
	function getSaveName($smode)
	{
		if($smode == "d")
		{
			//$date = getdate();
			//$str_name = $date['year'].$date['month'].$date['mday'].$date['hours'].$date['minutes'].$date['seconds'].".".$this->file_ext_name;
			$str_name = date('Y-m-d_Hi').rand(0, 99).".".$this->file_ext_name;
		}
		else if($smode == "c")
		{
			$i = 1;
			$str_name = $this->file_name;
			while(file_exists($this->upload_path.$str_name))
			{
				$str_name = $this->file_front_name."_".$i.".".$this->file_ext_name;
				$i++;
			}
		}
		else if($smode == "e")
		{
			$i = 1;
			$str_name = $this->file_name;
		}
		else if($smode == "f")
		{
			$i = 1;
			$str_name = $this->imgname;
		}

		$this->save_file_name = $str_name;
		return $str_name;
	}

	// # 파일 저장 함수
	// ' $save_file_name: 저장할 이름
	function fileSave()
	{
		// if(!move_uploaded_file($this->file,$this->upload_path.$this->save_file_name))
		if(!move_uploaded_file($this->file,$this->upload_path.$this->save_file_name))
		{
			return false;
		}
		// unlink($this->file);
		return true;
	}
}

?>
