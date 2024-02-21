<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>

<section id="bo_w">
    <h2 id="container_title"><?php echo $g5['title'] ?></h2>
	<?php
	if($csconfig['cf_counsel']){

		if(!$w && $csconfig['cf_agree']){

			switch($csconfig['cf_agree']) {
				case '1':
					$w_step = ($_POST['agree'])?"step2":"step1";
					break;
				case '2':
					$w_step = 'step2';
					break;
			}

		}else{

			$w_step = ($w=="r")?"re":"step2";

		}

		include_once($board_skin_path.'/write.'.$w_step.'.skin.php');

	}else{

		$str = '<p>심사원등록 스킨을 적용 또는 설치를 진해해주세요.</p>';
		if($is_admin) $str .= '<a role="button" href="/adm/counsel_config.php" class="btn_admin" target="_blank">설정 및 설치</a>';

		echo $str;

	}
	?>
</section>