<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "testes".
 *
 * @property int $tes_id_tes
 * @property string|null $tes_nome_teste
 * @property int|null $tes_id_tur
 * @property float|null $tes_valor_teste
 * @property int|null $tes_unidade_teste
 *
 * @property Notas[] $notas
 * @property TesteQuestoes[] $testeQuestoes
 */
class Testes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'testes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tes_id_tur', 'tes_unidade_teste'], 'integer'],
            [['tes_valor_teste'], 'number'],
            [['tes_nome_teste'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'tes_id_tes' => 'Tes Id Tes',
            'tes_nome_teste' => 'Tes Nome Teste',
            'tes_id_tur' => 'Tes Id Tur',
            'tes_valor_teste' => 'Tes Valor Teste',
            'tes_unidade_teste' => 'Tes Unidade Teste',
        ];
    }

    /**
     * Gets query for [[Notas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNotas()
    {
        return $this->hasMany(Notas::class, ['not_id_tes' => 'tes_id_tes']);
    }

    /**
     * Gets query for [[TesteQuestoes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTesteQuestoes()
    {
        return $this->hasMany(TesteQuestoes::class, ['tqu_id_tes' => 'tes_id_tes']);
    }


}
