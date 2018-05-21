<?php

namespace backend\controllers;

use Yii;
use common\models\Room;
use common\models\RoomSearch;
use common\models\RoomCheck;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\helpers\CityArea;
use yii\web\UploadedFile;

/**
 * RoomController implements the CRUD actions for Room model.
 */
class RoomController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Room models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RoomSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
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


    /**
     * Displays a single Room model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Room model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        $model = new Room();

        if ($model->load(Yii::$app->request->post())) {
            $model->room_images = UploadedFile::getInstances($model, 'room_images');
            $allimagepath="";
            foreach ($model->room_images as $value){
                $path = '../../uploads/';
                $imageName=time() . rand(100, 900).'test' . '.'. $value->extension;
                $value->saveAs($path.$imageName);
                $allimagepath .=$imageName.",";
            }
            $model->room_images=$allimagepath;
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->room_id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
    public function upload($model){
        $images=UploadedFile::getInstance($model, 'room_images');
        var_dump($model);
        exit(0);
        $imagepath=0;
        foreach ($images as $image) {
            $ext = $image->getExtension();
            $imageName = time() . rand(100, 900).'test' . '.' . $ext;
            $path = '../../uploads/';
            $image->saveAs($path . $imageName);
            $imagepath .= '/roomshare/uploads/' . $imageName.",";
        }
        $model->room_images=$imagepath;
        return $model;
    }

    /**
     * Updates an existing Room model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->room_images = UploadedFile::getInstances($model, 'room_images');
            $allimagepath="";
            foreach ($model->room_images as $value){
                $path = '../../uploads/';
                $imageName=time() . rand(100, 900).'test' . '.'. $value->extension;
                $value->saveAs($path.$imageName);
                $allimagepath .=$imageName.",";
            }
            $model->room_images=$allimagepath;
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->room_id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Room model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Room model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Room the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Room::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
    protected function findroomcheck($id)
    {
        if (($model = RoomCheck::findOne(['room_id'=>$id])) !== null) {
            return $model;
        }
        return false;
    }
    public function actionCheckroom($id){
        $model=$this->findModel($id);
        if($this->findroomcheck($id)){
            $roomcheck=$this->findroomcheck($id);
        }
        else{
            $roomcheck=new RoomCheck();
        }

        return $this->render('checkroom',[
            'model'=>$model,
            'roomcheck'=>$roomcheck,
        ]);
    }
    public function actionCheckresult(){
        $info=Yii::$app->request->post();
        $room_id=$info['Room']['room_id'];
        $roomcheck=$info['RoomCheck'];
        $room=$this->findModel($room_id);
        $room->is_check=$roomcheck['is_check'];
        $room->save();
        $roomcheckmodel=$this->findroomcheck($room_id);
        if(!$roomcheckmodel){
            $roomcheckmodel=new RoomCheck();
        }
        $roomcheckmodel->room_id=$room_id;
        $roomcheckmodel->is_check=$roomcheck['is_check'];
        $roomcheckmodel->check_info=$roomcheck['check_info'];
        if($roomcheckmodel->save()){
             return $this->render('view',[
                 'model'=>$room
             ]);
        }
        else{
            var_dump($roomcheck->getErrors()) ;
            exit(0);
        }


    }
}
