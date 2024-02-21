<?php
include_once('./_common.php');
$g5['title'] = '사이트맵';
include_once(G5_THEME_PATH.'/head.php');
?>

<link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR:100,300,400,500,700,900&display=swap&subset=korean" rel="stylesheet">

<style>
    /*자료실-사이트맵 페이지 시작-YR 210727*/
    .container_title{display:none;}
    .swipe{display:none;}
    .sitemap1>span{ /*메뉴클릭시 이동한다는 안내메세지*/
        font-size:0.9rem;
        font-weight:400;
        height:40px;
        line-height:40px;
    }
    .sitemap1 .material-icons{
        vertical-align:middle;
        font-size:1.2em;
        padding-right:4px;
    }
    /*테이블 시작*/
    table{
        width:100%;
        min-width:250px;
        overflow-x: auto;
        margin-top:5px;
        font-size:0.8rem;
        line-height:1.4rem;
    }
    th,td{
        border: 1px solid #555;
        padding:5px;
        margin-top:-10px;
    }
    table tr{
        height:40px;
        color:#333;
        font-weight:400;
    }
    table a{transition:all 0.2s;} /* 210721 전산팀 yr*/
    table td:hover a{color:#fff}
    table td{transition:all 0.2s;} /* 210721 전산팀 yr*/
    table td:hover{background:#ed7b70;}
    table td.empty_block:hover{background:#fff;cursor:default;}
    
    .table_tt, .table_tt_2{ /*상단 주메뉴 제목*/
        text-align:center;
        font-weight:500;
        color:#222;
        font-size:1rem;
        background:#efaea9;
        height:45px; 
    }
    .table_tt_2{height:40px;}
    .menu_2depth{
        font-weight:400;
        color:#222;
        font-size:0.9rem;
        background:#f5f5f5;
    }
    .last_row{}

/*자료실-사이트맵 페이지 종료*/

 
    
    /* -----------------------------------------------------반응형 시작 -210803 yr*/  
    
    /* 놋북,태블릿 사이즈, 최대 1280px 화소까지 적용 */
    @media (max-width:1280px) {
        .table_tt, .table_tt_2{ /*상단 주메뉴 제목*/
            font-size:0.95rem;
        }
        .menu_2depth{
            font-size:0.85rem;
        }
    }
    
    /* 최대 1024px 화소까지 적용 */
    @media (max-width:1024px) {
        .sitemap1{overflow-x:auto;}
        th,td{padding:5px 0.6%;min-width: 110px;}
        
    }
    

    /*  최대 768px 화소까지 적용 */
    @media only screen and (max-device-width : 768px) and (-webkit-min-device-pixel-ratio: 1) {
        .sitemap1>span{ /*메뉴클릭시 이동한다는 안내메세지*/
            font-size:0.75rem;
        }
        .sub_top_tt{display:none;} /*탭메뉴와 중복되어서 안보이게함*/
        
        table{font-size:0.75rem;}
        .table_tt, .table_tt_2{ /*상단 주메뉴 제목*/
            font-size:0.9rem;
        }
        th,td{padding:5px 0.6%; min-width:100px }
        
    }


    /* 모바일(가장 작은 사이즈: SAMSUNG GALAXY S6) 가로 버전 사이즈, 최소 360px ~ 최대 640px(가로로 볼때) 화소까지 적용 */    
    @media all and (max-device-width : 640px) { 
        .swipe{
            display:block;
            color:#ea7f77;
            text-align:right;
            height:15px;
            font-size:0.8rem;
        }
        .sitemap1>span{ /*메뉴클릭시 이동한다는 안내메세지*/
            font-size:0.7rem;
        }
        table{font-size:0.65rem;}
        th,td{padding:4px 0.4%;}
        .table_tt, .table_tt_2{ /*상단 주메뉴 제목*/
            font-size:0.75rem;
            color:#333;
            background:#c8c8f3;
        }
        .menu_2depth{
            font-size:0.7rem;
            background:#f7f7f7;
        }
        a:visited{color:inherit;}
    }


    /* 모바일(가장 큰 사이즈: iPhone 6/7/8 Plus) 세로 버전 사이즈, 최소 360px ~ 최대 414px 화소까지 적용 */
    @media all and (min-width:360px) and (max-device-width : 414px) {  
        .sitemap1>span{ /*메뉴클릭시 이동한다는 안내메세지*/
            font-size:0.65rem;
        }
        th,td{padding:4px 0.8%; border:1px solid #ddd;}
        table{font-size:0.6rem;}
        .table_tt, .table_tt_2{ /*상단 주메뉴 제목*/
            font-size:0.7rem;
        }
        .menu_2depth{
            font-size:0.65rem;
            background:#f7f7f7;
        }
    }  
    
/*---------------------------------------------------------------반응형 끝*/
</style>

<div class="content_wrap">

    <section class="vision_type1">
        <img src="./images/en_gpc_sitemap_banner.png" alt="사이트맵 배너" title="gpc_sitemap_banner"><br><br><br>

        <div class="sitemap1">
             <div class="swipe"><span class="material-icons">swipe</span>Swipe&nbsp;</div>
             <span style="display:block;text-align:right;color:#8f84c9;"> <span class="material-icons">open_in_new</span>If you click the menu, you can move to detail information.</span>
             
                <table cellspacing="0" cellpadding="0">
                    <col width="168" span="6">
                    <tr>
                        <td class="table_tt"><a href="../company/introduce.php">About Us</a></td>
                        <td class="table_tt" colspan="2"><a href="../service/auditor_scheme.php">Services</a></td>
                        <td class="table_tt"><a href="/gpc_eng/bbs/board.php?bo_table=notice_en">References</a></td>
                        <td class="table_tt"><a href="/gpc_eng/bbs/board.php?bo_table=notification_en">Customer Service</a></td>
                        <td class="table_tt last_row"><a href="/gpc_eng/bbs/board.php?bo_table=gallery_en">Recruitment</a></td>
                    </tr>
                    <tr>
                        <td class="menu_2depth"><a href="../company/introduce.php">Introduction</a></td>
                        <td class="menu_2depth" rowspan="5" ><a href="../service/auditor_scheme.php">Auditor Certification</a></td>
                        <td><a href="../service/auditor_scheme.php">Auditor Certification Scheme</a></td>
                        <td class="menu_2depth"><a href="/gpc_eng/bbs/board.php?bo_table=notice_en">Resources</a></td>
                        <td class="menu_2depth"><a href="/gpc_eng/bbs/board.php?bo_table=notification_en">Notice</a></td>
                        <td class="menu_2depth last_row"><a href="/gpc_eng/bbs/board.php?bo_table=gallery_en">Recruitment</a></td>
                    </tr>
                    <tr>
                        <td class="menu_2depth"><a href="../company/code_of_conduct.php">Code of Conduct</a></td>
                        <td><a href="../service/auditor_grade_REGS.php">Grade/Registration requirements</a></td>
                        <td class="menu_2depth"><a href="/gpc_eng/bbs/board.php?bo_table=introduce_en">Newsletter</a></td>
                        <td class="menu_2depth"><a href="/gpc_eng/bbs/board.php?bo_table=qa_en">Certification Inquiry</a></td>
                        <td class="empty_block last_row" rowspan="5"></td> <!--인재채용 공백-->
                    </tr>
                    <tr>
                        <td class="menu_2depth"><a href="../company/impartiality.php">Impartiality</a></td>
                        <td><a href="../service/auditor_process.php">Auditor certification process</a></td>
                        <td class="menu_2depth"><a href="/gpc_eng/bbs/board.php?bo_table=gpcglobal">Partners</a></td>
                        <td class="empty_block" rowspan="13"></td> <!-- Contact us 공백-->
                    </tr>
                     <tr>
                        <td class="menu_2depth"><a href="../company/logo.php">CI &amp; Mark</a></td>
                        <td><a href="../service/auditor_fee.php">Auditor Certification Fee</a></td>
                        <td class="menu_2depth"><a href="/gpc_eng/theme/gpcert/info/sitemap.php">Sitemap</a></td>
                    </tr>
                    <tr>
                        <td class="menu_2depth"><a href="../company/appeal.php">Appeal</a></td>
                        <td><a href="../service/auditor_FAQ.php">FAQ</a></td>
                        <td class="empty_block" rowspan="11"></td> <!--자료실 공백-->
                    </tr>
                    <tr>
                        <td class="menu_2depth"><a href="../company/location.php">Location</a></td>
                        <td class="menu_2depth" rowspan="4"><a href="../service/training_introduction.php">Training Provider Designation</a></td>
                        <td><a href="../service/training_introduction.php">Introduction of Training Provider Designation</a></td>
                    </tr>
                    <tr>
                        <td class="empty_block" rowspan="9"></td> <!--회사안내 공백-->
                        <td><a href="../service/training_process.php">Designation Process</a></td>
                        <td class="table_tt last_row"><a href="#" onclick="return false">Others</a></td>
                    </tr>
                    <tr>
                        <td><a href="../service/training_invigilator.php">Invigilator</a></td>
                        <td class="last_row"><a href="/gpc_eng/bbs/content.php?co_id=privacy_en">Privacy Policy</a></td>
                    </tr>
                    <tr>
                        <td><a href="../service/training_FAQ.php">FAQ</a></td>
                        <td class="last_row"><a href="/gpc_eng/bbs/content.php?co_id=provision_en">Terms and Condition of Service</a></td>
                    </tr>
                    <tr>
                        <td class="menu_2depth" rowspan="3"><a href="../service/exam_introduction.php">Examination</a></td>
                         <td><a href="../service/exam_introduction.php">GPC Exam</a></td>
                         <td class="last_row"><a href="/gpc_eng/bbs/qalist.php">1:1 Counseling</a></td>
                    </tr>
                     <tr>
                        <td><a href="../service/exam_process.php">GPC Exam Process</a></td>
                        <td class="last_row"><a href="/gpc_eng/bbs/search.php?sfl=wr_subject%7C%7Cwr_content&sop=and&stx=">Searching</a></td>
                    </tr>
                    <tr>
                        <td><a href="../service/exam_FAQ.php">FAQ</a></td>
                        <td width="168"  class="last_row"><a href="/gpc_eng/bbs/register.php">New Account</a></td>
                    </tr>
                    <tr>
                        <td class="menu_2depth" rowspan="3"><a href="../service/edu_introduction.php">Training</a></td>
                        <td><a href="../service/edu_introduction.php">Introduction</a></td>
                        <td width="168"  class="last_row"><a href="/gpc_eng/bbs/login.php">Login</a></td> 
                    </tr>
                     <tr>
                        <td><a href="../service/edu_process.php">Training Process</a></td>
                        <td width="168"  class="empty_block last_row"></td> 
                    </tr>
                    <tr>
                        <td><a href="../service/edu_FAQ.php">FAQ</a></td>
                        <td class="table_tt_2 last_row"><a href="https://gicertorg1.cafe24.com/">Korean Site</a></td>
                    </tr>
                </table>
        </div>
        <br>
	</section>	
</div> <!--------------------------// class="content_wrap" //------------------------------->


<?php
include_once(G5_THEME_PATH.'/tail.php');
?>