<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/tail.php');
    return;
}
?>

<?php if (!defined("_INDEX_")) { ?>
		</div>
	</div>
</div>
<? } ?>

<script src="<?php echo G5_THEME_URL ?>/js/css3-animate-it.js"></script>


<!-- 하단 시작 { -->
<footer id="footer" <?php if (defined("_INDEX_")) { ?>class="main"<? }?>>
	<div class="wrap footer_wrap">
        
        <!-- 하단로고 -->
		<a href="/" class="footer_logo"></a>
		
        <!----------- 푸터 fnb 영역 ----------->
		<nav class="gnb">
			<ul>
  
				<li class="sites">
				   <select onchange="copyrtChgUrl(this.value)" class="site2">
	                  <option value=""> 관련사이트 </option>
	                  <option value="http://dna-tec.org">DNA-TEC</option>
	                  <option value="http://rus-test.org">RUS-TEST</option>
	                  <option value="https://www.gicert.org/?l=ko">GIC</option>
	                  <option value="https://www.gpcert.org/">GPC</option>
	                  <option value="http://www.patscorp.com/">PATSCORP</option>
	                  <option value="https://www.asiaitc.com/">ASIAITC</option>
                      <option value="http://aemiworld.com/">AEMIWORLD</option>
                      <option value="http://igcert.net/">(구) IGC</option>
<!--                  <option value="https://data.igcert.org/">WWW.DATACERTORG</option>-->
                      <option value="https://blog.naver.com/kate_0432">NAVER Blog1</option>
                      <option value="https://blog.naver.com/woheni19">NAVER Blog2</option>
                      <option value="https://blog.naver.com/djrrlforyou">NAVER Blog3</option>
                      <option value="https://blog.naver.com/kate_0432">NAVER Blog4</option>
                   </select>
				</li>
				
			</ul>			
		</nav>
		
        <!----------- 회사정보 ----------->
		<div class="f_left">
            <!-- 개인정보처리방침/서비스이용약관 영역 -->
            <div class="privacyprovision">
				<a href="<?php echo get_pretty_url('content', 'privacy_en'); ?>"><span>Privacy</span></a>
				<a href="<?php echo get_pretty_url('content', 'provision_en'); ?>"><span>Provision</span></a>
            </div><br>
			<dl class="address">
                <a class="mobile_logo"></a>
				<dt>Company name : Global Personnel Certification Co., Ltd.</dt>&nbsp; &nbsp;<br/>	
				<dt>Address : 501-1, 638, Seobusaet-gil, Geumchoen-gu, Seoul, Republic of Korea</dt><br class="pc_only">	
				<dt>Name of representative : Minhyang Son</dt>&nbsp; &nbsp;
				<dt>Business registration no. : 778-87-00837</dt>&nbsp; &nbsp; <br>
				<a href="tel:02-6749-0723" style="color: #fff">
                    <dt>TEL : 02) 6749-0710</dt>
				</a>&nbsp; &nbsp;
				<dt>Fax : </dt>
				<dt>02) 6749-0711</dt> &nbsp; &nbsp; 
				<a href="mailto:info@igcert.org" style="color: #fff">
                    <dt>E-mail : </dt>
                    <dt class="gpc_email">info@gpcert.org</dt>
				</a><br><br>
				<dt style="color:#a0a0a0">Copyright &copy; 2017 Global Personnel Certification All Rights Reserved.</dt>
			</dl>
		</div>
        <!----------- CS 정보 ----------->
		<div class="f_right">
            <div class="cs_area">
                <span>Customer Service Center</span>
                <strong>02-6749-0710</strong>
                <span>AM 9:00 ~ PM 6:00</span>
                <span>Closed on weekends and holidays</span>
            </div>
		</div>
	</div>
    
    <!-- TOP 버튼 -->
    <a href="javascript:" id="top_btn"><i class="fa fa-angle-up" aria-hidden="true"></i><span style="display:block;font-size:1rem">TOP</span> </a>
    
    <script>
    $(function() {
        $("#top_btn").on("click", function() {
            $("html, body").animate({scrollTop:0}, '1000');
            return false;
        });
    });
    </script>
    
    <!---FamilySites 시작------>
    <script>
    function copyrtChgUrl(url){
	if(url){
		window.open(url);
	}
    }
    <!---FamilySites 종료------>
</script>
</footer>
<!-- } 하단 끝 -->

<!-- 20200402 QuickMenu -->

<!----------
tail.php 60라인~ 추가
head.php 204,207라인 추가
design.css 564라인~ 추가
------>

<!----퀵메뉴 영역----->
<!-- 모바일_하단고정 -->
	<div class="request">
		<div class="floating">
			<div class="inner">
				<div class="btn_col">
					<span><a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=qa" class="btn_type1">1:1문의</a></span>
					<span><a href="tel:02-6749-0710" class="btn_type2">전화바로상담</a></span>
				</div>
			</div>
		</div>
	</div>
	<!-- 모바일_하단고정 //-->
<?php
include_once(G5_THEME_PATH."/tail.sub.php");
?>