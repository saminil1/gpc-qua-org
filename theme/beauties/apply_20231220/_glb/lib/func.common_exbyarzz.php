<?php
/**
 *
 * @file func.common_exbyarzz.php
 * @author wioz
 * @version 0.1.0
 * @modified wioz  2019.09.05
 */

function Request($var,$type='request') {
	global $_REQUEST, $_SESSION;

	switch ($type) {
		case 'request' :
			$value = isset($_REQUEST[$var]) == true ? $_REQUEST[$var] : null;
		break;

		case 'session' :
			$value = isset($_SESSION[$var]) == true ? $_SESSION[$var] : null;
		break;

		case 'cookie' :
			$value = isset($_COOKIE[$var]) == true ? $_COOKIE[$var] : null;
		break;
	}

	if ($value === null) return null;
	if (is_array($value) == false) return $value;
	return $value;
}


function FileReadLine($path,$line) {
	if (is_file($path) == true) {
		$file = @file($path);
		if (isset($file[$line]) == false) throw new Exception('Line Overflow : '.$path.'(Line '.$line.')');
		return trim($file[$line]);
	} else {
		throw new Exception('Not Found : '.$path);
		return '';
	}
}

function CheckEmail($email) {
	return preg_match('/^[[:alnum:]]+([_.-\]\+[[:alnum:]]+)*[_.-]*@([[:alnum:]]+([.-][[:alnum:]]+)*)+.[[:alpha:]]{2,4}$/',$email);
}

function CheckNickname($nickname) {
	if (preg_match('/[~!@#\$%\^&\*\(\)\-_\+\=\[\]\<\>\/\?\'":;\{\}\x{25a0}-\x{25ff}\x{2600}-\x{26ff}[:space:]]+/u',$nickname) == true) return false;
	if (mb_strlen($nickname,'utf-8') < 2 || mb_strlen($nickname,'utf-8') > 10) return false;

	return true;
}

function GetAntiSpamEmail($email,$isLink=true) {
	$email = str_replace('@','<i class="fa fa-at"></i>',$email);
	return $isLink == true ? '<span class="iModuleEmail">'.$email.'</span>' : $email;
}

function GetTime($format,$time=null) {
	$time = $time === null ? time() : $time;

	$replacements = array(
		'd' => 'DD',
		'D' => 'ddd',
		'j' => 'D',
		'l' => 'dddd',
		'N' => 'E',
		'S' => 'o',
		'w' => 'e',
		'z' => 'DDD',
		'W' => 'W',
		'F' => 'MMMM',
		'm' => 'MM',
		'M' => 'MMM',
		'n' => 'M',
		't' => '', // no equivalent
		'L' => '', // no equivalent
		'o' => 'YYYY',
		'Y' => 'YYYY',
		'y' => 'YY',
		'a' => 'a',
		'A' => 'A',
		'B' => '', // no equivalent
		'g' => 'h',
		'G' => 'H',
		'h' => 'hh',
		'H' => 'HH',
		'i' => 'mm',
		's' => 'ss',
		'u' => 'SSS',
		'e' => 'zz', // deprecated since version 1.6.0 of moment.js
		'I' => '', // no equivalent
		'O' => '', // no equivalent
		'P' => '', // no equivalent
		'T' => '', // no equivalent
		'Z' => '', // no equivalent
		'c' => '', // no equivalent
		'r' => '', // no equivalent
		'U' => 'X'
	);
	$momentFormat = strtr($format,$replacements);
	return '<span class="moment" data-time="'.$time.'" data-format="'.$format.'" data-moment="'.$momentFormat.'">'.date($format,$time).'</span>';
}


/**
 * getallheaders function is apache only
 *
 * @see http://php.net/getallheaders
 * @return $headers
 */
if (!function_exists('getallheaders')) {
	function getallheaders() {
		$headers = array();
		foreach ($_SERVER as $name=>$value) {
			if (substr($name,0,5) == 'HTTP_') {
				$headers[str_replace(' ', '-',ucwords(strtolower(str_replace('_',' ',substr($name,5)))))] = $value;
			}
		}
		return $headers;
	}
}


function getEngcode($str) {
	$arr_kor = array('ㄱ','ㄲ','ㄴ','ㄷ','ㄸ','ㄹ','ㅁ','ㅂ','ㅃ','ㅅ','ㅆ','ㅇ','ㅈ','ㅉ','ㅊ','ㅋ','ㅌ','ㅍ','ㅎ','ㄳ','ㄵ','ㄶ','ㄺ','ㄻ','ㄼ','ㄽ','ㄾ','ㄿ','ㅀ','ㅄ','ㅏ','ㅐ','ㅑ','ㅒ','ㅓ','ㅔ','ㅕ','ㅖ','ㅗ','ㅘ','ㅙ','ㅚ','ㅛ','ㅜ','ㅝ','ㅞ','ㅟ','ㅠ','ㅡ','ㅢ','ㅣ');

	$arr_eng = array('r','R','s','e','E','f','a','q','Q','t','T','d','w','W','c','z','x','v','g','rt','sw','sg','fr','fa','fq','ft','fx','fv','fg','qt','k','o','i','O','j','p','u','P','h','hk','ho','hl','y','n','nj','np','nl','u','m','ml','l');

	$engcode = str_replace($arr_kor,$arr_eng,$str);

	return $engcode;
}

function getKeycode($str) {
	$arr_cho = array('ㄱ','ㄲ','ㄴ','ㄷ','ㄸ','ㄹ','ㅁ','ㅂ','ㅃ','ㅅ','ㅆ','ㅇ','ㅈ','ㅉ','ㅊ','ㅋ','ㅌ','ㅍ','ㅎ');
	$arr_jung = array('ㅏ','ㅐ','ㅑ','ㅒ','ㅓ','ㅔ','ㅕ','ㅖ','ㅗ','ㅘ','ㅙ','ㅚ','ㅛ','ㅜ','ㅝ','ㅞ','ㅟ','ㅠ','ㅡ','ㅢ','ㅣ');
	$arr_jong = array('','ㄱ','ㄲ','ㄳ','ㄴ','ㄵ','ㄶ','ㄷ','ㄹ','ㄺ','ㄻ','ㄼ','ㄽ','ㄾ','ㄿ','ㅀ','ㅁ','ㅂ','ㅄ','ㅅ','ㅆ','ㅇ','ㅈ','ㅊ','ㅋ','ㅌ','ㅍ','ㅎ');

	$unicode = array();
	$values = array();
	$lookingFor = 1;

	for ($i=0, $loop=strlen($str);$i<$loop;$i++) {
		$thisValue = ord($str[$i]);

		if ($thisValue < 128) {
			$unicode[] = $thisValue;
		} else {
			if (count($values)==0) $lookingFor = $thisValue < 224 ? 2 : 3;
			$values[] = $thisValue;
			if (count($values) == $lookingFor) {
				$number = $lookingFor == 3 ? (($values[0]%16)*4096)+(($values[1]%64)*64)+($values[2]%64) : (($values[0]%32)*64)+($values[1]%64);
				$unicode[] = $number;
				$values = array();
				$lookingFor = 1;
			}
		}
	}

	$splitStr = '';
	while (list($key,$code) = each($unicode)) {
		if ($code >= 44032 && $code <= 55203) {
			$temp = $code-44032;
			$cho = (int)($temp/21/28);
			$jung = (int)(($temp%(21*28)/28));
			$jong = (int)($temp%28);

			$splitStr.= $arr_cho[$cho].$arr_jung[$jung].$arr_jong[$jong];
		} else {
			$temp = array($unicode[$key]);

			foreach ($temp as $ununicode) {
				if ($ununicode < 128) {
					$splitStr.= chr($ununicode);
				} elseif ($ununicode < 2048) {
					$splitStr.= chr(192+(($ununicode-($ununicode%64))/64));
					$splitStr.= chr(128+($ununicode%64));
				} else {
					$splitStr.= chr(224+(($ununicode-($ununicode%4096))/4096));
					$splitStr.= chr(128+((($ununicode%4096)-($ununicode%64))/64));
					$splitStr.= chr(128+($ununicode%64));
				}
			}
		}
	}

	$splitStr = str_replace(' ','',$splitStr);
	return $splitStr;
}

function getLivecode($str) {
	return getEngcode( getKeycode($str) );
}


?>