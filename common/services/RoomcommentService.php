<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/4/004
 * Time: 16:27
 */

namespace common\services;
use common\models\Room;
use common\models\RoomComments;
use common\models\RoomCommentsRes;
use common\models\User;
use common\models\UserInfo;
use yii\web\NotFoundHttpException;
use Yii;
class RoomcommentService
{

    public function Addroomcomment($roomid,$user_id,$comment,$anscount=0){
        $db=\Yii::$app->db;
        $translation=$db->beginTransaction();
        try {
            $room_model = $this->findRoom($roomid);
            $comment_count = $room_model->comment_count;
            $room_model->comment_count = $comment_count + 1;
            $room_model->save();
            $roomcom_model = new RoomComments();
            $roomcom_model->room_id = $roomid;
            $roomcom_model->user_id = $user_id;
            $roomcom_model->comments_content = $comment;
            $roomcom_model->created_at = time();
            $roomcom_model->answer_count = $anscount;
            $roomcom_model->save();
            $translation->commit();
            return true;
        }
        catch (\Exception $e ){
            $translation->rollBack();
            return $e->getMessage();
        }

    }
    protected function findRoom($roomid){
        if (($model = Room::find()->where(['room_id'=>$roomid])->one()) !== null) {
            return $model;
        } else {
            return false;
        }
    }
    protected function findRoomCom($comments_id){
        if (($model = RoomComments::find()->where(['comments_id'=>$comments_id])->one()) !== null) {
            return $model;
        } else {
            return false;
        }
    }
    public function Addroomres($comments_id,$user_id,$at_user_id,$res_comments_con){
        $db=\Yii::$app->db;
        $translation=$db->beginTransaction();
        try {
            $username = User::GetUserName($user_id);
            $at_username = User::GetUserName($at_user_id);
            $user_picture = UserInfo::GetUserImage($user_id);
            $at_user_picture = UserInfo::GetUserImage($at_user_id);
            $resModel=new RoomCommentsRes();
            $resModel->comments_id=$comments_id;
            $resModel->user_id=$user_id;
            $resModel->at_user_id=$at_user_id;
            $resModel->message=$res_comments_con;
            $resModel->created_at=time();
            $resModel->username=$username;
            $resModel->at_username=$at_username;
            $resModel->user_picture=$user_picture;
            $resModel->at_user_picture=$at_user_picture;
            $resModel->save();
            $comModel=$this->findRoomCom($comments_id);
            $answers=$comModel->answer_count;
            $comModel->answer_count=$answers+1;
            $comModel->save();
            $translation->commit();
            return true;
        }
        catch (\Exception $e ){
            $translation->rollBack();
            return $e->getMessage();
        }
    }
}