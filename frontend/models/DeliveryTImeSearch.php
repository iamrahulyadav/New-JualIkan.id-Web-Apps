<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\DeliveryTime;

/**
 * DeliveryTImeSearch represents the model behind the search form of `common\models\DeliveryTime`.
 */
class DeliveryTImeSearch extends DeliveryTime
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['delivery_time_id', 'delivery_time_koperasi_id'], 'integer'],
            [['delivery_time_name', 'delivery_time_start', 'delivery_time_end'], 'safe'],
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
        $query = DeliveryTime::find();

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
            'delivery_time_id' => $this->delivery_time_id,
            'delivery_time_koperasi_id' => $this->delivery_time_koperasi_id,
            'delivery_time_start' => $this->delivery_time_start,
            'delivery_time_end' => $this->delivery_time_end,
        ]);

        $query->andFilterWhere(['like', 'delivery_time_name', $this->delivery_time_name]);

        return $dataProvider;
    }
}
