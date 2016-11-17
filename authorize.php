<?php

$app    = require __DIR__.'/app/app.php';
$action = $app->get('action', '');

/**
 * 判断
 */
switch ($action) {
    case '':
        return $app->wechat->oauth->redirect()->send();
        break;
    case 'callback':
        $user = $app->wechat->oauth->user();
        Common::setAuthUser($user->getOriginal());
        Common::saveWechatUser($user->getOriginal());
        Util::redirect('index.php');
        break;
    default:
        exit('Failed request!');
        break;
}
