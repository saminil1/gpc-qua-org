<?php
$page_meta_tags = '
<meta name="title" content="연수기관 지정 소개">
<meta name="description" content="GPC는 IPC와 경영시스템 심사원 인증 및 연수기관 지정과 관련하여 MLA를 체결함으로써 연수기관 지정에 대한 권한을 승인받아 다음과 같은 심사원 교육 과정이 등록되어 있습니다.">
<meta name="keywords" content="연수기관 지정, IPC, MLA, 권한, 승인, ISO/IEC 17021-1, ISO 19011, 지침, ISO 표준 요구사항, 심사원 교육 과정, ISO 9001:2015, 품질경영시스템 인증 심사원, ISO 13485:2016, 의료기기 품질경영시스템 인증 심사원, ISO 14001:2015, 환경경영시스템 인증 심사원, ISO 22000:2018, 식품안전경영시스템 인증 심사원, ISO 45001:2018, 안전보건경영시스템 인증 심사원, ISO 21001:2018, 교육기관경영시스템 인증 심사원, ISO 22301:2019, 비즈니스연속성경영시스템 인증 심사원, ISO/IEC 27001:2013, 정보보안경영시스템 인증 심사원, ISO/IEC 27701:2019, 개인정보경영시스템 인증 심사원, ISO 37001:2016, 부패방지경영시스템 인증 심사원, ISO 22716:2007, 우수화장품 제조 및 품질관리시스템 심사원, ISO 21384-3:2019, 무인항공시스템 심사원, ISO 50001:2018, 에너지경영시스템 인증 심사원, ISO 55001:2014, 자산경영시스템 인증 심사원, ISO 37301:2021, 컴플라이언스경영시스템 인증 심사원">
<meta property="og:type" content="website"> 
<meta property="og:title" content="연수기관 지정 소개">
<meta property="og:description" content="GPC는 IPC와 경영시스템 심사원 인증 및 연수기관 지정과 관련하여 MLA를 체결함으로써 연수기관 지정에 대한 권한을 승인받아 다음과 같은 심사원 교육 과정이 등록되어 있습니다.">
<meta property="og:url" content="https://www.gpcert.org/theme/gpcert/service/training_introduction.php">
';
include_once('./_common.php');
$g5['title'] = '연수기관 지정 소개';
include_once(G5_THEME_PATH.'/head.php');
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
    .page_con .con_stt { font-size: 1.15rem; font-weight: 500; line-height: 1.5; text-align: left; margin: 0 auto 20px auto;width: 100%; }/* 문단 부제목 css */
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
    
    .faq_wrap .accordion { border-bottom: 1px solid #6b8a0f;color: #6b8a0f;cursor: pointer;padding: 20px 40px 20px 50px;width: 100%;text-align: left;position: relative }/* point_col와 동일한 색 적용 */
    .faq_wrap .accordion::before { content: '';float: right;width: 10px;height: 10px;margin: 6px 0 0 20px;border-bottom:2px solid #ccc;border-right:2px solid #ccc;transform: rotate(45deg) }/* 열림 버튼 생성 */
    .faq_wrap .accordion::after { content: "Q";display: block;width: 40px;float: left;text-align: center;margin-left: -40px;font-size: 1.45rem;font-weight: 700;line-height: 1;position: absolute;top:20px }/* 알파벳 Q */
    .faq_wrap .accordion.active, .faq_wrap .accordion:hover { background-color: #6b8a0f;color: #fff }/* 아코디언 클래스를 클릭, 호버될 경우 배경색 변경 / point_col와 동일한 색 적용 */
    
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
			<li class="on"><a href="/theme/gpcert/service/training_introduction.php">연수기관 지정소개</a></li>
			<li><a href="/theme/gpcert/service/training_process.php">연수기관 지정절차</a></li>
			<li><a href="/theme/gpcert/service/training_invigilator.php">시험감독관</a></li>
            <li><a href="/theme/gpcert/service/training_FAQ.php">연수기관 지정FAQ</a></li>
		</ul>
	</div>
    
    <div class="tab_con">
		<!--+++++ 연수기관 지정 소개 // 탭메뉴 페이지 분리 20230323 HJ +++++-->
        <article style="display:block">
            <div class="page_title">
                <h1 class="top_tt point_col">연수기관 지정소개</h1>
                <!--<h2 class="top_stt"></h2>-->
                <p class="top_txt">
                    GPC는 IPC와 경영시스템 심사원 인증 및 연수기관 지정과 관련하여 MLA를 체결함으로써 연수기관 지정에 대한 권한을 승인받았습니다. GPC에 등록된 심사원/선임심사원 교육 과정은 ISO/IEC 17021-1 및 ISO 19011을 기반으로 한 심사 수행에 대한 지침 및 ISO 표준 요구사항에 대한 내용으로 구성되어 있으며, 현재 아래와 같은 교육 과정이 등록되어 있습니다.
                </p>
            </div>
            <div class="page_con">
                <ul>
                    <li>
                        <dl>
                            <dt class="con_img">
                                <img src="./image/training_01.jpg" alt="심사원 교육 과정">
                            </dt>
                            <dd style="margin:0 0 70px">
                                <h3 class="con_stt point_col">
                                    <i class="fas fa-check-circle" style="margin-right:10px"></i>심사원 교육 과정
                                </h3>
                                <table class="type01">
                                    <tbody>
                                        <tr>
                                            <th width="30%" scope="row">
                                                <p>ISO 9001:2015</p>
                                            </th>
                                            <td width="70%">
                                                <p>품질경영시스템 인증 심사원</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th width="30%" scope="row" class="even">
                                                <p>ISO 13485:2016</p>
                                            </th>
                                            <td width="70%" class="even">
                                                <p>의료기기 품질경영시스템 인증 심사원</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th width="30%" scope="row">
                                                <p>ISO 14001:2015</p>
                                            </th>
                                            <td width="70%">
                                                <p>환경경영시스템 인증 심사원</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th width="30%" scope="row" class="even">
                                                <p>ISO 22000:2018</p>
                                            </th>
                                            <td width="70%" class="even">
                                                <p>식품안전경영시스템 인증 심사원</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th width="30%" scope="row">
                                                <p>ISO 45001:2018</p>
                                            </th>
                                            <td width="70%">
                                                <p>안전보건경영시스템 인증 심사원</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th width="30%" scope="row" class="even">
                                                <p>ISO 21001:2018</p>
                                            </th>
                                            <td width="70%" class="even">
                                                <p>교육기관경영시스템 인증 심사원</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th width="30%" scope="row">
                                                <p>ISO 22301:2019</p>
                                            </th>
                                            <td width="70%">
                                                <p>비즈니스연속성경영시스템 인증 심사원</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th width="30%" scope="row" class="even">
                                                <p>ISO/IEC 27001:2013</p>
                                            </th>
                                            <td width="70%" class="even">
                                                <p>정보보안경영시스템 인증 심사원</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th width="30%" scope="row">
                                                <p>ISO/IEC 27701:2019</p>
                                            </th>
                                            <td width="70%">
                                                <p>개인정보경영시스템 인증 심사원</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th width="30%" scope="row" class="even">
                                                <p>ISO 37001:2016</p>
                                            </th>
                                            <td width="70%" class="even">
                                                <p>부패방지경영시스템 인증 심사원</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th width="30%" scope="row">
                                                <p>ISO 22716:2007</p>
                                            </th>
                                            <td width="70%">
                                                <p>우수화장품 제조 및 품질관리시스템 심사원</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th width="30%" scope="row" class="even">
                                                <p>ISO 21384-3:2019</p>
                                            </th>
                                            <td width="70%" class="even">
                                                <p>무인항공시스템 심사원</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th width="30%" scope="row">
                                                <p>ISO 50001:2018</p>
                                            </th>
                                            <td width="70%">
                                                <p>에너지경영시스템 인증 심사원</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th width="30%" scope="row" class="even">
                                                <p>ISO 55001:2014</p>
                                            </th>
                                            <td width="70%" class="even">
                                                <p>자산경영시스템 인증 심사원</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th width="30%" scope="row">
                                                <p>ISO 37301:2021</p>
                                            </th>
                                            <td width="70%">
                                                <p>컴플라이언스경영시스템 인증 심사원</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
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