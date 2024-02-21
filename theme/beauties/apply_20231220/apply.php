<?php
include_once('./_common.php');

$od_id			= isset($_POST['od_id']) ? preg_replace('/[^0-9]/', '', $_POST['od_id']) : 0;// 주문번호
//$iso_standard	= (isset($_POST['iso_standard']) && in_array($_POST['iso_standard'], $iso_standard_arr)) ? $_POST['iso_standard'] : '';
//$iso_grade		= (isset($_POST['iso_grade']) && in_array($_POST['iso_grade'], $iso_grade_arr)) ? $_POST['iso_grade'] : '';
//$iso_type		= (isset($_POST['iso_type']) && in_array($_POST['iso_type'], $iso_type_arr)) ? $_POST['iso_type'] : '';
$standard	= (isset($_POST['iso_standard']) && $iso_standard_arr[$_POST['iso_standard']]) ? $_POST['iso_standard'] : '';
$grade		= (isset($_POST['iso_grade']) && $iso_grade_arr[$_POST['iso_grade']]) ? $_POST['iso_grade'] : '';
$type		= (isset($_POST['iso_type']) && $iso_type_arr[$_POST['iso_type']]) ? $_POST['iso_type'] : '';

if (!get_session('ss_apply_'.$od_id))
    alert('잘못된 접근입니다.', G5_THEME_URL.'/apply/apply_apply.php');

if (!$iso_standard)
    alert('잘못된 접근입니다.', G5_THEME_URL.'/apply/apply_apply.php');

if (!$iso_grade)
    alert('잘못된 접근입니다.', G5_THEME_URL.'/apply/apply_apply.php');

if (!$iso_type)
    alert('잘못된 접근입니다.', G5_THEME_URL.'/apply/apply_apply.php');

if($is_member) {// 회원로그인 후 접근이라면 신청규격이 중복으로 존재하는지 판단
	$sql = " select * from {$g5['iso_apply_table']} where mb_id = '{$member['mb_id']}' and standard = '{$iso_standard}' ";
	$iso = sql_fetch($sql);
	if ($iso['ia_no']) {
		alert('회원님은 이미 신청한 규격 내역이 존재합니다.\n상태 : '.$iso_state_arr[$iso['state']], G5_THEME_URL.'/apply/apply_apply.php');//, G5_URL
	}
}

$g5['title'] = '등록 신청';
include_once(G5_THEME_PATH.'/head.php');
add_javascript(G5_POSTCODE_JS, 0);    //다음 주소 js
add_javascript('<script src="'.G5_JS_URL.'/apply.js?ver='.time().'"></script>', 0);
?>

<body>

<div class="content_wrap">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<!-- STRAT : form wrap -->
				<div class="form_wrap">
					<div class="content_tt" style="color:#27323a;">
						신청자 정보 입력
					</div>

					<!-- step navigation -->
					<div class="step_navi">
						<ul>
							<li>
								<p><span>STEP 1.</span>자격정보 입력</p>
							</li>
							<li class="active">
								<p><span>STEP 2.</span>신청자 정보 입력</p>
								<div class="arrow arrow-right"></div>
							</li>
							<li>
								<p><span>STEP 3.</span>등록 신청 완료</p>
							</li>
						</ul>
					</div>

					<!-- 신청자 정보 입력 -->
					<h6 class="content_box_tt content_box_tt2">신청자 정보 입력</h6>
					<form name="fm_write" id="fm_write" method="post" action="<?php echo G5_THEME_URL ?>/apply/apply_update.php" enctype="multipart/form-data">
					<input type="hidden" name="w" value="<?php echo $w ?>" id="w">
					<input type="hidden" name="is_member" value="<?php echo $is_member ?>" id="is_member">
					<input type="hidden" name="standard" value="<?php echo $standard ?>" id="iso_standard">
					<input type="hidden" name="grade" value="<?php echo $grade ?>" id="iso_grade">
					<input type="hidden" name="type" value="<?php echo $type ?>" id="iso_type">
					<input type="hidden" name="od_id" value="<?php echo $od_id ?>" id="od_id">
					
						<table class="apply_table">
							<thead>
								<tr style="display:none">
									<th scope="cols"></th>
									<th scope="cols"></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<th scope="row">신청규격 및 등급</th>
									<td><?php echo $iso_standard_arr[$standard]; ?>(<?php echo $iso_grade_arr[$grade]; ?>)</td>
									<th scope="row">유형</th>
									<td><?php echo $iso_type_arr[$type]; ?></td>
								</tr>
								
								<tr>
									<th scope="row" class="required">이름(한)</th>
									<td>
										<input type="text" name="name_kr" value="<?php echo get_text($member['mb_name']) ?>" id="name_kr" maxlength="20">
									</td>
									<th scope="row" class="required">이름(영)</th>
									<td>
										<input type="text" name="name_en" value="" id="name_en" maxlength="50">
									</td>
								</tr>
								<tr>
									<th scope="row" class="required">핸드폰번호</th>
									<td>
										<input type="text" name="hp" value="<?php echo get_text($member['mb_hp']) ?>" id="hp" maxlength="20">
									</td>
									<th scope="row" class="required">이메일</th>
									<td>
										<input type="text" name="email" value="<?php echo isset($member['mb_email'])?$member['mb_email']:''; ?>" id="email" class="maxlength70" maxlength="100">
										<!--
										<input type="text" id="email" class="maxlength70" name="email" value="test1@gmail.com">
										<input type="button" onclick="duplicatecheck()" value="중복확인" style="margin-left: 8px;">
										<p class="duplicate_text" style="color: #0086ff;margin: 0;">* 사용 가능한 이메일입니다.</p>
										-->
									</td>
								</tr>
								<?php if(!$is_member) {// 회원은 닉네임과 비밀번호를 받을 필요가 없다. ?>
								<tr>
									<th scope="row" class="required">아이디</th>
									<td colspan="3">
										<input type="text" name="mb_id" value="<?php echo $member['mb_id'] ?>" id="reg_mb_id" class="maxlength70" maxlength="20">
									</td>
									<!--
									<th scope="row" class="required">닉네임</th>
									<td>
										<input type="text" name="mb_nick" value="<?php echo isset($member['mb_nick'])?get_text($member['mb_nick']):''; ?>" id="reg_mb_nick" maxlength="20">
									</td>
									-->
								</tr>
								<tr>
									<th scope="row" class="required">비밀번호</th>
									<td>
										<input type="password" name="mb_password" id="reg_mb_password" minlength="3" maxlength="20">
									</td>
									<th scope="row" class="required">비밀번호 확인</th>
									<td>
										<input type="password" name="mb_password_re" id="reg_mb_password_re" minlength="3" maxlength="20">
									</td>
								</tr>
								<?php } else { ?>
										<input type="hidden" name="mb_id" id="mb_id" value="<?php echo $member['mb_id'] ?>">
								<?php } ?>
								<tr>
									<th scope="row" class="required">수령 주소</th>
									<td colspan='3'>
										<input type="text" name="zipcode" value="<?php echo $member['mb_zip1'].$member['mb_zip2']; ?>" id="zipcode" class="maxlength70" maxlength="6" readonly placeholder="우편번호"> &nbsp;&nbsp;<button type="button" id="btn_zip" class="btn_basic" onclick="win_zip('fm_write', 'zipcode', 'address1', 'address2', 'extraAddress', 'mb_addr_jibeon');">우편번호확인</button> <br>
										<input type="text" name="address1" value="<?php echo get_text($member['mb_addr1']) ?>" id="address1" placeholder="기본주소"> <br>
										<input type="text" name="address2" value="<?php echo get_text($member['mb_addr2']) ?>" id="address2" placeholder="상세주소">
										<input type="text" name="extraAddress" value="<?php echo get_text($member['mb_addr3']) ?>" id="extraAddress" placeholder="참고항목">
										<input type="hidden" name="addr_jibeon" value="<?php echo get_text($member['mb_addr_jibeon']); ?>">
									</td>
								</tr>
								<tr>
									<th scope="row" class="required">제출문서</th>
									<td colspan="3">
										<table class="in_table">
											<colgroup class="tablet_none">
												<col style="width:30%"> <!-- 구분 -->
												<col style="width:45%"> <!-- 비고 -->
												<col style="width:25%"> <!-- 다운로드 -->
											</colgroup>
											<tbody style="border-top: 1px solid #ddd;">
												<tr>
													<td colspan='3' style="font-weight:600;"><?php echo $iso_standard_arr[$standard]; ?>(<?php echo $iso_grade_arr[$grade]; ?>)</td>
												</tr>
												<tr>
													<td class="bd_right">이력서</td>
													<td class="bd_right">
														<label><input type="checkbox" name="doc_chk_01" value="Y" id="doc_chk_01"> 실무경력포함</label>
													</td>
													<td>
														<div class="btn_download">
															<a href="/data/apply/empty.xlsx" download>다운로드 <i class="fas fa-download"></i></a>
														</div>
													</td>
												</tr>
												<tr>
													<td class="bd_right">심사일지</td>
													<td class="bd_right">
														<label><input type="checkbox" name="doc_chk_02" value="Y" id="doc_chk_02"> 심사원 5맨데이, 선임 8맨데이</label>
													</td>
													<td>
														<div class="btn_download">
															<a href="/data/apply/empty.xlsx" download>다운로드 <i class="fas fa-download"></i></a>
														</div>
													</td>
												</tr>
												<tr>
													<td class="bd_right">교육훈련수료증</td>
													<td class="bd_right">
														<label><input type="checkbox" name="doc_chk_03" value="Y" id="doc_chk_03"> 교육수료</label>
													</td>
													<td>

													</td>
												</tr>
												<tr>
													<td class="bd_right">학력증명서</td>
													<td class="bd_right">
														<label><input type="checkbox" name="doc_chk_04" value="Y" id="doc_chk_04"> 고등학교졸업이상</label>
													</td>
													<td>

													</td>
												</tr>
											</tbody>
										</table>
										<div class="comment">
											<p>※ GPC에서 제공하는 양식을 다운로드하여 작성 후 그 외의 제출서류와 함께 첨부해주세요.</p>
											<p>※ 파일은 압축하여 하나의 파일로 업로드하여 주시기 바랍니다. 서류가 누락될 경우 신청이 지연될 수 있습니다.</p>
											<p>※ 파일첨부시 파일명을 변경해주세요. 예)최초인증_홍길동(생년월일)</p>
										</div>
									</td>
								</tr>
								<?php for ($i=1; $i<=1; $i++) { ?>
								<tr>
									<th scope="row">파일업로드</th>
									<td colspan="3">
										<input type="file" name="up_file[<?php echo $i; ?>]" id="up_file_<?php echo $i ?>" title="파일첨부 <?php echo $i ?> : 용량 <?php echo $iso_upload_size ?> 바이트 이하만 업로드 가능" class="form-control-file" accept="">
									</td>
								</tr>
								<?php } ?>
								<tr>
									<th scope="row">비용(부가세포함)</th>
									<td colspan="3">
										<?php foreach($iso_price_arr as $key => $val) { ?>
										<label for="price_<?php echo $key ?>" class="type_radio"><input type="radio" name="price" value="<?php echo $key ?>" id="price_<?php echo $key ?>" <?php echo get_checked($key, $price); ?>> <?php echo $val ?> 원 </label>
										<?php } ?>
									</td>
								</tr>
								<tr>
									<th scope="row">결제수단</th>
									<td colspan="3">
										<strong style="font-weight: 600;"><?php echo $iso_bank_info ?></strong>
									</td>
								</tr>
								<tr>
									<th scope="row">현금영수증</th>
									<td colspan="3">
										<ul class="chk_recpt">
											<li class="custom-control custom-checkbox">
												<?php foreach($iso_cash_receipt_arr as $key => $val) { ?>
												<label for="app_way_<?php echo $key ?>" class="type_radio"><input type="radio" name="app_way" value="<?php echo $key ?>" id="app_way_<?php echo $key ?>" <?php echo get_checked($key, $app_way); ?>> <?php echo $val ?> </label>
												<?php } ?>
											</li>
											<input type="text" name="app_info" value="" id="app_info" class="custom-control-input-text" style="margin-top:10px;" disabled="disabled" placeholder="발행 연락처">
										</ul>
									</td>
								</tr>
								<tr>
									<th scope="row">요청사항</th>
									<td colspan="3">
										<form>
											<textarea name="req_memo" id="req_memo" wrap="virtual" style="width: 100%;min-height: 100px;border: 1px solid #ddd;"></textarea>
										</form>
									</td>
								</tr>
							</tbody>
						</table>
						<div>
							<h6 class="content_box_tt content_box_tt2">자격인증 프로세스</h6>
							<div class="cert_process_box">
								<ul>
									<li>
										신청서류 접수<span>(신청비 납부)</span>
										<span class="arrow-next"></span>
									</li>
									<li>
										제출서류 검토<span>(검토후 보완요청)</span>
										<span class="arrow-next"></span>
									</li>
									<li>
										인증심의<span>(검토후 보완요청)</span>
										<span class="arrow-next"></span>
									</li>
									<li>
										인증승인<span>&nbsp;</span>
										<span class="arrow-next"></span>
									</li>
									<li>
										연회비 납부<span>(인증서/카드 신청)</span>
										<span class="arrow-next"></span>
									</li>
									<li>
										수령처로 발송<span>&nbsp;</span>
									</li>
								</ul>
							</div>
						</div>
						<div>
							<h6 class="content_box_tt content_box_tt2">
								개인정보 이용약관<span class="c-txt">서비스 이용을 위해 아래 이용약관 및 개인정보 수집에 동의해 주세요.</span>
							</h6>
						</div>

						<div class="acc-lst" style="border-top: 1px solid #000;">
							<div class="acc-item" style="border-bottom: 1px solid #e5e5e5;">
								<div class="tit-box">
									<div class="chk-area terms__check__all">
										<span class="chkBox"><input type="checkbox" name="checkAll" id="checkAll"><span class="chk_icon"></span></span>
										<label for="checkAll" class="label"><span class="txt">전체동의</span></label>
									</div>
								</div>
							</div>

							<div class="acc-item" style="border-bottom: 1px solid #e5e5e5;">
								<div class="tit-box">
									<div class="chk-area input__check">
										<span class="chkBox"><input type="checkbox"  name="agreement" id="termsOfService" value="termsOfService" required><span class="chk_icon"></span></span>
										<label for="termsOfService" class="label"><span class="txt">이용약관 <em class="txt-comp">(필수)</em></span></label>
									</div>
									<button type="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample" class="btn-acc serVice">열기</button>
								</div>
								<div class="acc-layer service collapse" id="collapseExample">
									<div style="padding: 3rem;">
										제 1장 총칙
										<br><br>
										제 1 조(목적)
										본 약관은 (주)지피씨인증원 웹사이트(이하 "(주)지피씨인증원")가 제공하는 모든 서비스(이하 "서비스")의 이용조건 및 절차, 회원과 (주)지피씨인증원의 권리, 의무, 책임사항과 기타 필요한 사항을 규정함을 목적으로 합니다.
										<br><br>
										제 2 조(약관의 효력과 변경)
										1. (주)지피씨인증원은 이용자가 본 약관 내용에 동의하는 경우, (주)지피씨인증원의 서비스 제공 행위 및 회원의 서비스 사용 행위에 본 약관이 우선적으로 적용됩니다.
										2. (주)지피씨인증원은 약관을 개정할 경우, 적용일자 및 개정사유를 명시하여 현행약관과 함께 (주)지피씨인증원의 초기화면에 그 적용일 7일 이전부터 적용 전일까지 공지합니다. 단, 회원에 불리하게 약관내용을 변경하는 경우에는 최소한 30일 이상의 사전 유예기간을 두고 공지합니다. 이 경우 (주)지피씨인증원은 개정 전 내용과 개정 후 내용을 명확하게 비교하여 회원이 알기 쉽도록 표시합니다.
										3. 변경된 약관은 (주)지피씨인증원 홈페이지에 공지하거나 e-mail을 통해 회원에게 공지하며, 약관의 부칙에 명시된 날부터 그 효력이 발생됩니다. 회원이 변경된 약관에 동의하지 않는 경우, 회원은 본인의 회원등록을 취소(회원탈퇴)할 수 있으며, 변경된 약관의 효력 발생일로부터 7일 이내에 거부의사를 표시하지 아니하고 서비스를 계속 사용할 경우는 약관 변경에 대한 동의로 간주됩니다.
										<br><br>
										제 3 조(약관 외 준칙)
										본 약관에 명시되지 않은 사항은 전기통신기본법, 전기통신사업법, 정보통신윤리위원회심의규정, 정보통신 윤리강령, 프로그램보호법 및 기타 관련 법령의 규정에 의합니다.
										<br><br>
										제 4 조(용어의 정의)
										본 약관에서 사용하는 용어의 정의는 다음과 같습니다.
										1. 이용자 : 본 약관에 따라 (주)지피씨인증원이 제공하는 서비스를 받는 자
										2. 가입 : (주)지피씨인증원이 제공하는 신청서 양식에 해당 정보를 기입하고, 본 약관에 동의하여 서비스 이용계약을 완료시키는 행위
										3. 회원 : (주)지피씨인증원에 개인 정보를 제공하여 회원 등록을 한 자로서 (주)지피씨인증원이 제공하는 서비스를 이용할 수 있는 자
										4. 계정(ID) : 회원의 식별과 회원의 서비스 이용을 위하여 회원이 선정하고 (주)지피씨인증원에서 부여하는 문자와 숫자의 조합
										5. 비밀번호 : 회원과 계정이 일치하는지를 확인하고 통신상의 자신의 비밀보호를 위하여 회원 자신이 선정한 문자와 숫자의 조합
										6. 탈퇴 : 회원이 이용계약을 종료시키는 행위
										7. 본 약관에서 정의하지 않은 용어는 개별서비스에 대한 별도 약관 및 이용규정에서 정의합니다.
										<br><br>
										제 2장 서비스 제공 및 이용
										<br><br>
										제 5 조 (이용계약의 성립)
										1. 이용계약은 이용자가 온라인으로 (주)지피씨인증원에서 제공하는 소정의 가입신청 양식에서 요구하는 사항을 기록하여 가입을 완료하는 것으로 성립됩니다.
										2. (주)지피씨인증원은 다음 각 호에 해당하는 이용계약에 대하여는 가입을 취소할 수 있습니다.
										1) 다른 사람의 명의를 사용하여 신청하였을 때
										2) 이용계약 신청서의 내용을 허위로 기재하였거나 신청하였을 때
										3) 다른 사람의 (주)지피씨인증원 서비스 이용을 방해하거나 그 정보를 도용하는 등의 행위를 하였을 때
										4) (주)지피씨인증원을 이용하여 법령과 본 약관이 금지하는 행위를 하는 경우
										5) 기타 (주)지피씨인증원이 정한 이용신청요건이 미비 되었을 때
										<br><br>
										제 6 조 (회원정보 사용에 대한 동의)
										1. 회원의 개인정보는 「공공기관의개인정보보호에관한법률」에 의해 보호됩니다.
										2. (주)지피씨인증원의 회원 정보는 다음과 같이 사용, 관리, 보호됩니다.
										1) 개인정보의 사용 : (주)지피씨인증원는 서비스 제공과 관련해서 수집된 회원의 신상정보를 본인의 승낙 없이 제3자에게 누설, 배포하지 않습 니다. 단, 전기통신기본법 등 법률의 규정에 의해 국가기관의 요구가 있는 경우, 범죄에 대한 수사상의 목적이 있거나 정보통신윤리위원회의 요청이 있는 경우 또는 기타 관계법령에서 정한 절차에 따른 요청이 있는 경우, 이용자 스스로 개인정보를 공개한 경우에는 그러 하지 않습니다.
										2) 개인정보의 관리 : 회원은 개인정보의 보호 및 관리를 위하여 서비스의 개인정보관리에서 수시로 회원의 개인정보를 수정/삭제할 수 있습니다.
										3) 개인정보의 보호 : 회원의 개인정보는 오직 본인만이 열람/수정/삭제 할 수 있으며, 이는 전적으로 회원의 계정과 비밀번호에 의해 관리되고 있습니다. 따라서 타인에게 본인의 계정과 비밀번호를 알려주어서는 안되며, 작업 종료시에는 반드시 로그아웃해 주시기 바랍니다.
										3. 회원이 본 약관에 따라 이용신청을 하는 것은, (주)인증원의 신청서에 기재된 회원정보를 수집, 이용하는 것에 동의하는 것으로 간주 됩니다.
										<br><br>
										제 7 조 (사용자의 정보 보안)
										1. 이용자는 (주)지피씨지아이씨인증원 서비스 가입 절차를 완료하는 순간부터 본인이 입력한 정보의 비밀을 유지할 책임이 있으며, 회원이 고의나 중대한 실수로 회원의 계정과 비밀번호를 사용하여 발생한 피해에 대한 책임은 회원 본인에게 있습니다.
										2. 계정과 비밀번호에 관한 모든 관리의 책임은 회원에게 있으며, 회원의 계정이나 비밀번호가 부정하게 사용되었다는 사실을 발견한 경우에는 즉시 (주)지피씨인증원에 신고하여야 합니다. 신고를 하지 않음으로 인한 모든 책임은 회원 본인에게 있습니다.
										3. 이용자는 (주)지피씨인증원 서비스의 사용 종료시마다 정확히 접속을 종료해야 하며, 정확히 종료하지 아니함으로써 제3자가 이용자에 관한 정보를 이용하게 되는 등의 결과로 인해 발생하는 손해 및 손실에 대하여 (주)지피씨인증원은 책임을 부담하지 아니합니다.
										<br><br>
										제 8 조 (서비스의 변경)
										1. 당 사이트는 귀하가 서비스를 이용하여 기대하는 손익이나 서비스를 통하여 얻은 자료로 인한 손해에 관하여 책임을 지지 않으며, 회원이 본 서비스에 게재한 정보, 자료, 사실의 신뢰도, 정확성 등 내용에 관하여는 책임을 지지 않습니다.
										2. 당 사이트는 서비스 이용과 관련하여 가입자에게 발생한 손해 중 가입자의 고의,과실에 의한 손해에 대하여 책임을 부담하지 아니합니다.
										<br><br>
										제 9 조 (이용기간 및 자격의 정지 및 상실)
										1. (주)지피씨인증원 회원이용기간은 조직통폐합에 따른 불가항력을 제외하고 회원신청에서 탈퇴까지로 합니다.
										2. (주)지피씨인증원은 이용자가 본 약관에 명시된 내용을 위배하는 행동을 한 경우, 이용자격을 일시적으로 정지하고 30일 이내에 시정하도록 이용자에게 요구할 수 있으며, 이후 동일한 행위를 2회 이상 반복할 경우에 30일간의 소명기회를 부여한 후 이용자격을 상실시킬 수 있습니다.
										3. (주)지피씨인증원 회원이 신청 후 12개월이상 장시간 이용하지 않은 회원은 휴면아이디로 분류하여, 자격 정지 및 상실이 가능합니다.
										<br><br>
										제 10 조 (계약해제, 해지 등)
										1. 회원은 언제든지 서비스 초기화면의 마이페이지 또는 정보수정 메뉴 등을 통하여 이용계약 해지 신청을 할 수 있으며, (주)지피씨인증원은 관련법 등이 정하는 바에 따라 이를 즉시 처리하여야 합니다.
										2. 회원이 계약을 해지할 경우, 관련법 및 개인정보취급방침에 따라 (주)지피씨인증원이 회원정보를 보유하는 경우를 제외하고는 해지 즉시 회원의 모든 데이터는 소멸됩니다.
										3. 회원이 계약을 해지하는 경우, 회원이 작성한 게시물 중 블로그 등과 같이 본인 계정에 등록된 게시물 일체는 삭제됩니다. 단, 타인에 의해 스크랩 되어 재게시되거나, 공용게시판에 등록된 게시물 등은 삭제되지 않으니 사전에 삭제 후 탈퇴하시기 바랍니다.
										<br><br>
										제 11 조 (게시물의 저작권)
										1. 이용자가 게시한 게시물의 저작권은 이용자가 소유하며, (주)지피씨인증원는 서비스 내에 이를 게시할 수 있는 권리를 갖습니다.
										2. (주)지피씨인증원은 다음 각 호에 해당하는 게시물이나 자료를 사전통지 없이 삭제하거나 이동 또는 등록 거부를 할 수 있습니다.
										1) 본서비스 약관에 위배되거나 상용 또는 불법, 음란, 저속하다고 판단되는 게시물을 게시한 경우
										2) 다른 회원 또는 제 3자에게 심한 모욕을 주거나 명예를 손상시키는 내용인 경우
										3) 공공질서 및 미풍양속에 위반되는 내용을 유포하거나 링크시키는 경우
										4) 불법복제 또는 해킹을 조장하는 내용인 경우
										5) 영리를 목적으로 하는 광고일 경우
										6) 범죄와 결부된다고 객관적으로 인정되는 내용일 경우
										7) 다른 이용자 또는 제 3자의 저작권 등 기타 권리를 침해하는 내용인 경우
										8) (주)지피씨인증원에서 규정한 게시물 원칙에 어긋나거나, 게시판 성격에 부합하지 않는 경우
										9) 기타 관계법령에 위배된다고 판단되는 경우
										3. 이용자의 게시물이 타인의 저작권을 침해함으로써 발생하는 민, 형사상의 책임은 전적으로 이용자가 부담하여야 합니다.
										<br><br>
										제 3장 의무 및 책임
										<br><br>
										제 12 조 ((주)지피씨인증원의 의무)
										1. (주)지피씨인증원은 회원의 개인 신상 정보를 본인의 승낙없이 타인에게 누설, 배포하지 않습니다. 단, 전기통신관련법령 등 관계법령에 의하여 관계 국가기관 등의 요구가 있는 경우에는 그러하지 아니합니다.
										2. (주)지피씨인증원은 법령과 본 약관이 금지하거나 미풍양속에 반하는 행위를 하지 않으며, 지속적·안정적으로 서비스를 제공하기 위해 노력 할 의무가 있습니다.
										3. (주)지피씨인증원은 이용자의 귀책사유로 인한 서비스 이용 장애에 대하여 책임을 지지 않습니다.
										<br><br>
										제 13 조 (회원의 의무)
										1. 회원 가입시에 요구되는 정보는 정확하게 기입하여야 합니다. 또한 이미 제공된 회원에 대한 정보가 정확한 정보가 되도록 유지, 갱신하여야 하며, 회원은 자신의 계정 및 비밀번호를 제3자에게 이용하게 해서는 안됩니다.
										2. 회원은 (주)지피씨인증원의 사전 승낙없이 서비스를 이용하여 어떠한 영리행위도 할 수 없으며, 그 영업활동의 결과에 대해 (주)지피씨인증원은 일절 책임을 지지 않습니다. 또한 회원은 이와 같은 영업활동으로 (주)지피씨인증원이 손해를 입은 경우 손해배상의무를 지며, (주)지피씨인증원은 해당 회원에 대해 서비스 이용제한 및 적법한 절차를 거쳐 손해배상 등을 청구할 수 있습니다.
										3. 회원은 (주)지피씨인증원 서비스 이용과 관련하여 다음 각 호의 행위를 하여서는 안됩니다.
										1) 회원가입 신청 또는 회원정보 변경 시 허위내용을 기재하거나 다른 회원의 비밀번호와 ID를 도용하여 부정 사용하는 행위
										2) 저속, 음란, 모욕적, 위협적이거나 타인의 Privacy를 침해할 수 있는 내용을 전송, 게시, 게재, 전자우편 또는 기타의 방법으로 전송하는 행위
										3) (주)지피씨인증원 운영진, 직원 또는 관계자를 사칭하는 행위
										4) 서비스를 통하여 전송된 내용의 출처를 위장하는 행위
										5) 법률, 계약에 의해 이용할 수 없는 내용을 게시, 게재, 전자우편 또는 기타의 방법으로 전송하는 행위
										6) 서버 해킹 및 컴퓨터바이러스 유포, 웹사이트 또는 게시된 정보의 일부분 또는 전체를 임의로 변경하는 행위
										7) 타인의 특허, 상표, 영업비밀, 저작권, 기타 지적재산권을 침해하는 내용을 게시, 게재, 전자우편 또는 기타의 방법으로 전송하는 행위
										8) (주)지피씨인증원의 승인을 받지 아니한 광고, 판촉물, 스팸메일, 행운의 편지, 피라미드 조직 기타 다른 형태의 권유를 게시, 게재, 전자우편 또는 기타의 방법으로 전송하는 행위
										9) 다른 사용자의 개인정보를 수집, 저장, 공개하는 행위
										10) 범죄행위를 목적으로 하거나 기타 범죄행위와 관련된 행위
										11) 선량한 풍속, 기타 사회질서를 해하는 행위
										12) 타인의 명예를 훼손하거나 모욕하는 행위
										13) 타인의 지적재산권 등의 권리를 침해하는 행위
										14) 타인의 의사에 반하여 광고성 정보 등 일정한 내용을 지속적으로 전송하는 행위
										15) 서비스의 안정적인 운영에 지장을 주거나 줄 우려가 있는 일체의 행위
										16) 본 약관을 포함하여 기타 (주)지피씨인증원이 정한 제반 규정 또는 이용 조건을 위반하는 행위
										17) 기타 관계법령에 위배되는 행위
										<br><br>
										제 4장 기타
										<br><br>
										제 14 조 (양도금지)
										회원이 서비스의 이용권한, 기타 이용계약 상 지위를 타인에게 양도, 증여할 수 없습니다.
										<br><br>
										제 15조 (면책조항)
										1. (주)지피씨인증원은 서비스 이용과 관련하여 이용자에게 발생한 손해에 대하여 (주)지피씨인증원의 중대한 과실, 고의 또는 범죄행위로 인해 발생한 손해를 제외하고 이에 대하여 책임을 부담하지 않으며, 이용자가 본 서비스에 게재한 정보, 자료, 사실의 신뢰도, 정확성 등 내용에 관하여는 책임을 지지 않습니다.
										2. (주)지피씨인증원은 서비스 이용과 관련하여 이용자에게 발생한 손해 중 이용자의 고의, 실수에 의한 손해에 대하여 책임을 부담하지 아니합니다.
										3. (주)지피씨인증원은 이용자간 또는 이용자와 제3자간에 서비스를 매개로 하여 물품거래 혹은 금전적 거래 등과 관련하여 어떠한 책임도 부담하지 아니하고, 이용자가 서비스의 이용과 관련하여 기대하는 이익에 관하여 책임을 부담하지 않습니다.
										<br><br>
										제 16 조 (재판관할)
										(주)지피씨인증원과 이용자간에 발생한 서비스 이용에 관한 분쟁에 대하여는 대한민국 법을 적용하며, 본 분쟁으로 인한 소는 민사소송법상의 관할법원에 제기합니다.
										<br><br>
										부 칙 1. (시행일) 본 약관은 2016년 1월 1일부터 시행됩니다.
									</div>   
								</div>
							</div>

							<div class="acc-item" style="border-bottom: 1px solid #e5e5e5;">
								<div class="tit-box">
									<div class="chk-area input__check">
										<span class="chkBox"><input type="checkbox" name="agreement" id="privacyPolicy" value="privacyPolicy" required><span class="chk_icon"></span></span>
										<label for="privacyPolicy" class="label"><span class="txt">개인정보취급방침 <em class="txt-comp">(필수)</em></span></label>
									</div>
									<button type="button" data-toggle="collapse" href="#collapseExample2" aria-expanded="false" aria-controls="collapseExample2" class="btn-acc poliCy">열기</button>
								</div>
								<div class="acc-layer policy collapse" id="collapseExample2">
									<div style="padding: 3rem;">
										&lt;(주)지피씨인증원&gt;('gpcert.org'이하 '(주)지피씨인증원')은(는) 개인정보보호법에 따라 이용자의 개인정보 보호 및 권익을 보호하고 개인정보와 관련한 이용자의 고충을 원활하게 처리할 수 있도록 다음과 같은 처리방침을 두고 있습니다.<br><br>
										&lt;(주)지피씨인증원&gt;('(주)지피씨인증원') 은(는) 회사는 개인정보처리방침을 개정하는 경우 웹사이트 공지사항(또는 개별공지)을 통하여 공지할 것입니다.<br><br>
										• 본 방침은부터 2008년 1월 1일부터 시행됩니다.
										<br><br>
										1. 개인정보의 처리 목적
										<br><br>
										&lt;(주)지피씨인증원&gt;('gpcert.org'이하 '(주)지피씨인증원')은(는) 개인정보를 다음의 목적을 위해 처리합니다. 처리한 개인정보는 다음의 목적이외의 용도로는 사용되지 않으며 이용 목적이 변경될 시에는 사전동의를 구할 예정입니다.
										<br><br>
										가. 홈페이지 회원가입 및 관리
										<br><br>
										회원 가입의사 확인, 회원제 서비스 제공에 따른 본인 식별·인증, 회원자격 유지·관리, 제한적 본인확인제 시행에 따른 본인확인, 서비스 부정이용 방지, 만14세 미만 아동 개인정보 수집 시 법정대리인 동의 여부 확인, 각종 고지·통지, 고충처리, 분쟁 조정을 위한 기록 보존 등을 목적으로 개인정보를 처리합니다.
										<br><br>
										나. 민원사무 처리
										<br><br>
										민원인의 신원 확인, 민원사항 확인, 사실조사를 위한 연락·통지, 처리결과 통보 등을 목적으로 개인정보를 처리합니다.
										<br><br>
										다. 마케팅 및 광고에의 활용
										<br><br>
										신규 서비스(제품) 개발 및 맞춤 서비스 제공, 이벤트 및 광고성 정보 제공 및 참여기회 제공 , 인구통계학적 특성에 따른 서비스 제공 및 광고 게재 , 서비스의 유효성 확인, 접속빈도 파악 또는 회원의 서비스 이용에 대한 통계 등을 목적으로 개인정보를 처리합니다.
										<br><br>
										라. 개인영상정보
										<br><br>
										범죄의 예방 및 수사, 시설안전 및 화재예방, 교통단속, 교통정보의 수집·분석 및 제공 등을 목적으로 개인정보를 처리합니다.
										<br><br>
										2. 개인정보 파일 현황
										<br><br>
										(1) 개인정보 파일명 : 개인정보처리방침
										- 개인정보 항목 : 이메일, 휴대전화번호, 자택주소, 비밀번호 질문과 답, 비밀번호, 로그인ID, 성별, 이름, 회사전화번호, 직책, 부서, 회사명, 직업, 신체정보, 학력, 주민등록번호, 신용카드정보, 은행계좌정보, 서비스 이용 기록, 접속 로그, 쿠키, 접속 IP 정보
										- 수집방법 : 홈페이지, 서면양식, 전화/팩스, 경품행사, 제휴사로부터 제공 받음, 생성정보 수집 툴을 통한 수집
										- 보유근거 : 고객관리
										- 보유기간 : 5년
										- 관련법령 : 신용정보의 수집/처리 및 이용 등에 관한 기록 : 3년, 소비자의 불만 또는 분쟁처리에 관한 기록 : 3년, 대금결제 및 재화 등의 공급에 관한 기록 : 5년, 계약 또는 청약철회 등에 관한 기록 : 5년, 표시/광고에 관한 기록 : 6개월
										<br><br>
										3. 개인정보의 처리 및 보유 기간
										<br><br>
										① &lt;(주)지피씨인증원&gt;('(주)지피씨인증원')은(는) 법령에 따른 개인정보 보유·이용기간 또는 정보주체로부터 개인정보를 수집시에 동의 받은 개인정보 보유,이용기간 내에서 개인정보를 처리,보유합니다.
										② 각각의 개인정보 처리 및 보유 기간은 다음과 같습니다.
										<br><br>
										(1) &lt;홈페이지 회원가입 및 관리&gt;
										<br><br>
										&lt;홈페이지 회원가입 및 관리&gt;와 관련한 개인정보는 수집.이용에 관한 동의일로부터&lt;3년&gt;까지 위 이용목적을 위하여 보유.이용됩니다.
										- 보유근거 : 고객관리
										- 관련법령 :
										1) 신용정보의 수집/처리 및 이용 등에 관한 기록 : 3년
										2) 소비자의 불만 또는 분쟁처리에 관한 기록 : 3년
										3) 대금결제 및 재화 등의 공급에 관한 기록 : 5년
										4) 계약 또는 청약철회 등에 관한 기록 : 5년
										5) 표시/광고에 관한 기록 : 6개월
										-예외사유 :
										<br><br>
										4. 개인정보의 제3자 제공에 관한 사항
										<br><br>
										① &lt;(주)지피씨인증원&gt;('gpcert.org'이하 '(주)지피씨인증원')은(는) 정보주체의 동의, 법률의 특별한 규정 등 개인정보 보호법 제17조 및 제18조에 해당하는 경우에만 개인정보를 제3자에게 제공합니다.
										② &lt;(주)지피씨인증원&gt;(gpcert.org')은(는) 다음과 같이 개인정보를 제3자에게 제공하고 있습니다.
										<br><br>
										(1) &lt;(주)지피씨인증원&gt;
										<br><br>
										- 개인정보를 제공받는 자 : (주)지피씨인증원
										- 제공받는 자의 개인정보 이용목적 : 이메일, 휴대전화번호, 자택주소, 비밀번호 질문과 답, 비밀번호, 로그인ID, 성별, 생년월일, 이름, 회사전화번호, 직책, 부서, 회사명, 직업, 학력, 주민등록번호, 서비스 이용 기록, 접속 로그, 쿠키, 접속 IP 정보
										- 제공받는 자의 보유.이용기간: 3년
										<br><br>
										5. 개인정보처리 위탁
										<br><br>
										① &lt;(주)지피씨인증원&gt;('(주)지피씨인증원')은(는) 원활한 개인정보 업무처리를 위하여 다음과 같이 개인정보 처리업무를 위탁하고 있습니다.
										<br><br>
										(1) &lt;(주)지피씨인증원&gt;
										<br><br>
										- 위탁받는 자 (수탁자) : 정보제공
										- 위탁하는 업무의 내용 : 회원제 서비스 이용에 따른 본인확인, 불만처리 등 민원처리, 고지사항 전달, 신규 서비스(제품) 개발 및 맞춤 서비스 제공, 이벤트 및 광고성 정보 제공 및 참여기회 제공, 영상정보처리기기 운영
										- 위탁기간 : 3년
										② &lt;(주)지피씨인증원&gt;('gpcert.org'이하 '(주)지피씨인증원')은(는) 위탁계약 체결시 개인정보 보호법 제25조에 따라 위탁업무 수행목적 외 개인정보 처리금지, 기술적․관리적 보호조치, 재위탁 제한, 수탁자에 대한 관리․감독, 손해배상 등 책임에 관한 사항을 계약서 등 문서에 명시하고, 수탁자가 개인정보를 안전하게 처리하는지를 감독하고 있습니다.
										③ 위탁업무의 내용이나 수탁자가 변경될 경우에는 지체없이 본 개인정보 처리방침을 통하여 공개하도록 하겠습니다.
										<br><br>
										6. 정보주체와 법정대리인의 권리·의무 및 그 행사방법 이용자는 개인정보주체로써 다음과 같은 권리를 행사할 수 있습니다.
										<br><br>
										① 정보주체는 (주)지피씨인증원에 대해 언제든지 개인정보 열람,정정,삭제,처리정지 요구 등의 권리를 행사할 수 있습니다.
										② 제1항에 따른 권리 행사는(주)지피씨인증원에 대해 개인정보 보호법 시행령 제41조제1항에 따라 서면, 전자우편, 모사전송(FAX) 등을 통하여 하실 수 있으며 (주)지피씨인증원은(는) 이에 대해 지체 없이 조치하겠습니다.
										③ 제1항에 따른 권리 행사는 정보주체의 법정대리인이나 위임을 받은 자 등 대리인을 통하여 하실 수 있습니다. 이 경우 개인정보 보호법 시행규칙 별지 제11호 서식에 따른 위임장을 제출하셔야 합니다.
										④ 개인정보 열람 및 처리정지 요구는 개인정보보호법 제35조 제5항, 제37조 제2항에 의하여 정보주체의 권리가 제한 될 수 있습니다.
										⑤ 개인정보의 정정 및 삭제 요구는 다른 법령에서 그 개인정보가 수집 대상으로 명시되어 있는 경우에는 그 삭제를 요구할 수 없습니다.
										⑥ (주)지피씨인증원은(는) 정보주체 권리에 따른 열람의 요구, 정정·삭제의 요구, 처리정지의 요구 시 열람 등 요구를 한 자가 본인이거나 정당한 대리인인지를 확인합니다.
										<br><br>
										7. 처리하는 개인정보의 항목 작성
										<br><br>
										① &lt;(주)지피씨인증원&gt;('gpcert.org'이하 '(주)지피씨인증원')은(는) 다음의 개인정보 항목을 처리하고 있습니다.
										1.&lt;홈페이지 회원가입 및 관리&gt;
										<br><br>
										- 필수항목 : 이메일, 휴대전화번호, 비밀번호, 로그인ID, 서비스 이용 기록, 접속 로그, 쿠키, 접속 IP 정보
										- 선택항목 : 이메일, 휴대전화번호, 자택주소, 자택전화번호, 비밀번호 질문과 답, 비밀번호, 로그인ID, 성별, 생년월일, 이름, 회사전화번호, 직책, 부서, 회사명, 직업
										<br><br>
										8. 개인정보의 파기
										<br><br>
										&lt;(주)지피씨인증원&gt;('(주)지피씨인증원')은(는) 원칙적으로 개인정보 처리목적이 달성된 경우에는 지체없이 해당 개인정보를 파기합니다. 파기의 절차, 기한 및 방법은 다음과 같습니다.
										- 파기절차
										<br><br>
										이용자가 입력한 정보는 목적 달성 후 별도의 DB에 옮겨져(종이의 경우 별도의 서류) 내부 방침 및 기타 관련 법령에 따라 일정기간 저장된 후 혹은 즉시 파기됩니다. 이 때, DB로 옮겨진 개인정보는 법률에 의한 경우가 아니고서는 다른 목적으로 이용되지 않습니다.
										- 파기기한
										<br><br>
										이용자의 개인정보는 개인정보의 보유기간이 경과된 경우에는 보유기간의 종료일로부터 5일 이내에, 개인정보의 처리 목적 달성, 해당 서비스의 폐지, 사업의 종료 등 그 개인정보가 불필요하게 되었을 때에는 개인정보의 처리가 불필요한 것으로 인정되는 날로부터 5일 이내에 그 개인정보를 파기합니다.
										- 파기방법
										<br><br>
										전자적 파일 형태의 정보는 기록을 재생할 수 없는 기술적 방법을 사용합니다.
										종이에 출력된 개인정보는 분쇄기로 분쇄하거나 소각을 통하여 파기합니다.
										<br><br>
										9. 개인정보 자동 수집 장치의 설치•운영 및 거부에 관한 사항
										<br><br>
										① (주)지피씨인증원 은 개별적인 맞춤서비스를 제공하기 위해 이용정보를 저장하고 수시로 불러오는 ‘쿠기(cookie)’를 사용합니다.
										② 쿠키는 웹사이트를 운영하는데 이용되는 서버(http)가 이용자의 컴퓨터 브라우저에게 보내는 소량의 정보이며 이용자들의 PC 컴퓨터내의 하드디스크에 저장되기도 합니다.
										가. 쿠키의 사용 목적 : 이용자가 방문한 각 서비스와 웹 사이트들에 대한 방문 및 이용형태, 인기 검색어, 보안접속 여부, 등을 파악하여 이용자에게 최적화된 정보 제공을 위해 사용됩니다.
										나. 쿠키의 설치•운영 및 거부 : 웹브라우저 상단의 도구>인터넷 옵션>개인정보 메뉴의 옵션 설정을 통해 쿠키 저장을 거부 할 수 있습니다.
										다. 쿠키 저장을 거부할 경우 맞춤형 서비스 이용에 어려움이 발생할 수 있습니다.
										<br><br>
										10. 개인정보 보호책임자 작성
										<br><br>
										① (주)지피씨인증원(‘gpcert.org’이하 ‘(주)지피씨인증원) 은(는) 개인정보 처리에 관한 업무를 총괄해서 책임지고, 개인정보 처리와 관련한 정보주체의 불만처리 및 피해구제 등을 위하여 아래와 같이 개인정보 보호책임자를 지정하고 있습니다.
										[개인정보 보호책임자]
										성명 : 이춘곤
										직책 : 과장
										직급 : 과장
										연락처 : 02)6749-0723, saminil@hanmail.net, 02-6749-0711
										※ 개인정보 보호 담당부서로 연결됩니다.
										[개인정보 보호 담당부서]
										부서명 : 인증부
										담당자 : 이춘곤
										연락처 : 02)6749-0723, saminil@hanmail.net, 02-6749-0711
										<br><br>
										② 정보주체께서는 (주)지피씨인증원(‘gpcert.org’이하 ‘(주)지피씨인증원) 의 서비스(또는 사업)을 이용하시면서 발생한 모든 개인정보 보호 관련 문의, 불만처리, 피해구제 등에 관한 사항을 개인정보 보호책임자 및 담당부서로 문의하실 수 있습니다. (주)지피씨인증원(‘gpcert.org’이하 ‘(주)지피씨인증원) 은(는) 정보주체의 문의에 대해 지체 없이 답변 및 처리해드릴 것입니다.
										<br><br>
										11. 개인정보 처리방침 변경
										<br><br>
										①이 개인정보처리방침은 시행일로부터 적용되며, 법령 및 방침에 따른 변경내용의 추가, 삭제 및 정정이 있는 경우에는 변경사항의 시행 7일 전부터 공지사항을 통하여 고지할 것입니다.
										<br><br>
										12. 개인정보의 안전성 확보 조치
										<br><br>
										&lt;(주)지피씨인증원&gt;('(주)지피씨인증원')은(는) 개인정보보호법 제29조에 따라 다음과 같이 안전성 확보에 필요한 기술적/관리적 및 물리적 조치를 하고 있습니다.
										<br><br>
										(1) 정기적인 자체 감사 실시
										<br><br>
										개인정보 취급 관련 안정성 확보를 위해 정기적(분기 1회)으로 자체 감사를 실시하고 있습니다.
										<br><br>
										(2) 개인정보 취급 직원의 최소화 및 교육
										<br><br>
										개인정보를 취급하는 직원을 지정하고 담당자에 한정시켜 최소화 하여 개인정보를 관리하는 대책을 시행하고 있습니다.
										<br><br>
										(3) 내부관리계획의 수립 및 시행
										<br><br>
										개인정보의 안전한 처리를 위하여 내부관리계획을 수립하고 시행하고 있습니다.
										<br><br>
										(4) 해킹 등에 대비한 기술적 대책
										<br><br>
										&lt;(주)지피씨인증원&gt;('(주)지피씨인증원')은 해킹이나 컴퓨터 바이러스 등에 의한 개인정보 유출 및 훼손을 막기 위하여 보안프로그램을 설치하고 주기적인 갱신·점검을 하며 외부로부터 접근이 통제된 구역에 시스템을 설치하고 기술적/물리적으로 감시 및 차단하고 있습니다.
										<br><br>
										(5) 개인정보의 암호화
										<br><br>
										이용자의 개인정보는 비밀번호는 암호화 되어 저장 및 관리되고 있어, 본인만이 알 수 있으며 중요한 데이터는 파일 및 전송 데이터를 암호화 하거나 파일 잠금 기능을 사용하는 등의 별도 보안기능을 사용하고 있습니다.
										<br><br>
										(6) 접속기록의 보관 및 위변조 방지
										<br><br>
										개인정보처리시스템에 접속한 기록을 최소 6개월 이상 보관, 관리하고 있으며, 접속 기록이 위변조 및 도난, 분실되지 않도록 보안기능 사용하고 있습니다.
										<br><br>
										(7) 개인정보에 대한 접근 제한
										<br><br>
										개인정보를 처리하는 데이터베이스시스템에 대한 접근권한의 부여,변경,말소를 통하여 개인정보에 대한 접근통제를 위하여 필요한 조치를 하고 있으며 침입차단시스템을 이용하여 외부로부터의 무단 접근을 통제하고 있습니다.
										<br><br>
										(8) 문서보안을 위한 잠금장치 사용
										<br><br>
										개인정보가 포함된 서류, 보조저장매체 등을 잠금장치가 있는 안전한 장소에 보관하고 있습니다.
										<br><br>
										(9) 비인가자에 대한 출입 통제
										<br><br>
										개인정보를 보관하고 있는 물리적 보관 장소를 별도로 두고 이에 대해 출입통제 절차를 수립, 운영하고 있습니다.
									</div>
								</div>
							</div>
						</div>
						<div style="text-align:center;">
							<input type="button" name="checkButton" id="submitAction" class="btn btn-lg btn-primary" style="font-weight:400;" value="신청서 제출" onclick="check_onclick()" disabled>
						</div>
					</form>
				</div>
				<!-- END : form wrap  -->
			</div>
		</div>
    </div>
</div>
<script>

const checkAll = document.querySelector(".terms__check__all input"); // 전체 동의하기 체크박스
const checkBoxes = document.querySelectorAll(".input__check input"); // 각각의 동의하기 체크박스
const submitButton = document.querySelector("#submitAction"); // 확인(제출) 버튼

const agreements = { // 체크박스 초기화
	termsOfService: false,
	privacyPolicy: false,
	// allowPromotions: false <= 선택동의
};

// form.addEventListener("submit", (e) => e.preventDefault());

checkBoxes.forEach((item) => item.addEventListener("input", toggleCheckbox));

function toggleCheckbox(e) {
	const { checked, id } = e.target;
	agreements[id] = checked;
	this.parentNode.classList.toggle("active");
	checkAllStatus();
	toggleSubmitButton();
}

function checkAllStatus() {
	const { termsOfService, privacyPolicy, allowPromotions } = agreements;
	if (termsOfService && privacyPolicy && allowPromotions) {
		checkAll.checked = true;
	} else {
		checkAll.checked = false;
	}
}

function toggleSubmitButton() {
	const { termsOfService, privacyPolicy } = agreements;
	if (termsOfService && privacyPolicy) {
		submitButton.disabled = false;
	} else {
		submitButton.disabled = true;
	}
}

checkAll.addEventListener("click", (e) => {
	const { checked } = e.target;
	if (checked) {
		checkBoxes.forEach((item) => {
			item.checked = true;
			agreements[item.id] = true;
			item.parentNode.classList.add("active");
		});
	} else {
		checkBoxes.forEach((item) => {
			item.checked = false;
			agreements[item.id] = false;
			item.parentNode.classList.remove("active");
		});
	}
	toggleSubmitButton();
});
</script>
</body>

<?php
include_once(G5_THEME_PATH.'/tail.php');
?>