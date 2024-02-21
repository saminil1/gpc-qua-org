<?php
$page_meta_tags = '
<meta name="title" content="심사원 인증FAQ">
<meta name="description" content="FAQ(Frequently Asked Questions) 자주하는 질문입니다.">
<meta name="keywords" content="심사원 등록 요건, 업무경력, 재직증명서, 경력증명서, 건강보험납입증명서, 국민보험가입증명서, 심사원 교육 과정, 커리큘럼, 내부심사, 이력, 심사 기준, 심사 체크리스트, 심사 보고서, 심사원보, ISO 9001, ISO 14001, 환경경영시스템, 신청서, 계약서, 서명, ISO 22000 심사원, 식품 안전, 인증서 번호, 자격증, 심사원증, 카드, 전환, 선임심사원, 승급, 자격 유지, 연회비, 갱신, 만료일, CPD 이력, 교육, 세미나, 워크샵, 참여증, 수료증">
<meta property="og:type" content="website">
<meta property="og:title" content="심사원 인증FAQ">
<meta property="og:description" content="FAQ(Frequently Asked Questions) 자주하는 질문입니다.">
<meta property="og:url" content="https://www.gpcert.org/theme/gpcert/service/auditor_FAQ.php">
';
include_once('./_common.php');
$g5['title'] = '심사원 인증FAQ';
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
    table.type02 { border-collapse: collapse;line-height: 1.6;border-bottom: 3px solid #0f618a;margin: 0 0 6px }/* point_col와 동일한 색 적용 */
    table.type02 thead th { padding: 10px;vertical-align: middle;color: #fff;background: #0f618a }/* point_col와 동일한 색 적용 */
    table.type02 tbody th { padding: 10px;vertical-align: middle;font-weight: 500;border-bottom: 1px solid #e1e1e1;border-right: 1px solid #e1e1e1 }
    table.type02 tbody td { padding: 10px;vertical-align: top;border-bottom: 1px solid #e1e1e1;border-right: 1px solid #e1e1e1 }
    table.type02 tbody td.none { border-right: none }
    /* type03 : 항목명 왼쪽에 보더 굵게 넣어 강조한 형식 */
    table.type03 { border-collapse: collapse;text-align: left;line-height: 1.6 }
    table.type03 th { padding: 10px;vertical-align: top;font-weight: 500;border-left: 3px solid #0f618a }/* point_col와 동일한 색 적용 */
    table.type03 td { padding: 10px 0 10px 20px;vertical-align: top;background: #f4f4f4 }

    /* ------------------------ 시작: 컨텐츠 공통 css ------------------------ */ 
    
    /* 서브페이지 전체 레이아웃 */
    .content_wrap {width:100%; max-width:1200px; margin:0 auto;font-size: 1rem; font-weight: 400;line-height: 1.6;}
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
    .page_con { width: 100%;margin: 70px auto; }
    .page_con .con { border: 2px solid #d8d8d8;margin-top: 50px }
    .page_con .con_tt { font-size: 1.5rem; font-weight: 500; text-align: left; margin: 0 auto 30px auto;width: 90%;padding: 30px 0 20px;border-bottom: 2px solid }/* 문단 제목 css */
    .page_con .con_stt { font-size: 1.15rem; font-weight: 500; line-height: 1.5; text-align: left; margin: 0 auto 20px auto;width: 100%; }/* 문단 부제목 css */
    .page_con .con_txt { width: 90%;margin: 70px auto;text-align: justify }/* 본문 css */
    
    /* 이미지에 대한 css */
    .con_img {width: 60%;text-align: center;margin: 70px auto }/* 문단에 쓰이는 이미지의 css */
    .con_img img {width: 100%;}/* 문단의 쓰이는 이미지의 크기 */
    
    /* 부가설명박스에 대한 css */
    .sub_txt { width:90%; margin: 30px auto;font-size:0.95rem; color:#555; background:#f7f7f7;border-radius: 5px;text-align: justify}
	.sub_txt ul { width: 100%;margin: 0 auto;padding: 25px }
	.sub_txt ul li { padding-left: 20px;position: relative }
	.sub_txt ul li .number { content: '';display: inline-block;width: 5px;height: 5px;position: absolute;left: 0;top: 0 }/* 문단 리스트 스타일 : 숫자 */
    .sub_txt ul li .bullet { content: '';display: inline-block;width: 5px;height: 5px;background: #222;border-radius: 50%;position: absolute;left: 0;top: 10px }/* 문단 리스트 스타일 : 불릿 */
    
    /* FAQ에 대한 css */
    .faq_bg { width: 100%;height: 300px;background: url(./image/faq_bg.png)no-repeat center;background-size: cover; margin: 0 0 50px;position: relative }
    
    .faq_wrap .accordion { border-bottom: 1px solid #0f618a;color: #0f618a;cursor: pointer;padding: 20px 40px 20px 50px;width: 100%;text-align: left;position: relative }/* point_col와 동일한 색 적용 */
    .faq_wrap .accordion::before { content: '';float: right;width: 10px;height: 10px;margin: 6px 0 0 20px;border-bottom:2px solid #ccc;border-right:2px solid #ccc;transform: rotate(45deg) }/* 열림 버튼 생성 */
    .faq_wrap .accordion::after { content: "Q";display: block;width: 40px;float: left;text-align: center;margin-left: -40px;font-size: 1.45rem;font-weight: 700;line-height: 1;position: absolute;top:20px }/* 알파벳 Q */
    .faq_wrap .accordion.active, .faq_wrap .accordion:hover { background-color: #0f618a;color: #fff }/* 아코디언 클래스를 클릭, 호버될 경우 배경색 변경 / point_col와 동일한 색 적용 */
    
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
        .faq_bg { margin: 70px 0;background: url(./image/m_faq_bg.png)no-repeat center; }
        .faq_wrap .accordion { margin-bottom: 0 }
        .faq_wrap .accordion::before { width: 10px;height: 10px;border-bottom: 1px solid #ccc;border-right: 1px solid #ccc }
        .faq_wrap .panel.show { box-shadow: none;background: #f4f4f4; }
        .type02{width:100%;}

	}    
</style>

<!-- 아코디언 FAQ 구현 2021.08.02 From H.J-->

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
      
</script>


<div class="content_wrap">
	<div class="tab_menu tab01">
		<ul>
			<!-- 활성화 메뉴에 class="on" // 탭메뉴 페이지 분리 20230322 HJ -->
			<li><a href="/theme/gpcert/service/auditor_scheme.php">심사원 인증 규격</a></li>
			<li><a href="/theme/gpcert/service/auditor_grade_REGS.php">등급/요구사항</a></li>
			<li><a href="/theme/gpcert/service/auditor_process.php">심사원 인증 절차</a></li>
			<li><a href="/theme/gpcert/service/auditor_fee.php">심사원 인증비용</a></li>
            <li class="on"><a href="/theme/gpcert/service/auditor_FAQ.php">심사원 인증FAQ</a></li>
		</ul>
	</div>
    
    <div class="tab_con">
        <!--+++++ FAQ // 탭메뉴 페이지 분리 20230322 HJ +++++-->
        <article style="display: block;">
            <div class="faq_wrap"> 
                <div class="faq_bg"></div>

                <p class="accordion active">1. 심사원 등록 요건이 어떻게 되나요?</p>
                <div class="panel show">
                    심사원 등록 시 다음 요구사항을 충족해야 합니다.
                    <ul>
                        <li>1)	중등 교육 졸업 이상의 학력</li>
                        <li>2)	총 5년 이상의 업무 경력 (2년 이상 신청 표준 관련 경력 포함)</li>
                        <li>3)	최근 3년 이내 공인된 기관에서 신청 표준에 대한 심사원 교육 과정 수료</li>
                        <li>4)	최근 3년 이내 20M/D 이상의 심사이력</li>
                        <li>5)	GPC 지식 및 인성시험 합격</li>
                    </ul>
                </div>

                <p class="accordion">2. 업무경력을 증빙할 수 있는 자료로 재직증명서나 경력증명서 제출이 어려운 데 어떤 서류로 대체할 수 있나요?</p>
                <div class="panel">건강보험납입증명서 또는 국민보험가입증명서 등으로 대체하실 수 있습니다.</div>

                <p class="accordion">3. GPC 외 타 기관의 심사원 교육 과정도 인정되나요?</p>
                <div class="panel">
                    공인된 기관에서의 심사원 교육 과정의 경우 인정되며, 해당 기관의 교육 자료 평가 절차를 통해 수용 여부를 결정하고 있습니다.<br>
                    신청자는 교육 자료 평가 절차를 위하여 교육 커리큘럼 또는 교육 교재 등을 제출해야 합니다.
                </div>

                <p class="accordion">4. 재직중인 회사에서 수행한 내부심사 이력도 인정되나요?</p>
                <div class="panel">
                    신청하시는 표준과 유사한 심사일 경우 심사이력으로 수용이 가능합니다. 따라서 신청 표준과의 동등성 평가를 위하여, 수행하신 심사와 관련된 자료(심사 기준, 심사 체크리스트, 심사 보고서 등)를 제출해 주셔야 합니다.
                </div>
                
                <p class="accordion">5. 심사원보 등록 요건이 어떻게 되나요?</p>
                <div class="panel">
                    심사원보 등록 시 다음 요구사항을 충족해야 합니다.
                    <ul>
                        <li>1)	중등 교육 졸업 이상의 학력</li>
                        <li>2)	최근 3년 이내 공인된 기관에서 신청 표준에 대한 심사원 교육 과정 수료</li>
                        <li>3)	GPC 지식 및 인성시험 합격</li>
                    </ul>
                </div>
                
                <p class="accordion">6. ISO 9001 심사원으로 등록했는데, ISO 14001 심사원으로 추가 등록하려고 합니다. 요건은 동일한가요?</p>
                <div class="panel">
                    요건은 동일하나, 환경경영시스템과 관련된 이력에 대한 증빙이 필요합니다. ISO 14001 심사원 등록 시 다음 요구사항을 충족해야 합니다.
                    <ul>
                        <li>1)	중등 교육 졸업 이상의 학력</li>
                        <li>2)	총 5년 이상의 업무 경력 (2년 이상 환경경영시스템 관련 경력 포함)</li>
                        <li>3)	최근 3년 이내 공인된 기관에서 ISO 14001 심사원 교육 과정 수료</li>
                        <li>4)	최근 3년 이내 20M/D 이상의 ISO 14001 심사이력</li>
                        <li>5)	GPC 지식 및 인성시험 합격</li>
                    </ul>
                </div>
                
                <p class="accordion">7. 신청서와 계약서에 서명은 어떻게 해야 하나요?</p>
                <div class="panel">서명의 경우, 서류 상에 전자 서명을 해주시거나 또는 서류를 인쇄하시어 자필로 서명하신 후 스캔하여 보내주시면 됩니다.</div>
                
                <p class="accordion">8. 서류는 어떻게 제출하면 되나요?</p>
                <div class="panel">
                    메일, 팩스, 우편 등으로 보내주시면 됩니다.
                    <ul>
                        메일: <span class="gpc_email">info@gpcert.org</span><br>
                        팩스: 02-6749-0711<br>
                        우편 주소: 서울시 금천구 서부샛길 638, 대륭테크노타운 7차 501-1호 GPC인증원
                    </ul>
                </div>
                
                <p class="accordion">9. ISO 22000 심사원으로 등록하려고 하는데, 식품 안전 관련 업무 경력은 없지만 ISO 22000 인증 컨설팅 업무를 했습니다. 컨설팅 이력은 관련 경력으로 인정되나요?</p>
                <div class="panel">컨설팅 관련 증빙자료(계약서, 작업 문서 등)의 검토 후 수용 여부가 결정됩니다.</div>
                
                <p class="accordion">10. 이번에 ISO 9001 심사원 교육 과정을 수료하였습니다. 언제까지 심사원보로 등록해야 하나요?</p>
                <div class="panel">GPC 심사원 등록 시 수용 가능한 교육 수료증은 신청일 기준 3년 이내 발행된 교육 수료증입니다. 따라서 교육 수료 후 3년 이내에 심사원보로 등록해주시면 됩니다.</div>
                
                <p class="accordion">11. 심사원 자격 등록 현황은 어떻게 확인할 수 있나요?</p>
                <div class="panel">GPC 홈페이지 첫 화면에서 인증서 번호를 검색해주세요. 등록된 심사원 자격의 현황(유지/정지/취소)을 확인하실 수 있습니다.</div>
                
                <p class="accordion">12. 심사원 자격증이 발행되나요?</p>
                <div class="panel">PDF 파일로 인증서가 발행되며, 인증서 원본 및 심사원증(카드)이 택배로 송부됩니다. 심사원 이상 등급의 경우, 연회비를 납부하시면 매년 인증서 원본 및 심사원증(카드)이 발송됩니다.</div>
                
                <p class="accordion">13. 다른 기관에서 심사원 자격을 받았습니다. GPC로 자격을 전환할 수 있나요?</p>
                <div class="panel">타 기관에서 발행된 심사원 자격이 신청일 기준 유효한 경우 GPC로 전환 신청하실 수 있습니다.</div>
                
                <p class="accordion">14. ISO 9001 심사원으로 등록했습니다. 선임심사원으로 등급을 변경하려면 어떻게 해야 하나요?</p>
                <div class="panel">
                    선임심사원 승급 요구사항은 다음과 같습니다.
                    <ul>
                        <li>-	심사원 등록일 이후 15M/D 이상 선임심사원으로서의 심사이력</li>
                    </ul>
                    GPC 심사로그시트 양식에 선임심사원으로서 수행하신 심사이력을 작성하여 승급 신청해주시면 됩니다.
                </div>
                
                <p class="accordion">15. 검증방식을 통하여 선임심사원으로 등록할 수 있나요?</p>
                <div class="panel">
                    검증방식은 심사원 등록 요구사항 중 심사이력 20M/D 이상을 보유하지 못한 경우에 신청할 수 있는 심사원 등록 방식입니다. 검증방식을 통해 등록할 수 있는 등급은 심사원 등급이며, 선임심사원 등록을 원하시는 경우 검증방식을 통한 심사원 등록 이후에 추가로 15M/D 이상의 선임심사원으로서의 심사이력을 보유해야 합니다.
                </div>
                
                <p class="accordion">16. 작년에 ISO 9001 심사원으로 등록했습니다. 자격 유지 조건이 어떻게 되나요?</p>
                <div class="panel">
                    심사원 이상 등급의 경우 매년 연회비가 발생하며, 3년 마다 자격 갱신이 요구됩니다. 심사원 등록 이후 사후 1, 2년차에는 연회비만 납부하시면 자격을 유지하실 수 있으며, 심사원 인증서 원본 및 심사원증(카드)이 새로 발송됩니다.
                </div>
                
                <p class="accordion">17. 심사원 자격 갱신은 3년마다 진행되나요?</p>
                <div class="panel">
                    심사원 자격 등록일 이후 3년 마다 자격 갱신이 요구되며, 갱신 신청 시 다음 요구사항을 충족해야 합니다.
                    <ul>
                        <li>-	만료일 기준 3년 이내, 10M/D 이상의 심사 이력 (선임심사원의 경우 추가로 최소 한 번 이상 선임심사원으로서의 심사이력 필요, 검증심사원의 경우 추가로 최소 한 번 이상 선임심사원으로서의 심사이력 및 검증활동 이력 필요)</li>
                        <li>-	만료일 기준 3년 이내, 16시간 이상의 CPD 활동</li>
                    </ul>
                </div>
                
                <p class="accordion">18. 3년 전에 ISO 9001 심사원보로 등록하였었는데, 곧 만료일입니다. 갱신 요건이 어떻게 되나요?</p>
                <div class="panel">
                    심사원보 자격 갱신의 경우, 심사원보 등록일로부터 3년 이내에 변경, 추가된 학력, 경력, 교육 이력 등을 포함하여 신청처에 재작성 후 제출해주기 바랍니다.
                </div>
                
                <p class="accordion">19. CPD 이력으로 인정되는 활동에는 어떤 것들이 있나요?</p>
                <div class="panel">
                    등록하신 표준과 관련한 내용을 다루고 있는 교육, 세미나, 워크샵 등의 활동이 인정됩니다. 증빙 자료로 참여증, 수료증 등을 제출해 주셔야 합니다.
                </div>
                
                <p class="accordion">20. IAF 코드는 어떻게 부여 받을 수 있나요?</p>
                <div class="panel">
                    GPC 인증원은 PCB(자격인증기관)가 준수해야 하는 요구사항 ISO/IEC 17024에 따라 개인에게 자격을 부여하고 있으며, ISO/IEC 17024에서는 PCB(자격인증기관)가 개인에게 기술영역을 규정하는 것과 관련하여서는 명시하고 있지 않습니다.<br><br>
                    이에 GPC는 신청자에게 Code 및 Category 등의 기술영역을 제한하거나 부여하고 있지 않습니다. 
                </div>
            </div>
        </article>
    </div><!-------div class="tab_con" 종료------>
</div><!---------/class="content_wrap" 종료/------------>

<?php
include_once(G5_THEME_PATH.'/tail.php');
?>