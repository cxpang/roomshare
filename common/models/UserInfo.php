<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_info".
 *
 * @property int $id
 * @property int $user_id
 * @property string $user_phone
 * @property string $user_picture
 * @property string $user_address
 * @property string $user_university
 * @property int $user_expe
 * @property int $user_credit
 * @property int $user_sex
 * @property string $user_idnumber
 * @property string $user_stu_number 学号
 */
class UserInfo extends \yii\db\ActiveRecord
{
    public static $SEX=[ '0'=>'未认证',
        '1'=>'男',
        '2'=>'女'];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'user_expe', 'user_credit'], 'integer'],
            [['user_phone', 'user_university', 'user_stu_number'], 'string', 'max' => 20],
            [['user_picture'], 'string', 'max' => 50],
            [['user_address'], 'string', 'max' => 255],
            [['user_idnumber'], 'string', 'max' => 32],
            [['user_id'], 'unique'],
            [['user_phone'], 'unique'],
            [['user_idnumber'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'user_sex'=>'User Sex',
            'user_phone' => 'User Phone',
            'user_picture' => 'User Picture',
            'user_address' => 'User Address',
            'user_university' => 'User University',
            'user_expe' => 'User Expe',
            'user_credit' => 'User Credit',
            'user_idnumber' => 'User Idnumber',
            'user_stu_number' => 'User Stu Number',
        ];
    }
    public static function  GetUserImage($user_id){
         $user=self::find()->where(['user_id'=>$user_id])->one();
         return $user->user_picture;
    }

}
