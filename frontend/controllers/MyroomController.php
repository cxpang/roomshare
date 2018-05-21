<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/13/013
 * Time: 23:37
 */

namespace frontend\controllers;

namespace frontend\controllers;
use yii\web\NotFoundHttpException;
use yii\web\Controller;
use common\models\User;
use common\models\UserInfo;
use yii\web\UploadedFile;
use common\models\Room;
use common\services\RoomService;
use common\models\RoomCheck;
use common\helpers\CityArea;
use Yii;
class MyroomController extends Controller
{
    public function actionIndex(){

        $user_id=Yii::$app->user->identity->getId();

        $rooms=Room::find()->where(['user_id'=>$user_id])
            ->orderBy('update_time desc')->asArray()->all();

        return $this->render('index',[
            'myroom'=>$rooms
        ]);
    }
    public function actionShowcheck(){
        $info=Yii::$app->request->post();
        $room_id=$info['room_id'];
        $check_info=RoomCheck::find()
            ->select('check_info')
            ->where(['room_id'=>$room_id])->asArray()->one();
        return $check_info['check_info'];
    }
    public function actionOverroom(){
        $info=Yii::$app->request->post();
        $room_id=$info['room_id'];
        $room=Room::find()->where(['room_id'=>$room_id])->one();
        $room->is_over=1;
        if($room->save()){
            return true;
        }
    }
    public function actionDeleteroom(){
        $info=Yii::$app->request->post();
        $room_id=$info['room_id'];
        $serivce=new RoomService();
        if($serivce->Deleteroom($room_id)){
            return true;
        }
    }
    public function actionCreate(){
        $model = new Room();


        if ($model->load(Yii::$app->request->post())) {
            $model->room_images = UploadedFile::getInstances($model, 'room_images');
            $allimagepath = "";
            foreach ($model->room_images as $value) {
                $path = '../../uploads/';
                $imageName = time() . rand(100, 900) . 'test' . '.' . $value->extension;
                $value->saveAs($path . $imageName);
                $allimagepath .= $imageName . ",";
            }
            $model->room_images = $allimagepath;
            if ($model->save()) {
                $user_id = Yii::$app->user->getId();
                $userinfo = UserInfo::find()->where(['user_id' => $user_id])->one();
                $expe = $userinfo->user_expe;
                $userinfo->user_expe = $expe + 5;
                $userinfo->save();
                Yii::$app->session->setFlash('success', '发布成功,请耐心等待管理员审核');
                return $this->redirect([
                    'index'
                ]);
            }
        }





        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionOption($room_city)
    {
        $_data = CityArea::GetArea($room_city);
        $_tmp = '';
        foreach ($_data as $key => $val) {
            $_tmp .= "<option value='" . $key . "'>{$val}</option>";
        }
        echo $_tmp;
    }
}