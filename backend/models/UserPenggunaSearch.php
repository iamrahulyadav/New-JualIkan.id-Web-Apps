<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\UserPengguna;

/**
 * UserPenggunaSearch represents the model behind the search form of `common\models\UserPengguna`.
 */
class UserPenggunaSearch extends UserPengguna
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'user_kota_id', 'user_saldo'], 'integer'],
            [['user_full_name', 'user_image', 'user_phone', 'user_email', 'user_password', 'user_device_id', 'user_address'], 'safe'],
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
        $query = UserPengguna::find();

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
            'user_id' => $this->user_id,
            'user_kota_id' => $this->user_kota_id,
            'user_saldo' => $this->user_saldo,
        ]);

        $query->andFilterWhere(['like', 'user_full_name', $this->user_full_name])
            ->andFilterWhere(['like', 'user_image', $this->user_image])
            ->andFilterWhere(['like', 'user_phone', $this->user_phone])
            ->andFilterWhere(['like', 'user_email', $this->user_email])
            ->andFilterWhere(['like', 'user_password', $this->user_password])
            ->andFilterWhere(['like', 'user_device_id', $this->user_device_id])
            ->andFilterWhere(['like', 'user_address', $this->user_address]);

        return $dataProvider;
    }
}
