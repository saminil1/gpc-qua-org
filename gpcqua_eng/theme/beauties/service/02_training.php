<?php
include_once('./_common.php');
$g5['title'] = 'Training Provider Designation';
include_once(G5_THEME_PATH.'/head.php');

	/*
		이 페이지는 jquery 로 작동됩니다.	
	*/
?>

<style>
    
    /* ---------------------- 시작: 컨텐츠 페이지별 css ---------------------- */ 
    
	.point_col { color:#6b8a0f;border-color: #6b8a0f }/*각 서브페이지의 포인트 컬러*/
    .point_b1 { display: block;color: #d63217; font-size: 1rem; font-weight: 500; margin-bottom: 10px }/* 본문의 강조부분 css */
    
    /* 컨텐츠 02 연수기관 지정 절차에 대한 css */
    .arrow { position: relative;margin: 0 0 50px }
    .triangle { display: inline-block;position: absolute;left: -16px;top: 15px;width: 0;height: 0;border-left: 30px solid transparent;border-right: 30px solid transparent;border-bottom: 30px solid #fff;transform: rotate(90deg);}
    .arrow_tit { font-size:1.1rem;font-weight: 500;margin-bottom: 10px }
    .arrow_txt { display: inline-block;width: 100%;height: 60px;background: #6b8a0f;text-align: center;font-size: 1.15rem;font-weight: bold;line-height: 60px;color: #fff; }/* point_col와 동일한 색 적용 */
    .step_wrap { display: flex;margin: 20px 0 50px }
    .step { flex: 1;padding: 20px }
    .icon { width: 40%;text-align: center;margin: 0 auto 30px }
    
    /* 테이블(Table)에 대한 css */
    /* type01 : 줄노트형식 */
    table.type01 { border-collapse: collapse;text-align: left;line-height: 1.6;border-top: 3px solid #6b8a0f;border-bottom: 3px solid #6b8a0f }/* point_col와 동일한 색 적용 */
    table.type01 th { padding: 10px 0 10px 20px;vertical-align: middle }
    table.type01 td { padding: 10px 0 10px 20px;vertical-align: top }
    table.type01 .even { background: #f4f4f4 }
    
    /* ---------------------- 종료: 컨텐츠 페이지별 css ---------------------- */
    
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
	.page_title .top_txt { width: 100%;margin: 70px auto;/*text-align: justify*/ }/* 개요부분 css */
    
    /* 문단 부분에 대한 css */
    .page_con { width: 100%;margin: 70px auto }
    .page_con .con { border: 2px solid #d8d8d8;margin-top: 50px }
    .page_con .con_tt { font-size: 1.5rem; font-weight: 500; text-align: left; margin: 0 auto 30px auto;width: 90%;padding: 30px 0 20px;border-bottom: 2px solid }/* 문단 제목 css */
    .page_con .con_stt { font-size: 1.15rem; font-weight: 500; text-align: left; margin: 0 auto 20px auto;width: 100%; }/* 문단 부제목 css */
    .page_con .con_txt { width: 90%;margin: 70px auto;/*text-align: justify*/ }/* 본문 css */
    
    /* 이미지에 대한 css */
    .con_img { width: 60%;text-align: center;margin: 70px auto }/* 문단에 쓰이는 이미지의 css */
    .con_img img { width: 100%; }/* 문단의 쓰이는 이미지의 크기 */
    
    /* 부가설명박스에 대한 css */
    .sub_txt { width:90%; margin: 30px auto;font-size:0.95rem; color:#555; background:#f7f7f7;border-radius: 5px;/*text-align: justify*/ }
	.sub_txt ul { width: 100%;margin: 0 auto;padding: 25px }
	.sub_txt ul li { padding-left: 20px;position: relative }
	.sub_txt ul li .number { content: '';display: inline-block;width: 5px;height: 5px;position: absolute;left: 0;top: 0 }/* 문단 리스트 스타일 : 숫자 */
    .sub_txt ul li .bullet { content: '';display: inline-block;width: 5px;height: 5px;background: #222;border-radius: 50%;position: absolute;left: 0;top: 10px }/* 문단 리스트 스타일 : 불릿 */
    
    /* FAQ에 대한 css */
    .faq_bg { width: 100%;height: 300px;background: url(./image/faq_bg_en.png)no-repeat center;background-size: cover; margin: 0 0 50px;position: relative }
    
    .faq_wrap .accordion { border-bottom: 1px solid #6b8a0f;color: #6b8a0f;cursor: pointer;padding: 20px 40px 20px 50px;width: 100%;text-align: left;position: relative }/* point_col와 동일한 색 적용 */
    .faq_wrap .accordion::before { content: '';float: right;width: 10px;height: 10px; margin-left: 20px; border-bottom:2px solid #ccc;border-right:2px solid #ccc;transform: rotate(45deg) }/* 열림 버튼 생성 */
    .faq_wrap .accordion::after { content: "Q";display: block;width: 40px;float: left;text-align: center;margin-left: -40px;font-size: 1.45rem;font-weight: 700;line-height: 1;position: absolute;top:20px }/* 알파벳 Q */
    .faq_wrap .accordion.active, .faq_wrap .accordion:hover { background-color: #6b8a0f;color: #fff }/* 아코디언 클래스를 클릭, 호버될 경우 배경색 변경 / point_col와 동일한 색 적용 */
    
    .faq_wrap .accordion.active::before { transform: rotate(-135deg);margin-top: 10px }/* 숨기기 버튼 생성 */

    .faq_wrap .panel { background-color: inherit;max-height: 0;overflow: hidden;transition: 0.4s ease-in-out;opacity: 0;margin-bottom:10px; }
    .faq_wrap .panel ul { padding: 20px; }
    .faq_wrap .panel.show { opacity: 1;max-height: 500px;padding: 20px 40px 20px 50px;box-shadow: 0 4px 6px 0 rgb(0 0 0 / 25%);position: relative }/* 패널에 클래스 show 붙을 경우 */
    .faq_wrap .panel::before { content: "A";display: block;width: 40px;float: left;text-align: center;margin-left: -40px;font-size: 1.45rem;font-weight: 700;line-height: 1;color: #e55d51;position: absolute;top:20px }/* 알파벳 A */
    
    
    /* ------------------------ 종료: 컨텐츠 공통 css ------------------------ */ 
    
    
    
    /* ------------------------ 시작: 반응형 css ------------------------ */   

	@media (max-width:1024px) {
        .container_title { font-size: 1.2rem }
        .tab_menu.tab01 ul li a { font-size: 0.95rem;padding: 10px }
        .page_title .top_tt { font-size: 1.6rem }
        .page_con .con_tt  { font-size: 1.3rem }
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
        .page_con .con_stt { font-size: 1rem }
        .page_con .con dl { width: 90%;margin: 0 auto 30px }
        .sub_txt { width: 100%;margin: 0;font-size: 0.9rem }
        .faq_bg { margin: 70px 0;background: url(./image/m_faq_bg_en.png)no-repeat center; }
        .faq_wrap .accordion { margin-bottom: 0 }
        .faq_wrap .panel { margin-bottom: 0 }
        .faq_wrap .panel.show { box-shadow: none;background: #f4f4f4; }
        .left_snb li:first-child a { padding: 18.5px 0 }

	}
    
    
    /* ------------------------ 종료: 반응형 css ------------------------ */    
    
    
    
</style>

<!-- 
    아코디언 FAQ 구현
    2021.08.02 
    From H.J
-->

<script>
    
// 한 번에 하나의 아코디언 탭만 열림  
document.addEventListener("DOMContentLoaded", function(event) { 

// 지정된 클래스 이름을 가진 모든 요소를 가져옵니다.
var acc = document.getElementsByClassName("accordion"); // 아코디언 클래스리스트를 가져온다.
var panel = document.getElementsByClassName('panel'); // 패널 클래스리스트를 가져온다.


for (var i = 0; i < acc.length; i++) {
    acc[i].onclick = function() { // 아코디언 클릭 시 이벤트
        var setClasses = !this.classList.contains('active'); // 아코디언에 액티브 클래스 포함 여부 확인.
        setClass(acc, 'active', 'remove'); // 모든 아코디언 상태 초기화
        setClass(panel, 'show', 'remove'); // 모든 패널 상태 초기화

        if (setClasses) {
            this.classList.toggle("active"); // 현재 아코디언에 액티브 클래스를 추가하거나 삭제함. 
            this.nextElementSibling.classList.toggle("show"); //현재 아코디언의 다음 요소인 패널에 쇼 클래스를 추가하거나 삭제함.
        }
    }
}

function setClass(els, className, fnName) {
    for (var i = 0; i < els.length; i++) {
        els[i].classList[fnName](className);
    }
}

});
    
// 아코디언 FAQ 종료
    
</script>


<div class="content_wrap">
	<div class="tab_menu tab01">
		<ul>
			<!-- 처음 활성화 메뉴에 class="on" -->
			<li class="on"><a href="javascript:;">Introduction of Training Provider Designation</a></li>
			<li><a href="javascript:;">Designation Process</a></li>
			<li><a href="javascript:;">Invigilator</a></li>
            <li><a href="javascript:;">FAQ</a></li>
		</ul>
	</div>
    
    <div class="tab_con">
		
        <!--+++++ 컨텐츠 01 (처음 활성화 컨텐츠에만 style="display:block") +++++-->
        <article style="display:block">
            <div class="page_title">
                <h1 class="top_tt point_col">Introduction of Training Provider Designation</h1>
                <!--<h2 class="top_stt"></h2>-->
                <p class="top_txt">
                    GPC has been authorized to designate a training provider by signing an MLA with IPC regarding management system auditor certification and designation of training provider.<br><br>
                    The auditor/lead auditor training course registered in GPC consists of guidelines for conducting an audit based on ISO/IEC 17021-1 and ISO 19011 and ISO standard requirements. The following training courses are currently registered in GPC.
                </p>
            </div>
            <div class="page_con">
                <ul>
                    <li>
                        <dl>
                            <dt class="con_img">
                                <img src="./image/training_01.jpg" alt="Training Provider Designation">
                            </dt>
                            <dd style="margin:0 0 70px">
                                <h3 class="con_stt point_col">
                                    <i class="fas fa-check-circle" style="margin-right:10px"></i>Training Provider Designation
                                </h3>
                                <table class="type01">
                                    <tbody>
                                        <tr>
                                            <th width="30%" scope="row">
                                                <p>ISO 9001:2015</p>
                                            </th>
                                            <td width="70%">
                                                <p>Quality Management System Auditor</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th width="30%" scope="row" class="even">
                                                <p>ISO 13485:2016</p>
                                            </th>
                                            <td width="70%" class="even">
                                                <p>Medical Devices Quality Management System Auditor</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th width="30%" scope="row">
                                                <p>ISO 14001:2015</p>
                                            </th>
                                            <td width="70%">
                                                <p>Environmental Management System Auditor</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th width="30%" scope="row" class="even">
                                                <p>ISO 22000:2018</p>
                                            </th>
                                            <td width="70%" class="even">
                                                <p>Food Safety Management System Auditor</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th width="30%" scope="row">
                                                <p>ISO 45001:2018</p>
                                            </th>
                                            <td width="70%">
                                                <p>Occupational Health and Safety Management System Auditor</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th width="30%" scope="row" class="even">
                                                <p>ISO 21001:2018</p>
                                            </th>
                                            <td width="70%" class="even">
                                                <p>Educational Organization Management System Auditor</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th width="30%" scope="row">
                                                <p>ISO 22301:2019</p>
                                            </th>
                                            <td width="70%">
                                                <p>Business Continuity Management System Auditor</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th width="30%" scope="row" class="even">
                                                <p>ISO/IEC 27001:2013</p>
                                            </th>
                                            <td width="70%" class="even">
                                                <p>Information Security Management System Auditor</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th width="30%" scope="row">
                                                <p>ISO/IEC 27701:2019</p>
                                            </th>
                                            <td width="70%">
                                                <p>Privacy Information Management System Auditor</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th width="30%" scope="row" class="even">
                                                <p>ISO 37001:2016</p>
                                            </th>
                                            <td width="70%" class="even">
                                                <p>Anti-Bribery Management System Auditor</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th width="30%" scope="row">
                                                <p>ISO 22716:2007</p>
                                            </th>
                                            <td width="70%">
                                                <p>Cosmetics – Good Manufacturing Practices Auditor</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th width="30%" scope="row" class="even">
                                                <p>ISO 21384-3:2019</p>
                                            </th>
                                            <td width="70%" class="even">
                                                <p>Unmanned Aircraft System Auditor</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th width="30%" scope="row">
                                                <p>ISO 50001:2018</p>
                                            </th>
                                            <td width="70%">
                                                <p>Energy Management System Auditor</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th width="30%" scope="row" class="even">
                                                <p>ISO 55001:2014</p>
                                            </th>
                                            <td width="70%" class="even">
                                                <p>Asset Management System Auditor</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th width="30%" scope="row">
                                                <p>ISO 37301:2021</p>
                                            </th>
                                            <td width="70%">
                                                <p>Compliance Management System Auditor</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </dd>
                        </dl>
                    </li>
                </ul>
            </div>
        </article><!--+++++ 컨텐츠 01 (처음 활성화 컨텐츠에만 style="display:block") 종료 +++++-->   

        <article><!--+++++ 컨텐츠 02 시작 +++++-->
            <div class="page_title">
                <h1 class="top_tt point_col">Designation Process</h1>
                <!--<h2 class="top_stt">ISO 45001:2018</h2>-->
                <!--<p class="top_txt"></p>-->
            </div>
            <div class="page_con">
                <ul>
                    <li class="con">
                        <dl>
                            <dt>
                                <h3 class="con_tt point_col"><i class="fas fa-check-circle" style="margin-right:10px"></i>Designation Process</h3>
                            </dt>
                            <dd class="con_txt" >
                                <div class="step_wrap">
                                    <div class="step">
                                        <div class="arrow">
                                            <span class="triangle"></span>
                                            <span class="arrow_txt"><span style="display: inline-block;width: 20px"></span>Step 1</span>
                                        </div>
                                        <div class="icon">
                                            <img src="./image/form.png" alt="Receive application">
                                        </div>
                                        <h4 class="arrow_tit">1. Receive application</h4>
                                        <p>Prepare and submit the application form, contract, and the related materials by e-mail</p>
                                    </div>
                                    <div class="step">
                                        <div class="arrow">
                                            <span class="triangle"></span>
                                            <span class="arrow_txt"><span style="display: inline-block;width: 20px"></span>Step 2</span>
                                        </div>
                                        <div class="icon">
                                            <img src="./image/invoice.png" alt="Payment">
                                        </div>
                                        <h4 class="arrow_tit">2. Payment</h4>
                                        <p>Pay the training provider designation fee</p>
                                    </div>
                                    <div class="step">
                                        <div class="arrow">
                                            <span class="triangle"></span>
                                            <span class="arrow_txt"><span style="display: inline-block;width: 20px"></span>Step 3</span>
                                        </div>
                                        <div class="icon">
                                            <img src="./image/document.png" alt="Review documents">
                                        </div>
                                        <h4 class="arrow_tit">3. Review documents</h4>
                                        <p>Review the submitted documents and, if necessary, supplement the documents</p>
                                    </div>
                                </div>
                                <div class="step_wrap">
                                    <div class="step">
                                        <div class="arrow">
                                            <span class="triangle"></span>
                                            <span class="arrow_txt"><span style="display: inline-block;width: 20px"></span>Step 4</span>
                                        </div>
                                        <div class="icon">
                                            <img src="./image/audit.png" alt="On-site audit">
                                        </div>
                                        <h4 class="arrow_tit">4. On-site audit</h4>
                                        <p>Evaluate the training sites and examination procedures of the training provider after passing the documents review</p>
                                    </div>
                                    <div class="step">
                                        <div class="arrow">
                                            <span class="triangle"></span>
                                            <span class="arrow_txt"><span style="display: inline-block;width: 20px"></span>Step 5</span>
                                        </div>
                                        <div class="icon">
                                            <img src="./image/compliant.png" alt="Approve">
                                        </div>
                                        <h4 class="arrow_tit">5. Approve</h4>
                                        <p>Approve finally regarding the designation of training provider based on the results of the on-site audit</p>
                                    </div>
                                    <div class="step">
                                        <div class="arrow">
                                            <span class="triangle"></span>
                                            <span class="arrow_txt"><span style="display: inline-block;width: 20px"></span>Step 6</span>
                                        </div>
                                        <div class="icon">
                                            <img src="./image/certificate.png" alt="Issue designation">
                                        </div>
                                        <h4 class="arrow_tit">6. Issue designation</h4>
                                        <p>Issue an accredited designation to the training provider that has received the final approval</p>
                                    </div>
                                </div>
                            </dd>
                        </dl>
                    </li>
                </ul>
            </div>
        </article><!--+++++ 컨텐츠 02 종료 +++++--> 

        <article><!--+++++ 컨텐츠 03 시작 +++++-->
            <div class="page_title">
                <h1 class="top_tt point_col">Invigilator</h1>
                <!--<h2 class="top_stt">ISO 45001:2018</h2>-->
                <p class="top_txt">
                    GPC-designated training provider conducts the examination together after the completion of the training course. Therefore, the training provider must register with the GPC as an invigilator. 
                </p>
            </div>
            <div class="page_con">
                <ul>
                    <li class="con">
                        <dl>
                            <dt>
                                <h3 class="con_tt point_col"><i class="fas fa-check-circle" style="margin-right:10px"></i>Invigilator</h3>
                            </dt>
                            <dd>
                                <div class="con_img inside">
                                    <img src="./image/training_02.jpg" alt="Invigilator">
                                </div>
                                <div class="sub_txt">
                                    <ul><span class="point_b1"><i class="far fa-edit" style="margin-right: 6px;"></i>There will be at least one invigilator for every 20 candidates, and the invigilator will perform the following duties : </span>
                                        <li><span class="bullet"></span>Identification of candidates</li>
                                        <li><span class="bullet"></span>Guidance about examination (Time limit, precautions, prohibition of cheating, candidate’s rights, method of appeal, pass criteria, etc.)</li>
                                        <li><span class="bullet"></span>Invigilation</li>
                                        <li><span class="bullet"></span>Cheater detection and action</li>
                                        <li><span class="bullet"></span>Distribution and collection of examination papers and answer sheets</li>
                                        <li><span class="bullet"></span>Sealing and submitting the recovered examination papers and answer sheets</li>
                                    </ul>
                                </div>
                                <div class="sub_txt">
                                    <ul>
                                        Invigilators must also be impartial and have no interest in candidates.<br>
                                        GPC registers as an invigilator through simple history check and evaluation according to internal procedures of invigilator applicants.<br>
                                        ** All rights related to the examination rest with GPC.
                                    </ul>
                                </div>
                            </dd>
                        </dl>
                    </li>
                </ul>
            </div>
        </article><!--+++++ 컨텐츠 03 종료 +++++--> 
 
        
<!--===========================================================================================================================-->
   
        
        <article><!--+++++ 컨텐츠 04 시작 +++++--> 
            <div class="faq_wrap"> 
                <div class="faq_bg"></div>

                <p class="accordion active">1. I want to register as a GPC training provider. What documents do I need?</p>
                <div class="panel show">
                    When registering as a GPC training provider, the following materials must be submitted.
                    <ul>
                        <li>1)	Training provider operation manual and procedures</li>
                        <li>2)	Evaluation data of the instructor’s qualification (educational background, work experience, audit log, etc.)</li>
                        <li>3)	Textbook</li>
                        <li>4)	Training certificate sample</li>
                    </ul>
                </div>

                <p class="accordion">2. What is evaluated in the on-site audit after document review?</p>
                <div class="panel">
                    Evaluate training sites and examination procedures. GPC checks the suitability of the training environment, conducts interviews with the instructor and invigilator, and, if necessary, conducts a witness to the training.
                </div>

                <p class="accordion">3. What should be included in the training certificate?</p>
                <div class="panel">
                    The training certificate must include the following : 
                    <ul>
                        <li>1)	The name of the student</li>
                        <li>2)	The name of the training provider</li>
                        <li>3)	The name of the training course</li>
                        <li>4)	The date of completion of the training</li>
                        <li>5)	Unique identification number</li>
                        <li>6)	The duration of the training course</li>
                        <li>7)	The issue date of the training certificate</li>
                    </ul>
                </div>

                <p class="accordion">4. I have registered for the ISO 9001 auditor training course, but I would like to add the ISO 14001 auditor training course. What documents do I need?</p>
                <div class="panel">If you want to add training courses for a different standard, you will need submit training materials and evaluation data of the instructor’s qualification for the training courses you want to add.</div>
                
                <p class="accordion">5. Do I have to pay the annual fee every year after registering as a training provider?</p>
                <div class="panel">The annual fee must be paid annually, and invoice is sent by e-mail in accordance with the annual cycle.</div>
            </div>
        </article><!--+++++ 컨텐츠 04 (처음 활성화 컨텐츠에만 style="display:block") 종료 +++++-->
        
        
    </div><!-------div class="tab_con" 종료------>
    
</div><!---------/class="content_wrap" 종료/------------>

<?php
include_once(G5_THEME_PATH.'/tail.php');
?>