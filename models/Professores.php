<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "professores".
 *
 * @property int $pro_id_pro
 * @property string|null $pro_nome_professor
 * @property string|null $pro_email_professor
 * @property string|null $pro_senha_professor
 *
 * @property Alunos[] $alunos
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
            [['pro_nome_professor', 'pro_email_professor'], 'string', 'max' => 45],
            [['pro_senha_professor'], 'string', 'max' => 220],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pro_id_pro' => 'Pro Id Pro',
            'pro_nome_professor' => 'Pro Nome Professor',
            'pro_email_professor' => 'Pro Email Professor',
            'pro_senha_professor' => 'Pro Senha Professor',
        ];
    }

    /**
     * Gets query for [[Alunos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlunos()
    {
        return $this->hasMany(Alunos::class, ['alu_id_pro' => 'pro_id_pro']);
    }

    /**
     * Gets query for [[Turmas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTurmas()
    {
        return $this->hasMany(Turma::class, ['tur_id_pro' => 'pro_id_pro']);
    }
}
