<?php

namespace common\models;

use Yii;
use yii\helpers\Html;

/**
 * This is the model class for table "room".
 *
 * @property int $room_id
 * @property int $user_id 用户ID
 * @property string $room_name 房间名
 * @property int $room_type 0 整租 ,1 合租
 * @property int $room_price 房间价格
 * @property string $room_content 房间简要信息
 * @property string $room_detail 房间详细信息
 * @property string $room_images 房间照片
 * @property int $room_city 房间归属市
 * @property int $room_area 房间归属区
 * @property string $room_address 房间地址详细描述
 * @property int $add_time 创建时间
 * @property int $update_time 更新时间
 * @property int $answer_counts 回复次数
 * @property int $answer_users 回答人数
 * @property int $focus_count 关注次数
 * @property int $comment_count 评论人数
 * @property int $is_essence 是否精华,0 否,1是
 * @property int $is_comment 是否推荐,0否,1是
 * @property int $is_over 是否结束，0否，1是
 * @property string $point_lng
 * @property string $point_lat
 *@property int $is_check 是否通过审核 0未通过 1通过
 */
class Room extends \yii\db\ActiveRecord
{

    public static $ROOM_TYPE=[
        "0"=>"合租",
        "1"=>"整租",
    ];
    public static $ROOM_ESSENCE=[
        "0"=>"否",
        "1"=>"是",
    ];
    public static $ROOM_COMMENT=[
        "0"=>"否",
        "1"=>"是",
    ];
    public static $ROOM_OVER=[
        "0"=>"求租中",
        "1"=>"已结帖",
    ];
    public static $ROOM_check=[
        "0"=>"审核中",
        "1"=>"审核通过",
        "2"=>"审核失败"
    ];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'room';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'room_name'], 'required'],
            [['user_id', 'room_type', 'room_price', 'room_city', 'room_area', 'add_time', 'update_time', 'answer_counts', 'answer_users', 'focus_count', 'comment_count', 'is_essence', 'is_comment', 'is_over','is_check'], 'integer'],
            [['room_detail'], 'string'],
            [['room_name'], 'string', 'max' => 50],
            [['room_content', 'room_address', 'point_lng', 'point_lat'], 'string', 'max' => 255],
            [['room_images'],'file','skipOnEmpty' => true,'maxFiles' => 10]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'room_id' => '房间ID',
            'user_id' => '用户ID',
            'room_name' => '房间名',
            'room_type' => '房间类型',
            'room_price' => '房间价格',
            'room_content' => '简要信息',
            'room_detail' => '详细信息',
            'room_images' => '房间照片',
            'room_city' => '房间归属市',
            'room_area' => '房间归属区',
            'room_address' => '房间详细地址',
            'add_time' => '添加时间',
            'update_time' => '更新时间',
            'answer_counts' => '回复次数',
            'answer_users' => '回复人数',
            'focus_count' => '关注人数',
            'comment_count' => '评论人数',
            'is_essence' => '是否精华',
            'is_comment' => '是否推荐',
            'is_over'=>'帖子状态',
            'point_lng' => '经度',
            'point_lat' => '纬度',
            'is_check'=>'审核结果',
        ];
    }

    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert)){
            if($insert){
                $this->add_time=time();
                $this->update_time=time();
            }
            else{
                $this->update_time=time();
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
    public function getCity(){
        return $this->hasOne(City::className(),['city_id'=>'room_city']);
    }
    public function getArea(){
        return $this->hasOne(Area::className(),['area_id'=>'room_area']);
    }
    public static function Delemiteroom($imagestring){
        $imagearay=explode(",",$imagestring);
        $url=[];
        foreach ($imagearay as $image){
            return "/roomshare/uploads/".$image;
        }
    }
}
