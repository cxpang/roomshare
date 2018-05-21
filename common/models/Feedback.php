<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "feedback".
 *
 * @property int $id
 * @property int $user_id
 * @property string $feed_content
 * @property int $created_at
 * @property int $updated_at
 */
class Feedback extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'feedback';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'feed_content'], 'required'],
            [['user_id', 'created_at', 'updated_at'], 'integer'],
            [['feed_content'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '流水ID',
            'user_id' => '用户ID',
            'feed_content' => '反馈内容',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
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
    public function getUser(){
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
