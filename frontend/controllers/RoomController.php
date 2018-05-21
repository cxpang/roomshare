<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/15
 * Time: 17:15
 */

namespace frontend\controllers;
use common\models\RoomCommentsRes;
use common\models\RoomWish;
use Yii;
use yii\web\Controller;
use common\models\Room;
use common\models\RoomComments;
use common\services\RedisService;
use common\models\Feedback;
use common\services\RoomcommentService;
class RoomController extends Controller
{

    public function actionIndex(){
        $info=Yii::$app->request->get();
        $room_city=$info['room_city'];
        if($room_city==0){
            $rooms=self::actionRoomAllIndex();
        }
        if($room_city==110100){
            $rooms=self::actionRoomBeijingIndex();
        }
        if($room_city==310100){
            $rooms=self::actionRoomShanghaiIndex();
        }

        return $this->render('index',[
            'data'=>$rooms
        ]);
    }
    public function actionRoomAllIndex(){
        $redis=new RedisService();

        if($redis->actionGetRedis('roomall')){
            $rooms=$redis->actionGetRedis('roomall');
        }
        else{
            $rooms=Room::find()->from('room as a')->leftJoin('user as b','a.user_id=b.id')->leftJoin('user_info as c','b.id=c.user_id')
                ->select('a.*,b.username,b.email,c.user_picture')->Where(['a.is_check'=>1])->asArray()->all();
            $redis->actionPhshRedis('roomall',$rooms,0);
        }
        return $rooms;
    }
    public function actionRoomBeijingIndex(){
        $redis=new RedisService();

        if($redis->actionGetRedis('roombeijing')){
            $rooms=$redis->actionGetRedis('roombeijing');
        }
        else{
            $rooms=Room::find()->from('room as a')->leftJoin('user as b','a.user_id=b.id')->leftJoin('user_info as c','b.id=c.user_id')
                ->select('a.*,b.username,b.email,c.user_picture')->where(['room_city'=>110100])->andWhere(['a.is_check'=>1])->asArray()->all();
            $redis->actionPhshRedis('roombeijing',$rooms,0);
        }
        return $rooms;
    }

    public function actionRoomShanghaiIndex(){
        $redis=new RedisService();

        if($redis->actionGetRedis('roomshanghai')){
            $rooms=$redis->actionGetRedis('roomshanghai');
        }
        else{
            $rooms=Room::find()->from('room as a')->leftJoin('user as b','a.user_id=b.id')->leftJoin('user_info as c','b.id=c.user_id')
                ->select('a.*,b.username,b.email,c.user_picture')->where(['room_city'=>310100])->andWhere(['a.is_check'=>1])->asArray()->all();
            $redis->actionPhshRedis('roomshanghai',$rooms,0);
        }
        return $rooms;
    }



    public function actionOptions(){

        $condition=self::OptionFilter();

        $rooms=Room::find()->from('room as a')->leftJoin('user as b','a.user_id=b.id')->leftJoin('user_info as c','b.id=c.user_id')
            ->select('a.*,b.username,b.email,c.user_picture')->where($condition)->asArray()->all();


        return $this->render('index',[
            'data'=>$rooms
        ]);

    }
    public function OptionFilter(){
        $info=Yii::$app->request->get();
        $condition=" 1 = 1";
        if(isset($info['roomcity'])&&$info['roomcity']>0){
            $condition .=" and a.room_city = ".$info['roomcity'];
        }
        if(isset($info['roomtype'])){
            $condition .=" and a.room_type = ".$info['roomtype'];
        }
        if(isset($info['commentroom'])&&$info['commentroom']>0){
            $condition .=" and a.is_comment = ".$info['commentroom'];
        }
        if(isset($info['fineroom'])&&$info['fineroom']>0){
            $condition .=" and a.is_essence = ".$info['fineroom'];
        }
        if(isset($info['roomprice'])&&$info['roomprice']=='low'){
            $condition .=" and a.room_price >= 1000  and a.room_price<2000 ";
        }
        if(isset($info['roomprice'])&&$info['roomprice']=='middle'){
            $condition .=" and a.room_price >= 2000  and a.room_price<3000 ";
        }
        if(isset($info['roomprice'])&&$info['roomprice']=='high'){
            $condition .=" and a.room_price >= 3000  ";
        }

        return $condition;


    }
    public function actionDetail($room_id){

        $redis=new RedisService();

        if($redis->actionGetRedis($room_id)){
            $roomsdetail=$redis->actionGetRedis($room_id);
        }
        else{
            $roomsdetail=Room::find()->from('room as a')->leftJoin('user as b','a.user_id=b.id')->leftJoin('user_info as c','b.id=c.user_id')
                ->select('a.*,b.username,b.email,c.user_picture,c.user_university,c.user_credit,c.user_expe')->where(['a.room_id'=>$room_id])->asArray()->one();

            $roomcomment=RoomComments::find()->where(['room_id'=>$room_id])->asArray()->all();

            $roomsdetail['comment']=$roomcomment;
            $redis->actionPhshRedis($room_id,$roomsdetail,30);

        }
        return $this->render('detail',[
            'data'=>$roomsdetail
        ]);
    }
    public function actionAddcomment(){
        $info=Yii::$app->request->post();
        $roomid=$info['roomid'];
        $comment=$info['roomcontent'];
        $userid=Yii::$app->user->identity->getId();
        $service=new RoomcommentService();
        if($service->Addroomcomment($roomid,$userid,$comment,0)){
            Yii::$app->session->setFlash('success', '评论成功');
            $this->redirect(['room/detail','room_id'=>$roomid]);
        }
        else{
            Yii::$app->session->setFlash('danger', '未知的错误发生了，请重试');
            $this->redirect(['room/detail','room_id'=>$roomid]);
        }

    }
    public function actionCommentres(){
        $info=Yii::$app->request->post();
        $comments_id=$info['comments_id'];
        $result=RoomCommentsRes::find()->where(['comments_id'=>$comments_id])->asArray()->all();
        return json_encode($result);
    }
    public function actionAddcommres(){
        $info=Yii::$app->request->post();
        $at_user_id=$info['at_user_id'];
        $comments_id=$info['comments_id'];
        $res_comments_con=$info['res_comments_con'];
        $user_id=Yii::$app->user->identity->getId();
        $roomid=$info['roomid'];
        $service=new RoomcommentService();
        if($service->Addroomres($comments_id,$user_id,$at_user_id,$res_comments_con,$roomid)){
            Yii::$app->session->setFlash('success', '回复成功');
            $this->redirect(['room/detail','room_id'=>$roomid]);
        }
        else{
            Yii::$app->session->setFlash('danger', '未知的错误发生了，请重试');
            $this->redirect(['room/detail','room_id'=>$roomid]);
        }
    }
    public function actionSearch(){
        $GetInfo=Yii::$app->request->get();
        $roomname=$GetInfo['room_name'];
        $roomsdetail=Room::find()->from('room as a')->leftJoin('user as b','a.user_id=b.id')->leftJoin('user_info as c','b.id=c.user_id')
            ->select('a.*,b.username,b.email,c.user_picture,c.user_university,c.user_credit,c.user_expe')
            ->where(['like','a.room_name',$roomname])
            ->andWhere(['a.is_check'=>1])
            ->asArray()->one();

        if(!$roomsdetail){
            return $this->render('error');
        }
        $roomcomment=RoomComments::find()->where(['room_id'=>$roomsdetail['room_id']])->asArray()->all();

        $roomsdetail['comment']=$roomcomment;

        return $this->render('detail',[
            'data'=>$roomsdetail
        ]);
    }
    public function actionShakerent(){
        $info=Yii::$app->request->post();
        $room_id=$info['room_id'];
        $room_user_id=$info['user_id'];
        $user_id=Yii::$app->user->getId();
        if(RoomWish::find()->where(['room_id'=>$room_id,'user_id'=>$user_id])->one()){
            return 'had';
        }
        $roomwish=new RoomWish();
        $roomwish->user_id=$user_id;
        $roomwish->room_id=$room_id;
        $roomwish->room_user_id=$room_user_id;
        $roomwish->create_at=time();
        if($roomwish->save()){
            return 'ok';
        }
        else{
            return false;
        }
    }
}
