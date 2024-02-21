// ------------------------------------------------ 검색영역 활성화  
function openNav() {
    document.getElementById("searchBar").style.marginTop = "0px";
}
function closeNav() {
    document.getElementById("searchBar").style.marginTop = "-110px";
}


// ------------------------------------------------ gnb 상단에 고정
$(function() {

    var myObj = $('#main-navigation');
        if (myObj.length){
        var lnb = myObj.offset().top
    } //   var lnb = $("#main-navigation").offset().top; 같은 구문
 
  $(window).scroll(function() {
   
    var window = $(this).scrollTop();
    
    if(lnb <= window) {
      $("#main-navigation").addClass("fixed-top");
    }else{
      $("#main-navigation").removeClass("fixed-top");
    }
  })
});


// ------------------------------------------------ 모바일 gnb 활성화
function myFunction() {
  let x = document.getElementById("nav");
  
  if (x.style.display === "block") {
    x.style.display = "none";
  } else {
    x.style.display = "block";
  }
}


// ------------------------------------------------  모바일 gnb 리스트 토글 드롭다운 
$(function(){         
    //메뉴 슬라이드
    $('#nav > .depth1 > a').click(function(){
        $(this).next($('.depth2List')).slideToggle('fast');
    })

    // 버튼 클릭 시 스타일 변경
    $('li > a').focus(function(){
        $(this).addClass('active');
    })
    $("li > a").blur(function(){
        $(this).removeClass('active');
    })

})

// ------------------------------------------------ tab menu
function openMenu(evt, menuName) {
  let i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }

  document.getElementById(menuName).style.display = "block";
  evt.currentTarget.className += " active";
}
// Get the element with id="defaultOpen" and click on it
// document.getElementById("defaultOpen").click();


// ------------------------------------------------ TOP btn
$(function() {
    $("#btn_top").on("click", function() {
        $("html, body").animate({scrollTop:0}, '1000');
        return false;
    });
});


// ------------------------------------------------  우편번호 검색 스크립트 시작
    
function kakaopost() {
    //팝업 위치를 지정(화면의 가운데 정렬)
    var width = 500; //팝업의 너비
    var height = 600; //팝업의 높이
    
    new daum.Postcode({
        width: width, //생성자에 크기 값을 명시적으로 지정해야 합니다.
        height: height,
        oncomplete: function(data) {
            // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

            // 각 주소의 노출 규칙에 따라 주소를 조합한다.
            // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
            var addr = ''; // 주소 변수
            var extraAddr = ''; // 참고항목 변수

            //사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
            if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                addr = data.roadAddress;
            } else { // 사용자가 지번 주소를 선택했을 경우(J)
                addr = data.jibunAddress;
            }

            // 사용자가 선택한 주소가 도로명 타입일때 참고항목을 조합한다.
            if(data.userSelectedType === 'R'){
                // 법정동명이 있을 경우 추가한다. (법정리는 제외)
                // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
                if(data.bname !== '' && /[동|로|가]$/g.test(data.bname)){
                    extraAddr += data.bname;
                }
                // 건물명이 있고, 공동주택일 경우 추가한다.
                if(data.buildingName !== '' && data.apartment === 'Y'){
                    extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                }
                // 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
                if(extraAddr !== ''){
                    extraAddr = ' (' + extraAddr + ')';
                }
                // 조합된 참고항목을 해당 필드에 넣는다.
                document.getElementById("extraAddress").value = extraAddr;

            } else {
                document.getElementById("extraAddress").value = '';
            }

            // 우편번호와 주소 정보를 해당 필드에 넣는다.
            document.getElementById('zipcode').value = data.zonecode;
            document.getElementById("address1").value = addr;
            // 커서를 상세주소 필드로 이동한다.
            document.getElementById("address2").focus();
        }
    }).open({
        left: (window.screen.width / 2) - (width / 2),
        top: (window.screen.height / 2) - (height / 2)
    });
}


// ------------------------------------------------ 확인 버튼 클릭시 테이블 보임 
function onDisplay() {
    $('.apply_process').show();
}

    





