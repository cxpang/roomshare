<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "rent_forum_comment".
 *
 * @property int $comment_id
 * @property int $user_id
 * @property int $forum_id
 * @property string $comment_text
 * @property int $answer_couns
 * @property int $created_at
 * @property int $updated_at
 */
class RentForumComment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rent_forum_comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'forum_id', 'comment_text'], 'required'],
            [['user_id', 'forum_id', 'answer_couns', 'created_at', 'updated_at'], 'integer'],
            [['comment_text'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'comment_id' => 'Comment ID',
            'user_id' => 'User ID',
            'forum_id' => 'Forum ID',
            'comment_text' => 'Comment Text',
            'answer_couns' => 'Answer Couns',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert)){
            if($insert){
                $this->created_at=time();
                $this->updated_at=time();
            }
            else{
                $this->updated_at=time();
            }
            return true;
        }
        else{
            return false;
        }
    }
}
