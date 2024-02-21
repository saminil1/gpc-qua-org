<?php
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}
$page_meta_tags = '
<meta name="title" content="GPC인증원">
<meta name="description" content="GPC인증원은 미국의 인정 기관 IAS로부터 ISO/IEC 17024에 기반하여 인정을 취득한 개인인증 기관으로 서비스를 제공하고 있습니다.">
<meta name="keywords"content="심사원이증, 연수기관지정, 시험, 심사원 교육, 교육, 심사원 자격 인증, ISO 9001 심사원, ISO 14001 심사원, ISO 13485 심사원 심사원, ISO 22000 심사원, ISO/IEC 27001 심사원, ISO 45001 심사원, ISO 21001 심사원, ISO 22301 심사원, ISO/IEC 27701 심사원, ISO 37001 심사원, Auditor Certification, Auditor, Certification">
<meta property="og:type" content="website">
<meta property="og:title" content="GPC인증원">
<meta property="og:description" content="GPC인증원은 미국의 인정 기관 IAS로부터 ISO/IEC 17024에 기반하여 인정을 취득한 개인인증 기관으로 서비스를 제공하고 있습니다.">
<meta property="og:url" content="https://www.gpcert.org/">
';
include_once(G5_THEME_PATH.'/head.php');
?>

<div id="main_visual" class="main_sec">	
   <div class="slider">
     <div class="roll roll01">
	    <div class="black"></div>
	<!------영상일 경우 : video src="http://a01.sgedu.co.kr/theme/a01/img/visual01.mp4" autoplay="autoplay" loop="loop" muted="muted"></video------->
        <div class="roll_wrap" style="color:white;">
            <h2>GPC K-beauty ISO/IEC 17024</h2>
            <hr>
            <p>GPC는 ISO/IEC 17024를 기반으로 전문성 있는 자격등록서비스를 제공합니다.<br class="mobile_no" /></p>
            <a href="javascript:" class="btn_more">더보기</a>
        </div>
	</div>		
	
	<div class="roll roll02 lazy">
        <div class="roll_wrap" style="color:white;">
            <h2>GPC K-beauty 심사원양성</h2>
            <hr>
            <p>GPC는 자격등록과 관련하여 글로벌한 리더로서 인정받고 있습니다.<br class="mobile_no" /></p>
            <a href="javascript:" class="btn_more">더보기</a>
        </div>
	</div>
	<div class="roll roll03 lazy">
        <div class="roll_wrap" style="color:white;">
            <h2>GPC K-beauty 자격등록 서비스</h2>
            <hr>
            <p>GPC는 고품질의 자격등록서비스를 제공하여  <br class="s_mobile_only" />고객들의 신뢰를 얻고 있습니다.<br></p>
            <a href="javascript:" class="btn_more">더보기</a>
        </div>
	</div>
	
	<div class="roll roll04 lazy">
        <div  class="roll_wrap" style="color:white;">
            <h2>GPC Global Leader</h2>
            <hr>
            <p>GPC는 개인 인증 분야에서 <br class="s_mobile_only" />글로벌한 리더로서 인정받고 있습니다.</p>
            <a href="javascript:" class="btn_more">더보기</a>
        </div>
	</div>
  </div>
</div>

<!-------메인페이지 로고 하단 클릭했을 때 인증서검색 바로가기/// -------->
<div id="certification_search"></div>
        
	
	<!-- 메인 이벤트 /theme/테마/skin/latest/event/latest.skin.php -->
	<!----?php echo latest('theme/event', 'event', 1, 10); ?---->
	<!-- /메인 이벤트 -->		

<?
$v = @$_GET['view'];
if($v != 'dev'){
?>

<style type="text/css">
    
 /*기본CSS, 시작*/	
	
    /* ------------------------ 인증서 검색 영역 css 시작 ------------------------ */
    
    
    .main_cert .form_wrapper{/* 검색 입력폼 & 검색 버튼 영역*/
        width: 90%;	
        max-width: 500px;
        align-items: center;
        margin: 0px auto;
        text-align: center;

    }
    .main_cert .form_wrapper input{/* 검색 입력폼 */
        width: 70%;
        box-shadow: inset 0 2px 4px 0 hsla(0,0%,0%, 0.2);
        border: 1px solid hsl(0deg 0% 0% / 40%);
    }
    .main_cert .form_wrapper button{/* 검색 버튼 */
        margin-left: 8px;
        padding:7px 15px;
        border:1px solid #aca3da;
        background: #fff;
        vertical-align: top;
        color:#222;
        font-size: 1em;
        font-weight: 500;
        box-shadow: 0 2px 6px 0 rgb(0 0 0 / 25%)
    }

    .main_cert #cert_rst{/* 검색 결과 전체 영역 */
        position:relative;
        top:0px;
        text-align: left;
        font-size: 1.05em;
        margin: 0px auto;
        max-width: 800px;
        color:#333;
        padding: 50px 0 50px;

    }

    .main_cert #cert_rst div {/* 검색 결과값 문단 */
        padding: 4px 0;
        display: flex;/* 문단의 제목과 내용을 분리시킴 */
    }
    

    .main_cert #cert_rst div b {/* 검색 결과값 문단의 제목(구분) */
        font-size: 1.1rem;
        font-weight: 300;
        color: #ea4c89;
        flex: 1
    }

    .main_cert #cert_rst p{
        text-align: center;
    }

    .main_cert #cert_rst b::before{
        content: '';
        margin-right: 10px;
        margin-bottom: 2px;
        width: 10px;
        height: 10px;
        display: inline-block;
        border: 1px solid #999;
        border-radius: 2px

    }
    .main_cert #cert_rst span{/* 검색 결과값 문단의 내용 */
        display: inline-block;
        margin-left: 14px;
        font-size: 1rem;
        font-weight: 300;
        color: #333;
        flex: 2.6;
    }
    
    /* 인증서검색 영역 검색 중 Loader 영역 시작 */

    .main_cert #cert_rst .lds-ring,.lds-ring div {
        box-sizing: border-box;
    }
        .main_cert #cert_rst .lds-ring {
            display: inline-block;
            position: relative;
            width: 100%;
            height: 40px;
        }
        .main_cert #cert_rst .lds-ring div {
            box-sizing: border-box;
            display: block;
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 36px;
            height: 36px;
            margin: 4px;
            border: 4px solid currentColor;
            border-radius: 50%;
            animation: lds-ring 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
            border-color: currentColor transparent transparent transparent;
        }
        .main_cert #cert_rst .lds-ring div:nth-child(1) {
            animation-delay: -0.45s;
        }
        .main_cert #cert_rst .lds-ring div:nth-child(2) {
            animation-delay: -0.3s;
        }
        .main_cert #cert_rst .lds-ring div:nth-child(3) {
            animation-delay: -0.15s;
        }
        @keyframes lds-ring {

            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }

        }

    /* 인증서검색 영역 검색 중 Loader 영역 종료 */
    
    
/* ------------------------ 인증서 검색 영역 css 시작 ------------------------ */  
    
   
    
/* ------------------------ 인증서 검색 영역 반응형 시작 ------------------------ */     

@media (max-width: 1280px){
	.main_product.main_cert { 
	    padding: 50px 0;
	}
    
}
    
    
@media only screen and (max-device-width : 768px) and (-webkit-min-device-pixel-ratio: 1) {
        .main_cert #cert_rst {
            padding: 30px;/* 전체 레이아웃에(.wrap에 패딩값: 0 30px) 맞춰서 사이드 30px 적용 */
    }
}    
  
    
@media all and (max-device-width : 640px) {
        .main_cert #cert_rst div {/* 태블릿 해상도에 맞춰 결과값 내용에 display: flex 제거 */
            display: block;
    }
}
    

@media all and (min-width:360px) and (max-device-width : 414px) {
        .main_cert .form_wrapper {/* 모바일 해상도에 맞춰 검색 입력폼 & 검색 버튼 영역 width 100%로 변경 */
            width: 100%;
    }
        .main_cert #cert_rst span {/* 모바일 해상도에 맞춰 결과값 내용을 분리시킴 */
            display: block;
    }
}
    
/* ------------------------ 인증서 검색 영역 반응형 종료 ------------------------ */  
    
    
</style>

<!-----// 인증서검색 시작,  맨 아래 코드 추가 참조, 개발 2021년6월22일 //------------>
<section class="main_sec main_cert">
	<div class="wrap"> <!---- style="margin-top:-0.1%;------->
      <h2>인 증 서 검 색
		  <span>GPC Certification Search</span>
	  </h2>
		<div class="form_wrapper">
			<input type="text" name="cert_code" id="cert_code" onkeypress="if(window.event.keyCode==13){certProxt.getData()}" placeholder="GPC 인증서 번호를 입력해주세요." />
			<button id="cert_btn">검색</button>
		</div>
	</div>
	<div id="cert_rst" class="wrap"><!--검색결과 영역--></div>
</section>

<?
}
?>
<!-----// 인증서검색 종료 //------------>

<section class="main_sec main_bbs" style="background-color: #fff;">
	<div class="wrap">
	<!-- 공지사항 최근글 /theme/테마/skin/latest/qna/latest.skin.php---->
<section><?php echo latest('theme/qna', 'notification', 3, 40); ?></section>
    
		<!-- 뉴스레터, 일반 최근글 /theme/테마/skin/latest/basic/latest.skin.php>----->
<section><?php echo latest('theme/basic', 'introduce', 3, 40); ?></section>
    
		<!-- 자료파일,일반 최근글 /theme/테마/skin/latest/basic/latest.skin.php -->
<section><?php echo latest('theme/basic', 'notice', 3, 40); ?></section>
	</div>
</section>


<section class="main_sec main_about">
    <hr style="display:block;position:absolute;left:0;top:0;width:100%;height:1px;background:#ea4c89">
	<div class="flex_wrap animatedParent animateOnce" data-sequence="500">
		<div class="img animated fadeInRightShort" data-id="1">
            <!--<img src="<?php echo G5_THEME_URL ?>/img/main_about_img01.jpg" alt="Global Inter Certification" />-->
		   
			<!----br--->
			<!--- style="display:block;margin-left:-10px;"  ----->
			
		</div>
		<div class="text animated fadeInUpShort" data-id="2">
			<div class="animatedParent animateOnce" data-sequence="250">
				<h2 class="animated fadeInUpShort" data-id="1"><!---about----> <strong style="color:#ea4c89;">Global Personnel Certification</strong></h2>
				<!----------h3 class="animated fadeInUpShort" data-id="2" style="color:#333333;">고객님의 성공을 위한 큰 힘이 되겠습니다.</h3---------->
				<p class="animated fadeInUpShort" data-id="2"><span style="color:#ea4c89;">GPC</span>는<br class="pc_only_2"> 고객의 전문 역량 제고에 기여하는 <br class="pc_only_2">공인된 개인 자격 인증 기관입니다.</p>
				<p class="animated fadeInUpShort" data-id="3">공정하고 객관적인 역량 검증 및 <br class="pc_only_2"> 양질의 교육훈련을 통하여 <br class="pc_only_2">공신력 있는 자격 관리 서비스를 제공하고 있습니다.</p>
				<div class="btn_area animated fadeInUpShort" data-id="4">
					<a href="<?php echo G5_THEME_URL ?>/company/introduce.php">회사소개</a>
					<a href="<?php echo G5_THEME_URL ?>/company/location.php">오시는길</a>
				</div>
				<div class="cs animated fadeInUpShort" data-id="5">
				    <div class="cs_area">
				        <p class="title" style="color:#ea4c89;">대표번호</p>
				        <p class="tel">02-6749-0710<small>평일 AM 09:00 ~ PM 06:00</small></p>
                    </div>
				</div>
			</div>
		</div>
	</div>
	<hr style="display:block;position:absolute;left:0;bottom:0;width:100%;height:1px;background:#ea4c89">
</section>

<section class="main_sec main_focus">
    <div class="wrap">
        <div class="main_focus_title">
            <h2 style="color:#ea4c89">사업 핵심영역</h2>
            <p class="sub_tit">고객님을 위한 Global Personnel Certification만의 핵심 가치</p>
        </div>
        <div class="main_focus_con">
            <ul class="main_focus_icon_wrap">
                <li>
                    <a href="<?php echo G5_THEME_URL ?>/service/auditor_scheme.php">
                        <div class="icon_box"><i class="fas fa-graduation-cap"></i></div>
                        <p class="li_tit">개인 인증</p>
                        <p class="li_txt">ISO/IEC 17024를 기반으로 하는 다양한 <br class="tb_no" /> 산업분야의 전문인력을 위한 국제 공인 인증입니다.</p>
                        <div class="more_area">
                            <span class="more">MORE VIEW</span>
                            <div class="more_arrow">
                                <i class="fas fa-arrow-right"></i>
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="<?php echo G5_THEME_URL ?>/service/training_introduction.php">
                        <div class="icon_box"><i class="fas fa-university"></i></div>
                        <p class="li_tit">연수기관</p>
                        <p class="li_txt">전문 인력 양성을 위한 심사원 교육 및 <br class="tb_no" /> 인증 서비스를 제공합니다.</p>
                        <div class="more_area">
                            <span class="more">MORE VIEW</span>
                            <div class="more_arrow">
                                <i class="fas fa-arrow-right"></i>
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="<?php echo G5_THEME_URL ?>/service/exam_introduction.php">
                        <div class="icon_box"><i class="fas fa-pencil-alt"></i></div>
                        <p class="li_tit">시험</p>
                        <p class="li_txt">심사원의 적격성 및 자질 평가를 위한 <br class="tb_no" /> 심사원 시험입니다.</p>
                        <div class="more_area">
                            <span class="more">MORE VIEW</span>
                            <div class="more_arrow">
                                <i class="fas fa-arrow-right"></i>
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="<?php echo G5_THEME_URL ?>/service/edu_introduction.php">
                        <div class="icon_box"><i class="fas fa-book"></i></div>
                        <p class="li_tit">교육과정</p>
                        <p class="li_txt">전문 인력을 양성하기 위한 <br class="tb_no" /> 경영시스템 교육과정입니다. </p>
                        <div class="more_area">
                            <span class="more">MORE VIEW</span>
                            <div class="more_arrow">
                                <i class="fas fa-arrow-right"></i>
                            </div>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</section>

<section class="main_sec main_company">
    <div class="wrap">
        <div class="main_company_title">
            <h2 style="color:#ea4c89">우리의 경쟁력</h2>
            <p>분야별 전문적인 협력업체와 특화된 서비스 수행 능력</p>
        </div>
        <div class="main_company_con">
            <ul class="main_company_con_wrap">
                <li class="big_img_box">
                    <a href="<?php echo G5_THEME_URL ?>/company/introduce.php">
                        <div class="con_img">
                            <img src="<?php echo G5_THEME_URL ?>/img/company_img01.png" alt="세계적인 수준의 개인 인증기관" class="s_mobile_no">
                            <img src="<?php echo G5_THEME_URL ?>/img/company_img04.png" alt="세계적인 수준의 개인 인증기관" class="s_mobile_only">
                        </div>
                        <div class="con_text">
                            <strong class="con_tit">세계적인 수준의 개인 인증기관</strong>
                            <p>㈜지피씨인증원은  <br> ISO/IEC 17024에 의거하여 개인의 자격을 인증해주는 <br>국제적인 개인인증 평가기관입니다.</p>
                        </div>
                        <div class="enter">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </a>
                </li>
                <li class="small_img_box">
                    <a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=igcglobal">
                        <div class="con_img">
                            <img src="<?php echo G5_THEME_URL ?>/img/company_img04.png" alt="협력업체">
                        </div>
                        <div class="con_text black">
                            <strong class="con_tit">협력업체</strong>
                            <p>각 분야의 전문가들이 여러 산업분야의 인증 경험으로 <br>인증에 대한 이해도가 높고 능동적인 서비스를 제공합니다.</p>
                        </div>
                        <div class="enter black">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </a>
                </li>
                <li class="small_img_box">
                    <a href="<?php echo G5_THEME_URL ?>/company/impartiality.php">
                        <div class="con_img">
                            <img src="<?php echo G5_THEME_URL ?>/img/company_img03.png" alt="공정의 약속">
                        </div>
                        <div class="con_text">
                            <strong class="con_tit">공정의 약속</strong>
                            <p>모든 활동이 공정하고 이해 상충이 없도록 <br>모든 노력을 할 것입니다.</p>
                        </div>
                        <div class="enter">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
        
    </div>
    
</section>

<section class="main_sec main_product">
	<div class="wrap">
		<h2 style="color:#ea4c89">자료파일</h2>
		<!-- 제품 슬라이드 /theme/구매테마/skin/latest/pic_block_slide/latest.skin.php -->
		<?php echo latest('theme/pic_block_slide', 'notice', 4, 30); ?>
	</div>
</section>
 <!------style="padding-left:-10px;" ----->

<!-------section class="main_sec main_gallery"----->
<!--
    <h2 style="height: 1px;background-color:#ffffff;"></h2>
	<h2 style="height: 1px;background-color:#ddd9d9;"></h2>
	<h2 style="height: 1px;background-color:#ffffff;"></h2>
-->
	<!-- 포트폴리오 슬라이드 /theme/구매테마/skin/latest/portfolio/latest.skin.php -->
	<!----?php echo latest('theme/portfolio', 'portfolio', 5, 40); ?--->
<!----/section----->

<script type="text/javascript">
$(document).ready(function(){
	$('#main_visual .slider').bxSlider({
		mode: 'fade',
		auto: true,
		autoControls: true,
		stopAutoOnClick: false,
		speed: 800, 
		pager: true,
		touchEnabled: true,		
		pause: 8000
	});
});

<?
$v = @$_GET['view'];
if($v != 'dev'){

//http://igcert.net/?view=dev
?>

const certProxt = {
	data:'',
	getData:function(){
		let cert_code = $('#cert_code').val();
		if(cert_code === ''){
			$('#cert_rst').html('<p>올바른 인증서번호를 입력해주세요.</p>');
			return false;
		}

		$('#cert_rst').html('<div class="lds-ring" style="color: #999"><div></div><div></div><div></div><div></div></div>');
		$.get('/lib/certProxy/search.php',{'code':cert_code},function(r){
			//console.log(r);            
			if(r === '') r = '<p>GPC인증서 조회결과가 없습니다.</p>';
			$('#cert_rst').hide().html(r).fadeIn(1500);
		});
	}
}

$('#cert_btn').click(certProxt.getData);

<?
}
?>
</script>

<!-- Images Lazy Loading 적용 20230112 HJ -->
<script>
	document.addEventListener("DOMContentLoaded", function() {
  var lazyloadImages;    

  if ("IntersectionObserver" in window) {
    lazyloadImages = document.querySelectorAll(".lazy");
    var imageObserver = new IntersectionObserver(function(entries, observer) {
      entries.forEach(function(entry) {
        if (entry.isIntersecting) {
          var image = entry.target;
          image.classList.remove("lazy");
          imageObserver.unobserve(image);
        }
      });
    });

    lazyloadImages.forEach(function(image) {
      imageObserver.observe(image);
    });
  } else {  
    var lazyloadThrottleTimeout;
    lazyloadImages = document.querySelectorAll(".lazy");
    
    function lazyload () {
      if(lazyloadThrottleTimeout) {
        clearTimeout(lazyloadThrottleTimeout);
      }    

      lazyloadThrottleTimeout = setTimeout(function() {
        var scrollTop = window.pageYOffset;
        lazyloadImages.forEach(function(img) {
            if(img.offsetTop < (window.innerHeight + scrollTop)) {
              img.src = img.dataset.src;
              img.classList.remove('lazy');
            }
        });
        if(lazyloadImages.length == 0) { 
          document.removeEventListener("scroll", lazyload);
          window.removeEventListener("resize", lazyload);
          window.removeEventListener("orientationChange", lazyload);
        }
      }, 20);
    }

    document.addEventListener("scroll", lazyload);
    window.addEventListener("resize", lazyload);
    window.addEventListener("orientationChange", lazyload);
  }
})
</script>


<?php
include_once(G5_THEME_PATH.'/tail.php');
?>