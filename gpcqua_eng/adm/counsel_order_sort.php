<?php
$sub_menu = '300910';
include_once('./_common.php');

auth_check($auth[$sub_menu], "r");

$g5['title'] = '심사원등록 출력순서변경';
include_once (G5_ADMIN_PATH.'/admin.head.php');

$frm_submit = '<div class="btn_confirm01 btn_confirm">
    <input type="submit" value="확인" class="btn_submit" accesskey="s">
    <a href="./counsel_order_opt.php">취소</a>
</div>';

if($mode=='900'){
	echo("
		<script name=javascript>
		ans=confirm('정말로 삭제 하시겠습니까?')
		if(ans == true)
		window.open('./counsel_order_sort.php?mode=999&mnum=$mnum','_self','')
		else
		history.go(-1)
		</script>");
	exit;
}

if($mode=="999"){
    $sql="delete from {$g5['counsel_item_table']} where num='$mnum'";
	if(sql_query($sql)){ goto_url('./counsel_order_sort.php', false); }
	else{ alert('삭제하는 데 문제가 발생했습니다. 다시 시도해 주세요.', './counsel_order_sort.php'); }
}

if($mode=="820"){

	$sql=" select num,mno from {$g5['counsel_item_table']} where num='$mnum' ";
	$row = sql_fetch($sql);
	$mnoA = $row['mno'];

	$sql=" select min(mno) as mno from {$g5['counsel_item_table']} where mno > '$mnoA' ";
	$row = sql_fetch($sql);
	$mnoB = $row['mno'];

	if(strlen($mnoB) < 1 ){ alert("이동 범위를 초과 했습니다."); }

	$sql="select num,mno from {$g5['counsel_item_table']} where mno='$mnoB'  ";
	$row = sql_fetch($sql);
	$mnumB = $row['num'];
	$mnoB = $row['mno'];

	$sql="update {$g5['counsel_item_table']} set mno='$mnoB' where num='$mnum' ";
	sql_query($sql);
	$sql="update {$g5['counsel_item_table']} set mno='$mnoA' where num='$mnumB' ";
	sql_query($sql);
    goto_url($PHP_SELF, false);
}

if($mode=="810"){

	$sql="select num,mno from {$g5['counsel_item_table']} where num='$mnum' ";
	$row = sql_fetch($sql);
	$mnoA = $row['mno'];

	$sql="select max(mno) as mno from {$g5['counsel_item_table']} where mno < '$mnoA'  ";
	$row = sql_fetch($sql);
	$mnoB = $row['mno'];

	if(strlen($mnoB) < 1 ){ ScriptErrMsg("이동 범위를 초과 했습니다."); }

	$sql="select num,mno from {$g5['counsel_item_table']} where mno='$mnoB'  ";
	$row = sql_fetch($sql);
	$mnumB = $row['num'];
	$mnoB = $row['mno'];

	$sql="update {$g5['counsel_item_table']} set mno='$mnoB' where num='$mnum' ";
	sql_query($sql);
	$sql="update {$g5['counsel_item_table']} set mno='$mnoA' where num='$mnumB' ";
	sql_query($sql);
	goto_url($PHP_SELF, false);
}


$sql = " select num,mno,icode,iname from {$g5['counsel_item_table']} order by mno ";
$result = sql_query($sql);

?>

<form name="fconfig" action="./counsel_order_sort.php" onsubmit="return fconfig_check(this)" method="post" enctype="MULTIPART/FORM-DATA">
<input type="hidden" name="token" value="" id="token">
<input type="hidden" name="mode" value="100" id="mode">
<input type="hidden" name="num" value="<?php echo $row['num'] ?>" id="num">

<section id="anc_sidx_act">
	<h2>출력순서변경</h2>
	<?php echo $pg_anchor; ?>

	<div id="sidx_take_act" class="tbl_head01 tbl_wrap">
		<table>
		<thead>
		<tr>
			<th scope="col" class="td_mng">순서</th>
			<th scope="col">항목이름</th>
			<th scope="col" class="td_mng">이동</th>
			<th scope="col" class="td_mng">삭제</th>
		</tr>
		</thead>
		<tbody>
		<?php
		$count = 0;
		for ($i=0; $row=sql_fetch_array($result); $i++){
			 $k=$i+1 ;
		?>
		<tr>
			<td scope="row"><?php echo $k?></td>
			<td><?php echo $row['iname'];?></td>
			<td style="text-align:center"><a href="./counsel_order_sort.php?mode=810&mnum=<?php echo $row['num'] ?>"><img src='<?php echo G5_ADMIN_URL ?>/img/up.gif' width='10' border='0'></a> | <a href="./counsel_order_sort.php?mode=820&mnum=<?php echo $row['num'] ?>"><img src='<?php echo G5_ADMIN_URL ?>/img/down.gif' width='10' border='0'></a></td>
			<td class="td_mngsmall"><a href="./counsel_order_sort.php?mode=900&mnum=<?php echo $row['num'] ?>" class="mng_mod">삭제</a></td>
		</tr>
		<?php
		$count++;
		}
		if ($count == 0){
			echo '<tr><td colspan="4" class="empty_table">출력 항목이 없습니다.</td></tr>';
		}
		?>
		</tbody>
		</table>
	</div>
</section>

<?php echo $frm_submit; ?>

</form>

<script>
function fconfig_check(f)
{

    return true;
}
</script>
<?php
include_once (G5_ADMIN_PATH.'/admin.tail.php');
?>
