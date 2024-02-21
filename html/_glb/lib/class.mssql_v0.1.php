<?php
/**
 *
 * @file class.mssql_v0.1.php
 * @author wioz
 * @version 0.1.0
 * @modified wioz  2019.09.05
 */

Class mssql {

	private 	$db;
	private 	$_mssql;

	private 	$_prefix;
	private 	$_query;
	private 	$_lastQuery;
	private 	$_join = array();
	private 	$_where = array();
	private 	$_orderBy = array();
	private 	$_groupBy = array();
	private 	$_limit = null;
	private 	$_bindParams = array('');
	private 	$_tableDatas = array();
	private 	$_stmtError;
	private 	$isSubQuery = false;
	public 		$count = 0;
	public 		$result = "";


	public function __construct($db=null,$isSubQuery=false) {
		if ($db !== null) {
			$this->db = $db;

			$this->_mssql = mssql_connect($this->db->host, $this->db->username, $this->db->password) or die("Database Connection Error"."<br>". mssql_get_last_message());

			if ( $this->_mssql ) {
				if( !mssql_select_db($this->db->database, $this->_mssql) ) {
					$this->_mssql = null;
				}

				$this->Query_normal('SET ANSI_NULLS ON');
			    $this->Query_normal('SET ANSI_WARNINGS ON');

			}
		}
	}


	public function Query_normal( $query ) {

		return mssql_query( $query,  $this->_mssql );
		//$this->rawQuery( $query );

		//return $this->getLastError() == '';
	}

	public function Query_row( $query ) {

		$ary_ret = array();

		$this->result = mssql_query( $query,  $this->_mssql );
		$rtn = mssql_fetch_row( $this->result );
		mssql_free_result( $this->result );
		$this->result = "";

		return $this-Query_iconv( $rtn );
	}

	public function Query_array( $query ) {

		$ary_ret = array();

		$this->result = mssql_query( $query,  $this->_mssql );
		$rtn = mssql_fetch_assoc( $this->result );
		mssql_free_result( $this->result );
		$this->result = "";

		return $this->Query_iconv( $rtn );
	}

	public function Query_result( $query ) {

		$ary_ret = array();

		$this->result = mssql_query( $query,  $this->_mssql );

		$ary_ret['res'] = mssql_fetch_assoc( $this->result );

		if( $ary_ret['res'] ) {
			foreach ($ary_ret['res'] as $key => $value) {

				return $this->Set_iconv( $value );
			}
		}
		return NULL;
	}

	public function Query_procedure( $c_NAME, $ary_VAR ) {

		$this->result = mssql_init('USP_AS_LOGIN', $this->_mssql );

		 foreach ($ary_VAR as $key => $value) {
		 	# code...
			mssql_bind($this->result, "@".$key, $value, SQLVARCHAR);
		 }

		$this->result = mssql_execute( $this->result );
		$rtn = mssql_fetch_assoc( $this->result );
		mssql_free_result( $this->result );
		$this->result = "";

		return $this->Query_iconv( $rtn );
	}



	public function Close() {		// DB 종료

		if( $this->_mssql ) {

			if( $this->result ) {
				mssql_free_result( $this->result );
			}
			mssql_close( $this->_mssql );
		}
	}


	public function Query_iconv($row){
		$p = array();

		if( is_array($row) )
		{
			foreach($row as $key=>$item) {
				$p[$key] = $this->Set_iconv( $item );
			}
		}
		return $p;
	}

	public function Set_iconv( $c_VAR ){
		$tmp_type = mb_detect_encoding( $c_VAR );

		if( $tmp_type == "UTF-8" ) {
			return $c_VAR;
		} else if( $tmp_type == "EUC-KR" ) {
			return iconv("UTF-8", "EUC-KR", $c_VAR);
		} else {
			return $c_VAR;
		}

	}


}

?>
