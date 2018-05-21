<?php

namespace common\models;
use common\models\User;
use Yii;

/**
 * This is the model class for table "room_wish".
 *
 * @property int $id
 * @property int $user_id
 * @property int $room_id
 * @property int $room_user_id
 * @property int $create_at
 */
class RoomWish extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'room_wish';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'room_id', 'room_user_id'], 'required'],
            [['user_id', 'room_id', 'room_user_id', 'create_at'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'room_id' => 'Room ID',
            'room_user_id' => 'Room User ID',
            'create_at' => 'Create At',
        ];
    }

    public function GetWishPeople($room_id){
        $people_array=self::find()->from('room_wish as a')
            ->leftJoin('user as b','a.user_id=b.id')
            ->select('b.username')
            ->where(['room_id'=>$room_id])->asArray()->all();
        $name_array=[];
        foreach ($people_array as $value){
             $name_array[]=$value['username'];
        }
        $people_string=implode(",",$name_array);
        return $people_string;
    }
}
