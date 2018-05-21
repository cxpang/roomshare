<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/2
 * Time: 17:22
 */

namespace frontend\controllers;
use yii\web\NotFoundHttpException;
use common\models\UploadForm;
use yii\web\Controller;
use common\models\User;
use common\models\UserInfo;
use yii\web\UploadedFile;
class PersonController extends Controller
{
    public function actionIndex()
    {
        $currentid=\Yii::$app->user->getId();
        $persondata=User::find()->from('user as a')->leftJoin('user_info as b','a.id=b.user_id')
            ->select('a.*,b.*')
            ->where(['a.id'=>$currentid])->asArray()->one();
        return $this->render('index',[
            'persondata'=>$persondata
        ]);
    }
    public function actionUploadimage(){
        if (\Yii::$app->request->isAjax){
//            $id=\Yii::$app->request->post('id');根据id获取用户model数据
//            $model = $this->findModel($id);
//            var_dump($model);
              $userimage=$_FILES;
              $handleresult=self::handleupload($userimage);
              $result=array("msg"=>$handleresult);
              return json_encode($result);

        }
    }
    public function handleupload($userimage){
        $type=substr($userimage['file']['name'], strrpos($userimage['file']['name'], '.'));
        $temp=$userimage['file']['tmp_name'];
        $imageName=time().rand(100,900).'userphotos'.$type;
        $path='../../uploads/'.$imageName;
        move_uploaded_file($temp, $path);
        return '/roomshare/uploads/'.$imageName;
    }
    protected function findModel($id)
    {
        if (($model = UserInfo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('用户不存在.');
        }
    }
    public function actionChangestaticinfo(){
        if(\Yii::$app->request->isPost){
            $userinfo=\Yii::$app->request->post();
            $id=$userinfo['id'];
            $model=$this->findModel($id);
            $model->user_picture=$userinfo['image'];
            $model->user_sex=$userinfo['sex'];
            $model->user_address=$userinfo['address'];
            $model->user_university=$userinfo['univesrsity'];
            $model->save();
            return true;

        }
    }
    public function actionCheckoldpwd(){
        if(\Yii::$app->request->isPost){
            $info=\Yii::$app->request->post();
            $id=$info['id'];
            $oldpwd=$info['oldpwd'];
            $user=User::findOne($id);
            $result= $user->validatePassword($oldpwd);
            return $result;

        }
    }
    public function actionChangepwd(){
        if(\Yii::$app->request->isPost){
            $info=\Yii::$app->request->post();
            $id=$info['id'];
            $pwd=$info['newpwd'];
            $user=User::findOne($id);
            $user->setPassword($pwd);
            return $user->save();

        }
    }
    public function actionChangeuserident(){
        if(\Yii::$app->request->isPost) {
            $info = \Yii::$app->request->post();
            $email=$info['email'];
            $phone=$info['phone'];
            $idnumber=$info['idnumber'];
            $stunumber=$info['stunumber'];
            $userid=\Yii::$app->user->identity->getId();
            $userinfo=UserInfo::find()->where(['user_id'=>$userid])->one();
            $userinfo->user_phone=$phone;
            $userinfo->user_idnumber=$idnumber;
            $userinfo->user_stu_number=$stunumber;
            $userinfo->save();
            return true;
        }
    }
}