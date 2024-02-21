<?php
/**
 * This file is part of Moimz Tools - https://www.moimz.com
 *
 * @file class.mysql_byarzz.php
 * @author Arzz
 * @version 1.1.5
 * @license MIT License
 */
class mysql {
	private $db;
	private $_mysqli;
	private $_prefix;
	private $_query;
	private $_lastQuery;
	private $_join = array();
	private $_where = array();
	private $_orderBy = array();
	private $_groupBy = array();
	private $_limit = null;
	private $_bindParams = array('');
	private $_tableDatas = array();
	private $_stmtError;
	private $isSubQuery = false;
	public 		$count = 0;
	public 		$result = "";


	public function __construct($db=null,$isSubQuery=false) {
		if ($db !== null) {
			$this->db = $db;
			if (isset($this->db->port) == false) $this->db->port = 3306;
			if (isset($this->db->charset) == false) $this->db->charset = 'utf8';
			$this->isSubQuery = $isSubQuery;
			$this->_mysqli = new mysqli($this->db->host,$this->db->username,$this->db->password,$this->db->database,$this->db->port) or $this->error('There was a problem connecting to the database');
			$this->_mysqli->set_charset($this->db->charset);
		}
	}

	public function check($db) {
		if (isset($db->port) == false) $db->port = 3306;
		$mysqli = @new mysqli($db->host,$db->username,$db->password,$db->database,$db->port);
		if ($mysqli->connect_errno) return false;
		return true;
	}

	function setPrefix($prefix) {
		$this->_prefix = $prefix;
		return $this;
	}

	function error($msg,$query='') {
		die($msg.'<br>'.$query);
	}

	private function reset() {
		$this->_where = array();
		$this->_join = array();
		$this->_orderBy = array();
		$this->_groupBy = array();
		$this->_limit = null;
		$this->_bindParams = array('');
		$this->_tableDatas = array();
		$this->_query = null;
		$this->count = 0;
	}

	public function rawQuery($query,$bindParams=null,$sanitize=true) {
		$this->_query = $query;
		if ($sanitize) $this->_query = filter_var($query,FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES);
		$stmt = $this->_prepareQuery();
		if (is_array($bindParams) === true) {
			$params = array('');
			foreach($bindParams as $prop=>$val) {
				$params[0].= $this->_determineType($val);
				array_push($params,$bindParams[$prop]);
			}
			call_user_func_array(array($stmt,'bind_param'),$this->refValues($params));
		}
		$stmt->execute();
		$this->_stmtError = $stmt->error;
		$this->reset();
		return $this->_dynamicBindResults($stmt);
	}

	public function query($query) {
		$this->_query = filter_var($query,FILTER_SANITIZE_STRING);
		$stmt = $this->_buildQuery();
		$stmt->execute();
		$this->_stmtError = $stmt->error;
		$this->reset();
		return $this->_dynamicBindResults($stmt);
	}








	public function Query_normal( $query ) {

		return $this->_mysqli->query( $query );
		//$this->rawQuery( $query );

		//return $this->getLastError() == '';
	}

	// public function Query( $query ) {

	// 	return $this->_mysqli->query( $query );
	// }

	public function Query_row( $query ) {

		$ary_ret = array();

		$this->result = $this->_mysqli->query( $query );

		return $this->result->fetch_array(MYSQLI_NUM);
	}

	public function Query_array( $query ) {

		$ary_ret = array();

		$this->result = $this->_mysqli->query( $query );

		return $this->result->fetch_array(MYSQLI_ASSOC);
	}

	public function Query_result( $query ) {

		$ary_ret = array();

		$this->result = $this->_mysqli->query( $query );

		$ary_ret['res'] = $this->result->fetch_array(MYSQLI_ASSOC);

		foreach ($ary_ret['res'] as $key => $value) {
			return $value;
		}
	}

	public function Query_string( $Query ) {	// 결과 출력

		return $this->_mysqli->real_escape_string($Query);
	}

	public function Query_echo( $Query ) {	// 결과 출력

		echo $Query;
	}

	public function Get_insert_id() {	// 마지막 번호

		$ary_ret = array();

		$ary_ret['res'] = $this->_mysqli->insert_id;
		if( !$ary_ret['res'] ) $ary_ret['res'] = 0;

		return $ary_ret['res'];
	}







	public function exists($table) {
		$table = filter_var($table,FILTER_SANITIZE_STRING);
		$count = $this->rawQuery("SHOW TABLES LIKE '".$this->_prefix.$table."'");
		return count($count) == 1;
	}

	public function compare($table,$schema) {
		$table = filter_var($table,FILTER_SANITIZE_STRING);
		$desc = $this->rawQuery('SHOW FULL COLUMNS FROM `'.$this->_prefix.$table.'`');

		if (count($desc) != count(array_keys((array)$schema->columns))) return false;

		$auto_increment = '';
		for ($i=0, $loop=count($desc);$i<$loop;$i++) {
			if (isset($schema->columns->{$desc[$i]->Field}) == false) return false;
			if ($desc[$i]->Collation && $desc[$i]->Collation != 'utf8mb4_unicode_ci') return false;

			$compare = $schema->columns->{$desc[$i]->Field};
			if (preg_match('/(.*?)\((.*?)\)/',$desc[$i]->Type,$match) == true) {
				if ($compare->type != $match[1]) return false;
				if ($compare->length != $match[2]) return false;
			} else {
				if ($compare->type != $desc[$i]->Type) return false;
			}

			if ((isset($compare->default) == true && $compare->default != $desc[$i]->Default) || isset($compare->default) == false && $desc[$i]->Default != null) return false;

			$compare->is_null = isset($compare->is_null) == true && $compare->is_null === true;
			if (($compare->is_null == true && $desc[$i]->Null == 'NO') || $compare->is_null == false && $desc[$i]->Null == 'YES') return false;

			if (isset($desc[$i]->Extra) == true && $desc[$i]->Extra == 'auto_increment') {
				if (isset($schema->auto_increment) == false || $schema->auto_increment != $desc[$i]->Field) return false;
				$auto_increment = $desc[$i]->Field;
			}
		}

		$index = $this->rawQuery('SHOW INDEX FROM `'.$this->_prefix.$table.'`');

		$indexByType = array();
		for ($i=0, $loop=count($index);$i<$loop;$i++) {
			if (isset($indexByType[$index[$i]->Key_name]) == false) $indexByType[$index[$i]->Key_name] = array('column'=>'','type'=>$index[$i]->Index_type,'unique'=>$index[$i]->Non_unique == 0);
			$indexByType[$index[$i]->Key_name]['column'] = $indexByType[$index[$i]->Key_name]['column'] ? $indexByType[$index[$i]->Key_name]['column'].','.$index[$i]->Column_name : $index[$i]->Column_name;
		}

		$index = array();
		foreach ($indexByType as $key=>$value) {
			if ($key == 'PRIMARY') {
				$index[$value['column']] = 'primary_key';
			} elseif ($value['type'] == 'FULLTEXT') {
				$index[$value['column']] = 'fulltext';
			} else {
				$index[$value['column']] = $value['unique'] == true ? 'unique' : 'index';
			}
		}

		foreach ($index as $column=>$type) {
			if (isset($schema->indexes->$column) == false || $schema->indexes->$column != $type) return false;
		}

		foreach ($schema->indexes as $column=>$type) {
			if (isset($index[$column]) == false) {
				$column = filter_var($column,FILTER_SANITIZE_STRING);
				$column = '`'.str_replace(',','`,`',$column).'`';
				if ($type == 'primary_key') {
					$this->rawQuery('ALTER TABLE `'.$this->_prefix.$table.'` ADD PRIMARY KEY('.$column.')');
					if ($this->getLastError()) return false;
				} elseif ($type == 'index') {
					$this->rawQuery('ALTER TABLE `'.$this->_prefix.$table.'` ADD INDEX('.$column.')');
					if ($this->getLastError()) return false;
				} elseif ($type == 'fulltext') {
					$this->rawQuery('ALTER TABLE `'.$this->_prefix.$table.'` ADD FULLTEXT('.$column.')');
					if ($this->getLastError()) return false;
				} elseif ($type == 'unique') {
					$this->rawQuery('ALTER TABLE `'.$this->_prefix.$table.'` ADD UNIQUE('.$column.')');
					if ($this->getLastError()) return false;
				}
			}
		}

		if (isset($schema->auto_increment) == true && $auto_increment != $schema->auto_increment) return false;

		return true;
	}

	public function create($table,$schema) {
		$table = filter_var($table,FILTER_SANITIZE_STRING);
		$query = 'CREATE TABLE IF NOT EXISTS `'.$this->_prefix.$table.'` (';

		$isFirst = true;
		foreach ($schema->columns as $column=>$options) {
			if ($isFirst == false) $query.= ', ';

			$column = filter_var($column,FILTER_SANITIZE_STRING);
			$query.= '`'.$column.'` ';
			if (isset($options->length) == true) {
				$query.= $options->type.'('.$options->length.')';
			} else {
				$query.= $options->type;
			}

			if (isset($options->is_null) == true && $options->is_null == true) {
				$query.= ' NULL';
			} else {
				$query.= ' NOT NULL';
			}

			if (isset($options->default) == true) {
				$query.= " DEFAULT '".$options->default."'";
			}

			$isFirst = false;
		}
		$query.= ') ENGINE = MyISAM CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci';

		$this->rawQuery($query);
		if ($this->getLastError()) return false;

		foreach ($schema->indexes as $column=>$index) {
			$column = filter_var($column,FILTER_SANITIZE_STRING);
			$column = '`'.str_replace(',','`,`',$column).'`';

			if ($index == 'primary_key') {
				$this->rawQuery('ALTER TABLE `'.$this->_prefix.$table.'` ADD PRIMARY KEY('.$column.')');
			} elseif ($index == 'index') {
				$this->rawQuery('ALTER TABLE `'.$this->_prefix.$table.'` ADD INDEX('.$column.')');
			} elseif ($index == 'fulltext') {
				$this->rawQuery('ALTER TABLE `'.$this->_prefix.$table.'` ADD FULLTEXT('.$column.')');
			} elseif ($index == 'unique') {
				$this->rawQuery('ALTER TABLE `'.$this->_prefix.$table.'` ADD UNIQUE('.$column.')');
			}

			if ($this->getLastError()) {
				$this->drop($table);
				return false;
			}
		}

		if (isset($schema->auto_increment) == true && $schema->auto_increment) {
			$auto_increment = filter_var($schema->auto_increment,FILTER_SANITIZE_STRING);
			$this->rawQuery('ALTER TABLE `'.$this->_prefix.$table.'` CHANGE `'.$auto_increment.'` `'.$auto_increment.'` int('.$schema->columns->{$schema->auto_increment}->length.') NOT NULL AUTO_INCREMENT');
			if ($this->getLastError()) return false;
		}

		return true;
	}

	public function drop($table) {
		$table = filter_var($table,FILTER_SANITIZE_STRING);
		$this->rawQuery('DROP TABLE IF EXISTS `'.$this->_prefix.$table.'`');

		return $this->getLastError() == '';
	}

	public function rename($table,$newname) {
		$table = filter_var($table,FILTER_SANITIZE_STRING);
		$newname = filter_var($newname,FILTER_SANITIZE_STRING);
		$this->rawQuery('RENAME TABLE `'.$this->_prefix.$table.'` TO `'.$this->_prefix.$newname.'`');

		return $this->getLastError() == '';
	}

	public function execute() {
		if (preg_match('/^SELECT /',$this->_query) == true) {
			return $this->get();
		} elseif (preg_match('/^INSERT /',$this->_query) == true) {
			$stmt = $this->_buildQuery();
			$stmt->execute();
			$this->_stmtError = $stmt->error;
			$this->reset();
			$this->count = $stmt->affected_rows;
			if ($stmt->affected_rows < 1) return false;
			if ($stmt->insert_id > 0) return $stmt->insert_id;
			return true;
		} elseif (preg_match('/^DELETE /',$this->_query) == true) {
			$stmt = $this->_buildQuery();
			$stmt->execute();
			$this->_stmtError = $stmt->error;
			$this->reset();
			return ($stmt->affected_rows > 0);
		} else {
			$stmt = $this->_buildQuery();
			$status = $stmt->execute();
			$this->reset();
			$this->_stmtError = $stmt->error;
			$this->count = $stmt->affected_rows;
			return $status;
		}
	}

	public function has() {
		$this->getOne();
		return $this->count >= 1;
	}

	public function count() {
		$this->get();
		return $this->count;
	}

	public function get() {
		$stmt = $this->_buildQuery();
		if ($this->isSubQuery == true) return $this;

		$stmt->execute();
		$this->_stmtError = $stmt->error;
		$this->reset();
		return $this->_dynamicBindResults($stmt);
	}

	public function getOne() {
		$res = $this->get();
		if (is_object($res) == true) return $res;
		if (isset($res[0]) == true) return $res[0];
		return null;
	}

	public function select($table,$columns='*') {
		if (empty($columns)) $columns = '*';
		$column = is_array($columns) ? implode(',',$columns) : $columns;
		$this->_query = 'SELECT '.$column.' FROM '.$this->_prefix.$table;

		return $this;
	}

	public function insert($table,$data) {
		if ($this->isSubQuery == true) return;
		/*
		$desc = $this->rawQuery('SHOW FULL COLUMNS FROM `'.$this->_prefix.$table.'`');
		for ($i=0, $loop=count($desc);$i<$loop;$i++) {
			if (isset($data[$desc[$i]->Field]) == false && $desc[$i]->Null == 'NO' && $desc[$i]->Default === null) {
				if (preg_match('/[^\(]+/',$desc[$i]->Type,$match) == true) {
					$type = $match[0];

					switch ($type) {
						case 'int' :
							$data[$desc[$i]->Field] = 0;
							break;

						case 'date' :
							$data[$desc[$i]->Field] = '0000-00-00';
							break;

						case 'datetime' :
							$data[$desc[$i]->Field] = '0000-00-00 00:00:00';
							break;

						default :
							$data[$desc[$i]->Field] = '';
					}
				}
			}
		}
		*/
		$this->_query = 'INSERT into '.$this->_prefix.$table;
		$this->_tableDatas = $data;

		return $this;
	}

	public function update($table,$data) {
		if ($this->isSubQuery == true) return;

		$this->_query = 'UPDATE '.$this->_prefix.$table.' SET ';
		$this->_tableDatas = $data;

		return $this;
	}

	public function delete($table) {
		if ($this->isSubQuery == true) return;

		$this->_query = 'DELETE FROM '.$this->_prefix.$table;

		return $this;
	}

	public function truncate($table) {
		if ($this->isSubQuery == true) return;

		$this->_query = 'TRUNCATE TABLE '.$this->_prefix.$table;

		return $this;
	}

	public function where($whereProp,$whereValue = null,$operator = null) {
		if ($operator) $whereValue = array($operator=>$whereValue);
		$this->_where[] = array('AND',$whereValue,$whereProp);
		return $this;
	}

	public function orWhere($whereProp,$whereValue=null,$operator=null) {
		if ($operator) $whereValue = array($operator=>$whereValue);
		$this->_where[] = array('OR',$whereValue,$whereProp);
		return $this;
	}

	public function join($joinTable,$joinCondition,$joinType = '') {
		$allowedTypes = array('LEFT','RIGHT','OUTER','INNER','LEFT OUTER','RIGHT OUTER');
		$joinType = strtoupper(trim($joinType));
		if ($joinType && in_array($joinType,$allowedTypes) == false)
			die ('Wrong JOIN type: '.$joinType);
		if (is_object($joinTable) == false) {
			$joinTable = $this->_prefix.filter_var($joinTable,FILTER_SANITIZE_STRING);
		}
		$this->_join[] = array($joinType,$joinTable,$joinCondition);
		return $this;
	}

	public function orderBy($orderByField,$orderbyDirection='DESC',$customFields=null) {
		$allowedDirection = array('ASC','DESC');
		$orderbyDirection = strtoupper(trim($orderbyDirection));
		$orderByField = preg_replace('/[^-a-z0-9\.\(\),_]+/i','',$orderByField);
		if (empty($orderbyDirection) == true || in_array($orderbyDirection,$allowedDirection) == false) $this->error('Wrong order direction: '.$orderbyDirection);

		if (is_array($customFields) == true) {
			foreach ($customFields as $key=>$value) {
				$customFields[$key] = preg_replace('/[^-a-z0-9\.\(\),_]+/i','',$value);
			}
			$orderByField = 'FIELD ('.$orderByField.',"'.implode('","',$customFields).'")';
		}
		$this->_orderBy[$orderByField] = $orderbyDirection;
		return $this;
	}

	public function groupBy($groupByField) {
		$groupByField = preg_replace ('/[^-a-z0-9\.\(\),_]+/i','',$groupByField);
		$this->_groupBy[] = $groupByField;
		return $this;
	}

	public function limit($start,$limit=null) {
		if ($limit != null) {
			$this->_limit = array($start,$limit);
		} else {
			$this->_limit = array(0,$start);
		}
		return $this;
	}

	public function getInsertId() {
		return $this->_mysqli->insert_id;
	}

	public function escape($str) {
		return $this->_mysqli->real_escape_string($str);
	}

	public function ping() {
		return $this->_mysqli->ping();
	}

	private function _determineType($item) {
		switch (gettype($item)) {
			case 'NULL':
			case 'string':
				return 's';
				break;
			case 'boolean':
			case 'integer':
				return 'i';
				break;
			case 'blob':
				return 'b';
				break;
			case 'double':
				return 'd';
				break;
		}
		return '';
	}

	private function _bindParam($value) {
		$this->_bindParams[0].= $this->_determineType($value);
		array_push ($this->_bindParams,$value);
	}

	private function _bindParams($values) {
		foreach ($values as $value) $this->_bindParam($value);
	}

	private function _buildPair($operator,$value) {
		if (is_object($value) == false) {
			$this->_bindParam($value);
			return ' '.$operator.' ? ';
		}
		$subQuery = $value->getSubQuery();
		$this->_bindParams($subQuery['params']);
		return ' '.$operator.' ('.$subQuery['query'].') '.$subQuery['alias'];
	}

	private function _buildQuery() {
		$this->_buildJoin();
		if (empty($this->_tableDatas) == false) $this->_buildTableData($this->_tableDatas);
		$this->_buildWhere();
		$this->_buildGroupBy();
		$this->_buildOrderBy();
		$this->_buildLimit();
		$this->_lastQuery = $this->replacePlaceHolders($this->_query,$this->_bindParams);
		if ($this->isSubQuery == true) return;

		$stmt = $this->_prepareQuery();
		if (count($this->_bindParams) > 1) call_user_func_array(array($stmt,'bind_param'),$this->refValues($this->_bindParams));
		return $stmt;
	}

	private function _dynamicBindResults(mysqli_stmt $stmt) {
		$parameters = array();
		$results = array();
		$meta = $stmt->result_metadata();
		if(!$meta && $stmt->sqlstate) {
			return array();
		}
		$row = array();
		while ($field = $meta->fetch_field()) {
			$row[$field->name] = null;
			$parameters[] = &$row[$field->name];
		}
		$stmt->store_result();

		call_user_func_array(array($stmt,'bind_result'),$parameters);
		$this->count = 0;
		while ($stmt->fetch()) {
			$result = array();
			foreach ($row as $key=>$val) {
				$result[$key] = isset($val) == false || $val === null ? '' : $val;
			}
			array_push($results,(object)$result);
			$this->count++;
		}
		$stmt->free_result();
		return $results;
	}

	private function _buildJoin() {
		if (empty($this->_join) == true) return;
		foreach ($this->_join as $data) {
			list($joinType,$joinTable,$joinCondition) = $data;

			if (is_object($joinTable) == true) $joinStr = $this->_buildPair('',$joinTable);
			else $joinStr = $joinTable;

			$this->_query.= ' '.$joinType.' JOIN '.$joinStr.' on '.$joinCondition;
		}
	}

	private function _buildTableData($tableData) {
		if (is_array($tableData) == false) return;

		$isInsert = strpos($this->_query,'INSERT');
		$isUpdate = strpos($this->_query,'UPDATE');
		if ($isInsert !== false) {
			$this->_query.= '(`'.implode(array_keys($tableData),'`,`').'`)';
			$this->_query.= ' VALUES(';
		}

		foreach ($tableData as $column=>$value) {
			if ($isUpdate !== false) $this->_query.= '`'.$column.'` = ';
			if (is_object($value) == true) {
				$this->_query.= $this->_buildPair('',$value).',';
				continue;
			}
			if (is_array($value) == false) {
				$this->_bindParam($value);
				$this->_query.= '?,';
				continue;
			}
			$key = key($value);
			$val = $value[$key];
			switch ($key) {
				case '[I]':
					$this->_query.= $column.$val.',';
					break;
				case '[F]':
					$this->_query.= $val[0].',';
					if (empty($val[1]) == false) $this->_bindParams($val[1]);
					break;
				case '[N]':
					if ($val == null) $this->_query.= '!'.$column.',';
					else $this->_query.= '!'.$val.',';
					break;
				default:
					$this->error('Wrong operation');
			}
		}
		$this->_query = rtrim($this->_query,',');
		if ($isInsert !== false) $this->_query.= ')';
	}

	private function _buildWhere() {
		if (empty($this->_where) == true) return;

		$this->_query.= ' WHERE ';
		$this->_where[0][0] = '';
		foreach ($this->_where as $cond) {
			list ($concat,$wValue,$wKey) = $cond;

			$this->_query.= ' '.$concat.' ';
			if (is_array($wValue) == false || (strtolower(key($wValue)) != 'inset' && strtolower(key($wValue)) != 'fulltext')) $this->_query.= $wKey;

			if ($wValue === null) continue;

			if (is_array($wValue) == false) $wValue = array('='=>$wValue);

			$key = key($wValue);
			$val = $wValue[$key];
			switch (strtolower($key)) {
				case '0':
					$this->_bindParams($wValue);
					break;
				case 'not in':
				case 'in':
					$comparison = ' '.$key.' (';
					if (is_object($val) == true) {
						$comparison.= $this->_buildPair('',$val);
					} else {
						foreach ($val as $v) {
							$comparison.= ' ?,';
							$this->_bindParam($v);
						}
					}
					$this->_query.= rtrim($comparison,',').' ) ';
					break;
				case 'inset' :
					$comparison = ' FIND_IN_SET (?,'.$wKey.')';
					$this->_bindParam($val);

					$this->_query.= $comparison;
					break;
				case 'not between':
				case 'between':
					$this->_query.= " $key ? AND ? ";
					$this->_bindParams($val);
					break;
				case 'not exists':
				case 'exists':
					$this->_query.= $key.$this->_buildPair('',$val);
					break;
				case 'not like':
				case 'like':
					$this->_query .= " $key ? ";
					$this->_bindParam($val);
					break;
				case 'fulltext':
					$comparison = ' MATCH ('.$wKey.') AGAINST (? IN BOOLEAN MODE)';

					$keylist = explode(' ',$val);
					for ($i=0, $loop=sizeof($keylist);$i<$loop;$i++) {
						$keylist[$i] = '\'+'.$keylist[$i].'*\'';
					}
					$keylist = implode(' ',$keylist);

					$this->_bindParam($keylist);
					$this->_query.= $comparison;

					break;
				default:
					$this->_query.= $this->_buildPair($key,$val);
			}
		}
	}

	private function _buildGroupBy() {
		if (empty($this->_groupBy) == true) return;

		$this->_query.= ' GROUP BY ';
		foreach ($this->_groupBy as $key=>$value) {
			$this->_query.= $value.',';
		}
		$this->_query = rtrim($this->_query,',').' ';
	}

	private function _buildOrderBy() {
		if (empty($this->_orderBy) == true) return;

		$this->_query.= ' ORDER BY ';
		foreach ($this->_orderBy as $prop=>$value) {
			if (strtolower(str_replace(' ','',$prop)) == 'rand()') $this->_query.= 'rand(),';
			else $this->_query.= $prop.' '.$value.',';
		}
		$this->_query = rtrim($this->_query,',').' ';
	}

	private function _buildLimit() {
		if ($this->_limit == null) return;

		if (is_array($this->_limit) == true) {
			$this->_query.= ' LIMIT '.(int)$this->_limit[0].','.(int)$this->_limit[1];
		} else {
			$this->_query.= ' LIMIT '.(int)$this->_limit;
		}
	}

	private function _prepareQuery() {
		if (!$stmt = $this->_mysqli->prepare($this->_query)) {
			$this->error('Problem preparing query '.$this->_mysqli->error,$this->_query);
		}
		return $stmt;
	}

	private function refValues($arr) {
		if (strnatcmp(phpversion(),'5.3') >= 0) {
			$refs = array();
			foreach ($arr as $key=>$value) {
				$refs[$key] = &$arr[$key];
			}
			return $refs;
		}
		return $arr;
	}

	private function replacePlaceHolders($str,$vals) {
		$i = 1;
		$newStr = '';
		while ($pos = strpos ($str,'?')) {
			$val = $vals[$i++];
			if (is_object($val == true)) $val = '[object]';

			$newStr.= substr($str,0,$pos).$val;
			$str = substr($str,$pos + 1);
		}
		$newStr.= $str;
		return $newStr;
	}

	public function getLastQuery() {
		return $this->_lastQuery;
	}

	public function getLastError() {
		return trim($this->_stmtError.' '.$this->_mysqli->error);
	}

	public function getSubQuery() {
		if (!$this->isSubQuery) return null;

		array_shift($this->_bindParams);
		$val = array('query'=>$this->_query,'params'=>$this->_bindParams,'alias'=>$this->host);
		$this->reset();
		return $val;
	}

	public function interval($diff,$func='NOW()') {
		$types = array('s'=>'second','m'=>'minute','h'=>'hour','d'=>'day','M'=>'month','Y'=>'year');
		$incr = '+';
		$items = '';
		$type = 'd';
		if ($diff && preg_match('/([+-]?) ?([0-9]+) ?([a-zA-Z]?)/',$diff,$matches)) {
			if (empty($matches[1]) == false) $incr = $matches[1];
			if (empty($matches[2]) == false) $items = $matches[2];
			if (empty($matches[3]) == false) $type = $matches[3];
			if (in_array($type,array_keys($types)) == false) $this->error('invalid interval type in '.$diff);

			$func.= ' '.$incr.' interval '.$items.' '.$types[$type].' ';
		}
		return $func;
	}

	public function now($diff=null,$func='NOW()') {
		return array('[F]'=>array($this->interval($diff,$func)));
	}

	public function inc($num=1) {
		return array('[I]'=>'+'.(int)$num);
	}

	public function dec($num = 1) {
		return array('[I]'=>"-".(int)$num);
	}

	public function not($col=null) {
		return array('[N]'=>(string)$col);
	}

	public function func($expr,$bindParams=null) {
		return array('[F]'=>array($expr,$bindParams));
	}

	public static function subQuery($db='') {
		return new mysql($db ? $db : $this->db,true);
	}

	public function copy() {
		$copy = unserialize(serialize($this));
		$copy->_mysqli = $this->_mysqli;
		return $copy;
	}

	public function startTransaction() {
		$this->_mysqli->autocommit(false);
		$this->_transaction_in_progress = true;
		register_shutdown_function(array($this,'_transaction_status_check'));
	}

	public function commit() {
		$this->_mysqli->commit();
		$this->_transaction_in_progress = false;
		$this->_mysqli->autocommit(true);
	}

	public function rollback() {
		$this->_mysqli->rollback();
		$this->_transaction_in_progress = false;
		$this->_mysqli->autocommit(true);
	}

	public function _transaction_status_check() {
		if (!$this->_transaction_in_progress) return;
		$this->rollback();
	}

	public function __destruct() {
		if ($this->isSubQuery == false) return;
		if ($this->_mysqli) $this->_mysqli->close();
	}
}
?>