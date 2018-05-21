<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "admin_info".
 *
 * @property int $id
 * @property int $admin_id
 * @property string $admin_phone
 * @property string $admin_picture
 * @property string $admin_address
 * @property string $admin_university
 * @property int $admin_expe
 * @property int $admin_credit
 * @property string $admin_idnumber
 */
class Admininfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['admin_id'], 'required'],
            [['admin_id', 'admin_expe', 'admin_credit'], 'integer'],
            [['admin_phone', 'admin_university'], 'string', 'max' => 20],
            [['admin_picture'], 'string', 'max' => 50],
            [['admin_address'], 'string', 'max' => 255],
            [['admin_idnumber'], 'string', 'max' => 32],
            [['admin_id'], 'unique'],
            [['admin_phone'], 'unique'],
            [['admin_idnumber'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'admin_id' => 'Admin ID',
            'admin_phone' => 'Admin Phone',
            'admin_picture' => 'Admin Picture',
            'admin_address' => 'Admin Address',
            'admin_university' => 'Admin University',
            'admin_expe' => 'Admin Expe',
            'admin_credit' => 'Admin Credit',
            'admin_idnumber' => 'Admin Idnumber',
        ];
    }
}
