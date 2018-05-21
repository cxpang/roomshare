<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "room_check".
 *
 * @property int $room_id 房间审核ID
 * @property int $is_check 审核结果 1通过 2不通过
 * @property string $check_info 不通过信息
 */
class RoomCheck extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'room_check';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['room_id', 'is_check', 'check_info'], 'required'],
            [['room_id', 'is_check'], 'integer'],
            [['check_info'], 'string', 'max' => 255],
            [['room_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'room_id' => 'Room ID',
            'is_check' => '审核结果',
            'check_info' => '审核信息',
        ];
    }
}
