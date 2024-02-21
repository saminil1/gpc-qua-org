<!---DOCTYPE html--->
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <!---meta http-equiv="Content-Type" content="text/html; charset=utf-8"--->
    <title>GPC 인증/심사원 신청시스템 예시</title>
    
    <style>
        body { width: 100%;margin: 0;padding: 0;overflow: hidden; }
        ul,ol,li { list-style: none;margin: 0;padding: 0; }
        p { margin: 0;padding: 0 }
        
        #form01 { width: 1280px;margin: 0 auto; }
        #form01 .page_name { font-size: 1.5em;font-weight: 500;text-align: center; }
        #form01 table.type01 {
            border-collapse: collapse;
            line-height: 1.5;
            margin: 100px auto 0;
            text-align: left;
            border-top: 1px solid #ccc;
        }
        #form01 table.type01 input {
            margin-right: 6px
        }
        #form01 table.type01 tbody th {
            width: 20%;
            padding: 20px;
            font-weight: 600;
            border-bottom: 1px solid #ccc;
            background: #f3f6f7;
        }
        #form01 table.type01 tbody td {
            width: auto;
            padding: 20px;
            border-bottom: 1px solid #ccc;
        }
        #form01 table.type01 tbody p {
            width: 50%;
            margin-bottom: 20px;
            background-color: #f3f6f7;
            font-weight: 600;
            border-top-right-radius: 30px;
            padding: 6px 10px;
        }
        #form01 table.type01 ul {
            display: flex;
            flex-wrap: wrap;
        }
        #form01 table.type01 ul.chk li {
            flex-basis: 25%;
        }
        #form01 table.type01 ul.chk_radio li {
            flex-basis: auto;
            padding-right: 20px;
        }
    </style>
    <script src="https://code.jquery.com/jquery-1.11.3.js"></script>
</head>

<body>

<div id="form01">
    <form name="fm_write" class="" method="post" enctype="multipart/form-data" >
    <input type="hidden" id="hand" name="hand" value="reg">

        <h3 class="page_name">등록신청</h3>

        <table class="type01">
            <thead>
                <tr style="display:none">
                    <th scope="cols"></th>
                    <th scope="cols"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">자격구분</th>
                    <td colspan="3">신청하시려는 ISO 규격과 등급을 선택하세요.</td>
                </tr>
                <tr>
                    <th scope="row" rowspan="2">신청규격 및 등급</th>
                    <td colspan="3" style="border: none">
                        <p>ISO 규격</p>
                        <ul class="chk">
                            <li><label><input type="checkbox" id="chk1" name="chk1" checked>ISO 9001:2015</label></li>
                            <li><label><input type="checkbox" id="chk2" name="chk2">ISO 14001:2015</label></li>
                            <li><label><input type="checkbox" id="chk3" name="chk3">ISO 45001:2018</label></li>
                            <li><label><input type="checkbox" id="chk4" name="chk4">ISO 22000:2018</label></li>
                            <li><label><input type="checkbox" id="chk5" name="chk5">ISO 27001:2013</label></li>
                            <li><label><input type="checkbox" id="chk6" name="chk6">ISO 13485:2016</label></li>
                            <li><label><input type="checkbox" id="chk7" name="chk7">ISO 20000-1:2018</label></li>
                            <li><label><input type="checkbox" id="chk8" name="chk8">ISO 22301:2019</label></li>
                            <li><label><input type="checkbox" id="chk9" name="chk9">ISO 21001:2018</label></li>
                            <li><label><input type="checkbox" id="chk10" name="chk10">ISO 37001:2016</label></li>
                            <li><label><input type="checkbox" id="chk11" name="chk11">ISO 22716:2007</label></li>
                            <li><label><input type="checkbox" id="chk12" name="chk12">검증심사원</label></li>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <p>등급</p>
                        <ul class="chk_radio">
                            <li><label><input type="radio" name="chk_grd" value="chk_grd1" checked>심사원보</label></li>
                            <li><label><input type="radio" name="chk_grd" value="chk_grd2">심사원</label></li>
                            <li><label><input type="radio" name="chk_grd" value="chk_grd3">선임심사원</label></li>
                            <li><label><input type="radio" name="chk_grd" value="chk_grd4">검증심사원</label></li>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <th scope="row">유형</th>
                    <td colspan="3">
                        <ul class="chk_radio">
                            <li><label><input type="radio" name="chk_tp" value="chk_tp1" checked>최초인증</label></li>
                            <li><label><input type="radio" name="chk_tp" value="chk_tp2">사후</label></li>
                            <li><label><input type="radio" name="chk_tp" value="chk_tp3">갱신</label></li>
                            <li><label><input type="radio" name="chk_tp" value="chk_tp4">규격추가</label></li>
                            <li><label><input type="radio" name="chk_tp" value="chk_tp5">등급변경</label></li>
                            <li><label><input type="radio" name="chk_tp" value="chk_tp6">전환</label></li>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <th scope="row">인증번호</th>
                    <td>
                        <input type="text" id="name_ko" name="name_ko" value="">
                    </td>
                    <th scope="row">비밀번호</th>
                    <td>
                        <input type="text" id="name_en" name="name_en" value="">
                    </td>
                </tr>
            </tbody>
        </table>
        
        <p style="padding: 6px 0;">* GCT에 최초등록 또는 전환하시는 경우 인증번호와 비밀번호는 입력하지 않으셔도 됩니다.</p>

        <div style="text-align:center;margin-top:30px">
            <button type="button" id="submitAction">확인</button>
        </div>

    </form>
</div>
  
<!-- Javascript --> 
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
        
        if(confirm('이대로 제출하시겠습니까?')) {

			o_OBJ = $('form[name=fm_write]').serialize();
			$.ajax({
				url: 'save_db.php',
				data : o_OBJ,
                //data : {'hand':'del','idx':idx},
				dataType: "html",
				type : 'POST',
				timeout : 1000,
				error : function( xhr, ajaxOptions, thrownError ) {
					alert( "재확인 후 다시 제출해주시길 바랍니다." );
				},
                
				success: function(data) {
					console.log(data);
                    location.href="form.php";
					//if( data.code == "OK" ) {
                        //alert( data.msg );
				        //document.location.reload();
                        //location.href="list.php";
					//}
					//else if( data.code == "ERR" ) {
                        //alert( data.msg );
					//}
				}
			});
		}
    });

</script>

</body>
</html>