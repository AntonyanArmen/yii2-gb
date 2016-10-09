<?php

use yii\db\Migration;

class m161002_161415_tweet_publish extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%tweets}}','publish_timestamp',$this->timestamp());
    }

    public function safeDown()
    {
        $this->dropColumn('{{%tweets}}','publish_timestamp');
    }
}
