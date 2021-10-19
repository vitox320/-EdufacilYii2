<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "notas".
 *
 * @property int $not_id_not
 * @property int|null $not_id_tes
 * @property int|null $not_id_alu
 * @property float|null $not_valor_nota
 *
 * @property Alunos $notIdAlu
 * @property Testes $notIdTes
 */
class Notas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'notas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['not_id_tes', 'not_id_alu'], 'integer'],
            [['not_valor_nota'], 'number'],
            [['not_id_alu'], 'exist', 'skipOnError' => true, 'targetClass' => Alunos::class, 'targetAttribute' => ['not_id_alu' => 'alu_id_alu']],
            [['not_id_tes'], 'exist', 'skipOnError' => true, 'targetClass' => Testes::class, 'targetAttribute' => ['not_id_tes' => 'tes_id_tes']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'not_id_not' => 'Not Id Not',
            'not_id_tes' => 'Not Id Tes',
            'not_id_alu' => 'Not Id Alu',
            'not_valor_nota' => 'Not Valor Nota',
        ];
    }

    /**
     * Gets query for [[NotIdAlu]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNotIdAlu()
    {
        return $this->hasOne(Alunos::class, ['alu_id_alu' => 'not_id_alu']);
    }

    /**
     * Gets query for [[NotIdTes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNotIdTes()
    {
        return $this->hasOne(Testes::class, ['tes_id_tes' => 'not_id_tes']);
    }
}
