/*
$(function(){ // 서브페이지 탭메뉴
	var tab = $('.tab01 ul');
	var tabMenu = tab.find('> li');
	var contents = $('.tab_con > article');

	tabMenu.on('click', function(){
		tabMenu.removeClass('on');
		$(this).addClass('on');
		contents.css('display', 'none');
        
		var i = $(this).index();
		contents.eq(i).css('display', 'block');

	});
});

$(function(){ // 서브페이지 탭메뉴 (k-beauty 인증 소개 페이지)
	var tab = $('.tabMenu ul');
	var tabMenu = tab.find('> li');
	var contents = $('.tab_con > article');

	tabMenu.on('click', function(){
		tabMenu.removeClass('on');
		$(this).addClass('on');
		contents.css('display', 'none');
        
		var i = $(this).index();
		contents.eq(i).css('display', 'block');

	});
});
*/

/* ------ 서브페이지 Sticky Sidebar 20220330 HJ ------ */

function offset(el) {
  var rect = el.getBoundingClientRect(),
    scrollLeft = window.pageXOffset || document.documentElement.scrollLeft,
    scrollTop = window.pageYOffset || document.documentElement.scrollTop;
  return { top: rect.top + scrollTop, left: rect.left + scrollLeft }
}

window.addEventListener("load", function() {
  var lastScrollTop = 0;
  var article = document.getElementById("right_area");
  var aside = document.getElementById("left_area");
    
  if (document.documentElement.clientWidth > 767 && article.offsetHeight > aside.offsetHeight) {
    window.addEventListener("scroll", function() {
        
      var scrT = window.pageYOffset || document.documentElement.scrollTop;
      var winH = document.documentElement.clientHeight;
      var sideH = aside.offsetHeight;
      var dir = (scrT > lastScrollTop) ? "down" : "up"; lastScrollTop = scrT;
      var sideT = offset(aside).top;
      var topLine = offset(article).top - 190;
      var bottomLine = topLine + article.offsetHeight - winH;
      
      if (sideH > winH) {
        if (dir == "down") {
          if (scrT >= (sideT + sideH - winH) && scrT < bottomLine) {
            aside.style.marginTop = scrT - topLine - (sideH - winH) + 'px';
          }
          if (scrT >= bottomLine) {
            aside.style.marginTop = Math.max(topLine + article.offsetHeight - sideH - topLine, 0) + 'px';
          }
        } else {
          if (scrT <= sideT && scrT > topLine) {
            aside.style.marginTop = scrT - topLine + 'px';
          }
          if (scrT <= topLine) {
            aside.style.marginTop = 0;
          }
        }
      } else {
        bottomLine = topLine + article.offsetHeight - sideH;
        if (dir == "down") {
          if (scrT > topLine && scrT < bottomLine) {
            aside.style.marginTop = scrT - topLine + 'px';
          }
          if (scrT >= bottomLine) {
            aside.style.marginTop = bottomLine - topLine + 'px';
          }
        } else {
          if (scrT > topLine && scrT < bottomLine) {
            aside.style.marginTop = scrT - topLine + 'px';
          }
          if (scrT <= topLine) {
            aside.style.marginTop = 0;
          }
        }
      } if (matchMedia("screen and (max-width: 1024px)").matches) {
        
        /*
            Device Mode로 테스트 중 태블릿 & 모바일 브라우저에서 화면 흔들림 이슈 발생
                ==> 태블릿 & 모바일버전에서 Sidebar 레이아웃 변경되면서 상단에 고정되므로 Sticky Sidebar는 default 한다 // 20220404 HJ 
        */
        
        aside.style.marginTop = 0;
        
      }
    });
  }
});


/* ------ 서브페이지 왼쪽 snb 영역 스크롤 시 컨텐츠 길이가 짧을 경우 푸터와 겹침 이슈 해결 20210813 전산: 이혜정 ------ */
/*var hd_height = $("#header").height();

$(document).scroll(function(){
    curSc = $(document).scrollTop() + $(window).height();
    body_height = $("#contents").height();
    footer_height = $("#footer").height();
    bottom_top = body_height - footer_height;
    if(curSc > bottom_top + 15){
        $("#left_area").css('top', 'auto');
        $("#left_area").css('bottom', curSc - bottom_top + 240);
    }else{
        $("#left_area").css('top', hd_height);
    }
});

$(document).ready(function(){ //TOP버튼

	// hide #back-top first
	$("#top_btn").hide();
	
	// fade in #back-top
	$(function () {
		$(window).scroll(function () {
			if ($(this).scrollTop() > 100) {
				$('#top_btn').fadeIn();
			} else {
				$('#top_btn').fadeOut();
			}
		});

		// scroll body to 0px on click
		$('#top_btn').click(function () {
			$('body,html').animate({
				scrollTop: 0
			}, 1000);
			return false;
		});
	});

});*/
