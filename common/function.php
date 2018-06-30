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

?>