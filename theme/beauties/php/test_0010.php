<?php
include_once('./_common.php');
$g5['title'] = '연관배열, 연산자, 조건문 05';//<!------서브페이지 최상위 타이블, css/design.css 파일 Line 425 ~ line 430까지 참조------->
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

    <div class="content_wrap">
        <section class="page_title">
            <hr style="border-top: 15px solid #ff9900;;display:inline-block;margin-bottom:0px;margin-top:50px;width:100%;color:">
            <h1>인증등록신청 양식 10 : 전역변수3 </h1>
            <h2>전역변수3</h2>
            <?php
            echo "<h1>전역변수</h1><br><br>";
            counter();
            counter();
            counter();
            counter();
            counter();
            counter();
            counter();
            counter();
            counter();
            counter();
            counter();

            function counter(){
                static $data = 0;//함수 안에 변수를 그대로 두고, 전역변수처럼 사용하기 위해 static을 사용함
                print $data ++;
                print "<br>\n \n";
            }
            ?>

            <?php
            echo "<br><br>";
            //공백제거하기
                $string = " a1234567890";
                $result = trim($string);
                print "공백제거하기(trim) : ".$result;
            ?>

            <?php
            echo "<br><br><h1>HTML & PHP-HTML태그 무효로 처리하기</h1>";

            echo "<br><br>HTML 태그 무효로 처리하기01<br><br>";
                $string1 ='<a href="https://www.gpcert.org">GPC인증원</a>';
                $result1 = htmlspecialchars($string1,ENT_QUOTES);
                print "$result1";

            echo "<br><br><br>HTML 태그 무효로 처리하기02<br><br>";
            // HTML 태그 무효로 처리하기
                $string2 = '<a href="http://www.naver.com">네이버</a>';
                 $result2 = htmlspecialchars($string2,ENT_NOQUOTES);
                print "$result2";
            ?>

            <?php
            echo "<br><br><h1>HTML 태그 제거하기 : strip_tags() 함수 사용함</h1>";
                $string ='<a href="https://www.gpcert.org">GPC인증원</a><hr><br>';//결과: 태그는 사라지는데 url 링크 안걸리는 이윤는?
                $result = strip_tags($string);
                //$result = htmlspecialchars($string);

                print $result;



            echo "<br><br><h1>개행 코드 앞에 HTML 줄바굼 태그 붙이기</h1><br><br><hr>";
            $string = "GPC인증원은
            개인인증, 기관인증 
            교육기관입니다.";
            $result = nl2br($string);
            print $result;


            echo "<br><br><h1>배열을 사용한 문자열 처리/문자열 작성</h1><br><br>";
            $data = array("GPC인증원","IGC인증원","GIC인증원","러스테스트인증원","디엔에이테크놀로지스");
            $result = implode(',',  $data);
            print $result;

            echo "<br><br><h1>$_SESSION-데이터를 가지고 다니기 위해 사용되는 변수</h1>";
            $_SESSION;
            $_FILES;

            echo "<br><br><h1>환경변수 : $_ENV;</h1>";
            $_ENV;

            echo "<br><br><h1>문자열 바이트 수 얻기 : 회원가입(아이디, 비번)제약사항</h1>";
            $str = "안녕하세요";
            $length = strlen($str);
            $mb_length = mb_strlen($str);

            echo $length;
            echo $mb_length;

            print "<br><br><h1>strlen & mb_strlen 비교</h1>";
            echo strlen('123 abc');//공백 포함 7byte을 출력함
            print "<br><br>";
            print mb_strlen("123", "utf-8");// 3을 출력함
            print "<br><br>";
            echo mb_strlen( '가나다', 'euc-kr' );//6을 출력함
            ?>

            <?php
            echo "<br><br><h1>문자열의 길이(byte) 수 구하는 함수 : strlen()</h1>";
            $str2 = "IGC인증원";

            ?>



            <!---------(주)아이지씨인증원 사업영역 종료 ------>
        </section>

    </div>

<?php
include_once(G5_THEME_PATH.'/tail.php');
?>