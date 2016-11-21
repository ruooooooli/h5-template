<?php

    /**
     * 获取 app 实例
     */
    $app = require __DIR__.'/app/app.php';

    // 判断是否授权
    if (!Common::isAuth()) {
        // 设置当前页面的地址
        $currentUrl = Common::generateUrl($_SERVER['REQUEST_URI']);
        Common::setSession(SESS_TARGET_URL, $currentUrl);

        // 跳转去授权
        Util::redirect('authorize.php');
    }

    /**
     * 分享配置
     */
    $user   = Common::getAuthUser();
    $jssdk  = $app->jssdk();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title></title>
    </head>
    <body>


        <h1>Hello World !</h1>


    </body>

    <!-- 先引入微信的 js 文件 -->
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js" charset="utf-8"></script>
    <script type="text/javascript">
        // 预先定义分享的描述信息
        var options = {
            title   : '',
            desc    : '',
            link    : '',
            imgUrl  : '',
        };

        // 通过 wx.config 注入配置信息
        wx.config(<?php echo $jssdk; ?>);

        // 通过ready接口处理成功验证
        wx.ready(function () {

            // 获取“分享到朋友圈”按钮点击状态及自定义分享内容接口
            wx.onMenuShareTimeline({
                title   : options.title,    // 分享标题
                link    : options.link,     // 分享链接
                imgUrl  : options.imgUrl,   // 分享图标
                success : function () {
                    // 用户确认分享后执行的回调函数
                },
                cancel  : function () {
                    // 用户取消分享后执行的回调函数
                }
            });

            // 获取“分享给朋友”按钮点击状态及自定义分享内容接口
            wx.onMenuShareAppMessage({
                title   : options.title,    // 分享标题
                desc    : options.desc,     // 分享描述
                link    : options.link,     // 分享链接
                imgUrl  : options.imgUrl,   // 分享图标
                success : function () {
                    // 用户确认分享后执行的回调函数
                },
                cancel  : function () {
                    // 用户取消分享后执行的回调函数
                }
            });

            // 可以继续填写其他接口
            //
        });
    </script>
</html>
