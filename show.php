<?php
/**
 * Created by PhpStorm.
 * User: yushi
 * Date: 2019/3/2
 * Time: 20:55
 */
error_reporting(E_ALL ^ E_NOTICE);
include 'api.php';
//获取id
$music_id=$_GET['id'];
//获取链接地址
$url=json_decode(GetMusicUrl($music_id),true)['data'][0]['url'];
//获取歌曲信息
$info=json_decode(GetMusicInfo($music_id),true);
//获取歌曲封面
$pic=$info['songs'][0]['al']['picUrl'];
//echo "<pre>";
//var_dump($url);
//echo "</pre>";
//exit;
//var_dump($url);
//var_dump($info);

?>
<!-- Netease Player includes-->
<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.1.0/css/bootstrap.min.css">
<style>
    a{
        border: none !important;
    }
    #div_lrc {
        position: absolute;
        padding-top: 0px;
        left: 28%;
        top: 300px;
        width:50%;
        transition: top .5s;
        margin: 0 auto;

    }
    .div_DisLrc {
        overflow: hidden;
        color:#b1abab;
        width: 70%;
        height: 600px;
        position: relative;
        margin: 0 auto;

    }

    #audio {
        width: 100%;
    }

    .div_audio {
        width: 50%;
        margin: 0 auto;
    }

    .div_but {
        position: absolute;
        font-size: 26px;
        font-weight: 900;
        top: 40%;
        right: 0%;
    }

    .div_but p {
        cursor: pointer;
    }

</style>
<script src="https://cdn.staticfile.org/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.staticfile.org/popper.js/1.12.5/umd/popper.min.js"></script>
<script src="https://cdn.staticfile.org/twitter-bootstrap/4.1.0/js/bootstrap.min.js"></script>
<!-- Lyric Shows -->

<!-- Player Start -->
<div id="OnlinePlayer" class="card">
    <div class="card-header"><img src="https://f.ydr.me/music.163.com/">&nbsp;&nbsp;&nbsp;&nbsp;<a href="https://music.163.com/#/song?id=<?php echo $music_id; ?>" target="_blank"><?php echo $info['songs']['0']['name']; ?></a>&nbsp;&nbsp;-&nbsp;&nbsp;<?php formatsinger($info); ?></div>
    <div class="card-body">
        <img src="<?php echo $pic ?>" onclick="location='https://music.163.com/#/album?id=<?php echo $info['songs'][0]['al']['id']; ?>'">
            <audio id="audio" controls="controls" preload="auto" >
                <source src="<?php echo $url; ?>" type="audio/mpeg"/>
                <track src="lyric.php?id=<?php echo $music_id; ?>">
            </audio>
    </div>
    <div class="card-footer">
                
    </div>
</div>
