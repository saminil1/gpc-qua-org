<?php
require_once $_SERVER['DOCUMENT_ROOT']."/html/_inc/_config.php";

$pg = !$_POST['pg'] ? ( !$_GET['pg'] ? 1 : $_GET['pg'] ) : $_POST['pg'];
$one_page_num = !$_POST['one_page_num'] ? ( !$_GET['one_page_num'] ? 15 : $_GET['one_page_num'] ) : $_POST['one_page_num'];
$one_block_num = 10;
$first_no = $one_page_num * ($pg - 1);


$tot_count = $Mysql_Base->Query_result("select count(*) from tbl_iso a"); // 테이블명 일치 확인





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


<html lang="en">
<head>
    <meta charset="UTF-8">

    <!--  Noto Sans 폰트  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@400;500;700&display=swap" rel="stylesheet">
    
    <style>
        table{font-size:inherit;}
        table.type09 {
            width:100%;
            border-collapse: collapse;
            text-align: center;
            line-height: 1.5;
            margin: 0 auto;
            margin-top:30px;
        }
        table.type09 thead th {
            padding: 15px;
            font-weight: 500;
            border-top: 1px solid #ddd;
            border-bottom: 1px solid #ddd;
            background: #f7f7f7;
        }
        table.type09 tbody th {
            width: 15%;
            padding: 12px 15px;
            font-weight: 500;
            vertical-align: middle;
            border-bottom: 1px solid #ddd;
            background: #f7f7f7;
        }
        table.type09 td {
            width: 350px;
            padding: 15px 20px;
            vertical-align: middle;
            border-bottom: 1px solid #ddd;
        }
        
        
        /* ----------------------------------- 220609 yr */
        .wrap{
            font-size:0.95rem;
            color:#333;
            font-weight:400;
            font-family: 'Noto Sans KR', sans-serif;
        }
        
        .btn_return a{
            display: block;
            width:130px;
            height:46px;
            line-height: 46px;
            background:#f5af12;
            margin:40px auto 0;
            text-align:center;
            color:#fff;
            text-decoration: none;
        }
        
        /* ==== Modal ====*/ 
        .modal_wrap{
            display:none;
            position:absolute;
            top:45%;
            left:50%;
            width:600px;
            height:600px;
            margin:-250px 0 0 -250px;
            background:#fff;
            z-index:2;
        }
        .black_bg{
            display:none;
            position:absolute;
            top:0;
            left:0;
            z-index:1;  
            content:"";
            width:100%;
            height:100%;
            background-color:rgba(0,0,0,0.7);
        }
        .modal_close{
            font-size:1.8rem;
            position:absolute;
            bottom:0px;
            right:-40px;
            width: 40px;
            height: 40px;
            border: 1px solid #fff;
            transition:all 0.15s;
            -webkit-transition:all 0.15s;
            -moz-transition:all 0.15s;
            -ms-transition:all 0.15s;
        }
        .modal_close:hover{
            background: #fff;
            border-color:transparent;
        }
        .modal_close>a{
            text-decoration: none;
            display:block;
            width:100%;
            height:100%;
            color:#fff;
            line-height:40px;
        }
        .modal_close:hover a{
            color:#333;
        }
        #modal_btn{
            background: #13bd6e;
            padding: 0.5rem;
            border: none;
            color: #fff;
            cursor: pointer;
        }
        
    </style>
    
    <!------------------------------ 모달 스크립트 시작 ------------------------------>
    <script>    
        window.onload = function() {
            function onClick() {        
                document.querySelector('.modal_wrap').style.display ='block';        
                document.querySelector('.black_bg').style.display ='block';    
            }       
            function offClick() {        
                document.querySelector('.modal_wrap').style.display ='none';        
                document.querySelector('.black_bg').style.display ='none';    
            }     
            document.getElementById('modal_btn').addEventListener('click', onClick);    
            document.querySelector('.modal_close').addEventListener('click', offClick); 
        };
    </script>
    <!------------------------------ 모달 스크립트 종료 ------------------------------>
</head>
    
<body>
    <div class="wrap">
        <table class="type09">
            <colgroup>
                <col style="width:5%">
                <col style="width:5%">
                <col style="width:6%">
                <col style="width:13%">
                <col style="width:13%">
                <col style="width:13%">
                <col style="width:18%">
                <col style="width:15%">
            </colgroup>
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">순서</th>
                    <th scope="col">상세보기</th>
                    <th scope="col">이름(영문)</th>
                    <th scope="col">전화번호</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">주소</th>
                    <th scope="col">상세주소</th>
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

                    <td>
<!--                        <a id="modal_btn" href="search_view.html?idx=<?=$LIST[$ary_i]['idx']?>"><?=$LIST[$ary_i]['kind']?></a>-->
                        <button type=button id="modal_btn">열기</button>
                        
                        <div class="black_bg"></div>
                        <div class="modal_wrap">
                            <div class="modal_close">
                                <a href="#">X</a>
                            </div>
                            <div>모달창 내용</div>
                        </div>
                    </td>

                    <td><?=$LIST[$ary_i]['name_ko']."(".$LIST[$ary_i]['name_en'].")"?></td>

                    <td class="tal">
                        <?=$LIST[$ary_i]['hp']?> 
                    </td>

                    <td class="tal">
                        <?=$LIST[$ary_i]['email']?>
                    </td>

                    <td class="tal">
                        <?=$LIST[$ary_i]['address1']?>
                    </td>

                    <td class="tal">
                        <?=$LIST[$ary_i]['address2']?>
                    </td>

                    <td class="tal">
                        <?=$LIST[$ary_i]['reg_date']?>
                    </td>	


                    <!---td class="tal"><?=str_replace("|"," ",$LIST[$ary_i]['Morphology'])?></td--->

                </tr>
                <? }?>

            </tbody>
        </table>
        <div class="btn_return"><a href="form_2page.php"> &lt; 이전으로</a></div>
    </div>
    <script>
        page_set['tot'] = parseInt('<?=$tot_count?>');
        page_set['one_page'] = parseInt('<?=$one_page_num?>');
        page_set['now_page'] = parseInt('<?=$pg?>');
        page_set['one_block'] = parseInt('<?=$one_block_num?>');
        page_set['self_url'] = "<?=$_SET['Nav']['pageurl']?>";
        setPaging();
    </script>

</body>
</html>