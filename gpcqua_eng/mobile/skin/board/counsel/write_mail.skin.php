<?php
// E-mail 수정시 인증 메일 (회원님께 발송)
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

$sql = " select * from {$g5['counsel_item_table']} order by mno ";
$result = sql_query($sql);

$data['addre']	 = $_POST['Nzip']."|".$_POST['Naddre1']."|".$_POST['Naddre2']."|".$_POST['Naddre3']."|".$_POST['Naddre_jibeon'];
$data['tel']	 = $_POST['Ntel'];
$data['hphone']	 = $_POST['Nhphone'];

$data['oaddre']	 = $_POST['Nozip']."|".$_POST['Noaddre1']."|".$_POST['Noaddre2']."|".$_POST['Noaddre3']."|".$_POST['Noaddre_jibeon'];
$data['otel']	 = $_POST['Notel'];

$data['fax']	 = $_POST['Nfax'];
$data['ename']	 = $_POST['Nename'];
$data['sex']	 = $_POST['Nsex'];
$data['birth']	 = $_POST['Nyear'].'-'.$_POST['Nmonth'].'-'.$_POST['Nday'];
$data['merry']	 = $_POST['Nmerry'];

$data['grade']	 = $_POST['Ngrade'];
$data['bizno']	 = $_POST['Nbizno'];
$data['job']	 = $_POST['Njob'];
$data['duty']	 = $_POST['Nduty'];
$data['likes']	 = $_POST['Nlikes'];
$data['emailok'] = $_POST['Nemailok'];
$data['rcid']	 = $_POST['Nrcid'];

$data['input1']  = $_POST['Ninput1'];
$data['input2']  = $_POST['Ninput2'];
$data['input3']  = $_POST['Ninput3'];
$data['input4']  = $_POST['Ninput4'];
$data['input5']  = $_POST['Ninput5'];
$data['input6']  = $_POST['Ninput6'];
$data['input7']  = $_POST['Ninput7'];
$data['input8']  = $_POST['Ninput8'];
$data['input9']  = $_POST['Ninput9'];
$data['input10']  = $_POST['Ninput10'];

$data['select1'] = $_POST['Nselect1'];
$data['select2'] = $_POST['Nselect2'];
$data['select3'] = $_POST['Nselect3'];
$data['select4'] = $_POST['Nselect4'];
$data['select5'] = $_POST['Nselect5'];
$data['select6'] = $_POST['Nselect6'];
$data['select7'] = $_POST['Nselect7'];
$data['select8'] = $_POST['Nselect8'];
$data['select9'] = $_POST['Nselect9'];
$data['select10'] = $_POST['Nselect10'];

$data['radio1']  = $_POST['Nradio1'];
$data['radio2']  = $_POST['Nradio2'];
$data['radio3']  = $_POST['Nradio3'];
$data['radio4']  = $_POST['Nradio4'];
$data['radio5']  = $_POST['Nradio5'];
$data['radio6']  = $_POST['Nradio6'];
$data['radio7']  = $_POST['Nradio7'];
$data['radio8']  = $_POST['Nradio8'];
$data['radio9']  = $_POST['Nradio9'];
$data['radio10']  = $_POST['Nradio10'];
$data['radio11']  = $_POST['Nradio11'];
$data['radio12']  = $_POST['Nradio12'];

$data['check1']  = $_POST['Ncheck1'];
$data['check2']  = $_POST['Ncheck2'];
$data['check3']  = $_POST['Ncheck3'];
$data['check4']  = $_POST['Ncheck4'];
$data['check5']  = $_POST['Ncheck5'];
$data['check6']  = $_POST['Ncheck6'];
$data['check7']  = $_POST['Ncheck7'];
$data['check8']  = $_POST['Ncheck8'];
$data['check9']  = $_POST['Ncheck9'];
$data['check10']  = $_POST['Ncheck10'];

$data['txt1']  = $_POST['Ntxt1'];
$data['txt2']  = $_POST['Ntxt2'];
$data['txt3']  = $_POST['Ntxt3'];
$data['txt4']  = $_POST['Ntxt4'];
$data['txt5']  = $_POST['Ntxt5'];

?>

<!doctype html>
<html lang="ko">
<head>
<meta charset="utf-8">
<title>심사원등록 메일</title>
</head>

<body>

<div style="margin:30px auto;width:600px;border:10px solid #f7f7f7">
    <div style="border:1px solid #dedede">
			<?php if (!$view['reply']) { ?>
			<table>
				<tbody>
				<tr>
					<th scope="row" style="width:150px;height:35px;border-right:1px solid #e7f1ed;border-bottom:1px solid #e7f1ed;"><label for="wr_name">이름</label></th>
					<td style="width:450px;margin-left:10px;border-bottom:1px solid #e7f1ed;"><?php echo $wr_name; ?></td>
				</tr>
				<tr>
					<th scope="row" style="width:150px;height:35px;border-right:1px solid #e7f1ed;border-bottom:1px solid #e7f1ed;"><label for="wr_email">E-mail</label></th>
					<td style="width:450px;margin-left:10px;border-bottom:1px solid #e7f1ed;"><?php echo $wr_email; ?></td>
				</tr>
				<?php if ($is_homepage) { ?>
				<tr>
					<th scope="row" style="width:150px;height:35px;border-right:1px solid #e7f1ed;border-bottom:1px solid #e7f1ed;"><label for="wr_homepage">홈페이지</label></th>
					<td style="width:450px;margin-left:10px;border-bottom:1px solid #e7f1ed;"><?php echo $wr_homepage; ?></td>
				</tr>
				<?php } ?>

				<?php
				$mdatas = Array() ;
				for ($i=0; $row=sql_fetch_array($result); $i++) {

					$fvs=$row[icode];

					$mdatas[$fvs][icode]=trim($row[icode]);
					$mdatas[$fvs][iname]=trim(stripslashes($row[iname]));
					$mdatas[$fvs][size]=trim($row[size]);
					$mdatas[$fvs][size2]=trim($row[size2]);
					$mdatas[$fvs][editor]=trim($row[editor]);
					$mdatas[$fvs][bigo]=trim(stripslashes($row[bigo]));
					$mdatas[$fvs][type]=$row[type];
					$mdatas[$fvs][1]=trim(stripslashes($row[it1]));
					$mdatas[$fvs][2]=trim(stripslashes($row[it2]));
					$mdatas[$fvs][3]=trim(stripslashes($row[it3]));
					$mdatas[$fvs][4]=trim(stripslashes($row[it4]));
					$mdatas[$fvs][5]=trim(stripslashes($row[it5]));
					$mdatas[$fvs][6]=trim(stripslashes($row[it6]));
					$mdatas[$fvs][7]=trim(stripslashes($row[it7]));
					$mdatas[$fvs][8]=trim(stripslashes($row[it8]));
					$mdatas[$fvs][9]=trim(stripslashes($row[it9]));
					$mdatas[$fvs][10]=trim(stripslashes($row[it10]));
					$mdatas[$fvs][11]=trim(stripslashes($row[it11]));
					$mdatas[$fvs][12]=trim(stripslashes($row[it12]));
					$mdatas[$fvs][13]=trim(stripslashes($row[it13]));
					$mdatas[$fvs][14]=trim(stripslashes($row[it14]));
					$mdatas[$fvs][15]=trim(stripslashes($row[it15]));
					$mdatas[$fvs][16]=trim(stripslashes($row[it16]));
					$mdatas[$fvs][17]=trim(stripslashes($row[it17]));
					$mdatas[$fvs][18]=trim(stripslashes($row[it18]));
					$mdatas[$fvs][19]=trim(stripslashes($row[it19]));
					$mdatas[$fvs][20]=trim(stripslashes($row[it20]));
					$mdatas[$fvs][21]=trim(stripslashes($row[it21]));
					$mdatas[$fvs][22]=trim(stripslashes($row[it22]));
					$mdatas[$fvs][23]=trim(stripslashes($row[it23]));
					$mdatas[$fvs][24]=trim(stripslashes($row[it24]));
					$mdatas[$fvs][25]=trim(stripslashes($row[it25]));
					$mdatas[$fvs][26]=trim(stripslashes($row[it26]));
					$mdatas[$fvs][27]=trim(stripslashes($row[it27]));
					$mdatas[$fvs][28]=trim(stripslashes($row[it28]));
					$mdatas[$fvs][29]=trim(stripslashes($row[it29]));
					$mdatas[$fvs][30]=trim(stripslashes($row[it30]));

					switch($row[type]){
						case '1': //셀렉트박스
							if($csconfig[$fvs]!='0'){
							echo '<tr>
								<th scope="row" style="width:150px;height:35px;border-right:1px solid #e7f1ed;border-bottom:1px solid #e7f1ed;"><label for="'.$fvs.'">'.$mdatas[$fvs][iname].'</label></th>
								<td style="width:450px;margin-left:10px;border-bottom:1px solid #e7f1ed;">'.$data[$fvs].'</td>
							</tr>';
						} break;

						case '11': //영문이름
							if($csconfig[$fvs]!='0'){
							echo '<tr>
								<th scope="row" style="width:150px;height:35px;border-right:1px solid #e7f1ed;border-bottom:1px solid #e7f1ed;"><label for="'.$fvs.'">'.$mdatas[$fvs][iname].'</label></th>
								<td style="width:450px;margin-left:10px;border-bottom:1px solid #e7f1ed;">'.$data[$fvs].'</td>
							</tr>';
						} break;

						case '12': // 전화번호
							if($csconfig[$fvs]!='0'){
							echo '<tr>
								<th scope="row" style="width:150px;height:35px;border-right:1px solid #e7f1ed;border-bottom:1px solid #e7f1ed;"><label for="'.$fvs.'">'.$mdatas[$fvs][iname].'</label></th>
								<td style="width:450px;margin-left:10px;border-bottom:1px solid #e7f1ed;">'.$data[$fvs].'</td>
							</tr>';
						} break;

						case '13': // 직장전화번호
							if($csconfig[$fvs]!='0'){
							echo '<tr>
								<th scope="row" style="width:150px;height:35px;border-right:1px solid #e7f1ed;border-bottom:1px solid #e7f1ed;"><label for="'.$fvs.'">'.$mdatas[$fvs][iname].'</label></th>
								<td style="width:450px;margin-left:10px;border-bottom:1px solid #e7f1ed;">'.$data[$fvs].'</td>
							</tr>';
						} break;

						case '14': // 휴대폰번호
							if($csconfig[$fvs]!='0'){
							echo '<tr>
								<th scope="row" style="width:150px;height:35px;border-right:1px solid #e7f1ed;border-bottom:1px solid #e7f1ed;"><label for="'.$fvs.'">'.$mdatas[$fvs][iname].'</label></th>
								<td style="width:450px;margin-left:10px;border-bottom:1px solid #e7f1ed;">'.$data[$fvs].'</td>
							</tr>';
						} break;

						case '15'://추천인
							if($csconfig[$fvs]!='0'){
							echo '<tr>
								<th scope="row" style="width:150px;height:35px;border-right:1px solid #e7f1ed;border-bottom:1px solid #e7f1ed;"><label for="'.$fvs.'">'.$mdatas[$fvs][iname].'</label></th>
								<td style="width:450px;margin-left:10px;border-bottom:1px solid #e7f1ed;">'.$data[$fvs].'</td>
							</tr>';
						} break;

						case '16': //심사원등록번호
							if($csconfig[$fvs]!='0'){
							echo '<tr>
								<th scope="row" style="width:150px;height:35px;border-right:1px solid #e7f1ed;border-bottom:1px solid #e7f1ed;"><label for="'.$fvs.'">'.$mdatas[$fvs][iname].'</label></th>
								<td style="width:450px;margin-left:10px;border-bottom:1px solid #e7f1ed;">'.$data[$fvs].'</td>
							</tr>';
						} break;

						case '17': //주소
							if($csconfig[$fvs]!='0'){

							$addr_array = explode("|", $data['addre']);
							$data['zip']			= $addr_array[0];
							$data['addre1']		= $addr_array[1];
							$data['addre2']		= $addr_array[2];
							$data['addre3']		= $addr_array[3];
							$data['addre_jibeon']	= $addr_array[4];

							echo '<tr>
								<th scope="row" style="width:150px;height:35px;border-right:1px solid #e7f1ed;border-bottom:1px solid #e7f1ed;"><label for="'.$fvs.'">'.$mdatas[$fvs][iname].'</label></th>
								<td style="width:450px;margin-left:10px;border-bottom:1px solid #e7f1ed;">['.$data['zip'].'] '.$data['addre1'].''.$data['addre2'].''.$data['addre3'].''.$data['addre_jibeon'].'</td>
							</tr>';
						} break;

						case '18': //직장주소
							if($csconfig[$fvs]!='0'){

							$addr_array = explode("|", $data['oaddre']);
							$data['ozip']			= $addr_array[0];
							$data['oaddre1']		= $addr_array[1];
							$data['oaddre2']		= $addr_array[2];
							$data['oaddre3']		= $addr_array[3];
							$data['oaddre_jibeon']	= $addr_array[4];

							echo '<tr>
								<th scope="row" style="width:150px;height:35px;border-right:1px solid #e7f1ed;border-bottom:1px solid #e7f1ed;"><label for="'.$fvs.'">'.$mdatas[$fvs][iname].'</label></th>
								<td style="width:450px;margin-left:10px;border-bottom:1px solid #e7f1ed;">['.$data['ozip'].'] '.$data['oaddre1'].''.$data['oaddre2'].''.$data['oaddre3'].''.$data['oaddre_jibeon'].'</td>
							</tr>';
						} break;

						case '19': //FAX
							if($csconfig[$fvs]!='0'){
							echo '<tr>
								<th scope="row" style="width:150px;height:35px;border-right:1px solid #e7f1ed;border-bottom:1px solid #e7f1ed;"><label for="'.$fvs.'">'.$mdatas[$fvs][iname].'</label></th>
								<td style="width:450px;margin-left:10px;border-bottom:1px solid #e7f1ed;">'.$data[$fvs].'</td>
							</tr>';
						} break;

						case '2': //텍스트
							if($csconfig[$fvs]!='0'){
							echo '<tr>
								<th scope="row" style="width:150px;height:35px;border-right:1px solid #e7f1ed;border-bottom:1px solid #e7f1ed;"><label for="'.$fvs.'">'.$mdatas[$fvs][iname].'</label></th>
								<td style="width:450px;margin-left:10px;border-bottom:1px solid #e7f1ed;">'.$data[$fvs].'</td>
							</tr>';
						} break;

						case '21': //생년월일
							if($csconfig[$fvs]!='0'){

							$ymd_array = explode("-", $data['birth']);
							$data['year']	= $ymd_array[0];
							$data['month']	= $ymd_array[1];
							$data['day']	= $ymd_array[2];

							echo '<tr>
								<th scope="row" style="width:150px;height:35px;border-right:1px solid #e7f1ed;border-bottom:1px solid #e7f1ed;"><label for="'.$fvs.'">'.$mdatas[$fvs][iname].'</label></th>
								<td style="width:450px;margin-left:10px;border-bottom:1px solid #e7f1ed;">'.$data['year'].'년 '.$data['month'].'월 '.$data['day'].'일</td>
							</tr>';
						} break;

						case '3': //라디오
							if($csconfig[$fvs]!='0'){
							echo '<tr>
								<th scope="row" style="width:150px;height:35px;border-right:1px solid #e7f1ed;border-bottom:1px solid #e7f1ed;"><label for="'.$fvs.'">'.$mdatas[$fvs][iname].'</label></th>
								<td style="width:450px;margin-left:10px;border-bottom:1px solid #e7f1ed;">'.$data[$fvs].'</td>
							</tr>';
						} break;

						case '31': //성별
							if($csconfig[$fvs]!='0'){
							echo '<tr>
								<th scope="row" style="width:150px;height:35px;border-right:1px solid #e7f1ed;border-bottom:1px solid #e7f1ed;"><label for="'.$fvs.'">'.$mdatas[$fvs][iname].'</label></th>
								<td style="width:450px;margin-left:10px;border-bottom:1px solid #e7f1ed;">'.$data[$fvs].'</td>
							</tr>';
						} break;

						case '32': //결혼여부
							if($csconfig[$fvs]!='0'){
							echo '<tr>
								<th scope="row" style="width:150px;height:35px;border-right:1px solid #e7f1ed;border-bottom:1px solid #e7f1ed;"><label for="'.$fvs.'">'.$mdatas[$fvs][iname].'</label></th>
								<td style="width:450px;margin-left:10px;border-bottom:1px solid #e7f1ed;">'.$data[$fvs].'</td>
							</tr>';
						} break;

						case '4'://체크박스
							if($csconfig[$fvs]!='0'){

							$Arrays=optArray($fvs,$mdatas);
							$check_item = "";
							for( $i = 0; $i < count( $Arrays ); $i++ ){
								if ( $Arrays[ $i ] == $data[$fvs][$i] ){
								$check_item .= '<font color=red>' . $Arrays[ $i ] .'</font>&nbsp;&nbsp;';
								} else {
								$check_item .= $Arrays[ $i ].'</font>&nbsp;&nbsp;';
								}
							}
							echo '<tr>
								<th scope="row" style="width:150px;height:35px;border-right:1px solid #e7f1ed;border-bottom:1px solid #e7f1ed;"><label for="'.$fvs.'">'.$mdatas[$fvs][iname].'</label></th>
								<td style="width:450px;margin-left:10px;border-bottom:1px solid #e7f1ed;">'.$check_item.'</td>
							</tr>';
						} break;

						case '41': //메일수신여부
							if($csconfig[$fvs]!='0'){
							$emailcheck = ($data[$fvs]=='1')?'메일수신동의':'메일수신동의하지 않음';

							echo '<tr>
								<th scope="row" style="width:150px;height:35px;border-right:1px solid #e7f1ed;border-bottom:1px solid #e7f1ed;"><label for="'.$fvs.'">'.$mdatas[$fvs][iname].'</label></th>
								<td style="width:450px;margin-left:10px;border-bottom:1px solid #e7f1ed;">'.$emailcheck.'</td>
							</tr>';
						} break;

						case '5': //긴분장
							if($csconfig[$fvs]!='0'){

							echo '<tr>
								<th scope="row" style="width:150px;height:35px;border-right:1px solid #e7f1ed;border-bottom:1px solid #e7f1ed;"><label for="'.$fvs.'">'.$mdatas[$fvs][iname].'</label></th>
								<td style="width:450px;margin-left:10px;border-bottom:1px solid #e7f1ed;">'.$data[$fvs].'</td>
							</tr>';
						} break;

					}// end switch
					unset($needstr);
				}
				?>
				<tr>
					<th scope="row" style="width:150px;height:35px;border-right:1px solid #e7f1ed;border-bottom:1px solid #e7f1ed;"><label for="wr_subject">제목</label></th>
					<td style="width:450px;margin-left:10px;border-bottom:1px solid #e7f1ed;"><?php echo $wr_subject; ?></td>
				</tr>
				<tr>
					<td colspan="2" style="padding:15px;"><?php echo $wr_content; ?></td>
				</tr>
				</tbody>
			</table>
			<?php } ?>
    </div>
</div>

</body>
</html>
