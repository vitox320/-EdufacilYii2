<?php

use yii\db\Migration;

/**
 * Class m211017_143330_criar_tabela_professores
 */
class m211017_143330_criar_tabela_professores extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable("professores", [
            "pro_id_pro" => $this->primaryKey(),
            "pro_nome_professor" => $this->string(45),
            "pro_email_professor" => $this->string(45),
            "pro_senha_professor" => $this->string(220)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable("professores");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211017_143330_criar_tabela_professores cannot be reverted.\n";

        return false;
    }
    */
}
