var isValid = {
    email: function ( el ) {
		var pattern = /^[_a-zA-Z0-9-\.]+@[\.a-zA-Z0-9-]+\.[a-zA-Z]+$/;
		return (pattern.test(el)) ? true : false;
	},
	businessNo: function ( bisNo ) {
		if( bisNo ) {
			if ((bisNo = (bisNo+'').match(/\d{1}/g)).length != 10) { return false; }
			var sum = 0, key = [1, 3, 7, 1, 3, 7, 1, 3, 5];
			for (var i = 0 ; i < 9 ; i++) { sum += (key[i] * Number(bisNo[i])); }
			return (10 - ((sum + Math.floor(key[8] * Number(bisNo[8]) / 10)) % 10)) == Number(bisNo[9]);
		} else {
			return false;
		}
	},
	name: function ( el ) {
		var pattern = /^[가-힣a-zA-Z0-9]{1,13}$/;
		if( el == parseInt( el) ) {
			return false;
		}
		return (pattern.test(el)) ? true : false;
	},
	url: function ( el ) {
		var pattern = ﻿﻿ /((([a-zA-z\-_]+[0-9]*)|([0-9]*[a-zA-z\-_]+)){2,}(\.[^(\n|\t|\s,)]+)+)+/gi;
		if( el == parseInt( el) ) {
			return false;
		}
		return (pattern.test(el)) ? true : false;
	},
	number: function ( el ) {
		var pattern = /^[0-9]{8,12}$/;
		return (pattern.test(el)) ? true : false;
	},
	tel: function ( el ) {
		var pattern = /^[0-9\-]{8,14}$/;
		return (pattern.test(el)) ? true : false;
	},
	mobile: function ( el ) {
		var pattern = /^01([0|1|6|7|8|9]?)-?([0-9]{3,4})-?([0-9]{4})$/;
		return (pattern.test(el)) ? true : false;
	},
	password: function ( el ) {
		var pattern = /^.*(?=.{6,15})(?=.*[0-9])(?=.*[a-zA-Z]).*$/;
		return (pattern.test(el)) ? true : false;
	},
}

var timer = {
	init:function(oTAR, iTIME) {
		timer.o_target = oTAR;
		timer.i_start = iTIME;
		timer.start();
	},
	start:function() {
		if(timer.o_func) {
			clearInterval(timer.o_func);
			timer.o_func = null;
		}
		timer.i_time = timer.i_start;
		timer.o_func = setInterval(function(){ timer.progress();}, 1000);
	},
	progress:function() {
		timer.i_time--;

		if(timer.i_time <= 0) {
			timer.stop();
			alert("인증 시간을 초과하였습니다.");
		} else {
			var i_min = parseInt(timer.i_time/60)%60;
			var i_sec = parseInt(timer.i_time)%60;
			timer.o_target.text(formatPad(i_min,2) + ":" + formatPad(i_sec,2));
		}
	},
	stop:function() {
		clearInterval(timer.o_func);
		timer.o_target.text('');
		timer.i_time = 0;
		timer.o_func = null;
	}
}


function copyText( o_OBJ ) {
	var t_val = o_OBJ.val();
	var t_title = o_OBJ.attr('data-title');
	var t_length = t_val.length;

	if( navigator.share ) {
		navigator.share({
			title: t_title,
			url: t_val
		});
	} else {
		var t_OBJ = $('<textarea>'+t_val+'</textarea>');
		$('body').append(t_OBJ);

		t_OBJ.select();
		t_OBJ[0].setSelectionRange(0, t_length);
		document.execCommand('copy');
		t_OBJ.remove();
		alert("클립보드에 복사되었습니다.");
	}
}

function formatPad(n, w) {
	n = n + '';
	return n.length >= w ? n : new Array(w - n.length + 1).join('0') + n;
}

function formfieldCheck( f_fm ) {

	var o_OBJ = {};
		o_OBJ = f_fm.serializeArray();

	var valicheck = true;

	$(o_OBJ).each(function(i,data){

		var t_placeholder_sp = '';
		var t = f_fm.find("[name='"+data.name+"']");
		var t_required = t.attr("required");
		var t_placeholder = t.attr("data-placeholder");
		if( !t_placeholder ) {
			t_placeholder = t.attr("placeholder");
		} else {
			t_placeholder = t_placeholder.replace( /\'/gi, '\"');
			t_placeholder_sp = JSON.parse(t_placeholder);
		}

		var t_type = t.attr("type");

		var t_value = t.val();
		var t_patten = t.attr("data-patten");
		var t_msgview = t.attr("data-msgview");

		if( t_required == 'required' ) {

			var b_chk_inp = true;
			var b_chk_pat = true;

			if( !t_value ) {
				b_chk_inp = false;
			} else if( t_patten ) {
				var o_tmp_patten = new RegExp( t_patten  );
			 	b_chk_pat = (o_tmp_patten.test(t_value)) ? true : false;
			}

/*
			if( t_type == 'checkbox' ) {
				if( !t.is(':checked') ) {
					b_chk_inp = false;
				}
			}
*/
			if( !b_chk_inp || !b_chk_pat ) {
				if( t_msgview ) {
					$(t_msgview).text(t_placeholder);
				} else {
					if( !b_chk_inp && t_placeholder_sp.NULL ) {
						alert(t_placeholder_sp.NULL);
					} else if( !b_chk_pat && t_placeholder_sp.ERR ) {
						alert(t_placeholder_sp.ERR);
					} else {
						alert(t_placeholder);
					}
				}
				t.focus();

				/*
				var offset = t.offset();
				if( offset ) {
					$('html, body').animate({scrollTop: parseInt(offset.top)-60}, 360);
				}
				*/

				valicheck = false;

				return valicheck;
			} else {
				if( t_msgview ) {
					$(t_msgview).text('');
				}
			}
		}

	});

	return valicheck;
}

function singlefieldCheck( f_obj ) {

	var valicheck = true;


	var t_placeholder_sp = '';
	var t = f_obj;
	var t_required = t.attr("required");
	var t_placeholder = t.attr("data-placeholder");
	if( !t_placeholder ) {
		t_placeholder = t.attr("placeholder");
	} else {
		t_placeholder = t_placeholder.replace( /\'/gi, '\"');
		t_placeholder_sp = JSON.parse(t_placeholder);
	}

	var t_value = t.val();
	var t_patten = t.attr("data-patten");

	var b_chk_inp = true;
	var b_chk_pat = true;

	if( !t_value ) {
		b_chk_inp = false;
	} else if( t_patten ) {
		var o_tmp_patten = new RegExp( t_patten  );
	 	b_chk_pat = (o_tmp_patten.test(t_value)) ? true : false;
	}

	if( !b_chk_inp || !b_chk_pat ) {
		if( !b_chk_inp && t_placeholder_sp.NULL ) {
			alert(t_placeholder_sp.NULL);
		} else if( !b_chk_pat && t_placeholder_sp.ERR ) {
			alert(t_placeholder_sp.ERR);
		} else {
			alert(t_placeholder);
		}

		t.focus();

		var offset = t.offset();
		if( offset ) {
			$('html, body').animate({scrollTop: parseInt(offset.top)-60}, 360);
		}
		valicheck = false;

		return valicheck;
	}

	return valicheck;
}

function inputfieldCheck( f_fm ) {

	var o_OBJ = {};
		o_OBJ = f_fm.serializeArray();

	var valicheck = true;

	$(o_OBJ).each(function(i,data){

		var t = f_fm.find("[name='"+data.name+"']");
		var t_required = t.attr("required");
		var t_placeholder = t.attr("data-placeholder");
		if( !t_placeholder )
			t_placeholder = t.attr("placeholder");

		var t_value = t.val();
		var t_patten = t.attr("data-patten");
		var t_msgview = t.attr("data-msgview");

		if( t_required == 'required' ) {

			var b_chk_inp = true;

			if( !t_value ) {
				b_chk_inp = false;
			} else if( t_patten ) {
				var o_tmp_patten = new RegExp( t_patten  );
			 	b_chk_inp = (o_tmp_patten.test(t_value)) ? true : false;
			}

			if( !b_chk_inp ) {
				if( t_msgview ) {
					$(t_msgview).text(t_placeholder);
				} else {
					alert(t_placeholder);
				}
				t.focus();

				var offset = t.offset();
				if( offset ) {
					$('html, body').animate({scrollTop: parseInt(offset.top)-60}, 360);
				}
				valicheck = false;

				return valicheck;
			} else {
				if( t_msgview ) {
					$(t_msgview).text('');
				}
			}
		}

	});

	return valicheck;
}

function stripTags(input, allowed) {
    allowed = (((allowed || "") + "").toLowerCase().match(/<[a-z][a-z0-9]*>/g) || []).join(''); // making sure the allowed arg is a string containing only tags in lowercase (<a><b><c>)
    var tags = /<\/?([a-z][a-z0-9]*)\b[^>]*>/gi,
        commentsAndPhpTags = /<!--[\s\S]*?-->|<\?(?:php)?[\s\S]*?\?>/gi;
    return input.replace(commentsAndPhpTags, '').replace(tags, function ($0, $1) {        return allowed.indexOf('<' + $1.toLowerCase() + '>') > -1 ? $0 : '';
    });
}

function strNum(str) {
   if(str < 10) {
	   return '0'+str;
   } else {
	   return str;
   }
}

var newwindow;
function createPop(url, name) {
	newwindow = window.open(url,name,'width=420,height=720,scrollbars=yes,resizeable=no');
	if (window.focus) {newwindow.focus()}
}

function numComma(element) {
	var num = element.value;
	var str = Number(num.replace(/[^0-9]/g, ''));
	//var tmp = str.replace(/(\d)(?=(?:\d{3})+(?!\d))/g, '$1,');
	var tmp = str.toLocaleString();

	element.value = tmp;
}

//문자 제거
function removeChar(event) {
    event = event || window.event;
    var keyID = (event.which) ? event.which : event.keyCode;
    if (keyID == 8 || keyID == 46 || keyID == 37 || keyID == 39)
        return;
    else
        //숫자와 소수점만 입력가능
        event.target.value = event.target.value.replace(/[^-\.0-9]/g, "");
}
//콤마 찍기
function newComma(obj) {
    var regx = new RegExp(/(-?\d+)(\d{3})/);
    var bExists = obj.indexOf(".", 0);//0번째부터 .을 찾는다.
	var strArr = obj.split('.');
    while (regx.test(strArr[0])) {//문자열에 정규식 특수문자가 포함되어 있는지 체크
        //정수 부분에만 콤마 달기
        strArr[0] = strArr[0].replace(regx, "$1,$2");//콤마추가하기
    }
	var result;
    if (bExists > -1) {
        //. 소수점 문자열이 발견되지 않을 경우 -1 반환
		strArr[1] = strArr[1].substring(0,2);
        result = strArr[0] + "." + strArr[1];
    } else { //정수만 있을경우 //소수점 문자열 존재하면 양수 반환
        result = strArr[0];
    }
    return result;//문자열 반환
}

function roundToTwo(num) {
    return +(Math.round(num + "e+2")  + "e-2");
}

//콤마 풀기
function unnewComma(str) {
    str = "" + str.replace(/,/gi, ''); // 콤마 제거
    str = str.replace(/(^\s*)|(\s*$)/g, ""); // trim()공백,문자열 제거
    return (new Number(str));//문자열을 숫자로 반환
}
//input box 콤마달기
function inputNumberFormat(obj) {
    obj.value = newComma(obj.value);
}

function phoneFormat(element) {
  var num = element.value;
  var str = num.replace(/[^0-9]/g, '');
  var tmp = '';

  if(num.substr(0,2) == "02"){
      element.setAttribute("maxlength","12");
      if( str.length < 3){
          tmp = str;
      }else if(str.length < 6){
          tmp += str.substr(0, 2);
          tmp += '-';
          tmp += str.substr(2);
      }else if(str.length < 10){
          tmp += str.substr(0, 2);
          tmp += '-';
          tmp += str.substr(2, 3);
          tmp += '-';
          tmp += str.substr(5);
      }else{
          tmp += str.substr(0, 2);
          tmp += '-';
          tmp += str.substr(2, 4);
          tmp += '-';
          tmp += str.substr(6);
      }

  } else if(num.substr(0,2) == "11" || num.substr(0,2) == "12" || num.substr(0,2) == "13" || num.substr(0,2) == "14" || num.substr(0,2) == "15" || num.substr(0,2) == "16" || num.substr(0,2) == "17" || num.substr(0,2) == "18" || num.substr(0,2) == "19"){
      element.setAttribute("maxlength","9");
      if( str.length < 4 ) {
          tmp = str;
      } else if( str.length < 9 ) {
          tmp += str.substr(0, 4);
          tmp += '-';
          tmp += str.substr(4, 4);
      }

  } else {
      element.setAttribute("maxlength","13");
      if( str.length < 4) {
          tmp = str;
      } else if(str.length < 7) {
          tmp += str.substr(0, 3);
          tmp += '-';
          tmp += str.substr(3);
      } else if(str.length < 11) {
          tmp += str.substr(0, 3);
          tmp += '-';
          tmp += str.substr(3, 3);
          tmp += '-';
          tmp += str.substr(6);
      } else {
          tmp += str.substr(0, 3);
          tmp += '-';
          tmp += str.substr(3, 4);
          tmp += '-';
          tmp += str.substr(7);
      }
  }

  element.value = tmp;
}


function bizNoFormat(element) {
  var num = element.value;
  var str = num.replace(/[^0-9]/g, '');
  var tmp = '';

  element.setAttribute("maxlength","12");
  if( str.length < 3) {
      tmp = str;
  } else if(str.length < 5) {
      tmp += str.substr(0, 3);
      tmp += '-';
      tmp += str.substr(3);
  } else if(str.length < 12) {
      tmp += str.substr(0, 3);
      tmp += '-';
      tmp += str.substr(3, 2);
      tmp += '-';
      tmp += str.substr(5);
  }

  element.value = tmp;
}

function getParams() {
	var t_qry = document.location.hash.replace("#","");
	var params = {};
	if( decodeURI(t_qry) ) {
		params = JSON.parse(decodeURI(t_qry));
	}

	return params;
}

function setParams(params) {
	var params_en = encodeURI(JSON.stringify(params))
	window.location.hash = params_en;
	return params_en;
}

function goUrl( s_url ) {
	if( s_url ) {
		document.location.href = s_url;
	}
	return false;
}

function replaceUrl( s_url ) {
	if( s_url ) {
		document.location.replace(s_url);
	}
	return false;
}

function goWin( s_url ) {
	if( s_url ) {
		window.open(s_url);
	}
	return false;
}

function goPop(url, name, width) {
	if( !width ) width = 800;
	newwindow = window.open(url,name,'width='+width+',height=720,scrollbars=yes,resizeable=no,top=10,left=10');
	if (window.focus) {newwindow.focus()}
}

function goExcel( s_url, c_type, i_width ) {

	if( c_type == "EXCEL" ) {
		document.location.href = s_url;
	} else {
		var wX = screen.availWidth-100;
		var wY = 700;

		if( i_width ) {
			wX = parseInt( i_width );
		}
		window.open(s_url, s_url, 'width='+wX+', height='+wY+'');
	}
	return false;
}

function getCookie( cookieName ) {
	var search = cookieName + "=";
	var cookie = document.cookie;

	if( cookie.length > 0 ) {

		startIndex = cookie.indexOf( cookieName );

		if( startIndex != -1 ) {

			startIndex += cookieName.length;
			endIndex = cookie.indexOf( ";", startIndex );

			if( endIndex == -1) { endIndex = cookie.length; }

			return unescape( cookie.substring( startIndex + 1, endIndex ) );
		} else {
			return false;
		}
	} else {
		return false;
	}
}


function setCookie( name, value, expiredays ) {
	var todayDate = new Date();
	todayDate.setDate( todayDate.getDate() + expiredays );
	document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + todayDate.toGMTString() + ";"
}

function nl2br(str) {
	return str.replace(/\n/g, "<br />");
}

function autoHypenPhone(str) {

	str = str.replace(/[^0-9]/g, '');
	var tmp = '';
	if( str.length < 4){
		return str;
	} else if(str.length < 7) {
		tmp += str.substr(0, 3);
		tmp += '-';
		tmp += str.substr(3);
		return tmp;
	} else if(str.length < 11) {
		tmp += str.substr(0, 3);
		tmp += '-';
		tmp += str.substr(3, 3);
		tmp += '-';
		tmp += str.substr(6);
		return tmp;
	} else {
		tmp += str.substr(0, 3);
		tmp += '-';
		tmp += str.substr(3, 4);
		tmp += '-';
		tmp += str.substr(7);
		return tmp;
	}
	return str;
}

function setNumber( o_OBJ, c_TYPE ) {
	str = o_OBJ.value;
	if( c_TYPE == 'jumin') {
		str = str.replace(/[^0-9]/g, '');
		if(str.length >6){ str=str.substr(0,6)+'-'+str.substr(6); }
		//	else( str=str;}
	} else if( c_TYPE == 'company') {
		str = str.replace(/[^0-9]/g, '');
		if(str.length>12){ alert('잘못된 사업자번호입니다'); str=str.substr(0,10); }
		if(str.length >2 && str.length <5){ str=str.substr(0,3)+'-'+str.substr(3); }
		else if(str.length > 4 && str.length <13){ str=str.substr(0,3)+'-'+str.substr(3,2)+'-'+str.substr(5,6); }
		//	else( str=str;}
	} else if( c_TYPE == 'phone') {
		str = str.replace(/[^0-9]/g, '');
		str = str.replace(/(^02.{0}|^01.{1}|[0-9]{3})([0-9]+)([0-9]{4})/,"$1-$2-$3");
		// if(str.length < 4){ str=str; }
		// else if(str.length < 7){ str=str.substr(0, 3)+'-'+str.substr(3); }
		// else if(str.length < 11 ){ str=str.substr(0, 3)+'-'+str.substr(3, 3)+'-'+str.substr(6); }
		// else { str=str.substr(0, 3)+'-'+str.substr(3, 4)+'-'+str.substr(7); }
	} else if( c_TYPE == 'money') {
		str = str.replace(/,/g,'');
		var i_num = parseInt( str );
		var c_minus = "";
		if( i_num < 0 ) {
			c_minus = "-";
		}
		if(str.length < 3){
			str=str.replace(/[^0-9-]/g, '');
		} else {
			str = String( str.replace(/[^0-9]/g, '') );
			str = str.replace(/(\d)(?=(?:\d{3})+(?!\d))/g, '$1,');
			str = c_minus + str;
		}
	} else if( c_TYPE == 'date') {
		str = str.replace(/-/g,'');
		if(str.length < 4){ str=str; }
		else if(str.length < 6){ str=str.substr(0, 4)+'-'+str.substr(4); }
		else { str=str.substr(0, 4)+'-'+str.substr(4, 2)+'-'+str.substr(6); }
	} else if( c_TYPE == '4etc') {
		str = str.replace(/-/g,'');
		str = str.replace(/(\w)(?=(?:\w{4})+(?!\w))/g, '$1-');
	} else if( c_TYPE == 'phone2') {
		str = str.replace(/[^0-9]/g, '');
		str = str.replace(/([0-9]+)([0-9]{4})/,"$1-$2");
	} else if( c_TYPE == 'type1') {
		str = str.replace(/[^0-9]/g, '');
		str = str.replace(/([0-9]{5})([0-9]{4})([0-9]{1})([0-9]+)/,"$1-$2-$3-$4");
	}
	o_OBJ.value = str;
}

//콤마풀기
function uncomma(str) {
    str = String(str);
    return str.replace(/[^\d]+/g, '');
}

//콤마찍기
function comma(str) {
    str = uncomma(String(str));
    return str.replace(/(\d)(?=(?:\d{3})+(?!\d))/g, '$1,');
}

//[] <--문자 범위 [^] <--부정 [0-9] <-- 숫자
//[0-9] => \d , [^0-9] => \D
var rgx1 = /\D/g;  // /[^0-9]/g 와 같은 표현
var rgx2 = /(\d+)(\d{3})/;

function getNumber(obj) {
     var num01;
     var num02;
     num01 = obj.value;
     num02 = num01.replace(rgx1,"");
     num01 = setComma(num02);
     obj.value =  num01;
}

function putLoadingSpinner( c_TYPE ) {

	if( c_TYPE == 1 ) {
		$('.obj_public_loading').fadeIn(0);
	} else if( c_TYPE == 0 ) {
		$('.obj_public_loading').fadeOut(0);
	}

}


function popInit( t ) {

	var sct = $('.obj_pop[data-role='+t+'] > .obj_popup > .obj_pop_cnts_area').scrollTop();

	$('.obj_pop[data-role='+t+'] > .obj_popup > .obj_pop_cnts_area').height('auto');

	if( $('.obj_pop[data-role='+t+'] > .popup').height() > ($(window).height()-20) ) {
		$('.obj_pop[data-role='+t+'] > .obj_popup > .obj_pop_cnts_area').height($(window).height()-150);
	}

	$('.obj_pop[data-role='+t+'] > .obj_popup > .obj_pop_cnts_area').scrollTop(sct);

	$('.obj_pop[data-role='+t+']').find('.btn_pop_close').unbind().click(function() {
		$('.obj_pop[data-role='+t+']').hide().remove();
		$('.xdsoft_datetimepicker').remove();
		$('.wrapper').removeClass('blur');
	});

	$('body').removeClass('loading');
	$('.wrapper').addClass('blur');

}