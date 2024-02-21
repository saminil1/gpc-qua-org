// 설정 : /js/apply.js 파일에 해당 스크립트 함수 생성
// 신청 내역 확인
$(document).on("click","#btn_iso_login",function(){
	
	if(!$("#login_id").val()) {
		alert("아이디를 입력하세요");
		$("#login_id").focus();
		return false;
	}
	
	if(!$("#login_pw").val()) {
		alert("비밀번호를 입력하세요");
		$("#login_pw").focus();
		return false;
	}
	
	$.ajax({
		url : g5_url + "/theme/gpcert/apply/ajax.apply_confirm.php",
		type: "POST",
		data: { iso_mode: $("#iso_mode").val(), mb_id: $("#login_id").val(), mb_password: $("#login_pw").val() },
		success: function(data) {
			var res  = jQuery.parseJSON(data);
			if(res.error) {
				alert(res.error);
				$("#submiT").empty();
				return false;
			}
			if(res.result == "y") {
				$("#submiT").empty().html(res.content);
				
				var acc = document.getElementsByClassName("mobile-arrow");
				var panel = document.getElementsByClassName("table_list");
				var point_clk = document.getElementsByClassName("iso_label");

				for (var i = 0; i < acc.length; i++) {
					acc[i].onclick = function() {
						var setClasses = !this.classList.contains('active');
						setClass(acc, 'active', 'remove');
						setClass(panel, 'show', 'remove');
						setClass(point_clk, 'active', 'remove');

						if (setClasses) {
							this.classList.toggle("active");
							this.parentElement.parentElement.classList.toggle("show");
							this.parentElement.classList.toggle("active");
						}
					}
				}

				function setClass(els, className, fnName) {
					for (var i = 0; i < els.length; i++) {
						els[i].classList[fnName](className);
					}
				}
			}
		}
	});
});


// 신청 내역 확인 : 코드
$(document).on("click","#btn_code_login",function(){
	if(!$("#scode").val()) {
		alert("인증번호를 입력하세요");
		$("#scode").focus();
		return false;
	}	
	
	$.ajax({
		url : g5_url + "/theme/gpcert/apply/ajax.apply_confirm.php",
		type: "POST",
		data: { iso_mode: $("#iso_mode").val(), scode: $("#scode").val() },
		success: function(data) {
			var res  = jQuery.parseJSON(data);
			if(res.error) {
				alert(res.error);
				$("#submiT").empty();
				return false;
			}
			if(res.result == "y") {
				$("#submiT").empty().html(res.content);
				
				var acc = document.getElementsByClassName("mobile-arrow");
				var panel = document.getElementsByClassName("table_list");
				var point_clk = document.getElementsByClassName("iso_label");

				for (var i = 0; i < acc.length; i++) {
					acc[i].onclick = function() {
						var setClasses = !this.classList.contains('active');
						setClass(acc, 'active', 'remove');
						setClass(panel, 'show', 'remove');
						setClass(point_clk, 'active', 'remove');

						if (setClasses) {
							this.classList.toggle("active");
							this.parentElement.parentElement.classList.toggle("show");
							this.parentElement.classList.toggle("active");
						}
					}
				}

				function setClass(els, className, fnName) {
					for (var i = 0; i < els.length; i++) {
						els[i].classList[fnName](className);
					}
				}
			}
		}
	});
});

// 자격정보 입력
$(document).on("click", "#submitIsoAction", function() {
	if(!$('input:radio[name="iso_standard"]').is(':checked')) {
		alert("신청규격을 선택하세요.");
		return false;
	}
	
	if(!$('input:radio[name="iso_grade"]').is(':checked')) {
		alert("등급을 선택하세요.");
		return false;
	}
	
	if(!$('input:radio[name="iso_type"]').is(':checked')) {
		alert("유형을 선택하세요.");
		return false;
	}
	
	$("#fm_write").submit();
});

//신청자 정보 입력
$(document).on("click", "#submitAction", function() {
	var mode = $("input:hidden[name=w]").val();
	var is_member = $("input:hidden[name=is_member]").val();
	
	if(!$("#name_kr").val()) {
		alert("이름(한)을 입력하세요");
		$("#name_kr").focus();
		return false;
	}

	if(!$("#name_en").val()) {
		alert("이름(영)을 입력하세요");
		$("#name_en").focus();
		return false;
	}

	if(!$("#hp").val()) {
		alert("핸드폰번호를 입력하세요");
		$("#hp").focus();
		return false;
	}

	if(!$("#email").val()) {
		alert("이메일을 입력하세요");
		$("#email").focus();
		return false;
	}
	
	if (validateEmail($("#email").val()) != true) { // 이메일 검사
		alert("이메일을 정확하게 입력하세요.");
		$("#email").focus();
		return false;
	}

	if(!is_member) {// 비회원 : 아이디, 이메일 중복검사
		if(!$("#reg_mb_id").val()) {
			alert("아이디를 입력하세요");
			$("#reg_mb_id").focus();
			return false;
		}
		/*
		if(!$("#reg_mb_nick").val()) {
			alert("닉네임을 입력하세요");
			$("#reg_mb_nick").focus();
			return false;
		}
		*/

		if(!$("#reg_mb_password").val()) {
			alert("비밀번호를 입력하세요");
			$("#reg_mb_password").focus();
			return false;
		}

		if(!$("#reg_mb_password_re").val()) {
			alert("비밀번호 확인을 입력하세요");
			$("#reg_mb_password_re").focus();
			return false;
		}
		
		if($("#reg_mb_password").val() != $("#reg_mb_password_re").val()) {
			alert("비밀번호가 같지 않습니다.");
			$("#reg_mb_password_re").focus();
			return false;
		}
	}

	if(!$("#zipcode").val()) {
		alert("수령주소를 입력하세요");
		$("#zipcode").focus();
		return false;
	}

	if(!$("#termsOfService").prop("checked")) { 
		alert("이용약관에 동의하셔야 합니다.");
		$("#termsOfService").focus();
		return false;
	}
	
	if(!$("#privacyPolicy").prop("checked")) { 
		alert("개인정보 처리방침에 동의하셔야 합니다.");
		$("#privacyPolicy").focus();
		return false;
	}
	
	var form = $('#fm_write')[0];
	var formData = new FormData(form);
	var save_result = "";
	$.ajax({
		enctype: 'multipart/form-data',
		processData: false,
		type: "POST",
		//data: order_data,
		data: formData,
		url: g5_url+"/theme/gpcert/apply/ajax.apply_update.php",
		contentType: false,
		cache: false,
		async: false,
		success: function(data) {
			save_result = data;
		}
	});

	if(save_result) {
		alert(save_result);
		return false;
	}

	var url = g5_url+"/theme/gpcert/apply/apply_confirm.php?od_id=" + $("input:hidden[name=od_id]").val();
	$(location).attr('href',url);
	//$("#fm_write").submit();

});

$(document).on("change","input:radio[name='app_way']",function(){
	if($("input:radio[name='app_way']:checked").val() == 'n'){
		$(".custom-control-input-text").attr("disabled", true);
	} else {
		$(".custom-control-input-text").attr("disabled", false);
	}
});


$(document).ready(function() {
	/* 중복확인 버튼 클릭시 이메일 사용여부 메세지 출력
	$(".duplicate_text").hide();
	function duplicatecheck() {
		event.preventDefault();
		$(".duplicate_text").show();
	}
	*/
	// 이용약관 & 개인정보취급방침 아코디언 이벤트
	$('.btn-acc.serVice').click(function() {
		$('.btn-acc.serVice').toggleClass('up');
		$('.acc-layer.service').toggleClass('in');
	});
	$('.btn-acc.poliCy').click(function() {
		$('.btn-acc.poliCy').toggleClass('up');
		$('.acc-layer.policy').toggleClass('in');
	});
});


// 이메일 검사
function validateEmail(email) {
	var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
	return re.test(email);
};

