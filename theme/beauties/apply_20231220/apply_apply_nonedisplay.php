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
                            
                            <div style="margin: 100px 0;">
								<div style="width: 260px;margin: 0 auto 60px;">
									<img src="https://www.gpcert.org/theme/gpcert/apply/images/ready_icon.png" alt="시스템 준비 중">
								</div>
								<h3 style="font-size: 2rem;font-weight: 500;text-align: center;margin: 0 0 30px;">시스템 준비 중입니다.</h3>
								<a href="tel:+82 2 6749-1162" style="display: block;font-size: 1.26rem;font-weight: 500;text-align: center;">상담 전화 : 02) 6749 - 1162</a>
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