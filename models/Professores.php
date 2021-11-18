<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "professores".
 *
 * @property int $pro_id_pro
 * @property int|null $pro_id_usu
 *
 * @property Alunos[] $alunos
 * @property Usuarios $proIdUsu
 * @property Turma[] $turmas
 */
class Professores extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'professores';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pro_id_usu'], 'integer'],
            [['pro_id_usu'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::className(), 'targetAttribute' => ['pro_id_usu' => 'usu_id_usu']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pro_id_pro' => 'Pro Id Pro',
            'pro_id_usu' => 'Pro Id Usu',
        ];
    }

    /**
     * Gets query for [[Alunos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlunos()
    {
        return $this->hasMany(Alunos::className(), ['alu_id_pro' => 'pro_id_pro']);
    }

    /**
     * Gets query for [[ProIdUsu]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProIdUsu()
    {
        return $this->hasOne(Usuarios::className(), ['usu_id_usu' => 'pro_id_usu']);
    }

    /**
     * Gets query for [[Turmas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTurmas()
    {
        return $this->hasMany(Turma::className(), ['tur_id_pro' => 'pro_id_pro']);
    }
}
