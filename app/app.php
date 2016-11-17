<?php

/**
 * 引入配置和 composer autoload 文件
 */
require __DIR__.'/../vendor/autoload.php';
require __DIR__.'/config.php';
require __DIR__.'/util.php';
require __DIR__.'/common.php';

/**
 * 定义 Application 类
 */
class Application
{
    /**
     * 当前对象的实例
     */
    private static $instance = null;

    /**
     * 数据库实例
     */
    public $database = null;

    /**
     * 微信实例
     */
    public $wechat = null;

    /**
     * http 请求的实例
     */
    public $request = null;

    /**
     * 构造函数私有化
     */
    private function __construct() {}

    /**
     * 防止 clone
     */
    public function __clone()
    {
        throw new Exception('Method __clone unavailable!');
    }

    /**
     * 唯一获取 Application 实例的方法
     */
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new static();
        }

        return self::$instance;
    }

    /**
     * 启动
     */
    public function start()
    {
        $this->configEnvironment();
        $this->createRequest();

        ENABLE_DATABASE && $this->createDatabase();
        ENABLE_WECHAT && $this->createWechat();

        return $this;
    }

    /**
     * 配置环境
     */
    public function configEnvironment()
    {
        ENABLE_SESSION && session_start();

        if (APP_DEBUG) {
            error_reporting(-1);
            ini_set('display_errors', 1);
        } else {
            ini_set('display_errors', 0);
            if (version_compare(PHP_VERSION, '5.3', '>=')) {
                error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED);
            } else {
                error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_USER_NOTICE);
            }
        }
    }

    /**
     * 创建数据库的实例 如果需要
     */
    public function createDatabase()
    {
        $database = new Illuminate\Database\Capsule\Manager();
        $database->addConnection(array(
            'driver'    => DB_DRIVER,
            'host'      => DB_HOST,
            'database'  => DB_DATABASE,
            'username'  => DB_USERNAME,
            'password'  => DB_PASSWORD,
            'charset'   => DB_CHARSET,
            'collation' => DB_COLLATION,
            'prefix'    => DB_PREFIX,
        ));

        $this->database = $database;
    }

    /**
     * 创建微信的实例
     */
    public function createWechat()
    {
        $wechat = new EasyWeChat\Foundation\Application(array(
            'debug'     => APP_DEBUG,
            'app_id'    => WECHAT_APPID,
            'secret'    => WECHAT_SECRET,
            'token'     => WECHAT_TOKEN,
            'aes_key'   => WECHAT_AES_KEY,
            'log'       => [
                'level' => WECHAT_LOG_LEVEL,
                'file'  => WECHAT_LOG_FILE,
            ],
            'oauth'     => [
                'scopes'    => [WECHAT_OAUTH_SCOPES],
                'callback'  => WECHAT_OAUTH_CALLBACK,
            ]
        ));

        $this->wechat = $wechat;
    }

    /**
     * 创建 request
     */
    public function createRequest()
    {
        $this->request = Symfony\Component\HttpFoundation\Request::createFromGlobals();
    }

    /**
     * 获取 get 数据
     */
    public function get($key, $default = null)
    {
        return $this->request->query->get($key, $default);
    }

    /**
     * 获取 post 数据
     */
    public function post($key, $default = null)
    {
        return $this->request->request->get($key, $default);
    }

    /**
     * 判断 ajax
     */
    public function isAjax()
    {
        return $this->request->isXmlHttpRequest();
    }
}

/**
 * 创建 app 并启动
 */
return Application::getInstance()->start();
