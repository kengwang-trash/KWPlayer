<?php
/**
 * Created by PhpStorm.
 * User: yushi
 * Date: 2019/3/9
 * Time: 17:51
 */

//HomePage - Show Themes & Create Code & Introduction
error_reporting(E_ALL ^ E_NOTICE);

/******* 数据库连接 ********/

$DB = new SQLite3('db.db');
//$DB->open('db.db');
if (!$DB) {
    echo '数据库连接出错';
    exit;
}

/********** 主题信息获取 **********/
//获取翻页数
$start = $_GET['page'] * 10;
$end = $start + 10;
$res = $DB->query("SELECT * FROM \"main\".\"theme\" LIMIT {$start},{$end} ");
$themeinfo = $res->fetchArray(SQLITE3_ASSOC);
?>
<!DOCTYPE html>
<html lang="ch">
<head>
    <!-- include MDUI -->
    <link href="https://cdn.bootcss.com/mdui/0.4.2/css/mdui.css" rel="stylesheet">
    <link href="https://cdn.bootcss.com/mdui/0.4.2/css/mdui.min.css" rel="stylesheet">
    <script src="https://cdn.bootcss.com/mdui/0.4.2/js/mdui.js"></script>
    <script src="https://cdn.bootcss.com/mdui/0.4.2/js/mdui.min.js"></script>
    <!-- Things -->
    <title>KPlayer - 开源的在线组件播放器</title>
    <!-- 背景 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.js"></script>
    <script type="text/javascript" src="js/vector.js"></script>
    <script type="text/javascript" src="js/clipboard.min.js"></script>
    <script type="text/javascript">
        $(function () {
            Victor("bgcontainer", "bgoutput");   //登陆背景函数
        });


    </script>
</head>
<body>

<!-- BackGround -->
<div id="bgcontainer" style=" position:fixed;">
    <div id="bgoutput"></div>
</div>

<div class="mdui-container">
    <div class="mdui-row">
        <div class="mdui-col-sm-1 mdui-col-md-2 mdui-col-lg-3 mdui-hidden-xs">
            &nbsp;
        </div>
        <div class="mdui-col-xs-12 mdui-col-sm-10 mdui-col-md-8 mdui-col-lg-6">

            <div class="mdui-card head">
                <div class="mdui-container">
                    <br><br>
                    <div class="first">
                        <p>开源,强大,简单,实用的外链播放器</p>
                        <div class="web-title">&nbsp;&nbsp;&nbsp;KPlayer</div>
                        <br><br>
                        <hr>
                        <br><br>
                    </div>

                    <div class="mdui-textfield">
                        <label class="mdui-textfield-label">歌曲ID</label>
                        <input id="mid" type="text" class="mdui-textfield-input" placeholder="音乐ID" value="32717971"/>
                        <button id="done" class="mdui-btn mdui-color-blue mdui-ripple mdui-right" onclick="changed();">
                            确定
                        </button>
                        <div class="mdui-textfield-helper">网易云音乐歌曲ID https://music.163.com/#/song?id=歌曲ID</div>
                    </div>
                    <br><br>
                    <div class="mdui-textfield">
                        <label class="mdui-textfield-label">生成的代码</label>
                        <input id="code" class="mdui-textfield-input" value="code" type="text"/>
                    </div>
                    <button id="copy" class="mdui-btn mdui-color-blue mdui-ripple mdui-center"
                            data-clipboard-target="#code">复制
                    </button>
                    <br>

                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">

</div>
</body>
<script>
    new ClipboardJS('#copy');
    changed();

    function changed() {
        var id = $("#mid").val();
        var qian = "<iframe src=\"https://kplayer.tysv.top/show.php?id=";
        var hou = "\"></iframe>";
        $("#code").val(qian + id + hou);
        $.get('/api/api.php?fun=musicname&p=' + id, function (data) {
            mdui.snackbar({
                message: "当前ID: " + id + " 对应歌曲: " + data
            });
        })
    }
</script>
</html>
