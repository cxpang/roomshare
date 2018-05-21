<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "rent_story".
 *
 * @property int $id
 * @property int $user_id
 * @property int $story_name
 * @property string $story_text
 * @property int $support_counts
 * @property int $love_counts
 * @property int $create_at
 * @property int $is_star 是否标星故事
 */
class RentStory extends \yii\db\ActiveRecord
{
    public static $IS_STAR=[
        '0'=>'未标星',
        '1'=>'标星',
    ];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rent_story';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'story_name', 'story_text'], 'required'],
            [['user_id', 'support_counts', 'love_counts', 'create_at', 'is_star'], 'integer'],
            [['story_text'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键ID',
            'user_id' => '用户ID',
            'story_name' => '故事主题',
            'story_text' => '故事内容',
            'support_counts' => '支持人数',
            'love_counts' => '点赞人数',
            'create_at' => '创建时间',
            'is_star' => '是否星标',
        ];
    }
    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert)){
            $this->create_at=time();
            return true;
        }
        else{
            return false;
        }
    }
    public function getUser(){
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    public static function getstr($string){
        $len=strlen($string);
        if($len<1000){
            return $len;
        }
        else{
            return substr($string,0,1100).'##########';
        }
    }

}
