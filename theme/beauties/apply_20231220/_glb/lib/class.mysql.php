<?php
/**
 *
 * @file class.mysql.php
 * @author wioz
 * @version 0.1.0
 * @modified wioz  2019.09.05
 */

Class DataBase // DB에 관련된 클래스 함수
{
	var $DBHost;
	var $DBUser;
	var $DBPass;
	var $DBSele;
	var $DB = "";
	var $result;
	//var $DBchr = "euckr";
	var $DBchr = "utf8";
	var $DB_safe = false;


	function Conn( )			// DB 접속
	{
		for($i=0;$i<3;$i++)
		{
			$DB = mysql_connect($this->DBHost,$this->DBUser,$this->DBPass,$this->DB_safe);
			if(!$DB)	$this->PrintM("DB에 접속할 수 없습니다.");
			else 		break;

		}

		mysql_query(" SET NAMES $this->DBchr ");
		//mysql_query(" set session character_set_connection = $this->DBchr ");
		//mysql_query(" set session character_set_results = $this->DBchr ");
		//mysql_query(" set session character_set_client = $this->DBchr ");

		if($i == 3)
		{
			$this->PrintM("DB에 접속할 수 없습니다.");
		} else {
			if(!mysql_select_db($this->DBSele,$DB))
			{
					$this->PrintM("DB가 선택되지 않았습니다.");
					exit;
			}
			$this->DB = $DB;
		}
		return true;
	}

	function Query($Query,$src="")		// 쿼리문 전송
	{
		if(empty($this->DB))
		{
			$this->PrintM(" 데이타 베이스에 연결되어 있지 않습니다. ");
			exit;
		}
		$Result = @mysql_query($Query,$this->DB) or $this->PrintM("퀴리문 오류",$src);
		return $Result;
	}

	function Query_row($Query,$src="")		// 쿼리문 전송
	{
		if(empty($this->DB))
		{
			$this->PrintM(" 데이타 베이스에 연결되어 있지 않습니다. ");
			exit;
		}
		$this->result = @mysql_query($Query,$this->DB) or $this->PrintM("퀴리문 오류",$src);
		$Result = @mysql_fetch_row($this->result);
		return $Result;
	}

	function Query_array($Query,$src="")		// 쿼리문 전송
	{
		if(empty($this->DB))
		{
			$this->PrintM(" 데이타 베이스에 연결되어 있지 않습니다. ");
			exit;
		}
		$this->result = @mysql_query($Query,$this->DB) or $this->PrintM("퀴리문 오류",$src);
		$Result = @mysql_fetch_array($this->result);
		return $Result;
	}

	function Query_result($Query,$src="")	// 결과 출력
	{
		$this->result = $this->Query($Query,$src);
		$Result = @mysql_fetch_row($this->result);
		return $Result[0];
	}

	function Get_insert_id()	// 마지막 번호
	{
		$Result = @mysql_insert_id($this->DB);
		if( !$Result ) $Result = 0;
		return $Result;
	}




	function PrintM($msg,$src="")		// 메세지 출력
	{
		if(!$msg)
		{
			$msg = mysql_error();
			$msg1 = $msg;
		}
		else if( $msg == "퀴리문 오류" );
		{
			$chk_msg = 1;
			$msg1 = mysql_error();
		}

		if($msg)
		{
			$path_parts = pathinfo($_SERVER[PHP_SELF]);
			$tmp_page_name = $path_parts[basename];

			$msg = addslashes($msg1);
			echo "<script> alert('$msg'); </script>";
			exit;
		}
		return;
	}

	function Close()		// DB 종료
	{
		mysql_close($this->DB);
	}
}
?>
