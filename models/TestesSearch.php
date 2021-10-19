<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Testes;

/**
 * TestesSearch represents the model behind the search form of `app\models\Testes`.
 */
class TestesSearch extends Testes
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tes_id_tes', 'tes_id_tur', 'tes_unidade_teste'], 'integer'],
            [['tes_nome_teste'], 'safe'],
            [['tes_valor_teste'], 'number'],
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
        $query = Testes::find();

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
            'tes_id_tes' => $this->tes_id_tes,
            'tes_id_tur' => $this->tes_id_tur,
            'tes_valor_teste' => $this->tes_valor_teste,
            'tes_unidade_teste' => $this->tes_unidade_teste,
        ]);

        $query->andFilterWhere(['like', 'tes_nome_teste', $this->tes_nome_teste]);

        return $dataProvider;
    }
}
