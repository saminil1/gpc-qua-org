<?php
include_once('./_common.php');

$od_id = isset($_REQUEST['od_id']) ? preg_replace('/[^0-9]/', '', $_REQUEST['od_id']) : 0;// 주문번호

if (!get_session('ss_apply_'.$od_id))
    alert('잘못된 접근입니다.', G5_URL);

$sql = " select * from {$g5['iso_apply_table']} where od_id = '{$od_id}' ";
$ap = sql_fetch($sql);
if (!$ap['ia_no']) {
	alert('잘못된 접근입니다.', G5_URL);
}

$g5['title'] = '등록 신청';
include_once(G5_THEME_PATH.'/head.php');
?>

<body>

<div class="content_wrap">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<!-- STRAT : form wrap -->
				<div class="form_wrap">
					<div class="content_tt" style="color:#27323a;">
						등록 신청 완료
					</div>

					<!-- step navigation -->
					<div class="step_navi">
						<ul>
							<li>
								<p><span>STEP 1.</span>자격정보 입력</p>
							</li>
							<li>
								<p><span>STEP 2.</span>신청자 정보 입력</p>
							</li>
							<li class="active">
								<p><span>STEP 3.</span>등록 신청 완료</p>
								<div class="arrow arrow-right"></div>
							</li>
						</ul>
					</div>
					<!-- 신청내역 안내 -->
					<h6 class="content_box_tt content_box_tt2">신청내역 안내</h6>
					<div class="text_box_gray">
                        <span class="icon_comment material-symbols-outlined">check_circle</span> <span style="font-weight: 600;"><?php echo get_text($ap['name_kr']) ?></span>님의 신청이 <span style="font-weight: 600;color: #e63946;">정상적으로 처리</span>되었습니다.
					</div>
					<form name="fm_write" class="" method="post" enctype="multipart/form-data" >
					<input type="hidden" id="hand" name="hand" value="reg">
						<table class="apply_table">
							<thead>
								<tr style="display:none">
									<th scope="cols"></th>
									<th scope="cols"></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<th scope="row">성명</th>
									<td>
										<?php echo get_text($ap['name_kr']) ?>
									</td>
									<th class="tablet_none" style="background: #fff;"></th>
                                    <td class="tablet_none"></td>
								</tr>
								<tr>
									<th scope="row">신청규격</th>
									<td colspan="3">
										<?php echo $iso_standard_arr[$ap['standard']] ?>
									</td>
								</tr>
								<tr>
									<th scope="row">등급</th>
									<td>
										<?php echo $iso_grade_arr[$ap['grade']] ?>
									</td>
									<th scope="row">유형</th>
									<td>
										<?php echo $iso_type_arr[$ap['type']] ?>
									</td>
								</tr>
								<tr>
									<th scope="row">결제금액</th>
									<td>
										<?php echo number_format($ap['price']) ?>원
									</td>
									<th scope="row">결제수단</th>
									<td>
										무통장입금
									</td>
								</tr>
							</tbody>
						</table>
					</form>

					<!-- 입금내역 안내 -->
					<h6 class="content_box_tt content_box_tt2">입금내역 안내</h6>
					<div class="text-box_border">
						입금하실 금액은 <span style="font-weight: 600;"><?php echo number_format($ap['price']) ?>원</span>이며, 입금하실 계좌는 <span style="font-weight: 600;"><?php echo $iso_bank_info ?></span> 입니다.<br>
						입금 확인 후 신청이 완료되며, 입금 후 연락주시면 확인 도와드리겠습니다. (TEL : 02-6749-0710)<br><br>
                        
						발급된 인증번호는 <span style="font-weight: 600;">[<?php echo get_text($ap['od_id']) ?>]</span> 이며 인증번호는 신청 진행상황 조회시 필요합니다.<br>
                        하단 신청진행상황조회 버튼 클릭시 상세내역 조회가 가능합니다.
					</div>

					<div style="text-align:center;">
						<button onclick="javascript:history.back()" class="btn btn-primary back_btn">&lt;&nbsp; 이전으로</button>
						<button onclick="location.href='http://3.36.181.167/#'" class="btn btn-primary">심사원시험</button>
						<button onclick="location.href='http://3.36.181.167/#'" class="btn btn-primary">CPD교육</button>
                        <button type="button" onclick="location.href='./list.php?od_id=<?php echo $od_id ?>'" class="btn btn-primary">신청진행상황조회</button>
                        <a href="/theme/gpcert/apply/apply_apply.php" class="btn">처음으로 &nbsp;&gt;</a>
					</div>
				</div>
				<!-- END : form wrap  -->
			</div>
		</div>
	</div>	
</div>

</body>

<?php
include_once(G5_THEME_PATH.'/tail.php');
?>