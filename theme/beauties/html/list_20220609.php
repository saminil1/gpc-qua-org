<?php
require_once $_SERVER['DOCUMENT_ROOT']."/html/_inc/_config.php";

$pg = !$_POST['pg'] ? ( !$_GET['pg'] ? 1 : $_GET['pg'] ) : $_POST['pg'];
$one_page_num = !$_POST['one_page_num'] ? ( !$_GET['one_page_num'] ? 15 : $_GET['one_page_num'] ) : $_POST['one_page_num'];
$one_block_num = 10;
$first_no = $one_page_num * ($pg - 1);


$tot_count = $Mysql_Base->Query_result("select count(*) from tbl_iso a");





$tmp_q = $Mysql_Base->Query_normal("
							select *
								from tbl_iso order by idx desc 
										limit ".$first_no.", ".$one_page_num."  
							");


$tmp_no = $tot_count - $first_no;
$ary_i = 0; while( $tmp_l = @mysqli_fetch_array($tmp_q) ) {
	$LIST[$ary_i] = $tmp_l;
	$LIST[$ary_i]['no'] = number_format($tmp_no);

	$tmp_no--;
	$ary_i++;
}
$LIST['cnt'] = $ary_i;

?>

<style>
table.type09 {
  border-collapse: collapse;
  text-align: left;
  line-height: 1.5;
      text-align: center;
    margin: 0 auto;
margin-top:100px;
}
table.type09 thead th {
  padding: 10px;
  font-weight: bold;
  vertical-align: top;
  color: #369;
  border-bottom: 3px solid #036;
}
table.type09 tbody th {
  width: 250px;
  padding: 10px;
  font-weight: bold;
  vertical-align: top;
  border-bottom: 1px solid #ccc;
  background: #f3f6f7;
}
table.type09 td {
  width: 350px;
  padding: 10px;
  vertical-align: top;
  border-bottom: 1px solid #ccc;
}
</style>

<table class="type09">
                            <colgroup>
                                <col style="width:5%">
                                <col style="width:5%">
                                <col style="width:10%">
                                <col style="width:10%">
                                <col style="width:20%">
								<col style="width:15%">
								<col style="width:12%">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th scope="col"></th>
									<th scope="col">순서</th>
                                    <th scope="col">유형</th>
                                    <th scope="col">이름(영문)</th>
                                    <th scope="col">hp</th>
									<th scope="col">email</th>
                                    <th scope="col">등록일</th>									
                                </tr>
                            </thead>
                            <tbody>
								<?php for($ary_i=0; $ary_i < $LIST['cnt']; $ary_i++) { ?>
                                <tr>
									<td>								
										<input type="checkbox" name="chk_wr_id[]" value="<?=$LIST[$ary_i]['idx']?>" >
									</td> 
									<td><?=$tot_count-(($pg-1)*$one_page_num)-$ary_i;?></td>
									<td><a href="search_view.html?idx=<?=$LIST[$ary_i]['idx']?>"><?=$LIST[$ary_i]['kind']?></a></td>
									<td><?=$LIST[$ary_i]['name_ko']."(".$LIST[$ary_i]['name_en'].")"?></td>
									<td class="tal">
										<?=$LIST[$ary_i]['hp']?> <?=$LIST[$ary_i]['email']?>
 									</td>
									<td class="tal"><?=str_replace("|"," ",$LIST[$ary_i]['Morphology'])?></td>
									<td class="tal"><?=$LIST[$ary_i]['reg_date']?></td>									
                                </tr>
								<? }?>
                                
                            </tbody>
                        </table>
					</form>
                    </div>
                    <div class="paging_wrap">
				<script>
					page_set['tot'] = parseInt('<?=$tot_count?>');
					page_set['one_page'] = parseInt('<?=$one_page_num?>');
					page_set['now_page'] = parseInt('<?=$pg?>');
					page_set['one_block'] = parseInt('<?=$one_block_num?>');
					page_set['self_url'] = "<?=$_SET['Nav']['pageurl']?>";
					setPaging();
				</script>