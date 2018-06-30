<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_coupons".
 *
 * @property int $id
 * @property int $cid 优惠券ID
 * @property int $uid 用户ID
 * @property int $status 优惠券状态：1 待使用 2 已使用 3 已过期
 * @property string $use_time 使用时间
 * @property string $platform_code
 * @property string $receive_time 领取时间
 */
class UserCoupons extends \yii\db\ActiveRecord
{

    //优惠券 1 待使用 2 已使用 3 已过期
    const COUPON_WAITE = 1;
    const COUPON_USED = 2;
    const COUPON_EXPIRED = 3;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_coupons';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cid', 'uid'], 'required'],
            [['cid', 'uid', 'status'], 'integer'],
            [['use_time', 'receive_time'], 'safe'],
            [['platform_code'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cid' => 'Cid',
            'uid' => 'Uid',
            'status' => 'Status',
            'use_time' => 'Use Time',
            'platform_code' => 'Platform Code',
            'receive_time' => 'Receive Time',
        ];
    }

    /*
    * 优惠券状态
    */
    public static function couponStatus() {
        return [
            self::COUPON_WAITE => '待使用',
            self::COUPON_USED => '已使用',
            self::COUPON_EXPIRED => '已过期'
        ];
    }

    public function getCoupons()
    {
        return $this->hasOne(Coupons::className(), ['cid' => 'cid']);
    }
}
