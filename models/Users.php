<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sw_users".
 *
 * @property int $uid 用户id
 * @property string $username 姓名
 * @property string $nickname 微信名
 * @property string $wx_number 微信号
 * @property string $phone 手机号
 * @property string $openid openid
 * @property string $avatar_url 微信头像
 * @property string $add_time 添加时间
 * @property string $update_time 更新时间
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nickname', 'openid', 'avatar_url'], 'required'],
            [['add_time', 'update_time'], 'safe'],
            [['username', 'wx_number', 'openid', 'avatar_url'], 'string', 'max' => 255],
            [['nickname'], 'string', 'max' => 50],
            [['phone'], 'string', 'max' => 30],
            [['openid'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'uid' => 'Uid',
            'username' => 'Username',
            'nickname' => 'Nickname',
            'wx_number' => 'Wx Number',
            'phone' => 'Phone',
            'openid' => 'Openid',
            'avatar_url' => 'Avatar Url',
            'add_time' => 'Add Time',
            'update_time' => 'Update Time',
        ];
    }
}
