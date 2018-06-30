<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/30/030
 * Time: 18:57
 */

    function sendError($message = '', $data = [], $code = 0) {
        $data = [
            'code' => $code,
            'msg' => $message,
            'data' => $data
        ];
        return json_encode($data);
    }

    /**
     * 返回正确
     * @param string $message
     * @param array $data
     * @param int $code
     * @return string
     */
    function sendSuccess($message = '', $data = [], $code = 1) {
        $data = [
            'code' => $code,
            'msg' => $message,
            'data' => $data
        ];
        return json_encode($data);
    }

    function isMobile($phone) {
        if(preg_match('/^1\d{10}/', $phone))
            return true;
        return false;
    }

    function isName($username) {
        if(preg_match(' /^[\x{4e00}-\x{9fa5}]{1,10}$/u', $username))
            return true;
        return false;
    }

    function isWxNumber($wx_number) {
        if(preg_match('/^[a-zA-Z\d_]{5,}$/', $wx_number))
            return true;
        return false;
    }

?>