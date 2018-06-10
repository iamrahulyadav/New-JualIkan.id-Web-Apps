<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "promo".
 *
 * @property int $promo_id
 * @property string $promo_name
 * @property string $promo_start
 * @property string $promo_end
 * @property string $promo_image
 */
class Promo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'promo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['promo_name', 'promo_start', 'promo_end', 'promo_image'], 'required'],
            [['promo_start', 'promo_end'], 'safe'],
            [['promo_image'], 'string'],
            [['promo_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'promo_id' => 'ID Promo',
            'promo_name' => 'Nama Promo',
            'promo_start' => 'Tanggal Promo Mulai',
            'promo_end' => 'Tanggal Promo Berakhir',
            'promo_image' => 'Foto Promo',
        ];
    }
}
