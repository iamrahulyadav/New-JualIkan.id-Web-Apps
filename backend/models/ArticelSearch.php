<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Articel;

/**
 * ArticelSearch represents the model behind the search form of `backend\models\Articel`.
 */
class ArticelSearch extends Articel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['articel_id', 'articel_user_level_id'], 'integer'],
            [['articel_name', 'articel_url'], 'safe'],
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
        $query = Articel::find();

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
            'articel_id' => $this->articel_id,
            'articel_user_level_id' => $this->articel_user_level_id,
        ]);

        $query->andFilterWhere(['like', 'articel_name', $this->articel_name])
            ->andFilterWhere(['like', 'articel_url', $this->articel_url]);

        return $dataProvider;
    }
}
