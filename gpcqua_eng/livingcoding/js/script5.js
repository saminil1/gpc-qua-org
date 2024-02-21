// tab menu
$(function() {
    $("#tab li").click(function(){
        var num = $("#tab li").index(this);
        $(".tabContent").removeClass('active');
        $(".tabContent").eq(num).addClass('active');
        $(".tabContent").eq(num).addClass('num'+num);
        $("#tab li").removeClass('active');
        $(this).addClass('active')
    });
    // tab in tab
    $(".tab2 li").click(function(){
        var num = $(".tab2 li").index(this);
        $(".tabContent2").removeClass('active');
        $(".tabContent2").eq(num).addClass('active');
        $(".tab2 li").removeClass('active');
        $(this).addClass('active')
    });
});