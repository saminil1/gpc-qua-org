<?php
$page_meta_tags = '
<meta name="title" content="GPC 시험응시 절차">
<meta name="description" content="GPC 시험응시 절차, 1. GPC 지식 및 인성 시험 신청, 2. 신청 서류 검토, 3. 시험 일정 안내, 4. GPC 지식 및 인성 시험 진행, 5. 합격증 발행">
<meta name="keywords" content="GPC 시험응시 절차, 시험 프로세스, 지식 시험, 인성 시험, 서류 검토, 시험 일정 안내, 합격증 발행, 신청서, 개인 정보">
<meta property="og:type" content="website"> 
<meta property="og:title" content="GPC 시험응시 절차">
<meta property="og:description" content="GPC 시험응시 절차, 1. GPC 지식 및 인성 시험 신청, 2. 신청 서류 검토, 3. 시험 일정 안내, 4. GPC 지식 및 인성 시험 진행, 5. 합격증 발행">
<meta property="og:url" content="https://www.gpcert.org/theme/gpcert/service/exam_process.php">
';
include_once('./_common.php');
$g5['title'] = 'GPC 시험응시 절차';
include_once(G5_THEME_PATH.'/head.php');
?>
<style>
    /* ---------------------- 시작: 컨텐츠 페이지별 css ---------------------- */ 
	.point_col { color:#0f8a75;border-color: #0f8a75 }/*각 서브페이지의 포인트 컬러*/
    .point_b1 { display: inline-block;color: #d63217; font-size: 1rem; font-weight: 500; margin-bottom: 10px }/* 본문의 강조부분 css */
    .link:hover { color: blue;text-decoration: underline }/* 링크에 대한 css */
    
    /* 문단 부분에 대한 css */
    .page_con .con_txt .con_txt_li p { padding: 15px 0 }
    .page_con .con_txt .con_txt_li ul { margin: 0 3% }
    .page_con .con_txt .con_txt_li .con_li_tt { font-size: 1.05rem;font-weight: 500;padding: 50px 0 0;position: relative }
    .page_con .con_txt .con_txt_li .con_li_tt::before { content: '';display: inline-block;width: 20px;height: 3px;background: #0f8a75;position: absolute;left: 0;top: 35px }/* point_col와 동일한 색 적용 */
    
    /* 컨텐츠 02 GPC 시험응시 절차에 대한 css */
    .arrow { position: relative;margin: 0 0 50px }
    .triangle { display: inline-block;position: absolute;left: -16px;top: 15px;width: 0;height: 0;border-left: 30px solid transparent;border-right: 30px solid transparent;border-bottom: 30px solid #fff;transform: rotate(90deg);}
    .arrow_tit { font-size:1.1rem;font-weight: 500;margin-bottom: 10px }
    .arrow_txt { display: inline-block;width: 100%;height: 60px;background: #0f8a75;text-align: center;font-size: 1.15rem;font-weight: bold;line-height: 60px;color: #fff; }/* point_col와 동일한 색 적용 */
    .step_wrap { display: flex;margin: 20px 0 50px }
    .step { flex: 1;padding: 20px }
    .icon { width: 40%;text-align: center;margin: 0 auto 30px }
    
    .con_txt .step_wrap:nth-child(2) .step {flex: 0.315}/* .step의 갯수가 홀수여서 사이즈 변경 */

    /* ------------------------ 시작: 컨텐츠 공통 css ------------------------ */ 
    
    .content_wrap {width:100%; max-width:1200px; margin:0 auto;font-size: 1rem; font-weight: 400;line-height: 1.6 }/* 서브페이지 전체 레이아웃 */
    section, article { margin-bottom: 70px }/* 문단 하단 부분과 푸터와의 마진 */
    
    /* 페이지 제목에 대한 css */
    .container_title { display: block !important; color:#555; font-size:1.6rem; line-height:1; font-weight:700; text-align:center; border-radius:4px; background:#fff; box-shadow: 1px 2px 8px #eee; width:100%; padding:30px 0; margin: 0 0 50px; }/* 서브페이지 페이지 타이틀 생성 / 20210730 전산: 이혜정 */
    
    /* 상단 제목에 대한 css */
    .page_title { margin:70px auto }
    .page_title .top_tt { width:100%; margin:70px auto 0; text-align:center; font-size:2.2rem; font-weight:600; }/* 상단 제목 css */
	.page_title .top_tt::after { content:""; clear:both; display:block; width:40px; margin:50px auto 0; border:1px solid #999; }/* 상단 제목의 arrow css */
	.page_title .top_stt { width:100%; margin:0 auto 70px; padding: 40px 0 0; text-align:center; font-size:1.8rem; font-weight:600; }/* 상단 부제목 css */
	.page_title .top_txt { width: 100%;margin: 70px auto;text-align: justify }/* 개요부분 css */
    
    /* 문단 부분에 대한 css */
    .page_con { width: 100%;margin: 70px auto }
    .page_con .con { border: 2px solid #d8d8d8;margin-top: 50px }
    .page_con .con_tt { font-size: 1.5rem; font-weight: 500; text-align: left; margin: 0 auto 30px auto;width: 90%;padding: 30px 0 20px;border-bottom: 2px solid }/* 문단 제목 css */
    .page_con .con_stt { font-size: 1.15rem; font-weight: 500; text-align: left; margin: 0 auto 20px auto;width: 100%; }/* 문단 부제목 css */
    .page_con .con_txt { width: 90%;margin: 70px auto;text-align: justify }/* 본문 css */
    
    /* 이미지에 대한 css */
    .con_img { width: 60%;text-align: center;margin: 70px auto }/* 문단에 쓰이는 이미지의 css */
    .con_img img { width: 100%; }/* 문단의 쓰이는 이미지의 크기 */
    
    /* 부가설명박스에 대한 css */
    .sub_txt { width:90%; margin: 30px auto;font-size:0.95rem; color:#555; background:#f7f7f7;border-radius: 5px;text-align: justify}
	.sub_txt ul { width: 100%;margin: 0 auto;padding: 25px }
	.sub_txt ul li { padding-left: 20px;position: relative }
	.sub_txt ul li .number { content: '';display: inline-block;width: 5px;height: 5px;position: absolute;left: 0;top: 0 }/* 문단 리스트 스타일 : 숫자 */
    .sub_txt ul li .bullet { content: '';display: inline-block;width: 5px;height: 5px;background: #222;border-radius: 50%;position: absolute;left: 0;top: 10px }/* 문단 리스트 스타일 : 불릿 */
    
    /* FAQ에 대한 css */
    .faq_bg { width: 100%;height: 300px;background: url(./image/faq_bg.png)no-repeat center;background-size: cover; margin: 0 0 50px;position: relative }
    
    .faq_wrap .accordion { border-bottom: 1px solid #0f8a75;color: #0f8a75;cursor: pointer;padding: 20px 40px 20px 50px;width: 100%;text-align: left;position: relative }/* point_col와 동일한 색 적용 */
    .faq_wrap .accordion::before { content: '';float: right;width: 10px;height: 10px;margin: 6px 0 0 20px;border-bottom:2px solid #ccc;border-right:2px solid #ccc;transform: rotate(45deg) }/* 열림 버튼 생성 */
    .faq_wrap .accordion::after { content: "Q";display: block;width: 40px;float: left;text-align: center;margin-left: -40px;font-size: 1.45rem;font-weight: 700;line-height: 1;position: absolute;top:20px }/* 알파벳 Q */
    .faq_wrap .accordion.active, .faq_wrap .accordion:hover { background-color: #0f8a75;color: #fff }/* 아코디언 클래스를 클릭, 호버될 경우 배경색 변경 / point_col와 동일한 색 적용 */
    
    .faq_wrap .accordion.active::before { transform: rotate(-135deg);margin: 10px 0 0 }/* 숨기기 버튼 생성 */

    .faq_wrap .panel { background-color: inherit;max-height: 0;overflow: hidden;transition: 0.4s ease-in-out;opacity: 0 }
    .faq_wrap .panel ul { padding: 20px; }
    .faq_wrap .panel.show { opacity: 1;max-height: 500px;padding: 20px 40px 20px 50px;box-shadow: 0 4px 6px 0 rgb(0 0 0 / 25%);position: relative }/* 패널에 클래스 show 붙을 경우 */
    .faq_wrap .panel::before { content: "A";display: block;width: 40px;float: left;text-align: center;margin-left: -40px;font-size: 1.45rem;font-weight: 700;line-height: 1;color: #e55d51;position: absolute;top:20px }/* 알파벳 A */

    /* ------------------------ 시작: 반응형 css ------------------------ */   

	@media (max-width:1024px) {
        .page_title .top_tt { font-size: 1.85rem }
    }

	@media screen and (max-width:768px) {	
        .con_txt { width: 100% }
        .con_txt ul { width: 100% }
        .container_title { display:none !important }
	}
    
    @media screen and (max-width:640px) {	
        .con_img { width: 100% }
        .con_img.inside { width: 90% }
        .page_con .con_txt { margin: 20px auto }
        .step_wrap { display: block;margin: 0 }
        .step { margin: 0 auto 30px;border: 1px solid #d1d1d1;padding: 30px }
        .arrow_tit { font-size: 1rem }
       
	}

	@media all and (min-width:360px) and (max-device-width : 414px) {
        .content_wrap {font-size: 0.95rem}
        .page_title .top_tt { font-size: 1.35rem }
        .con_img { width: 100% }
        .page_con .con_tt { font-size: 1.05rem;width: 100%;margin: 0 }
        .page_con .con_stt { font-size: 1.05rem }
        .page_con .con dl { width: 90%;margin: 0 auto 30px }
        .sub_txt { width: 100%;margin: 0;font-size: 0.9rem }
        .faq_bg { margin: 70px 0;background: url(./image/m_faq_bg.png)no-repeat center; }
        .faq_wrap .accordion { margin-bottom: 0 }
        .faq_wrap .accordion::before { width: 10px;height: 10px;border-bottom: 1px solid #ccc;border-right: 1px solid #ccc }
        .faq_wrap .panel.show { box-shadow: none;background: #f4f4f4; }
	}    
</style>


<div class="content_wrap">
	<div class="tab_menu tab01">
		<ul>
			<!-- 활성화 메뉴에 class="on" // 탭메뉴 페이지 분리 20230323 HJ -->
			<li><a href="/theme/gpcert/service/exam_introduction.php">GPC 시험소개</a></li>
			<li class="on"><a href="/theme/gpcert/service/exam_process.php">GPC 시험응시 절차</a></li>
            <li><a href="/theme/gpcert/service/exam_FAQ.php">GPC 시험FAQ</a></li>
		</ul>
	</div>
    
    <div class="tab_con">
        <!--+++++ GPC 시험응시 절차 // 탭메뉴 페이지 분리 20230323 HJ +++++-->
        <article style="display:block">
            <div class="page_title">
                <h1 class="top_tt point_col">GPC 시험응시 절차</h1>
                <!--<h2 class="top_stt">ISO 45001:2018</h2>-->
                <!--<p class="top_txt"></p>-->
            </div>
            <div class="page_con">
                <ul>
                    <li class="con">
                        <dl>
                            <dt>
                                <h3 class="con_tt point_col"><i class="fas fa-check-circle" style="margin-right:10px"></i>시험 프로세스</h3>
                            </dt>
                            <dd class="con_txt" >
                                <div class="step_wrap">
                                    <div class="step">
                                        <div class="arrow">
                                            <span class="triangle"></span>
                                            <span class="arrow_txt"><span style="display: inline-block;width: 20px"></span>Step 1</span>
                                        </div>
                                        <div class="icon">
                                            <img src="./image/form.png" alt="GPC 지식 및 인성 시험 신청">
                                        </div>
                                        <h4 class="arrow_tit">1. GPC 지식 및 인성 시험 신청</h4>
                                    </div>
                                    <div class="step">
                                        <div class="arrow">
                                            <span class="triangle"></span>
                                            <span class="arrow_txt"><span style="display: inline-block;width: 20px"></span>Step 2</span>
                                        </div>
                                        <div class="icon">
                                            <img src="./image/paper.png" alt="신청 서류 검토">
                                        </div>
                                        <h4 class="arrow_tit">2. 신청 서류 검토</h4>
                                    </div>
                                    <div class="step">
                                        <div class="arrow">
                                            <span class="triangle"></span>
                                            <span class="arrow_txt"><span style="display: inline-block;width: 20px"></span>Step 3</span>
                                        </div>
                                        <div class="icon">
                                            <img src="./image/date.png" alt="시험 일정 안내">
                                        </div>
                                        <h4 class="arrow_tit">3. 시험 일정 안내</h4>
                                    </div>
                                </div>
                                <div class="step_wrap">
                                    <div class="step">
                                        <div class="arrow">
                                            <span class="triangle"></span>
                                            <span class="arrow_txt"><span style="display: inline-block;width: 20px"></span>Step 4</span>
                                        </div>
                                        <div class="icon">
                                            <img src="./image/test.png" alt="GPC 지식 및 인성 시험 진행">
                                        </div>
                                        <h4 class="arrow_tit">4. GPC 지식 및 인성 시험 진행</h4>
                                    </div>
                                    <div class="step">
                                        <div class="arrow">
                                            <span class="triangle"></span>
                                            <span class="arrow_txt"><span style="display: inline-block;width: 20px"></span>Step 5</span>
                                        </div>
                                        <div class="icon">
                                            <img src="./image/certificate.png" alt="합격증 발행">
                                        </div>
                                        <h4 class="arrow_tit">5. 합격증 발행</h4>
                                    </div>
                                </div>
                                <div class="sub_txt">
                                    <ul>
                                        GPC 시험을 진행하기 위해서는 꼭 신청서를 제출해야 합니다. 신청서에는 개인 정보 및 교육 수료를 증빙할 수 있는 내용을 기재해야 합니다. 신청 서류 검토 후 추가적인 보완이 필요없을 경우 시험 일정을 안내해드립니다. 추가적인 문의 사항이 있는 경우, <a href="mailto:info@gpcert.org" class="link gpc_email">info@gpcert.org</a>로 연락해주시기 바랍니다.
                                    </ul>
                                </div>
                            </dd>
                        </dl>
                    </li>
                </ul>
            </div>
        </article>
    </div><!-------div class="tab_con" 종료------>
</div><!---------/class="content_wrap" 종료/------------>
<?php
include_once(G5_THEME_PATH.'/tail.php');
?>