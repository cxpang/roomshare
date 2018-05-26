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
            ->select('a.id,a.username,b.user_picture')->where(['a.id'=>$to_user_id])
            ->asArray()->one();

        if(Chatpoint::find()->where(['fromid'=>$from_user_id,'toid'=>$to_user_id])->one()){
            $chatModel=Chatpoint::find()->where(['fromid'=>$from_user_id,'toid'=>$to_user_id])->one();
        }
        else{
            $chatModel=new Chatpoint();
        }
        $result['message']=$chatModel->message;
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
    public function actionChatcentersave(){
        if(Yii::$app->request->isPost){
            $info=Yii::$app->request->post();
            $chat_id=$info['to_chat_id'];
            $message=$info['message'];
            $model=Chatpoint::find()->where(['id'=>$chat_id])->one();
            $model->message=$message;
            $model->save();
            return true;
        }
    }
    public function actionChatindexsave(){
        if(Yii::$app->request->isPost){
            $info=Yii::$app->request->post();
            $toid=$info['toid'];
            $message=$info['message'];
            $fromid=Yii::$app->user->getId();

            if(Chatpoint::find()->where(['fromid'=>$fromid,'toid'=>$toid])->one()){

                $model=Chatpoint::find()->where(['fromid'=>$fromid,'toid'=>$toid])->one();
            }
            else{
                $model=new Chatpoint();
            }
            $model->fromid=$fromid;
            $model->toid=$toid;
            $model->message=$message;
            $model->save();
            return true;

        }
    }

}