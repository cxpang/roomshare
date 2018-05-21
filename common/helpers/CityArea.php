<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/8
 * Time: 21:21
 */

namespace common\helpers;

use common\models\City;
use common\models\Area;
use yii\helpers\ArrayHelper;

class CityArea
{
      public static function GetCity(){
          $_data = City::find()->select('city_id,city')->all();
          $_data = ArrayHelper::map(array_merge($_data), 'city_id', 'city');
          return $_data;
      }
    public static function GetArea($city_id){
        $_data = Area::find()->select('area_id,area')->where(['parent_id'=>$city_id])->all();
        $_data = ArrayHelper::map(array_merge($_data), 'area_id', 'area');
        return $_data;
    }
}