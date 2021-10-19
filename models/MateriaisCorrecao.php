<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "materiais_correcao".
 *
 * @property int $mac_id_mac
 * @property int|null $mac_id_alu
 * @property int|null $mac_id_mat
 *
 * @property Alunos $macIdAlu
 * @property Materiais $macIdMat
 */
class MateriaisCorrecao extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'materiais_correcao';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mac_id_alu', 'mac_id_mat'], 'integer'],
            [['mac_id_alu'], 'exist', 'skipOnError' => true, 'targetClass' => Alunos::className(), 'targetAttribute' => ['mac_id_alu' => 'alu_id_alu']],
            [['mac_id_mat'], 'exist', 'skipOnError' => true, 'targetClass' => Materiais::className(), 'targetAttribute' => ['mac_id_mat' => 'mat_id_mat']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'mac_id_mac' => 'Mac Id Mac',
            'mac_id_alu' => 'Mac Id Alu',
            'mac_id_mat' => 'Mac Id Mat',
        ];
    }

    /**
     * Gets query for [[MacIdAlu]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMacIdAlu()
    {
        return $this->hasOne(Alunos::className(), ['alu_id_alu' => 'mac_id_alu']);
    }

    /**
     * Gets query for [[MacIdMat]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMacIdMat()
    {
        return $this->hasOne(Materiais::className(), ['mat_id_mat' => 'mac_id_mat']);
    }
}
