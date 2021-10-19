<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Professores;

/**
 * ProfessoresSearch represents the model behind the search form of `app\models\Professores`.
 */
class ProfessoresSearch extends Professores
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pro_id_pro'], 'integer'],
            [['pro_nome_professor', 'pro_email_professor', 'pro_senha_professor'], 'safe'],
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
        $query = Professores::find();

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
            'pro_id_pro' => $this->pro_id_pro,
        ]);

        $query->andFilterWhere(['like', 'pro_nome_professor', $this->pro_nome_professor])
            ->andFilterWhere(['like', 'pro_email_professor', $this->pro_email_professor])
            ->andFilterWhere(['like', 'pro_senha_professor', $this->pro_senha_professor]);

        return $dataProvider;
    }
}
