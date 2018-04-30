<?php

use yii\db\Migration;

/**
 * Handles the creation of table `post_news`.
 * Has foreign keys to the tables:
 *
 * - `post`
 * - `news`
 */
class m180419_130930_create_junction_table_for_post_and_news_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('post_news', [
            'post_id' => $this->integer(),
            'news_id' => $this->integer(),
            'created_at' => $this->datetime(),
            'PRIMARY KEY(post_id, news_id)',
        ]);

        // creates index for column `post_id`
        $this->createIndex(
            'idx-post_news-post_id',
            'post_news',
            'post_id'
        );

        // add foreign key for table `post`
        $this->addForeignKey(
            'fk-post_news-post_id',
            'post_news',
            'post_id',
            'post',
            'id',
            'CASCADE'
        );

        // creates index for column `news_id`
        $this->createIndex(
            'idx-post_news-news_id',
            'post_news',
            'news_id'
        );

        // add foreign key for table `news`
        $this->addForeignKey(
            'fk-post_news-news_id',
            'post_news',
            'news_id',
            'news',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `post`
        $this->dropForeignKey(
            'fk-post_news-post_id',
            'post_news'
        );

        // drops index for column `post_id`
        $this->dropIndex(
            'idx-post_news-post_id',
            'post_news'
        );

        // drops foreign key for table `news`
        $this->dropForeignKey(
            'fk-post_news-news_id',
            'post_news'
        );

        // drops index for column `news_id`
        $this->dropIndex(
            'idx-post_news-news_id',
            'post_news'
        );

        $this->dropTable('post_news');
    }
}
