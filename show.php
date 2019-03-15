<?php
/**
 * Created by PhpStorm.
 * User: yushi
 * Date: 2019/3/2
 * Time: 20:55
 */

//屏蔽报错
error_reporting(E_ALL ^ E_NOTICE);
//引用到API
include 'api/api.php';
/************ 预请求音乐 *********/

//获取id
$music_id = $_GET['id'];
//获取链接地址
$url = json_decode(GetMusicUrl($music_id), true)['data'][0]['url'];
//获取歌曲信息
$info = json_decode(GetMusicInfo($music_id), true);
//获取歌曲封面
$pic = $info['songs'][0]['al']['picUrl'];
/* 调试代码
echo "<pre>";
var_dump($url);
echo "</pre>";
exit;
var_dump($url);
var_dump($info);
*/
/************ 获取样式主题并且处理 *********/
//获取用户请求的主题
if (!isset($_GET['theme'])) $theme = 'default'; else $theme = $_GET['theme'];
//获取是否存在该主题
$all = file_get_contents('./theme/'.$theme.'.kwptheme');
if ($all == false) {
    $all = file_get_contents('./theme/default.kwptheme');
}
//替换消息
$all = str_replace('{audio}', '<audio id="audio" src="'.$url.'">', $all);
$all = str_replace('{musicurl}', $url, $all);
$all = str_replace('{picurl}', $pic, $all);
$all = str_replace('{singer}', formatsinger($info), $all);
$all = str_replace('{musicname}', $info['songs']['0']['name'], $all);
$all = str_replace('{musicid}', $music_id, $all);
$all = str_replace('{albumid}', $info['songs'][0]['al']['id'], $all);
$all = str_replace('{albumname}', $info['songs'][0]['al']['name'], $all);
$all = str_replace('{lrcurl}', "lyric.php?id=$music_id", $all);
$all = str_replace('{ncurl}', "https://music.163.com/#/song?id=$music_id", $all);
$alid = $info['songs'][0]['al']['id'];
$all = str_replace('{albumurl}', "https://music.163.com/#/album?id=$alid", $all);
$all = str_replace('{autoplay}', $_GET['autoplay'], $all);
echo $all;
?>