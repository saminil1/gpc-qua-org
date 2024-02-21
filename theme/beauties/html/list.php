<?php
include_once('./_common.php');
$g5['title'] = '신청목록';


include_once(G5_THEME_PATH.'/head.php');


//exit;


$pg = !$_POST['pg'] ? ( !$_GET['pg'] ? 1 : $_GET['pg'] ) : $_POST['pg'];
$one_page_num = !$_POST['one_page_num'] ? ( !$_GET['one_page_num'] ? 50 : $_GET['one_page_num'] ) : $_POST['one_page_num'];
$one_block_num = 15;
$first_no = $one_page_num * ($pg - 1);



$tot_count = sql_query("select count(*) from tbl_iso a"); // 테이블명 일치 확인
$tmp_q = sql_query("
							select *
								from tbl_iso order by idx desc 
										limit ".$first_no.", ".$one_page_num."  
							");



$tmp_no = $tot_count - $first_no;
$ary_i = 0; 



for($k=0;$tmp_l=sql_fetch_array($tmp_q);$k++){
	$LIST[$ary_i] = $tmp_l;
	$LIST[$ary_i]['no'] = number_format($tmp_no);

	$tmp_no--;
	$ary_i++;
}
$LIST['cnt'] = $ary_i;



?>

<style>   

/*회사안내- 회사소개 페이지 시작-YR 210728*/
    .content_wrap{
        font-size:1rem;
        font-weight:400;
        color:#333;
        line-height:1.8rem;
        text-align:justify;
        overflow-x:hidden;
    }
    .container_title{/* 서브페이지 상단 타이틀 생성 / 20210730 HJ */
        display: block !important;
        color:#555; font-size:1.6rem;
        line-height:1; font-weight:700;
        text-align:center;
        border-radius:4px;
        background:#fff;
        box-shadow: 1px 2px 8px #eee;
        width:100%; padding:30px 0; margin: 0 0 50px;
    }
    .top_tt{
        text-align:center;
        color:#5d94c3;
        font-size:2.2rem;
        font-weight:700;
        padding:50px 0;
        line-height:3.4rem;
    }
    .top_tt small{
        display:block;
    }
    .top_tt:after { /*밑줄선*/
        content: "";
        clear: both;
        display: block;
        width: 40px;
        margin: 50px auto 0;
        border: 1px solid #999;
    }
    .top_txt{
        font-size:1rem;
        color:#333;
        font-weight:400;
        line-height:1.8rem; 
        text-align:justify;
    }
    
    /*1번-5번 서비스*/
    .mid_content01{padding:5px 0;}
    .mid_content01 h3{ 
        font-size:1.3rem;  
        font-weight:500; 
        letter-spacing:-1px; 
        color:#333;
        margin-bottom:10px;
    }
    .gray_box{
        display:block;
        width:92%;
        margin:30px 4%;
        height:auto;
        padding:30px 50px;
        background:#eff3f7;
        border-top:1px solid #ddd;
        color:#333;
        font-weight:400;
        line-height:1.8rem;
    }
    
    
    /*회사개요*/
    .mid_content02 {margin:50px 0 0px;}
    .mid_content02 .content_title{ /*회사개요 제목*/
        font-size:1.8rem;
        font-weight:500;
        color:#333;
        margin-bottom:40px;
    }
     .mid_content02 .content_title:before{ /*제목 위 border*/
        content: "";
        display:block;
        width:35px;
        height:3px;
        background:#5d94c3;
        margin-bottom:13px;
    }
    .company_info{
        width:100%;
        height:auto;
        padding:20px 7%;
        background:#f9f9f9;
        border-top:3px solid #eee;
    }
    .mid_content02 ul li{
        padding:8px 12px;
        color:#333;
        font-weight:400;
    }
    .mid_content02  ul li span{
        display:inline-block;
        width:180px;
        font-size:1.1rem;
        color:#333;
        font-weight:500;
    }
      
/*회사안내- 회사소개 페이지 종료*/     

    
    
/* -----------------------------------------------------반응형 시작 -210803 yr*/  
    
    /* 놋북,태블릿 사이즈, 최대 1280px 화소까지 적용 */
    @media (max-width:1280px) {
        .container_title{width:100%;}
         .company_info{ /*회사개요 컨텐츠 박스*/
            width:100%;
            height:auto;
            padding:20px 6%;
            background:#f9f9f9;
            border-top:3px solid #eee;
        }
        .mid_content02  ul li span{ /*회사개요 왼쪽 타이틀*/
            display:inline-block;
            width:140px;
            font-size:1.1rem;
            color:#333;
            font-weight:500;
        }
        
    /* 최대 1024px 화소까지 적용 */
    @media (max-width:1024px) {
        /*-----1024px에서 텍스트 크기 변경되는 class -----*/
        .container_title{width:100%;}
        .top_tt{
            padding:40px 0 40px;
            font-size:1.85rem;
        }
        .top_tt:after { /*밑줄선*/
            margin: 40px auto 0;
        }
        .mid_content02 .content_title{ /*company overview*/
            font-size:1.6rem;
        }
        /*-----1024px에서 텍스트 크기 변경되는 class -----*/
        
        .gray_box{ /*개인인증, 연수기관 지정 컨텐츠*/
            display:block;
            width:100%;
            margin:30px 0%;
            height:auto;
            padding:30px 7%;
        }
        .company_info{ /*회사개요 컨텐츠 박스*/
            padding:20px 7%;
        }
        .mid_content02  ul li{ /*회사개요 li*/
            padding:8px 0px;
            color:#333;
            font-weight:400;
        }
        .mid_content02  ul li span{ /*회사개요 왼쪽 타이틀*/
            display:block;
            width:100%;
            font-size:1.1rem;
            color:#333;
            font-weight:500;
            padding-bottom:2px;
        }
        
    }

    /*  최대 768px 화소까지 적용 */
    @media only screen and (max-device-width : 768px) and (-webkit-min-device-pixel-ratio: 1) {
        .container_title{display:none !important;} /*탭메뉴와 중복되어서 안보이게함*/  
    }

    /* 모바일(가장 작은 사이즈: SAMSUNG GALAXY S6) 가로 버전 사이즈, 최소 360px ~ 최대 640px(가로로 볼때) 화소까지 적용 */    
    @media all and (max-device-width : 640px) { 
        .top_tt{
            padding:20px 0 40px;
        }
        .gray_box{ /*개인인증, 연수기관 지정 컨텐츠*/
            display:block;
            height:auto;
            padding:20px 7%;
        }
    }


    /* 모바일(가장 큰 사이즈: iPhone 6/7/8 Plus) 세로 버전 사이즈, 최소 360px ~ 최대 414px 화소까지 적용 */
    @media all and (min-width:360px) and (max-device-width : 414px) { 
        /*----- 360px ~ 414px에서 텍스트 크기 변경되는 class -----*/
        .content_wrap{
            font-size:0.95rem;
        }
        .top_tt{
            font-size:1.35rem;
            padding:0px 0 30px;
            line-height:2.2rem;
        }
        .top_tt:after { /*밑줄선*/
            margin: 30px auto 0;
        }
        .top_txt{
            font-size:0.95rem;
        }
        .mid_content01 h3{font-size:1.1rem;}
        
        .gray_box{ /*개인인증, 연수기관 지정 컨텐츠*/
           margin:20px 0%;
        }
        .mid_content02 .content_title{ /*company overview*/
            margin-bottom:30px;
            font-size:1.4rem;
        }
        .mid_content02  ul li>span{ /*회사개요 왼쪽 타이틀*/
            font-size:1rem;
        }
    }  
            
/*---------------------------------------------------------------반응형 끝*/

    
    
</style>

<body>

<div class="content_wrap">
	<!--본문영역 -->
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
                                    <th scope="col">상세보기</th>
                                    <th scope="col">이름(영문)</th>
                                    <th scope="col">hp</th>
									<th scope="col">email</th>
									<th scope="col">주소1</th>
									<th scope="col">주소2</th>
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


									<td class="tal"><?=str_replace("|"," ",$LIST[$ary_i]['Morphology'])?></td>
																	
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
  
	<!--본문영역끝 -->

</div> <!--------------------------// class="content_wrap" //------------------------------->

</body>

<?php
include_once(G5_THEME_PATH.'/tail.php');
?>