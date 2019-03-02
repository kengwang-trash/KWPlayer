<?php
/**
 * Created by PhpStorm.
 * User: yushi
 * Date: 2019/3/2
 * Time: 21:00
 */
//引用MeTing
require_once 'meting.php';
use Metowolf\Meting;
//调用API并默认为网易云音乐
$API = new Meting('netease');
$API->cookie(getParam('cookie'));    // Cookie可以自定义

/*************前端功能******************/
function formatsinger($info){
    $first=true;
    $things=$info['songs'][0]['ar'];
    //print_r($things);
    foreach ($things as $value){
        $first=true;
        if($first){
            $temp='<a href="https://music.163.com/#/artist?id='.$value['id'].'">'.$value['name'].'</a>';
            $first=false;
        }else{
            $temp=' / <a href="https://music.163.com/#/artist?id='.$value['id'].'">'.$value['name'].'</a>';
        }
    }
    echo $temp;
}
/************主要功能*******************/

/**
 * 获取歌曲歌词
 * @param $id string 歌曲ID
 * @return string JSON
 */
function GetLyric($id){
    global $API;
    if(defined('CACHE_PATH')) {
        $cache = CACHE_PATH.'netease'.'_'.'lyric'.'_'.$id.'.json';

        if(file_exists($cache)) {   // 缓存存在，则读取缓存
            $data = file_get_contents($cache);
        } else {
            $data = $API->lyric($id);

            // 只缓存链接获取成功的歌曲
            if(json_decode($data)->lyric !== '') {
                file_put_contents($cache, $data);
            }
        }
    } else {
        $data = $API->lyric($id);
    }

    return $data;

}

/**
 * 获取歌曲播放链接
 * @param $id string 歌曲ID
 * @return false|mixed|string 链接
 */

function GetMusicUrl($id){
    global $API;

    $data = $API->url($id);

    return $data;

}



/**
 * 获取歌曲详情
 * @param $id string 歌曲ID
 * @return false|mixed|string
 */
function GetMusicInfo($id){
    global $API;
    $data=$API->song($id);
    return $data;
}

/******************杂七杂八***********/

/**
 * 获取GET或POST过来的参数
 * @param $key string 键值
 * @param $default string 默认值
 * @return string 获取到的内容（没有则为默认值）
 */
function getParam($key, $default='')
{
    return trim($key && is_string($key) ? (isset($_POST[$key]) ? $_POST[$key] : (isset($_GET[$key]) ? $_GET[$key] : $default)) : $default);
}