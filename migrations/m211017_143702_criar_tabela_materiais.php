<?php

use yii\db\Migration;

/**
 * Class m211017_143702_criar_tabela_materiais
 */
class m211017_143702_criar_tabela_materiais extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable("materiais", [
            "mat_id_mat" => $this->primaryKey(),
            "mat_tiulo" => $this->string(45),
            "mat_link" => $this->string(45),
            "mat_dat_cadastro" => $this->dateTime(),
            "mat_id_tur" => $this->integer(),
            "mat_teste" => $this->boolean()
        ]);
        $this->addForeignKey("mat_id_tur","materiais","mat_id_tur","turma","tur_id_tur");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey("mat_id_tur","materiais");
        $this->dropTable("materiais");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211017_143702_criar_tabela_materiais cannot be reverted.\n";

        return false;
    }
    */
}
