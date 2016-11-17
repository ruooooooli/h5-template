<?php

use Illuminate\Database\Capsule\Manager as DB;

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

    /**
     * 生成 url
     */
    public static function generateUrl($path = '')
    {
        return APP_URL.trim($path, '/');
    }

    /**
     * 保存微信的用户信息到数据库
     */
    public static function saveWechatUser($user)
    {
        $query = DB::table('wechats')->where('openid', '=', $user['openid']);

        if ($query->exists()) {
            $query->update(array(
                'nickname'      => $user['nickname'],
                'avatar'        => $user['headimgurl'],
                'updated_at'    => date('Y-m-d H:i:s'),
            ));
        } else {
            $wechats = DB::table('wechats')->insert(
                array(
                    'openid'        => $user['openid'],
                    'nickname'      => $user['nickname'],
                    'gender'        => ($user['sex'] == 1) ? 'M' : 'F',
                    'country'       => $user['country'],
                    'province'      => $user['province'],
                    'city'          => $user['city'],
                    'avatar'        => $user['headimgurl'],
                    'created_at'    => date('Y-m-d H:i:s'),
                    'updated_at'    => date('Y-m-d H:i:s'),
                )
            );
        }
    }
}
