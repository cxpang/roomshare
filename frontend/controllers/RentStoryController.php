<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/6/006
 * Time: 15:16
 */

namespace frontend\controllers;
use yii\web\Controller;
use common\models\RentStory;

class RentStoryController extends Controller
{

    public function actionIndex(){
         $model=new RentStory();
         $data=$model->find()->from('rent_story as a')
             ->leftJoin('user as b','a.user_id=b.id')
             ->select('a.*,b.username')->asArray()->all();
         return $this->render('index',[
             'data'=>$data
         ]);
    }
    public function actionDetail($story_id){
         $model=RentStory::find()->from('rent_story as a')
             ->leftJoin('user as b','a.user_id=b.id')
             ->leftJoin('user_info as c','a.user_id=c.user_id')
             ->select('a.*,b.username,c.*')
             ->where(['a.id'=>$story_id])->asArray()->one();
         $lastdata=[];
         $nextdata=[];
        $lastdata=RentStory::find()->where(['id'=>$story_id-1])->asArray()->one();

        $nextdata=RentStory::find()->where(['id'=>$story_id+1])->asArray()->one();

         return $this->render('detail',[
             'data'=>$model,
             'last'=>$lastdata,
             'next'=>$nextdata
         ]);
    }


}