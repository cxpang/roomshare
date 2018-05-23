<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "chatpoint".
 *
 * @property int $id
 * @property int $fromid
 * @property string $message
 * @property int $toid
 * @property int $created_at
 * @property int $updated_at
 * @property int $is_read 是否已读
 */
class Chatpoint extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'chatpoint';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fromid', 'toid'], 'required'],
            [['fromid', 'toid', 'created_at', 'updated_at', 'is_read'], 'integer'],
            [['message'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fromid' => 'Fromid',
            'message' => 'Message',
            'toid' => 'Toid',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'is_read' => 'Is Read',
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
    public function SubString($string){
        $len=strlen($string);
        if($len<6){
            return $string;
        }
        else{
            return mb_substr($string,0,6,'utf-8')."**";
        }
    }
}
