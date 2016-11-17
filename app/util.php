<?php

/**
 * 工具函数类
 */
class Util
{
    /**
     * 转换 json
     */
    public static function json($data)
    {
        return json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    /**
     * 返回 json
     */
    public static function responseJson($data)
    {
        header("Content-Type : application/json; charset=utf-8");
        echo self::json($data);
        exit;
    }

    /**
     * ajax 返回成功消息
     */
    public static function success($message, $data = array(), $status = 200)
    {
        self::responseJson(array(
            'code'          => 'success',
            'message'       => $message,
            'data'          => $data,
            'status_code'   => $status,
        ));
    }

    /**
     * ajax 返回错误消息
     */
    public static function error($message, $data = array(), $status = 200)
    {
        self::responseJson(array(
            'code'          => 'error',
            'message'       => $message,
            'data'          => $data,
            'status_code'   => $status,
        ));
    }

    /**
     * 判断电话号码
     */
    public static function isMobile($value)
    {
        if (11 !== mb_strlen($value)) {
            return false;
        }

        $arr = array(
            130, 131, 132, 133, 134, 135, 136, 137, 138, 139,
            145, 147,
            150, 151, 152, 153, 154, 155, 156, 157, 158, 159,
            176, 177, 178,
            180, 181, 182, 183, 184, 185, 186, 187, 188, 189,
        );

        return in_array(mb_substr($value, 0, 3), $arr);
    }

    /**
     * 判断邮箱
     */
    public static function isEmail($email)
    {
        return (filter_var($email, FILTER_VALIDATE_EMAIL) != false);
    }

    /**
     * 检测是否是中文姓名
     */
    public static function isChineseName($value)
    {
        // 姓名只能为中文
        if (!preg_match("/^\p{Han}+$/u", $value)) {
            return false;
        }

        // 姓名只能 2-4 个字
        $strlen = mb_strlen($value);
        if (($strlen < 2) || ($strlen > 4)) {
            return false;
        }

        return true;
    }

    /**
     * 重定向
     */
    public static function redirect($path = '')
    {
        if (empty($path)) {
            return false;
        }

        header("Location: {$path}");
        exit;
    }

    /**
     * 随机字符
     */
    public static function randomString($len = 4)
    {
        $string = '0123456789';
        $result = '';
        $max    = mb_strlen($string) - 1;
        for ($i = 0; $i < $len; $i++) {
            $result .= $string[mt_rand(0, $max)];
        }

        return $result;
    }


    /**
     * 上周一
     */
    public static function lastMonday($hour = 0, $minute = 0, $second = 0)
    {
        return mktime($hour, $minute, $second, date('n'), date('j') - date('N') - 6, date('Y'));
    }

    /**
     * 上周日
     */
    public static function lastSunday($hour = 0, $minute = 0, $second = 0)
    {
        return mktime($hour, $minute, $second, date('n'), date('j') - date('N'), date('Y'));
    }

    /**
     * 本周一
     */
    public static function thisMonday($hour = 0, $minute = 0, $second = 0)
    {
        return mktime($hour, $minute, $second, date('n'), date('j') - date('N') + 1, date('Y'));
    }

    /**
     * 本周日
     */
    public static function thisSunday($hour = 0, $minute = 0, $second = 0)
    {
        return mktime($hour, $minute, $second, date('n'), date('j') - date('N') + 7, date('Y'));
    }

    /**
     * 上个月第一天
     */
    public static function firstDayOfLastMonth($hour = 0, $minute = 0, $second = 0)
    {
        return mktime($hour, $minute, $second, date('n') - 1, 1, date('Y'));
    }

    /**
     * 上个月最后一天
     */
    public static function lastDayOfLastMonth($hour = 0, $minute = 0, $second = 0)
    {
        return mktime($hour, $minute, $second, date('n'), 0, date('Y'));
    }

    /**
     * 本月第一天
     */
    public static function firstDayOfMonth($hour = 0, $minute = 0, $second = 0)
    {
        return mktime($hour, $minute, $second, date('n'), 1, date('Y'));
    }

    /**
     * 本月最后一天
     */
    public static function lastDayOfMonth($hour = 0, $minute = 0, $second = 0)
    {
        return mktime($hour, $minute, $second, date('n'), date('t'), date('Y'));
    }
}
