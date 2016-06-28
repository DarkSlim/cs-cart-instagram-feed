<?php
use Tygh\Registry;

if ( !defined('AREA') ) { die('Access denied'); }

function display_instagramfeed()
{

$instagram_uid = Registry::get('addons.csc_instagram_feed.instagram_user_id');

$access_token = Registry::get('addons.csc_instagram_feed.instagram_access_token');

$photo_count = Registry::get('addons.csc_instagram_feed.number_of_item');


$json_link="https://api.instagram.com/v1/users/{$instagram_uid}/media/recent/?";
$json_link.="access_token={$access_token}&count={$photo_count}";


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $json_link); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
$output = curl_exec($ch); 

$response_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

if(($response_code !== 400) or ($response_code !== 404)) {

//var_dump($http_response_header);

//$obj = json_decode($json, true, 512, JSON_BIGINT_AS_STRING);
$obj = json_decode($output, true);

$data = array();
$i = 1;
if (is_array($obj) || is_object($obj)) {
foreach ($obj['data'] as $post) {

    $pic_text=$post['caption']['text'];
    $pic_src=str_replace("http://", "https://", $post['images']['standard_resolution']['url']);    
    //$pic_link=$post['link'];
    //$pic_like_count=$post['likes']['count'];
    //$pic_comment_count=$post['comments']['count'];
    //$pic_created_time=date("F j, Y", $post['caption']['created_time']);
    //$pic_created_time=date("F j, Y", strtotime($pic_created_time . " +1 days"));
    
    $data[$i]['imgsrc'] = $pic_src;
    $data[$i]['title'] = $pic_text;
    
    $i++;
}
}
    //var_dump($data);
    
	return $data;
}
}

?>
