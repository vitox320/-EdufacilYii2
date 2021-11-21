<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "aluno_turma".
 *
 * @property int $atu_id_atu
 * @property int|null $atu_id_alu
 * @property int|null $atu_id_tur
 *
 * @property Alunos $atuIdAlu
 * @property Turma $atuIdTur
 */
class AlunoTurma extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'aluno_turma';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['atu_id_alu', 'atu_id_tur'], 'integer'],
            [['atu_id_tur'], 'exist', 'skipOnError' => true, 'targetClass' => Turma::className(), 'targetAttribute' => ['atu_id_tur' => 'tur_id_tur']],
            [['atu_id_alu'], 'exist', 'skipOnError' => true, 'targetClass' => Alunos::className(), 'targetAttribute' => ['atu_id_alu' => 'alu_id_alu']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'atu_id_atu' => 'Atu Id Atu',
            'atu_id_alu' => 'Atu Id Alu',
            'atu_id_tur' => 'Atu Id Tur',
        ];
    }

    /**
     * Gets query for [[AtuIdAlu]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAtuIdAlu()
    {
        return $this->hasOne(Alunos::className(), ['alu_id_alu' => 'atu_id_alu']);
    }

    /**
     * Gets query for [[AtuIdTur]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAtuIdTur()
    {
        return $this->hasOne(Turma::className(), ['tur_id_tur' => 'atu_id_tur']);
    }
}
