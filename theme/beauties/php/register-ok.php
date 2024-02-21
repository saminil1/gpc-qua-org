<?php
include_once('./_common.php');
$g5['title'] = '인증신청/가입 페이지 구현';//<!------서브페이지 최상위 타이블, css/design.css 파일 Line 425 ~ line 430까지 참조------->
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
    <style>
        /*기본CSS 여기부터는 페이지에 넣지 않습니다.*/
        body,td,h1,h2,h3,h4,h5,div,p,li,ul,ol,dd,dt,section,input,textarea,select,button{margin:0;padding:0; font-size:1rem; color:#333; line-height:1.6em; font-family: 'Noto Sans KR', sans-serif; font-weight:400; letter-spacing:-0.02em;}
        body{padding-top:0px; padding-bottom:0px;}
        ul,ol,li{margin:0;padding:0;list-style:none;}
        /*기본CSS 여기까지는 페이지에 넣지 않습니다.*/

        /* 신규 테이블 삽입   */
        table{width:80%;min-width:240px;border: 1px solid #444444;overflow-x: auto;}
        th,td{border: 1px solid #444444;font-size:100%;padding:20px;}

        /*심사원의 종류*/
        .txtBox00, .txtBox01, .txtBox02, .txtBox03, .txtBox04 {
            border-width: 2px;
            padding: 12px;
            margin:20px;
            word-break: break-all;
            width:250px;
            text-align:center;
            float:left;
            border-radius:15px;
        }
        .txtBox00 { background-color:LightGray;}
        .txtBox01 { background-color:#e0ecf3;}
        .txtBox02 { background-color:#99ffff;}
        .txtBox03 { clear:both;background-color:#ffcc99;}
        .txtBox04 { background-color:#ffcccc;}

        table{width:100%;border: 1px solid #444444;}
        th,td{border: 1px solid #444444;margin-left:10px;font-size:0.9em;}

        table,td p {font-size:0.9em;margin-left:0px;padding-left:10px;}
        td {font-size:96%;padding-left:10px;}

    </style>

    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR:100,300,400,500,700,900&display=swap&subset=korean" rel="stylesheet">

    <style>
        .fc_pointer {color:#ff9900; }
        .content_wrap{width:100%; min-width:320px; max-width:1200px; margin:0 auto;}
        .page_title{width:100%; margin-bottom:70px;}
        .page_title h1{width:100%; margin:0 auto; text-align:center; font-size:2.5em; font-weight:600;}
        .page_title h1:after {content:""; clear:both; display:block; width:30px; margin:10px auto; border:1px solid #000;}
        .page_title h2{width:100%; margin:0 auto; text-align:center; font-size:1.2em; color:#666; margin-top:20px; }

        .business_type2{ width:100%; max-width:1200px; margin:0 auto;}
        .business_type2:after{content:""; display:block; clear:both;}
        .business_type2 .business_info { width:100%; background:#fff; margin-bottom:80px; }
        .business_type2 .business_info:after{content:""; display:block; clear:both;}
        .business_type2 .business_info ul{ padding:0; margin:0;}
        .business_type2 .business_info ul li{ padding:0; margin:0;}
        .business_type2 .business_info ul li.left_box { float:left; width:500px; height:500px; overflow:hidden; }/* 컨텐츠 좌측 이미지  */
        .business_type2 .business_info ul li.left_box img{ width:90%; height:100%; }
        .business_type2 .business_info ul li.right_box{position:relative; float:right; width:45%; height:auto;}/* 컨텐츠 우측 텍스트  */
        .business_type2 .business_info ul li.right_box .txt03{ position:absolute; left:0; bottom:0; width:100%; border-top:1px solid #ddd; font-size:0.9em; color:#555; line-height:1.5em; text-transform: uppercase; background:#f8f8f8; overflow:hidden;}
        .business_type2 .business_info ul li.right_box .txt03 span {display:block; padding:20px 25px; height:100px; }
        .business_type2 .txt_area { width:100%; padding-top:40px; border-top:2px solid #000; }
        .business_type2 .txt_area:after{content:""; display:block; clear:both;}
        .business_type2 .txt_area .txt01 { float:left; width:100%; word-break: keep-all; }
        .business_type2 .txt_area .txt01 p { padding:0; margin:0; margin-bottom:15px; padding:0;}
        .business_type2 .txt_area .txt01 span.tit { display:block; font-size:2.2em; color:#000; font-weight:700; line-height:1.2em;  }
        .business_type2 .txt_area .txt01 span.txt { display:block; font-size:1.15em; color:#333; font-weight:400; line-height:1.4em; }
        .business_type2 .txt_area .txt02 { float:left; width:100%; margin-top:20px;}
        .business_type2 .txt_area .txt02 ul {margin:0; padding:0; }
        .business_type2 .txt_area .txt02 ul li { position:relative; color:#555; font-weight:400; line-height:1.5em; list-style:none; padding-left:3%; margin-bottom:5px;}
        .business_type2 .txt_area .txt02 ul li:before {position:absolute; top:8px; left:0; content:""; display:inline-block; width:4px; height:4px; background:#555; margin-right:10px; vertical-align:middle;}
        .business_type2 .con_arrow{ width:100%; max-width:1200px;  padding-bottom:20px;  margin:0 auto;}
        .business_type2 .con_arrow p{position:relative; font-size:2em; color:#000; padding-left:30px; }
        .business_type2 .con_arrow span{  position:absolute; right:0; display:inline-block; font-size: 1em;  padding-left: 10px;  color: #555;}
        .business_type2 .con_arrow > p:before{position:absolute; top:4px; left:10px; display:inline-block; content:""; width:3px; height:23px; background-color:#1F88E5; -ms-transform:rotate(45deg); -webkit-transform:rotate(45deg); -moz-transform:rotate(45deg); -o-transform:rotate(45deg); transform:rotate(45deg);}
        .business_type2 .con_box{ width:100%; padding:20px 0; border-top:1px solid #000; border-bottom:1px solid #000;}
        .business_type2 .con_box:after{content:""; display:block; clear:both;}
        .business_type2 .con_box ul { padding:0; margin:0; }
        .business_type2 .con_box ul li {float:left; width:50%; list-style:none; margin:10px 0; }
        .business_type2 .con_box ul li p{display:table; width:100%; }
        .business_type2 .con_box ul li p > em, .business_type2 .con_box p > span{display:table-cell; vertical-align:top; }
        .business_type2 .con_box ul li p > em{ width:30px; }
        .business_type2 .con_box ul li p > em > strong{display:inline-block; width:30px; height:30px;  line-height:30px; color:#fff; background-color:#000; text-align:center; font-size:1em;  border-radius:100%; -moz-border-radius:100%; -webkit-border-radius:100%; -o-border-radius:100%; font-weight:500;}
        .business_type2 .con_box ul li p > span{font-size:1em; line-height:30px; color:#555; letter-spacing:-0.75px;  padding:0 15px;}

        /* (주)아이지씨인증원 사업영역 시작  */
        .partner_type2 .con_arrow{ width:100%; max-width:1200px;  padding-bottom:20px;  margin:0 auto;}
        .partner_type2 .con_arrow p{position:relative; font-size:2em; color:#000; padding-left:30px; }
        .partner_type2 .con_arrow span{  position:absolute; right:0; display:inline-block; font-size: 1em;  padding-left: 10px;  color: #555;}
        .partner_type2 .con_arrow > p:before{position:absolute; top:4px; left:10px; display:inline-block; content:""; width:3px; height:23px; background-color:#1F88E5; -ms-transform:rotate(45deg); -webkit-transform:rotate(45deg); -moz-transform:rotate(45deg); -o-transform:rotate(45deg); transform:rotate(45deg);}
        .partner_type2 .con_box{ width:100%; padding:20px 0; border-top:1px solid #000; border-bottom:1px solid #000;}
        .partner_type2 .con_box:after{content:""; display:block; clear:both;}
        .partner_type2 .con_box ul { padding:0; margin:0; }
        .partner_type2 .con_box ul li {float:left; width:50%; list-style:none; margin:10px 0; }
        .partner_type2 .con_box ul li p{display:table; width:100%; }
        .partner_type2 .con_box ul li p > em, .business_type2 .con_box p > span{display:table-cell; vertical-align:top; }
        .partner_type2 .con_box ul li p > em{ width:30px; }
        .partner_type2 .con_box ul li p > em > strong{display:inline-block; width:30px; height:30px;  line-height:30px; color:#fff; background-color:#000; text-align:center; font-size:1em;  border-radius:100%; -moz-border-radius:100%; -webkit-border-radius:100%; -o-border-radius:100%; font-weight:500;}
        .partner_type2 .con_box ul li p > span{font-size:1em; line-height:30px; color:#555; letter-spacing:-0.75px;  padding:0 15px;}
        /* (주)아이지씨인증원 사업영역 종료  */

        @media screen and (max-width:992px){

            .content_wrap{width:100%;}
            .page_title{margin-bottom:50px;}
            .page_title h1{font-size:2em;}
            .page_title h2{font-size:1em;}
            .s_tit{font-size:1.2em;}
            .business_type2 .business_info{margin-bottom:0px;}
            .business_type2 .business_info ul li.left_box { width:100%; height:300px;  }
            .business_type2 .business_info ul li.right_box{ width:100%; }
            .business_type2 .business_info ul li.right_box .txt03 {position:relative !important; margin-top:40px;}
            .business_type2 .business_info ul li.right_box .txt03 span {height:auto;}
            .business_type2 .txt_area { width:90%; margin:0 auto; border-top:0;}
            .business_type2 .txt_area .txt01 span.tit {font-size:1.85em;}
            .business_type2 .con_arrow{width:95%; margin:0 auto;}
            .business_type2 .con_box{width:95%; margin:0 auto;}
        }

        @media screen and (max-width:480px){
            .business_type2 .con_arrow p{ font-size:1.5em; margin-top:30px;}
            .business_type2 .con_box ul li { width:100%; }
        }
    </style>
    <style><!-------->
        table{
            width:100%;
            border:1px solid #000000;/* 검정색 실선 */
        }
        table, td, tr{
            background:#0066EE;
            color:#FFFFFF;
        }
        .array3{
            #background: #74992e;
            color:#FFFFFF;
        }
    </style>
    <style>
        body{
            font-family:sans-serif;font-size:25px;
        }
    </style>
    <div class="content_wrap">
        <section class="page_title">
            <hr style="border-top: 15px solid #ff9900;;display:inline-block;margin-bottom:0px;margin-top:50px;width:100%;color:">
            <h1>인증시청 페이지 </h1>
            <h2>회원가입 페이지 구현</h2>

            <?php
            // 페이지를 로드하면 POST방식으로 넘어온 username, password, passowrd_confirm을 받는다.
            // username에 값이 있으면 회원가입 버튼을 클릭한 것이므로 이후의 php코드를 실행한다.

            // 회원가입 버튼을 클릭하여 페이지가 로드되었다면 회원 DB에서 같은 username을 가진 회원이 있는지 검사한다.
            // 같은 이름의 회원이 있다면 사용자 이름이 중복되었습니다.를 출력한다.

            // 사용자 이름이 중복되지 않았다면 입력한 두 비밀번호가 같은지 검사한다.
            // 같지 않다면 비밀번호가 일치하지 않습니다를 출력한다.

            //사용자 이름이 중복되지 않고, 두 비밀번호가 일치한다면 DB에 회원 정보를 저장하고
            // register-ok.php로 넘어간다.
            ?>

           <h1>회원가입이 완료되었습니다.</h1>
            <form action="register.php" method="POST">
                <!--    <input type="text" name="username" placeholder="Username">-->
                <!--    <input type="text" name="password" placeholder="Password">-->
                <button>회원가입페이지로 되돌아가기</button>
            </form>


            <!---------(주)아이지씨인증원 사업영역 종료 ------>
        </section>

    </div>

<?php
include_once(G5_THEME_PATH.'/tail.php');
?>