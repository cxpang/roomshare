<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "rent_forum_comment_res".
 *
 * @property int $res_id
 * @property int $user_id
 * @property int $comment_id
 * @property string $ans_text
 * @property int $at_user_id
 * @property int $created_at
 * @property int $updated_at
 * @property string $username 用户名
 * @property string $at_username 对用户名
 * @property string $user_picture 用户头像
 * @property string $at_user_picture 对用户头像
 */
class RentForumCommentRes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rent_forum_comment_res';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'comment_id', 'ans_text', 'at_user_id'], 'required'],
            [['user_id', 'comment_id', 'at_user_id', 'created_at', 'updated_at'], 'integer'],
            [['ans_text', 'username', 'at_username', 'user_picture', 'at_user_picture'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'res_id' => 'Res ID',
            'user_id' => 'User ID',
            'comment_id' => 'Comment ID',
            'ans_text' => 'Ans Text',
            'at_user_id' => 'At User ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'username' => 'Username',
            'at_username' => 'At Username',
            'user_picture' => 'User Picture',
            'at_user_picture' => 'At User Picture',
        ];
    }
}
