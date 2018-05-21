<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "room_comments".
 *
 * @property int $comments_id 评论ID
 * @property int $room_id 房间ID
 * @property string $comments_content 评论内容
 * @property int $created_at 评论时间
 * @property int $user_id 评论用户ID
 * @property int $answer_count 评论回复次数
 * @property int $force_fold 是否强制折叠,0是 ,1否
 */
class RoomComments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'room_comments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['room_id', 'comments_content', 'user_id', 'answer_count'], 'required'],
            [['room_id', 'created_at', 'user_id', 'answer_count'], 'integer'],
            [['comments_content'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'comments_id' => '评论ID',
            'room_id' => '房间ID',
            'comments_content' => '评论内容',
            'created_at' => '评论时间',
            'user_id' => '评论用户ID',
            'answer_count' => '评论回复次数',
            'force_fold' => '是否强制折叠,0是 ,1否',
        ];
    }

}
