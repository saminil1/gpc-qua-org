<?php
	include_once('./_common.php');
$g5['title'] = 'Appeal';//<!------서브페이지 최상위 타이블, css/design.css 파일 Line 425 ~ line 430까지 참조-------> 
include_once(G5_THEME_PATH.'/head.php');
	/*
		이 페이지는 jquery 로 작동됩니다.	
	*/
?>

<?php 
	/*	
		기본 css(11~15라인)
		기본 css 는 적용하지 않습니다. 
	*/ 
?>

<link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR:100,300,400,500,700,900&display=swap&subset=korean" rel="stylesheet">

<?php
	/*
		주의사항 
		관리자모드 내용관리등 에디터로 내용을 등록하실 경우, 보안문제로 자바스크립트와 css가 필터될 수 있습니다.
		이럴 경우 공통 css 파일에 아래 style을 별도 추가하고, 내용관리 에디터의 HTML 모드로 태그를 넣으시면 됩니다.(에디터마다 HTML 모드 버튼이 있으니 HTML 모드로 넣어주세요.)
		javascript 를 사용한다면 공통하단 파일 </body> 위에 코드를 복사하여 추가 합니다.	
	
	*/
?>
<style>
	/* 내용관리등 에디터로 입력할 경우  여기서부터 */

    
/*회사안내- 이의제기 페이지 시작-YR 210728*/
    .clear{ /*float 문제 해결*/
        content="";
        display:block;
        clear:both;
    }
    .content_wrap{
        overflow:hidden;
        font-size:1rem;
        font-weight:400;
        color:#333;
        line-height:1.8rem;
        text-align:justify;
    }
   .container_title{/* 서브페이지 상단 타이틀 생성 / 20210730 HJ */
        display: block !important;
        color:#555; font-size:1.6rem;
        line-height:1; font-weight:700;
        text-align:center;
        border-radius:4px;
        background:#fff;
        box-shadow: 1px 2px 8px #eee;
        width:100%; padding:30px 0; margin: 0 0 50px;
    }
    .top_tt{
        text-align:center;
        color:#5d94c3;
        font-size:2.2rem;
        font-weight:600;
        padding:50px 0;
        line-height:3.4rem;
    }
    
    
    /*이의제기 컨텐츠*/
    .appeal_box{margin:0 0 100px;}
    .complaint_box{margin-bottom:100px;}
    .appeal_complaint_box{margin-bottom:50px;}
    .content_title{
        font-size: 1.8rem;
        font-weight: 500;
        color: #333;
        margin-bottom: 40px;
    }
    .content_title:before{ /*제목 위 border*/
        content: "";
        display:block;
        width:35px;
        height:3px;
        background:#5d94c3;
        margin-bottom:13px;
    }
    .mid_content01, .mid_content02, .mid_content03{
        color:#333;
        font-weight:400;
        text-align:justify;
        letter-spacing:-0.02em;
    }
    /*이메일 주소*/
    .content_txt>p{margin-top:10px;vertical-align:middle;}
    .content_txt .material-icons{
        vertical-align:middle;
        font-size:1.2rem;
        margin-bottom:2px;
        color:#2e516f;
    }
     /*이의제기 목록 ul*/
    .content_txt ul.appeal_info2 li:first-child{margin:0 0% 15px 0%;}
    .content_txt ul.appeal_info2 li:not(:first-child){height:30px;color:#2e516f;font-weight:400;margin:0 3%;}
    
    
    
    /*이의 및 불만 제기 방법*/
    .box_content_txt_list{margin:10px 3% 15px;color:#2e516f;}
    .mid_content03 ul.appeal_info{
        display:block;
        width:100%;
        height:auto;
        background:#f9f9f9;
        border-radius: 5px;
        padding:22px 20px;
        text-align: justify;
        margin-top:15px;
    }
    .mid_content03 ul.appeal_info li{
        height:38px;
        vertical-align: middle;
        text-indent:10px;
        line-height:38px;
    }
    .mid_content03 ul.appeal_info li>.appeal_info_tt{ /*불만 및 이의제기 제출 정보 타이틀*/
        display:inline-block;
        width:150px;
        font-weight:500;
    }
    .mid_content03 .material-icons{ /*아이콘*/
        font-size:1.2em;
        vertical-align: middle;
        color:#5d94c3;
        padding-right:2px;
        margin-bottom:4px;
    }
      
     
    /*고객게시판 글쓰기 버튼*/
    .write_qna_btn a{
        display:block;
        background:#fff;
        border:1px solid #666;
        font-weight:500;
        color:#444;
        font-size:1rem;
        padding:15px 10px 13px;
        width:220px;
        text-align:center;
        vertical-align:middle;
        margin:30px auto 0px;
        transition:all 0.2s; /*마우스 오버시 효과 YR*/
    }
    .write_qna_btn a:hover{
        background:#eee;
        border:1px solid transparent;
    }
    
    .write_qna_btn a .material-icons{
        vertical-align:middle;
        font-size:1.3rem;
        color:#333;
        margin-bottom:3px;
        transition:all 0.2s; /*마우스 오버시 효과 YR*/
    }
    .write_qna_btn a:hover .material-icons{
        color:#999;
    }
     /*게시판 영역 CSS 해당 페이지에서만 변경 210802 전산팀 yr*/
    .lat .lat_title {
        font-size: 1.7rem;
    }
    .lat .lat_title:before {
        content: "";
        display: block;
        width: 35px;
        height: 3px;
        background: #5d94c3;
        margin-bottom: 13px;
    }
    .lat li:first-child {
        margin-top: 20px;
        border-top: 2px solid #ddd;
    }
    .lat .lt_more {
        display: none;
    }

    .claim_opinion{display:block;width:80%;margin-top:20px;font-size:1rem;}
    
/*회사안내- 이의제기 페이지 종료*/
    

    
    /* -----------------------------------------------------반응형 시작 -210803 yr*/    
    
    /* 놋북,태블릿 사이즈, 최대 1280px 화소까지 적용 */
    @media (max-width:1280px) {
        .container_title{width:100%;}
        .mid_content03 ul.appeal_info li>.appeal_info_tt{ /*불만 및 이의제기 제출 정보 타이틀*/
            display:inline-block;
            width:135px;
            font-weight:500;
        }
        .mid_content03 ul.appeal_info li{
            height:38px;
            vertical-align: middle;
            text-indent:5px;
            line-height:38px;
        }
        .mid_content03 .material-icons{ /*아이콘*/
            font-size:1.2em;
            vertical-align: middle;
            color:#5d94c3;
            padding-right:8px;
        }
        
        /*게시판 영역 CSS 해당 페이지에서만 변경 210802 전산팀 yr*/
        .main_bbs .wrap{padding:0px;}
        .claim_opinion{display:block;width:100%;margin-top:20px;font-size:1rem;}
    }

    
    /* 최대 1024px 화소까지 적용 */
    @media (max-width:1024px) {
         /*-----1024px에서 텍스트 크기 변경되는 class -----*/
        .container_title{width:100%; font-size: 1.2rem;}
        .top_tt{ 
            padding:40px 0 40px;
            font-size: 1.6rem;
        }
        .content_title{ /*회사개요 제목*/
            font-size:1.5rem;
        }
        .lat .lat_title { /*게시판 제목*/
            font-size:1.5rem;
        }
        /*-----1024px에서 텍스트 크기 변경되는 class -----*/
        
        /*대표전화/팩스 등 불만 및 이의제기 제출 주소*/
        
        .mid_content03 ul.appeal_info{
            display:block;
            width:100%;
            height:auto;
            background:#f9f9f9;
            border-radius: 5px;
            padding:22px 5%;
            text-align: justify;
            margin:15px 0% 0px;
        }
        .mid_content03 ul.appeal_info li{
            height:auto;
            vertical-align: middle;
            text-indent:0px;
            margin:10px 0;
            line-height:1.8rem;
        }
        .mid_content03 ul.appeal_info .info_detail{
            display:block;
            margin-left:30px;
        }
    }
    

    /*  최대 768px 화소까지 적용 */
    @media only screen and (max-device-width : 768px) and (-webkit-min-device-pixel-ratio: 1) {
        .container_title{display:none !important;} /*탭메뉴와 중복되어서 안보이게함*/ 
        .appeal_complaint_box{margin-bottom:100px;}
    }


    /* 모바일(가장 작은 사이즈: SAMSUNG GALAXY S6) 가로 버전 사이즈, 최소 360px ~ 최대 640px(가로로 볼때) 화소까지 적용 */    
    @media all and (max-device-width : 640px) { 
        .content_wrap{
            overflow:hidden;
        }
        .top_tt {
            padding: 20px 0 40px;
        }
         /*이의제기 컨텐츠*/
        .appeal_box{margin:0 0 60px;}
        .complaint_box{margin-bottom:60px;}
        .appeal_complaint_box{margin-bottom:60px;}
        
        /*대표전화/팩스 등 불만 및 이의제기 제출 주소*/
        .mid_content03 ul.appeal_info{
            padding:14px 5%;
            text-align: justify;
            margin:15px 0% 0px;
        }
        
        /*고객게시판 글쓰기 버튼*/
        .write_qna_btn a{
            padding:16px 10px 12px;
            width:200px;
            text-align:center;
            vertical-align:middle;
            margin:30px auto 0px;
            transition:all 0.2s; /*마우스 오버시 효과 YR*/
        }
         .write_qna_btn a .material-icons{
            vertical-align:middle;
            font-size:1.2rem;
            color:#333;
            margin-bottom:3px;
        }
    }


    /* 모바일(가장 큰 사이즈: iPhone 6/7/8 Plus) 세로 버전 사이즈, 최소 360px ~ 최대 414px 화소까지 적용 */
    @media all and (min-width:360px) and (max-device-width : 414px) {  
        /*----- 360px ~ 414px에서 텍스트 크기 변경되는 class -----*/
        .content_wrap{
            font-size:0.95rem;
            line-height:1.6rem;
        }
        .top_tt{
            font-size:1.35rem;
            padding:0px 0 30px;
        }
        .content_title{
            font-size:1.3rem;
        }
        .lat .lat_title { /*게시판 제목*/
            font-size:1.3rem;
        }
        .write_qna_btn a{
            padding:12px 10px 10px;
            width:180px;
            font-size:0.9rem;
        }
        /*----- 360px ~ 414px에서 텍스트 크기 변경되는 class -----*/
        
       /*이의제기 목록 ul*/
        .content_txt ul.appeal_info2 li:not(:first-child){margin:0 0%;}
        
        
        /*대표전화/팩스 등 불만 및 이의제기 제출 주소*/
        .mid_content03 ul.appeal_info{
            padding:14px 6%;
        }
        .mid_content03 .material-icons{ /*아이콘*/
            padding-right:6px;
        }
        .mid_content03 ul.appeal_info .info_detail{
            display:block;
            margin-left:0px;
        }
        
       /*이의 및 불만 제기 방법*/
        .box_content_txt_list{margin:10px 0% 15px;}    
    }  
/*---------------------------------------------------------------반응형 끝*/
    
	/*  여기까지 코드를 복사하여 공통 css파일 최하단에 추가합니다. */
</style>

<!-- /* 내용관리등 에디터로 입력할 경우 여기서부터 */ -->


<body> 
    
<div class="content_wrap">
       
    <!--------------이의제기--------------->
    
    <div class="appeal_box animatedParent">
        <div class="top_tt animated fadeInUpShort">Appeal &amp; Complaint</div>
        <h2 class="content_title animated fadeInUpShort">Appeal</h2>
        <ul class="mid_content01 animated fadeInUpShort">
            <li>
                <div class="content_txt">
                    Any client can take issue as an appeal against GPC decision on certification.<br>
                    The appeal against the decision of GPC must be made within 30 days of notification of that decision.<br><br>

                    The appeals can be submitted to the GPC Administration department, along with evidence materials, to the email address below.<br>
                    <p class="gpc_email"><span class="material-icons">mail_outline</span> E-Mail : info@gpcert.org</p><br>

                    The administration department should check the documents for completeness and may ask for additional documentary, if necessary. After checking the appeal should be forwarded to the manager of administration department. The manager has the right to either disallow the appeal or to organize an Appeal Panel based on the contents of the appeal.<br><br>

                    An appeal against adverse certification or recertification decisions or cancellation of certification should be treated in writing form. The written appeal will be reviewed, investigated and resolved in a timely manner through a formal documented process.<br><br>

                    <ul class="appeal_info2">
                        <li class="first_line">Appeals can be processed on the following decisions:</li>
                        <li>a. Refusal to grant initial certification</li>
                        <li>b. Refusal to grant continual certification</li>
                        <li>c. Refusal to grant upgrade certification</li>
                        <li>d. Reduction in certification grade</li>
                    </ul><br>
                    
                    If the appeal is accepted, manager of administration department will organize an Appeal Panel. The Head of the Appeal Panel may ask the appellant to present, if necessary.<br><br>

                    The Appeal Panel gives its recommendation to the manager of administration department for necessary action to discharge the appeal to the satisfaction of the appellant. The Appeal Panel also recommends preventive action, if any, to avoid such recurrences.<br>
                    The manager of administration department will give the decision on the appeal based on the recommendation by the appeals panel. The decision of the manager of administration department will be final.<br><br>

                    The above process will be completed within 45 days from the date of admission to the appeal.<br><br>

                    If not satisfied with the decision of the manager of administration department, appellant can file appeal to the President of GPC. The president will organize Appeal Panel consisting of three members, that will go into the situation of the case and the procedure follows to address the appeal.<br><br>

                    The Appeal Panel will make recommendation to the president. The president will give the decision based on the recommendation by the appeal panel. The above process will be completed within 45 days of referring the appeal to the president. The president shall be acting on the advice of any appropriate specialist, if necessary.<br><br>

                    If the appeals ends or a reassessment or verification is required as a result of the appeal decision, the cost of the appeal is borne by the appellant.<br><br>

                    If not satisfied with the decision of the President of GPC, the appellant can file appeal to the Accreditation Body. However, this process is only possible after all processes have been taken to resolve the issue by filing appeal with GPC. In such a case, the Accreditation Body’s appeals process shall be followed, and the costs of appeal shall be borne by the appellant unless the appeal is accepted.<br><br>

                    The decision of the relevant Accreditation Body shall be final and binding on both parties, i.e., the appellant and GPC. Administration department maintains the track of the appeals, including action taken to resolve them.<br><br>
                    
                    In the event of a dispute, the laws and regulations of the Republic of Korea where GPC is located will apply, and Court of Korea can have full control over administrative process.<br>
                </div>
            </li>
        </ul>
    </div>
    
    <!--------------불만제기--------------->
    
    <div class="complaint_box animatedParent">
        <h2 class="content_title animated fadeInUpShort">Complaint</h2>
        <ul class="mid_content02 animated fadeInUpShort">
            <li>
                <div class="content_txt">
                    Complaints are handled by administration department. Administration department has the authority to receive, verify and investigate complaints and to make corrective actions for complaints.<br>
                    Manager of administration department will forward the complainant to the concerned official of GPC for disposition, who will take necessary corrective and preventive action to close the complaint, without any undue delay.<br><br>

                    A written and/or verbal, external as well as internal complaints can be received by any employee/staff of GPC.<br>
                    The complaint received shall be forwarded to manager of administration department, who will immediately enter it into the complaints register being maintained at GPC. Additional information may be requested from the complainant, if necessary.<br>
                    The complaint shall be acknowledged within 24 hours of receipt by telephone or by sending an e-mail. If possible, formal notice shall be given to the complainant about the end of the complaint handling process.<br><br>

                    The result of handling complaint shall be communicated to the complainant. The complainant and the content of the complaint shall be kept confidential in accordance with GPC complaint handling procedure.
                    
                </div>
            </li>
        </ul>
    </div>
    
     <!--------------이의 및 불만 제기 방법--------------->
    
    <div class="appeal_complaint_box animatedParent">
        <h2 class="content_title animated fadeInUpShort">How to file a Complaint and Appeal</h2>
        <div class="mid_content03 animated fadeInUpShort">
            <div class="content_txt">
                In the event of complaints and appeals, the following must include:
                <ul class="box_content_txt_list">
                    <li>- Name, Contact, Email address</li>
                    <li>- Date of complaint &amp; appeal, detailed description</li>
                    <li>- Relevant evidence</li>
                    <li>- Signature</li>
                </ul>
                Additional materials may be requested to verify complaints and appeals.<br><br>
                Complaints and appeals should be submitted to the address below.<br>

            </div>
            <ul class="appeal_info animated fadeInUpShort">
                <li><span class="material-icons">inbox</span><span class="appeal_info_tt">Phone / Fax</span><span class="info_detail">+82 2 6749 0710 / +82 2 6749 0711</span></li>
                <li><span class="material-icons">inbox</span><span class="appeal_info_tt">E-Mail</span><span class="info_detail gpc_email">info@gpcert.org</span></li>
                <li><span class="material-icons">inbox</span><span class="appeal_info_tt">Address</span><span class="info_detail">(08504) Room 501-1, Daeryung Techno Town, 638, Seobusaet-gil, Geumcheon-gu, Seoul</span></li>
            </ul>
        </div>
    </div>
    
    <!-- Appeal & Complaint 게시판 영역 -->
    
    <section class="main_sec main_bbs animatedParent">
        <div class="wrap animated fadeInUpShort">
            <!-- 일반 최근글 /theme/구매테마/skin/latest/basic/latest.skin.php -->
            <div class="claim_opinion"><?php echo latest('theme/basic', 'claim', 5, 40); ?></div>
        </div>
             <!--고객게시판 글쓰기 버튼-->
        <div class="write_qna_btn animated fadeInUpShort"><a href="/bbs/write.php?bo_table=claim">Client Board&nbsp;<span class="material-icons">edit</span></a></div>
    </section>
    
	
    <!-- Appeal & Complaint 게시판 영역  끝-->
    
   
    

<!-- /* 여기까지 에디터의 HTML 모드로 등록합니다. */ -->

      
</div> <!----------++++++++/  div class="content_wrap" 종료  /+++++++++----------------->

</body>
    
<?php
include_once(G5_THEME_PATH.'/tail.php');
?>