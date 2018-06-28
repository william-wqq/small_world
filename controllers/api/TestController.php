<?php

namespace app\controllers\api;
use app\helper\SmallWorld;
use Yii;

class TestController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $data = [
            'name' => 'wqq',
            'sex' => 1,
        ];
        return SmallWorld::sendSuccess('成功', $data);
    }
    public function actionOpenid(){
        $request = Yii::$app->request;
        $appId = Yii::$app->params['AppID'];
        $appSecret = Yii::$app->params['AppSecret'];
        $jsCode = $request->get('js_code');

        $url    = 'https://api.weixin.qq.com/sns/jscode2session?appid='.$appId.'&secret='.$appSecret.'&grant_type=authorization_code'.'&js_code='.$jsCode;
        $resultJson = file_get_contents($url);
        $resultArray = json_decode($resultJson, TRUE);
        print_r($resultArray);
    }


}
