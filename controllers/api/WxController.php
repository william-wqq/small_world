<?php

namespace app\controllers\api;
use app\helper\SmallWorld;
use app\models\User;
use app\models\Users;
use DeepCopy\TypeFilter\Date;
use Yii;

class WxController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }


    /**
     * 获取openid
     * @method GET
     */
    public function actionOpenid(){
        $request = Yii::$app->request;
        $appId = Yii::$app->params['AppID'];
        $appSecret = Yii::$app->params['AppSecret'];
        $jsCode = $request->get('code');

        $url = 'https://api.weixin.qq.com/sns/jscode2session?appid='.$appId.'&secret='.$appSecret.'&grant_type=authorization_code'.'&js_code='.$jsCode;
        $resultJson = file_get_contents($url);
        $resultArray = json_decode($resultJson, TRUE);
        //print_r($resultArray);
        return SmallWorld::sendSuccess('返回成功', $resultArray);
    }

    /**
     * 登录
     * @method GET
     */
    public function actionLogin() {
        $request = Yii::$app->request;
        $nickname = $request->get('nickname');
        $avatar_url = $request->get('avatar_url');
        $openid = $request->get('openid','oqDzs0O_XXgUSq0pR6KzkJ7x2J0s');
        $user = Users::findOne(['openid' => $openid]);
        if($user->uid) {
            return SmallWorld::sendSuccess('用户存在', $user->toArray());
        }

        try{
            $userModel = new Users();
            $userModel->nickname = $nickname;
            $userModel->openid = $openid;
            $userModel->avatar_url = $avatar_url;
            $userModel->add_time = time();
            $userModel->save();
            $user = Users::findOne(['openid' => $openid]);
        }catch(\Exception $e) {
            return SmallWorld::sendError($e->getMessage());
        }
        return SmallWorld::sendSuccess('用户添加成功', $user->toArray());
    }

    /**
     * 获取用户信息
     */
    public function getUserInfo() {
        $request = Yii::$app->request;
        $uid = $request->get('uid');
        $user = Users::findOne(['uid' => $uid]);
        if($user->uid) {
            return SmallWorld::sendSuccess('返回用户'.$uid, $user->toArray());
        }
        return SmallWorld::sendError('查无用户'.$uid);
    }



}
