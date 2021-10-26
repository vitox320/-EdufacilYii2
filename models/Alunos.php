<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "alunos".
 *
 * @property int $alu_id_alu
 * @property string|null $alu_nome_alunos
 * @property string|null $alu_email_alunos
 * @property string|null $alu_senha_alunos
 * @property int|null $alu_id_tur
 * @property int|null $alu_id_pro
 *
 * @property Professores $aluIdPro
 * @property Turma $aluIdTur
 * @property MateriaisCorrecao[] $materiaisCorrecaos
 * @property Notas[] $notas
 */
class Alunos extends \yii\db\ActiveRecord implements IdentityInterface
{

    /**
     * @var mixed|null
     */
    public $auth_key;

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
            [['alu_id_tur', 'alu_id_pro'], 'integer'],
            [['alu_nome_alunos', 'alu_email_alunos'], 'string', 'max' => 45],
            [['alu_senha_alunos'], 'string', 'max' => 220],
            [['alu_id_pro'], 'exist', 'skipOnError' => true, 'targetClass' => Professores::class, 'targetAttribute' => ['alu_id_pro' => 'pro_id_pro']],
            [['alu_id_tur'], 'exist', 'skipOnError' => true, 'targetClass' => Turma::class, 'targetAttribute' => ['alu_id_tur' => 'tur_id_tur']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'alu_id_alu' => 'Alu Id Alu',
            'alu_nome_alunos' => 'Alu Nome Alunos',
            'alu_email_alunos' => 'Alu Email Alunos',
            'alu_senha_alunos' => 'Alu Senha Alunos',
            'alu_id_tur' => 'Alu Id Tur',
            'alu_id_pro' => 'Alu Id Pro',
        ];
    }

    /**
     * Gets query for [[AluIdPro]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAluIdPro()
    {
        return $this->hasOne(Professores::class, ['pro_id_pro' => 'alu_id_pro']);
    }

    /**
     * Gets query for [[AluIdTur]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAluIdTur()
    {
        return $this->hasOne(Turma::class, ['tur_id_tur' => 'alu_id_tur']);
    }

    /**
     * Gets query for [[MateriaisCorrecaos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMateriaisCorrecaos()
    {
        return $this->hasMany(MateriaisCorrecao::class, ['mac_id_alu' => 'alu_id_alu']);
    }

    /**
     * Gets query for [[Notas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNotas()
    {

        return $this->hasMany(Notas::class, ['not_id_alu' => 'alu_id_alu']);
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * Finds an identity by the given token.
     *
     * @param string $token the token to be looked for
     * @return IdentityInterface|null the identity object that matches the given token.
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * @return int|string current user ID
     */
    public function getId()
    {
        return $this->alu_id_alu;
    }

    /**
     * @return string|null current user auth key
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }


    /**
     * @param string $authKey
     * @return bool|null if auth key is valid for current user
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

}
