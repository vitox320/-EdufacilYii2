<?php

use yii\db\Migration;

/**
 * Class m211017_143553_criar_tabela_testes
 */
class m211017_143553_criar_tabela_testes extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable("testes", [
            "tes_id_tes" => $this->primaryKey(),
            "tes_nome_teste" => $this->string(45),
            "tes_id_tur" => $this->integer(),
            "tes_valor_teste" => $this->float(),
            "tes_unidade_teste" => $this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable("testes");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211017_143553_criar_tabela_testes cannot be reverted.\n";

        return false;
    }
    */
}
