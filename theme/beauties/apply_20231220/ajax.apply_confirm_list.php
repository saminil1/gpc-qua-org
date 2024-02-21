<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>
	<h6 class="content_box_tt">조회 결과</h6>
	<div id="form01 ">
		<table class="apply_table apply_table_horizon">
			<colgroup class="tablet_none">
				<col style="width:6%"> <!-- 순서 -->
				<col style="width:22%"> <!-- 신청규격 및 등급 -->
				<col style="width:10%"> <!-- 유형 -->
				<col style="width:16%"> <!-- 인증번호 -->
				<col style="width:10%"> <!-- 이름 -->
				<col style="width:8%"> <!-- 상태 -->
				<col style="width:16%"> <!-- 등록일 -->
				<col style="width:12%"> <!-- 상세보기 -->
			</colgroup>
			<thead class="tablet_none">
				<tr>
					<th scope="col">순서</th>
					<th scope="col">신청규격 및 등급</th>
					<th scope="col">유형</th>
					<th scope="col">인증번호</th>
					<th scope="col">이름</th>
					<th scope="col">상태</th>
					<th scope="col">등록일</th>
					<th scope="col">상세보기</th>
				</tr>
			</thead>
			<tbody>
				<?php
				for ($i=0; $i < $iso_count; $i++) {
					$seq = $i + 1;
				?>
				<tr class="table_list">
					<td class="tablet_none"><?php echo $seq ?></td>
					<td class="iso_label"><?php echo $iso_standard_arr[$iso_arr[$seq]['standard']] ?>(<?php echo $iso_grade_arr[$iso_arr[$seq]['grade']] ?>)<a href="javascript:void(0);" class="mobile-arrow tablet_block"></a></td>
					<td><span class="type_show tablet_block">유형 : </span><?php echo $iso_type_arr[$iso_arr[$seq]['type']] ?></td>
					<td><span class="type_show tablet_block">인증번호 : </span><?php echo $iso_arr[$seq]['od_id'] ?></td>
					<td><span class="type_show tablet_block">신청자 : </span><?php echo $iso_arr[$seq]['name_kr'] ?></td>
					<td><span class="type_show tablet_block">진행상황 : </span><?php echo $iso_state_arr[$iso_arr[$seq]['state']] ?></td>
					<td><span class="type_show tablet_block">등록일 : </span><?php echo $iso_arr[$seq]['datetime'] ?></td>
					<td class="view_button">
						<a href="<?php echo G5_THEME_URL ?>/apply/apply_detail.php?od_id=<?php echo $iso_arr[$seq]['od_id'] ?>">
							<span class="btn btn-primary btn-view" style="margin: 0;line-height: 32px;padding: 0 12px;">상세보기</span>
						</a>
					</td>
				</tr>
				<?php } ?>
				<?php if($i == 0) echo '<tr class="list_type01"><td colspan="8">신청내역이 존재하지 않습니다.</td></tr>'; ?>
			</tbody>
		</table>
		<?php if($iso_mode != 'login') { ?>
		<div style="text-align:center;">
			<button onclick="javascript:history.back()" class="btn btn-primary back_btn">&lt;&nbsp; 이전으로</button>
			<button type="button" onclick="location.href=''" class="btn btn-primary">목록보기</button>
		</div>
		<?php } ?>
	</div>	