<!---DOCTYPE html--->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!---meta http-equiv="Content-Type" content="text/html; charset=utf-8"--->
    <title>GPC 인증/심사원 신청시스템 예시</title>
    
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
<script src="https://code.jquery.com/jquery-1.11.3.js"></script>
</head>

<body>

   
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
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
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
    <td colspan='3' >
		<input type="text" id="address1" name="address1" value="서울시 강남구 역삼동" style="float:left"> 버튼위치 <br>
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
			<td><input type="checkbox" id="chk2" name="chk2" checked>심사원 5맨데이, 선임 8맨데이</td>
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
  <button type="button" id="submitAction">DB 전송하기</button>
  </div>

  </form> 
  
  
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

	if(confirm('�����͸� ����Ͻðڽ��ϱ�?')) {

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
					alert( "������ �߻��Ͽ����ϴ�.\n����Ŀ� �õ����ּ���." );
				},
				success: function(data)
				{
					console.log(data);
location.href="list.php";
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



