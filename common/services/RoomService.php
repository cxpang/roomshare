<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/14/014
 * Time: 8:44
 */

namespace common\services;
use common\models\Room;
use common\models\RoomComments;

class RoomService
{
    public function Deleteroom($room_id){
        $db=\Yii::$app->db;
        $translation=$db->beginTransaction();
        try{
            RoomComments::deleteAll(['room_id'=>$room_id]);
            Room::deleteAll(['room_id'=>$room_id]);
            $translation->commit();
            return true;
        }
        catch (\Exception $e ){

            $translation->rollBack();
            return $e->getMessage();
        }
    }

}