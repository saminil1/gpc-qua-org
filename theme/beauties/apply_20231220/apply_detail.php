<?php
include_once('./_common.php');
$g5['title'] = '조회 결과 상세보기';

$od_id = isset($_GET['od_id']) ? preg_replace('/[^0-9]/', '', $_GET['od_id']) : 0;// 주문번호

$sql = " select * from {$g5['iso_apply_table']} where od_id = '{$od_id}' ";	// mb_id = '{$member['mb_id']}' and
$ap = sql_fetch($sql);
if (!$ap['od_id'])
	alert("신청내역이 존재하지 않습니다.");

$address = $ap['zip1'] ? print_address($ap['address1'], $ap['address2'], $ap['address3'], $ap['addr_jibeon']) : '';

include_once(G5_THEME_PATH.'/head.php');
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
                        신청 상세내역
                    </div>
					<!-- 신청내역 안내 -->
					<div>
						<h6 class="content_box_tt">사용자 정보</h6>
						<table class="apply_table">
							<tbody>
								<tr>
									<th scope="row">이름</th>
									<td><?php echo get_text($ap['name_kr']) ?>(<?php echo get_text($ap['name_en']) ?>)</td>
								</tr>
								<tr>
									<th scope="row">연락처</th>
									<td><?php echo get_text($ap['hp']) ?></td>
								</tr>
								<tr>
									<th scope="row">이메일</th>
									<td><?php echo get_text($ap['email']) ?></td>
								</tr>
								<tr>
									<th scope="row">주소</th>
									<td><?php echo $address ?></td>
								</tr>
							</tbody>
						</table>
						<h6 class="content_box_tt">신청 내역</h6>
						<table class="apply_table">
							<tbody>
								<tr>
									<th scope="row">자격구분</th>
									<td><?php echo $iso_standard_arr[$ap['standard']] ?>(<?php echo $iso_grade_arr[$ap['grade']] ?>)</td>
								</tr>
								<tr>
									<th scope="row">신청규격</th>
									<td><?php echo $iso_standard_arr[$ap['standard']] ?></td>
								</tr>
								<tr>
									<th scope="row">신청유형</th>
									<td><?php echo $iso_type_arr[$ap['type']] ?></td>
								</tr>
								<tr>
									<th scope="row">등급</th>
									<td><?php echo $iso_grade_arr[$ap['grade']] ?></td>
								</tr>
								<tr>
									<th scope="row">인증번호</th>
									<td><?php echo get_text($ap['od_id']) ?></td>
								</tr>
								<tr>
									<th scope="row">신청일</th>
									<td><?php echo substr($ap['datetime'], 0, 10) ?></td>
								</tr>
								<tr>
									<th scope="row">진행상황</th>
									<td><?php echo $iso_state_arr[$ap['state']] ?></td>
								</tr>
								<tr>
									<th scope="row">결제금액</th>
									<td><?php echo number_format($ap['price']) ?>원</td>
								</tr>
							</tbody>
						</table>
                        <div style="text-align:center;">
							<button onclick="javascript:history.back()" class="btn btn-primary back_btn">&lt;&nbsp; 이전으로</button>
							<button type="button" onclick="location.href=''" class="btn btn-primary">목록보기</button>
                        </div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div> <!--------------------------// class="content_wrap" //------------------------------->

</body>

<?php
include_once(G5_THEME_PATH.'/tail.php');
?>