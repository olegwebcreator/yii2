<?php

use yii\db\Schema;
use yii\db\Migration;

class m151113_211749_category extends Migration
{
    public function up()
    {
    	$tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }


        $this->createTable('{{%gsmset_category_image}}', [
            'id' => Schema::TYPE_PK,
            'category_id' => Schema::TYPE_INTEGER,
        ], $tableOptions);

        $this->addForeignKey('fk-gsmset_category_image-category_id-category_id', '{{%gsmset_category_image}}', 'category_id', '{{%gsmset_category}}', 'id', 'SET NULL');

        
    }

    public function down()
    {
        $this->dropTable('{{%gsmset_category_image}}');
    }
}
