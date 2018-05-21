<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "city".
 *
 * @property int $id
 * @property int $city_id
 * @property string $city
 * @property int $parent_id
 */
class City extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'city';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['city_id', 'parent_id'], 'integer'],
            [['city'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'city_id' => 'City ID',
            'city' => 'City',
            'parent_id' => 'Parent ID',
        ];
    }
    public static function findCity($cityid){
        $city=self::find()->where(['city_id'=>$cityid])->one();
        return $city->city;

    }
}
