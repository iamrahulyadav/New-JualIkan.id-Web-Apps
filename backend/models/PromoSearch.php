<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Promo;

/**
 * PromoSearch represents the model behind the search form of `backend\models\Promo`.
 */
class PromoSearch extends Promo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['promo_id'], 'integer'],
            [['promo_name', 'promo_start', 'promo_end', 'promo_image'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Promo::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'promo_id' => $this->promo_id,
            'promo_start' => $this->promo_start,
            'promo_end' => $this->promo_end,
        ]);

        $query->andFilterWhere(['like', 'promo_name', $this->promo_name])
            ->andFilterWhere(['like', 'promo_image', $this->promo_image]);

        return $dataProvider;
    }
}
