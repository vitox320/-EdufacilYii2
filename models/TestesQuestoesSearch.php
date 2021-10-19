<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TesteQuestoes;

/**
 * TestesQuestoesSearch represents the model behind the search form of `app\models\TesteQuestoes`.
 */
class TestesQuestoesSearch extends TesteQuestoes
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tqu_id_tqu', 'tqu_id_tes'], 'integer'],
            [['tqu_enunciado', 'tqu_alternativa', 'tqu_gabaritos'], 'safe'],
            [['tqu_valor'], 'number'],
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
        $query = TesteQuestoes::find();

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
            'tqu_id_tqu' => $this->tqu_id_tqu,
            'tqu_valor' => $this->tqu_valor,
            'tqu_id_tes' => $this->tqu_id_tes,
        ]);

        $query->andFilterWhere(['like', 'tqu_enunciado', $this->tqu_enunciado])
            ->andFilterWhere(['like', 'tqu_alternativa', $this->tqu_alternativa])
            ->andFilterWhere(['like', 'tqu_gabaritos', $this->tqu_gabaritos]);

        return $dataProvider;
    }
}
