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
use common\models\User;
use common\models\UserInfo;
use common\models\Chatpoint;
class ChatController extends Controller
{
    public function actionIndex(){

        $info=Yii::$app->request->get();
        $to_user_id=$info['touser'];

        $from_user_id=Yii::$app->user->getId();

        $result=User::find()->from('user as  a')->leftJoin('user_info as b','a.id=b.user_id')
            ->select('a.id,a.username,b.user_picture')->where(['a.id'=>$to_user_id])->asArray()->one();

        if(Chatpoint::find()->where(['fromid'=>$from_user_id,'toid'=>$to_user_id])->one()){
            $chatModel=Chatpoint::find()->where(['fromid'=>$from_user_id,'toid'=>$to_user_id])->one();
        }
        else{
            $chatModel=new Chatpoint();
        }
        $chatModel->fromid=$from_user_id;

        $chatModel->toid=$to_user_id;
        $chatModel->is_read='0';
        $chatModel->save();



        return $this->render('index',[
            'to_user'=>$result
        ]);
    }
    public function actionCenter(){
        $user_id=Yii::$app->user->getId();
        $to_chats=Chatpoint::find()->where(['toid'=>$user_id])->asArray()->all();

        $from_chats=Chatpoint::find()->where(['fromid'=>$user_id])->asArray()->all();


        return $this->render('center',[
            'to_chats'=>$to_chats,
            'from_chats'=>$from_chats,
        ]);

    }

}