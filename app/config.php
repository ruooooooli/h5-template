<?php

/**
 * 项目配置
 */
define('APP_DEBUG', true);
define('ENABLE_SESSION', true); // 启用 session
define('APP_URL', '');
define('INDEX_URL', '');
define('AUTHORIZE_URL', '');
define('AUTHORIZE_CALLBACK', '');
define('AUTHORIZE_KEY', ''); // session 存取用户信息的 key

/**
 * 微信配置
 */
define('ENABLE_WECHAT', true); // 启用微信
define('WECHAT_APPID', '');
define('WECHAT_SECRET', '');
define('WECHAT_TOKEN', '');
define('WECHAT_AES_KEY', '');
define('WECHAT_OAUTH_SCOPES', 'snsapi_userinfo');
define('WECHAT_OAUTH_CALLBACK', AUTHORIZE_CALLBACK);
define('WECHAT_LOG_FILE', realpath(__DIR__.'/../storage/wechat.log')); // 绝对路径
define('WECHAT_LOG_LEVEL', 'debug'); // debug|info|notice|warning|error|critical|alert|emergency

/**
 * 数据库配置
 */
define('ENABLE_DATABASE', true); // 启用数据库
define('DB_DRIVER', 'mysql');
define('DB_HOST', '');
define('DB_DATABASE', '');
define('DB_USERNAME', '');
define('DB_PASSWORD', '');
define('DB_CHARSET', 'utf8');
define('DB_COLLATION', 'utf8_unicode_ci');
define('DB_PREFIX', 'utf8');

/**
 * 其他配置
 */
