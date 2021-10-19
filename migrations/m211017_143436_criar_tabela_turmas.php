<?php

use yii\db\Migration;

/**
 * Class m211017_143436_criar_tabela_turmas
 */
class m211017_143436_criar_tabela_turmas extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable("turma", [
            "tur_id_tur" => $this->primaryKey(),
            "tur_nom_turma" => $this->string(45),
            "tur_id_pro" => $this->integer(),
        ]);

        $this->addForeignKey("tur_id_pro", "turma", "tur_id_pro", "professores", "pro_id_pro");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable("turma");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211017_143436_criar_tabela_turmas cannot be reverted.\n";

        return false;
    }
    */
}
