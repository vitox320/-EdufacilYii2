<?php

use yii\db\Migration;

/**
 * Class m211121_160346_criar_aluno_turma
 */
class m211121_160346_criar_aluno_turma extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable("aluno_turma", [
            "atu_id_atu" => $this->primaryKey(),
            "atu_id_alu" => $this->integer(),
            "atu_id_tur" => $this->integer()
        ]);
        $this->addForeignKey("atu_id_alu", "aluno_turma", "atu_id_alu", "alunos", "alu_id_alu");
        $this->addForeignKey("atu_id_tur", "aluno_turma", "atu_id_tur", "turma", "tur_id_tur");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable("aluno_turma");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211121_160346_criar_aluno_turma cannot be reverted.\n";

        return false;
    }
    */
}
