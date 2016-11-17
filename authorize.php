<?php

$app    = require __DIR__.'/app/app.php';
$action = $app->get('action', '');

/**
 * 判断
 */
switch ($action) {
    case '':
        // 获取当前页地址
        $currentUrl = Common::generateUrl($_SERVER['REQUEST_URI']);
        Common::setSession(SESS_TARGET_URL, $currentUrl);

        // 跳转去授权
        $app->wechat->oauth->redirect();
        break;
    case 'callback':
        // 处理回调
        $user = $app->wechat->oauth->user();

        // 持久化用户信息
        var_dump($user);
        break;
    default:
        exit('Failed request!');
        break;
}
