<?php

use yii\db\Migration;

/**
 * Class m211017_143705_criar_tabela_material_correcao
 */
class m211017_143705_criar_tabela_material_correcao extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable("materiais_correcao", [
            "mac_id_mac" => $this->primaryKey(),
            "mac_id_alu" => $this->integer(),
            "mac_id_mat" => $this->integer()
        ]);

        $this->addForeignKey("mac_id_alu","materiais_correcao","mac_id_alu","alunos","alu_id_alu");
        $this->addForeignKey("mac_id_mat","materiais_correcao","mac_id_mat","materiais","mat_id_mat");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey("mac_id_alu","materiais_correcao");
        $this->dropForeignKey("mac_id_alu","materiais_correcao");
        $this->dropTable("mac_materiais_correcao");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211017_143705_criar_tabela_material_correcao cannot be reverted.\n";

        return false;
    }
    */
}
