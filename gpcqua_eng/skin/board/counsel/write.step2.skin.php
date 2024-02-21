<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

    <form name="fwrite" id="fwrite" action="<?php echo $action_url ?>" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
    <input type="hidden" name="w" value="<?php echo $w ?>">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <?php
    $option = '';
    $option_hidden = '';
    if ($is_notice || $is_html || $is_secret || $is_mail) {
        $option = '';
        if ($is_notice) {
            $option .= PHP_EOL.'<input type="checkbox" id="notice" name="notice" value="1" '.$notice_checked.'>'.PHP_EOL.'<label for="notice">공지</label>';
        }

        if ($is_html) {
            if ($is_dhtml_editor) {
                $option_hidden .= '<input type="hidden" value="html1" name="html">';
            } else {
                $option .= PHP_EOL.'<input type="checkbox" id="html" name="html" onclick="html_auto_br(this);" value="'.$html_value.'" '.$html_checked.'>'.PHP_EOL.'<label for="html">html</label>';
            }
        }

        if ($is_secret) {
            if ($is_admin || $is_secret==1) {
                $option .= PHP_EOL.'<input type="checkbox" id="secret" name="secret" value="secret" '.$secret_checked.'>'.PHP_EOL.'<label for="secret">비밀글</label>';
            } else {
                $option_hidden .= '<input type="hidden" name="secret" value="secret">';
            }
        }

        if ($is_mail) {
            $option .= PHP_EOL.'<input type="checkbox" id="mail" name="mail" value="mail" '.$recv_email_checked.'>'.PHP_EOL.'<label for="mail">답변메일받기</label>';
        }
    }

    echo $option_hidden;
    ?>

	<?php if (!$w && $csconfig['cf_agree'] == "2") { ?>
	<p>심사원등록 내용에 동의하셔야 심사원등록 하실 수 있습니다.</p>
    <section id="fregister_term">
        <h2>심사원등록약관</h2>
        <textarea readonly><?php echo get_text($csconfig['cf_stipulation']) ?></textarea>
        <fieldset class="fregister_agree">
            <label for="agree">심사원등록약관의 내용에 동의합니다.</label>
            <input type="checkbox" name="agree" value="1" id="agree">
        </fieldset>
    </section>
	<?php } ?>

    <div class="tbl_frm01 tbl_wrap">
        <table>
        <caption><?php echo $g5['title'] ?></caption>
        <tbody>
		<?php if ($w && $is_admin && $csconfig['cf_effect']) { ?>
		<tr>
			<th scope="row"><label for="effect">결과</label></th>
			<td>
				<?php gen_single_selectbox("",'effect',Array("접수중","접수완료","접수취소"),Array("0","1","2"),$write['effect'],'',0); ?>
			</td>
		</tr>
		<?php } ?>
        <?php if ($is_name) { ?>
        <tr>
            <th scope="row"><label for="wr_name">이름<strong class="sound_only">필수</strong></label></th>
            <td><input type="text" name="wr_name" value="<?php echo $name ?>" id="wr_name" required class="frm_input required" maxlength="20"></td>
        </tr>
        <?php } ?>

        <?php if ($is_password) { ?>
        <tr>
            <th scope="row"><label for="wr_password">비밀번호<strong class="sound_only">필수</strong></label></th>
            <td><input type="password" name="wr_password" id="wr_password" <?php echo $password_required ?> class="frm_input <?php echo $password_required ?>" maxlength="20"></td>
        </tr>
        <?php } ?>

        <?php if ($is_email) { ?>
        <tr>
            <th scope="row"><label for="wr_email">이메일</label></th>
            <td><input type="email" name="wr_email" value="<?php echo $email ?>" id="wr_email" class="frm_input email" maxlength="100"></td>
        </tr>
        <?php } ?>

        <?php if ($is_homepage) { ?>
        <tr>
            <th scope="row"><label for="wr_homepage">홈페이지</label></th>
            <td><input type="url" name="wr_homepage" value="<?php echo $homepage ?>" id="wr_homepage" class="frm_input"></td>
        </tr>
        <?php } ?>

        <?php if ($option) { ?>
        <tr>
            <th scope="row">옵션</th>
            <td><?php echo $option ?></td>
        </tr>
        <?php } ?>

        <?php if ($is_category) { ?>
        <tr>
            <th scope="row"><label for="ca_name">분류<strong class="sound_only">필수</strong></label></th>
            <td>
                <select class="required" id="ca_name" name="ca_name" required>
                    <option value="">선택하세요</option>
                    <?php echo $category_option ?>
                </select>
            </td>
        </tr>
        <?php } ?>

		<?php if($csconfig['cf_subject']) { ?>
        <tr>
            <th scope="row"><label for="wr_subject">제목<strong class="sound_only">필수</strong></label></th>
            <td><input type="text" name="wr_subject" value="<?php echo $subject ?>" id="wr_subject" required class="frm_input required"></td>
        </tr>
		<?php }else{ ?>
		<?php if($is_member){ ?><input type="hidden" name="wr_name" id="wr_name" value="<?php echo $member['mb_name'] ?>"><?php } ?>
		<input type="hidden" name="wr_subject" id="wr_subject" value="<?php echo $subject ?>">
		<?php } ?>

		<?php
		$sql = " select * from {$g5['counsel_item_table']} order by mno ";
		$result = sql_query($sql);
		$mdatas = Array();
		for ($i=0; $row=sql_fetch_array($result); $i++){
			$fvs=$row['icode'];

			$mdatas[$fvs][icode]	= trim($row['icode']);
			$mdatas[$fvs][iname]	= trim(stripslashes($row['iname']));
			$mdatas[$fvs][size]		= trim($row['size']);
			$mdatas[$fvs][size2]	= trim($row['size2']);
			$mdatas[$fvs][bigo]		= trim(stripslashes($row['bigo']));
			$mdatas[$fvs][type]		= $row['type'];
			$mdatas[$fvs][1]		= trim(stripslashes($row['it1']));
			$mdatas[$fvs][2]		= trim(stripslashes($row['it2']));
			$mdatas[$fvs][3]		= trim(stripslashes($row['it3']));
			$mdatas[$fvs][4]		= trim(stripslashes($row['it4']));
			$mdatas[$fvs][5]		= trim(stripslashes($row['it5']));
			$mdatas[$fvs][6]		= trim(stripslashes($row['it6']));
			$mdatas[$fvs][7]		= trim(stripslashes($row['it7']));
			$mdatas[$fvs][8]		= trim(stripslashes($row['it8']));
			$mdatas[$fvs][9]		= trim(stripslashes($row['it9']));
			$mdatas[$fvs][10]		= trim(stripslashes($row['it10']));
			$mdatas[$fvs][11]		= trim(stripslashes($row['it11']));
			$mdatas[$fvs][12]		= trim(stripslashes($row['it12']));
			$mdatas[$fvs][13]		= trim(stripslashes($row['it13']));
			$mdatas[$fvs][14]		= trim(stripslashes($row['it14']));
			$mdatas[$fvs][15]		= trim(stripslashes($row['it15']));
			$mdatas[$fvs][16]		= trim(stripslashes($row['it16']));
			$mdatas[$fvs][17]		= trim(stripslashes($row['it17']));
			$mdatas[$fvs][18]		= trim(stripslashes($row['it18']));
			$mdatas[$fvs][19]		= trim(stripslashes($row['it19']));
			$mdatas[$fvs][20]		= trim(stripslashes($row['it20']));
			$mdatas[$fvs][21]		= trim(stripslashes($row['it21']));
			$mdatas[$fvs][22]		= trim(stripslashes($row['it22']));
			$mdatas[$fvs][23]		= trim(stripslashes($row['it23']));
			$mdatas[$fvs][24]		= trim(stripslashes($row['it24']));
			$mdatas[$fvs][25]		= trim(stripslashes($row['it25']));
			$mdatas[$fvs][26]		= trim(stripslashes($row['it26']));
			$mdatas[$fvs][27]		= trim(stripslashes($row['it27']));
			$mdatas[$fvs][28]		= trim(stripslashes($row['it28']));
			$mdatas[$fvs][29]		= trim(stripslashes($row['it29']));
			$mdatas[$fvs][30]		= trim(stripslashes($row['it30']));

			if (($row[type] == '17' || $row[type] == '18') && $csconfig[$fvs]!='0')
				add_javascript(G5_POSTCODE_JS, 0);    //다음 주소 js

			switch($row['type']){
				case '1':	// 입력형
					if($csconfig[$fvs]=='1' || $csconfig[$fvs]=='2'){
						if($csconfig[$fvs]=='2') { $needstr = '<strong class="sound_only">필수</strong>'; $required = 'required '; }
						else { $needstr = ''; $required = ''; }

						echo '<tr>
							<th scope="row"><label for="ca_name">'.$mdatas[$fvs]['iname'].$needstr.'</label></th>
							<td>
								<input type="text" name="N'.$fvs.'" id="N'.$fvs.'" value="'.$write[$fvs].'" '.$required.' class="'.$required.'frm_input" placeholder="'.$mdatas[$fvs][bigo].'" size="'.$mdatas[$fvs][size].'">
							</td>
						</tr>';

					} break;
				case '11':	// 영문이름
					if($csconfig[$fvs]=='1' || $csconfig[$fvs]=='2'){
						if($csconfig[$fvs]=='2') { $needstr = '<strong class="sound_only">필수</strong>'; $required = 'required '; }
						else { $needstr = ''; $required = ''; }

						echo '<tr>
							<th scope="row"><label for="ca_name">'.$mdatas[$fvs]['iname'].$needstr.'</label></th>
							<td>
								<input type="text" name="N'.$fvs.'" id="N'.$fvs.'" value="'.$write[$fvs].'" '.$required.' class="'.$required.'frm_input" placeholder="'.$mdatas[$fvs][bigo].'" size="'.$mdatas[$fvs][size].'">
							</td>
						</tr>';

					} break;
				case '12':	// 전화번호
					if($csconfig[$fvs]=='1' || $csconfig[$fvs]=='2'){
						if($csconfig[$fvs]=='2') { $needstr = '<strong class="sound_only">필수</strong>'; $required = 'required '; }
						else { $needstr = ''; $required = ''; }

						echo '<tr>
							<th scope="row"><label for="ca_name">'.$mdatas[$fvs]['iname'].$needstr.'</label></th>
							<td>
								<input type="text" name="N'.$fvs.'" id="N'.$fvs.'" value="'.$write[$fvs].'" '.$required.' class="'.$required.'frm_input" placeholder="'.$mdatas[$fvs][bigo].'" size="'.$mdatas[$fvs][size].'">
							</td>
						</tr>';

					} break;
				case '13':	// 직장전화번호
					if($csconfig[$fvs]=='1' || $csconfig[$fvs]=='2'){
						if($csconfig[$fvs]=='2') { $needstr = '<strong class="sound_only">필수</strong>'; $required = 'required '; }
						else { $needstr = ''; $required = ''; }

						echo '<tr>
							<th scope="row"><label for="ca_name">'.$mdatas[$fvs]['iname'].$needstr.'</label></th>
							<td>
								<input type="text" name="N'.$fvs.'" id="N'.$fvs.'" value="'.$write[$fvs].'" '.$required.' class="'.$required.'frm_input" placeholder="'.$mdatas[$fvs][bigo].'" size="'.$mdatas[$fvs][size].'">
							</td>
						</tr>';

					} break;
				case '14':	// 휴대번호
					if($csconfig[$fvs]=='1' || $csconfig[$fvs]=='2'){
						if($csconfig[$fvs]=='2') { $needstr = '<strong class="sound_only">필수</strong>'; $required = 'required '; }
						else { $needstr = ''; $required = ''; }

						echo '<tr>
							<th scope="row"><label for="ca_name">'.$mdatas[$fvs]['iname'].$needstr.'</label></th>
							<td>
								<input type="text" name="N'.$fvs.'" id="N'.$fvs.'" value="'.$write[$fvs].'" '.$required.' class="'.$required.'frm_input" placeholder="'.$mdatas[$fvs][bigo].'" size="'.$mdatas[$fvs][size].'">
							</td>
						</tr>';

					} break;
				case '15':	// 추천인
					if($csconfig[$fvs]=='1' || $csconfig[$fvs]=='2'){
						if($csconfig[$fvs]=='2') { $needstr = '<strong class="sound_only">필수</strong>'; $required = 'required '; }
						else { $needstr = ''; $required = ''; }

						echo '<tr>
							<th scope="row"><label for="ca_name">'.$mdatas[$fvs]['iname'].$needstr.'</label></th>
							<td>
								<input type="text" name="N'.$fvs.'" id="N'.$fvs.'" value="'.$write[$fvs].'" '.$required.' class="'.$required.'frm_input" placeholder="'.$mdatas[$fvs][bigo].'" size="'.$mdatas[$fvs][size].'">
							</td>
						</tr>';

					} break;
				case '16':	// 심사원등록번호
					if($csconfig[$fvs]=='1' || $csconfig[$fvs]=='2'){
						if($csconfig[$fvs]=='2') { $needstr = '<strong class="sound_only">필수</strong>'; $required = 'required '; }
						else { $needstr = ''; $required = ''; }

						echo '<tr>
							<th scope="row"><label for="ca_name">'.$mdatas[$fvs]['iname'].$needstr.'</label></th>
							<td>
								<input type="text" name="N'.$fvs.'" id="N'.$fvs.'" value="'.$write[$fvs].'" '.$required.' class="'.$required.'frm_input" placeholder="'.$mdatas[$fvs][bigo].'" size="'.$mdatas[$fvs][size].'">
							</td>
						</tr>';

					} break;
				case '17':	// 주소
					if($csconfig[$fvs]=='1' || $csconfig[$fvs]=='2'){
						if($csconfig[$fvs]=='2') { $needstr = '<strong class="sound_only">필수</strong>'; $required = 'required '; }
						else { $needstr = ''; $required = ''; }

						$addr_array = explode("|", $write['addre']);
						$write['zip']			= $addr_array[0];
						$write['addre1']		= $addr_array[1];
						$write['addre2']		= $addr_array[2];
						$write['addre3']		= $addr_array[3];
						$write['addre_jibeon']	= $addr_array[4];

						echo '<tr>
							<th scope="row"><label for="ca_name">'.$mdatas[$fvs]['iname'].$needstr.'</label></th>
							<td>
								<label for="reg_mb_zip" class="sound_only">우편번호'.$needstr.'</label>
								<input type="text" name="Nzip" id="reg_Nzip" value="'.$write['zip'].'" '.$required.'class="'.$required.'frm_input" size="6" maxlength="6">
								<button type="button" class="btn_frmline" onclick="win_zip(\'fwrite\', \'Nzip\', \'Naddre1\', \'Naddre2\', \'Naddre3\', \'Naddre_jibeon\');">주소 검색</button><br>
								<input type="text" name="Naddre1" id="reg_Naddre1" value="'.$write['addre1'].'" '.$required.'class="'.$required.'frm_input frm_address" size="'.$mdatas[$fvs][size].'">
								<label for="reg_mb_addr1" class="sound_only">주소'.$needstr.'</label><br>
								<input type="text" name="Naddre2" id="reg_Naddre2" value="'.$write['addre2'].'" class="frm_input frm_address" size="'.$mdatas[$fvs][size].'">
								<label for="reg_mb_addr2" class="sound_only">상세주소</label>
								<br>
								<input type="text" name="Naddre3" id="reg_Naddre3" value="'.$write['addre3'].'" class="frm_input frm_address" size="'.$mdatas[$fvs][size].'" readonly="readonly">
								<label for="reg_mb_addr3" class="sound_only">참고항목</label>
								<input type="hidden" name="Naddre_jibeon" value="'.$write['addre_jibeon'].'">'.$mdatas[$fvs][bigo].'
							</td>
						</tr>';

					} break;
				case '18':	// 직장주소
					if($csconfig[$fvs]=='1' || $csconfig[$fvs]=='2'){
						if($csconfig[$fvs]=='2') { $needstr = '<strong class="sound_only">필수</strong>'; $required = 'required '; }
						else { $needstr = ''; $required = ''; }

						$oaddr_array = explode("|", $write['oaddre']);
						$write['ozip']			= $oaddr_array[0];
						$write['oaddre1']		= $oaddr_array[1];
						$write['oaddre2']		= $oaddr_array[2];
						$write['oaddre3']		= $oaddr_array[3];
						$write['oaddre_jibeon']	= $oaddr_array[4];

						echo '<tr>
							<th scope="row"><label for="ca_name">'.$mdatas[$fvs]['iname'].$needstr.'</label></th>
							<td>
								<label for="reg_mb_zip" class="sound_only">우편번호'.$needstr.'</label>
								<input type="text" name="Nozip" id="reg_Nozip" value="'.$write['ozip'].'" '.$required.'class="'.$required.'frm_input" size="6" maxlength="6">
								<button type="button" class="btn_frmline" onclick="win_zip(\'fwrite\', \'Nozip\', \'Noaddre1\', \'Noaddre2\', \'Noaddre3\', \'Noaddre_jibeon\');">주소 검색</button><br>
								<input type="text" name="Noaddre1" id="reg_Noaddre1" value="'.$write['oaddre1'].'" '.$required.'class="'.$required.'frm_input frm_address" size="'.$mdatas[$fvs][size].'">
								<label for="reg_mb_addr1" class="sound_only">주소'.$needstr.'</label><br>
								<input type="text" name="Noaddre2" id="reg_Noaddre2" value="'.$write['oaddre2'].'" class="frm_input frm_address" size="'.$mdatas[$fvs][size].'">
								<label for="reg_mb_addr2" class="sound_only">상세주소</label>
								<br>
								<input type="text" name="Noaddre3" id="reg_Noaddre3" value="'.$write['oaddre3'].'" class="frm_input frm_address" size="'.$mdatas[$fvs][size].'" readonly="readonly">
								<label for="reg_mb_addr3" class="sound_only">참고항목</label>
								<input type="hidden" name="Noaddre_jibeon" value="'.$write['oaddre_jibeon'].'">'.$mdatas[$fvs][bigo].'
							</td>
						</tr>';

					} break;
				case '19':	// FAX
					if($csconfig[$fvs]=='1' || $csconfig[$fvs]=='2'){
						if($csconfig[$fvs]=='2') { $needstr = '<strong class="sound_only">필수</strong>'; $required = 'required '; }
						else { $needstr = ''; $required = ''; }

						echo '<tr>
							<th scope="row"><label for="ca_name">'.$mdatas[$fvs]['iname'].$needstr.'</label></th>
							<td>
								<input type="text" name="N'.$fvs.'" id="N'.$fvs.'" value="'.$write[$fvs].'" '.$required.' class="'.$required.'frm_input" size="'.$mdatas[$fvs][size].'" placeholder="'.$mdatas[$fvs][bigo].'">
							</td>
						</tr>';

					} break;
				case '2':	// 선택형, 최종학력, 직업, 직종, 관심영역
					if($csconfig[$fvs]=='1' || $csconfig[$fvs]=='2'){
						if($csconfig[$fvs]=='2') { $needstr = '<strong class="sound_only">필수</strong>'; }
						else { $needstr = ''; }
						$Arrays=optArray($fvs,$mdatas);

						echo '<tr>
							<th scope="row"><label for="ca_name">'.$mdatas[$fvs]['iname'].$needstr.'</label></th>
							<td>';
							gen_single_selectbox("",'N'.$fvs,$Arrays,$Arrays,$write[$fvs],'',$mdatas[$fvs]['size2']);
							if($mdatas[$fvs]['bigo']) echo '<span class="text-muted font-12" style="margin-top:4px;">'.get_text($mdatas[$fvs]['bigo'], 1).'</span>';
						echo '</td>
						</tr>';

					} break;
				case '21':	// 생년월일
					if($csconfig[$fvs]=='1' || $csconfig[$fvs]=='2'){
						if($csconfig[$fvs]=='2') { $needstr = '<strong class="sound_only">필수</strong>'; }
						else { $needstr = ''; }

						$ss=0;for($yy=1940; $yy<=2010; $yy++){$Ayears[$ss]=$yy; $ss++;}
						$ss=0;for($yy=1; $yy<=12; $yy++){$Amonths[$ss]=$yy; $ss++;}
						$ss=0;for($yy=1; $yy<=31; $yy++){$Adays[$ss]=$yy; $ss++;}

						echo '<tr>
							<th scope="row"><label for="ca_name">'.$mdatas[$fvs]['iname'].$needstr.'</label></th>
							<td>';

								$ymd_array = explode("-", $write['birth']);
								$write['year']	= $ymd_array[0];
								$write['month']	= $ymd_array[1];
								$write['day']	= $ymd_array[2];

								gen_single_selectbox("","Nyear",$Ayears,$Ayears,$write['year'],'', $mdatas[$fvs]['size2']);
								gen_single_selectbox("","Nmonth",$Amonths,$Amonths,$write['month'],'', $mdatas[$fvs]['size2']);
								gen_single_selectbox("","Nday",$Adays,$Adays,$write['day'],'', $mdatas[$fvs]['size2']);

								if($mdatas[$fvs]['bigo']) echo '<span class="text-muted font-12" style="margin-top:4px;">'.get_text($mdatas[$fvs]['bigo'], 1).'</span>';
						echo '</td>
						</tr>';

					} break;
				case '3':	// 라디오박스
					if($csconfig[$fvs]=='1' || $csconfig[$fvs]=='2'){
						if($csconfig[$fvs]=='2') { $needstr = '<strong class="sound_only">필수</strong>'; }
						else { $needstr = ''; }
						$Arrays=optArray($fvs,$mdatas);

						echo '<tr>
							<th scope="row"><label for="ca_name">'.$mdatas[$fvs]['iname'].$needstr.'</label></th>
							<td>';
								gen_single_radiobox("",'N'.$fvs,$Arrays,$Arrays,$write[$fvs],'',$mdatas[$fvs]['size2']);
								if($mdatas[$fvs]['bigo']) echo '<span class="text-muted font-12" style="margin-top:4px;">'.get_text($mdatas[$fvs]['bigo'], 1).'</span>';
						echo '</td>
						</tr>';

						if($csconfig[$fvs]=='2') {
							$javastr.="
							kk=0;
							for ( ii=0; ii < ".sizeof($Arrays)." ; ii++ ){
								if (document.fwrite.N".$fvs."[ii].checked) {kk=1; ii=".sizeof($Arrays)."; }
							}
							if(kk<1){ alert('".$mdatas[$fvs][iname]."을(를) 선택하여 주십시오.'); document.fwrite.N".$fvs."[0].focus(); return false ;   }
							";
						}

					} break;
				case '31':	// 성별
					if($csconfig[$fvs]=='1' || $csconfig[$fvs]=='2'){
						if($csconfig[$fvs]=='2') { $needstr = '<strong class="sound_only">필수</strong>'; }
						else { $needstr = ''; }

						echo '<tr>
							<th scope="row"><label for="ca_name">'.$mdatas[$fvs]['iname'].$needstr.'</label></th>
							<td>';
								gen_single_radiobox("",'N'.$fvs,Array("남","여"),Array("남","여"),$write[$fvs],'',0);
								if($mdatas[$fvs]['bigo']) echo '<span class="text-muted font-12" style="margin-top:4px;">'.get_text($mdatas[$fvs]['bigo'], 1).'</span>';
						echo '</td>
						</tr>';

						if($csconfig[$fvs]=='2') {
							$javastr.="
							kk=0;
							for ( ii=0; ii < ".sizeof($Arrays)." ; ii++ ){
								if (document.fwrite.N".$fvs."[ii].checked) {kk=1; ii=".sizeof($Arrays)."; }
							}
							if(kk<1){ alert('".$mdatas[$fvs][iname]."을(를) 선택하여 주십시오.'); document.fwrite.N".$fvs."[0].focus(); return false ;   }
							";
						}

					} break;
				case '32':	// 결혼여부
					if($csconfig[$fvs]=='1' || $csconfig[$fvs]=='2'){
						if($csconfig[$fvs]=='2') { $needstr = '<strong class="sound_only">필수</strong>'; }
						else { $needstr = ''; }

						echo '<tr>
							<th scope="row"><label for="ca_name">'.$mdatas[$fvs]['iname'].$needstr.'</label></th>
							<td>';
								gen_single_radiobox("",'N'.$fvs,Array("미혼","기혼"),Array("미혼","기혼"),$write[$fvs],'',0);
								if($mdatas[$fvs]['bigo']) echo '<span class="text-muted font-12" style="margin-top:4px;">'.get_text($mdatas[$fvs]['bigo'], 1).'</span>';
						echo '</td>
						</tr>';

						if($csconfig[$fvs]=='2') {
							$javastr.="
							kk=0;
							for ( ii=0; ii < ".sizeof($Arrays)." ; ii++ ){
								if (document.fwrite.N".$fvs."[ii].checked) {kk=1; ii=".sizeof($Arrays)."; }
							}
							if(kk<1){ alert('".$mdatas[$fvs][iname]."을(를) 선택하여 주십시오.'); document.fwrite.N".$fvs."[0].focus(); return false ;   }
							";
						}

					} break;
				case '4':	// 체크박스
					if($csconfig[$fvs]=='1' || $csconfig[$fvs]=='2'){
						if($csconfig[$fvs]=='2') { $needstr = '<strong class="sound_only">필수</strong>'; }
						else { $needstr = ''; }
						$Arrays=optArray($fvs,$mdatas);

						$ch_array[$fvs] = explode("|", $write[$fvs]);

						echo '<tr>
							<th scope="row"><label for="ca_name">'.$mdatas[$fvs]['iname'].$needstr.'</label></th>
							<td>';
								gen_single_checkbox("",'N'.$fvs,$Arrays,$Arrays,$ch_array[$fvs],'',$mdatas[$fvs]['size2']);
								if($mdatas[$fvs]['bigo']) echo '<span class="text-muted font-12" style="margin-top:4px;">'.get_text($mdatas[$fvs]['bigo'], 1).'</span>';
						echo '</td>
						</tr>';

						if($csconfig[$fvs]=='2') {
							$javastr.="
							kk=0;
							for ( ii=0; ii < ".sizeof($Arrays)." ; ii++ ){
								if (document.fwrite.N".$fvs."[ii].checked) {kk=1; ii=".sizeof($Arrays)."; }
							}
							if(kk<1){ alert('".$mdatas[$fvs][iname]."을(를) 선택하여 주십시오.'); document.fwrite.N".$fvs."[0].focus(); return false ;   }
							";
						}

					} break;
				case '41':	// 메일수신여부
					if($csconfig[$fvs]=='1' || $csconfig[$fvs]=='2'){
						if($csconfig[$fvs]=='2') { $needstr = '<strong class="sound_only">필수</strong>'; }
						else { $needstr = ''; }

						if($write[$fvs]) $emailcheck='checked'; else $emailcheck='';

						echo '<tr>
							<th scope="row"><label for="ca_name">'.$mdatas[$fvs]['iname'].$needstr.'</label></th>
							<td>';

						echo '<label class="checkbox-inline">
								<input type="checkbox" name="N'.$fvs.'" id="N'.$fvs.'" value="1" '.$emailcheck.' style="border:0;"> 메일수신동의
								</label>';
								if($mdatas[$fvs]['bigo']) echo '<span class="text-muted font-12" style="margin-top:4px;">'.get_text($mdatas[$fvs]['bigo'], 1).'</span>';
						echo '</td>
						</tr>';

					} break;
				case '5':	//긴문장입력형1
					if($csconfig[$fvs]=='1' || $csconfig[$fvs]=='2'){
						if($csconfig[$fvs]=='2') { $needstr = '<strong class="sound_only">필수</strong>'; $required = 'required '; }
						else { $needstr = ''; $required = ''; }

						echo '<tr>
							<th scope="row"><label for="ca_name">'.$mdatas[$fvs]['iname'].$needstr.'</label></th>
							<td>';

								if($csconfig['cf_txt_editor']) echo editor_html('N'.$fvs, get_text($write[$fvs], 0));
								else echo '<textarea name="N'.$fvs.'" id="N'.$fvs.'"'.$required.' class="'.$required.'form-control input-sm" rows="'.$mdatas[$fvs]['size2'].'">'.$write[$fvs].'</textarea>';

								if($mdatas[$fvs]['bigo']) echo '<span class="text-muted font-12" style="margin-top:4px;">'.get_text($mdatas[$fvs]['bigo'], 1).'</span>';
						echo '</td>
						</tr>';

						if($csconfig['cf_txt_editor']) $javastr .= get_editor_js('N'.$fvs);

					} break;
				default:  break;
			}	//switch
		}	//for
		?>

        <tr>
            <th scope="row"><label for="wr_content">내용<strong class="sound_only">필수</strong></label></th>
            <td class="wr_content">
                <?php if($write_min || $write_max) { ?>
                <!-- 최소/최대 글자 수 사용 시 -->
                <p id="char_count_desc">이 게시판은 최소 <strong><?php echo $write_min; ?></strong>글자 이상, 최대 <strong><?php echo $write_max; ?></strong>글자 이하까지 글을 쓰실 수 있습니다.</p>
                <?php } ?>
                <?php echo $editor_html; // 에디터 사용시는 에디터로, 아니면 textarea 로 노출 ?>
                <?php if($write_min || $write_max) { ?>
                <!-- 최소/최대 글자 수 사용 시 -->
                <div id="char_count_wrap"><span id="char_count"></span>글자</div>
                <?php } ?>
            </td>
        </tr>

        <?php for ($i=1; $is_link && $csconfig['cf_link'] && $i<=G5_LINK_COUNT; $i++) { ?>
        <tr>
            <th scope="row"><label for="wr_link<?php echo $i ?>">링크 #<?php echo $i ?></label></th>
            <td><input type="url" name="wr_link<?php echo $i ?>" value="<?php if($w=="u"){echo$write['wr_link'.$i];} ?>" id="wr_link<?php echo $i ?>" class="frm_input wr_link"></td>
        </tr>
        <?php } ?>

        <?php for ($i=0; $is_file && $csconfig['cf_files'] && $i<$file_count; $i++) { ?>
        <tr>
            <th scope="row">파일 #<?php echo $i+1 ?></th>
            <td>
                <input type="file" name="bf_file[]" title="파일첨부 <?php echo $i+1 ?> :  용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" class="frm_file frm_input">
                <?php if ($is_file_content) { ?>
                <input type="text" name="bf_content[]" value="<?php echo ($w == 'u') ? $file[$i]['bf_content'] : ''; ?>" title="파일 설명을 입력해주세요." class="frm_file frm_input">
                <?php } ?>
                <?php if($w == 'u' && $file[$i]['file']) { ?>
                <input type="checkbox" id="bf_file_del<?php echo $i ?>" name="bf_file_del[<?php echo $i; ?>]" value="1"> <label for="bf_file_del<?php echo $i ?>"><?php echo $file[$i]['source'].'('.$file[$i]['size'].')'; ?> 파일 삭제</label>
                <?php } ?>
            </td>
        </tr>
        <?php } ?>

        <?php if ($is_guest) { //자동등록방지 ?>
        <tr>
            <th scope="row">자동등록방지</th>
            <td>
                <?php echo $captcha_html ?>
            </td>
        </tr>
        <?php } ?>

        </tbody>
        </table>
    </div>

    <div class="btn_confirm">
        <input type="submit" value="작성완료" id="btn_submit" class="btn_submit" accesskey="s">
        <a href="./board.php?bo_table=<?php echo $bo_table ?>" class="btn_cancel">취소</a>
    </div>
    </form>

<script>
<?php if($write_min || $write_max) { ?>
// 글자수 제한
var char_min = parseInt(<?php echo $write_min; ?>); // 최소
var char_max = parseInt(<?php echo $write_max; ?>); // 최대
check_byte("wr_content", "char_count");

$(function() {
    $("#wr_content").on("keyup", function() {
        check_byte("wr_content", "char_count");
    });
});

<?php } ?>
function html_auto_br(obj)
{
    if (obj.checked) {
        result = confirm("자동 줄바꿈을 하시겠습니까?\n\n자동 줄바꿈은 게시물 내용중 줄바뀐 곳을<br>태그로 변환하는 기능입니다.");
        if (result)
            obj.value = "html2";
        else
            obj.value = "html1";
    }
    else
        obj.value = "";
}

function fwrite_submit(f)
{
	<?php if(!$csconfig['cf_subject']) { ?>
	f.wr_subject.value = f.wr_name.value + "님의 심사원등록신청서";
	<?php } ?>

	<?php if (!$w && $csconfig['cf_agree'] == "2") { ?>

	if (!f.agree.checked) {
		alert("심사원등록약관의 내용에 동의하셔야 심사원등록 하실 수 있습니다.");
		f.agree.focus();
		return false;
	}
	<?php } ?>

	<?=$javastr?>

    <?php echo $editor_js; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>

    var subject = "";
    var content = "";
    $.ajax({
        url: g5_bbs_url+"/ajax.filter.php",
        type: "POST",
        data: {
            "subject": f.wr_subject.value,
            "content": f.wr_content.value
        },
        dataType: "json",
        async: false,
        cache: false,
        success: function(data, textStatus) {
            subject = data.subject;
            content = data.content;
        }
    });

    if (subject) {
        alert("제목에 금지단어('"+subject+"')가 포함되어있습니다");
        f.wr_subject.focus();
        return false;
    }

    if (content) {
        alert("내용에 금지단어('"+content+"')가 포함되어있습니다");
        if (typeof(ed_wr_content) != "undefined")
            ed_wr_content.returnFalse();
        else
            f.wr_content.focus();
        return false;
    }

    if (document.getElementById("char_count")) {
        if (char_min > 0 || char_max > 0) {
            var cnt = parseInt(check_byte("wr_content", "char_count"));
            if (char_min > 0 && char_min > cnt) {
                alert("내용은 "+char_min+"글자 이상 쓰셔야 합니다.");
                return false;
            }
            else if (char_max > 0 && char_max < cnt) {
                alert("내용은 "+char_max+"글자 이하로 쓰셔야 합니다.");
                return false;
            }
        }
    }

     <?php echo $captcha_js; // 캡챠 사용시 자바스크립트에서 입력된 캡챠를 검사함  ?>

    document.getElementById("btn_submit").disabled = "disabled";

    return true;
}
</script>
