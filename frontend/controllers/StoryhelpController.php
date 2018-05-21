<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/6/006
 * Time: 21:56
 */

namespace frontend\controllers;
use yii\web\Controller;
use common\models\RentStory;

class StoryhelpController extends Controller
{

    public function actionAddsupport(){
        $info = \Yii::$app->request->post();
        $story_id = $info['story_id'];
        $model = RentStory::find()->where(['id' => $story_id])->one();
        $support_counts = $model->support_counts;
        $model->support_counts = $support_counts + 1;
        if ($model->save()) {
            return true;
        }
        return false;
    }
    public function actionAddlove()
    {
        if (\Yii::$app->request->isPost) {
            $info = \Yii::$app->request->post();
            $story_id = $info['story_id'];
            $model = RentStory::find()->where(['id' => $story_id])->one();
            $love_counts = $model->love_counts;
            $model->love_counts = $love_counts + 1;
            if ($model->save()) {
                return true;
            }
            return false;
        }
    }
}