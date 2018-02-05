<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "user_koperasi".
 *
 * @property int $koperasi_id
 * @property string $koperasi_name
 * @property string $kopreasi_image
 * @property int $koperasi_level_id
 * @property string $koperasi_holder_name
 * @property string $koperasi_holder_phone
 * @property string $koperasi_email
 * @property string $koperasi_password
 * @property int $koperasi_kota_id
 * @property string $koperasi_address
 * @property string $koperasi_lat
 * @property string $koperasi_lng
 * @property int $koperasi_status
 */
class UserKoperasi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_koperasi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['koperasi_name', 'koperasi_holder_name', 'koperasi_holder_phone', 'koperasi_email', 'koperasi_kota_id', 'koperasi_address', ], 'required'],
            [['kopreasi_image', 'koperasi_address'], 'string'],
            [['koperasi_level_id', 'koperasi_kota_id', 'koperasi_status'], 'integer'],
            [['koperasi_name', 'koperasi_holder_name', 'koperasi_email', 'koperasi_password'], 'string', 'max' => 100],
            [['koperasi_holder_phone'], 'string', 'max' => 12],
            [['koperasi_lat', 'koperasi_lng'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'koperasi_id' => 'Koperasi ID',
            'koperasi_name' => 'Koperasi Name',
            'kopreasi_image' => 'Kopreasi Image',
            'koperasi_level_id' => 'Koperasi Level ID',
            'koperasi_holder_name' => 'Koperasi Holder Name',
            'koperasi_holder_phone' => 'Koperasi Holder Phone',
            'koperasi_email' => 'Koperasi Email',
            'koperasi_password' => 'Koperasi Password',
            'koperasi_kota_id' => 'Koperasi Kota ID',
            'koperasi_address' => 'Koperasi Address',
            'koperasi_lat' => 'Koperasi Lat',
            'koperasi_lng' => 'Koperasi Lng',
            'koperasi_status' => 'Koperasi Status',
        ];
    }
}
