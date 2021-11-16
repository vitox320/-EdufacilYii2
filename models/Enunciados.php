<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "enunciados".
 *
 * @property int $enu_id_enu
 * @property string|null $enu_nom_enunciado
 * @property float|null $enu_valor
 * @property int|null $enu_id_tes
 *
 * @property Testes $enuIdTes
 * @property TesteQuestoes[] $testeQuestoes
 */
class Enunciados extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'enunciados';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['enu_nom_enunciado'], 'string'],
            [['enu_valor'], 'number'],
            [['enu_id_tes'], 'integer'],
            [['enu_id_tes'], 'exist', 'skipOnError' => true, 'targetClass' => Testes::className(), 'targetAttribute' => ['enu_id_tes' => 'tes_id_tes']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'enu_id_enu' => 'Id Enunciado',
            'enu_nom_enunciado' => 'Nome Enunciado',
            'enu_valor' => 'Valor',
            'enu_id_tes' => 'Testes',
        ];
    }

    /**
     * Gets query for [[EnuIdTes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEnuIdTes()
    {
        return $this->hasOne(Testes::className(), ['tes_id_tes' => 'enu_id_tes']);
    }

    /**
     * Gets query for [[TesteQuestoes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTesteQuestoes()
    {
        return $this->hasMany(TesteQuestoes::className(), ['tqu_id_enu' => 'enu_id_enu']);
    }
}
