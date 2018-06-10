<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_pengguna".
 *
 * @property int $user_id
 * @property string $user_full_name
 * @property string $user_image
 * @property string $user_phone
 * @property string $user_email
 * @property string $user_password
 * @property string $user_device_id
 * @property int $user_kota_id
 * @property string $user_address
 * @property int $user_saldo
 */
class UserPengguna extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_pengguna';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_full_name', 'user_phone', 'user_email', 'user_password', 'user_kota_id', 'user_address'], 'required'],
            [['user_image', 'user_address'], 'string'],
            [['user_kota_id', 'user_saldo'], 'integer'],
            [['user_full_name', 'user_email', 'user_password', 'user_device_id'], 'string', 'max' => 100],
            [['user_phone'], 'string', 'max' => 12],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'ID User',
            'user_full_name' => 'Nama Lengkap User',
            'user_image' => 'Foto User',
            'user_phone' => 'No Telp User',
            'user_email' => 'Email User',
            'user_password' => 'Password User',
            'user_device_id' => 'Device ID User',
            'user_kota_id' => 'Nama Kota',
            'user_address' => 'Alamat User',
            'user_saldo' => 'Saldo User',
        ];
    }
}
