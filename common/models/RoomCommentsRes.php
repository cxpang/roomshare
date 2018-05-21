<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "room_comments_res".
 *
 * @property int $id
 * @property int $comments_id 房间评论ID
 * @property int $user_id 回复的用户ID
 * @property int $at_user_id 对谁回复的用户ID
 * @property string $message 回复内容
 * @property int $created_at 回复时间
 * @property string $username 用户名
 * @property string $at_username 对用户名
 * @property string $user_picture 用户头像
 * @property string $at_user_picture 对用户头像
 */
class RoomCommentsRes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'room_comments_res';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['comments_id', 'user_id', 'at_user_id'], 'required'],
            [['comments_id', 'user_id', 'at_user_id', 'created_at'], 'integer'],
            [['message'], 'string'],
            [['username', 'at_username', 'user_picture', 'at_user_picture'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'comments_id' => '房间评论ID',
            'user_id' => '回复的用户ID',
            'at_user_id' => '对谁回复的用户ID',
            'message' => '回复内容',
            'created_at' => '回复时间',
            'username' => 'Username',
            'at_username' => 'At Username',
            'user_picture' => 'User Picture',
            'at_user_picture' => 'At User Picture',
        ];
    }
}
