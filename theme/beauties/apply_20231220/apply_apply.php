<?php
/*****************************
* 신청내역 확인 및 자격정보 입력(STEP1)
	- 비회원도 접근 가능 : 비회원은 STEP2에서 완료 시 회원가입도 병행한다.
	- 신청내역 확인
		: 기존의 회원이라면 기존의 등록 신청된 내역이 존재하는지 아이디 / 비밀번호를 통해서 확인 할 수 있다
		: 아이디(E-mail) 부분은 아이디와 이메일이 별도이기 때문에 둘 중에 하나는 존재하는지로 확인
		: iso_mode 값을 가지고 아이디 / 비밀번호 인지 인증번호인지 여부를 따져서 인증한다.
	- 자격정보 입력
		- 주문번호 값을 생성하여 세션으로 저장 후 다음페이지에 직접 접근을 방지한다.
		- 중복 및 회원여부는 다음 페이지에서 확인한다.
*****************************/
include_once('./_common.php');

$od_id = get_uniqid();// 주문번호 생성
// 토큰 생성 : apply.php 파일에 직접 접속 차단
$ss_name = 'ss_apply_'.$od_id;

if(!get_session($ss_name))
	set_session($ss_name, TRUE);

$g5['title'] = '등록 신청';
include_once(G5_THEME_PATH.'/head.php');
add_javascript('<script src="'.G5_JS_URL.'/apply.js?ver='.time().'"></script>', 0);
?>

<body>

<div class="content_wrap">
    <div id="page-b">
        <div id="sub-content">
            <div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- STRAT : form wrap -->
                            <div class="form_wrap">
                                <div class="content_tt" style="color:#27323a;">
                                    자격정보 입력
                                </div>

                                <!-- step navigation -->
                                <div class="step_navi">
                                    <ul>
                                        <li class="active">
                                            <p><span>STEP 1.</span>자격정보 입력</p>
                                            <div class="arrow arrow-right"></div>
                                        </li>
                                        <li>
											<p><span>STEP 2.</span>신청자 정보 입력</p>
                                        </li>
                                        <li>
											<p><span>STEP 3.</span>등록 신청 완료</p>
                                        </li>
                                    </ul>
                                </div>
								
								<div class="login_wrap">
                                    <!-- 신청내역 확인 -->
                                    <h6 class="content_box_tt content_box_tt2">신청내역 확인</h6>
									<form name="iso_login" id="iso_login" method="post">
										<input type="hidden" name="iso_mode" id="iso_mode" value="login" />
										<table class="apply_table">
											<tbody>
												<tr>
													<th scope="row">아이디(E-mail)</th>
													<td>
														<input type="text" class="input_login" name="mb_id" value="<?php echo $member['mb_id'] ?>" id="login_id" maxLength="20" placeholder="아이디">
													</td>
													<th scope="row">비밀번호</th>
													<td>
														<input type="password" class="input_login" name="mb_password" id="login_pw" maxLength="20" placeholder="비밀번호">
													</td>
												</tr>
											</tbody>
										</table>
										<div style="display: flex;">
											<button type="button" id="btn_iso_login" class="btn btn-primary confm" style="margin-left: auto;">신청내역 확인</button>
										</div>
									</form>
									<div id="submiT" style="margin: 6rem 0;"></div>
                                </div>


                                <form name="fm_write" id="fm_write" action="<?php echo G5_THEME_URL ?>/apply/apply.php" method="post" enctype="multipart/form-data">
									<input type="hidden" name="od_id" value="<?php echo $od_id ?>" />

                                    <!-- 자격정보 입력 -->
                                    <h6 class="content_box_tt content_box_tt2">자격정보 입력</h6>
                                    <div class="text_box_gray">
                                        <span class="icon_comment material-symbols-outlined">comment</span>
                                        신청하시려는 ISO 규격과 등급을 선택하세요.
                                    </div>
                                    
                                    <table class="apply_table">
                                        <thead>
                                            <tr style="display:none">
                                                <th scope="cols"></th>
                                                <th scope="cols"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">신청규격</th>
                                                <td colspan='3' class="iso_check">
													<?php
													foreach($iso_standard_arr as $key => $val) {
													?>
													<label for="<?php echo $key ?>" class="type_radio type_radio2"><input type="radio" name="iso_standard" value="<?php echo $key ?>" id="<?php echo $key ?>" <?php echo get_checked($key, $iso_standard); ?>> <?php echo $val ?> </label>
													<?php
													}
													?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">등급</th>
                                                <td colspan='3'>
													<?php foreach($iso_grade_arr as $key => $val) { ?>
													<label for="iso_grade_<?php echo $key ?>" class="type_radio"><input type="radio" name="iso_grade" value="<?php echo $key ?>" id="iso_grade_<?php echo $key ?>" <?php echo get_checked($key, $iso_grade); ?>> <?php echo $val ?> </label>
													<?php } ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">유형</th>
                                                <td colspan='3'>
													<?php foreach($iso_type_arr as $key => $val) { ?>
													<label for="iso_type_<?php echo $key ?>" class="type_radio"><input type="radio" name="iso_type" value="<?php echo $key ?>" id="iso_type_<?php echo $key ?>" <?php echo get_checked($key, $iso_type); ?>> <?php echo $val ?> </label>
													<?php } ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>      

                                    <div style="text-align:center;">
										<!-- <button onclick="javascript:history.back()" class="btn btn-primary back_btn">돌아가기</button>-->
										<button id="submitIsoAction" class="btn btn-primary sub_btn">확인</button>
                                    </div>
                                </form>								
                            </div>
                            <!-- END : form wrap  -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
	
</body>

<?php
include_once(G5_THEME_PATH.'/tail.php');
?>