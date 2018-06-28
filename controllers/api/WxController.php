<?php

namespace app\controllers\api;
use Yii;

class WxController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }



    public function actionOpenid(){
        $request = Yii::$app->request;
        $appId = Yii::$app->params['AppID'];
        $appSecret = Yii::$app->params['AppSecret'];
        $jsCode = $request->get('js_code');

        //var_dump($appId);
        $url    = 'https://api.weixin.qq.com/sns/jscode2session?appid='.$appId.'&secret='.$appSecret.'&grant_type=authorization_code'.'&js_code='.$jsCode;
        $resultJson = file_get_contents($url);
        $resultArray = json_decode($resultJson, TRUE);
        print_r($resultArray);
    }



}
