<?php
$seo_Author = "";
$seo_Publisher  = "";
$seo_head_title = "";
$seo_theme_color = "#0a81a8";
$seo_language = "kr";
$seo_locale = "ko_KR";
$seo_type = "website";

$secure_connection = !empty($_SERVER['HTTPS']); // https 확인
if ($secure_connection == true ) {
    $seo_domain_addr = "https://gpcert.org";
} else {
    $seo_domain_addr = "http://". $_SERVER['SERVER_NAME'];
}

$seo_descriptionS = "GPC is a personnel certification body that has been accredited based on ISO/IEC 17024 from IAS, an accreditation body, and provides the following services.";

$seo_descriptionL = "1. Personnel certification : GPC provides personnel certification services by evaluating and verifying competence according to impartial and objective evaluation criteria.
2. Designation of training provider:Companies need auditors who are qualified in various fields to ensure efficient operation and competitiveness. GPC designates qualified institutions as training providers by signing MLA with IPC, IAF Association member, for the designation of a training provider, and training providers strive to produce auditors with expertise.";

$seo_keywords = "Recognition, Certification, Personal Certification 19011,Management System Audit Guidelines,Personal Qualification Certification,, Certification Process, IAS, IAF, IPC,ISO,ISO Education,Auditor Certification,Auditor Grade
ISO/IEC 17024, ISO 9001, Quality Management System, ISO 14001,Environmental Management System,, ISO 22000, ISO 13485, Medical Device Quality Management System, ISO 21001, Educational Institution Management System, ISO 22301, Business Continuity Management System, ISO/IEC 27701,Personal Information Security Management System, ISO 37001,Anti-Bribery Management System,45001: ISO 45001, Occupational Health and Safety Management System";

$seo_image = $seo_domain_addr ."/img/logo_social.png";
$seo_image_width  = "";
$seo_image_height = "";

$seo_og_image = $seo_domain_addr ."/img/logo_social_og.png";
$seo_og_image_width  = "";
$seo_og_image_height = ""; 

$seo_twitter_image = $seo_domain_addr ."/img/logo_social_twitter.png"; 
$seo_twitter_image_width  = ""; 
$seo_twitter_image_height = "";
$seo_facebook = "";
$seo_twitter = "";
$naver_site_verification = "";
$seo_naver = "";
$seo_naver_storefarm = "";


/////////////////////  이하 수정사항 없습니다. /////////////////////

if ($config['cf_title']) $seo_Author = "{$config['cf_title']}";
if ($config['cf_title']) $seo_Publisher  = "{$config['cf_title']}";
if ($config['cf_title']) $seo_head_title = "{$config['cf_title']}";

$gnu_seo_Publisher  = "{$seo_Author}";
$gnu_seo_Author     = ($wr_id) ? $write['wr_name'] : $seo_Publisher;
$gnu_seo_head_title = $g5_head_title;

if ($gnu_seo_Publisher) $seo_Publisher = $gnu_seo_Publisher;
if ($gnu_seo_Author) $seo_Author = $gnu_seo_Author;
if ($gnu_seo_head_title) $seo_head_title = $gnu_seo_head_title;

$seo_datetime = date("Y-m-d");

if ($bo_table) {
    if ($wr_id) {
        $seo_qry = sql_query(" select * from {$g5['write_prefix']}{$bo_table} where wr_id='{$wr_id}' ");
        $seo_row = sql_fetch_array($seo_qry);
        
        $seo_wr_datetime = $seo_row['wr_datetime'];
        if(strpos($seo_row['wr_option'], "secret") !== false) {
            $seo_descriptionL = $g5_head_title;
            $seo_descriptionS = $g5_head_title;
            $seo_keywords     = $g5_head_title;
        } else {
            $seo_description = str_replace('<br />', ' ', $seo_row['wr_content']); // &nbsp; 를 공백으로 교체하기
            $seo_description = str_replace('<br>', ' ', $seo_description); // &nbsp; 를 공백으로 교체하기
            $seo_description = str_replace('"', ' ', $seo_description); // " 를 공백으로 교체하기
            $seo_description = str_replace('&nbsp;', ' ', $seo_description); // &nbsp; 를 공백으로 교체하기
            $seo_description = preg_replace('/[\x00-\x1F\x7F]/', '', $seo_description); // 이상한 특수문자를 제어하는 코드 추가
            //$seo_keywords     = strip_tags($seo_description).", ".$seo_keywords;
            $seo_keywords = $seo_descriptionS .",". cut_str(strip_tags($seo_description),80);
            //$seo_descriptionL = strip_tags($seo_description) .", ". $seo_descriptionL;
            $seo_descriptionL = cut_str(strip_tags($seo_description),200);
            //$seo_descriptionS = cut_str(strip_tags($seo_description),80) .", ". $seo_descriptionS;
            $seo_descriptionS = cut_str(strip_tags($seo_description),80) .", ". $seo_descriptionS;
            $gnu_seo_datetime     = substr($seo_row['wr_datetime'],0,10);
            if ($seo_row['wr_last'] > $seo_row['wr_datetime']) {
                $gnu_seo_datetime = substr($seo_row['wr_last'],0,10);
            } else {
                $gnu_seo_datetime = substr($seo_row['wr_datetime'],0,10);
            }
        }
        
        // 썸네일 or 로고경로 (최소 200 x 200픽셀)
        include_once(G5_LIB_PATH.'/thumbnail.lib.php');
        $seo_thumb = get_list_thumbnail($bo_table, $wr_id, $board['bo_gallery_width'], $board['bo_gallery_height'], false, true);
        
        if($seo_thumb['src']) {
            $seo_image        = $seo_thumb['src'];
            $seo_image_width  = $board['bo_gallery_width'];
            $seo_image_height = $board['bo_gallery_height'];
        } /*else {
            if (preg_match("/<img.*src=\\\"(.*)\\\"/iUs", stripslashes($seo_row['wr_content']), $seo_tmp)) { // 에디터 이미지추출
                $seo_file = str_replace(G5_BBS_URL, "..",$seo_tmp[1]); // 파일명
                if (is_file($seo_file)) {
                    $seo_thumb = thumbnail($seo_file, $board['bo_gallery_width'], $board['bo_gallery_height'], 0, 1, 90, 0, "",  99, $noimg); // 에디터 썸네일
                    $seo_image        = $seo_thumb['src'];
                    $seo_image_width  = $board['bo_gallery_width'];
                    $seo_image_height = $board['bo_gallery_height'];
                }
            }
        }*/
    } else {
        if ($g5_head_title) {
            $seo_descriptionL = $g5_head_title.", ".$seo_descriptionL;
            $seo_descriptionS = $g5_head_title.", ".$seo_descriptionS;
            $seo_keywords = $g5_head_title.", ".$seo_keywords;
        }
    }
}

if ($gnu_seo_datetime) $seo_datetime = $gnu_seo_datetime;

echo "<meta http-equiv=\"content-language\" content=\"{$seo_language}\">\r\n";

//echo "<link rel=\"canonical\" href=\"{$seo_domain_addr}\">\r\n";
echo "<meta name=\"Author\" contents=\"{$seo_Author}\">\r\n";
echo "<meta name=\"Publisher\" content=\"{$seo_Author}\">\r\n";
echo "<meta name=\"Other Agent\" content=\"{$seo_Author}\">\r\n";
echo "<meta name=\"copyright\" content=\"{$seo_Author}\">\r\n";
echo "<meta name=\"Author-Date\" content=\"{$seo_datetime}\" scheme=\"YYYY-MM-DD\">\r\n";
echo "<meta name=\"Date\" content=\"{$seo_datetime}\" scheme=\"YYYY-MM-DD\">\r\n";
echo "<meta name=\"subject\" content=\"{$seo_head_title}\">\r\n";
echo "<meta name=\"title\" content=\"{$seo_head_title}\">\r\n";
echo "<meta name=\"Distribution\" content=\"{$seo_descriptionS}\">\r\n";
echo "<meta name=\"description\" content=\"{$seo_descriptionS}\">\r\n";
echo "<meta name=\"Descript-xion\" content=\"{$seo_descriptionL}\">\r\n";
echo "<meta name=\"keywords\" content=\"{$seo_keywords}\">\r\n";
echo "<meta itemprop=\"name\" content=\"{$seo_head_title}\">\r\n";
echo "<meta itemprop=\"description\" content=\"{$seo_descriptionS}\">\r\n";
if ($seo_image) echo "<meta itemprop=\"image\" content=\"{$seo_image}\">\r\n";

echo "<meta property=\"og:locale\" content=\"{$seo_locale}\">\r\n"; // ko_KR
echo "<meta property=\"og:locale:alternate\" content=\"{$seo_locale}\">\r\n";
echo "<meta property=\"og:author\" content=\"{$seo_Author}\">\r\n";
echo "<meta property=\"og:type\" content=\"website\">\r\n";
echo "<meta property=\"og:site_name\" content=\"{$seo_head_title}\">\r\n";
echo "<meta property=\"og:title\" id=\"ogtitle\" itemprop=\"name\" content=\"{$seo_head_title}\">\r\n";
echo "<meta property=\"og:description\" id=\"ogdesc\" content=\"{$seo_descriptionS}\">\r\n";
echo "<meta property=\"og:url\" content=\"{$seo_domain_addr}{$_SERVER['REQUEST_URI']}\">\r\n";
if ($seo_og_image) echo "<meta property=\"og:image\" id=\"ogimg\" content=\"{$seo_og_image}\">\r\n";
if ($seo_og_image_width) echo "<meta property=\"og:image:width\" content=\"{$seo_og_image_width}\">\r\n";
if ($seo_og_image_height) echo "<meta property=\"og:image:height\" content=\"{$seo_og_image_height}\">\r\n";
if ($wr_id) echo "<meta property=\"og:updated_time\" content=\"".substr($seo_wr_datetime,0,10)."T".substr($seo_wr_datetime,11,18)."+09:00\">\r\n";

echo "<meta name=\"apple-mobile-web-app-title\" content=\"{$seo_head_title}\">\r\n";
echo "<meta name=\"format-detection\" content=\"telephone=no\">\r\n";

if ($seo_theme_color) echo "<meta name=\"theme-color\" content=\"{$seo_theme_color}\">\r\n";

if ($seo_twitter) echo "<meta name=\"twitter:site\" content=\"@{$seo_twitter}\">\r\n";
if ($seo_twitter) echo "<meta name=\"twitter:creator\" content=\"@{$seo_twitter}\">\r\n";
echo "<meta name=\"twitter:title\" content=\"{$seo_head_title}\">\r\n";
echo "<meta name=\"twitter:description\" content=\"{$seo_descriptionS}\">\r\n";
echo "<meta name=\"twitter:domain\" content=\"{$seo_domain_addr}\">\r\n";
echo "<meta name=\"twitter:url\" content=\"{$seo_domain_addr}{$_SERVER['REQUEST_URI']}\">\r\n";
if ($seo_twitter_image) echo "<meta name=\"twitter:image\" content=\"{$seo_twitter_image}\">\r\n";
if ($seo_twitter_image_width) echo "<meta name=\"twitter:image:width\" content=\"{$seo_twitter_image_width}\">\r\n";
if ($seo_twitter_image_height) echo "<meta name=\"twitter:image:height\" content=\"{$seo_twitter_image_height}\">\r\n";
echo "<meta name=\"twitter:card\" content=\"summary\">\r\n"; // summary, photo, player , 신청: https://cards-dev.twitter.com/validator

if ($naver_site_verification) echo "<meta name=\"naver-site-verification\" content=\"{$naver_site_verification}\">\r\n";

echo "<span itemscope=\"\" itemtype=\"http://schema.org/Organization\">\r\n";
echo "<link itemprop=\"url\" href=\"{$seo_domain_addr}\">\r\n";
if ($seo_facebook) echo "<a itemprop=\"sameAs\" href=\"https://www.facebook.com/{$seo_facebook}\"></a>\r\n";
if ($seo_twitter) echo "<a itemprop=\"sameAs\" href=\"https://twitter.com/{$seo_twitter}\"></a>\r\n";
if ($seo_naver) echo "<a itemprop=\"sameAs\" href=\"http://blog.naver.com/{$seo_naver}\"></a>\r\n";
if ($seo_naver_storefarm) echo "<a itemprop=\"sameAs\" href=\"http://storefarm.naver.com/{$seo_naver_storefarm}\"></a>\r\n";
echo "</span>\r\n";

if ($seo_theme_color) echo "<meta name=\"msapplication-TileColor\" content=\"{$seo_theme_color}\">\r\n";

echo "\r\n";

echo "<meta name=\"referrer\" content=\"no-referrer-when-downgrade\">\r\n";
echo "<meta name=\"robots\" content=\"all\">\r\n";
echo "\r\n";

////////////////////////////// The End! 끝 //////////////////////////////
////////////////////////////////////////////////////////////////////
?>
