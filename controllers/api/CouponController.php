<?php

namespace app\controllers\api;
use app\helper\SmallWorld;
use app\models\Coupons;
use app\models\UserCoupons;
use Yii;

class CouponController extends \yii\web\Controller
{
    /**
     * 优惠券列表
     */
    public function actionIndex()
    {
        $request = Yii::$app->request;
        $status = intval($request->get('status', UserCoupons::COUPON_WAITE));
        $uid = intval($request->get('uid'));
        if (!in_array($status, array_keys(UserCoupons::couponStatus())))
            return sendError('参数异常');

        $coupon = UserCoupons::find()->asArray();
        //$nowTime = time();
        if($status == UserCoupons::COUPON_WAITE)
            $coupon->where(['status' => UserCoupons::COUPON_WAITE]);
        elseif($status == UserCoupons::COUPON_USED)
            $coupon->where(['status' => UserCoupons::COUPON_USED]);
        elseif($status == UserCoupons::COUPON_EXPIRED)
            $coupon->where(['status' => UserCoupons::COUPON_EXPIRED]);

        $coupon->andWhere(['uid' => $uid]);
        $couponList = $coupon->with('coupons')->all();
        if($couponList)
            return sendSuccess('返回成功', $couponList);
        return sendError('返回失败');
    }

}
