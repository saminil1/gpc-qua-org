// tab menu
	$(".tab li").click(function () {
		var num = $(".tab li").index(this);
		$(".tabContent").removeClass('active');
		$(".tabContent").eq(num).addClass('active');
		$(".tab li").removeClass('active');
		$(this).addClass('active')
	});

var _scrollTop = window.scrollY || document.documentElement.scrollTop;


console.log(_scrollTop)