<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "materiais".
 *
 * @property int $mat_id_mat
 * @property string|null $mat_tiulo
 * @property string|null $mat_link
 * @property string|null $mat_dat_cadastro
 * @property int|null $mat_id_tur
 * @property int|null $mat_teste
 *
 * @property Turma $matIdTur
 * @property MateriaisCorrecao[] $materiaisCorrecaos
 */
class Materiais extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'materiais';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mat_dat_cadastro'], 'safe'],
            [['mat_id_tur', 'mat_teste'], 'integer'],
            [['mat_tiulo', 'mat_link'], 'string', 'max' => 45],
            [['mat_id_tur'], 'exist', 'skipOnError' => true, 'targetClass' => Turma::class, 'targetAttribute' => ['mat_id_tur' => 'tur_id_tur']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'mat_id_mat' => 'Mat Id Mat',
            'mat_tiulo' => 'Mat Tiulo',
            'mat_link' => 'Mat Link',
            'mat_dat_cadastro' => 'Mat Dat Cadastro',
            'mat_id_tur' => 'Mat Id Tur',
            'mat_teste' => 'Mat Teste',
        ];
    }

    /**
     * Gets query for [[MatIdTur]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMatIdTur()
    {
        return $this->hasOne(Turma::class, ['tur_id_tur' => 'mat_id_tur']);
    }

    /**
     * Gets query for [[MateriaisCorrecaos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMateriaisCorrecaos()
    {
        return $this->hasMany(MateriaisCorrecao::class, ['mac_id_mat' => 'mat_id_mat']);
    }
}
