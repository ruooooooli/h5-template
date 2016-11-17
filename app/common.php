<?php

/**
 * 项目公用函数类
 */
class Common
{
    /**
     * 判断用户是否认证
     */
    public static function isAuth()
    {
        return isset($_SESSION[AUTHORIZE_KEY]);
    }

    /**
     * 获取已经认证的用户信息
     */
    public static function getAuthUser()
    {
        return self::isAuth() ? unserialize($_SESSION[AUTHORIZE_KEY]) : null;
    }

    /**
     * 设置用户认证信息
     */
    public static function setAuthUser($user)
    {
        if (empty($user)) {
            return false;
        }

        $_SESSION[AUTHORIZE_KEY] = serialize($user);

        return self::isAuth();
    }
}
