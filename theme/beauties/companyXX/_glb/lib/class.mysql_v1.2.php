<?php
/**
 *
 * @file class.mysql_v1.2.php
 * @author wioz
 * @version 0.1.0
 * @modified wioz  2019.09.05
 */

Class DataBase // DB에 관련된 클래스 함수
{
	var 		$DB_Host = "127.0.0.1";
	var 		$DB_User;
	var 		$DB_Pass;
	var 		$DB_Sele;
	var 		$DB_safe = false;
	var 		$DB_chr = "utf8";
	var 		$DB_logs_dir = "";
	var 		$DB_logs_show_type = 1;		//	0. 표시안함, 1. 파일출력,  2.echo  3 <script>

	var 		$DB = "";
	var 		$result;


	function Conn( )			// DB 접속
	{
		$ary_ret = array();
		$ary_ret['code'] = 1;
		$ary_ret['msg'] = "";
		$ary_ret['res'] = "";

		for( $i=0; $i<3; $i++ )
		{
			$DB = mysql_connect($this->DB_Host,$this->DB_User,$this->DB_Pass,$this->DB_safe);

			if( $DB )
			{
				mysql_query(" SET NAMES ".$this->DB_chr." ");
				break;
			}
		}

		if($i == 3)
		{
			$ary_ret['msg'] = "DB에 접속할 수 없습니다.";
			$ary_ret['code'] = -1;

			$this->Set_Err_show( $ary_ret['msg'] );
		}
		else
		{
			if( !mysql_select_db($this->DB_Sele,$DB) )
			{
				$ary_ret['msg'] = "DB가 선택되지 않았습니다.";
				$ary_ret['code'] = -2;

				$this->Set_Err_show( $ary_ret['msg'] );
			}
			else
			{
				$this->DB = $DB;
			}
		}

		return 1;
	}

	function Query( $Query )		// 쿼리문 전송
	{
		$ary_ret = array();
		$ary_ret['code'] = 1;
		$ary_ret['msg'] = "";
		$ary_ret['res'] = "";

		if(empty($this->DB))
		{
			$ary_ret['msg'] = "데이타 베이스에 연결되어 있지 않습니다.";
			$ary_ret['code'] = -4;

			$this->Set_Err_show( $ary_ret['msg'] );
		}
		else
		{
			$ary_ret['res'] = @mysql_query($Query,$this->DB);
			if( !$ary_ret['res'] )
			{
				$ary_ret['msg'] = "퀴리문 오류.";
				$ary_ret['code'] = -11;

				$this->Set_Err_show( $ary_ret['msg'] );
			}
		}

		return $ary_ret['res'];
	}

	function Query_row( $Query )		// 쿼리문 전송
	{
		$ary_ret = array();

		$ary_ret['code'] = 1;
		$ary_ret['msg'] = "";
		$ary_ret['res'] = "";

		if(empty($this->DB))
		{
			$ary_ret['msg'] = "데이타 베이스에 연결되어 있지 않습니다.";
			$ary_ret['code'] = -4;

			$this->Set_Err_show( $ary_ret['msg'] );
		}
		else
		{
			$this->result = @mysql_query($Query, $this->DB);
			if( !$this->result )
			{
				$ary_ret['msg'] = "퀴리문 오류.";
				$ary_ret['code'] = -11;

				$this->Set_Err_show( $ary_ret['msg'] );
			}
			else
			{
				$ary_ret['res'] = @mysql_fetch_row($this->result);
			}
		}

		return $ary_ret['res'];
	}

	function Query_array( $Query )		// 쿼리문 전송
	{
		$ary_ret = array();

		$ary_ret['code'] = 1;
		$ary_ret['msg'] = "";
		$ary_ret['res'] = "";

		if(empty($this->DB))
		{
			$ary_ret['msg'] = "데이타 베이스에 연결되어 있지 않습니다.";
			$ary_ret['code'] = -4;

			$this->Set_Err_show( $ary_ret['msg'] );
		}
		else
		{
			$this->result = @mysql_query($Query, $this->DB);
			if( !$this->result )
			{
				$ary_ret['msg'] = "퀴리문 오류.";
				$ary_ret['code'] = -12;

				$this->Set_Err_show( $ary_ret['msg'] );
			}
			else
			{
				$ary_ret['res'] = @mysql_fetch_array($this->result);
			}
		}

		return $ary_ret['res'];
	}

	function Query_result( $Query )	// 결과 출력
	{
		$ary_ret = array();

		$ary_ret['code'] = 1;
		$ary_ret['msg'] = "";
		$ary_ret['res'] = "";

		if(empty($this->DB))
		{
			$ary_ret['msg'] = "데이타 베이스에 연결되어 있지 않습니다.";
			$ary_ret['code'] = -4;

			$this->Set_Err_show( $ary_ret['msg'] );
		}
		else
		{
			$this->result = @mysql_query($Query, $this->DB);
			if( !$this->result )
			{
				$ary_ret['msg'] = "퀴리문 오류.";
				$ary_ret['code'] = -11;

				$this->Set_Err_show( $ary_ret['msg'] );
			}
			else
			{
				$ary_ret['res'] = @mysql_fetch_row($this->result);
			}
		}

		return $ary_ret['res'][0];
	}

	function Get_insert_id()	// 마지막 번호
	{
		$ary_ret = array();

		$ary_ret['code'] = 1;
		$ary_ret['msg'] = "";

		$ary_ret['res'] = @mysql_insert_id($this->DB);
		if( !$ary_ret['res'] ) $ary_ret['res'] = 0;

		return $ary_ret['res'];
	}

	function Set_Err_show( $msg )		// 메세지 출력
	{
		$c_MSG = $msg." : ( ".mysql_error()." ) ";

		if( $DB_logs_show_type == 0 )
		{
			//	콘솔에서 사용할때 주로.씀..
			//exit;
		}
		else if( $DB_logs_show_type == 1 )
		{
			if( !$this->DB_logs_dir )
			{
				$Fname = basename(__FILE__);
				$fullpath = realpath(__FILE__);
				$this->DB_logs_dir = eregi_replace( $Fname, "", $fullpath );
			}

			$m_log_dir = $this->DB_logs_dir."logs/";

			if(!file_exists($m_log_dir)) mkdir( $m_log_dir );

			error_log( date("YmdGis")." : ".$c_MSG.PHP_EOL,3, $m_log_dir."/Mysql_".date("Ymd").".log" );
			exit;
		}
		else if( $DB_logs_show_type == 2 )
		{
			echo $c_MSG;
			exit;
		}
		else if( $DB_logs_show_type == 3 )
		{
			echo "<script> alert('".addslashes($c_MSG)."'); </script>";
			exit;
		}
		return;
	}

	function Close()		// DB 종료
	{
		if( $this->DB )
		{
			mysql_close($this->DB);
		}
	}
}
?>
