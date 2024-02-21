<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

$sql = " select * from {$g5['new_win_table']}
          where '".G5_TIME_YMDHIS."' between nw_begin_time and nw_end_time
            and nw_device IN ( 'both', 'pc' )
          order by nw_id asc ";
$result = sql_query($sql, false);
?>

<!-- 팝업레이어 시작 { -->
<div id="hd_pop">
    <h2>팝업레이어 알림</h2>

    <?php
    for ($i=0; $row_nw=sql_fetch_array($result); $i++)
    {
        // 이미 체크 되었다면 Continue
        if ($_COOKIE["hd_pops_{$row_nw['nw_id']}"])
            continue;

        $sql = " select * from {$g5['new_win_table']} where nw_id = '{$row_nw['nw_id']}' ";
        $nw = sql_fetch($sql);
    ?>
        <div id="draggable" class="ui-widget-content">
            <div class="ui-drag-handle" style="width: 100%;height: 600px;cursor: move;position: absolute;"></div><!-- drag-handle 생성 -->
            <div id="hd_pops_<?php echo $nw['nw_id'] ?>" class="hd_pops" style="top:<?php echo $nw['nw_top']?>px;left:<?php echo $nw['nw_left']?>px;">
                <div class="ui-drag-handle"></div>
                <div class="hd_pops_con" style="width:<?php echo $nw['nw_width'] ?>px;height:<?php echo $nw['nw_height'] ?>px">
                    <?php echo conv_content($nw['nw_content'], 1); ?>
                </div>
                <div class="hd_pops_footer">
                    <button class="hd_pops_reject hd_pops_<?php echo $nw['nw_id']; ?> <?php echo $nw['nw_disable_hours']; ?>"><strong><?php echo $nw['nw_disable_hours']; ?></strong>시간 동안 다시 열람하지 않습니다.</button>
                    <button class="hd_pops_close hd_pops_<?php echo $nw['nw_id']; ?>" style="display: block">닫기</button>
                </div>
            </div>
        </div>
    <?php
    }
    
if ($i == 0) echo '<span class="sound_only">팝업레이어 알림이 없습니다.</span>';
?>
    
</div>

<!-- 팝업 Drag & Drop 구현 - draggable 라이브러리 / (모바일버전) jqueryui-touch-punch 라이브러리 연결 20220707 HJ -->
<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js" integrity="sha512-0bEtK0USNd96MnO4XhH8jhv3nyRF0eK87pJke6pkYf3cM0uDIhNJy9ltuzqgypoIFXw3JSuiy04tVk4AjpZdZw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- Drag-handle Javascript -->
<script>
    $(function() {
        $("#draggable").draggable({
            cursor: 'move',
            handle: ".ui-drag-handle",
        });
    });
</script>

<script>
    $(function() {
        $(".hd_pops_reject").click(function() {
            var id = $(this).attr('class').split(' ');
            var ck_name = id[1];
            var exp_time = parseInt(id[2]);
            $("#"+id[1]).remove();
            set_cookie(ck_name, 1, exp_time, g5_cookie_domain);
        });
        
        $('.hd_pops_close').click(function() {
            var idb = $(this).attr('class').split(' ');
            $('#'+idb[1]).remove();
        });
    });
</script>
<!-- } 팝업레이어 끝 -->

