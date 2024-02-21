<?php
include_once('./_common.php');
$g5['title'] = 'Auditor Certification';
include_once(G5_THEME_PATH.'/head.php');
?>

<style>
    
    /* ---------------------- 시작: 컨텐츠 페이지별 css ---------------------- */ 
    
	.point_col { color:#0f618a;border-color: #0f618a }/*각 서브페이지의 포인트 컬러*/
    .point_b1 { display: block;color: #d63217; font-size: 1rem; font-weight: 500; margin-bottom: 10px }/* 본문의 강조부분 css */
    
    /* 컨텐츠 03 심사원 인증 절차에 대한 css */
    .arrow { position: relative;margin: 0 0 50px }
    .triangle { display: inline-block;position: absolute;left: -16px;top: 15px;width: 0;height: 0;border-left: 30px solid transparent;border-right: 30px solid transparent;border-bottom: 30px solid #fff;transform: rotate(90deg);}
    .arrow_tit { font-size:1.1rem;font-weight: 500;margin-bottom: 10px }
    .arrow_txt { display: inline-block;width: 100%;height: 60px;background: #0f618a;text-align: center;font-size: 1.15rem;font-weight: bold;line-height: 60px;color: #fff; }/* point_col와 동일한 색 적용 */
    .step_wrap { display: flex;margin: 20px 0 50px }
    .step { flex: 1;padding: 20px }
    .icon { width: 40%;text-align: center;margin: 0 auto 30px }
    
    /* 테이블(Table)에 대한 css */
    /* type01 : 줄노트형식 */
    table.type01 { border-collapse: collapse;text-align: left;line-height: 1.6;border-top: 3px solid #0f618a;border-bottom: 3px solid #0f618a }/* point_col와 동일한 색 적용 */
    table.type01 th { padding: 10px 0 10px 20px;vertical-align: middle }
    table.type01 td { padding: 10px 0 10px 20px;vertical-align: top }
    table.type01 .even { background: #f4f4f4 }
    /* type02 : 헤더에 배경색/왼쪽-항목명/오른쪽-내용 기본테이블형식 */
    table.type02 { border-collapse: collapse;line-height: 1.6;border-bottom: 3px solid #0f618a }/* point_col와 동일한 색 적용 */
    table.type02 thead th { padding: 10px;vertical-align: middle;color: #fff;background: #0f618a }/* point_col와 동일한 색 적용 */
    table.type02 tbody th { padding: 10px;vertical-align: middle;font-weight: 500;border-bottom: 1px solid #e1e1e1;border-right: 1px solid #e1e1e1 }
    table.type02 tbody td { padding: 10px;vertical-align: top;border-bottom: 1px solid #e1e1e1;border-right: 1px solid #e1e1e1 }
    table.type02 tbody td.none { border-bottom: none;border-right: none }
    /* type03 : 항목명 왼쪽에 보더 굵게 넣어 강조한 형식 */
    table.type03 { border-collapse: collapse;text-align: left;line-height: 1.6 }
    table.type03 th { padding: 10px;vertical-align: top;font-weight: 500;border-left: 3px solid #0f618a }/* point_col와 동일한 색 적용 */
    table.type03 td { padding: 10px 0 10px 20px;vertical-align: top;background: #f4f4f4 }
    
    
    /* ---------------------- 종료: 컨텐츠 페이지별 css ---------------------- */ 
    
    /* ------------------------ 시작: 컨텐츠 공통 css ------------------------ */ 
    
    .content_wrap {width:100%; max-width:1200px; margin:0 auto;font-size: 1rem; font-weight: 400;line-height: 1.6; }/* 서브페이지 전체 레이아웃 */
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
    .page_con .con_stt { font-size: 1.15rem; font-weight: 500; line-height: 1.5; text-align: left; margin: 0 auto 20px auto;width: 100%; }/* 문단 부제목 css */
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
    
    .faq_wrap .accordion { border-bottom: 1px solid #0f618a;color: #0f618a;cursor: pointer;padding: 20px 40px 20px 50px;width: 100%;text-align: left;position: relative }/* point_col와 동일한 색 적용 */
    .faq_wrap .accordion::before { content: '';float: right;width: 10px;height: 10px;margin: 6px 0 0 20px;border-bottom:2px solid #ccc;border-right:2px solid #ccc;transform: rotate(45deg) }/* 열림 버튼 생성 */
    .faq_wrap .accordion::after { content: "Q";display: block;width: 40px;float: left;text-align: center;margin-left: -40px;font-size: 1.45rem;font-weight: 700;line-height: 1;position: absolute;top:20px }/* 알파벳 Q */
    .faq_wrap .accordion.active, .faq_wrap .accordion:hover { background-color: #0f618a;color: #fff }/* 아코디언 클래스를 클릭, 호버될 경우 배경색 변경 / point_col와 동일한 색 적용 */
    
    .faq_wrap .accordion.active::before { transform: rotate(-135deg);margin: 10px 0 0 }/* 숨기기 버튼 생성 */

    .faq_wrap .panel { background-color: inherit;max-height: 0;overflow: hidden;transition: 0.4s ease-in-out;opacity: 0 }
    .faq_wrap .panel ul { padding: 20px; }
    .faq_wrap .panel.show { opacity: 1;max-height: 500px;padding: 20px 40px 20px 50px;box-shadow: 0 4px 6px 0 rgb(0 0 0 / 25%);position: relative }/* 패널에 클래스 show 붙을 경우 */
    .faq_wrap .panel::before { content: "A";display: block;width: 40px;float: left;text-align: center;margin-left: -40px;font-size: 1.45rem;font-weight: 700;line-height: 1;color: #e55d51;position: absolute;top:20px }/* 알파벳 A */
    
    
    /* ------------------------ 종료: 컨텐츠 공통 css ------------------------ */ 
    
    
    
    /* ------------------------ 시작: 반응형 css ------------------------ */   
        
    @media (max-width:1024px) {
        .page_title .top_tt { font-size: 1.85rem }
    }

	@media screen and (max-width:768px) {	
        .page_con{ overflow-x:scroll; }
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
        .faq_bg { margin: 50px 0;background: url(./image/m_faq_bg_en.png)no-repeat center; }
        .faq_wrap .accordion { margin-bottom: 0 }
        .faq_wrap .accordion::before { width: 10px;height: 10px;border-bottom: 1px solid #ccc;border-right: 1px solid #ccc }
        .faq_wrap .panel.show { box-shadow: none;background: #f4f4f4; }
        .type02{width:100%;}

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
            this.nextElementSibling.classList.toggle("show"); // 현재 아코디언의 다음 요소인 패널에 쇼 클래스를 추가하거나 삭제함.
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
			<!-- 활성화 메뉴에 class="on" // 탭메뉴 페이지 분리 20230503 HJ -->
			<li><a href="/gpc_eng/theme/gpcert/service/auditor_scheme.php">Auditor Certification Scheme</a></li>
			<li><a href="/gpc_eng/theme/gpcert/service/auditor_grade_REGS.php">Grade/Registration requirements</a></li>
			<li><a href="/gpc_eng/theme/gpcert/service/auditor_process.php">Auditor certification process</a></li>
			<li><a href="/gpc_eng/theme/gpcert/service/auditor_fee.php">Auditor Certification Fee</a></li>
            <li class="on"><a href="/gpc_eng/theme/gpcert/service/auditor_FAQ.php">FAQ</a></li>
		</ul>
	</div>
    
    <div class="tab_con">
		<!--+++++ 심사원 인증 규격 // 탭메뉴 페이지 분리 20230503 HJ +++++-->
        <article style="display:block">
            <div class="faq_wrap"> 
                <div class="faq_bg"></div>

                <p class="accordion active">1. What are the requirements for registration as auditor?</p>
                <div class="panel show">
                    When registering as an auditor, applicant must meet the following requirements : 
                    <ul>
                        <li>1)	Graduation of secondary education</li>
                        <li>2)	Work experience of 5 years (including at least 2 years of experience related to application standard)</li>
                        <li>3)	Completion of auditor / lead auditor training course for application standards at an authorized institution within 3 years</li>
                        <li>4)	Audit log of at least 20M/D within 3 years</li>
                        <li>5)	Pass knowledge and attribution examination of GPC</li>
                    </ul>
                </div>

                <p class="accordion">2. It is difficult to submit a proof of employment or certificate of career as evidence of work experience. What kind of document can be used instead?</p>
                <div class="panel">It can be replaced by detailed work experience descriptions in the work experience of the application form or curriculum vitae.</div>

                <p class="accordion">3. Are auditor training courses from other institutions recognized?</p>
                <div class="panel">
                    Auditor training courses at authorized institutions are accepted, and acceptance is decided through evaluation of the institution's training materials.<br>
                    Applicants must submit training curriculum or training materials such as textbooks for evaluation process.
                </div>

                <p class="accordion">4. Is the log of internal audits conducted by the applicant’s company recognized?</p>
                <div class="panel">
                    In the case of an audit similar to the application standard, it can be accepted as an audit log. Therefore, in order to evaluate the equivalence with the application standard, applicant must submit the audit materials (audit criteria, audit checklist, audit report, etc.)
                </div>
                
                <p class="accordion">5. What are the requirements for registration as provisional auditor?</p>
                <div class="panel">
                    When registering as a provisional auditor, applicant must meet the following requirements : 
                    <ul>
                        <li>1)	Graduation of secondary education</li>
                        <li>2)	Completion of auditor / lead auditor training course for application standards at an authorized institution within 3 years</li>
                        <li>3)	Pass knowledge and attribution examination of GPC</li>
                    </ul>
                </div>
                
                <p class="accordion">6. I registered as ISO 9001 auditor, but I would like to additionally register as ISO 14001 auditor. Are the requirements the same?</p>
                <div class="panel">
                    The requirements are the same, but evidence is needed for history related to the environmental management system. When registering as ISO 14001 auditor, applicant must meet the following requirements : 
                    <ul>
                        <li>1)	Graduation of secondary education</li>
                        <li>2)	Work experience of 5 years (including at least 2 years of experience related to the environmental management system)</li>
                        <li>3)	Completion of ISO 14001 auditor / lead auditor training course at an authorized institution within 3 years</li>
                        <li>4)	ISO 14001 audit log of at least 20M/D within 3 years</li>
                        <li>5)	Pass knowledge and attribution examination of GPC</li>
                    </ul>
                </div>
                
                <p class="accordion">7.	How can I sign the application form and the contract?</p>
                <div class="panel">Applicant can sign the document electronically, or print the document, sign it by hand, scan and send it.</div>
                
                <p class="accordion">8. How can I submit the document?</p>
                <div class="panel">
                    It can be submitted by mail, fax, post, etc.
                    <ul>
                        E-Mail: <span class="gpc_email">info@gpcert.org</span><br>
                        FAX: 02-6749-0711<br>
                        Post address: Rm. 501-1, Daeryung Techno Town No. 7, 638, Seobusaet-gil, Geumcheon-gu, Seoul, Republic of Korea
                    </ul>
                </div>
                
                <p class="accordion">9. I would like to register as ISO 22000 auditor, but I have no experience in food safety related field, but I did ISO 22000 certification consulting work. Is consulting career recognized as relevant experience?</p>
                <div class="panel">It is decided according to the result of reviewing the evidence related to consulting. (contract, work document, etc.).</div>
                
                <p class="accordion">10. I completed the ISO 9001 auditor training course. Until when should I register as auditor?</p>
                <div class="panel">When registering as a GPC auditor, the acceptable training certificate is the training certificate issued within 3 years from the date of application. Therefore, applicant must register as an auditor within 3 years of completing the training.</div>
                
                <p class="accordion">11. How can I check the status of registration as an auditor?</p>
                <div class="panel">Please search for the certificate number on the first page of the GPC homepage. You can check the status (KEEP/SUSPENDED/WITHDRAWN) of registered auditor qualifications.</div>
                
                <p class="accordion">12. Will the certificates be issued?</p>
                <div class="panel">Auditor certificate will be issued as a PDF file, and the original certificate and auditor card will be sent by courier.</div>
                
                <p class="accordion">13. I certified as auditor from other certification body. Can I transfer to GPC?</p>
                <div class="panel">If the auditor certification issued by another personnel certification body is valid as of the application date, applicant can apply for transfer to GPC.</div>
                
                <p class="accordion">14. I registered as ISO 9001 auditor. How can I upgrade to Lead auditor?</p>
                <div class="panel">
                    The requirements for upgrade to lead auditor are as follows.
                    <ul>
                        <li>-	Audit log of at least 15M/D as lead auditor after the registration date of auditor</li>
                    </ul>
                    If you apply for upgrade by filling out the audit log as lead auditor on the GPC audit log sheet form, you can upgrade to lead auditor.
                </div>
                
                <p class="accordion">15. Can I register as a lead auditor through onsite competence evaluation method? </p>
                <div class="panel">
                    The onsite competence evaluation method is a registration method for auditor that can be applied if applicant do not have an audit log of 20M/D or more among the auditor registration requirements. The grade that can be registered through this method is an auditor, and if applicant want to register as a lead auditor, applicant must have an additional 15M/D or higher audit log as a lead auditor after registration as auditor through the onsite competence evaluation method.
                </div>
                
                <p class="accordion">16. I registered as an ISO 9001 auditor last year. What are the requirements for maintaining the certification? </p>
                <div class="panel">
                    An annual fee is charged for auditor and above grade, and recertification is required every 3 years. After registering as an auditor, you can maintain your certification by paying the annual fee in the first and second year, and the original auditor certificate and auditor card will be sent.
                </div>
                
                <p class="accordion">17. Does the auditor recertification process happen every 3 years?</p>
                <div class="panel">
                    Auditor recertification is required every 3 years after the initial registration date, and the following requirements must be met at the time of application for recertification.
                    <ul>
                        <li>-	Audit log of at least 10M/D for 3 years from the initial registration date<br>(In the case of a lead auditor, at least one additional audit log as a lead auditor is required, and in the case of a senior auditor, an additional audit log as a lead auditor and senior auditor’s activity is required at least once)</li>
                        <li>-	CPD log of more than 16 hours for 3 years from the initial registration date</li>
                    </ul>
                </div>
                
                <p class="accordion">18. I registered as ISO 9001 provisional auditor 3 years ago, and it is due to expire soon. What are the recertification requirements?</p>
                <div class="panel">
                    In the case of provisional auditor recertification, please re-write and submit the application form within 3 years from the date of registration as provisional auditor, including any changes or added academic background, experience, education history, etc.
                </div>
                
                <p class="accordion">19. What activities are recognized as CPD log?</p>
                <div class="panel">
                    Activities such as training, seminars and workshops related to the registered standard can be recognized. Evidence such as certificate of attendance and certificate of completion must be submitted.
                </div>
                
                <p class="accordion">20. How can I obtain an IAF code?</p>
                <div class="panel">
                    The GPC Certification body grants qualifications to individuals in accordance with the requirements of ISO/IEC 17024, which the Personnel Certification Body (PCB) must adhere to. ISO/IEC 17024 does not explicitly specify regulations for Personnel Certification Body (PCB) in defining technical areas for individuals.<br><br>
                    Therefore, GPC does not impose restrictions or allocations of specific technical areas, such as codes and categories, to applicants.
                </div>
            </div>
        </article>
    </div><!-------div class="tab_con" 종료------>
    
</div><!---------/class="content_wrap" 종료/------------>

<?php
include_once(G5_THEME_PATH.'/tail.php');
?>