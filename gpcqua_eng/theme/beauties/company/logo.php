<?php
include_once('./_common.php');
$g5['title'] = 'CI&amp;Mark';
include_once(G5_THEME_PATH.'/head.php');
?>


<link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR:100,300,400,500,700,900&display=swap&subset=korean" rel="stylesheet">

<style>
    /*회사안내- 로고 페이지 시작-YR 210728*/
    .clear{ /*float 문제 해결*/
        content="";
        display:block;
        clear:both;
    }
    .content_wrap{
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
    
    .ci_mark_content{width:100%;height:auto;}
    
     /*ci 소제목*/
    .content_title{
        font-size:1.8rem;
        font-weight:500;
        color:#333;
        margin-bottom:40px;
        line-height:2rem;
    }
    .content_title:before{  /*제목 위 border*/
        content: "";
        display:block;
        width:35px;
        height:3px;
        background:#5d94c3;
        margin-bottom:13px;
    }

    
    /*1) CI*/
    .ci_box1, .ci_box2, .ci_box3{
        width:100%;
        margin:40px 0 80px;
        padding:20px 3%;
    }
    .ci_tt{ /*문단 제목*/
        font-size:1.3rem;
        font-weight:500;
        color:#333;
        padding:3px 0;
        height:28px;
        width:40%;
    }
    .ci_tt_underline{
        display:inline-block;
        width:100%;
        height:2px;
        margin:10px 0 20px;
        background:#ddd;
    }
    .basic_logo>img{ /*로고 이미지*/
        width:80%;
        margin:30px 10% 40px;
        border:1px solid #eee;
        padding:35px 3%;
    }
    .ci_txt{
        color:#333;
        font-weight:400;
        text-align:justify;
    }
    /*2) 형태규정*/
    
    .basic_logo_size>img, .basic_logo_size_2>img{ /*로고형태규정 이미지*/
        width:80%;
        margin:30px 10% 0;
    }
    .basic_logo_size_2>img{margin:20px 10% 40px;}

    .ci_txt_box{padding:0 2%;}
    .ci_txt_box>li{margin:5px 0;}
    .ci_txt_tt{
        font-size:1.1rem;
        font-weight:500;
    }
    .ci_txt_box>li>span{
        display:inline-block;
        color:#333;
        font-weight:400;
        margin:5px 0 20px;
        text-align:justify;
        margin-left:20px;
    }
    /*다운로드 버튼*/
    .gic_logo_download_btn{margin-top:30px;}
    .gic_logo_download_btn a{
        display:block;
        background:#fff;
        border:1px solid #666;
        font-weight:500;
        color:#555;
        font-size:1rem;
        height:44px;
        line-height:42px;
        width:300px;
        text-align:center;
        margin:20px auto 0px;
        transition:all 0.2s; /*마우스 오버시 효과 YR*/
    }
    .gic_logo_download_btn a:hover{
        background:#eee;
        border:1px solid #eee;
    }
    .gic_logo_download_btn .material-icons{
        vertical-align:middle;
        font-size:1.2em;
        color:#8f84c9;
    }
    /*3) 색상규정*/
    .basic_logo_color{margin:30px 0 0;display:flex;padding:0 5%;}
    .basic_logo_color li{
        width:45%;
        margin-right:10%;
        height:260px;
    }
    .basic_logo_color li:last-child{margin-right:0%;}
    
    .basic_logo_color .color_box{width:100%;height:80px;}
    .red_color{background:#a1301d;} /*GPC Red*/
    .pp_color{background:#7171ae;} /*GPC Purple*/
    .basic_logo_color li>p{
        margin:30px 0% 10px;
        font-size:1.2rem;
        color:#333;
        font-weight:500;
    }
    .basic_logo_color .color01>p{color:#c7270c;padding-bottom:10px;border-bottom:2px solid #c7270c;} /*GPC Red*/
    .basic_logo_color .color02>p{color:#7474ca;padding-bottom:10px;border-bottom:2px solid #7474ca;} /*GPC Purple*/
    
    .basic_logo_color li>span{
        display:block;
        margin:0 2%;
        font-size:1rem;
        color:#666;
        line-height:1.8rem;
        font-weight:300;
    }
    .basic_logo_color li .color_tt{
        display:inline-block;
        font-weight:400;
        width:70px;
    }
    
    /*주의사항 */
    .vision_type1 {
        width:100%;  
        margin:0 auto; 
    }
    .mark_info{
        padding:35px 3% 10px;
        border:1px solid #e8e8e8;
        line-height:1.8em;
    }
    .mark_info_txt{
        margin:0 2%;
        font-weight:400;
    }
    .mark_info_content{margin:20px 20px;}
    .mark_info_content>p{padding:3px 0;font-size:0.98rem;}

/*회사안내- 로고 페이지 종료*/
    
    
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
            padding:40px 0 60px;
            font-size: 1.6rem;
        }
        .content_title{ /*회사개요 제목*/
            font-size:1.5rem;
        }
        .basic_logo_color li>p{
            font-size:1.1rem;
        }
        .ci_tt{ /*문단 제목*/
            width:60%;
            font-size:1.2rem;
        }
        /*-----1024px에서 텍스트 크기 변경되는 class -----*/
        
        /*1) CI*/
        .ci_box1, .ci_box2, .ci_box3{
            width:100%;
            margin:40px 0 60px;
            padding:20px 0%;
        }
        
        /*3) 색상규정*/
        .basic_logo_color{margin:30px 0;display:flex;padding:0 0%;}
        .basic_logo_color li{
            width:48%;
            margin-right:4%;
            height:260px;
        }
        .basic_logo_color li:last-child{margin-right:0%;}
        
        .mark_info_content{margin:20px 0px;}
    }
    

    /*  최대 768px 화소까지 적용 */
    @media only screen and (max-device-width : 768px) and (-webkit-min-device-pixel-ratio: 1) {
        .container_title{display:none !important;} /*탭메뉴와 중복되어서 안보이게함*/
        .basic_logo>img{ /*로고 이미지*/
            width:80%;
            margin:20px 10% 40px;
            border:1px solid #eee;
            padding:35px 3%;
        }
        .basic_logo_size>img, .basic_logo_size_2>img{ /*로고형태규정 이미지*/
            width:80%;
            margin:20px 10% 0;
        }
        .ci_txt_box{margin-top:40px;}
        .basic_logo_color{margin:20px 0;display:flex;padding:0 0%;}
    }


    /* 모바일(가장 작은 사이즈: SAMSUNG GALAXY S6) 가로 버전 사이즈, 최소 360px ~ 최대 640px(가로로 볼때) 화소까지 적용 */    
    @media all and (max-device-width : 640px) { 
        .content_wrap{
            overflow:hidden;
        }
        .top_tt {
            padding: 20px 0 60px;
        }
        .ci_tt{width:100%;}
        .basic_logo>img{ /*로고 이미지*/
            width:100%;
            margin:0px 0% 15px;
            border:none;
            padding:35px 3%;
        }
        .ci_txt{ margin-bottom:0px;}
        .basic_logo_size>img, .basic_logo_size_2>img{ /*로고형태규정 이미지*/
            width:100%;
            margin:20px 0% 0;
        }
        .ci_txt_box>li>span{ /*형태규정 텍스트*/
            display:inline-block;
            color:#333;
            font-weight:400;
            line-height:1.7em;
            margin:5px 0 20px;
            text-align:justify;
            margin-left:0px;
        }
         /*다운로드 버튼*/
        .gic_logo_download_btn{margin-top:40px;}
        .gic_logo_download_btn a{width:70%;margin:20px auto 0px;}
        .gic_logo_download_btn .hide{display:none;}
        
        /*3) 색상규정*/
        .basic_logo_color{margin:20px 0 0;display:block;padding:0 0%;}
         .basic_logo_color li{
            width:100%;
            height:auto;
            padding-bottom:12px;
        }
        .basic_logo_color li>span{color:#444;}
        .basic_logo_color .color01{margin-bottom:40px;border-bottom:1px solid #c7270c;}
        .basic_logo_color .color02{border-bottom:1px solid #7474ca;}
        
         .basic_logo_color .color01>p{border-bottom:1px solid #c7270c;} /*GPC Red*/
         .basic_logo_color .color02>p{border-bottom:1px solid #7474ca;} /*GPC Purple*/
        
        .basic_logo_color .color_box{width:100%;height:120px;} /*컬러박스*/
        
        .basic_logo_color li>p{
            margin:15px 0% 10px;
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
            margin-bottom:20px;
            letter-spacing:-0.06rem;
        }
        .ci_tt{ /*문단 제목*/
            width:60%;
            font-size:1.2rem;
        }
        .ci_txt_tt{
            font-size:0.95rem;
        }
        .gic_logo_download_btn a{
            width:260px;
            font-size:0.9rem;
        }
        .basic_logo_color .color_box{width:100%;height:110px;} /*컬러박스*/
        .basic_logo_color li>p{
            font-size:1rem;
        }
        .basic_logo_color li>span{
            padding: 0 2.5%;
            font-size:0.95rem;
            line-height:1.6rem;
        }
        .mark_info_content>p{padding:3px 0;font-size:0.95rem;}
         /*----- 360px ~ 414px에서 텍스트 크기 변경되는 class -----*/
        
         /*1) CI*/
        .ci_box1, .ci_box2, .ci_box3{
            width:100%;
            margin:0px 0 40px;
            border:0;
            padding:20px 0%;
        }
        .basic_logo_color li>p{
            padding: 0 3%;
        }
        
    }  
/*---------------------------------------------------------------반응형 끝*/


</style>

<div class="content_wrap">
	<section class="ci_mark_content animatedParent">
        <div class="top_tt animated fadeInUpShort">GPC CI&amp;Mark</div>
        <h2 class="content_title animated fadeInUpShort">GPC Logo</h2>
        
        <!-------------- ci_box1 --------------->
        <div class="ci_box1 animated fadeInUpShort">
            <h2 class="ci_tt">Corporate Identity(CI)</h2> <!--문단 타이틀 -->
            <span class="ci_tt_underline"></span>
            
            <div class="basic_logo">
               <img src="./images/GPC_ci.png" alt="(주)지피씨인증원 로고"> <!--로고 이미지 -->
            </div>
            <div class="ci_txt">
              The wordmark's design emphasizes honesty and clarity. It contains the will to breathe with the world and contribute to human society by communicating the inside and the outside through the divisions in which the G, P, and C characters are placed in an orderly manner between the lines, which are the basic shapes.<br>The English logo design expresses the customer-oriented will that integrates technicalism and humanism, and the image of a global company in a modern sense.
            </div>
        </div>

        <!-------------- ci_box2 --------------->
        <div class="ci_box2 clear animated fadeInUpShort">
            
            <h2 class="ci_tt">Form regulations</h2> <!--문단 타이틀 -->
            <span class="ci_tt_underline"></span>
            
            <div class="basic_logo_size">
               <img src="./images/GPC_ci_design.png" alt="(주)지피씨인증원 로고 형태규정"> <!--basic logo image -->
            </div>
            <div class="basic_logo_size_2">
               <img src="./images/GPC_ci_size.png" alt="(주)지피씨인증원 로고 형태규정"> <!--grid logo image -->
            </div>
            
            <ul class="ci_txt_box">
               <li>
                    <p class="ci_txt_tt">1) Signature</p>
                   <span>
                    The signature is a combination of basic symbols and logo types to form the identity of GPC, and the manuscript must be enlarged and reduced in direct proportion to prevent deformation during reproduction.
                   </span>
               </li>
               <li>
                    <p class="ci_txt_tt">2) Minimum space regulations</p>
                   <span>
                    Clear Space is a regulation that secures the minimum space so that the logo is not invaded by other elements. When applying the logo to various media, keep the minimum space and be careful not to be invaded by other elements or complex patterns.
                   </span>
                <li>   
                    <p class="ci_txt_tt">3) Prohibition of use</p>
                    <span>
                   The logo of GPC is not a certification mark and cannot be used by customers. Also, to maintain visual consistency, it must not be arbitrarily changed and must use the prescribed shape and color.
                    </span>
                </li>
            <!--                
                <li>
                    지피씨 로고 다운로드 버튼
                    <div class="gic_logo_download_btn">
                        <a class="btn" href="/data/file/gpclogo/GPC_Logo.zip" download> <span class="material-icons">file_download</span> GPC Logo <span class="hide">AI(Illust)</span> Download</a>
                    </div>
                </li>
            -->
            </ul>
        </div>
        
        <!-------------- ci_box3 --------------->
        <div class="ci_box3 animated fadeInUpShort"> 	
            <h2 class="ci_tt">Color regulations</h2> <!--문단 타이틀 -->
            <span class="ci_tt_underline"></span>
            
            <ul class="basic_logo_color clear">
                <li class="color01">
                    <div class="red_color color_box"></div>
                    <p>GPC Red</p>
                    <span><span class="color_tt">Pantone</span> 484c</span>
                    <span><span class="color_tt">CMYK</span> 0 / 95 / 100 /29 </span>
                    <span><span class="color_tt">RGB</span> 161 / 48 / 29 </span>
                </li>
                <li class="color02">
                    <div class="pp_color color_box"></div>
                    <p>GPC Purple</p>
                    <span><span class="color_tt">Pantone</span> 2725c</span>
                    <span><span class="color_tt">CMYK</span> 70 / 70 / 0 / 0 </span>
                    <span><span class="color_tt">RGB</span> 113 / 113 / 174 </span>
                </li>
            </ul>
        </div>
	</section>	

    <!--------------품질인증 마크--------------->
	<section class="vision_type1 animatedParent">
        <h2 class="content_title animated fadeInUpShort">Certification Mark Precautions for use</h2>
        <div class="mark_info animated fadeInUpShort">
           <div  class="mark_info_txt">
               Customers certified from GPC must correctly use the Certification Mark and Accreditation Mark in accordance with the following regulations and must comply with the relevant regulations of the certification schemes when using certificates, logos, and marks.
                <div class="mark_info_content"> 
                   <p>1) Certification Marks and Accreditation Marks can only be used when the certificate is valid.</p>
                   <p>2) Certification Marks and Accreditation Marks can only be used within the scope that has been certified.</p>
                   <p>3) The use of Certification Marks and Accreditation Marks expressed in a way that gives the impression that personnel who has not been certified by GPC is certified is absolutely prohibited.</p>
                   <p>4) Certification marks and Accreditation marks are not available other than those provided by GPC.</p>
                   <p>5) Do not use certificates, logos, and marks in a misleading manner.</p>
                   <p>6) If the certification is suspended or withdrawn, no advertisement with a mark referring to the certification shall be made.</p>
                   <p>7) If the certification terms are reduced, all advertisements must be modified.</p>
                   <p>8) Do not use the certification in a way that could damage the reputation of the GPC, and make no statements related to the certification that the certification body may consider to be misleading or unauthorized.</p>
                   <p>9) In case of suspension or withdrawal of certification, use of all rights related to certification including reference to certification body or certification must be stopped, and all certificates issued by certification body must be returned.</p>
                   <p>10) Accreditation Marks and Certification Marks should always be marked together.</p>
                </div>
           </div>
        </div>  
        
        
    </section>
</div> <!--------------------------// class="content_wrap" //------------------------------->


<?php
include_once(G5_THEME_PATH.'/tail.php');
?>