<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "turma".
 *
 * @property int $tur_id_tur
 * @property string|null $tur_nom_turma
 * @property int|null $tur_id_pro
 *
 * @property Alunos[] $alunos
 * @property Materiais[] $materiais
 * @property Professores $turIdPro
 */
class Turma extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'turma';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tur_id_pro'], 'integer'],
            [['tur_nom_turma'], 'string', 'max' => 45],
            [['tur_id_pro'], 'exist', 'skipOnError' => true, 'targetClass' => Professores::class, 'targetAttribute' => ['tur_id_pro' => 'pro_id_pro']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'tur_id_tur' => 'Tur Id Tur',
            'tur_nom_turma' => 'Tur Nom Turma',
            'tur_id_pro' => 'Tur Id Pro',
        ];
    }

    /**
     * Gets query for [[Alunos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlunos()
    {
        return $this->hasMany(Alunos::class, ['alu_id_tur' => 'tur_id_tur']);
    }

    /**
     * Gets query for [[Materiais]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMateriais()
    {
        return $this->hasMany(Materiais::class, ['mat_id_tur' => 'tur_id_tur']);
    }

    /**
     * Gets query for [[TurIdPro]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTurIdPro()
    {
        return $this->hasOne(Professores::class, ['pro_id_pro' => 'tur_id_pro']);
    }
}
