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
            "tqu_enunciado" => $this->text(),
            "tqu_alternativa"=> $this->text(),
            "tqu_gabaritos" => $this->char("2"),
            "tqu_valor" => $this->float(),
            "tqu_id_tes" => $this->integer()
        ]);
        $this->addForeignKey("tqu_id_tes","teste_questoes","tqu_id_tes","testes","tes_id_tes");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey("tqu_id_tes","teste_questoes");
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
