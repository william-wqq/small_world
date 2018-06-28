<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sw_user".
 *
 * @property int $uid 用户id
 * @property string $nickname 微信名
 * @property int $openid openid
 * @property string $avatar_url 微信头像
 * @property string $add_time 添加时间
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sw_users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nickname', 'openid', 'avatar_url'], 'required'],
            [['openid'], 'integer'],
            [['add_time'], 'safe'],
            [['nickname'], 'string', 'max' => 50],
            [['avatar_url'], 'string', 'max' => 255],
            [['openid'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nickname' => 'Nickname',
            'openid' => 'Openid',
            'avatar_url' => 'Avatar Url',
            'add_time' => 'Add Time',
        ];
    }
}
