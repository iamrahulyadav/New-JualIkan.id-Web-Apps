<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "fish_review".
 *
 * @property int $id
 * @property int $user_id
 * @property int $fish_id
 * @property string $review_text
 * @property int $review_jumalh
 */
class FishReview extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fish_review';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'fish_id', 'review_text', 'review_jumalh'], 'required'],
            [['id', 'user_id', 'fish_id', 'review_jumalh'], 'integer'],
            [['review_text'], 'string'],
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
            'fish_id' => 'Fish ID',
            'review_text' => 'Review Text',
            'review_jumalh' => 'Review Jumalh',
        ];
    }
}
