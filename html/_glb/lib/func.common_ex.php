<?php
/**
 *
 * @file func.common_ex.php
 * @author wioz
 * @version 0.1.0
 * @modified wioz  2019.09.05
 */

function addHyphen($num){
	return preg_replace("/(^02.{0}|^01.{1}|[0-9]{3})([0-9]+)([0-9]{4})/", "$1-$2-$3", $num);
}


function getManNai($birth_year,$birth_month,$brith_day){

	$birth_year = (int)$birth_year;
	$birth_month = (int)$birth_month;
	$brith_day = (int)$brith_day;
	$now_year = date("Y");
	$now_month = date("m");
	$now_day = date("d");

	if($birth_month < $now_month) {
		$age = $now_year - $birth_year;
	} else if($birth_month == $now_month) {
		if($brith_day <= $now_day) {
			$age = $now_year - $birth_year;
		} else {
			$age = $now_year - $birth_year -1;
		}
	}else{
		$age = $now_year - $birth_year-1;
	}
	return $age;
}



?>