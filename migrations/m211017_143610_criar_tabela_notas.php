<?php

use yii\db\Migration;

/**
 * Class m211017_143610_criar_tabela_notas
 */
class m211017_143610_criar_tabela_notas extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable("notas", [
            "not_id_not" => $this->primaryKey(),
            "not_id_tes" => $this->integer(),
            "not_id_alu" => $this->integer(),
            "not_valor_nota" => $this->float()
        ]);

        $this->addForeignKey("not_id_tes", "notas", "not_id_tes", "testes", "tes_id_tes");
        $this->addForeignKey("not_id_alu", "notas", "not_id_alu", "alunos", "alu_id_alu");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey("not_id_tes", "not_notas");
        $this->dropForeignKey("not_id_alu", "not_notas");
        $this->dropTable("notas");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211017_143610_criar_tabela_notas cannot be reverted.\n";

        return false;
    }
    */
}
