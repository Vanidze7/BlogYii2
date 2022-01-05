<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%article}}`.
 */
class m220105_154323_create_article_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%article}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'text' => $this->string(),
            'views' => $this->tinyInteger()->unsigned(),
            'img' => $this->string(),
            'created' => $this->integer()->unsigned(),
            'updated' => $this->integer()->unsigned(),
            'user_id' => $this->integer()->notNull(),
            'category_id' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%article}}');
    }
}
