<?php
/*****************************
* 신청내역 확인 및 자격정보 입력(STEP1)
- 회원여부에 따라서 비회원은 기존의 회원으로 되어 있는지 확인 필요.
	- 회원으로 넘어왔을 경우 그대로 처리
	- 비회원으로 넘어왔을 경우 기존 회원인데 로그인을 안했을 경우를 대비해서 기존 회원 여부를 판단 후 없으면 회원가입. 있다면 신청규격의 중복여부 체크

*****************************/
include_once('./_common.php');
include_once(G5_LIB_PATH.'/register.lib.php');

$is_member		= isset($_POST['is_member'])	? preg_replace('/[^0-9]/', '', $_POST['is_member']) : ''; //회원여부
$od_id			= isset($_POST['od_id']) ? preg_replace('/[^0-9]/', '', $_POST['od_id']) : 0;// 주문번호
$standard		= (isset($_POST['standard']) && $iso_standard_arr[$_POST['standard']]) ? $_POST['standard'] : '';
$grade			= (isset($_POST['grade']) && $iso_grade_arr[$_POST['grade']]) ? $_POST['grade'] : '';
$type			= (isset($_POST['type']) && $iso_type_arr[$_POST['type']]) ? $_POST['type'] : '';
$name_kr		= isset($_POST['name_kr'])	? clean_xss_tags(trim($_POST['name_kr'])) : '';// 이름(한)
$name_en		= isset($_POST['name_en'])	? clean_xss_tags(trim($_POST['name_en'])) : '';// 이름(영)
$hp				= isset($_POST['hp'])	? preg_replace('/[^0-9]/', '', $_POST['hp']) : '';//휴대폰번호
$email			= isset($_POST['email'])	? clean_xss_tags(trim($_POST['email'])) : ''; //이메일(앞자리)
$zip1			= isset($_POST['zipcode'])	? preg_replace('/[^0-9]/', '', substr(trim($_POST['zipcode']), 0, 3)) : ''; //주소(우편번호)
$zip2			= isset($_POST['zipcode'])	? preg_replace('/[^0-9]/', '', substr(trim($_POST['zipcode']), 3)) : ''; //주소(우편번호)
$address1		= isset($_POST['address1'])	? clean_xss_tags(trim($_POST['address1'])) : ''; //주소(기본주소)
$address2		= isset($_POST['address2'])	? clean_xss_tags(trim($_POST['address2'])) : ''; //주소(상세주소)
$address3		= isset($_POST['extraAddress'])	? clean_xss_tags(trim($_POST['extraAddress'])) : ''; //주소(참고항목)
$addr_jibeon	= isset($_POST['addr_jibeon'])	? preg_match("/^(N|R)$/", trim($_POST['addr_jibeon'])) : "";//주소(지번)

$doc_chk_01		= isset($_POST['doc_chk_01'])      ? trim($_POST['doc_chk_01'])    : "N";// 제출문서(이력서)
$doc_chk_02		= isset($_POST['doc_chk_02'])      ? trim($_POST['doc_chk_02'])    : "N";// 제출문서(심사일지)
$doc_chk_03		= isset($_POST['doc_chk_03'])      ? trim($_POST['doc_chk_03'])    : "N";// 제출문서(교육훈련수료증)
$doc_chk_04		= isset($_POST['doc_chk_04'])      ? trim($_POST['doc_chk_04'])    : "N";// 제출문서(학력증명서)

$mb_id			= isset($_POST['mb_id']) ? trim($_POST['mb_id']) : '';// 아이디
$mb_nick        = isset($_POST['mb_nick']) ? trim($_POST['mb_nick']) : '';// 닉네임
$mb_password    = isset($_POST['mb_password']) ? trim($_POST['mb_password']) : '';// 비밀번호
$mb_password_re    = isset($_POST['mb_password_re']) ? trim($_POST['mb_password_re']) : '';// 비밀번호 확인

$price			= (isset($_POST['price']) && $iso_price_arr[$_POST['price']]) ? $_POST['price'] : '';
$settle_case	= $iso_bank_info;// 결제수단
$app_way		= (isset($_POST['app_way']) && $iso_cash_receipt_arr[$_POST['app_way']]) ? $_POST['app_way'] : '';//현금영수증
$app_info		= isset($_POST['app_info'])	? clean_xss_tags(trim($_POST['app_info'])) : ''; //발행 연락처
//req_memo, state, datetime, ip

$email       = get_email_address($email);

if (!get_session('ss_apply_'.$od_id))
	die('잘못된 접근입니다.');

// 에러문구
$msg = array();

if(!$od_id || !$standard || !$grade || !$type)
	$msg[] = '잘못된 접근입니다.';

if(!$name_kr)
	$msg[] = '이름(한)을 입력해 주세요.';

if(!$name_en)
	$msg[] = '이름(영)을 입력해 주세요.';

if(!$hp)
	$msg[] = '핸드폰번호를 입력해 주세요.';

if(!$email)
	$msg[] = '이메일을 입력해 주세요.';

if(!$zip1)
	$msg[] = '수령주소를 입력해 주세요.';

if(!$price)
	$msg[] = '비용을 선택해 주세요.';
if (!empty($msg)) {
    $msg = implode('<br>', $msg);
	die($msg);
}

if (substr_count($req_memo, '&#') > 50) {
	die('요청사항에 올바르지 않은 코드가 다수 포함되어 있습니다.');
}

if ($w == 'u') {// 수정은 무조건 회원만 가능
	$sql = " select * from {$g5['iso_apply_table']} where mb_id = '{$member['mb_id']}' and od_id = '{$od_id}' ";	// mb_id = '{$member['mb_id']}' and
	$write = sql_fetch($sql);
	if (!$write['od_id'])
		die('신청내역이 존재하지 않습니다.');
} else {
	// 1번 : 비회원으로 접속 후 아이디/비번에 기존 회원 정보를 입력. : 정보 일치한다면 중복된 신청내역 확인
	// 2번 : 
	
	if(!$member['mb_id']) {
		if(!$mb_id || !$mb_password || !$mb_password_re || !$email) {// 비회원은 아이디 / 비밀번호 / 이멩리 필수
			die('아이디나 비밀번호 또는 이메일이 넘어오지 않았습니다.');
		} else {
			$sql = " select * from {$g5['member_table']} where mb_id = TRIM('$mb_id') ";
			$mb = sql_fetch($sql);
			if (!$mb['mb_id']) {// 아이디가 존재하지 않는다면 가입
				// 이메일, 닉네임 중복 여부 체크
				if ($msg = empty_mb_email($email))			die($msg);
				if ($msg = valid_mb_email($email))			die($msg);
				if ($msg = prohibit_mb_email($email))		die($msg);
				if ($msg = exist_mb_email($email, $mb_id))	die($msg);
				
				if ($msg = valid_mb_hp($hp))	die($msg);
				$hp = hyphen_hp_number($hp);

				// 회원가입
				$sql = " insert into {$g5['member_table']}
							set mb_id = '{$mb_id}',
							mb_password = '".get_encrypt_string($mb_password)."',
							mb_name = '{$name_kr}',
							mb_nick = '{$mb_nick}',
							mb_nick_date = '".G5_TIME_YMD."',
							mb_email = '{$email}',
							mb_zip1 = '{$zip1}',
							mb_zip2 = '{$zip2}',
							mb_addr1 = '{$address1}',
							mb_addr2 = '{$address2}',
							mb_addr3 = '{$address3}',
							mb_addr_jibeon = '{$addr_jibeon}',
							mb_today_login = '".G5_TIME_YMDHIS."',
							mb_datetime = '".G5_TIME_YMDHIS."',
							mb_ip = '{$_SERVER['REMOTE_ADDR']}',
							mb_level = '{$config['cf_register_level']}' ";
				
				// 이메일 인증을 사용하지 않는다면 이메일 인증시간을 바로 넣는다
				if (!$config['cf_use_email_certify'])
					$sql .= " , mb_email_certify = '".G5_TIME_YMDHIS."' ";
				sql_query($sql);
				// 회원가입 포인트 부여
				insert_point($mb_id, $config['cf_register_point'], '회원가입 축하', '@member', $mb_id, '회원가입');


			} else {// 아이디 존재한다면 비밀번호가 맞는지 확인
				if (!login_password_check($mb, $mb_password, $mb['mb_password'])) {// 비밀번호가 일치하지 않는다면 존재하는 아이디
					die('이미 사용중인 아이디 입니다.');
				}
			}
			
		}
	}	

	// 중복된 신청내역 확인
	$sql = " select * from {$g5['iso_apply_table']} where mb_id = '{$mb_id}' and standard = '{$standard}' ";
	$iso = sql_fetch($sql);
	if ($iso['ia_no']) {
		die('회원님은 이미 신청한 규격 내역이 존재합니다.\n상태 : '.$iso_state_arr[$iso['state']]);
	}

}


$upload_max_filesize = ini_get('upload_max_filesize');

if (empty($_POST)) {
	die("파일 또는 글내용의 크기가 서버에서 설정한 값을 넘어 오류가 발생하였습니다.\\npost_max_size=".ini_get('post_max_size')." , upload_max_filesize=".$upload_max_filesize."\\n게시판관리자 또는 서버관리자에게 문의 바랍니다.");
}

// 파일개수 체크
$file_count   = 0;
$upload_count = isset($_FILES['up_file']['name']) ? count($_FILES['up_file']['name']) : 0;

for ($i=1; $i<=$upload_count; $i++) {
    if($_FILES['up_file']['name'][$i] && is_uploaded_file($_FILES['up_file']['tmp_name'][$i]))
        $file_count++;
}

if($file_count > 1)
	die('첨부파일을 1개 이하로 업로드 해주십시오.');

$dir_name = 'apply';// 디렉토리명

// 디렉토리가 없다면 생성합니다. (퍼미션도 변경하구요.)
@mkdir(G5_DATA_PATH.'/'.$dir_name, G5_DIR_PERMISSION);
@chmod(G5_DATA_PATH.'/'.$dir_name, G5_DIR_PERMISSION);

$chars_array = array_merge(range(0,9), range('a','z'), range('A','Z'));

// 가변 파일 업로드
$file_upload_msg = '';
$upload = array();
for ($i=1; $i<=$upload_count; $i++) {
    $upload[$i]['file']     = '';
    $upload[$i]['source']   = '';
    $upload[$i]['del_check'] = false;

    // 삭제에 체크가 되어있다면 파일을 삭제합니다.
    if (isset($_POST['up_file_del'][$i]) && $_POST['up_file_del'][$i]) {
        $upload[$i]['del_check'] = true;
        @unlink(G5_DATA_PATH.'/'.$dir_name.'/'.clean_relative_paths($write['file'.$i]));
        // 썸네일삭제
        if(preg_match("/\.({$config['cf_image_extension']})$/i", $write['file'.$i])) {
            delete_thumbnail($dir_name, $write['file'.$i]);
        }
    }

    $tmp_file  = $_FILES['up_file']['tmp_name'][$i];
    $filesize  = $_FILES['up_file']['size'][$i];
    $filename  = $_FILES['up_file']['name'][$i];
    $filename  = get_safe_filename($filename);

    // 서버에 설정된 값보다 큰파일을 업로드 한다면
    if ($filename) {
        if ($_FILES['up_file']['error'][$i] == 1) {
            $file_upload_msg .= '\"'.$filename.'\" 파일의 용량이 서버에 설정('.$upload_max_filesize.')된 값보다 크므로 업로드 할 수 없습니다.\\n';
            continue;
        }
        else if ($_FILES['up_file']['error'][$i] != 0) {
            $file_upload_msg .= '\"'.$filename.'\" 파일이 정상적으로 업로드 되지 않았습니다.\\n';
            continue;
        }
    }

    if (is_uploaded_file($tmp_file)) {
        // 관리자가 아니면서 설정한 업로드 사이즈보다 크다면 건너뜀
        if (!$is_admin && $filesize > $iso_upload_size) {
            $file_upload_msg .= '\"'.$filename.'\" 파일의 용량('.number_format($filesize).' 바이트)이 게시판에 설정('.number_format($iso_upload_size).' 바이트)된 값보다 크므로 업로드 하지 않습니다.\\n';
            continue;
        }

        //=================================================================\
        // 090714
        // 이미지나 플래시 파일에 악성코드를 심어 업로드 하는 경우를 방지
        // 에러메세지는 출력하지 않는다.
        //-----------------------------------------------------------------
        $timg = @getimagesize($tmp_file);
        // image type
        if ( preg_match("/\.({$config['cf_image_extension']})$/i", $filename) ||
             preg_match("/\.({$config['cf_flash_extension']})$/i", $filename) ) {
            // webp 파일의 type 이 18 이므로 업로드가 가능하도록 수정
            if ($timg['2'] < 1 || $timg['2'] > 18)
                continue;
        }
        //=================================================================

        if ($w == 'u') {
            // 존재하는 파일이 있다면 삭제합니다.
            @unlink(G5_DATA_PATH.'/'.$dir_name.'/'.clean_relative_paths($write['file'.$i]));
            // 이미지파일이면 썸네일삭제
            if(preg_match("/\.({$config['cf_image_extension']})$/i", $write['file'.$i])) {
                delete_thumbnail($dir_name, $write['file'.$i]);
            }
        }

        // 프로그램 원래 파일명
        $upload[$i]['source'] = $filename;
        $upload[$i]['filesize'] = $filesize;

        // 아래의 문자열이 들어간 파일은 -x 를 붙여서 웹경로를 알더라도 실행을 하지 못하도록 함
        $filename = preg_replace("/\.(php|pht|phtm|htm|cgi|pl|exe|jsp|asp|inc|phar)/i", "$0-x", $filename);

        shuffle($chars_array);
        $shuffle = implode('', $chars_array);

        // 첨부파일 첨부시 첨부파일명에 공백이 포함되어 있으면 일부 PC에서 보이지 않거나 다운로드 되지 않는 현상이 있습니다. (길상여의 님 090925)
        $upload[$i]['file'] = abs(ip2long($_SERVER['REMOTE_ADDR'])).'_'.substr($shuffle,0,8).'_'.replace_filename($filename);

        $dest_file = G5_DATA_PATH.'/'.$dir_name.'/'.$upload[$i]['file'];

        // 업로드가 안된다면 에러메세지 출력하고 죽어버립니다.
        $error_code = move_uploaded_file($tmp_file, $dest_file) or die($_FILES['up_file']['error'][$i]);

        // 올라간 파일의 퍼미션을 변경합니다.
        chmod($dest_file, G5_FILE_PERMISSION);
    }
}

$sql_common = " standard	= '{$standard}',
				grade		= '{$grade}',
				type		= '{$type}',
				name_kr		= '{$name_kr}',
				name_en		= '{$name_en}',
				hp			= '{$hp}',
				email		= '{$email}',
				zip1		= '{$zip1}',
				zip2		= '{$zip2}',
				address1	= '{$address1}',
				address2	= '{$address2}',
				address3	= '{$address3}',
				addr_jibeon	= '{$addr_jibeon}',
				doc_chk_01	= '{$doc_chk_01}',
				doc_chk_02	= '{$doc_chk_02}',
				doc_chk_03	= '{$doc_chk_03}',
				doc_chk_04	= '{$doc_chk_04}',
                app_way		= '{$app_way}',
                app_info	= '{$app_info}',
                req_memo	= '{$req_memo}'
                
";

if ($w == "") {
	

    $insert_file1	= isset($upload[1]['file']) ? $upload[1]['file'] : '';
    $insert_source1	= isset($upload[1]['source']) ? $upload[1]['source'] : '';

    $sql = " insert {$g5['iso_apply_table']}
                set od_id		= '$od_id',
					mb_id		= '{$mb_id}',
					file1		= '{$insert_file1}',
					source1		= '{$insert_source1}',
					price		= '{$price}',
					settle_case	= '{$iso_bank_info}',
					state		= 'register',
					ip			= '{$_SERVER['REMOTE_ADDR']}',
					datetime	= '".G5_TIME_YMDHIS."',
					{$sql_common} ";
	

    sql_query($sql);	
}
else if ($w == "u")
{

	if(!$upload[1]['file'] && !$upload[1]['del_check']) {
        $upload[1]['file'] = $write['in_file1'];
        $upload[1]['source'] = $write['in_source1'];
    }
    
	$sql_common .= " , file1 = '{$upload[1]['file']}' ";
	$sql_common .= " , source1 = '{$upload[1]['source']}' ";

    $sql = " update {$g5['iso_apply_table']}
                set $sql_common
              where od_id = '{$od_id}' ";
    sql_query($sql);		
}
?>