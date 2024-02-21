<?php
$sub_menu = '300900';
include_once('./_common.php');

auth_check($auth[$sub_menu], 'w');

$g5['title'] = '항목 등록 및 수정';
include_once(G5_PATH.'/head.sub.php');

$qstr = 'item='.$item.'&amp;inum='.$inum.'&amp;itemname='.$itemname;

$frm_submit = '<div class="btn_confirm01 btn_confirm">
    <input type="submit" value="확인" class="btn_submit">
	<a href="./counsel_open.php?'.$qstr.'">취소</a>
	<a href="javascript:;" onclick="window.close();">닫기</a>
</div>';

if($mode=='100'){
	$sql = " update {$g5['counsel_item_table']} set iname='$Niname', size='$Nsize', size2='$Nsize2', type='$Ntype', bigo='$Nbigo',
	it1='$Nit1', it2='$Nit2', it3='$Nit3', it4='$Nit4', it5='$Nit5'
	,it6='$Nit6', it7='$Nit7', it8='$Nit8', it9='$Nit9', it10='$Nit10', it11='$Nit11', it12='$Nit12', it13='$Nit13', it14='$Nit14'
	,it15='$Nit15', it16='$Nit16', it17='$Nit17', it18='$Nit18', it19='$Nit19', it20='$Nit20', it21='$Nit21', it22='$Nit22', it23='$Nit23'
	,it24='$Nit24', it25='$Nit25', it26='$Nit26', it27='$Nit27', it28='$Nit28', it29='$Nit29', it30='$Nit30' where icode='$item' ";
	sql_query($sql);

	goto_url("./counsel_open.php?item=".$item."&inum=".$inum."&itemname=".$itemname);
}

$sql="select * from {$g5['counsel_item_table']} where icode='$item' ";
$row = sql_fetch($sql);

if(!$row['icode']) {
	$sql = "select max(num) as Nmno from {$g5['counsel_item_table']} ";
	$row = sql_fetch($sql);
	$Nmno = $row['Nmno']+1;

	$sql="insert into {$g5['counsel_item_table']} (mno,icode,iname) values($Nmno,'$item','$itemname') ";
	sql_query($sql);

	$sql="select * from {$g5['counsel_item_table']} where icode='$item' ";
	$row = sql_fetch($sql);
}

?>
<form name="fconfigform" id="fconfigform" action="./counsel_open.php" method="post" onsubmit="return fconfigform_submit(this);">
<input type="hidden" name="mode" id="mode" value="100">
<input type="hidden" name="item" id="item" value="<?php echo $item ?>">
<input type="hidden" name="inum" id="inum" value="<?php echo $inum ?>">
<input type="hidden" name="Ntype" id="Ntype" value="<?php echo $inum ?>">

<section id="anc_cf_output">
    <h2 class="h2_frm"><?php echo $g5['title'] ?></h2>

    <div class="tbl_frm01 tbl_wrap">
        <table>
        <caption>항목 등록 및 수정</caption>
        <colgroup>
            <col class="grid_2" style="width:150px;">
            <col>
        </colgroup>
        <tbody>
        <tr>
            <th scope="row"><label for="Niname">항목이름</label></th>
            <td>
				<?php echo help("항목마다 표시되는 이름"); ?>
                <input type="text" name="Niname" value='<?php echo $row['iname']; ?>' id="Niname" class="frm_input" size="40">
            </td>
        </tr>
		<tr>
            <th scope="row"><label for="ca_default">도움말</label></th>
            <td>
				<?php echo help("도움말이 필요하면 입력합니다."); ?>
				<textarea name="Nbigo" id="Nbigo" class="frm_input" rows="50"><?php echo $row['bigo']; ?></textarea>
            </td>
        </tr>
		<?php
		if($inum==1 || $inum==11 || $inum==12 || $inum==13 || $inum==14 || $inum==15 || $inum==16 || $inum==17 || $inum==18 || $inum==19){
		if(strlen($row[size])<1) $lalaSize = 30;
		else $lalaSize = $row[size];
		?>
		<tr>
            <th scope="row"><label for="Nsize">COLS SIZE</label></th>
            <td>
				<?php echo help("입력박스의 크기로  30 정도가 적당합니다."); ?>
				<input type="text" name="Nsize" value="<?php echo $lalaSize ?>" id="cf_Nsize" class="frm_input" size="5" placeholder="입력박스의 크기로  30 정도가 적당합니다.">
            </td>
        </tr>
		<?php } ?>






		<?php
		if($inum==41){ // 생년월일 selectbox
			if(strlen($row['size2'])<1) {
				$lalaSize = 0;
			}else{
				$lalaSize = $row['size2'];
			}
		?>
		<tr>
            <th scope="row"><label for="Nsize">항목별 공간</label></th>
            <td>
				<?php echo gen_single_selectbox("","Nsize2",   Array("가로형","세로형"), Array("0","1"),$lalaSize,''); ?>
            </td>
        </tr>
		<?php } ?>


		<?php
		if($inum==5){ // 긴문장입력형 textarea
			if(strlen($row['size2'])<1) {
				$lalaSize = 50; $lalaSize2 = 5;
			}else{
				$lalaSize = $row['size']; $lalaSize2 = $row['size2'];
			}
		?>
		<tr>
			<th scope="row"><label for="cf_Nsize">TextBox Columns</label></th>
			<td><input type="text" name="Nsize" value="<?php echo $lalaSize?>" id="cf_Nsize" class="frm_input" size="5" placeholder="텍스트박스의 가로크기"></td>
		</tr>
		<tr>
			<th scope="row"><label for="cf_Nsize2">TextBox Rows</label></th>
			<td><input type="text" name="Nsize2" value="<?php echo $lalaSize2?>" id="cf_Nsize2" class="frm_input" size="5" placeholder="텍스트박스의 세로크기"></td>
		</tr>
		<?php } ?>


		<?php
		if($inum==3||$inum==4){ // 라디오박스형 radiobox ,체크박스형 checkbox
			if(strlen($row['size2'])<1) {
				$lalaSize = 0;
			}else{
				$lalaSize = $row['size2'];
			}
		?>
		<tr>
            <th scope="row"><label for="Nsize">항목별 공간</label></th>
            <td>
				<?php echo gen_single_selectbox("","Nsize2",   Array("가로형","세로형"), Array("0","1"),$lalaSize,''); ?>
            </td>
        </tr>
		<?php } ?>


		<?php
		if($inum==2 || $inum==3 || $inum==4){ // 셀렉트박스 selectbox, 라디오박스형 radiobox ,체크박스형 checkbox
		$t_num=0;for($i=0; $i<30; $i++) {$t_num++;
		$row_title = 'it'.$t_num;
		?>
		<tr>
            <th scope="row"><label for="Nit<?php echo $t_num;?>">옵션<?php echo $t_num;?></label></th>
            <td>
                <input type="text" name="Nit<?php echo $t_num;?>" value='<?php echo $row[$row_title]; ?>' id="Nit<?php echo $t_num;?>" class="frm_input" size="40">
            </td>
        </tr>
		<?php
		} // for end
		} // if end
		?>
        </tbody>
        </table>
    </div>
</section>

<?php echo $frm_submit; ?>

</form>

<script>

function fconfigform_submit(f)
{
    return true;
}
</script>
<?php
include_once(G5_PATH.'/tail.sub.php');
?>
