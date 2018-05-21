<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/21/021
 * Time: 22:26
 */

namespace frontend\controllers;

use yii;
use yii\web\Controller;
class ChatController extends Controller
{
    public function actionIndex(){
        return $this->render('index');
    }

}