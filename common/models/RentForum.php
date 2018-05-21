<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "rent_forum".
 *
 * @property int $forum_id
 * @property string $forum_name
 * @property int $user_id
 * @property string $forum_content
 * @property int $forum_people_counts
 * @property int $forum_star
 * @property int $forum_check
 * @property string $forum_check_message
 * @property int $created_at
 * @property int $updated_at
 */
class RentForum extends \yii\db\ActiveRecord
{
    public static $IS_STAR=[
       '0'=>'非标星',
        '1'=>'标星',
    ];
    public static $IS_CHECK=[
        '0'=>'未审核',
        '1'=>'审核通过',
        '2'=>'审核失败'
    ];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rent_forum';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['forum_name', 'user_id', 'forum_content'], 'required'],
            [['user_id', 'forum_people_counts', 'forum_star', 'forum_check', 'created_at', 'updated_at'], 'integer'],
            [['forum_content'], 'string'],
            [['forum_name', 'forum_check_message'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'forum_id' => '论坛ID',
            'forum_name' => '论坛名',
            'user_id' => '发布人ID',
            'forum_content' => '论坛内容',
            'forum_people_counts' => '评论人数',
            'forum_star' => '是否标星',
            'forum_check' => '是否审核',
            'forum_check_message' => '审核信息',
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
}
