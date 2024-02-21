<?php
include_once('./_common.php');
$g5['title'] = '회사소개';
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
    .top_tt small{
        display:block;
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
        line-height:1.8rem;
    }
    
    
    /*회사개요*/
    .mid_content02 {margin:50px 0 0px;}
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
    .mid_content02 ul li{
        padding:8px 12px;
        color:#333;
        font-weight:400;
    }
    .mid_content02  ul li span{
        display:inline-block;
        width:180px;
        font-size:1.1rem;
        color:#333;
        font-weight:500;
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
        .mid_content02  ul li span{ /*회사개요 왼쪽 타이틀*/
            display:inline-block;
            width:140px;
            font-size:1.1rem;
            color:#333;
            font-weight:500;
        }
        
    /* 최대 1024px 화소까지 적용 */
    @media (max-width:1024px) {
        /*-----1024px에서 텍스트 크기 변경되는 class -----*/
        .container_title{width:100%;}
        .top_tt{
            padding:40px 0 40px;
            font-size:1.85rem;
        }
        .top_tt:after { /*밑줄선*/
            margin: 40px auto 0;
        }
        .mid_content02 .content_title{ /*company overview*/
            font-size:1.6rem;
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
        .mid_content02  ul li span{ /*회사개요 왼쪽 타이틀*/
            display:block;
            width:100%;
            font-size:1.1rem;
            color:#333;
            font-weight:500;
            padding-bottom:2px;
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
    }


    /* 모바일(가장 큰 사이즈: iPhone 6/7/8 Plus) 세로 버전 사이즈, 최소 360px ~ 최대 414px 화소까지 적용 */
    @media all and (min-width:360px) and (max-device-width : 414px) { 
        /*----- 360px ~ 414px에서 텍스트 크기 변경되는 class -----*/
        .content_wrap{
            font-size:0.95rem;
        }
        .top_tt{
            font-size:1.35rem;
            padding:0px 0 30px;
            line-height:2.2rem;
        }
        .top_tt:after { /*밑줄선*/
            margin: 30px auto 0;
        }
        .top_txt{
            font-size:0.95rem;
        }
        .mid_content01 h3{font-size:1.1rem;}
        
        .gray_box{ /*개인인증, 연수기관 지정 컨텐츠*/
           margin:20px 0%;
        }
        .mid_content02 .content_title{ /*company overview*/
            margin-bottom:30px;
            font-size:1.4rem;
        }
        .mid_content02  ul li>span{ /*회사개요 왼쪽 타이틀*/
            font-size:1rem;
        }
    }  
            
/*---------------------------------------------------------------반응형 끝*/

    
    
</style>

<body>

<div class="content_wrap">
	<!--본문영역 -->
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
    .top_tt small{
        display:block;
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
        line-height:1.8rem;
    }
    
    
    /*회사개요*/
    .mid_content02 {margin:50px 0 0px;}
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
    .mid_content02 ul li{
        padding:8px 12px;
        color:#333;
        font-weight:400;
    }
    .mid_content02  ul li span{
        display:inline-block;
        width:180px;
        font-size:1.1rem;
        color:#333;
        font-weight:500;
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
        .mid_content02  ul li span{ /*회사개요 왼쪽 타이틀*/
            display:inline-block;
            width:140px;
            font-size:1.1rem;
            color:#333;
            font-weight:500;
        }
        
    /* 최대 1024px 화소까지 적용 */
    @media (max-width:1024px) {
        /*-----1024px에서 텍스트 크기 변경되는 class -----*/
        .container_title{width:100%;}
        .top_tt{
            padding:40px 0 40px;
            font-size:1.85rem;
        }
        .top_tt:after { /*밑줄선*/
            margin: 40px auto 0;
        }
        .mid_content02 .content_title{ /*company overview*/
            font-size:1.6rem;
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
        .mid_content02  ul li span{ /*회사개요 왼쪽 타이틀*/
            display:block;
            width:100%;
            font-size:1.1rem;
            color:#333;
            font-weight:500;
            padding-bottom:2px;
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
    }


    /* 모바일(가장 큰 사이즈: iPhone 6/7/8 Plus) 세로 버전 사이즈, 최소 360px ~ 최대 414px 화소까지 적용 */
    @media all and (min-width:360px) and (max-device-width : 414px) { 
        /*----- 360px ~ 414px에서 텍스트 크기 변경되는 class -----*/
        .content_wrap{
            font-size:0.95rem;
        }
        .top_tt{
            font-size:1.35rem;
            padding:0px 0 30px;
            line-height:2.2rem;
        }
        .top_tt:after { /*밑줄선*/
            margin: 30px auto 0;
        }
        .top_txt{
            font-size:0.95rem;
        }
        .mid_content01 h3{font-size:1.1rem;}
        
        .gray_box{ /*개인인증, 연수기관 지정 컨텐츠*/
           margin:20px 0%;
        }
        .mid_content02 .content_title{ /*company overview*/
            margin-bottom:30px;
            font-size:1.4rem;
        }
        .mid_content02  ul li>span{ /*회사개요 왼쪽 타이틀*/
            font-size:1rem;
        }
    }  
            
/*---------------------------------------------------------------반응형 끝*/

    
    
</style>

  
<!---인증신첨시스템 시작 --->  
<style>
table.type09 {
  border-collapse: collapse;
  text-align: left;
  line-height: 1.5;
      text-align: center;
    margin: 0 auto;
margin-top:100px;
}
table.type09 thead th {
  padding: 10px;
  font-weight: bold;
  vertical-align: top;
  color: #369;
  border-bottom: 3px solid #036;
}
table.type09 tbody th {
  width: 250px;
  padding: 10px;
  font-weight: bold;
  vertical-align: top;
  border-bottom: 1px solid #ccc;
  background: #f3f6f7;
}
table.type09 td {
  width: 350px;
  padding: 10px;
  vertical-align: top;
  border-bottom: 1px solid #ccc;
}
</style>

<link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR:100,300,400,500,700,900&display=swap&subset=korean" rel="stylesheet">
<script src="https://code.jquery.com/jquery-1.11.3.js"></script>

<!---인증신첨시스템 종료 ---> 
    


<form name="fm_write" class="" method="post" enctype="multipart/form-data" >
<input type="hidden" id="hand" name="hand" value="reg">
<table class="type09">
  <thead>
  <tr style="display:none">
    <th scope="cols">타이틀</th>
    <th scope="cols">내용</th>
  </tr>
  </thead>
  <tbody>
  <tr>
    <th scope="row">자격구분</th>
    <td>
		<select id="kind" name="kind">
			<option value="1">ISO기본 표준심사원1</option>
			<option value="2">ISO기본 표준심사원2</option>
			<option value="3">ISO기본 표준심사원3</option>
			<option value="3">ISO기본 표준심사원4</option>
			<option value="3">ISO기본 표준심사원5</option>
			<option value="3">ISO기본 표준심사원6</option>
		</select>
	</td>
	<th scope="row">유형</th>
    <td>최초인증</td>
  </tr>
  <tr>
    <th scope="row">신청규격 및 등급</th>
    <td colspan='3'>ISO90001 2015(심사원)</td>
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
		<input type="text" id="address1" name="address1" value="서울시 강남구 역삼동" style="float:left">버튼위치<BR>
		<input type="text" id="address2" name="address2" value="123" style="float:left">
	</td>
   </tr>

   <tr>
    <th scope="row">제출문서</th>
    <td colspan='3' >
		<table>
		<tr>
			<th>구분</th>
			<th>비교</th>
		</tr>
		<tr>
			<td colspan='2' style="color:#e53e53">ISO 9001 2015(심사원)</td>
		</tr>
		<tr>
			<td>이력서</td>
			<td><input type="checkbox" id="chk1" name="chk1" checked>실무경력포함</td>
		</tr>
		<tr>
			<td>심사일지</td>
			<td><input type="checkbox" id="chk2" name="chk2" checked>심사원 5맨데이,선임 8맨데이</td>
		</tr>
		<tr>
			<td>서약서</td>
			<td><input type="checkbox" id="chk3" name="chk3">서약서</td>
		</tr>
		<tr>
			<td>교육훈련수료증</td>
			<td><input type="checkbox" id="chk4" name="chk4">교육수료</td>
		</tr>
		<tr>
			<td>학력증명서</td>
			<td><input type="checkbox" id="chk5" name="chk5">고등학교졸업이상</td>
		</tr>
		<tr>
			<td>비용</td>
			<td><input type="checkbox" id="chk6" name="chk6">신청서, 연회비</td>
		</tr>
		<tr>
			<td>규격별 시험</td>
			<td><input type="checkbox" id="chk7" name="chk7">ISO19011+신청규격</td>
		</tr>

		<tr>
			
			<td colspan='2'><input type="file" id="file1" name="file2"></td>
		</tr>

		</table>
	</td>
   </tr>

  </tbody>

  </table>

  <div style="text-align:center;margin-top:30px">
  <button type="button" id="submitAction">DB전송하기</button>
  </div>

  </form>

  <script>

  $("#submitAction").click(function(){
	
	console.log( "kind==="+$("#kind").val() );
	console.log( "name_ko==="+$("#name_ko").val() );
	console.log( "name_en==="+$("#name_en").val() );
	console.log( "hp==="+$("#hp").val() );
	console.log( "email==="+$("#email").val() );
	console.log( "address1==="+$("#address1").val() );
	console.log( "address2==="+$("#address2").val() );
	console.log( "reg_date==="+$("#reg_date").val() );

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
					console.log(data);//
					location.href="introduce_list.php";
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
  
	<!--본문영역끝 -->

</div> <!--------------------------// class="content_wrap" //------------------------------->

</body>

<?php
include_once(G5_THEME_PATH.'/tail.php');
?>