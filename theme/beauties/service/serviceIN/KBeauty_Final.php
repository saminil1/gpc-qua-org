<?php
include_once('./_common.php');
$g5['title'] = 'K-beauty 국제 자격 인증';
include_once(G5_THEME_PATH.'/head.php');

	/*
		이 페이지는 jquery 로 작동됩니다.	
	*/

?>

<style>
	
	/* ---------------------- 시작: 컨텐츠 공통 css ---------------------- */ 
	
	/* 탭메뉴 Hover 효과 변경 HJ 20230117 */
	.tab_menu.tab01 ul li a::before { display: none; }/* 기존 hover 효과 비활성화 */
	.tab_menu.tab01 ul li a span { position: relative; }
	.tab_menu.tab01 ul li a span::before { content: '';display: block;width: 0;height: 3px;background: #8f84c9;position: absolute;left: 50%; bottom: -8px;transform: translateX(-50%); }
	.tab_menu.tab01 ul li.on a span::before { width: 100%;transition: 0.3s; }
	
	
	
	
	/* 각 서브페이지의 포인트 컬러 */
	.point_col { color: #A63EC5;border-color: #A63EC5; }
	
	/* 서브페이지 전체 레이아웃 */
    .content_wrap { width: 100%;max-width: 1200px;margin: 0 auto;font-size: 1rem;font-weight: 400;line-height: 1.6; }
    section, article { margin-bottom: 70px; }/* 문단 하단 부분과 푸터와의 마진 */
	
	/* 페이지 제목에 대한 css */
    .container_title { display: block !important;color: #555;font-size: 1.6rem;line-height: 1;font-weight: 700;text-align: center;border-radius: 4px;background: #fff;box-shadow: 1px 2px 8px #eee;width: 100%;padding: 30px 0;margin: 0 0 50px; }
	
	/* 본문 상단 제목 css */
    .page_title { margin: 70px auto; }
    .page_title .top_tt { margin: 70px auto 0;text-align: center;font-size: 2rem;font-weight: 600; }
	.page_title .top_tt::after { content: "";clear: both;display: block;width: 40px;margin: 50px auto 0;border: 1px solid #999; }
	
	/* 본문 컨텐츠별 타이틀 css - circle-border */
	.tt_sec { display: flex;line-height: 1;margin: 0 0 20px; }
	.tt_sec .tt_mark { margin: 8px 6px auto 0; }
	.tt_sec .tt_mark .circle-border { width: 14px;height: 14px;border: 3px solid #A63EC5;border-radius: 50%; }
	.tt_sec .tt_txt { font-size: 1.15rem;font-weight: 500;line-height: 1.6; }
	
	/* 본문 컨텐츠 여백 설정 css */
    .page_con { width: 100%;margin: 70px auto; }
	.page_con dl dd { margin: 0 0 70px; }
	
	/* 본문 이미지 css */
    .con_img { width: 60%;text-align: center;margin: 70px auto; }
    .con_img img { width: 100%; }
	
	/* 컨텐츠 박스 css - background-color: #f4f4f4 박스 */
	.con_sec { background: #f4f4f4;border-top: 1px solid #ccc;padding: 16px 32px; }
	
	/* 테이블 css - 헤더에 배경색/왼쪽-항목명/오른쪽-내용 기본테이블형식 */
    table.thead_bg { border-collapse: collapse;line-height: 1.6;border-bottom: 2px solid #A63EC5;margin: 0 0 6px; }/* point_col와 동일한 색 적용 */
    table.thead_bg thead th { padding: 8px 16px;vertical-align: middle;color: #fff;background: #A63EC5;border-right: 1px solid #f7f7f7; }/* point_col와 동일한 색 적용 */
    table.thead_bg tbody th { padding: 8px 16px;vertical-align: middle;font-weight: 500;border-bottom: 1px solid #e1e1e1;border-right: 1px solid #e1e1e1; }
    table.thead_bg tbody td { padding: 8px 16px;vertical-align: top;border-bottom: 1px solid #e1e1e1;border-right: 1px solid #e1e1e1; }
    table.thead_bg tbody td.none { border-right: none; }
	
	/* K-beauty 인증 절차 > 심사원 인증 프로세스 */
	.step_wrap { display: flex;margin: 0 0 50px }
    .step_wrap .step { flex: 1;margin: 0 40px 0 0;padding: 20px;border: 1px solid #ddd;border-top: 2px solid #A63EC5;position: relative; }
	.step_wrap .step::before { content: '';display: block;position: absolute;border: 1px dashed #A63EC5;width: 40px;height: 1px;top: 50%;right: -40px;transform: translateY(-50%); }
	.step_wrap .step::after { content: '';display: block;position: absolute;top: calc(50% - 8px);right: -30px;border-left: 10px solid transparent;border-right: 10px solid transparent;border-bottom: 16px solid #A63EC5;transform: rotate(90deg); }
	
	.step_wrap .step:last-child { margin: 0; }
	.step_wrap .step:last-child::before { display: none; }
	.step_wrap .step:last-child::after { display: none; }
	
	.step_wrap .step .arrow { position: relative;margin: 0 0 30px;text-align: center; }
	.step_wrap .step .icon { width: 40%;text-align: center;margin: 0 auto 30px }
	.step_wrap .step .arrow_tit { font-size:1.1rem;font-weight: 500;margin-bottom: 20px;text-align: center; }
    .step_wrap .step .arrow_txt { display: inline-block;border: 1px solid #A63EC5;background: rgba(166,62,197,0.06);text-align: center;font-size: 1rem;font-weight: 500;line-height: 1.2;color: #A63EC5;padding: 4px 16px;border-radius: 32px; }/* point_col와 동일한 색 적용 */
	
	.step_wrap .step p { line-height: 1.4; }
	
	/* ---------------------- 종료: 컨텐츠 공통 css ---------------------- */ 
	
	
    /* ---------------------- 시작: 컨텐츠 페이지별 css ---------------------- */ 
	
	/* K-beauty 인증 소개 > 국제 자격 인증 서비스 - 이미지 2개씩 배열 */
	.con_sec.imgFlex { display: flex;flex-wrap: wrap; }
	.con_sec.imgFlex li { width: calc(50%);text-align: center;margin: 30px 0; }
	.con_sec.imgFlex li img { width: 60%;border-bottom: 3px solid #A63EC5; }
	.con_sec.imgFlex li p { margin: 20px 0 0; }
    
	/* K-beauty 인증 소개 > 국제 자격 인증 서비스 리스트 - 여백 설정 */
	.con_sec.listMargin li { margin: 0 0 6px; }
	.con_sec.listMargin li:last-child { margin: 0; }
	
	/* K-beauty 자격 등급 및 요구사항 - 2번째 테이블 갱신 요구사항 타이틀 설정 */
	.page_con .con_stt { font-size: 1.15rem;font-weight: 500;line-height: 1.5;text-align: left;margin: 0 auto 20px auto;width: 100%; }/* 문단 부제목 css */
    
    /* ---------------------- 종료: 컨텐츠 페이지별 css ---------------------- */ 
	
	
    /* ------------------------ 시작: 반응형 css ------------------------ */
	
	@media (max-width: 1024px) {
        .page_title .top_tt { font-size: 1.85rem; }
		
    }

	@media screen and (max-width: 768px) {
        .container_title { display: none !important }
        
	}
    
    @media screen and (max-width: 640px) {	
        .con_img { width: 100%; }
		.con_sec.imgFlex li img { width: 90%; }
		
        .page_con .con_txt { margin: 20px auto; }
        .step_wrap { display: block;margin: 0; }
        .step_wrap .step { margin: 0 auto 30px;border: 1px solid #d1d1d1;padding: 30px; }
        .step_wrap .step .arrow_tit { font-size: 1rem; }
		
		.step_wrap .step::before { display: none; }
		.step_wrap .step::after { display: none; }
		.step_wrap .step:last-child { margin: 0 auto 30px; }
       
	}

	@media all and (min-width: 360px) and (max-device-width: 414px) {
        .content_wrap { font-size: 0.95rem; }
        .page_title .top_tt { font-size: 1.35rem; }
        .page_con .con_tt { font-size: 1.05rem;width: 100%;margin: 0; }
        .page_con .con_stt { font-size: 1.05rem; }
		
	}
	
    /* ------------------------ 종료: 반응형 css ------------------------ */   

</style>


<div class="content_wrap">
	<div class="tab_menu tab01">
		<ul>
			<!-- 처음 활성화 메뉴에 class="on" -->
			<li class="on"><a href="javascript:;"><span>K-beauty 인증 소개</span></a></li>
			<li><a href="javascript:;"><span>K-beauty 자격 등급 및 요구사항</span></a></li>
			<li><a href="javascript:;"><span>K-beauty 인증 절차</span></a></li>
            <!--<li><a href="javascript:;">FAQ</a></li>-->
		</ul>
	</div>
    
    <div class="tab_con">
		
        <!--+++++ 컨텐츠 01 (처음 활성화 컨텐츠에만 style="display:block") +++++-->
        <article style="display:block">
            <div class="page_title">
                <h3 class="top_tt point_col">K-beauty 인증 소개</h3>
            </div>
            <div class="page_con">
            	<ul>
            		<li>
            			<dl>
            				<dt></dt>
            				<dd>
            					<h4 class="tt_sec">
            						<div class="tt_mark">
										<div class="circle-border"></div>
									</div>
									<p class="tt_txt">GPC는 국제인정기관 미국 IAS로부터 아래와 같은 뷰티 / 미용 분야에 인정을 취득하여 국제 자격 인증 서비스를 제공하고 있습니다.</p>
            					</h4>
                                
								<ul class="con_sec imgFlex">
									<li>
										<img src="./image/Skincare.png" alt="K-Beauty Skincare (스킨케어)">
										<p>K-Beauty Skincare (스킨케어)</p>
									</li>
									<li>
										<img src="./image/Semi-Permanent.png" alt="K-Beauty Semi-Permanent (반영구)">
										<p>K-Beauty Semi-Permanent (반영구)</p>
									</li>
									<li>
										<img src="./image/SMP.png" alt="K-Beauty Scalp Micro Pigmentation (SMP)">
										<p>K-Beauty Scalp Micro Pigmentation (SMP)</p>
									</li>
									<li>
										<img src="./image/Eyelash Extension.png" alt="K-Beauty Eyelash Extension (속눈썹 연장)">
										<p>K-Beauty Eyelash Extension (속눈썹 연장)</p>
									</li>
								</ul>
            				</dd>
            				<dd>
            					<h4 class="tt_sec">
            						<div class="tt_mark">
										<div class="circle-border"></div>
									</div>
									<p class="tt_txt">GPC는 K-Beauty 인증스킴 개발을 통해 아래와 같은 분야의 국제 자격 인증 서비스를 준비하고 있습니다.</p>
								</h4>
								<ul class="con_sec listMargin">
									<li>
										- Permanent
									</li>
									<li>
										- Make-up
									</li>
									<li>
										- Waxing
									</li>
									<li>
										- Eyelash Permanent
									</li>
									<li>
										- Eyebrow Permanent
									</li>
									<li>
										- Planing
									</li>
									<li>
										- Nail Art
									</li>
									<li>
										- Hair
									</li>
								</ul>
            				</dd>
            			</dl>
            		</li>
            	</ul>
            </div>
            
        </article><!--+++++ 컨텐츠 01 (처음 활성화 컨텐츠에만 style="display:block") 종료 +++++-->   

        <article><!--+++++ 컨텐츠 02 시작 +++++--> 
            <div class="page_title">
                <h3 class="top_tt point_col">K-beauty 자격 등급 및 요구사항</h3>
            </div>
            <div class="page_con">
            	<ul>
            		<li>
            			<dl>
            				<dt class="con_img">
                                <img src="./image/kbeauty_expert.jpg" alt="헤어 드라이어를 들고 여자">
                            </dt>
            				<dd>
            					<table class="thead_bg">
									<thead>
										<tr>
											<th scope="cols">
												<p>등급</p>
											</th>
											<th scope="cols">
												<p>요구사항</p>
											</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<th scope="row">
												<p>Pre-Master (Level 1)</p>
											</th>
											<td class="none">
												<p>- 최근 2년 이내 공인 교육기관으로부터 초급 과정 수료</p>
												<p>- GPC 필기 및 실기 시험 합격</p>
											</td>
										</tr>
										<tr>
											<th scope="row">
												<p>Master (Level 2)</p>
											</th>
											<td class="none">
												<p>- 신청 뷰티 / 미용 분야 관련 업무경력 보유 (3년 이상)</p>
												<p>- 최근 2년 이내 공인 교육기관으로부터 중급 과정 수료 또는 강사교육 과정 수료</p>
												<p>- GPC 필기 및 실기 시험 합격</p>
											</td>
										</tr>
										<tr>
											<th scope="row">
												<p>Global Master (Level 3)</p>
											</th>
											<td class="none">
												<p>- 신청 뷰티 / 미용 분야 관련 업무경력 보유 (5년 이상)</p>
												<p>- 최근 2년 이내 공인 교육기관으로부터 고급 과정 수료 또는 강사교육 과정 수료</p>
												<p>- GPC 필기 및 실기 시험 합격</p>
											</td>
										</tr>
									</tbody>
								</table>
            				</dd>
            				<dd>
            					<h4 class="con_stt point_col">
									<i class="fas fa-check-circle" style="margin-right:10px"></i>K-beauty 자격 갱신 요구사항 (최초 등록일 기준 3년 후)
								</h4>
								<table class="thead_bg">
									<thead>
										<tr>
											<th scope="cols">
												<p>등급</p>
											</th>
											<th scope="cols">
												<p>요구사항</p>
											</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<th scope="row">
												<p>Pre-Master (Level 1)</p>
											</th>
											<td rowspan="3" class="none" style="vertical-align: middle">
												<p>GPC가 인정하는 뷰티 / 미용 분야 별 교육, 세미나, 워크샵, 컨퍼런스 등의 개발활동 1회 이상 참석</p>
											</td>
										</tr>
										<tr>
											<th scope="row">
												<p>Master (Level 2)</p>
											</th>
										</tr>
										<tr>
											<th scope="row">
												<p>Global Master (Level 3)</p>
											</th>
										</tr>
									</tbody>
								</table>
            					<strong style="font-weight: 400;">**최초 및 갱신 요구사항은 문서화된 증빙자료를 통해 입증되어야 합니다.</strong>
            				</dd>
						</dl>
					</li>
				</ul>
            </div>
            
        </article><!--+++++ 컨텐츠 02 종료 +++++--> 

        <article><!--+++++ 컨텐츠 03 시작 +++++-->
            <div class="page_title">
                <h3 class="top_tt point_col">K-beauty 인증 절차</h3>
            </div>
            <div class="page_con">
                <ul>
                    <li class="con">
                        <dl>
                            <dt>
                                <h4 class="tt_sec">
            						<div class="tt_mark">
										<div class="circle-border"></div>
									</div>
									<p class="tt_txt">심사원 인증 프로세스</p>
            					</h4>
                            </dt>
                            <dd class="con_txt">
                                <div class="step_wrap">
                                    <div class="step">
                                        <div class="arrow">
                                            <span class="arrow_txt">STEP 1</span>
                                        </div>
                                        <div class="icon">
                                            <img src="./image/contract_02.png" alt="신청 서류 접수">
                                        </div>
                                        <h5 class="arrow_tit">신청 서류 접수</h5>
                                        <p>신청자는 GPC 신청서 및 계약서와 신청하고자 하는 뷰티/미용 분야 및 등급에 따른 추가 서류를 제출합니다.</p>
                                    </div>
                                    <div class="step">
                                        <div class="arrow">
                                            <span class="arrow_txt">STEP 2</span>
                                        </div>
                                        <div class="icon">
                                            <img src="./image/invoice.png" alt="등록 비용 청구">
                                        </div>
                                        <h5 class="arrow_tit">등록 비용 청구</h5>
                                        <p>인보이스를 통해 자격 인증 신청을 위한 비용이 청구됩니다.</p>
                                    </div>
                                    <div class="step">
                                        <div class="arrow">
                                            <span class="arrow_txt">STEP 3</span>
                                        </div>
                                        <div class="icon">
                                            <img src="./image/document.png" alt="서류 검토">
                                        </div>
                                        <h5 class="arrow_tit">서류 검토</h5>
                                        <p>신청 및 제반 자료를 검토하여 적합성을 평가하며 추가적인 증빙이 필요한 경우 자료 보완을 요청합니다.</p>
                                    </div>
                                </div>
                                <div class="step_wrap">
                                    <div class="step">
                                        <div class="arrow">
                                            <span class="arrow_txt">STEP 4</span>
                                        </div>
                                        <div class="icon">
                                            <img src="./image/test.png" alt="GPC 시험 응시">
                                        </div>
                                        <h5 class="arrow_tit">GPC 시험 응시</h5>
                                        <p>자격요건을 충족하는 신청자는 GPC 필기 및 실기시험을 응시할 수 있으며 평가 기준에 따라 합격하여야 합니다.</p>
                                        <p style="margin-top: 6px;">실기시험의 경우 필기시험을 합격한 자에 한하여 응시할 수 있습니다.</p>
                                    </div>
                                    <div class="step">
                                        <div class="arrow">
                                            <span class="arrow_txt">STEP 5</span>
                                        </div>
                                        <div class="icon">
                                            <img src="./image/paper.png" alt="인증결정위원회의 검토">
                                        </div>
                                        <h5 class="arrow_tit">인증결정위원회의 검토</h5>
                                        <p>인증결정위원회는 신청 뷰티/미용 분야 및 등급과 관련하여 신청자가 모든 요구사항을 충족하는지 최종적인 검토를 진행합니다.</p>
                                    </div>
                                    <div class="step">
                                        <div class="arrow">
                                            <span class="arrow_txt">STEP 6</span>
                                        </div>
                                        <div class="icon">
                                            <img src="./image/certificate.png" alt="인증서 발행">
                                        </div>
                                        <h5 class="arrow_tit">인증서 발행</h5>
                                        <p>인증결정위원회로부터 인증발행이 결정되면 인증서가 발행되어 신청자에게 전달됩니다.</p>
                                    </div>
                                </div>
                            </dd>
                        </dl>
                    </li>
                </ul>
            </div>
            
        </article><!--+++++ 컨텐츠 03 종료 +++++-->
        
    </div><!-------div class="tab_con" 종료------>
    
</div><!---------/class="content_wrap" 종료/------------>

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

<?php
include_once(G5_THEME_PATH.'/tail.php');
?>