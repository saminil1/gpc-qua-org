<?php
$sub_menu = '300930';
include_once('./_common.php');

include_once(G5_EDITOR_LIB);

auth_check($auth[$sub_menu], "w");

if($csconfig['cf_bo_table']){
	if (isset($wr_id) && $wr_id){
		$write = sql_fetch(" select * from {$csconfig['cf_bo_table']} where wr_id = '$wr_id' ");
	}else{
		alert('등록된 자료가 없습니다.');
	}
}else{
	alert("완라인 환경설정 > 환경설정 > 게시판명을 입력하세요.", "counsel_config.php");
}

$name = get_sideview($write['mb_id'], get_text($write['wr_name']), $write['mb_email'], $write['mb_homepage']);

$g5['title'] = ' 심사원등록 상세정보';
include_once (G5_ADMIN_PATH.'/admin.head.php');

$qstr .= ($qstr ? '&amp;' : '').'sca='.$sca;
?>
<style>
#fwrite .frm_address {margin:5px 0 0}
#fwrite #addr3 {display:inline-block;margin:5px 0 0;vertical-align:middle}
#fwrite #addr_jibeon {display:block;margin:5px 0 0}
#fwrite #oaddr3 {display:inline-block;margin:5px 0 0;vertical-align:middle}
#fwrite #oaddr_jibeon {display:block;margin:5px 0 0}
</style>

<form name="fwrite" id="fwrite" method="post" action="./counsel_formupdate.php" onsubmit="return counsel_submit(this);">
<input type="hidden" name="w" value="<?php echo $w; ?>">
<input type="hidden" name="wr_id" value="<?php echo $wr_id; ?>">
<input type="hidden" name="sca" value="<?php echo $sca; ?>">
<input type="hidden" name="sst" value="<?php echo $sst; ?>">
<input type="hidden" name="sod" value="<?php echo $sod; ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl; ?>">
<input type="hidden" name="stx" value="<?php echo $stx; ?>">
<input type="hidden" name="page" value="<?php echo $page; ?>">


<div class="tbl_frm01 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?> 수정</caption>
    <colgroup>
        <col class="grid_4">
        <col>
    </colgroup>
    <tbody>
    <tr>
        <th scope="row">이름</th>
        <td><?php echo $name; ?></td>
    </tr>
    <tr>
        <th scope="row"><label for="wr_subject">제목</label></th>
        <td><input type="text" name="wr_subject" required class="required frm_input" id="wr_subject" size="100"
        value="<?php echo get_text($write['wr_subject']); ?>"></td>
    </tr>
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
								<input type="text" name="N'.$fvs.'" id="N'.$fvs.'" value="'.$write[$fvs].'" '.$required.' class="'.$required.'frm_input" size="'.$mdatas[$fvs][size].'" placeholder="'.$mdatas[$fvs][bigo].'">
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
								<input type="text" name="N'.$fvs.'" id="N'.$fvs.'" value="'.$write[$fvs].'" '.$required.' class="'.$required.'frm_input" size="'.$mdatas[$fvs][size].'" placeholder="'.$mdatas[$fvs][bigo].'">
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
								<input type="text" name="N'.$fvs.'" id="N'.$fvs.'" value="'.$write[$fvs].'" '.$required.' class="'.$required.'frm_input" size="'.$mdatas[$fvs][size].'" placeholder="'.$mdatas[$fvs][bigo].'">
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
								<input type="text" name="N'.$fvs.'" id="N'.$fvs.'" value="'.$write[$fvs].'" '.$required.' class="'.$required.'frm_input" size="'.$mdatas[$fvs][size].'" placeholder="'.$mdatas[$fvs][bigo].'">
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
								<input type="text" name="N'.$fvs.'" id="N'.$fvs.'" value="'.$write[$fvs].'" '.$required.' class="'.$required.'frm_input" size="'.$mdatas[$fvs][size].'" placeholder="'.$mdatas[$fvs][bigo].'">
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
								<input type="text" name="N'.$fvs.'" id="N'.$fvs.'" value="'.$write[$fvs].'" '.$required.' class="'.$required.'frm_input" size="'.$mdatas[$fvs][size].'" placeholder="'.$mdatas[$fvs][bigo].'">
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
								<input type="text" name="N'.$fvs.'" id="N'.$fvs.'" value="'.$write[$fvs].'" '.$required.' class="'.$required.'frm_input" size="'.$mdatas[$fvs][size].'" placeholder="'.$mdatas[$fvs][bigo].'">
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
								<input type="text" name="Naddre1" id="reg_Naddre1" value="'.$write['addre1'].'" '.$required.'class="'.$required.'frm_input frm_address" size="'.$mdatas[$fvs][size].'" placeholder="기본주소">
								<label for="reg_mb_addr1">기본주소'.$needstr.'</label><br>
								<input type="text" name="Naddre2" id="reg_Naddre2" value="'.$write['addre2'].'" class="frm_input frm_address" size="'.$mdatas[$fvs][size].'" placeholder="상세주소">
								<label for="reg_mb_addr2">상세주소</label>
								<br>
								<input type="text" name="Naddre3" id="reg_Naddre3" value="'.$write['addre3'].'" class="frm_input frm_address" size="'.$mdatas[$fvs][size].'" readonly="readonly" placeholder="참고항목">
								<label for="reg_mb_addr3">참고항목</label>
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
								<input type="text" name="Noaddre1" id="reg_Noaddre1" value="'.$write['oaddre1'].'" '.$required.'class="'.$required.'frm_input frm_address" size="'.$mdatas[$fvs][size].'" placeholder="기본주소">
								<label for="reg_mb_addr1">기본주소'.$needstr.'</label><br>
								<input type="text" name="Noaddre2" id="reg_Noaddre2" value="'.$write['oaddre2'].'" class="frm_input frm_address" size="'.$mdatas[$fvs][size].'" placeholder="상세주소">
								<label for="reg_mb_addr2">상세주소</label>
								<br>
								<input type="text" name="Noaddre3" id="reg_Noaddre3" value="'.$write['oaddre3'].'" class="frm_input frm_address" size="'.$mdatas[$fvs][size].'" readonly="readonly" placeholder="참고항목">
								<label for="reg_mb_addr3">참고항목</label>
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
        <th scope="row">내용</th>
        <td><?php echo editor_html('wr_content', get_text($write['wr_content'], 0)); ?></td>
    </tr>
    <tr>
		<th scope="row"><label for="effect">결과</label></th>
		<td>
			<?php gen_single_selectbox("",'effect',Array("접수중","접수완료","접수취소"),Array("0","1","2"),$write['effect'],'',0); ?>
		</td>
	</tr>
    </tbody>
    </table>
</div>

<div class="btn_confirm01 btn_confirm">
    <input type="submit" value="확인" class="btn_submit" accesskey="s">
    <a href="./counsel_list.php?<?php echo $qstr; ?>">목록</a>
</div>
</form>

<script>
function counsel_submit(f)
{
	<?=$javastr?>

    <?php echo get_editor_js('wr_content'); ?>

    return true;
}
</script>

<?php
include_once (G5_ADMIN_PATH.'/admin.tail.php');
?>
