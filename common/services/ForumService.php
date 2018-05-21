<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/12/012
 * Time: 14:23
 */

namespace common\services;
use common\models\User;
use common\models\UserInfo;
use yii\web\NotFoundHttpException;
use Yii;
use common\models\RentForum;
use common\models\RentForumComment;
use common\models\RentForumCommentRes;
class ForumService
{
    public function Addforumcomment($user_id,$forum_id,$comment_text,$answer_couns=0){
        $db=\Yii::$app->db;
        $translation=$db->beginTransaction();
        try{
            $forum=$this->findforum($forum_id);
            $pelple_count=$forum->forum_people_counts;
            $forum->forum_people_counts=$pelple_count+1;
            $forum->save();
            $forumcom=new RentForumComment();
            $forumcom->user_id=$user_id;
            $forumcom->forum_id=$forum_id;
            $forumcom->comment_text=$comment_text;
            $forumcom->answer_couns=$answer_couns;
            $forumcom->save();
            $translation->commit();
            return true;
        }
        catch (\Exception $e ){
            $translation->rollBack();
            return $e->getMessage();
        }


    }
    public function Addforumcomres($comments_id,$user_id,$at_user_id,$res_comments_con,$forum_id){

        $db=\Yii::$app->db;
        $translation=$db->beginTransaction();
        try{
            $username = User::GetUserName($user_id);
            $at_username = User::GetUserName($at_user_id);
            $user_picture = UserInfo::GetUserImage($user_id);
            $at_user_picture = UserInfo::GetUserImage($at_user_id);
            $forumcomres=new RentForumCommentRes();
            $forumcomres->user_id=$user_id;
            $forumcomres->comment_id=$comments_id;
            $forumcomres->ans_text=$res_comments_con;
            $forumcomres->at_user_id=$at_user_id;
            $forumcomres->username=$username;
            $forumcomres->at_username=$at_username;
            $forumcomres->user_picture=$user_picture;
            $forumcomres->at_user_picture=$at_user_picture;
            $forumcomres->created_at=time();
            $forumcomres->updated_at=time();
            $forumcomres->save();
            $comsmodel=$this->findforumcom($comments_id);
            $comsmodelcount=$comsmodel->answer_couns;
            $comsmodel->answer_couns=$comsmodelcount+1;
            $comsmodel->save();
            $translation->commit();
            return true;
        }
        catch (\Exception $e ){
            $translation->rollBack();
            return $e->getMessage();
        }

    }
    protected function findforum($forum_id){
        if (($model = RentForum::find()->where(['forum_id'=>$forum_id])->one()) !== null) {
            return $model;
        } else {
            return false;
        }
    }
    protected function findforumcom($comment_id){
        if (($model = RentForumComment::find()->where(['comment_id'=>$comment_id])->one()) !== null) {
            return $model;
        } else {
            return false;
        }
    }
    protected function finduserinfo($user_id){
        if(($model=UserInfo::find()->where(['user_id'=>$user_id])->one())!==null){
            return $model;
        }else {
            return false;
        }
    }
    public function addforum($user_id,$forum_name,$forum_content){
        $db=\Yii::$app->db;
        $translation=$db->beginTransaction();
        try{
            $userinfo=$this->finduserinfo($user_id);
            $exep=$userinfo->user_expe;
            $userinfo->user_expe=$exep+2;
            $userinfo->save();
            $forum=new RentForum();
            $forum->forum_name=$forum_name;
            $forum->user_id=$user_id;
            $forum->forum_content=$forum_content;
            $forum->save();
            $translation->commit();
            return true;
        }
        catch (\Exception $e ){
            $translation->rollBack();
            return $e->getMessage();
        }

    }

    public function DeleteForum($forum_id){
        $db=\Yii::$app->db;
        $translation=$db->beginTransaction();
        try{
            RentForumComment::deleteAll(['forum_id'=>$forum_id]);
            RentForum::deleteAll(['forum_id'=>$forum_id]);
            $translation->commit();
            return true;
        }
        catch (\Exception $e ){

            $translation->rollBack();
            return $e->getMessage();
        }
    }

}