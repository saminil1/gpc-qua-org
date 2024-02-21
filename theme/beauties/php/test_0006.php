<?php
include_once('./_common.php');
$g5['title'] = '연관배열, 연산자, 조건문 01';//<!------서브페이지 최상위 타이블, css/design.css 파일 Line 425 ~ line 430까지 참조------->
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
            <h1>인증등록신청 양식</h1>
            <?php
            //연관 배열에 이름을 붙인다.===>$member
            //[""]을 이용해서 키를 지정한다.
            //''을 이용해 지정된 키에 값을 할당한다.
            $member["name"] = "GPC인증원1";
            $member["Tel"] = "02-6749-0723";
            $member["address1"] = "서울특별시 금천구 서부샛길 638 대륭테트코나타운7차 402-1호";
            $member["ISO-part"] = "ISO 90001";

            //연관배열 데이터 출력하기
            echo "<table>
                  <th>회사명</th><th>전화번호</th><th>주소</th><th>규격선택</th>
                        <tr>
                            <td>";echo $member["name"];echo"</td>
                            <td>";echo $member["Tel"];echo"</td>
                            <td>";echo $member["address1"];echo"</td>
                            <td>";echo $member["ISO-part"];echo"</td>
                        </tr>
                        
                        <tr>
                            <td>";echo $member["name"];echo "</td>
                            <td>";echo $member["Tel"];echo "</td>
                            <td>";echo $member["address1"];echo "</td>
                            <td>";echo $member["ISO-part"];echo "</td>
                        </tr>
                        
                        <tr>
                            <td>";echo $member["name"];echo "</td>
                            <td>";echo $member["Tel"];echo "</td>
                            <td>";echo $member["address1"];echo "</td>
                            <td>";echo $member["ISO-part"];echo "</td>
                        </tr>
                        
                        <tr>
                            <td>";echo $member["name"];echo "</td>
                            <td>";echo $member["Tel"];echo "</td>
                            <td>";echo $member["address1"];echo "</td>
                            <td>";echo $member["ISO-part"];echo "</td>
                        </tr>    
                  </table>";

                            //array 함수 출력하는 방법
            $member = array("name2"=>"GPC인증신청시스템", "Tel2"=>"010-2299-5655","address2"=>"서울시 금천구 서부샛길 638 402-1호", "ISO-part2"=>"ISO13485" );

            print "<br><br>";
            ?>



            <?php
            print "<br><br><h1>연관배열 데이터 출력</h1>";
            echo "<h2>데이터를 할당하는 방법과 출력하는 방법</h2>";
            ?>

            <?php
            //연관 배열의 데이터를 출력한다.
            echo "<table>
                    <th>프로젝트 이름</th> <th>휴대폰번호</th> <th>담장자주소</th> <th>시험 규격</th>
                    <tr>
                        <td>"; print $member["name2"]; echo "</td>
                        <td>"; print $member["Tel2"]; echo "</td>
                        <td>"; print $member["address2"]; echo "</td>
                        <td>"; print $member["ISO-part2"]; echo "</td>
                    </tr>
                    <tr>
                        <td>"; print $member["name2"]; echo "</td>
                        <td>"; print $member["Tel2"]; echo "</td>
                        <td>"; print $member["address2"]; echo "</td>
                        <td>"; print $member["ISO-part2"]; echo "</td>
                    </tr>
                    <tr>
                        <td>"; print $member["name2"]; echo "</td>
                        <td>"; print $member["Tel2"]; echo "</td>
                        <td>"; print $member["address2"]; echo "</td>
                        <td>"; print $member["ISO-part2"]; echo "</td>
                    </tr>
                    <tr>
                        <td>"; print $member["name2"]; echo "</td>
                        <td>"; print $member["Tel2"]; echo "</td>
                        <td>"; print $member["address2"]; echo "</td>
                        <td>"; print $member["ISO-part2"]; echo "</td>
                    </tr>

                  </table>";
            ?>

            <?php
            print "<br><br><h1>배열과 연관배열을 사용하는 다차원배열</h1>";
            echo "<h2>주로 데이터베이스를 다룰 때 사용함.</h2>";

            $member1[0] = array("name3"=>"IGC인증원1", "Tel3"=>"010-5731-5654", "address3"=>"서울시 강북구 오패산로52길 137", "class3"=>"ISO 27001", "etcs3"=>"남");
            $member1[1] = array("name3"=>"IGC인증원2", "Tel3"=>"010-5732-5654", "address3"=>"서울시 강북구 오패산로52길 138", "class3"=>"ISO 27001", "etcs3"=>"남");
            $member1[2] = array("name3"=>"IGC인증원3", "Tel3"=>"010-5733-5654", "address3"=>"서울시 강북구 오패산로52길 139", "class3"=>"ISO 27001", "etcs3"=>"여");
            $member1[3] = array("name3"=>"IGC인증원4", "Tel3"=>"010-5734-5654", "address3"=>"서울시 강북구 오패산로52길 140", "class3"=>"ISO 27001", "etcs3"=>"여");
            $member1[4] = array("name3"=>"IGC인증원7", "Tel3"=>"010-5735-5654", "address3"=>"서울시 강북구 오패산로52길 141", "class3"=>"ISO 27001", "etcs3"=>"여");
            $member1[5] = array("name3"=>"IGC인증원6", "Tel3"=>"010-5736-5654", "address3"=>"서울시 강북구 오패산로52길 142", "class3"=>"ISO 27001", "etcs3"=>"남");
            $member1[6] = array("name3"=>"IGC인증원7", "Tel3"=>"010-5737-5654", "address3"=>"서울시 강북구 오패산로52길 143", "class3"=>"ISO 27001", "etcs3"=>"남");
            $member1[7] = array("name3"=>"IGC인증원8", "Tel3"=>"010-5738-5654", "address3"=>"서울시 강북구 오패산로52길 144", "class3"=>"ISO 27001", "etcs3"=>"여");


            echo "<table style=''>
                        <th>회사이름</th><th>담당자휴대폰</th><th>담장자주소</th><th>수강과목선택</th><th>성별</th>
                        <tr>
                            <td>"; print $member1[0]["name3"]; echo "</td>
                            <td>"; print $member1[0]["Tel3"]; echo "</td>
                            <td>"; print $member1[0]["address3"]; echo "</td>
                            <td>"; print $member1[0]["class3"]; echo "</td>
                            <td>"; print $member1[0]["etcs3"]; echo "</td>
                        </tr>
                        <tr>
                            <td>"; print $member1[1]["name3"]; echo "</td>
                            <td>"; print $member1[1]["Tel3"]; echo "</td>
                            <td>"; print $member1[1]["address3"]; echo "</td>
                            <td>"; print $member1[1]["class3"]; echo "</td>
                            <td>"; print $member1[1]["etcs3"]; echo "</td>
                        </tr>
                        <tr>
                            <td>"; print $member1[2]["name3"]; echo "</td>
                            <td>"; print $member1[2]["Tel3"]; echo "</td>
                            <td>"; print $member1[2]["address3"]; echo "</td>
                            <td>"; print $member1[2]["class3"]; echo "</td>
                            <td>"; print $member1[2]["etcs3"]; echo "</td>
                        </tr>
                        <tr>
                            <td>"; print $member1[3]["name3"]; echo "</td>
                            <td>"; print $member1[3]["Tel3"]; echo "</td>
                            <td>"; print $member1[3]["address3"]; echo "</td>
                            <td>"; print $member1[3]["class3"]; echo "</td>
                            <td>"; print $member1[3]["etcs3"]; echo "</td>
                        </tr>
                        <tr>
                            <td>"; print $member1[4]["name3"]; echo "</td>
                            <td>"; print $member1[4]["Tel3"]; echo "</td>
                            <td>"; print $member1[4]["address3"]; echo "</td>
                            <td>"; print $member1[4]["class3"]; echo "</td>
                            <td>"; print $member1[4]["etcs3"]; echo "</td>
                        </tr>
                        <tr>
                            <td>"; print $member1[5]["name3"]; echo "</td>
                            <td>"; print $member1[5]["Tel3"]; echo "</td>
                            <td>"; print $member1[5]["address3"]; echo "</td>
                            <td>"; print $member1[5]["class3"]; echo "</td>
                            <td>"; print $member1[5]["etcs3"]; echo "</td>
                        </tr>
                        <tr>
                            <td>"; print $member1[6]["name3"]; echo "</td>
                            <td>"; print $member1[6]["Tel3"]; echo "</td>
                            <td>"; print $member1[6]["address3"]; echo "</td>
                            <td>"; print $member1[6]["class3"]; echo "</td>
                            <td>"; print $member1[6]["etcs3"]; echo "</td>
                        </tr>
                        <tr>
                            <td>"; print $member1[7]["name3"]; echo "</td>
                            <td>"; print $member1[7]["Tel3"]; echo "</td>
                            <td>"; print $member1[7]["address3"]; echo "</td>
                            <td>"; print $member1[7]["class3"]; echo "</td>
                            <td>"; print $member1[7]["etcs3"]; echo "</td>
                        </tr>
                        
                   </table>";
            ?>
            
            <?php
            echo "<br><br>";
            echo "<h1>연산자 시작</h1>";

            $answer1 = 5 + 1;
            $answer2 = 5 - 1;
            $answer3 = 5 / 5;
            $answer4 = 5 % 3;
            echo "<table>
                    <tr>
                        <td>덧셈연산</td>
                        <td>5+1</td>
                        <td>$answer1</td>
                    </tr>
                    
                    <tr>
                        <td>뺄셈연산</td>
                        <td>5-1</td>
                        <td>$answer2</td>
                    </tr>
                    
                    <tr>
                        <td>나눗셈연산</td>
                        <td>5 / 5</td>
                        <td>$answer3</td>
                    </tr>
                    
                    <tr>
                        <td>나머지연산</td>
                        <td>5 % 3</td>
                        <td>$answer4</td>
                    </tr>
                  </table>";
            echo "<br><br>";


                $answer = 5 +1;
                print "[덧셈연산] 5+1 = $answer";
                print "<br><br>";



            $answer = 5-2;
            echo "[뺄셈연산] 5-2 = $answer";
            print "<br><br>";



            $answer1 = 5 * 2;
            print "[곱하기연산] 5 * 2 = $answer1";
            echo "<br><br>";



            $answer3 = 5 / 5;
            print "[나눗셈연산] 5 / 5 =$answer3";
            echo "<br><br>";



            $answer4 = 5 % 3;
            print "[나머지연산] 5 % 3 = $answer4";
            echo "<br><br>";

            ?>



            <?php
                //+= 연산자
            echo "<h1>+=연산자</h1>";
                $data = 20;
                $age = $data;
                $age += 5;
                print $age;
                print "<br><br>";

            echo ".= 연산자 : ";
            $data = "GPC인증원,  \n\n";
            $name = $data;
            $name .= "대표이사 \n";
            print $name;
            print "<br><br>";
            ?>
            <h1>상수</h1>
            <h2>1)코드가 실행되는 중에 변경하지 않는 값을 미리 할당해둔다.</h2>
            <h2>2)대문자 사용함</h2>
            <h2>상수는 php코드 어디서든지 사용할 수 있어서 사용자에게 나타낼 메시지를 정의하기 편리하다.</h2>
            <?php
            //상수 : 코드가 실행되는 중에 변경하지 않는 값을 미리 할당해 둔다. 대문자 사용함, 상수는 PHP코드 어디서든지 사용할 수 있어서 사용자에게 나타낼 메시지를 정의하기 편리하다.
            // define 함수를 사용햐면 자신만의 상수를 사용할 수 있다.
                define("상수이름","정의할 값");
                echo  "상수이름1";
                echo "<br><br>";
                define("define1","안녕하세요! GPC인증신청시스템입니다.");
                print define1;
            ?>
            
            <?php
            echo "<h1>배열변수만 대입하여 결과확인</h1>";
            print "<pre>"; print_r($_SERVER); print "</pre>";
            ?>

            <?php
//                print true;
//                print "<br>";
//
//                print false;
//                print "<br>";
                print "5 == 5 => 좌측 5와 우측5가 같다. 그러므로 참이되어 숫자 1을 출력함.\n";
                print (5 == 5);// 좌측 5와 우측 5같다. 그러므로 참이되어 숫자 1을 출력함
                print "<br>";
            ?>

            <?php
                echo "<h1>삼항연산자</h1>";
                $age =58;
                $adult_age =20;
                $adult_check =($adult_age <= $age)?"어른":"아이";

                echo $adult_check."입니다";
echo "<br><br>";
print "<h1>오류제어 연산자 @</h1>";
                global $aaa;
                function foo()
                {
                    global $aaa;
                    return $aaa = 1234;
                }
                echo "<br>";
                $bbb = foo();
//                echo $bbb;// 이 때 출력값은 1234
echo "<br>";
                echo $aaa = 4321;
 echo "<br>";
                echo $bbb;// 이 때 출력값은 4321
            ?>


            <?php
                echo "<h1>배열연산자</h1>";
                $data1 = array("name"=>"IGC","age"=>21);
                $data2 = array("name"=>"GPC","age"=>14, "Tel"=>"0267490723");
                $data = $data1 + $data2;

                echo "<PRE>";
                //var_dump함수는 배열의 구조를 표시해준다.
                var_dump($data);
                echo "</PRE>";
            ?>

            <?php
                echo "<h1>if 조건문</h1>";
                $username = "user";
                $password = "pass";
                $db_data["username"] = "user";
                $db_data["password"] = "pass";

                //if(조건문)  시작
                 if($db_data["username"] == $username && $db_data["password"] == $password){
                    print "회원전용 페이지 로그인되었습니다...";
                 } else {
                    print "로그인에 실패하였습니다.";
                        }
            ?>



            <?php
            echo "<h1>if else 조건문</h1>";
                $adult_check = ($adult_age <= $age)?"어른":"아이";
                //위와 같은 코드이다.

                if($adult_age <= $age){
                    $adult_check = "어른";
                } else{
                    $adult_check = "아이";
                }
            ?>

            <?php
            echo "<h1>switch문</h1>";
                $type ="form";

                if($type == "form"){
                    print "폼 등록입니다.";
                }else if($type == "exec"){
                    print " 등록 처리 진행 중입니다.";
                }else{
                    print "화면이 없습니다.";
                }
            ?>

            <?php
                echo "<h1>Switch문 예</h1><br>";
                $type = "form";

                //switch문 시작
                switch($type){
                    case "form":
                        print "등록된 폼입니다.";
                        break;
                    case "confirm":
                        print "확인이 필요한 화면입니다.";
                        break;
                    case "exec":
                        print "등록처리 실행 중입니다.";
                        break;
                    default:
                        print "화면이 없습니다.";
                }
            ?>

            <?php
            echo "<br><br> \n <h1>반복문 while, for, foreach문</h1>";
                $i = 5;
                while($i<=10){
                    print $i ++;
                    print "<h2>\n \n</h2>";
                }
            ?>
            
            <?php
            echo "<br><br><h1>폴더 안에 있는 파일명과 디렉토리 명을 모두 표시함</h1>";

            if($dirhandle = opendir('.')){
                while(false !== ($filename = readdir($dirhandle))){
                    print $filename."<br>";
                }
                closedir($dirhandle);
            }
            ?>

            <?php
            echo "<h1>while문과 do while 차이</h1><br>";
            $j = 0;
            do{
                print $j ++;
                print "<br>";
            } while($i <=10);
            ?>

            <?php
            echo "<br><h1>for문</h1>";
                for($i=1;$i<5;$i++){
                    print $i."번째 반복입니다.<br>";
                }
            ?>

            <?php
            echo "<h1>자격구분(풀다운 메뉴 구현-apply.php 파일에 구현)</h1><br>";
                $PrefectureList = array(
                 "ISO 9001:2015",
                 "ISO 14001:2015",
                 "ISO 45001:2018",
                 "ISO 22000:2018",
                 "ISO 27001:2013",
                 "ISO 13485:2016",
                 "ISO 20000-1:2018",
                 "ISO 22301:2019",
                 "ISO 21001:2018",
                 "ISO 21001:2018",
                 "ISO 21001:2018",
                 "ISO 22716:2007",
                 "ISO 27701:2019",
                 "ISO 27017:2015",
                 "ISO 27018:2019",
                 "ISO 27799:2016",
                 "검증심사원"
            );
                $html = "<select name=\"prefecture\">\n";
                for($i =0; $i<=count($PrefectureList)- 1;$i ++){
                    $html.="<option value=\"$i\">$PrefectureList[$i]</option>\n";
                }
                $html .="</select>\n";

                echo $html;
            ?>

<!--            --><!---?php
//            echo "<br><br><h1>foreach문</h1>";
//
//            $week = array("월요일","화요일","수요일","목요일","금요일","토요일","일요일");
////            reset($week);
//            foreach($week as $key){
//                print $value;
//                print "<br>";
//            }
//            ?--->

<!--            --><!---?php
//            $week = array("Monday","Tuesday","Wednesday","Thursday","Friday","Satuarday","Sunday");
//            reset($week);
//
//            while(list($value) = each($week)){
//                print $value;
//                print "<br>";
//                print $week;
//                print "<br>";
//            }
//            ?--->

            <?php
            echo "<br><h1>연관배열 key값, value값 동시 꺼내기</h1>";

            $member2 = array("company"=>"IGC", "Tel"=>02-6749-0723, "address"=>"서울시 금천구 서부샛길 638 대륭테크노타운7차 402-1호");

            foreach($member2 as $key=>$value){
                print "$key : $value";
                print "<br>";
            }
            ?>

            <!---------(주)아이지씨인증원 사업영역 종료 ------>
        </section>

    </div>

<?php
include_once(G5_THEME_PATH.'/tail.php');
?>