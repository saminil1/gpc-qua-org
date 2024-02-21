<div id="snb" class="left_snb">
<?php
	################################################################################################
	##### 관리자 메뉴설정을 아래와 같이 한다고 가정하에 왼쪽 메뉴 설정  (bo_table 기준으로 작업)
	################################################################################################
	##### 게시판이 아닐때 : /theme/a01/sub01/sub01.php
	##### 게시판 일때 : /bbs/board.php?bo_table=product01
	################################################################################################

	// 게시판이 아니고 co_id 값이 없을 때
	if($bo_table == "" && $co_id == "") {
		$url = preg_replace('/(qawrite\.php|qaview\.php)/i', 'qalist.php', $_SERVER['SCRIPT_NAME']); // 일대일상대 적용
	// 게시판일때
	}else{
		$base_url = preg_replace('/write\.php/i', 'board.php', $_SERVER['SCRIPT_NAME']);
		// 인터넷 주소창에 "&" 없는 경우 - 글목록/글등록/글수정
		if(strpos($_SERVER['QUERY_STRING'], "&") === false) {
    		$url = $base_url."?".$_SERVER['QUERY_STRING'];
		// 인터넷 주소창에 "&" 있는 경우 - 글보기, 글검색
		}else{
			$query_string = preg_replace('/(w=u&)/i', '', $_SERVER['QUERY_STRING']);
			$url = $base_url."?".substr($query_string, 0, strpos($query_string, "&"));
		}
	}

    $sql = " select * from {$g5['menu_table']} where length(me_code) = '4' and me_link like '%".$url."%' and me_use = '1' order by me_order, me_id ";
	$query = sql_query($sql, false) ;
	$total  = sql_num_rows($query) ;
	$list = array() ;
	if($total > 0) {
		$row = sql_fetch_array($query);
		$keyword =  $row['me_code'] ;
		if(strlen($keyword) >= 2) {
			$filter_keyword = substr($keyword, 0, 2);
			$sql = " select * from {$g5['menu_table']} where me_code like '{$filter_keyword}%' and me_use = '1' order by me_order, me_code ";
			$query = sql_query($sql, false);
			$num = sql_num_rows($query);
			for($i=0; $i < $num;$i++) {
				$list[$i] = sql_fetch_array($query);
			}
		}
	}	
	
	// 메뉴 자체가 있을 경우
    if (count($list) > 0) {		
?>
    <?php for($i=0;$i<count($list);$i++) { $class = ""; if(strpos($list[$i]['me_link'], $url) !== false) $class = " class=\"on\"";
        if ($i == 0) { ?>
    <h2><?php echo $list[$i]['me_name']?></h2>
	<ul>
    <?php } else { ?>
    	<li <?php echo $class?>><a href="<?php echo $list[$i]['me_link']?>" target="_<?php echo $list[$i]['me_target']?>"><?php echo $list[$i]['me_name']?></a></li>
    <?php } } ?>
	</ul>
<? 
	} else { 
		/////////////////////////////////////////////////////////////////////////////
		// 사용자 메뉴 및 페이지 생성 2023.03.23 HJ, 20.05.06 islro
		/////////////////////////////////////////////////////////////////////////////
		$page_block_arr = array("service");		// 페이지 폴더 블럭 설정
		for($b=0; $b < count($page_block_arr); $b++) {
			$page_key = $page_block_arr[$b] ;
            
			if(preg_match("/".$page_key."\/(certificate_)/i", $_SERVER["PHP_SELF"])) { // 페이지 경로로 페이지 블럭 설정
				// 페이지 블럭별 왼쪽 메뉴 세팅
				$pages = array();
				if($page_key == "service"){
					$page_folder = "/theme/beauties/service/" ; // 사용자 디렉토리 설정
					$pages[0][$page_key] = array("제공서비스"); // 왼쪽 메뉴 타이틀
                    $pages[1][$page_key] = array("Beauty자격", $_SERVER["PHP_SELF"], "_self"); // 왼쪽 메뉴 1
					$pages[2][$page_key] = array("Beauty연수기관", $page_folder."trainprovid_instroduction.php", "_self"); // 왼쪽 메뉴 2
					$pages[3][$page_key] = array("Beauty자격시험", $page_folder."exam_instroduction.php", "_self"); // 왼쪽 메뉴 3
					$pages[4][$page_key] = array("Beauty자격교육", $page_folder."training_instroduction.php", "_self"); // 왼쪽 메뉴 4
					$pages[5][$page_key] = array("기타자격", $page_folder."otherquali_instroduction.php", "_self"); // 왼쪽 메뉴 5
					$pages[6][$page_key] = array("기타자격연수기관", $page_folder."otherqualitran_provider.php", "_self"); // 왼쪽 메뉴 6
					$pages[7][$page_key] = array("기타자격시험", $page_folder."otherqualexam_introduction.php", "_self"); // 왼쪽 메뉴 7
					$pages[8][$page_key] = array("기타자격교육", $page_folder."othertraining_introduction.php", "_self"); // 왼쪽 메뉴 8
				}
				for($i=0; $i<count($pages); $i++) { 				
					$menu_name = $pages[$i][$page_key][0] ;
					$menu_link = $pages[$i][$page_key][1] ;
					$menu_target = $pages[$i][$page_key][2] ;
					$class = ""; 
					if(strpos($menu_link, basename($_SERVER["PHP_SELF"])) !== false) $class = " class=\"on\"";
					if ($i == 0) {
						echo "<h2>".$menu_name."</h2>";
						echo "<ul>" ;
					} else {
						echo "<li ".$class."><a href='".$menu_link."' target='".$menu_target."'>".$menu_name."</a></li>";
					} 
				}
				echo "</ul>" ;
			};
            
			if(preg_match("/".$page_key."\/(trainprovid_)/i", $_SERVER["PHP_SELF"])) { // 페이지 경로로 페이지 블럭 설정
				// 페이지 블럭별 왼쪽 메뉴 세팅
				$pages = array();
				if($page_key == "service"){
					$page_folder = "/theme/beauties/service/" ; // 사용자 디렉토리 설정
					$pages[0][$page_key] = array("제공서비스"); // 왼쪽 메뉴 타이틀
                    $pages[1][$page_key] = array("Beauty자격", $page_folder."certificate_instroduction.php", "_self"); // 왼쪽 메뉴 1
					$pages[2][$page_key] = array("Beauty연수기관",  $_SERVER["PHP_SELF"], "_self"); // 왼쪽 메뉴 2
					$pages[3][$page_key] = array("Beauty자격시험", $page_folder."exam_instroduction.php", "_self"); // 왼쪽 메뉴 3
					$pages[4][$page_key] = array("Beauty자격교육", $page_folder."training_instroduction.php", "_self"); // 왼쪽 메뉴 4
					$pages[5][$page_key] = array("기타자격", $page_folder."otherquali_instroduction.php", "_self"); // 왼쪽 메뉴 5
					$pages[6][$page_key] = array("기타자격연수기관", $page_folder."otherqualitran_provider.php", "_self"); // 왼쪽 메뉴 6
					$pages[7][$page_key] = array("기타자격시험", $page_folder."otherqualexam_introduction.php", "_self"); // 왼쪽 메뉴 7
					$pages[8][$page_key] = array("기타자격교육", $page_folder."othertraining_introduction.php", "_self"); // 왼쪽 메뉴 8
				}
				for($i=0; $i<count($pages); $i++) { 				
					$menu_name = $pages[$i][$page_key][0] ;
					$menu_link = $pages[$i][$page_key][1] ;
					$menu_target = $pages[$i][$page_key][2] ;
					$class = ""; 
					if(strpos($menu_link, basename($_SERVER["PHP_SELF"])) !== false) $class = " class=\"on\"";
					if ($i == 0) {
						echo "<h2>".$menu_name."</h2>";
						echo "<ul>" ;
					} else {
						echo "<li ".$class."><a href='".$menu_link."' target='".$menu_target."'>".$menu_name."</a></li>";
					} 
				}
				echo "</ul>" ;
			};
            
			if(preg_match("/".$page_key."\/(exam_)/i", $_SERVER["PHP_SELF"])) { // 페이지 경로로 페이지 블럭 설정
				// 페이지 블럭별 왼쪽 메뉴 세팅
				$pages = array();
				if($page_key == "service"){
					$page_folder = "/theme/beauties/service/" ; // 사용자 디렉토리 설정
					$pages[0][$page_key] = array("제공서비스"); // 왼쪽 메뉴 타이틀
                    $pages[1][$page_key] = array("Beauty자격", $page_folder."certificate_instroduction.php", "_self"); // 왼쪽 메뉴 1
					$pages[2][$page_key] = array("Beauty연수기관", $page_folder."trainprovid_instroduction.php", "_self"); // 왼쪽 메뉴 2
					$pages[3][$page_key] = array("Beauty자격시험", $_SERVER["PHP_SELF"], "_self"); // 왼쪽 메뉴 3
					$pages[4][$page_key] = array("Beauty자격교육", $page_folder."training_instroduction.php", "_self"); // 왼쪽 메뉴 4
					$pages[5][$page_key] = array("기타자격", $page_folder."otherquali_instroduction.php", "_self"); // 왼쪽 메뉴 5
					$pages[6][$page_key] = array("기타자격연수기관", $page_folder."otherqualitran_provider.php", "_self"); // 왼쪽 메뉴 6
					$pages[7][$page_key] = array("기타자격시험", $page_folder."otherqualexam_introduction.php", "_self"); // 왼쪽 메뉴 7
					$pages[8][$page_key] = array("기타자격교육", $page_folder."othertraining_introduction.php", "_self"); // 왼쪽 메뉴 8
				}
				for($i=0; $i<count($pages); $i++) { 				
					$menu_name = $pages[$i][$page_key][0] ;
					$menu_link = $pages[$i][$page_key][1] ;
					$menu_target = $pages[$i][$page_key][2] ;
					$class = ""; 
					if(strpos($menu_link, basename($_SERVER["PHP_SELF"])) !== false) $class = " class=\"on\"";
					if ($i == 0) {
						echo "<h2>".$menu_name."</h2>";
						echo "<ul>" ;
					} else {
						echo "<li ".$class."><a href='".$menu_link."' target='".$menu_target."'>".$menu_name."</a></li>";
					} 
				}
				echo "</ul>" ;
			};
            
			if(preg_match("/".$page_key."\/(training_)/i", $_SERVER["PHP_SELF"])) { // 페이지 경로로 페이지 블럭 설정
				// 페이지 블럭별 왼쪽 메뉴 세팅
				$pages = array();
				if($page_key == "service"){
					$page_folder = "/theme/beauties/service/" ; // 사용자 디렉토리 설정
					$pages[0][$page_key] = array("제공서비스"); // 왼쪽 메뉴 타이틀
                    $pages[1][$page_key] = array("Beauty자격", $page_folder."certificate_instroduction.php", "_self"); // 왼쪽 메뉴 1
					$pages[2][$page_key] = array("Beauty연수기관", $page_folder."trainprovid_instroduction.php", "_self"); // 왼쪽 메뉴 2
					$pages[3][$page_key] = array("Beauty자격시험", $page_folder."exam_instroduction.php", "_self"); // 왼쪽 메뉴 3
					$pages[4][$page_key] = array("Beauty자격교육", $_SERVER["PHP_SELF"], "_self");; // 왼쪽 메뉴 4
					$pages[5][$page_key] = array("기타자격", $page_folder."otherquali_instroduction.php", "_self"); // 왼쪽 메뉴 5
					$pages[6][$page_key] = array("기타자격연수기관", $page_folder."otherqualitran_provider.php", "_self"); // 왼쪽 메뉴 6
					$pages[7][$page_key] = array("기타자격시험", $page_folder."otherqualexam_introduction.php", "_self"); // 왼쪽 메뉴 7
					$pages[8][$page_key] = array("기타자격교육", $page_folder."othertraining_introduction.php", "_self"); // 왼쪽 메뉴 8
				}
				for($i=0; $i<count($pages); $i++) { 				
					$menu_name = $pages[$i][$page_key][0] ;
					$menu_link = $pages[$i][$page_key][1] ;
					$menu_target = $pages[$i][$page_key][2] ;
					$class = ""; 
					if(strpos($menu_link, basename($_SERVER["PHP_SELF"])) !== false) $class = " class=\"on\"";
					if ($i == 0) {
						echo "<h2>".$menu_name."</h2>";
						echo "<ul>" ;
					} else {
						echo "<li ".$class."><a href='".$menu_link."' target='".$menu_target."'>".$menu_name."</a></li>";
					} 
				}
				echo "</ul>" ;
			};
            
			if(preg_match("/".$page_key."\/(otherquali_)/i", $_SERVER["PHP_SELF"])) { // 페이지 경로로 페이지 블럭 설정
				// 페이지 블럭별 왼쪽 메뉴 세팅
				$pages = array();
				if($page_key == "service"){
					$page_folder = "/theme/beauties/service/" ; // 사용자 디렉토리 설정
					$pages[0][$page_key] = array("제공서비스"); // 왼쪽 메뉴 타이틀
                    $pages[1][$page_key] = array("Beauty자격", $page_folder."certificate_instroduction.php", "_self"); // 왼쪽 메뉴 1
					$pages[2][$page_key] = array("Beauty연수기관", $page_folder."trainprovid_instroduction.php", "_self"); // 왼쪽 메뉴 2
					$pages[3][$page_key] = array("Beauty자격시험", $page_folder."exam_instroduction.php", "_self"); // 왼쪽 메뉴 3
					$pages[4][$page_key] = array("Beauty자격교육", $page_folder."training_instroduction.php", "_self"); // 왼쪽 메뉴 4
					$pages[5][$page_key] = array("기타자격", $_SERVER["PHP_SELF"], "_self"); // 왼쪽 메뉴 5
					$pages[6][$page_key] = array("기타자격연수기관", $page_folder."otherqualitran_provider.php", "_self"); // 왼쪽 메뉴 6
					$pages[7][$page_key] = array("기타자격시험", $page_folder."otherqualexam_introduction.php", "_self"); // 왼쪽 메뉴 7
					$pages[8][$page_key] = array("기타자격교육", $page_folder."othertraining_introduction.php", "_self"); // 왼쪽 메뉴 8
				}
				for($i=0; $i<count($pages); $i++) { 				
					$menu_name = $pages[$i][$page_key][0] ;
					$menu_link = $pages[$i][$page_key][1] ;
					$menu_target = $pages[$i][$page_key][2] ;
					$class = ""; 
					if(strpos($menu_link, basename($_SERVER["PHP_SELF"])) !== false) $class = " class=\"on\"";
					if ($i == 0) {
						echo "<h2>".$menu_name."</h2>";
						echo "<ul>" ;
					} else {
						echo "<li ".$class."><a href='".$menu_link."' target='".$menu_target."'>".$menu_name."</a></li>";
					} 
				}
				echo "</ul>" ;
			};
            
            //  2024년1월22일 By LEE CHUNGON, 서브페이지 좌측 서부메뉴를 클릭하면 해당 페이지로 갈 수 있게 함
            if(preg_match("/".$page_key."\/(otherqualitran_)/i", $_SERVER["PHP_SELF"])) { // 페이지 경로로 페이지 블럭 설정
				// 페이지 블럭별 왼쪽 메뉴 세팅
				$pages = array();
				if($page_key == "service"){
					$page_folder = "/theme/beauties/service/" ; // 사용자 디렉토리 설정
					$pages[0][$page_key] = array("제공서비스"); // 왼쪽 메뉴 타이틀
                    $pages[1][$page_key] = array("Beauty자격", $page_folder."certificate_instroduction.php", "_self"); // 왼쪽 메뉴 1
					$pages[2][$page_key] = array("Beauty연수기관", $page_folder."trainprovid_instroduction.php", "_self"); // 왼쪽 메뉴 2
					$pages[3][$page_key] = array("Beauty자격시험", $page_folder."exam_instroduction.php", "_self"); // 왼쪽 메뉴 3
					$pages[4][$page_key] = array("Beauty자격교육", $page_folder."training_instroduction.php", "_self"); // 왼쪽 메뉴 4
					$pages[5][$page_key] = array("기타자격", $page_folder."otherquali_instroduction.php", "_self"); // 왼쪽 메뉴 5
					$pages[6][$page_key] = array("기타자격연수기관", $_SERVER["PHP_SELF"], "_self"); // 왼쪽 메뉴 6
					$pages[7][$page_key] = array("기타자격시험", $page_folder."otherqualexam_introduction.php", "_self"); // 왼쪽 메뉴 7
					$pages[8][$page_key] = array("기타자격교육", $page_folder."othertraining_introduction.php", "_self"); // 왼쪽 메뉴 8
				}
				for($i=0; $i<count($pages); $i++) { 				
					$menu_name = $pages[$i][$page_key][0] ;
					$menu_link = $pages[$i][$page_key][1] ;
					$menu_target = $pages[$i][$page_key][2] ;
					$class = ""; 
					if(strpos($menu_link, basename($_SERVER["PHP_SELF"])) !== false) $class = " class=\"on\"";
					if ($i == 0) {
						echo "<h2>".$menu_name."</h2>";
						echo "<ul>" ;
					} else {
						echo "<li ".$class."><a href='".$menu_link."' target='".$menu_target."'>".$menu_name."</a></li>";
					} 
				}
				echo "</ul>" ;
			};
            
            
              //  2024년1월22일 By LEE CHUNGON, 서브페이지 좌측 서부메뉴를 클릭하면 해당 페이지로 갈 수 있게 함
            if(preg_match("/".$page_key."\/(otherqualexam_)/i", $_SERVER["PHP_SELF"])) { // 페이지 경로로 페이지 블럭 설정
				// 페이지 블럭별 왼쪽 메뉴 세팅
				$pages = array();
				if($page_key == "service"){
					$page_folder = "/theme/beauties/service/" ; // 사용자 디렉토리 설정
					$pages[0][$page_key] = array("제공서비스"); // 왼쪽 메뉴 타이틀
                    $pages[1][$page_key] = array("Beauty자격", $page_folder."certificate_instroduction.php", "_self"); // 왼쪽 메뉴 1
					$pages[2][$page_key] = array("Beauty연수기관", $page_folder."trainprovid_instroduction.php", "_self"); // 왼쪽 메뉴 2
					$pages[3][$page_key] = array("Beauty자격시험", $page_folder."exam_instroduction.php", "_self"); // 왼쪽 메뉴 3
					$pages[4][$page_key] = array("Beauty자격교육", $page_folder."training_instroduction.php", "_self"); // 왼쪽 메뉴 4
					$pages[5][$page_key] = array("기타자격", $page_folder."otherquali_instroduction.php", "_self"); // 왼쪽 메뉴 5
					$pages[6][$page_key] = array("기타자격연수기관", $page_folder."otherqualitran_provider.php", "_self"); // 왼쪽 메뉴 6
					$pages[7][$page_key] = array("기타자격시험", $_SERVER["PHP_SELF"], "_self"); // 왼쪽 메뉴 7
					$pages[8][$page_key] = array("기타자격교육", $page_folder."othertraining_introduction.php", "_self"); // 왼쪽 메뉴 8
				}
				for($i=0; $i<count($pages); $i++) { 				
					$menu_name = $pages[$i][$page_key][0] ;
					$menu_link = $pages[$i][$page_key][1] ;
					$menu_target = $pages[$i][$page_key][2] ;
					$class = ""; 
					if(strpos($menu_link, basename($_SERVER["PHP_SELF"])) !== false) $class = " class=\"on\"";
					if ($i == 0) {
						echo "<h2>".$menu_name."</h2>";
						echo "<ul>" ;
					} else {
						echo "<li ".$class."><a href='".$menu_link."' target='".$menu_target."'>".$menu_name."</a></li>";
					} 
				}
				echo "</ul>" ;
			};
            
            
            
              //  2024년1월22일 By LEE CHUNGON, 서브페이지 좌측 서부메뉴를 클릭하면 해당 페이지로 갈 수 있게 함
            if(preg_match("/".$page_key."\/(othertraining_)/i", $_SERVER["PHP_SELF"])) { // 페이지 경로로 페이지 블럭 설정
				// 페이지 블럭별 왼쪽 메뉴 세팅
				$pages = array();
				if($page_key == "service"){
					$page_folder = "/theme/beauties/service/" ; // 사용자 디렉토리 설정
					$pages[0][$page_key] = array("제공서비스"); // 왼쪽 메뉴 타이틀
                    $pages[1][$page_key] = array("Beauty자격", $page_folder."certificate_instroduction.php", "_self"); // 왼쪽 메뉴 1
					$pages[2][$page_key] = array("Beauty연수기관", $page_folder."trainprovid_instroduction.php", "_self"); // 왼쪽 메뉴 2
					$pages[3][$page_key] = array("Beauty자격시험", $page_folder."exam_instroduction.php", "_self"); // 왼쪽 메뉴 3
					$pages[4][$page_key] = array("Beauty자격교육", $page_folder."training_instroduction.php", "_self"); // 왼쪽 메뉴 4
					$pages[5][$page_key] = array("기타자격", $page_folder."otherquali_instroduction.php", "_self"); // 왼쪽 메뉴 5
					$pages[6][$page_key] = array("기타자격연수기관", $page_folder."otherqualitran_provider.php", "_self"); // 왼쪽 메뉴 6
					$pages[7][$page_key] = array("기타자격시험", $page_folder."otherqualexam_introduction.php", "_self"); // 왼쪽 메뉴 7
					$pages[8][$page_key] = array("기타자격교육", $_SERVER["PHP_SELF"], "_self"); // 왼쪽 메뉴 8
				}
				for($i=0; $i<count($pages); $i++) { 				
					$menu_name = $pages[$i][$page_key][0] ;
					$menu_link = $pages[$i][$page_key][1] ;
					$menu_target = $pages[$i][$page_key][2] ;
					$class = ""; 
					if(strpos($menu_link, basename($_SERVER["PHP_SELF"])) !== false) $class = " class=\"on\"";
					if ($i == 0) {
						echo "<h2>".$menu_name."</h2>";
						echo "<ul>" ;
					} else {
						echo "<li ".$class."><a href='".$menu_link."' target='".$menu_target."'>".$menu_name."</a></li>";
					} 
				}
				echo "</ul>" ;
			};
            
		}
		/////////////////////////////////////////////////////////////////////////////
	}
?>
</div>



<!-----서브페이지 좌측 CS 시작----->
<div class="left_cs">
	<h2>CS Center</h2>
	<p class="tel">Tel. 02-6749-0710</p>
	<p class="time"><i class="fa fa-clock-o" aria-hidden="true"></i> AM 9:00 ~ PM 6:00</p>
	<p class="info">주말 및 공휴일은 휴무입니다.</p>
	<dl>
		<dt><i class="fa fa-fax" aria-hidden="true"></i></dt>
		<dd>Fax 02-6749-0711</dd>
		<dt><i class="fas fa-envelope" aria-hidden="true"></i></dt>
		<dd style="margin-bottom:40px;" class="gpc_email">info@gpcert.org</dd>
	</dl>
	
	<!---------ul class="banner">
		<li><a href="/bbs/board.php?bo_table=qa"><i class="fa fa-comments-o" aria-hidden="true"></i> 묻고답하기</a></li>
		<li><a href="/bbs/qalist.php"><i class="fa fa-user-o" aria-hidden="true"></i> 1:1상담</a></li>
	</ul--------->

</div>



<!-----서브페이지 좌측 CS 종료----->