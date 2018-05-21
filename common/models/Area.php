<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "area".
 *
 * @property int $id
 * @property int $area_id
 * @property string $area
 * @property int $parent_id
 */
class Area extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'area';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['area_id', 'parent_id'], 'integer'],
            [['area'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'area_id' => 'Area ID',
            'area' => 'Area',
            'parent_id' => 'Parent ID',
        ];
    }
    public static function findarea($areaid){
        $area=self::find()->where(['area_id'=>$areaid])->one();
        return $area->area;

    }
}
