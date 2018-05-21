<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/13/013
 * Time: 23:48
 */

namespace frontend\controllers;

namespace frontend\controllers;
use yii\web\NotFoundHttpException;
use yii\web\Controller;
use common\models\User;
use common\models\RentForum;
use common\models\RentForumComment;
use common\services\ForumService;
use common\models\UserInfo;

class MyforumController  extends Controller
{

    public function actionIndex(){


        $user_id=\Yii::$app->user->getId();
        $forumlist=RentForum::find()->from('rent_forum as  a')
            ->leftJoin('rent_forum_comment as b','a.forum_id=b.forum_id')
            ->leftJoin('user_info as c','b.user_id=c.user_id')
            ->leftJoin('user as d','c.user_id=d.id')
            ->select('a.forum_name,b.*,c.user_picture,d.username')
            ->where(['a.user_id'=>$user_id])
            ->orderBy('b.created_at desc')
            ->asArray()->all();


        return $this->render('index',
            [
                'datas'=>$forumlist,
            ]);
    }
    public function actionDeleteforum(){
        $info=\Yii::$app->request->post();
        $forum_id=$info['forum_id'];
        $serivce=new ForumService();
        if($serivce->DeleteForum($forum_id)){
            return true;
        }
    }
}