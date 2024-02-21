<!---DOCTYPE html--->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!---meta http-equiv="Content-Type" content="text/html; charset=utf-8"--->
    <title>GPC</title>
    
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
    <th scope="cols">Ÿ��Ʋ</th>
    <th scope="cols">����</th>
  </tr>
  </thead>
  <tbody>
  <tr>
    <th scope="row">�ڰݱ���</th>
    <td>
		<select id="kind" name="kind">
			<option value="1">ISO�⺻ ǥ�ؽɻ��?</option>
			<option value="2">ISO�⺻ ǥ�ؽɻ��?</option>
			<option value="3">ISO�⺻ ǥ�ؽɻ��?</option>
		</select>
	</td>
	<th scope="row">����</th>
    <td>��������</td>
  </tr>
  <tr>
    <th scope="row">��û�԰� �� ���?/th>
    <td colspan='3'>ISO90001 2015(�ɻ��?</td>
  </tr>
  
 

  <tr>
    <th scope="row">�̸�(��)</th>
    <td>
		<input type="text" id="name_ko" name="name_ko" value="ȫ�浿">
	</td>
	<th scope="row">�̸�(��)</th>
    <td><input type="text" id="name_en" name="name_en" value="hongkildong"></td>
  </tr>

    <tr>
    <th scope="row">�ڵ�����ȣ</th>
    <td>
		<input type="text" id="hp" name="hp" value="010-123-4567">
	</td>
	<th scope="row">�̸���</th>
    <td><input type="text" id="email" name="email" value="test1@gmail.com"></td>
  </tr>
  <tr>
    <th scope="row">�����ּ�</th>
    <td colspan='3' >
		<input type="text" id="address1" name="address1" value="�����?������ ���ﵿ" style="float:left">��ư��ġ<BR>
		<input type="text" id="address2" name="address2" value="123" style="float:left">
	</td>
   </tr>

   <tr>
    <th scope="row">���⹮��</th>
    <td colspan='3' >
		<table>
		<tr>
			<th>����</th>
			<th>��</th>
		</tr>
		<tr>
			<td colspan='2' style="color:#e53e53">ISO 9001 2015(�ɻ��?</td>
		</tr>
		<tr>
			<td>�̷¼�</td>
			<td><input type="checkbox" id="chk1" name="chk1" checked>�ǹ��������?/td>
		</tr>
		<tr>
			<td>�ɻ�����</td>
			<td><input type="checkbox" id="chk2" name="chk2" checked>�ɻ��?5�ǵ���,���� 8�ǵ���</td>
		</tr>
		<tr>
			<td>���༭</td>
			<td><input type="checkbox" id="chk3" name="chk3">���༭</td>
		</tr>
		<tr>
			<td>�����Ʒü�����</td>
			<td><input type="checkbox" id="chk4" name="chk4">��������</td>
		</tr>
		<tr>
			<td>�з������?/td>
			<td><input type="checkbox" id="chk5" name="chk5">����б������̻�?/td>
		</tr>
		<tr>
			<td>���?/td>
			<td><input type="checkbox" id="chk6" name="chk6">��û��, ��ȸ��</td>
		</tr>
		<tr>
			<td>�԰ݺ� ����</td>
			<td><input type="checkbox" id="chk7" name="chk7">ISO19011+��û�԰�</td>
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
  <button type="button" id="submitAction">DB�����ϱ�</button>
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
					alert( "������ �߻��Ͽ����ϴ�.\n����Ŀ�?�õ����ּ���." );
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



