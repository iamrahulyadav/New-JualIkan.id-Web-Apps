<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "articel".
 *
 * @property int $articel_id
 * @property string $articel_name
 * @property int $articel_user_level_id
 * @property string $articel_url
 */
class Articel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'articel';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['articel_name', 'articel_user_level_id', 'articel_url'], 'required'],
            [['articel_user_level_id'], 'integer'],
            [['articel_url'], 'string'],
            [['articel_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'articel_id' => 'ID Artikel',
            'articel_name' => 'Nama Artikel',
            'articel_user_level_id' => 'User Artikel',
            'articel_url' => 'Url Artikel',
        ];
    }
}
