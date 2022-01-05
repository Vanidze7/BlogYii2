<?php

use yii\db\Migration;

/**
 * Class m220105_163516_addForeignKey
 */
class m220105_163516_addForeignKey extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        //имя информационное, текущая таблица, ее столбик, связываемая таблица, ее столбик, постоянные значения
        $this->addForeignKey('fk_article_to_user', '{{%article}}','user_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_article_to_category', '{{%article}}','category_id', '{{%category}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_comment_to_user', '{{%comment}}','user_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_comment_to_article', '{{%comment}}','article_id', '{{%article}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_article_to_user', '{{%article}}');
        $this->dropForeignKey('fk_article_to_category', '{{%article}}');
        $this->dropForeignKey('fk_comment_to_user', '{{%comment}}');
        $this->dropForeignKey('fk_comment_to_article', '{{%comment}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220105_163516_addForeignKey cannot be reverted.\n";

        return false;
    }
    */
}
