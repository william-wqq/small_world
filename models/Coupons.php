<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sw_coupon".
 *
 * @property int $cid
 * @property string $coupon_code
 * @property int $coupon_type
 * @property string $coupon_name
 * @property string $platform_code
 * @property string $created_time
 * @property string $updated_time
 * @property string $created_by
 * @property string $start_time
 * @property string $end_time
 * @property string $coupon_value 折扣券则为折扣率，满减则为面值
 * @property string $option
 * @property string $remark
 * @property int $number 数量
 * @property int $can_share 能否分享
 * @property int $month
 */
class Coupons extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'coupons';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['coupon_type', 'number', 'can_share', 'month'], 'integer'],
            [['created_time', 'updated_time', 'start_time', 'end_time'], 'safe'],
            [['coupon_value'], 'number'],
            [['coupon_code', 'coupon_name', 'platform_code', 'created_by', 'option', 'remark'], 'string', 'max' => 255],
            [['coupon_code'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cid' => 'Cid',
            'coupon_code' => 'Coupon Code',
            'coupon_type' => 'Coupon Type',
            'coupon_name' => 'Coupon Name',
            'platform_code' => 'Platform Code',
            'created_time' => 'Created Time',
            'updated_time' => 'Updated Time',
            'created_by' => 'Created By',
            'start_time' => 'Start Time',
            'end_time' => 'End Time',
            'coupon_value' => 'Coupon Value',
            'option' => 'Option',
            'remark' => 'Remark',
            'number' => 'Number',
            'can_share' => 'Can Share',
            'month' => 'Month',
        ];
    }
}
