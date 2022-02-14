<?php

use yii\db\Migration;

/**
 * Class m220214_102041_update_comment_table
 */
class m220214_102041_update_comment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%comment}}', 'status', $this->tinyInteger()->defaultValue('1'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%comment}}', 'status');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220214_102041_update_comment_table cannot be reverted.\n";

        return false;
    }
    */
}
