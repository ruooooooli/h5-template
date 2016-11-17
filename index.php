<?php

    $app = require __DIR__.'/app/app.php';

    // 判断是否授权
    if (!Common::isAuth()) {
        // 设置当前页面的地址
        $currentUrl = Common::generateUrl($_SERVER['REQUEST_URI']);
        Common::setSession(SESS_TARGET_URL, $currentUrl);

        // 跳转去授权
        Util::redirect('authorize.php');
    }

    echo "success";
