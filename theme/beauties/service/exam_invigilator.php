<?php
$page_meta_tags = '
<meta name="title" content="심사원 교육 진행 절차">
<meta name="description" content="교육 진행 절차, 1. 교육 신청 접수, 2. 교육 비용 납부, 3. 동영상 강의 수강, 4. 교육 성취도 향상, 5. 최종 시험, 6. 교육 수료증 발행">
<meta name="keywords" content="교육 진행 절차, 교육 프로세스, 교육 신청 접수, 온라인 교육, 회원 가입, 교육 과정 신청, 비용 납부, 인보이스, 동영상 강의, 수강, 유닛 테스트, 성취도 향상, 부적합 사항, 케이스스터디, 워크샵, ISO 경영시스템, 요구사항, 이해도, 응용력 향상, 최종 시험, 심사활동, 후보자, 적격성, 자질, 수료증 발행, 진행률, 정답률">
<meta property="og:type" content="website"> 
<meta property="og:title" content="심사원 교육 진행 절차">
<meta property="og:description" content="교육 진행 절차, 1. 교육 신청 접수, 2. 교육 비용 납부, 3. 동영상 강의 수강, 4. 교육 성취도 향상, 5. 최종 시험, 6. 교육 수료증 발행">
<meta property="og:url" content="https://www.gpcert.org/theme/gpcert/service/edu_process.php">
';
include_once('./_common.php');
$g5['title'] = '시험감독관';
include_once(G5_THEME_PATH.'/head.php');
?>
<style>
    /* ---------------------- 시작: 컨텐츠 페이지별 css ---------------------- */ 
	.point_col { color:#8a380f;border-color: #8a380f }/*각 서브페이지의 포인트 컬러*/
    .point_b1 { display: block;color: #d63217; font-size: 1rem; font-weight: 500; margin-bottom: 10px }/* 본문의 강조부분 css */
    
    /* 컨텐츠 02 GPC 교육 진행 절차에 대한 css */
    .arrow { position: relative;margin: 0 0 50px }
    .triangle { display: inline-block;position: absolute;left: -16px;top: 15px;width: 0;height: 0;border-left: 30px solid transparent;border-right: 30px solid transparent;border-bottom: 30px solid #fff;transform: rotate(90deg);}
    .arrow_tit { font-size:1.1rem;font-weight: 500;margin-bottom: 10px }
    .arrow_txt { display: inline-block;width: 100%;height: 60px;background: #8a380f;text-align: center;font-size: 1.15rem;font-weight: bold;line-height: 60px;color: #fff; }/* point_col와 동일한 색 적용 */
    .step_wrap { display: flex;margin: 20px 0 50px }
    .step { flex: 1;padding: 20px }
    .icon { width: 40%;text-align: center;margin: 0 auto 30px }
 
    /* ------------------------ 시작: 컨텐츠 공통 css ------------------------ */ 
    
    .content_wrap {width:100%; max-width:1200px; margin:0 auto;font-size: 1rem; font-weight: 400;line-height: 1.6 }/* 서브페이지 전체 레이아웃 */
    section, article { margin-bottom: 70px }/* 문단 하단 부분과 푸터와의 마진 */
    
    /* 페이지 제목에 대한 css */
    .container_title { display: block !important; color:#555; font-size:1.6rem; line-height:1; font-weight:700; text-align:center; border-radius:4px; background:#fff; box-shadow: 1px 2px 8px #eee; width:100%; padding:30px 0; margin: 0 0 50px; }/* 서브페이지 페이지 타이틀 생성 / 20210730 HJ */
    
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
    
    .faq_wrap .accordion { border-bottom: 1px solid #8a380f;color: #8a380f;cursor: pointer;padding: 20px 40px 20px 50px;width: 100%;text-align: left;position: relative }/* point_col와 동일한 색 적용 */
    .faq_wrap .accordion::before { content: '';float: right;width: 10px;height: 10px;margin: 6px 0 0 20px;border-bottom:2px solid #ccc;border-right:2px solid #ccc;transform: rotate(45deg) }/* 열림 버튼 생성 */
    .faq_wrap .accordion::after { content: "Q";display: block;width: 40px;float: left;text-align: center;margin-left: -40px;font-size: 1.45rem;font-weight: 700;line-height: 1;position: absolute;top:20px }/* 알파벳 Q */
    .faq_wrap .accordion.active, .faq_wrap .accordion:hover { background-color: #8a380f;color: #fff }/* 아코디언 클래스를 클릭, 호버될 경우 배경색 변경 / point_col와 동일한 색 적용 */
    
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
			<li><a href="/theme/beauties/service/exam_instroduction.php">시험소개</a></li>
			<li><a href="/theme/beauties/service/exam_process.php">시험응시절차</a></li>
            <li class="on"><a href="/theme/beauties/service/exam_invigilator.php">시험감독관</a></li>
            <li><a href="/theme/beauties/service/exam_faq.php">FAQ</a></li>
		</ul>
	</div>
    
    <div class="tab_con">
        <!--+++++ 교육과정 소개 // 탭메뉴 페이지 분리 20230323 HJ +++++-->
        <article style="display:block">
            <div class="page_title">
                <h1 class="top_tt point_col">심사원 교육과정 소개</h1>
                <!--<h2 class="top_stt">ISO 9001:2015</h2>-->
                <p class="top_txt">
                    GPC는 경영시스템 심사원 인증 및 연수기관 지정과 관련한 IPC와의 MLA 체결을 통하여 ISO 경영시스템 심사원 교육 서비스를 제공하고 있습니다. 또한 IPC의 Scheme 및 ISO/IEC 17024의 요구사항 등 교육과 관련된 국제 공인 표준을 기반으로 LMS (Learning Management System)를 개발하여 온라인을 통한 전문인력 교육 서비스를 제공합니다. 온라인 심사원 교육 과정을 수료하면 ISO/IEC 17024를 기반으로 수립된 심사원 등록 요구사항에 따라 평가 과정을 거쳐 심사원(보) 자격을 취득할 수 있으며, 전문인력 양성 교육 과정을 통하여 전문가의 실무 능력 및 경영시스템 심사 스킬을 향상할 수 있을 뿐만 아니라 심사원 자격 갱신 요구사항으로 규정되어 있는 CPD (Continuing Professional Development) 활동으로 인정될 수 있습니다.
                </p>
            </div>
            <div class="page_con">
                <ul>
                    <li class="con">
                        <dl>
                            <dt>
                                <h3 class="con_tt point_col"><i class="fas fa-check-circle" style="margin-right:10px"></i>심사원 교육 과정</h3>
                            </dt>
                            <dd>
                                <div class="con_img inside">
                                    <img src="./image/edu_01.jpg" alt="심사원 교육 과정">
                                </div>
                                <div class="sub_txt">
                                    <ul>
                                        <li>
                                            <span class="number">1. </span>공통교육과정
                                            <span style="display:block">- 경영시스템 심사 수행에 대한 가이드라인 교육</span>
                                            <span style="display:block">- 심사원 또는 선임심사원으로 활동하기 위해서는 필수적으로 수료해야 하는 교육</span>
                                        </li>
                                        <li>
                                            <span class="number">2. </span>정규교육과정
                                            <span style="display:block">- 규격 별 요구사항 및 경영시스템 심사 수행에 대한 가이드라인 교육</span>
                                            <span style="display:block">- 교육 수료 후 ISO/IEC 17024 기반 심사원 등록 요구사항에 따라 평가 과정을 거쳐 심사원보 자격 취득 가능</span>
                                        </li>
                                        <li>
                                            <span class="number">3. </span>자격확대과정
                                            <span style="display:block">- 규격 별 요구사항에 대한 교육</span>
                                            <span style="display:block">- 교육 수료 후 ISO/IEC 17024 기반 심사원 등록 요구사항에 따라 평가 과정을 거쳐 심사원보 자격 취득 가능</span>
                                            <span style="display:block">- 타 표준 심사원보 이상 자격자 대상</span>
                                        </li>
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