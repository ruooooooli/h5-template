<?php

/**
 * 项目公用函数类
 */
class Common
{
    /**
     * 设置 session
     */
    public static function setSession($key, $value = '')
    {
        if (empty($key) || empty($value)) {
            return false;
        }

        $_SESSION[$key] = serialize($value);

        return self::hasSession($key);
    }

    /**
     * 获取 session
     */
    public static function getSession($key)
    {
        return self::hasSession($key) ? unserialize($_SESSION[$key]) : null;
    }

    /**
     * 是否有 session
     */
    public static function hasSession($key)
    {
        return isset($_SESSION[$key]);
    }

    /**
     * 判断用户是否认证
     */
    public static function isAuth()
    {
        return self::hasSession(SESS_AUTHORIZE_KEY);
    }

    /**
     * 获取已经认证的用户信息
     */
    public static function getAuthUser()
    {
        return self::getSession(SESS_AUTHORIZE_KEY);
    }

    /**
     * 设置用户认证信息
     */
    public static function setAuthUser($user)
    {
        return self::setSession(SESS_AUTHORIZE_KEY, $user);
    }

    public static function generateUrl($path)
    {
        return APP_URL.trim($path, '/');
    }
}
