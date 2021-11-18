<?php

use yii\db\Migration;

/**
 * Class m211017142351_criar_tabela_usuarios
 */
class m211017_142351_criar_tabela_usuarios extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('usuarios', [
            'usu_id_usu' => $this->primaryKey(),
            'usu_nom_usuario' => $this->string(45),
            'usu_email_usuario' => $this->string(45)->unique(),
            'usu_senha_usuario' => $this->string(220)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable("usuarios");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211017142351_criar_tabela_usuarios cannot be reverted.\n";

        return false;
    }
    */
}
