<!---DOCTYPE html--->
<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <!---meta http-equiv="Content-Type" content="text/html; charset=utf-8"--->
    
    <!--  Noto Sans 폰트  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@400;500;700&display=swap" rel="stylesheet">

    
    <title>GPC 심사원 등록신청 Test Page</title>
    
    <style>
        table{font-size:inherit;border-top:1px solid #ddd;}
        table.type09 {
            width:100%;
            border-collapse: collapse;
            text-align: left;
            line-height: 1.5;
            margin: 0 auto;
            margin-top:30px;
        }
        table.type09 thead th {
            padding: 12px 25px;
            font-weight: 500;
            border-bottom: 1px solid #666;
            background: #f7f7f7;
        }
        table.type09 tbody th {
            width: 15%;
            padding: 12px 25px;
            font-weight: 500;
            vertical-align: middle;
            border-bottom: 1px solid #ddd;
            background: #f7f7f7;
        }
        table.type09 td {
            width: 350px;
            padding: 12px 20px;
            vertical-align: middle;
            border-bottom: 1px solid #ddd;
        }
        
        
        /* ----------------------------------- 220609 yr */
        .wrap{
            font-size:0.95rem;
            color:#333;
            font-weight:400;
            font-family: 'Noto Sans KR', sans-serif;
        }
        
        /*
        table.type09 tbody th:before {  테이블명 옆 border
            content: "";
            display: inline-block;
            width: 3px;
            height: 1.2rem;
            background: #E8424F;
            vertical-align: middle;
            margin-right: 10px;
        }
        */
        
        /* ==== input ==== */
        input[type=text],select{ /* 전체 텍스트 입력란, select 선택란 */
            width:60%;
            font-family: inherit;
            font-size:0.9rem;
            padding:5px;
            border-radius:0px;
            border:1px solid #bbb;
            color:#555;
        }
        input#email{ width:80%; } /* 이메일 입력란 */
        input#zipcode{ /* 우편번호 입력란 */
            width:15%;
            margin-bottom:3px;
        }
        input#address1{ /* 주소 입력란 */
            width:45%;
            margin-bottom:3px;
        } 
        input#address2, input#extraAddress{ /* 상세주소, 참고항목 입력란 */
            width:35%;
            margin-right:3px;
        } 
        
        /* ==== button ====*/
        button{ cursor:pointer; } /* 버튼 */
        button#btn_zip{ /* 우편번호확인 버튼 */
            background:#13bd6e;
            border:1px solid #bbb;
            color:#fff;
            padding:4px 8px;
            font-size: 0.75rem;
            vertical-align:top;
        }
        button#submitAction{ /* 신청하기 버튼 */
            background:#0982ff;
            border:none;
            color:#fff;
            padding:8px 20px;
            font-size: 0.9rem;
            vertical-align:top;
            transition:all 0.1s;
        }
        button#submitAction:hover{ background:#0370e1;}
        
        /* ==== checklist_box ====*/
        .checklist_box{  /* 상단 제출서류 안내 박스 */
            height:auto;
            padding:20px 25px;
            background:#f9f9f9;
        }
        .checklist_box ul{ padding-left:0px; }
        .checklist_box ul li{
            list-style: none;
            padding-bottom:10px;
        }
        .checklist_box ul li a{
            color:#df452a;
            text-decoration: none;
        }
        .checklist_box ul li:last-child{ padding-bottom:0px; }
        
        /* ==== in_table ====*/
        table.in_table{ /* 제출문서 내 테이블 */
            width:100%;
            margin: 20px 0;
            border-collapse: collapse;
        }
        table.in_table .bd_right{border-right:1px solid #ddd;}
        
    </style>
    
    <script src="https://code.jquery.com/jquery-1.11.3.js"></script>
    
    <!------------------------------ 우편번호 검색 스크립트 시작 ------------------------------>
    <script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
    <script>
        function kakaopost() {
            //팝업 위치를 지정(화면의 가운데 정렬)
            var width = 500; //팝업의 너비
            var height = 600; //팝업의 높이
            
            new daum.Postcode({
                width: width, //생성자에 크기 값을 명시적으로 지정해야 합니다.
                height: height,
                oncomplete: function(data) {
                    // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

                    // 각 주소의 노출 규칙에 따라 주소를 조합한다.
                    // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
                    var addr = ''; // 주소 변수
                    var extraAddr = ''; // 참고항목 변수

                    //사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
                    if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                        addr = data.roadAddress;
                    } else { // 사용자가 지번 주소를 선택했을 경우(J)
                        addr = data.jibunAddress;
                    }

                    // 사용자가 선택한 주소가 도로명 타입일때 참고항목을 조합한다.
                    if(data.userSelectedType === 'R'){
                        // 법정동명이 있을 경우 추가한다. (법정리는 제외)
                        // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
                        if(data.bname !== '' && /[동|로|가]$/g.test(data.bname)){
                            extraAddr += data.bname;
                        }
                        // 건물명이 있고, 공동주택일 경우 추가한다.
                        if(data.buildingName !== '' && data.apartment === 'Y'){
                            extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                        }
                        // 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
                        if(extraAddr !== ''){
                            extraAddr = ' (' + extraAddr + ')';
                        }
                        // 조합된 참고항목을 해당 필드에 넣는다.
                        document.getElementById("extraAddress").value = extraAddr;

                    } else {
                        document.getElementById("extraAddress").value = '';
                    }

                    // 우편번호와 주소 정보를 해당 필드에 넣는다.
                    document.getElementById('zipcode').value = data.zonecode;
                    document.getElementById("address1").value = addr;
                    // 커서를 상세주소 필드로 이동한다.
                    document.getElementById("address2").focus();
                }
            }).open({
                left: (window.screen.width / 2) - (width / 2),
                top: (window.screen.height / 2) - (height / 2)
            });
        }
    </script>
    <!------------------------------ 우편번호 검색 스크립트 종료 ------------------------------>
</head>

<body>
    <div class="wrap">
        <div class="checklist_box">
            <div>다음의 제출 서류를 확인해주세요.</div>
            <ul>
                <li>1) 이력서(업무기술서) = > [<a href="#" download>다운로드</a>] 작성후 첨부해주세요.</li>
                <li>2) 심사일지(심사원 5맨데이, 선임 8맨데이) = > [<a href="#" download>다운로드</a>] 작성후 첨부해주세요.</li>
                <li>3) 서약서 = > [<a href="#" download>다운로드</a>] 작성후 첨부해주세요.</li>
                <li>4) 교육훈련수료증 = > 첨부해주세요.</li>
                <li>5) 학력증명서 = > 첨부해주세요.</li>
                <li>6) 비용 = > 카드결제 또는 현금결제 (GPC로 문의 부탁드립니다.)</li>
            </ul>
        </div>

        <form name="fm_write" class="" method="post" enctype="multipart/form-data" >
            <input type="hidden" id="hand" name="hand" value="reg">
            <table class="type09">
                <thead>
                    <tr style="display:none">
                        <th scope="cols"></th>
                        <th scope="cols"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">자격구분</th>
                        <td>
                            <select id="kind" name="kind">
                                <option value="ISO 기반 표준 심사원">ISO 기반 표준 심사원</option>
                                <option value="ISO 9001:2015">ISO 9001:2015</option>
                                <option value="ISO 14001:2015">ISO 14001:2015</option>
                                <option value="ISO 45001:2018">ISO 45001:2018</option>
                                <option value="ISO 22000:2018">ISO 22000:2018</option>
                                <option value="ISO 27001:2013">ISO 27001:2013</option>
                                <option value="ISO 13485:2016">ISO 13485:2016</option>
                                <option value="ISO 20000-1:2018">ISO 20000-1:2018</option>
                                <option value="ISO 22301:2019">ISO 22301:2019</option>
                                <option value="ISO 21001:2018">ISO 21001:2018</option>
                                <option value="ISO 37001:2016">ISO 37001:2016</option>
                                <option value="ISO 22716:2007">ISO 22716:2007</option>
                                <option value="ISO 27701:2019">ISO 27701:2019</option>
                                <option value="ISO 27017:2015">ISO 27017:2015</option>
                                <option value="ISO 27018:2019">ISO 27018:2019</option>
                                <option value="ISO 27799:2016">ISO 27799:2016</option>
                                <option value="검증심사원">검증심사원</option>
                            </select>
                        </td>
                        <th scope="row">유형</th>
                        <td>최초인증</td>
                    </tr>
                    <tr>
                        <th scope="row">신청규격 및 등급</th>
                        <td colspan='3'>ISO 90001:2015(심사원)</td>
                    </tr>
                    <tr>
                        <th scope="row">이름(한)</th>
                        <td>
                        <input type="text" id="name_ko" name="name_ko" value="홍길동">
                        </td>
                        <th scope="row">이름(영)</th>
                        <td><input type="text" id="name_en" name="name_en" value="hongkildong"></td>
                    </tr>
                    <tr>
                        <th scope="row">핸드폰번호</th>
                        <td>
                        <input type="text" id="hp" name="hp" value="010-123-4567">
                        </td>
                        <th scope="row">이메일</th>
                        <td><input type="text" id="email" name="email" value="test1@gmail.com"></td>
                    </tr>
                    <tr>
                        <th scope="row">직장주소</th>
                        <td colspan='3'>
                            <input type="text" id="zipcode" name="zipcode" value="우편번호"> &nbsp;&nbsp;<button type="button" onclick="kakaopost()" id="btn_zip">우편번호확인</button> <br> 
                            <input type="text" id="address1" name="address1" value="주소"> <br>
                            <input type="text" id="address2" name="address2" value="상세주소"><input type="text" id="extraAddress" name="extraAddress" value="참고항목">
                        </td>
                    </tr>

                    <tr>
                        <th scope="row">제출문서</th>
                        <td colspan='3'>
                            <table class="in_table">
                                <tr>
                                    <th style="width:30%" class="bd_right">구분</th>
                                    <th style="width:70%">비교</th>
                                </tr>
                                <tr>
                                    <td colspan='2' style="color:#e53e53">※ ISO 9001:2015(심사원)</td>
                                </tr>
                                <tr>
                                    <td class="bd_right">이력서</td>
                                    <td>
                                        <label><input type="checkbox" name="document_chk" id="chk1" value="실무경력포함" checked> 실무경력포함</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="bd_right">심사일지</td>
                                    <td>
                                        <label><input type="checkbox" name="document_chk" id="chk2" value="심사원 5맨데이, 선임 8맨데이" checked> 심사원 5맨데이, 선임 8맨데이</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="bd_right">서약서</td>
                                    <td>
                                        <label><input type="checkbox" name="document_chk" id="chk3" value="서약서"> 서약서</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="bd_right">교육훈련수료증</td>
                                    <td>
                                        <label><input type="checkbox" name="document_chk" id="chk4" value="교육수료"> 교육수료</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="bd_right">학력증명서</td>
                                    <td>
                                        <label><input type="checkbox" name="document_chk" id="chk5" value="고등학교졸업이상"> 고등학교졸업이상</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="bd_right">비용</td>
                                    <td>
                                        <label><input type="checkbox" name="document_chk" id="chk6" value="신청서, 연회비"> 신청서, 연회비</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="bd_right">규격 별 시험</td>
                                    <td>
                                        <label><input type="checkbox" nname="document_chk" id="chk7" value="ISO19011+신청규격"> ISO19011+신청규격</label>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">파일업로드</th>
                        <td colspan='3'><input type="file" id="file1" name="file2"></td>
                    </tr>
                </tbody>

            </table>

            <div style="text-align:center;margin-top:30px">
                <button type="button" id="submitAction">신청하기</button>
            </div>
        </form> 

    </div>
    <script>
        

        $("#submitAction").click(function(){

        console.log( "kind==="+$("#kind").val() );
        console.log( "name_ko==="+$("#name_ko").val() );
        console.log( "name_en==="+$("#name_en").val() );
        console.log( "hp==="+$("#hp").val() );
        console.log( "email==="+$("#email").val() );

        console.log( $('input:checkbox[id="chk1"]').is(":checked") );
        console.log( $('input:checkbox[id="chk2"]').is(":checked") );
        console.log( $('input:checkbox[id="chk3"]').is(":checked") );
        console.log( $('input:checkbox[id="chk4"]').is(":checked") );
        console.log( $('input:checkbox[id="chk5"]').is(":checked") );
        console.log( $('input:checkbox[id="chk6"]').is(":checked") );
        console.log( $('input:checkbox[id="chk7"]').is(":checked") );

        if(confirm('데이터를 등록하시겠습니까?')) {

                o_OBJ = $('form[name=fm_write]').serialize();
                $.ajax({
                    url: 'save_db.php',
                    data : o_OBJ,
        //			data : {'hand':'del','idx':idx},
                    dataType: "html",
                    type : 'POST',
                    timeout : 1000,
                    error : function( xhr, ajaxOptions, thrownError )
                    {
                        alert( "오류가 발생하였습니다.\n잠시후에 시도해주세요." );
                    },
                    success: function(data)
                    {
                        console.log(data);
        location.href="list_3page.php";
                        //if( data.code == "OK" )
                        //{
                        //	alert( data.msg );
                            //document.location.reload();
                        //location.href="list.php";
                        //}
                        //else if( data.code == "ERR" )
                        //{
                        //	alert( data.msg );
                        //}
                    }
                });

            }	


        });

    </script>
</body>
</html>



