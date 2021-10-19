<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MateriaisCorrecao;

/**
 * MateriaisCorrecaoSearch represents the model behind the search form of `app\models\MateriaisCorrecao`.
 */
class MateriaisCorrecaoSearch extends MateriaisCorrecao
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mac_id_mac', 'mac_id_alu', 'mac_id_mat'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = MateriaisCorrecao::find();

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
            'mac_id_mac' => $this->mac_id_mac,
            'mac_id_alu' => $this->mac_id_alu,
            'mac_id_mat' => $this->mac_id_mat,
        ]);

        return $dataProvider;
    }
}
