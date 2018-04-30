<?php

use yii\db\Migration;

/**
 * Handles the dropping of table `post`.
 */
class m180419_124214_drop_post_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropTable('post');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->createTable('post', [
            'id' => $this->primaryKey(),
            'title' => $this->string(12)->notnull()->nuique(),
            'body' => $this->text(),
        ]);
    }
}
