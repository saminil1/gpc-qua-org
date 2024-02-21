<?php
include_once('./_common.php');
$g5['title'] = 'Introduction';
include_once(G5_THEME_PATH.'/head.php');
?>

<style>   

/*회사안내- 회사소개 페이지 시작-YR 210728*/
    .content_wrap{
        font-size:1rem;
        font-weight:400;
        color:#333;
        line-height:1.8rem;
        text-align:justify;
        overflow-x:hidden;
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
        font-weight:700;
        padding:50px 0;
        line-height:3.4rem;
    }
    
    .top_tt:after { /*밑줄선*/
        content: "";
        clear: both;
        display: block;
        width: 40px;
        margin: 50px auto 0;
        border: 1px solid #999;
    }
    .top_txt{
        font-size:1rem;
        line-height:1.8rem;
        color:#333;
        font-weight:400;
        text-align:justify;
        margin-bottom:60px;
    }
    
    /*1번-5번 서비스*/
    .mid_content01{padding:5px 0;}
    .mid_content01 h3{ 
        font-size:1.3rem;  
        font-weight:500; 
        letter-spacing:-1px; 
        color:#333;
        margin-bottom:10px;
    }
    .gray_box{
        display:block;
        width:92%;
        margin:30px 4%;
        height:auto;
        padding:30px 50px;
        background:#eff3f7;
        border-top:1px solid #ddd;
        color:#333;
        font-weight:400;
    }
    
    
    /*회사개요*/
    .mid_content02 {margin:50px 0 30px;}
    .mid_content02 .content_title{ /*회사개요 제목*/
        font-size:1.8rem;
        font-weight:500;
        color:#333;
        margin-bottom:40px;
    }
     .mid_content02 .content_title:before{ /*제목 위 border*/
        content: "";
        display:block;
        width:35px;
        height:3px;
        background:#5d94c3;
        margin-bottom:13px;
    }
    .company_info{
        width:100%;
        height:auto;
        padding:20px 7%;
        background:#f9f9f9;
        border-top:3px solid #eee;
    }
    .mid_content02  ul li{
        padding:8px 12px;
        color:#333;
        font-weight:400;
    }
    .mid_content02  ul li>span{
        display:inline-block;
        width:20%;
        font-size:1.1rem;
        color:#333;
        font-weight:500;
        vertical-align:top;
    }
    .mid_content02  ul li .overview_txt{
        font-size:1rem;
        color:#333;
        font-weight:400;
        width:80%;
    }  
/*회사안내- 회사소개 페이지 종료*/     

    
    
/* -----------------------------------------------------반응형 시작 -210803 yr*/  
    
    /* 놋북,태블릿 사이즈, 최대 1280px 화소까지 적용 */
    @media (max-width:1280px) {
        .container_title{width:100%;}
         .company_info{ /*회사개요 컨텐츠 박스*/
            width:100%;
            height:auto;
            padding:20px 6%;
            background:#f9f9f9;
            border-top:3px solid #eee;
        }
        .mid_content02  ul li>span{ /*회사개요 왼쪽 타이틀*/
            display:inline-block;
            width:20%;
            font-size:1.1rem;
            color:#333;
            font-weight:500;
            vertical-align:top;
        }
        .mid_content02  ul li .overview_txt{
            display:inline-block;
            width:80%;
        }
        
    /* 최대 1024px 화소까지 적용 */
    @media (max-width:1024px) {
        /*-----1024px에서 텍스트 크기 변경되는 class -----*/
        .container_title{width:100%; font-size: 1.2rem;}
        .top_tt{ 
            padding:40px 0 40px;
            font-size: 1.6rem;
        }
        .top_tt:after { /*밑줄선*/
            margin: 40px auto 0;
        }
        .mid_content01 h3{font-size:1.2rem;}
        .mid_content02 .content_title{ /*회사개요 제목*/
            font-size:1.5rem;
        }
         .mid_content02  ul li>span{ /*회사개요 왼쪽 타이틀*/
            display:block;
            width:100%;
            font-size:1rem;
            color:#333;
            font-weight:500;
            padding-bottom:2px;
        }
        /*-----1024px에서 텍스트 크기 변경되는 class -----*/
        
        
        .gray_box{ /*개인인증, 연수기관 지정 컨텐츠*/
            display:block;
            width:100%;
            margin:30px 0%;
            height:auto;
            padding:30px 7%;
        }
        .company_info{ /*회사개요 컨텐츠 박스*/
            padding:20px 7%;
        }
        .mid_content02  ul li{ /*회사개요 li*/
            padding:8px 0px;
            color:#333;
            font-weight:400;
        }
        .mid_content02  ul li .overview_txt{
            display:inline-block;
            width:100%;
        }
        
    }

    /*  최대 768px 화소까지 적용 */
    @media only screen and (max-device-width : 768px) and (-webkit-min-device-pixel-ratio: 1) {
        .container_title{display:none !important;} /*탭메뉴와 중복되어서 안보이게함*/  
        
    }

    /* 모바일(가장 작은 사이즈: SAMSUNG GALAXY S6) 가로 버전 사이즈, 최소 360px ~ 최대 640px(가로로 볼때) 화소까지 적용 */    
    @media all and (max-device-width : 640px) { 
        .top_tt{
            padding:20px 0 40px;
        }
        .gray_box{ /*개인인증, 연수기관 지정 컨텐츠*/
            display:block;
            height:auto;
            padding:20px 7%;
        }
        .content_title{ /*company overview*/
            margin-top:80px; 
        }
    }


    /* 모바일(가장 큰 사이즈: iPhone 6/7/8 Plus) 세로 버전 사이즈, 최소 360px ~ 최대 414px 화소까지 적용 */
    @media all and (min-width:360px) and (max-device-width : 414px) { 
        /*----- 360px ~ 414px에서 텍스트 크기 변경되는 class -----*/
        .content_wrap{
            font-size:0.95rem;
            line-height:1.6rem;
        }
        .top_txt{
            font-size:0.95rem;
            line-height:1.6rem;
            margin-bottom:30px;
        }
        .top_tt{
            font-size:1.35rem;
            padding:0px 0 30px;
        }
        .top_tt:after { /*밑줄선*/
            margin: 30px auto 0;
        }
        .mid_content01 h3{font-size:1rem;}
        .gray_box{ /*개인인증, 연수기관 지정 컨텐츠*/
            margin:20px 0%;
        }
        .mid_content02 .content_title{ /*company overview*/
            margin-top:0px;
            font-size:1.3rem;
        }
        .mid_content02  ul li>span{ /*회사개요 왼쪽 타이틀*/
            font-size:0.95rem;
        }
        .mid_content02  ul li .overview_txt{
            font-size:0.95rem;
        } 
        /*----- 360px ~ 414px에서 텍스트 크기 변경되는 class -----*/
    }  
            
/*---------------------------------------------------------------반응형 끝*/
    
*/
    
    
</style>

<body>

<div class="content_wrap">
	<section class="paragraph animatedParent" data-sequence="300">
        <div class="top_content animated fadeInUpShort" data-id="1">
            <div class="top_tt">Global Personnel Certification</div>
            <h2 class="top_txt">
                <span style="font-weight:500;">GPC</span> is a personnel certification body that has been accredited based on ISO/IEC 17024 from IAS, an accreditation body, and provides the following services.
            </h2>
        </div>
    </section>
    
    <!--------------mid_content--------------->
	
	<section class="paragraph animatedParent" data-sequence="300">
        <div class="mid_content01 animated fadeInRightShort" data-id="1">
            <h3>1. Personnel certification</h3>
            <div class="gray_box" style="display:block";>
                GPC provides personnel certification services by evaluating and verifying competence according to impartial and objective evaluation criteria.
            </div>
            <br>
            <h3>2. Designation of training provider</h3>
            <div class="gray_box">
                Companies need auditors who are qualified in various fields to ensure efficient operation and competitiveness. GPC designates qualified institutions as training providers by signing MLA with IPC, IAF Association member, for the designation of a training provider, and training providers strive to produce auditors with expertise.
            </div>   
        </div>
    </section>
    
    <hr style="display:block;height:2px;margin-top:-20px;margin-bottom:40px;"> <!--  구분선 -->
    
    <!--------------회사개요--------------->

	<section class="animatedParent" data-sequence="300">
        <div class="mid_content02 animated fadeInRightShort" data-id="1">
            <h2 class="content_title">Company Overview</h2>
            <div class="animated fadeInRightShort" data-id="2">
                <ul class="company_info">
                    <li><span>Company</span> Global Personnel Certification Co., Ltd.</li>
                    <li><span>Phone / Fax</span> +82 2 6749 0710 / +82 2 6749 0711</li>
                    <li class="gpc_email"><span>E-Mail</span> info@gpcert.org</li>
                    <li><span>Address</span><span class="overview_txt"> (08504) Rm. 501-1, Daeryung techno town, 638, Seobusaet-gil, Geumcheon-gu, Seoul</span></li>
                </ul>
            </div>
        </div>
	</section>
    

</div> <!--------------------------// class="content_wrap" //------------------------------->

</body>

<?php
include_once(G5_THEME_PATH.'/tail.php');
?>