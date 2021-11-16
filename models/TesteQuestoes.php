<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "teste_questoes".
 *
 * @property int $tqu_id_tqu
 * @property string|null $tqu_alternativa
 * @property string|null $tqu_gabaritos
 * @property int|null $tqu_id_enu
 *
 * @property Enunciados $tquIdEnu
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
            [['tqu_alternativa'], 'string'],
            [['tqu_id_enu'], 'integer'],
            [['tqu_gabaritos'], 'string', 'max' => 2],
            [['tqu_id_enu'], 'exist', 'skipOnError' => true, 'targetClass' => Enunciados::className(), 'targetAttribute' => ['tqu_id_enu' => 'enu_id_enu']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'tqu_id_tqu' => 'Tqu Id Tqu',
            'tqu_alternativa' => 'Tqu Alternativa',
            'tqu_gabaritos' => 'Tqu Gabaritos',
            'tqu_id_enu' => 'Tqu Id Enu',
        ];
    }

    /**
     * Gets query for [[TquIdEnu]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTquIdEnu()
    {
        return $this->hasOne(Enunciados::className(), ['enu_id_enu' => 'tqu_id_enu']);
    }
}
