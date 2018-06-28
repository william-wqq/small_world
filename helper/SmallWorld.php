<?php
/**
 * Created by PhpStorm.
 * User: 365
 * Date: 2018/6/27
 * Time: 15:59
 */

namespace app\helper;


class SmallWorld
{
    const SUCCESS = 1;
    const ERROR = 0;

    /**
     * 返回错误
     * @param string $message
     * @param array $data
     * @param int $code
     * @return string
     */
    static public function sendError($message = '', $data = [], $code = self::ERROR) {
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
    static public function sendSuccess($message = '', $data = [], $code = self::SUCCESS) {
        $data = [
            'code' => $code,
            'msg' => $message,
            'data' => $data
        ];
        return json_encode($data);
    }
}