<?php

namespace app\controllers\api;
use app\helper\SmallWorld;
use app\helper\Sms;
use app\models\Users;
use Yii;

class UserController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return sendError('测试');
    }

    /**
     * 个人资料修改
     * @return string
     */
    public function actionModify() {
        $request = Yii::$app->request;

        $uid = $request->get('uid', 0);
        $username = $request->get('username');
        $phone = $request->get('phone');
        $code = $request->get('code');
        $wx_number = $request->get('wx_number');

        if(!$uid)
            return sendError('参数有误');

        if(empty($username))
            return sendError('姓名不能为空');
        else
            if(!isName($username))
                return sendError('姓名只能为中文');

        if(empty($phone))
            return sendError('手机号不能为空');
        else
            if(!isMobile($phone))
                return sendError('手机只能是11位数字');

        if(empty($code))
            return sendError('验证码不能为空');
        else
            if(!preg_match('/\d{6}/', $code))
                return sendError('验证码不正确');

        if(empty($wx_number))
            return sendError('微信号不能为空');
        else
            if(!isWxNumber($wx_number))
                return sendError('微信号格式不正确');

        if(!$this->actionCheckCode($phone, $code))
            return sendError('短信验证码不正确');

        $user = Users::findOne(['uid' => $uid]);
        if (!$user->uid)
            return sendError('用户不存在');

        $user->username = $username;
        $user->phone = $phone;
        $user->wx_number = $wx_number;
        $user->update_time = time();

        if($user->save())
            return sendSuccess('修改成功');
        return sendError('修改失败');
    }

    /*
     * 发送验证码
     */
    public function actionSendCode() {
        $request = Yii::$app->request;
        $cache = Yii::$app->cache;
        $phone = $request->get('phone');
        if(empty($phone))
            return sendError('手机号不能为空');
        else
            if(!isMobile($phone))
                return sendError('手机只能是11位数字');
        $result = Sms::send($phone);
        if($result && $result['error_code'] == 0) {
            $cache->set('phone_'.$phone, $result['sms_code'], 5*60);
            Yii::info($phone . '发送短信成功，验证码：' . $result['sms_code'] . '，返回' . json_encode($result), 'sms');
            return sendSuccess('发送成功');
        }
        Yii::error($phone . '发送短信失败，返回' . json_encode($result), 'sms');
        return sendError('发送失败');
    }

    /**
     * 校验验证码
     * @param $phone
     * @param $code
     */
    public function actionCheckCode($phone, $code) {
        $cache = Yii::$app->cache;
        $sms_code = $cache->get('phone_'.$phone);
        if($sms_code != $code) {
            return false;
        }
        return true;
    }
}
