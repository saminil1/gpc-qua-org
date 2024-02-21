/// 에러메시지 포멧 정의 ///
var NO_BLANK = "{name+을를} 입력하세요";
var NO_BLANK_RADIO = "{name+을를} 선택하세요";
var NO_BLANK_CHECKBOX = "{name+을를} 한가지 이상 선택하세요";
var NOT_VALID = "{name+이가} 올바르지 않습니다";
var TOO_LONG = "{name}의 길이가 초과되었습니다 (최대 {maxbyte}바이트)";

/// 스트링 객체에 메소드 추가 ///
String.prototype.trim = function(str) {
str = this != window ? this : str;
return str;
return str.replace(/^\s+/g,'').replace(/\s+$/g,'');
}

String.prototype.hasFinalConsonant = function(str) {
str = this != window ? this : str;
var strTemp = str.substr(str.length-1);
return ((strTemp.charCodeAt(0)-16)%28!=0);
}

function josa(str,tail) {
return (str.hasFinalConsonant()) ? tail.substring(0,1) : tail.substring(1,2);
}

function validate(form)
{
	for (i = 0; i < form.elements.length; i++ )
	{

		var el = form.elements[i];
		el.value = el.value.trim();

		if (el.getAttribute("REQUIRED") != null) {
			if (el.value == null || el.value == "") {
				return doError(el,NO_BLANK);
			}


			//라디오버튼 일때 폼 체크 하는 부분
			if ( el.getAttribute("type") == "radio" || el.getAttribute("type") == "checkbox" ) {
				obj	= form[el.name];
				len	= obj.length;
				//alert(len);

				chk	= '';

				if ( len == undefined )
				{
					if ( form[el.name].checked == true )
					{
						chk	= 'ok';
					}
				}
				else
				{
					for ( z=0 ; z<len ; z++ )
					{
						if ( form[el.name][z].checked == true )
						{
							chk	= 'ok';
							break;
						}
					}
				}
				if ( chk == '' )
				{
					return doError(el,NO_BLANK_RADIO);
				}
			}
			//라디오버튼 일때 폼 체크 하는 부분
		}







		if (el.getAttribute("MAXBYTE") != null && el.value != "") {
			var len = 0;
			for(j=0; j<el.value.length; j++) {
				var str = el.value.charAt(j);
				len += (str.charCodeAt() > 128) ? 2 : 1
			}
			if (len > parseInt(el.getAttribute("MAXBYTE"))) {
				maxbyte = el.getAttribute("MAXBYTE");
				return doError(el,TOO_LONG);
			}
		}

		if (el.getAttribute("OPTION") != null && el.value != "") {
			if (!funcs[el.getAttribute("OPTION")](el))
				return false;
		}


	}
	return true;
}



function doError(el,type,action) {
	var pattern = /{([a-zA-Z0-9_]+)\+?([가-힣]{2})?}/;
	var name = (hname = el.getAttribute("HNAME")) ? hname : el.getAttribute("NAME");
	name = name.replace('[]','');
	pattern.exec(type);
	var tail = (RegExp.$2) ? josa(eval(RegExp.$1),RegExp.$2) : "";
	alert(type.replace(pattern,eval(RegExp.$1) + tail));
	if (action == "sel") {
	el.select();
	} else if (action == "del") {
	el.value = "";
	}
	el.focus();
	return false;
}

/// 특수 패턴 검사 함수 매핑 ///
var funcs = new Array();
funcs['phone'] = isValidPhone;
funcs['hangul'] = hasHangul;
funcs['number'] = isNumeric;
funcs['engonly'] = alphaOnly;
funcs['bizno'] = isValidBizNo;

/// 패턴 검사 함수들 ///

function hasHangul(el) {
var pattern = /[가-힣]/;
return (pattern.test(el.value)) ? true : doError(el,"{name+은는} 반드시 한글을 포함해야 합니다");
}

function alphaOnly(el) {
var pattern = /^[a-zA-Z]+$/;
return (pattern.test(el.value)) ? true : doError(el,NOT_VALID);
}

function isNumeric(el) {
var pattern = /^[0-9]+$/;
return (pattern.test(el.value)) ? true : doError(el,"{name+은는} 반드시 숫자로만 입력해야 합니다");
}

function isValidBizNo(el) {
   var pattern = /([0-9]{3})-?([0-9]{2})-?([0-9]{5})/;
var num = el.value;
   if (!pattern.test(num)) return doError(el,NOT_VALID);
   num = RegExp.$1 + RegExp.$2 + RegExp.$3;
   var cVal = 0;
   for (var i=0; i<8; i++) {
       var cKeyNum = parseInt(((_tmp = i % 3) == 0) ? 1 : ( _tmp  == 1 ) ? 3 : 7);
       cVal += (parseFloat(num.substring(i,i+1)) * cKeyNum) % 10;
   }
   var li_temp = parseFloat(num.substring(i,i+1)) * 5 + '0';
   cVal += parseFloat(li_temp.substring(0,1)) + parseFloat(li_temp.substring(1,2));
   return (parseInt(num.substring(9,10)) == 10-(cVal % 10)%10) ? true : doError(el,NOT_VALID);
}

function isValidPhone(el) {
var pattern = /^([0]{1}[0-9]{1,2})-?([1-9]{1}[0-9]{2,3})-?([0-9]{4})$/;
if (pattern.exec(el.value)) {
if(RegExp.$1 == "011" || RegExp.$1 == "016" || RegExp.$1 == "017" || RegExp.$1 == "018" || RegExp.$1 == "019") {
el.value = RegExp.$1 + "-" + RegExp.$2 + "-" + RegExp.$3;
}
return true;
} else {
return doError(el,NOT_VALID);
}
}





	function emailCheck( prm_value ) {

		var regExp = /([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;

		if ( ! regExp.test( prm_value ) ) return false ;
		else return true ;

	} // @emailCheck

	function inputOnlyNum( prm_obj ) {

		//var chr , key_eg , key_num ;

		for ( var nRoop = 0 ; nRoop < prm_obj.value.length ; nRoop++ ) {

			chr = prm_obj.value.substr( nRoop , 1 ) ;
			chr = escape( chr ) ;
			key_eg = chr.charAt( 1 ) ;

			if ( key_eg == 'u' ) {

				key_num = chr.substr( nRoop , ( chr.length - 1 ) ) ;
				if ( ( key_num < "AC00" ) || ( key_num > "D7A3" ) ) event.returnValue = false ;
				
			} // if 

		} // for 

		if ( ( event.keyCode >= 48 ) && ( event.keyCode <= 57 ) ) ;
		else event.returnValue = false ;

	} // # inputOnlyNum


function OnCheckPhone(oTa) { 

	var oForm = oTa.form ; 
	var sMsg = oTa.value ; 
	var onlynum = "" ; 
	var imsi=0; 
	onlynum = RemoveDash2(sMsg);  //하이픈 입력시 자동으로 삭제함 
	onlynum =  checkDigit(onlynum);  // 숫자만 입력받게 함 
    var retValue = ""; 

	if ( ( event.keyCode != 12 ) && ( event.keyCode != 8 ) ) { 

		if(onlynum.substring(0,2) == 02) {  // 서울전화번호일 경우  10자리까지만 나타나교 그 이상의 자리수는 자동삭제 
			if (GetMsgLen(onlynum) <= 1) oTa.value = onlynum ; 
			if (GetMsgLen(onlynum) == 2) oTa.value = onlynum + "-"; 
			if (GetMsgLen(onlynum) == 4) oTa.value = onlynum.substring(0,2) + "-" + onlynum.substring(2,3) ; 
			if (GetMsgLen(onlynum) == 4) oTa.value = onlynum.substring(0,2) + "-" + onlynum.substring(2,4) ; 
			if (GetMsgLen(onlynum) == 5) oTa.value = onlynum.substring(0,2) + "-" + onlynum.substring(2,5) ; 
			if (GetMsgLen(onlynum) == 6) oTa.value = onlynum.substring(0,2) + "-" + onlynum.substring(2,6) ; 
			if (GetMsgLen(onlynum) == 7) oTa.value = onlynum.substring(0,2) + "-" + onlynum.substring(2,5) + "-" + onlynum.substring(5,7) ; ; 
			if (GetMsgLen(onlynum) == 8) oTa.value = onlynum.substring(0,2) + "-" + onlynum.substring(2,6) + "-" + onlynum.substring(6,8) ; 
			if (GetMsgLen(onlynum) == 9) oTa.value = onlynum.substring(0,2) + "-" + onlynum.substring(2,5) + "-" + onlynum.substring(5,9) ; 
			if (GetMsgLen(onlynum) == 10) oTa.value = onlynum.substring(0,2) + "-" + onlynum.substring(2,6) + "-" + onlynum.substring(6,10) ; 
			if (GetMsgLen(onlynum) == 11) oTa.value = onlynum.substring(0,2) + "-" + onlynum.substring(2,6) + "-" + onlynum.substring(6,10) ; 
			if (GetMsgLen(onlynum) == 12) oTa.value = onlynum.substring(0,2) + "-" + onlynum.substring(2,6) + "-" + onlynum.substring(6,10) ; 
		}
		
		if(onlynum.substring(0,2) == 05 ) {  // 05로 시작되는 번호 체크 

			if(onlynum.substring(2,3) == 0 ) {  // 050으로 시작되는지 따지기 위한 조건문 

				if (GetMsgLen(onlynum) <= 3) oTa.value = onlynum ; 
				if (GetMsgLen(onlynum) == 4) oTa.value = onlynum + "-"; 
				if (GetMsgLen(onlynum) == 5) oTa.value = onlynum.substring(0,4) + "-" + onlynum.substring(4,5) ; 
				if (GetMsgLen(onlynum) == 6) oTa.value = onlynum.substring(0,4) + "-" + onlynum.substring(4,6) ; 
				if (GetMsgLen(onlynum) == 7) oTa.value = onlynum.substring(0,4) + "-" + onlynum.substring(4,7) ; 
				if (GetMsgLen(onlynum) == 8) oTa.value = onlynum.substring(0,4) + "-" + onlynum.substring(4,8) ; 
				if (GetMsgLen(onlynum) == 9) oTa.value = onlynum.substring(0,4) + "-" + onlynum.substring(4,7) + "-" + onlynum.substring(7,9) ; ; 
				if (GetMsgLen(onlynum) == 10) oTa.value = onlynum.substring(0,4) + "-" + onlynum.substring(4,8) + "-" + onlynum.substring(8,10) ; 
				if (GetMsgLen(onlynum) == 11) oTa.value = onlynum.substring(0,4) + "-" + onlynum.substring(4,7) + "-" + onlynum.substring(7,11) ; 
				if (GetMsgLen(onlynum) == 12) oTa.value = onlynum.substring(0,4) + "-" + onlynum.substring(4,8) + "-" + onlynum.substring(8,12) ; 
				if (GetMsgLen(onlynum) == 13) oTa.value = onlynum.substring(0,4) + "-" + onlynum.substring(4,8) + "-" + onlynum.substring(8,12) ; 

			  } else { 

				if (GetMsgLen(onlynum) <= 2) oTa.value = onlynum ; 
				if (GetMsgLen(onlynum) == 3) oTa.value = onlynum + "-"; 
				if (GetMsgLen(onlynum) == 4) oTa.value = onlynum.substring(0,3) + "-" + onlynum.substring(3,4) ; 
				if (GetMsgLen(onlynum) == 5) oTa.value = onlynum.substring(0,3) + "-" + onlynum.substring(3,5) ; 
				if (GetMsgLen(onlynum) == 6) oTa.value = onlynum.substring(0,3) + "-" + onlynum.substring(3,6) ; 
				if (GetMsgLen(onlynum) == 7) oTa.value = onlynum.substring(0,3) + "-" + onlynum.substring(3,7) ; 
				if (GetMsgLen(onlynum) == 8) oTa.value = onlynum.substring(0,3) + "-" + onlynum.substring(3,6) + "-" + onlynum.substring(6,8) ; ; 
				if (GetMsgLen(onlynum) == 9) oTa.value = onlynum.substring(0,3) + "-" + onlynum.substring(3,7) + "-" + onlynum.substring(7,9) ; 
				if (GetMsgLen(onlynum) == 10) oTa.value = onlynum.substring(0,3) + "-" + onlynum.substring(3,6) + "-" + onlynum.substring(6,10) ; 
				if (GetMsgLen(onlynum) == 11) oTa.value = onlynum.substring(0,3) + "-" + onlynum.substring(3,7) + "-" + onlynum.substring(7,11) ; 
				if (GetMsgLen(onlynum) == 12) oTa.value = onlynum.substring(0,3) + "-" + onlynum.substring(3,7) + "-" + onlynum.substring(7,11) ; 

			  } 

		} 

		if(onlynum.substring(0,2) == 03 || onlynum.substring(0,2) == 04  || onlynum.substring(0,2) == 06  || onlynum.substring(0,2) == 07  || onlynum.substring(0,2) == 08 ) {  

			// 서울전화번호가 아닌 번호일 경우(070,080포함 // 050번호가 문제군요) 
			if (GetMsgLen(onlynum) <= 2) oTa.value = onlynum ; 
			if (GetMsgLen(onlynum) == 3) oTa.value = onlynum + "-"; 
			if (GetMsgLen(onlynum) == 4) oTa.value = onlynum.substring(0,3) + "-" + onlynum.substring(3,4) ; 
			if (GetMsgLen(onlynum) == 5) oTa.value = onlynum.substring(0,3) + "-" + onlynum.substring(3,5) ; 
			if (GetMsgLen(onlynum) == 6) oTa.value = onlynum.substring(0,3) + "-" + onlynum.substring(3,6) ; 
			if (GetMsgLen(onlynum) == 7) oTa.value = onlynum.substring(0,3) + "-" + onlynum.substring(3,7) ; 
			if (GetMsgLen(onlynum) == 8) oTa.value = onlynum.substring(0,3) + "-" + onlynum.substring(3,6) + "-" + onlynum.substring(6,8) ; ; 
			if (GetMsgLen(onlynum) == 9) oTa.value = onlynum.substring(0,3) + "-" + onlynum.substring(3,7) + "-" + onlynum.substring(7,9) ; 
			if (GetMsgLen(onlynum) == 10) oTa.value = onlynum.substring(0,3) + "-" + onlynum.substring(3,6) + "-" + onlynum.substring(6,10) ; 
			if (GetMsgLen(onlynum) == 11) oTa.value = onlynum.substring(0,3) + "-" + onlynum.substring(3,7) + "-" + onlynum.substring(7,11) ; 
			if (GetMsgLen(onlynum) == 12) oTa.value = onlynum.substring(0,3) + "-" + onlynum.substring(3,7) + "-" + onlynum.substring(7,11) ; 

		} 

		if(onlynum.substring(0,2) == 01) {  //휴대폰일 경우 

			if (GetMsgLen(onlynum) <= 2) oTa.value = onlynum ; 
			if (GetMsgLen(onlynum) == 3) oTa.value = onlynum + "-"; 
			if (GetMsgLen(onlynum) == 4) oTa.value = onlynum.substring(0,3) + "-" + onlynum.substring(3,4) ; 
			if (GetMsgLen(onlynum) == 5) oTa.value = onlynum.substring(0,3) + "-" + onlynum.substring(3,5) ; 
			if (GetMsgLen(onlynum) == 6) oTa.value = onlynum.substring(0,3) + "-" + onlynum.substring(3,6) ; 
			if (GetMsgLen(onlynum) == 7) oTa.value = onlynum.substring(0,3) + "-" + onlynum.substring(3,7) ; 
			if (GetMsgLen(onlynum) == 8) oTa.value = onlynum.substring(0,3) + "-" + onlynum.substring(3,7) + "-" + onlynum.substring(7,8) ; 
			if (GetMsgLen(onlynum) == 9) oTa.value = onlynum.substring(0,3) + "-" + onlynum.substring(3,7) + "-" + onlynum.substring(7,9) ; 
			if (GetMsgLen(onlynum) == 10) oTa.value = onlynum.substring(0,3) + "-" + onlynum.substring(3,6) + "-" + onlynum.substring(6,10) ; 
			if (GetMsgLen(onlynum) == 11) oTa.value = onlynum.substring(0,3) + "-" + onlynum.substring(3,7) + "-" + onlynum.substring(7,11) ; 
			if (GetMsgLen(onlynum) == 12) oTa.value = onlynum.substring(0,3) + "-" + onlynum.substring(3,7) + "-" + onlynum.substring(7,11) ; 

		} 

		if(onlynum.substring(0,1) == 1) {  // 1588, 1688등의 번호일 경우 

			if (GetMsgLen(onlynum) <= 3) oTa.value = onlynum ; 
			if (GetMsgLen(onlynum) == 4) oTa.value = onlynum + "-"; 
			if (GetMsgLen(onlynum) == 5) oTa.value = onlynum.substring(0,4) + "-" + onlynum.substring(4,5) ; 
			if (GetMsgLen(onlynum) == 6) oTa.value = onlynum.substring(0,4) + "-" + onlynum.substring(4,6) ; 
			if (GetMsgLen(onlynum) == 7) oTa.value = onlynum.substring(0,4) + "-" + onlynum.substring(4,7) ; 
			if (GetMsgLen(onlynum) == 8) oTa.value = onlynum.substring(0,4) + "-" + onlynum.substring(4,8) ; 
			if (GetMsgLen(onlynum) == 9) oTa.value = onlynum.substring(0,4) + "-" + onlynum.substring(4,8) ; 
			if (GetMsgLen(onlynum) == 10) oTa.value = onlynum.substring(0,4) + "-" + onlynum.substring(4,8) ; 
			if (GetMsgLen(onlynum) == 11) oTa.value = onlynum.substring(0,4) + "-" + onlynum.substring(4,8) ; 
			if (GetMsgLen(onlynum) == 12) oTa.value = onlynum.substring(0,4) + "-" + onlynum.substring(4,8) ; 

		} 
	}
	
} 

function RemoveDash2(sNo) { 

	var reNo = "" ;
	for(var i=0; i<sNo.length; i++) { 

		if ( sNo.charAt(i) != "-" ) reNo += sNo.charAt(i) ;

	} 

	return reNo ;

} 

function GetMsgLen(sMsg) { // 0-127 1byte, 128~ 2byte 

	var count = 0 ;
	for(var i=0; i<sMsg.length; i++) { 

		if ( sMsg.charCodeAt(i) > 127 ) count += 2 ;
		else count++ ;

	} 

	return count  ;
} 

function checkDigit(num) { 

    var Digit = "1234567890"; 
    var string = num; 
    var len = string.length 
    var retVal = ""; 

    for (i = 0; i < len; i++) { 

        if (Digit.indexOf(string.substring(i, i+1)) >= 0) 
			retVal = retVal + string.substring(i, i+1);
        
    } 

    return retVal; 
}