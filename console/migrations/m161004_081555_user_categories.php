<?php

use yii\db\Migration;

class m161004_081555_user_categories extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%userCategory}}', [
            'id' => $this->primaryKey(),
            'value' => $this->integer()->notNull(),
            'description' => $this->string(10),
        ], $tableOptions);

        $this->insert('{{%userCategory}}',[
            'value' => '1',
            'description' => 'Admin'
        ]);

        $this->insert('{{%userCategory}}',[
            'value' => '2',
            'description' => 'User'
        ]);

        $this->addColumn('{{%user}}','category_id',$this->integer());

        $this->update('{{%user}}', ['category_id' => '1'], ['username' => 'admin']);

        $this->createIndex('user_userCategory','{{%user}}','category_id');
        $this->addForeignKey('FK_user_userCategory','{{%user}}','category_id','{{%userCategory}}','id');
    }

    public function safeDown()
    {
        $this->dropForeignKey('FK_user_userCategory','{{%user}}');
        $this->dropColumn('{{%user}}','category_id');
        $this->dropTable('{{%userCategory}}');
    }
}
