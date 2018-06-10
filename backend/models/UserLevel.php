<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user_level".
 *
 * @property int $user_level_id
 * @property string $user_level_name
 */
class UserLevel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_level';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_level_name'], 'required'],
            [['user_level_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_level_id' => 'User Level ID',
            'user_level_name' => 'User Level Name',
        ];
    }
}
