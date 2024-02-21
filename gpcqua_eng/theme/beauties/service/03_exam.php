<?php
include_once('./_common.php');
$g5['title'] = 'Examination';
include_once(G5_THEME_PATH.'/head.php');

	/*
		이 페이지는 jquery 로 작동됩니다.	
	*/
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
    
    .faq_wrap .accordion { border-bottom: 1px solid #0f8a75;color: #0f8a75;cursor: pointer;padding: 20px 40px 20px 50px;width: 100%;text-align: left;position: relative }/* point_col와 동일한 색 적용 */
    .faq_wrap .accordion::before { content: '';float: right;width: 10px;height: 10px; margin-left: 20px; border-bottom:2px solid #ccc;border-right:2px solid #ccc;transform: rotate(45deg) }/* 열림 버튼 생성 */
    .faq_wrap .accordion::after { content: "Q";display: block;width: 40px;float: left;text-align: center;margin-left: -40px;font-size: 1.45rem;font-weight: 700;line-height: 1;position: absolute;top:20px }/* 알파벳 Q */
    .faq_wrap .accordion.active, .faq_wrap .accordion:hover { background-color: #0f8a75;color: #fff }/* 아코디언 클래스를 클릭, 호버될 경우 배경색 변경 / point_col와 동일한 색 적용 */
    
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
			<li class="on"><a href="javascript:;">GPC Exam</a></li>
			<li><a href="javascript:;">GPC Exam Process</a></li>
            <li><a href="javascript:;">FAQ</a></li>
		</ul>
	</div>
    
    <div class="tab_con">
		
        <!--+++++ 컨텐츠 01 (처음 활성화 컨텐츠에만 style="display:block") +++++-->
        <article style="display:block">
            <div class="page_title">
                <h1 class="top_tt point_col">GPC Exam</h1>
                <!--<h2 class="top_stt">ISO 9001:2015</h2>-->
                <p class="top_txt">
                    In order to be certified or maintained by GPC as an auditor, candidate must take an exam against related to standard. The exam location and time will be notified in advance and will usually be held on Saturdays at 10:00 am. Candidates must arrive 10 minutes prior to the start of the exam, and tardiness or absence will be automatically scored as 0 points. Candidates must present their identification cards (including photos) for the exam. Candidates must leave the prohibited items with the invigilator in advance. If cheating is confirmed, invigilator may request candidate to check out and no further exam will be allowed.
                </p>
            </div>
            <div class="page_con">
                <ul>
                    <li class="con">
                        <dl>
                            <dt>
                                <h3 class="con_tt point_col"><i class="fas fa-check-circle" style="margin-right:10px"></i>GPC Exam</h3>
                            </dt>
                            <dd>
                                <div class="con_img inside">
                                    <img src="./image/test_01.jpeg" alt="GPC Exam">
                                </div>
                                <div class="con_txt">
                                    The exam consists of a knowledge and attribution exam, and the allotted time is a total of 100 minutes for the knowledge and attribution exam. The candidate can take the knowledge exam as an open book.
                                    <div class="con_txt_li">
                                        <h4 class="con_li_tt point_col">1. Knowledge exam</h4>
                                        <p>
                                            The knowledge exam is conducted to evaluate the knowledge of ISO standards, and it evaluates the competence and qualifications of candidates who want to perform audit activities.<br>
                                            The knowledge exam has a total of 50 questions and consists of 4 sections. The candidate passes if all of the following pass criteria meet.
                                        </p>
                                        <ul class="point_col">
                                            <li>- More than 40% correct by sectional category</li>
                                            <li>- An acquirement of more than 70 points total</li>
                                        </ul>
                                        <p>
                                            If do not pass the knowledge exam, candidate will be given one more chance to retake the exam.<br>
                                            In the event of consecutive failures of the exam, candidate will not be able to take the knowledge exam again for one year.
                                        </p>
                                    </div>
                                    <div class="con_txt_li">
                                        <h4 class="con_li_tt point_col">2. Attribution exam</h4>
                                        <p>
                                            The attribution exam is based on ISO 19011:2018 and evaluates qualifications and characteristics as an auditor. It also determines how well the candidate understands the question.
                                        </p>
                                        <p>
                                            The attribution exam has a total of 25 questions, and a score of 70 or higher is a pass.<br>
                                            The highest point of each question is 4 points. The further away from the correct answer, the more points are deducted. (If not selected, 0 point) Candidates should choose without delay what they believe to be the correct answer.
                                        </p>
                                        <p>
                                            If do not pass the exam, candidates will be given one chance for an interview.<br>
                                            If do not pass the interview, candidates cannot take the attribution exam again for one year.
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
                                <h3 class="con_tt point_col"><i class="fas fa-check-circle" style="margin-right:10px"></i>Exam method</h3>
                            </dt>
                            <dd>
                                <div class="con_img inside">
                                    <img src="./image/test_02.jpg" alt="Exam method">
                                </div>
                                <div class="sub_txt">
                                    <ul><span class="point_b1"><i class="far fa-edit" style="margin-right: 6px;"></i>The GPC exam can be conducted in three ways.</span>
                                        <li>
                                            <span class="number">1. </span>Training provider
                                            <span style="display:block">- Training and exam can be conducted at the same time at a training provider designated by GPC.</span>
                                        </li>
                                        <li>
                                            <span class="number">2. </span>Visit to GPC
                                            <span style="display:block">- Candidates can take the exam by visiting the GPC.</span>
                                            <span style="display:block">- GPC proceeds with a test 10:00 am on the last Saturday of each month for those who have registered in advance.</span>
                                        </li>
                                        <li>
                                            <span class="number">3. </span>Individual exam
                                            <span style="display:block">- If the exam methods 1 and 2 are restricted, the exam can be conducted online according to the GPC procedure.</span>
                                            <span style="display:block">- However, a declaration of faithfulness and security compliance pledges is required, and candidate must prove that the methods 1 and 2 are restricted.</span>
                                        </li>
                                    </ul>
                                </div>
                            </dd>
                        </dl>			
                    </li>
                </ul>
            </div>
        </article><!--+++++ 컨텐츠 01 (처음 활성화 컨텐츠에만 style="display:block") 종료 +++++-->   

        <article><!--+++++ 컨텐츠 02 시작 +++++-->
            <div class="page_title">
                <h1 class="top_tt point_col">GPC Exam Process</h1>
                <!--<h2 class="top_stt">ISO 45001:2018</h2>-->
                <!--<p class="top_txt"></p>-->
            </div>
            <div class="page_con">
                <ul>
                    <li class="con">
                        <dl>
                            <dt>
                                <h3 class="con_tt point_col"><i class="fas fa-check-circle" style="margin-right:10px"></i>GPC Exam Process</h3>
                            </dt>
                            <dd class="con_txt" >
                                <div class="step_wrap">
                                    <div class="step">
                                        <div class="arrow">
                                            <span class="triangle"></span>
                                            <span class="arrow_txt"><span style="display: inline-block;width: 20px"></span>Step 1</span>
                                        </div>
                                        <div class="icon">
                                            <img src="./image/form.png" alt="Application for GPC exam">
                                        </div>
                                        <h4 class="arrow_tit">1. Application for GPC exam</h4>
                                    </div>
                                    <div class="step">
                                        <div class="arrow">
                                            <span class="triangle"></span>
                                            <span class="arrow_txt"><span style="display: inline-block;width: 20px"></span>Step 2</span>
                                        </div>
                                        <div class="icon">
                                            <img src="./image/paper.png" alt="Review of application documents">
                                        </div>
                                        <h4 class="arrow_tit">2. Review of application documents</h4>
                                    </div>
                                    <div class="step">
                                        <div class="arrow">
                                            <span class="triangle"></span>
                                            <span class="arrow_txt"><span style="display: inline-block;width: 20px"></span>Step 3</span>
                                        </div>
                                        <div class="icon">
                                            <img src="./image/date.png" alt="GPC exam schedule notice">
                                        </div>
                                        <h4 class="arrow_tit">3. GPC exam schedule notice</h4>
                                    </div>
                                </div>
                                <div class="step_wrap">
                                    <div class="step">
                                        <div class="arrow">
                                            <span class="triangle"></span>
                                            <span class="arrow_txt"><span style="display: inline-block;width: 20px"></span>Step 4</span>
                                        </div>
                                        <div class="icon">
                                            <img src="./image/test.png" alt="Perform the exam">
                                        </div>
                                        <h4 class="arrow_tit">4. Perform the exam</h4>
                                    </div>
                                    <div class="step">
                                        <div class="arrow">
                                            <span class="triangle"></span>
                                            <span class="arrow_txt"><span style="display: inline-block;width: 20px"></span>Step 5</span>
                                        </div>
                                        <div class="icon">
                                            <img src="./image/certificate.png" alt="Issuance of certificate">
                                        </div>
                                        <h4 class="arrow_tit">5. Issuance of certificate</h4>
                                    </div>
                                </div>
                                <div class="sub_txt">
                                    <ul>
                                        To proceed with the GPC exam, candidate must submit application documents. In the application document, candidate need to fill out personal information and proof of completion of training. Submitted documents will be reviewed, and if additional supplementation is not required, the GPC exam schedule will be announced. If you have any further questions, please contact us at our e-mail address - <a href="mailto:info@gpcert.org" class="link gpc_email">info@gpcert.org</a>
                                    </ul>
                                </div>
                            </dd>
                        </dl>
                    </li>
                </ul>
            </div>
        </article><!--+++++ 컨텐츠 02 종료 +++++--> 

        <article><!--+++++ 컨텐츠 03 시작 +++++--> 
            <div class="faq_wrap"> 
                <div class="faq_bg"></div>

                <p class="accordion active">1. I have completed the ISO 9001 auditor training course, but I did not take the exam. I want to take an exam before registering as a provisional auditor at GPC. How does it work?</p>
                <div class="panel show">
                    If you have not taken the exam after completing the training course, you can take the exam directly at GPC and proceed as follows.
                    <ul>
                        <li>1)	Apply for the exam at GPC (required to submit application form and certificate of completion)</li>
                        <li>2)	Payment</li>
                        <li>3)	Notify exam location and time</li>
                        <li>4)	Take the exam</li>
                        <li>5)	Issue the exam pass certificate</li>
                    </ul>
                </div>

                <p class="accordion">2. What is the exam passing criteria?</p>
                <div class="panel">
                    In the case of the auditor knowledge examination, it consists of a total of 4 sections and must meet all of the following pass criteria to be considered a pass.
                    <ul>
                        <li>1)	More than 40% of correct answers per section</li>
                        <li>2)	More than 70 points of a total score</li>
                    </ul>
                    Also, in the case of the auditor attribution examination, a total score of more than 70 points is considered a pass, and in case of failure, one chance to retake the exam is given.
                </div>

                <p class="accordion">3. How do I pay the exam fee?</p>
                <div class="panel">
                    If you apply for the exam at GPC, you will be informed of the exam fee in the form of an invoice after application. The fee is \40,000(KRW) per standard, and you can transfer it to the account information at the bottom of the invoice.
                </div>

                <p class="accordion">4. After taking the exam, when will I know the results of the exam?</p>
                <div class="panel">The result will be notified within one week after the exam date and you can receive the exam pass certificate.</div>
                
                <p class="accordion">5. I passed the GPC auditor knowledge exam and attribution exam. Can I register directly as an auditor?</p>
                <div class="panel">If you meet all of the other auditor registration requirements, you can register as an auditor by submitting the application and related materials.</div>
            </div>
        </article><!--+++++ 컨텐츠 03 (처음 활성화 컨텐츠에만 style="display:block") 종료 +++++-->
        
        
    </div><!-------div class="tab_con" 종료------>
    
</div><!---------/class="content_wrap" 종료/------------>

<?php
include_once(G5_THEME_PATH.'/tail.php');
?>