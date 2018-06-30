<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/30/030
 * Time: 16:43
 */

namespace app\helper;
use yii\caching\Cache;


class Sms
{
    static private $app_key = '7b6ac8de59d804ddbd567c4ee6969735';
    static private $api_url = 'http://v.juhe.cn/sms/send?';
    static private $tpl_id = 16997;

    static public function send($phone)
    {
        $tpl_value = self::randString();
        $params = [
            'mobile' => $phone,
            'tpl_id' => self::$tpl_id,
            'tpl_value' => urlencode("#code#=" . $tpl_value),
            'key' => self::$app_key
        ];

        $url = self::$api_url . http_build_query($params);
        $result = file_get_contents($url);
        $result = json_decode($result, true);
        $result['sms_code'] = $tpl_value;
        return $result;
    }


    /**
     * 产生随机数串
     * @param integer $len 随机数字长度
     * @return string
     */
    static private function randString($len = 6)
    {
        $chars = str_repeat('0123456789', 3);
        $chars = str_repeat($chars, $len);
        $chars = str_shuffle($chars);
        $str = substr($chars, 0, $len);
        return $str;
    }
}