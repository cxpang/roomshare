<?php
namespace common\services;
use common\models\Room;
use Yii;
class RedisService
{
    public static $REDISKEY=array(
        "roomall"=>"全部房间REDIS",
        "roombeijing"=>"北京房间REDIS",
        "roomshanghai"=>"上海房间REDIS",
    );



    /*****
      key置入redis队列
     *****/

    public function actionPhshRedis($key,$data,$expritime=0){
        $data = json_encode($data);
        if($expritime==0) {
            Yii::$app->redis->set($key, $data);  //设置redis缓存
        }
        else {
            Yii::$app->redis->executeCommand('SET', [$key, $data, 'EX', $expritime]); // 按秒缓存
        }
    }
    /****
     获取单个key
     ***/
    public function actionGetRedis($key){
        $data=Yii::$app->redis->get($key);
        $data=json_decode($data,true);
        return $data;
    }


    /****
     获取所有的redis-key
     ****/
    public function actionGetALLKeys(){
        $allkey=Yii::$app->redis->executeCommand('keys *');
        $usefulkey=[];
        foreach ($allkey as $key){
            if(Yii::$app->redis->executeCommand('ttl '.$key)==-1){
                $usefulkey[]=$key;
            }
        }
        return $usefulkey;
    }

    /****
    删除redis key
     ****/
    public function actionDelete($key){
        return Yii::$app->redis->del($key);
    }
    /****
    更新redis key
     ****/
    public function actionUpdate($key,$type){
        if($type==1){
            Yii::$app->redis->del($key);
            $rooms=Room::find()->from('room as a')->leftJoin('user as b','a.user_id=b.id')->leftJoin('user_info as c','b.id=c.user_id')
                ->select('a.*,b.username,b.email,c.user_picture')->where(['a.is_check'=>1])->asArray()->all();
            $this->actionPhshRedis($key,$rooms);
            return true;
        }
        if($type==2){
            Yii::$app->redis->del($key);
            $rooms=Room::find()->from('room as a')->leftJoin('user as b','a.user_id=b.id')->leftJoin('user_info as c','b.id=c.user_id')
                ->select('a.*,b.username,b.email,c.user_picture')->where(['a.room_city'=>110100])
                ->andWhere(['a.is_check'=>1])->asArray()->all();
            $this->actionPhshRedis($key,$rooms);
            return true;
        }
        if($type==3){
            Yii::$app->redis->del($key);
            $rooms=Room::find()->from('room as a')->leftJoin('user as b','a.user_id=b.id')->leftJoin('user_info as c','b.id=c.user_id')
                ->select('a.*,b.username,b.email,c.user_picture')->where(['a.room_city'=>310100])->
                andWhere(['a.is_check'=>1])->asArray()->all();
            $this->actionPhshRedis($key,$rooms);
            return true;
        }
        return false;
    }

}