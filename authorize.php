<?php

/**
 * 获取 app 实例
 */
$app = require __DIR__.'/app/app.php';

/**
 * 获取动作
 */
$action = $app->get('action', '');

/**
 * 判断
 */
switch ($action) {
    case '':
        // 需要授权 跳转到授权页面去
        return $app->wechat->oauth->redirect()->send();
        break;
    case 'callback':
        // 授权回调页面 获取用户的信息
        $user = $app->wechat->oauth->user();

        // 将用户的信息写入到 session 维持回话状态
        Common::setAuthUser($user->getOriginal());

        // 将用户信息保存到数据库里面
        Common::saveWechatUser($user->getOriginal());

        // 授权逻辑完毕 跳转到首页 开始 h5
        Util::redirect('index.php');
        break;
    default:
        // 错误的请求
        exit('Failed request!');
        break;
}
