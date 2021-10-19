<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "teste_questoes".
 *
 * @property int $tqu_id_tqu
 * @property string|null $tqu_enunciado
 * @property string|null $tqu_alternativa
 * @property string|null $tqu_gabaritos
 * @property float|null $tqu_valor
 * @property int|null $tqu_id_tes
 *
 * @property Testes $tquIdTes
 */
class TesteQuestoes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'teste_questoes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tqu_enunciado', 'tqu_alternativa'], 'string'],
            [['tqu_valor'], 'number'],
            [['tqu_id_tes'], 'integer'],
            [['tqu_gabaritos'], 'string', 'max' => 2],
            [['tqu_id_tes'], 'exist', 'skipOnError' => true, 'targetClass' => Testes::class, 'targetAttribute' => ['tqu_id_tes' => 'tes_id_tes']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'tqu_id_tqu' => 'Tqu Id Tqu',
            'tqu_enunciado' => 'Tqu Enunciado',
            'tqu_alternativa' => 'Tqu Alternativa',
            'tqu_gabaritos' => 'Tqu Gabaritos',
            'tqu_valor' => 'Tqu Valor',
            'tqu_id_tes' => 'Tqu Id Tes',
        ];
    }

    /**
     * Gets query for [[TquIdTes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTquIdTes()
    {
        return $this->hasOne(Testes::class, ['tes_id_tes' => 'tqu_id_tes']);
    }
}
