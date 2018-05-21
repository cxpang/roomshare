<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/17
 * Time: 22:24
 */

namespace backend\controllers;
use common\services\RedisService;
use yii\web\Controller;
class RedisController extends Controller
{

    public function actionIndex(){
        $redis=new RedisService();
        $keys=$redis->actionGetALLKeys();


        return $this->render('index',[
           'data'=>$keys
        ]);


    }
    public function actionUpdatekey(){
        if(\Yii::$app->request->isPost) {
            $info = \Yii::$app->request->post();
            $key=$info['key'];
            $redis=new RedisService();
            switch ($key){
                case 'roomall':
                    $type=1;
                    break;
                case 'roombeijing':
                    $type=2;
                    break;
                case 'roomshanghai':
                    $type=3;
                    break;
                default:
                    $type=0;
                    break;
            }
            if($redis->actionUpdate($key,$type)){
                return true;
            }
            return false;
        }
    }
    public function actionDeletekey(){
        if(\Yii::$app->request->isPost) {
            $info = \Yii::$app->request->post();
            $key=$info['key'];
            $redis=new RedisService();
            if($redis->actionDelete($key)) {
                return true;
            }
            return false;
        }
    }

}