<?php

use yii\db\Migration;

/**
 * Class m211017_143519_criar_tabela_alunos
 */
class m211017_143519_criar_tabela_alunos extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable("alunos", [
            "alu_id_alu" => $this->primaryKey(),
            "alu_id_tur" => $this->integer()->null(),
            "alu_id_pro" => $this->integer()->null(),
            "alu_id_usu" => $this->integer()
        ]);
        $this->addForeignKey("alu_id_usu", "alunos", "alu_id_usu", "usuarios", "usu_id_usu");
        $this->addForeignKey("alu_id_tur", "alunos", "alu_id_tur", "turma", "tur_id_tur");
        $this->addForeignKey("alu_id_pro", "alunos", "alu_id_pro", "professores", "pro_id_pro");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable("alunos");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211017_143519_criar_tabela_alunos cannot be reverted.\n";

        return false;
    }
    */
}
