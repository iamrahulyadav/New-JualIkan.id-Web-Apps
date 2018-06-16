<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "delivery_time".
 *
 * @property int $delivery_time_id
 * @property int $delivery_time_koperasi_id
 * @property string $delivery_time_name
 * @property string $delivery_time_start
 * @property string $delivery_time_end
 */
class DeliveryTime extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'delivery_time';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['delivery_time_koperasi_id', 'delivery_time_name', 'delivery_time_start', 'delivery_time_end'], 'required'],
            [['delivery_time_koperasi_id'], 'integer'],
            [['delivery_time_start', 'delivery_time_end'], 'safe'],
            [['delivery_time_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'delivery_time_id' => 'ID Waktu Pengriman',
            'delivery_time_koperasi_id' => 'Nama Koperasi Waktu Pengriman',
            'delivery_time_name' => 'Nama Waktu Pengiriman',
            'delivery_time_start' => 'Waktu Pengriman Dimulai',
            'delivery_time_end' => 'Waktu Pengriman Berakhir',
        ];
    }
}
