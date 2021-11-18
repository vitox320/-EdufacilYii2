<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "usuarios".
 *
 * @property int $usu_id_usu
 * @property string|null $usu_nom_usuario
 * @property string|null $usu_email_usuario
 * @property string|null $usu_senha_usuario
 *
 * @property Alunos[] $alunos
 * @property Professores[] $professores
 */
class Usuarios extends \yii\db\ActiveRecord implements IdentityInterface
{
    public $primaryKey = 'usu_id_usu';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usuarios';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //[['usu_nom_usuario', 'usu_email_usuario'], 'required', 'max' => 45],
            [['usu_nom_usuario', 'usu_email_usuario'], 'string', 'max' => 45],
            [['usu_senha_usuario'], 'string', 'max' => 220],
            [['usu_email_usuario'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'usu_id_usu' => 'Usu Id Usu',
            'usu_nom_usuario' => 'Usu Nom Usuario',
            'usu_email_usuario' => 'Usu Email Usuario',
            'usu_senha_usuario' => 'Usu Senha Usuario',
        ];
    }

    /**
     * Gets query for [[Alunos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlunos()
    {
        return $this->hasMany(Alunos::className(), ['alu_id_usu' => 'usu_id_usu']);
    }

    /**
     * Gets query for [[Professores]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfessores()
    {
        return $this->hasMany(Professores::className(), ['pro_id_usu' => 'usu_id_usu']);
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        //Implement findIdentityByAccessToken() method.
    }

    public function getId()
    {
        return $this->usu_id_usu;
    }

    public function getAuthKey()
    {
        //Implement getAuthKey() method.
    }

    public function validateAuthKey($authKey)
    {
        //Implement validateAuthKey() method.
    }
}
