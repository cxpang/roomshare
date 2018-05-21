<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/1/001
 * Time: 18:53
 */

namespace common\services;

use Yii;
class ChangeService
{
    public static function actionChangeCredit($user_credit){
        if($user_credit<60){
            return "信用初等";
        }
        if($user_credit>=60&&$user_credit<80){
            return "信用良好";
        }
        else{
            return "信用优秀";
        }
    }
    public static function actionChangeExpe($user_expe){
        if($user_expe<60){
            return "等级初级";
        }
        if($user_expe>=60&&$user_expe<80){
            return "等级中级";
        }
        else{
            return "等级高级";
        }
    }

}