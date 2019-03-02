<?php
/**
 * Created by PhpStorm.
 * User: yushi
 * Date: 2019/3/3
 * Time: 0:24
 */

error_reporting(E_ALL ^ E_NOTICE);
include 'api.php';
$music_id=$_GET['id'];
//获取歌词
$lyric=json_decode(GetLyric($music_id),true);
if ($lyric['nolyric']!='true') {
    $l=$lyric['lrc']['lyric'];
}else{
    $l="无歌词";
}
echo $l;