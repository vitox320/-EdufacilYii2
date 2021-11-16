<?php

use yii\db\Migration;

/**
 * Class m211017_143625_criar_tablea_enunciados
 */
class m211017_143625_criar_tablea_enunciados extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable("enunciados", [
            "enu_id_enu" => $this->primaryKey(),
            "enu_nom_enunciado" => $this->text(),
            "enu_valor" => $this->float(),
            "enu_id_tes" => $this->integer()
        ]);
        $this->addForeignKey("enu_id_tes", "enunciados", "enu_id_tes", "testes", "tes_id_tes");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey("enu_id_tes", "enunciados");
        $this->dropTable("enunciados");

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211017_143625_criar_tablea_enunciados cannot be reverted.\n";

        return false;
    }
    */
}
