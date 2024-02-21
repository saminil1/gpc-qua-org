<?php
include_once('./_common.php');
$g5['title'] = 'Code of Conduct';
include_once(G5_THEME_PATH.'/head.php');
?>


<link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR:100,300,400,500,700,900&display=swap&subset=korean" rel="stylesheet">

<style>
    
/*회사안내- 행동강령 페이지 시작-YR 210729*/
    .content_wrap{
        font-size:1rem;
        line-height:1.8rem;
        font-weight:400;
        color:#333;
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
        line-height: 3.4rem;
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
        color:#333;
        font-weight:400;
        line-height:1.8rem;
        text-align:justify;
    }
    .img_div img{/*이미지*/
        margin:60px 20% 30px; 
        width:60%;
    }
    /*행동강령 9가지*/
    
    .vision_type1 ul{
        margin-top:40px;
        display:flex;
        flex-wrap:wrap;
    }
    .vision_type1 ul li{
        flex:auto;
        flex-basis: 100%;
        height:auto;
        background:#f9f9f9;
        border:1px solid #f9f9f9;
        border-radius:5px;
        margin-bottom:12px;
        padding:20px 3%;
        text-align:justify;
        color:#333;
        font-weight:400;
        font-size:1rem;
        box-sizing: border-box;
        letter-spacing:-0.02em;
    }
    .act_tt span{ /*9가지 블럭 숫자*/
        display:inline-block;
        width:32px;
        height:32px;
        border-radius:50%;
        font-size:1.05rem;
        font-weight:400;
        background:#fff;
        color:#f34747;
        text-align:center;
        line-height:32px;
        margin-right:5px;
    }
     .act_tt{ /*9가지 블럭 숫자 영역*/
        float:left;
        width:5%;
    }
    .act_box>li>.act_txt{ /*9가지 행동강령 텍스트*/
        display:inline-block;
        width:95%;
        float:left;
    }
    
   

/*회사안내- 행동강령 페이지 종료*/
    
    
    
/* -----------------------------------------------------반응형 시작 -210803 yr*/   
    
    /* 놋북,태블릿 사이즈, 최대 1280px 화소까지 적용 */
    @media (max-width:1280px) {
        .container_title{width:100%;}
        
        .act_tt{ /*9가지 블럭 숫자 영역*/
            float:left;
            width:6%;
        }
        .act_box>li>.act_txt{ /*9가지 행동강령 텍스트*/
            display:inline-block;
            width:94%;
            float:left;
        }
    }

    
    /* 최대 1024px 화소까지 적용 */
    @media (max-width:1024px) {
        /*-----1024px에서 텍스트 크기 변경되는 class -----*/
        .container_title{width:100%; font-size: 1.2rem;}
        .top_tt{
            padding:40px 0;
            font-size: 1.6rem;
        }
        .top_tt:after { /*밑줄선*/
            margin: 40px auto 0;
        }
        .act_tt{ /*9가지 블럭 숫자 영역*/
            float:left;
            width:8%;
        }
        .vision_type1 ul{
            margin-top:0px;
        }
        .act_box>li>.act_txt{ /*9가지 행동강령 텍스트*/
            display:inline-block;
            width:92%;
            float:left;
        }
        .img_div img{/*이미지*/
            margin:50px 20%; 
            width:60%;
        }
    }
    

    /*  최대 768px 화소까지 적용 */
    @media only screen and (max-device-width : 768px) and (-webkit-min-device-pixel-ratio: 1) {
        .container_title{display:none !important;} /*탭메뉴와 중복되어서 안보이게함*/
        
        .act_tt{ /*9가지 블럭 숫자 영역*/
            float:left;
            width:7%;
        }
        .act_box>li>.act_txt{ /*9가지 행동강령 텍스트*/
            display:inline-block;
            width:93%;
            float:left;
        }
    }


    /* 모바일(가장 작은 사이즈: SAMSUNG GALAXY S6) 가로 버전 사이즈, 최소 360px ~ 최대 640px(가로로 볼때) 화소까지 적용 */    
    @media all and (max-device-width : 640px) { 
        .top_tt{
            padding:20px 0 40px;
            font-size:1.6rem;
        }
        .img_div img{/*이미지*/
            margin:50px 0%; 
            width:100%;
        }
        .vision_type1 ul li{
            padding:20px 5%;
            margin-bottom:10px;
            background:#eff3f7;
        }
        .act_tt{ /*9가지 블럭 숫자 영역*/
            float:static;
            width:10%;
        }
        .act_tt span{ /*9가지 블럭 숫자*/
            font-weight:500;
            color:#5e98d9;
        }
        .act_box>li>.act_txt{ /*9가지 행동강령 텍스트*/
            display:block;
            width:100%;
            float:static;
            margin-top:10px;
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
        .top_txt{
            font-size:0.95rem;
            line-height:1.6rem;
        }
        .img_div img{/*이미지*/
            margin:30px 0%; 
            width:100%;
        }
        .vision_type1 ul li{
            padding:15px 7%;
            margin-bottom:10px;
            font-size:0.95rem;
            line-height:1.6rem;
        }
         .act_tt span{ /*9가지 블럭 숫자*/
            display:inline-block;
            width:30px;
            height:30px;
            border-radius:50%;
            font-size:1rem;
            font-weight:400;
            background:#fff;
            text-align:center;
            line-height:30px;       
        }
        
    }  
/*---------------------------------------------------------------반응형 끝*/



</style>

<div class="content_wrap">
	<section class="vision_type1 animatedParent">
        <div class="top_tt animated fadeInUpShort">GPC Auditor - Code of Conduct</div>
        <h2 class="animated fadeInUpShort top_txt">
            GPC’s Code of Conduct refers to the ethical requirements that GPC-certified auditors must comply with, and all certified auditors must comply with the following code of conduct.
        </h2>
        
        <!-------행동강령 이미지------->
		<div class="img_div animated fadeInUpShort"><img src="./images/code_of_conduct_img.jpg" alt="행동강령 이미지"></div>

        <!--------------------------행동강령 컨텐츠 ----------------------------->
        
		<ul class="clear act_box animated fadeInUpShort">
            <li>
                <span class="act_tt"><span>01</span></span>
                <span class="act_txt">GPC auditors work objectively and professionally.</span>
            </li>
            <li class="second_box">
                <span class="act_tt"><span>02</span></span>
                <span class="act_txt">GPC auditors develop their own professional abilities and maintain the best condition for accurate audit.</span>
            </li>
            <li class="right_box">
                <span class="act_tt"><span>03</span></span>
                <span class="act_txt">GPC auditors do not engage in anything that could cause conflicts of interest.</span>
            </li >
            <li class="second_box">
                <span class="act_tt"><span>04</span></span>
                <span class="act_txt">GPC auditors do not act to damage the reputation, interests, and credibility of the certification body.</span>
            </li>
            <li>
                <span class="act_tt"><span>05</span></span>
                <span class="act_txt">GPC auditors do not disclose anything, including information learned during the audit, to the outside unless authorized in writing by the audited organization and certification body.</span>
            </li>
            <li class="right_box second_box">
                <span class="act_tt"><span>06</span></span>
                <span class="act_txt">GPC auditors do not take any other benefits, such as money, gifts etc., from the organization or stakeholders under audit.</span>
            </li>
            <li>
                <span class="act_tt"><span>07</span></span>
                <span class="act_txt">GPC auditors do not communicate information that may impair the integrity of the audit or auditor certification process.</span>
            </li>
            <li class="second_box">
                <span class="act_tt"><span>08</span></span>
                <span class="act_txt">GPC auditors do not unconditionally criticize the audit work of other auditors without going through due process.</span>
            </li>
            <li class="right_box">
                <span class="act_tt"><span>09</span></span>
                <span class="act_txt">GPC auditors do not violate any part of this Code of Conduct and fully cooperate with any investigation requested to comply with GPC's Code of Conduct.</span>
            </li>
		</ul>
	</section>	

</div> <!--------------------------// class="content_wrap" //------------------------------->

<?php
include_once(G5_THEME_PATH.'/tail.php');
?>