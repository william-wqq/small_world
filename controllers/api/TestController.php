<?php

namespace app\controllers\api;

class TestController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $data = [
            'name' => 'wqq',
            'sex' => 1,
        ];
        return $this->sendSuccess('成功', $data);
    }

}
