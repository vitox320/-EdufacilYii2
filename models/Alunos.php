<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "alunos".
 *
 * @property int $alu_id_alu
 * @property int|null $alu_id_tur
 * @property int|null $alu_id_pro
 * @property int|null $alu_id_usu
 *
 * @property Professores $aluIdPro
 * @property Turma $aluIdTur
 * @property Usuarios $aluIdUsu
 * @property MateriaisCorrecao[] $materiaisCorrecaos
 * @property Notas[] $notas
 */
class Alunos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'alunos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['alu_id_tur', 'alu_id_pro', 'alu_id_usu'], 'integer'],
            [['alu_id_usu'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::className(), 'targetAttribute' => ['alu_id_usu' => 'usu_id_usu']],
            [['alu_id_pro'], 'exist', 'skipOnError' => true, 'targetClass' => Professores::className(), 'targetAttribute' => ['alu_id_pro' => 'pro_id_pro']],
            [['alu_id_tur'], 'exist', 'skipOnError' => true, 'targetClass' => Turma::className(), 'targetAttribute' => ['alu_id_tur' => 'tur_id_tur']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'alu_id_alu' => 'Alu Id Alu',
            'alu_id_tur' => 'Alu Id Tur',
            'alu_id_pro' => 'Alu Id Pro',
            'alu_id_usu' => 'Alu Id Usu',
        ];
    }

    /**
     * Gets query for [[AluIdPro]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAluIdPro()
    {
        return $this->hasOne(Professores::className(), ['pro_id_pro' => 'alu_id_pro']);
    }

    /**
     * Gets query for [[AluIdTur]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAluIdTur()
    {
        return $this->hasOne(Turma::className(), ['tur_id_tur' => 'alu_id_tur']);
    }

    /**
     * Gets query for [[AluIdUsu]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAluIdUsu()
    {
        return $this->hasOne(Usuarios::className(), ['usu_id_usu' => 'alu_id_usu']);
    }

    /**
     * Gets query for [[MateriaisCorrecaos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMateriaisCorrecaos()
    {
        return $this->hasMany(MateriaisCorrecao::className(), ['mac_id_alu' => 'alu_id_alu']);
    }

    /**
     * Gets query for [[Notas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNotas()
    {
        return $this->hasMany(Notas::className(), ['not_id_alu' => 'alu_id_alu']);
    }
}
