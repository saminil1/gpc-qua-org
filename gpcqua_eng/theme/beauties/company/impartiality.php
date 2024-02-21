<?php
include_once('./_common.php');
$g5['title'] = 'Impartiality';
include_once(G5_THEME_PATH.'/head.php');
?>


<link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR:100,300,400,500,700,900&display=swap&subset=korean" rel="stylesheet">

<style>
    /*회사안내- 공정성 페이지 시작-YR 210729*/
    .content_wrap{
        font-size:1rem;
        font-weight:400;
        color:#333;
        line-height:1.8rem;
        text-align:justify;
    }
    .clear{ /*float 문제 해결*/
        content="";
        display:block;
        clear:both;
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
    .top_tt:after { /*밑줄선*/
        content: "";
        clear: both;
        display: block;
        width: 40px;
        margin: 60px auto 0;
        border: 1px solid #999;
}
    .img_div img{/*이미지*/
        margin:10px 20% 20px; 
        width:60%;
    }
    
    /*공정성 9가지*/
    .mid_content{width:100%;}
    .mid_content p{margin-bottom:8px;}
    .mid_content01{margin:60px 0 50px;}
    .mid_content01>h2, .mid_content02>h2{
        width:100%;
        color:#3a8de2;
        font-weight:600;
        border-bottom:2px solid #ddd;
        padding-bottom:10px;
        line-height:1.8em;
        margin-bottom:20px;
        font-size:1.3rem;
        text-align:justify;
    }
    .mid_content01_list, .mid_content02_list{
        width:100%;
        text-align:justify;
        margin-bottom:60px;
    }
    .mid_content02_list{margin-bottom:0px;}
    .mid_content02_list>p:first-child{margin-bottom:20px;}
    

/*회사안내- 공정성 페이지 종료*/

  
    
/* -----------------------------------------------------반응형 시작 -210803 yr*/   
    
    /* 놋북,태블릿 사이즈, 최대 1280px 화소까지 적용 */
    @media (max-width:1280px) {
        .container_title{width:100%;}
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
            margin: 50px auto 0;
        }
         /*-----1024px에서 텍스트 크기 변경되는 class -----*/
    }
    

    /*  최대 768px 화소까지 적용 */
    @media only screen and (max-device-width : 768px) and (-webkit-min-device-pixel-ratio: 1) {
        .container_title{display:none !important;} /*탭메뉴와 중복되어서 안보이게함*/  
    }


    /* 모바일(가장 작은 사이즈: SAMSUNG GALAXY S6) 가로 버전 사이즈, 최소 360px ~ 최대 640px(가로로 볼때) 화소까지 적용 */    
    @media all and (max-device-width : 640px) { 
        .top_tt{
            padding:25px 0 30px;
            line-height:2.6rem; /*모바일에서 제목이 두줄로 바뀌어서 줄간격 조정*/
        }
        .img_div img{/*이미지*/
            margin:20px 0% 0px; 
            width:100%;
        }
        .mid_content01>h2, .mid_content02>h2{
            float:static;
            width:100%;
            font-weight:600;
            border-top:none;
            border-bottom:2px solid #ddd;
            padding:0px 0px 10px;
            margin-bottom:20px;
            font-size:1.3rem;
        }
        .mid_content01_list, .mid_content02_list{
            float:static;
            width:100%;
            font-size:1rem;
            border-top:none;
            padding:25px 5%;
            text-align:justify;
            background:#f9f9f9;
        } 
    }


    /* 모바일(가장 큰 사이즈: iPhone 6/7/8 Plus) 세로 버전 사이즈, 최소 360px ~ 최대 414px 화소까지 적용 */
    @media all and (min-width:360px) and (max-device-width : 414px) {  
        /*----- 360px ~ 414px에서 텍스트 크기 변경되는 class -----*/
        .top_tt{
            font-size:1.35rem;
            padding:0px 0 30px;
        }
        .top_tt:after { /*밑줄선*/
            margin: 30px auto 0;
        }
        .mid_content01>h2, .mid_content02>h2{
            font-size:1.1rem;
        }
        .mid_content01_list, .mid_content02_list{
            padding:20px 5%;
            font-size:0.95rem;
            line-height:1.6rem;
            margin-bottom:40px;
        } 
        .mid_content02_list{margin-bottom:0px;}
        /*----- 360px ~ 414px에서 텍스트 크기 변경되는 class -----*/
        
        .img_div img{/*이미지*/
            margin:10px 0%; 
            width:100%;
        }
        .mid_content01{margin:20px 0 0px;}

    }  
    
/*---------------------------------------------------------------반응형 끝*/
    
    
</style>

<div class="content_wrap">
    
    <!--------------------공정성 선언문-------------------->
	<section class="vision_type1 animatedParent">
        <div class="top_tt animated fadeInUpShort">Declaration for Impartiality</div>
        
        <!--공정성 선언문 이미지-->
		<div class="img_div animated fadeInUpShort">
		   <img src="./images/impartiality_img.png" alt="공정성 이미지">
		</div>
        
        <!--공정성 선언문 컨텐츠 시작-->
        <div class="mid_content animated fadeInUpShort">
            <div class="mid_content01 clear"> <!--mid_content01-->
                <h2>Commitment of Impartiality</h2>
                 <div class="mid_content01_list">
                    <p>Top management of GPC has commitment to impartiality in certification activities.</p>
                    <p>All members of GPC conduct the audit fairly and try not to have conflicts of interest.</p>
                    <p>All members of GPC have an obligation to notify the GPC of any work that may result in conflicts of interest. There must be no commercial, financial or other pressures that could affect the outcome of the certification process.</p>
                    <p>GPC periodically reviews operations and procedures to ensure impartiality.</p>
                    <p>GPC acts quickly if it is threatened to impartiality.</p>
                </div>

            </div>

            <div class="mid_content02 clear"> <!--mid_content02-->
                <h2>Declaration of Impartiality</h2>
                <div class="mid_content02_list">
                    <p>As a member of GPC, I declare that I will strictly comply with the following;</p>

                    <p><span>First,</span> I act fairly as an interested party while performing impartiality activities. </p>
                    <p><span>Second,</span> I follow all GPC procedures and policies. </p>
                    <p><span>Third,</span> I do not interfere with the applicant's access by abusing the procedures of the GPC.</p>
                    <p><span>Fourth,</span> I have responsibility to continuously find out and recognize the threats to the impartiality, and I will immediately report to my superior or Impartiality Committee.</p>
                    <p><span>Fifth,</span> I do not disclose any information about GPC operation to internal or external organizations.</p>
                    <p><span>Sixth,</span> I declare that I will abide by all the statements promised to protect the policies and impartiality of GPC.</p>
                    <p><span>Seventh,</span> if I violate the rules and policies of the GPC, I will accept the penalties determined by GPC and take full responsibility for the consequences.</p>
                </div>
            </div>
        </div>
        
         <!--공정성 선언문 컨텐츠 끝-->
	</section>
    
</div>  <!--------------------------// class="content_wrap" //------------------------------->
<?php
include_once(G5_THEME_PATH.'/tail.php');
?>