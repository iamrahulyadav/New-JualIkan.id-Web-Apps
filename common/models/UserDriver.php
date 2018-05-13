<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_driver".
 *
 * @property int $driver_id
 * @property string $driver_full_name
 * @property string $driver_phone
 * @property string $driver_email
 * @property string $driver_password
 * @property string $driver_device_id
 * @property string $driver_image
 * @property int $driver_koperasi_id
 * @property int $driver_vehicle_weight
 * @property string $driver_address
 * @property int $driver_track_id
 * @property int $driver_saldo
 */
class UserDriver extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_driver';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['driver_full_name', 'driver_phone', 'driver_email', 'driver_password', 'driver_device_id', 'driver_image', 'driver_koperasi_id', 'driver_vehicle_weight', 'driver_address', 'driver_track_id', 'driver_saldo'], 'required'],
            [['driver_image', 'driver_address'], 'string'],
            [['driver_koperasi_id', 'driver_vehicle_weight', 'driver_track_id', 'driver_saldo'], 'integer'],
            [['driver_full_name', 'driver_email', 'driver_device_id'], 'string', 'max' => 100],
            [['driver_phone'], 'string', 'max' => 12],
            [['driver_password'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'driver_id' => 'Driver ID',
            'driver_full_name' => 'Driver Full Name',
            'driver_phone' => 'Driver Phone',
            'driver_email' => 'Driver Email',
            'driver_password' => 'Driver Password',
            'driver_device_id' => 'Driver Device ID',
            'driver_image' => 'Driver Image',
            'driver_koperasi_id' => 'Driver Koperasi ID',
            'driver_vehicle_weight' => 'Driver Vehicle Weight',
            'driver_address' => 'Driver Address',
            'driver_track_id' => 'Driver Track ID',
            'driver_saldo' => 'Driver Saldo',
        ];
    }
}
