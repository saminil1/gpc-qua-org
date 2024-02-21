<?php
$page_meta_tags = '
<meta name="title" content="GPC 시험 소개">
<meta name="description" content="GPC로부터 심사원 인증을 받거나 유지하기 위해서는 반드시 해당 표준과 관련해 시험을 치러야 합니다. 시험은 지식 및 인성시험으로 구성되어 있으며, 배정된 시간은 총 100분입니다. ">
<meta name="keywords" content="GPC 시험 소개, 심사원 인증, 시험 응시자, 신분증, 감독관, 부정행위, 퇴실, 지식시험, 오픈북, ISO 표준, 적격성, 자질, 인성 시험, ISO 19011, 연수기관, GPC 본사, 개별 시험, 온라인">
<meta property="og:type" content="website"> 
<meta property="og:title" content="GPC 시험 소개">
<meta property="og:description" content="GPC로부터 심사원 인증을 받거나 유지하기 위해서는 반드시 해당 표준과 관련해 시험을 치러야 합니다. 시험은 지식 및 인성시험으로 구성되어 있으며, 배정된 시간은 총 100분입니다. ">
<meta property="og:url" content="https://www.gpcert.org/theme/gpcert/service/exam_introduction.php">
';
include_once('./_common.php');
$g5['title'] = 'GPC 시험 소개';
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
			<li class="on"><a href="/theme/gpcert/service/exam_introduction.php">GPC 시험소개</a></li>
			<li><a href="/theme/gpcert/service/exam_process.php">GPC 시험응시 절차</a></li>
            <li><a href="/theme/gpcert/service/exam_FAQ.php">GPC 시험FAQ</a></li>
		</ul>
	</div>
    
    <div class="tab_con">
        <!--+++++ GPC 시험 소개 // 탭메뉴 페이지 분리 20230323 HJ +++++-->
        <article style="display:block">
            <div class="page_title">
                <h1 class="top_tt point_col">GPC 시험 소개</h1>
                <!--<h2 class="top_stt">ISO 9001:2015</h2>-->
                <p class="top_txt">
                    GPC로부터 심사원 인증을 받거나 유지하기 위해서는 반드시 해당 표준과 관련해 시험을 치러야 합니다.<br><br>
                    시험 장소와 시간은 미리 통보되며, 통상 토요일 오전 10시에 진행됩니다.<br>
                    시험 응시자는 시험 시작 10분 전에 도착해야 하며, 지각 또는 결석 시 자동으로 0점 처리됩니다.<br><br>
                    시험 응시자는 시험을 위해 신분증(사진이 포함된)을 제시해야 합니다.<br><br>
                    시험 응시자는 시험에 있어 사용이 금지된 물건을 감독관에게 미리 안내해야하며, 부정행위가 확인될 경우, 시험 감독관은 퇴실을 요구할 수 있으며 더 이상의 시험은 불가합니다.
                </p>
            </div>
            <div class="page_con">
                <ul>
                    <li class="con">
                        <dl>
                            <dt>
                                <h3 class="con_tt point_col"><i class="fas fa-check-circle" style="margin-right:10px"></i>GPC 시험</h3>
                            </dt>
                            <dd>
                                <div class="con_img inside">
                                    <img src="./image/test_01.jpeg" alt="GPC 시험">
                                </div>
                                <div class="con_txt">
                                    시험은 지식 및 인성시험으로 구성되어 있으며, 배정된 시간은 총 100분입니다. 지식 시험은 오픈북으로 진행됩니다.
                                    <div class="con_txt_li">
                                        <h4 class="con_li_tt point_col">1. 지식시험</h4>
                                        <p>
                                            지식 시험은 ISO 표준에 대한 지식을 평가하기 위한 시험으로 심사활동을 수행하고자 하는 후보자의 적격성 및 자질을 평가합니다.<br>
                                            지식 시험은 총 50문항으로, 4개의 섹션으로 구성되어 있으며, 아래 합격 기준을 모두 충족하여야 합격으로 인정됩니다.
                                        </p>
                                        <ul class="point_col">
                                            <li>- 섹션 별 정답률 40% 이상</li>
                                            <li>- 총 70점 이상 취득</li>
                                        </ul>
                                        <p>
                                            시험에 통과하지 못할 경우, 1번의 재시험 기회가 주어집니다.<br>
                                            연속으로 시험에 불합격할 경우, 시험 응시자는 1년간 지식 시험을 다시 치를 수 없습니다.
                                        </p>
                                    </div>
                                    <div class="con_txt_li">
                                        <h4 class="con_li_tt point_col">2. 인성 시험</h4>
                                        <p>
                                            인성 시험은 ISO 19011에 기초하고 있으며, 심사원으로서 자격과 특성을 평가합니다. 또한 시험 응시자가 문항에 대해 어느 정도 이해하고 있는지를 파악합니다.
                                        </p>
                                        <p>
                                            인성 시험은 총 25문항으로, 70점 이상일 경우 합격입니다.<br>
                                            각 문항에 대해 최대 4점을 부여하며, 정답에서 멀어질수록 1점씩 감점됩니다. (미 선택 시, 0점) 시험 응시자들은 정답이라고 생각되는 것을 지체 없이 선택해야 합니다.
                                        </p>
                                        <p>
                                            시험에 통과하지 못할 경우, 한 번의 면접의 기회가 주어집니다.<br>
                                            해당 면접에 통과하지 못할 경우, 1년 간 인성시험을 다시 치를 수 없습니다.
                                        </p>
                                    </div>
                                </div>
                            </dd>
                        </dl>
                    </li>
                    <!--<hr style="border-top: 1px dotted #999999;display:block;margin: 50px auto 2px;width:100%;">-->
                    <li class="con">
                        <dl>
                            <dt>
                                <h3 class="con_tt point_col"><i class="fas fa-check-circle" style="margin-right:10px"></i>시험 방법</h3>
                            </dt>
                            <dd>
                                <div class="con_img inside">
                                    <img src="./image/test_02.jpg" alt="시험 방법">
                                </div>
                                <div class="sub_txt">
                                    <ul><span class="point_b1"><i class="far fa-edit" style="margin-right: 6px;"></i>GPC 시험은 아래 3가지 방법을 통해 진행될 수 있습니다.</span>
                                        <li>
                                            <span class="number">1. </span>연수기관
                                            <span style="display:block">- GPC로부터 지정 받은 연수기관에서 교육과 시험을 동시에 진행할 수 있습니다.</span>
                                        </li>
                                        <li>
                                            <span class="number">2. </span>GPC 방문
                                            <span style="display:block">- GPC 본사로 직접 방문하여 시험을 치룰 수 있습니다.</span>
                                            <span style="display:block">- 시험은 사전에 접수된 인원에 대해 매달 마지막 주 토요일 오전 10시에 진행됩니다.</span>
                                        </li>
                                        <li>
                                            <span class="number">3. </span>개별 시험
                                            <span style="display:block">- 1, 2번 방법으로 시험 진행이 어려운 경우, GPC 내부 절차에 따라 온라인으로 시험을 진행할 수 있습니다.</span>
                                            <span style="display:block">- 단, 시험을 성실히 진행하겠다는 선언 및 보안 준수 서약서가 요구되며, 위 1, 2번의 방법으로 시험 진행이 어려움을 증명해야 합니다.</span>
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