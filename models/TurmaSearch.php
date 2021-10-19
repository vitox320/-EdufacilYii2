<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Turma;

/**
 * TurmaSearch represents the model behind the search form of `app\models\Turma`.
 */
class TurmaSearch extends Turma
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tur_id_tur', 'tur_id_pro'], 'integer'],
            [['tur_nom_turma'], 'safe'],
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
        $query = Turma::find();

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
            'tur_id_tur' => $this->tur_id_tur,
            'tur_id_pro' => $this->tur_id_pro,
        ]);

        $query->andFilterWhere(['like', 'tur_nom_turma', $this->tur_nom_turma]);

        return $dataProvider;
    }
}
