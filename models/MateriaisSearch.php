<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Materiais;

/**
 * MateriaisSearch represents the model behind the search form of `app\models\Materiais`.
 */
class MateriaisSearch extends Materiais
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mat_id_mat', 'mat_id_tur', 'mat_teste'], 'integer'],
            [['mat_tiulo', 'mat_link', 'mat_dat_cadastro'], 'safe'],
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
        $query = Materiais::find();

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
            'mat_id_mat' => $this->mat_id_mat,
            'mat_dat_cadastro' => $this->mat_dat_cadastro,
            'mat_id_tur' => $this->mat_id_tur,
            'mat_teste' => $this->mat_teste,
        ]);

        $query->andFilterWhere(['like', 'mat_tiulo', $this->mat_tiulo])
            ->andFilterWhere(['like', 'mat_link', $this->mat_link]);

        return $dataProvider;
    }
}
