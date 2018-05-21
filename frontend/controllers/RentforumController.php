<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/10/010
 * Time: 21:55
 */

namespace frontend\controllers;
use yii\web\Controller;
use common\models\User;
use common\models\UserInfo;
use common\models\RentForum;
use common\models\RentForumComment;
use common\models\RentForumCommentRes;
use common\services\ForumService;
use Yii;
class RentforumController  extends Controller
{

    public function actionIndex(){
        $data=RentForum::find()->from('rent_forum as a')->leftJoin('user as b','a.user_id=b.id')
            ->leftJoin('user_info as c','b.id=c.user_id')
            ->select('a.*,b.username,c.user_picture')
            ->orderBy('a.updated_at desc')
            ->where(['a.forum_check'=>1])
            ->asArray()->all();
        return $this->render('index',[
            'data'=>$data,
        ]);
    }
    public function actionDetail($forum_id){
        $data=RentForum::find()->from('rent_forum as a')->leftJoin('user as b','a.user_id=b.id')
            ->leftJoin('user_info as c','b.id=c.user_id')
            ->select('a.*,b.username,c.*')
            ->orderBy('a.updated_at desc')
            ->where(['a.forum_id'=>$forum_id])
            ->asArray()->one();

        $comments=RentForumComment::find()->where(['forum_id'=>$forum_id])->asArray()->all();

        $data['comments']=$comments;
        return $this->render('detail',[
            'data'=>$data,
        ]);
    }
    public function actionCommentres(){
        $info=\Yii::$app->request->post();
        $comment_id=$info['comments_id'];
        $result=RentForumCommentRes::find()->where(['comment_id'=>$comment_id])->asArray()->all();
        return json_encode($result);
    }
    public function actionAddcomment(){
        $info=Yii::$app->request->post();
        $forum_id=$info['forum_id'];
        $comment=$info['forumcontent'];
        $userid=Yii::$app->user->identity->getId();
        $service=new ForumService();
        if($service->Addforumcomment($userid,$forum_id,$comment,0)){
            Yii::$app->session->setFlash('success', '评论成功');
            $this->redirect(['rentforum/detail','forum_id'=>$forum_id]);
        }
        else{
            Yii::$app->session->setFlash('danger', '未知的错误发生了，请重试');
            $this->redirect(['rentforum/detail','$forum_id'=>$forum_id]);
        }

    }
    public function actionAddcommres(){
        $info=Yii::$app->request->post();
        $at_user_id=$info['at_user_id'];
        $comments_id=$info['comment_id'];

        $res_comments_con=$info['res_comments_con'];
        $user_id=Yii::$app->user->identity->getId();
        $forum_id=$info['forum_id'];
        $service=new ForumService();

        if($service->Addforumcomres($comments_id,$user_id,$at_user_id,$res_comments_con,$forum_id)){
            Yii::$app->session->setFlash('success', '回复成功');
            $this->redirect(['rentforum/detail','forum_id'=>$forum_id]);
        }
        else{
            Yii::$app->session->setFlash('danger', '未知的错误发生了，请重试');
            $this->redirect(['rentforum/detail','forum_id'=>$forum_id]);
        }
    }
    public function actionAddforum(){
        $info=Yii::$app->request->post();
        $user_id=Yii::$app->user->getId();
        $forum_name=$info['forum_name'];
        $forum_content=$info['forum_content'];
        $service=new ForumService();
        if($service->addforum($user_id,$forum_name,$forum_content)){
            Yii::$app->session->setFlash('success', '发布成功，我们将尽快为您审核');
            $this->redirect(['rentforum/index']);
        }
        else{
            Yii::$app->session->setFlash('danger', '未知的错误发生了，请重试');
            $this->redirect(['rentforum/index']);
        }
    }


}