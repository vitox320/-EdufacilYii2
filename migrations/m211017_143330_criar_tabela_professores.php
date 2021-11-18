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
            "pro_id_usu" => $this->integer()
        ]);

        $this->addForeignKey("pro_id_usu", "professores", "pro_id_usu", "usuarios", "usu_id_usu");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey("pro_id_usu", "professores");
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
