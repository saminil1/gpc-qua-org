<?php
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}

include_once(G5_THEME_PATH.'/head.php');
?>

<div id="main_visual" class="main_sec">	
	<div class="slider">
	
		<div class="roll roll01">
			<div class="black"></div>
			<!------영상일 경우 : video src="http://a01.sgedu.co.kr/theme/a01/img/visual01.mp4" autoplay="autoplay" loop="loop" muted="muted"></video------->
			<div class="roll_wrap">
                <h2>GPC is globally recognized</h2>
                <hr>
                <p>personnel certification body<br class="mobile_no" /></p>
                <a href="javascript:" class="btn_more">더보기</a>
			</div>
		</div>		
		
		<div class="roll roll02">
		    <div class="roll_wrap">
                <h2>GPC is <br class="s_mobile_no">a global <br class="s_mobile_no">personnel certification body</h2>
                <hr>
                <p>that trains auditors with competitiveness <br class="s_mobile_only">and expertise<br class="mobile_no" /></p>
                <a href="javascript:" class="btn_more">더보기</a>
            </div>
		</div>
		<div class="roll roll03">
		    <div class="roll_wrap">
                <h2>GPC has accredited</h2>
                <hr>
                <p>from IAS to provide customers <br/>with reliable personnel certification services<br></p>
                <a href="javascript:" class="btn_more">더보기</a>
            </div>
		</div>
		
		<div class="roll roll04">
		    <div class="roll_wrap">
                <h2>GPC is an international<br/> personnel certification body</h2>
                <hr>
                <p>that understands <br class="s_mobile_only">the requirements of ISO/IEC 17024 <br/>and achieves customer satisfaction</p>
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
    
    
    .main_cert .form_wrap{/* 검색 입력폼 & 검색 버튼 영역*/
        width: 90%;	
        max-width: 500px;
        align-items: center;
        margin: 0px auto;
        text-align: center;

    }
    .main_cert .form_wrap input{/* 검색 입력폼 */
        width: 70%;
        box-shadow: inset 0 2px 4px 0 hsla(0,0%,0%, 0.2);
        border: 1px solid hsl(0deg 0% 0% / 40%);
    }
    .main_cert .form_wrap button{/* 검색 버튼 */
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
        color: #d63217;
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
        .main_cert .form_wrap {/* 모바일 해상도에 맞춰 검색 입력폼 & 검색 버튼 영역 width값 100%로 변경 */
            width: 90%;	
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
      <h2>GPC CERT SEARCH
		  <span>GPC Certificate Verification</span>
	  </h2>
		<div class="form_wrap">
			<input type="text" name="cert_code" id="cert_code" onkeypress="if(window.event.keyCode==13){certProxt.getData()}" placeholder="Please enter your GPC certificate nuber." />
			<button id="cert_btn">SEARCH</button>
		</div>
	</div>
	<div id="cert_rst" class="wrap"></div>
</section>

<?
}
?>
<!-----// 인증서검색 종료 //------------>

<section class="main_sec main_bbs" style="background-color: #fff;">
	<div class="wrap">
	<!-- 질문과답변 최근글 /theme/테마/skin/latest/qna/latest.skin.php---->
<section><?php echo latest('theme/qna', 'notification_en', 3, 40); ?></section>
		<!-- 일반 최근글 /theme/테마/skin/latest/basic/latest.skin.php>----->
<section><?php echo latest('theme/basic', 'introduce_en', 3, 40); ?></section>
		<!-- 일반 최근글 /theme/테마/skin/latest/basic/latest.skin.php -->
<section><?php echo latest('theme/basic', 'notice_en', 3, 40); ?></section>
	</div>
</section>


<section class="main_sec main_about">
    <hr style="display:block;position:absolute;left:0;top:0;width:100%;height:1px;background:#d63217">
	<div class="flex_wrap animatedParent animateOnce" data-sequence="500">
		<div class="img animated fadeInRightShort" data-id="1">
            <!--<img src="<?php echo G5_THEME_URL ?>/img/main_about_img01.jpg" alt="Global Inter Certification" />-->
		   
			<!----br--->
			<!--- style="display:block;margin-left:-10px;"  ----->
			
		</div>
		<div class="text animated fadeInUpShort" data-id="2">
			<div class="animatedParent animateOnce" data-sequence="250">
				<h2 class="animated fadeInUpShort" data-id="1"><!---about----> <strong>Global Personnel Certification</strong></h2>
				<!----------h3 class="animated fadeInUpShort" data-id="2" style="color:#333333;">고객님의 성공을 위한 큰 힘이 되겠습니다.</h3---------->
				<p class="animated fadeInUpShort" data-id="2">GPC is<br> an accredited personnel certification body <br class="mobile_no">that contributes to the professional development of customers.</p>
				<p class="animated fadeInUpShort" data-id="3">We provide credible qualification management services <br class="mobile_no"> through fair and objective competence verification <br class="mobile_no">and high-quality education and training.</p>
				<div class="btn_area animated fadeInUpShort" data-id="4">
					<a href="<?php echo G5_THEME_URL ?>/company/introduce.php">Introduction</a>
					<a href="<?php echo G5_THEME_URL ?>/company/location.php">Location</a>
				</div>
				<div class="cs animated fadeInUpShort" data-id="5">
				    <div class="cs_area">
				        <p class="title">CS Center</p>
				        <p class="tel">TEL 02-6749-0710 &nbsp;<small>Business hours AM 09:00 ~ PM 06:00</small></p>
                    </div>
				</div>
			</div>
		</div>
	</div>
	<hr style="display:block;position:absolute;left:0;bottom:0;width:100%;height:1px;background:#d63217">
</section>

<section class="main_sec main_focus">
    <div class="wrap">
        <div class="main_focus_title">
            <h2>Business Area</h2>
            <p class="sub_tit">Core values of Global Personnel Certification for you</p>
        </div>
        <div class="main_focus_con">
            <ul class="main_focus_icon_wrap">
                <li>
                    <a href="<?php echo G5_THEME_URL ?>/service/01_auditor.php">
                        <div class="icon_box"><i class="fas fa-graduation-cap"></i></div>
                        <p class="li_tit">Auditor Certification</p>
                        <p class="li_txt">Management system auditor certification <br class="tb_no" /> based on ISO/IEC 17024</p>
                        <div class="more_area">
                            <span class="more">MORE VIEW</span>
                            <div class="arrow">
                                <i class="fas fa-arrow-right"></i>
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="<?php echo G5_THEME_URL ?>/service/02_training.php">
                        <div class="icon_box"><i class="fas fa-university"></i></div>
                        <p class="li_tit">Training Provider</p>
                        <p class="li_txt">Auditor training and certification services <br class="tb_no" /> for nurturing professionals</p>
                        <div class="more_area">
                            <span class="more">MORE VIEW</span>
                            <div class="arrow">
                                <i class="fas fa-arrow-right"></i>
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="<?php echo G5_THEME_URL ?>/service/03_exam.php">
                        <div class="icon_box"><i class="fas fa-pencil-alt"></i></div>
                        <p class="li_tit">Examination</p>
                        <p class="li_txt">Auditor exam for evaluating <br class="tb_no" /> the competence and qualifications of auditor</p>
                        <div class="more_area">
                            <span class="more">MORE VIEW</span>
                            <div class="arrow">
                                <i class="fas fa-arrow-right"></i>
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="<?php echo G5_THEME_URL ?>/service/04_edu.php">
                        <div class="icon_box"><i class="fas fa-book"></i></div>
                        <p class="li_tit">Training</p>
                        <p class="li_txt">Management system training course <br class="tb_no" /> to nurture professionals</p>
                        <div class="more_area">
                            <span class="more">MORE VIEW</span>
                            <div class="arrow">
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
            <h2>Our Competitiveness</h2>
            <p>Ability to perform specialized services with specialized partners in each field</p>
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
                            <strong class="con_tit">International Personnel Certification Body</strong>
                            <p>GPC is an international personnel certification body <br> that certifies personnel qualifications <br>in accordance with ISO/IEC 17024.</p>
                        </div>
                        <div class="enter">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </a>
                </li>
                <li class="small_img_box">
                    <a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=igcglobal">
                        <div class="con_img">
                            <img src="<?php echo G5_THEME_URL ?>/img/company_img02.png" alt="협력업체">
                        </div>
                        <div class="con_text black">
                            <strong class="con_tit">Partners</strong>
                            <p>Experts in each field provide active services <br>with a high understanding of certification <br>through certification experience in various industries.</p>
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
                            <strong class="con_tit">Commitment of Impartiality</strong>
                            <p>We will make every effort to ensure that all activities are fair <br>and that there are no conflicts of interest.</p>
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
		<h2>Resources</h2>
		<!-- 제품 슬라이드 /theme/구매테마/skin/latest/pic_block_slide/latest.skin.php -->
		<?php echo latest('theme/pic_block_slide', 'notice_en', 4, 30); ?>
	</div>
</section>


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
			$('#cert_rst').html('<p>Please, enter a valid search term.</p>');
			return false;
		}

		$('#cert_rst').html('<div class="lds-ring" style="color: #999"><div></div><div></div><div></div><div></div></div>');
		$.get('/lib/certProxy/search.php',{'code':cert_code},function(r){
			//console.log(r);            
			if(r === '') r = '<p>GPC. There is no certificate inquiry result.</p>';
			$('#cert_rst').hide().html(r).fadeIn(1500);
		});
	}
}

$('#cert_btn').click(certProxt.getData);

<?
}
?>
</script>


<?php
include_once(G5_THEME_PATH.'/tail.php');
?>