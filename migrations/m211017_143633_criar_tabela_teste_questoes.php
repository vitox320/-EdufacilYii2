<?php

use yii\db\Migration;

/**
 * Class m211017_143633_criar_tabela_teste_questoes
 */
class m211017_143633_criar_tabela_teste_questoes extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable("teste_questoes", [
            "tqu_id_tqu" => $this->primaryKey(),
            "tqu_alternativa" => $this->text(),
            "tqu_gabaritos" => $this->char("2"),
            "tqu_id_enu" => $this->integer()
        ]);

        $this->addForeignKey("tqu_id_enu", "teste_questoes", "tqu_id_enu", "enunciados", "enu_id_enu");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey("tqu_id_enu", "teste_questoes");
        $this->dropTable("teste_questoes");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211017_143633_criar_tabela_teste_questoes cannot be reverted.\n";

        return false;
    }
    */
}
