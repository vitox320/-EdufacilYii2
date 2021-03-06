<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Notas;

/**
 * NotasSearch represents the model behind the search form of `app\models\Notas`.
 */
class NotasSearch extends Notas
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['not_id_not', 'not_id_tes', 'not_id_alu'], 'integer'],
            [['not_valor_nota'], 'number'],
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
        $query = Notas::find();

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
            'not_id_not' => $this->not_id_not,
            'not_id_tes' => $this->not_id_tes,
            'not_id_alu' => $this->not_id_alu,
            'not_valor_nota' => $this->not_valor_nota,
        ]);

        return $dataProvider;
    }
}
