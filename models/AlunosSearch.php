<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Alunos;

/**
 * AlunosSearch represents the model behind the search form of `app\models\Alunos`.
 */
class AlunosSearch extends Alunos
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['alu_id_alu', 'alu_id_tur', 'alu_id_pro'], 'integer'],
            [['alu_nome_alunos', 'alu_email_alunos', 'alu_senha_alunos'], 'safe'],
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
        $query = Alunos::find();

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
            'alu_id_alu' => $this->alu_id_alu,
            'alu_id_tur' => $this->alu_id_tur,
            'alu_id_pro' => $this->alu_id_pro,
        ]);

        $query->andFilterWhere(['like', 'alu_nome_alunos', $this->alu_nome_alunos])
            ->andFilterWhere(['like', 'alu_email_alunos', $this->alu_email_alunos])
            ->andFilterWhere(['like', 'alu_senha_alunos', $this->alu_senha_alunos]);

        return $dataProvider;
    }
}
