<?php
include_once('./_common.php');
$g5['title'] = '신청 진행상황 조회';


include_once(G5_THEME_PATH.'/head.php');
add_javascript('<script src="'.G5_JS_URL.'/apply.js?ver='.time().'"></script>', 0);
?>


<body>

<div class="content_wrap">
	<!--본문영역 -->

	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<!-- STRAT : form wrap -->
				<div class="form_wrap">
                    <div class="content_tt" style="color:#27323a;">
                        신청 진행상황 조회
                    </div>
					<!-- 신청내역 안내 -->
					<h6 class="content_box_tt">인증번호 입력</h6>
					<div class="text_box_gray">
						<span class="icon_comment material-symbols-outlined">comment</span>
						자격 등록신청시 안내 받으신 인증번호를 입력하여 주세요.
					</div>
					<!-- 
						엔터키 눌렀을때 form의 submit 작동되어 페이지 '새로고침' 현상 발생
					    새로고침 방지하기 위해 form태그에 return false 적용. 20220915 HJ
					-->
					<form onsubmit="return false;" name="iso_code" id="iso_code" method="post"> 
					<input type="hidden" name="iso_mode" id="iso_mode" value="certification" />
					<div>						
						<table class="apply_table">
							<tbody>
								<tr height="35">
									<th scope="row">인증번호</th>
									<td>
										<input type="text" name="scode" id="scode" class="lance" style="width: 50%;border: 1px solid #bbb;">
									</td>
								</tr>
							</tbody>
						</table>
						<button type="button" id="btn_code_login" class="btn btn-primary" style="display: table;margin-left:auto;margin-right:auto;margin-bottom:100px;">확인</button>
					</div>
					</form>
					<div id="submiT" style="margin: 0 0 80px;"></div>
				</div>
				<!-- END : form wrap  -->
			</div>
		</div>
	</div>
	
	<script type="text/javascript">
        $(function(){   
            $("#sCode").on('input',function(){
                if($("#sCode").val()=='')
                    $("#TestBtn").attr("disabled",true);
                else
                    $("#TestBtn").attr("disabled",false);
            });
        })
        function btnActive()  {

        const subMt = document.getElementById('submiT');
        subMt.style.display = 'block';
        }
    </script>
	
	
	
<div class="paging_wrap">
	<script>
		page_set['tot'] = parseInt('<?=$tot_count?>');
		page_set['one_page'] = parseInt('<?=$one_page_num?>');
		page_set['now_page'] = parseInt('<?=$pg?>');
		page_set['one_block'] = parseInt('<?=$one_block_num?>');
		page_set['self_url'] = "<?=$_SET['Nav']['pageurl']?>";
		setPaging();
	</script>
  
	<!--본문영역끝 -->
</div>

</div> <!--------------------------// class="content_wrap" //------------------------------->

</body>

<?php
include_once(G5_THEME_PATH.'/tail.php');
?>