<?php

namespace app\controllers\api;

class UploadController extends \yii\web\Controller
{
    public function actionIndex()
    {
        print_r($_POST);die;
        return sendError('发送失败');

    }

    public function actiontTest() {
        return sendError('测试');
    }

}
