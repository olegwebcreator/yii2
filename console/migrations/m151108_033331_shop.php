<?php

use yii\db\Schema;
use yii\db\Migration;

class m151108_033331_shop extends Migration
{
	public function up()
    {
    	$tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%gsmset_category}}', [
            'id' => Schema::TYPE_PK,
            'parent_id' => Schema::TYPE_INTEGER,
            'title' => Schema::TYPE_STRING,
            'slug' => Schema::TYPE_STRING,
        ], $tableOptions);

        $this->addForeignKey('fk-gsmset_category-parent_id-gsmset_category-id', '{{%gsmset_category}}', 'parent_id', '{{%gsmset_category}}', 'id', 'CASCADE');

        $this->createTable('{{%gsmset_catalog_products}}', [
            'id' => Schema::TYPE_PK,
            'title' => Schema::TYPE_STRING,
            'slug' => Schema::TYPE_STRING,
            'description' => Schema::TYPE_TEXT,
            'category_id' => Schema::TYPE_INTEGER,
            'price' => Schema::TYPE_MONEY,
        ], $tableOptions);

        $this->addForeignKey('fk-gsmset_catalog_products-category_id-category_id', '{{%gsmset_catalog_products}}', 'category_id', '{{%gsmset_category}}', 'id', 'RESTRICT');

        $this->createTable('{{%gsmset_catalog_product_image}}', [
            'id' => Schema::TYPE_PK,
            'product_id' => Schema::TYPE_INTEGER,
        ], $tableOptions);

        $this->addForeignKey('fk-gsmset_catalog_product_image-product_id-product_id', '{{%gsmset_catalog_product_image}}', 'product_id', '{{%gsmset_catalog_products}}', 'id', 'SET NULL');

        $this->createTable('{{%gsmset_orders_customers}}', [
            'id' => Schema::TYPE_PK,
            'created_at' => Schema::TYPE_INTEGER,
            'updated_at' => Schema::TYPE_INTEGER,
            'phone' => Schema::TYPE_STRING,
            'address' => Schema::TYPE_TEXT,
            'email' => Schema::TYPE_STRING,
            'notes' => Schema::TYPE_TEXT,
            'status' => Schema::TYPE_STRING,
        ], $tableOptions);

        $this->createTable('{{%gsmset_orders_products}}', [
            'id' => Schema::TYPE_PK,
            'order_id' => Schema::TYPE_INTEGER,
            'title' => Schema::TYPE_STRING,
            'price' => Schema::TYPE_MONEY,
            'product_id' => Schema::TYPE_INTEGER,
            'quantity' => Schema::TYPE_FLOAT,
        ], $tableOptions);

        $this->addForeignKey('fk-gsmset_orders_products-order_id-order-id', '{{%gsmset_orders_products}}', 'order_id', '{{%gsmset_orders_customers}}', 'id', 'CASCADE');
        $this->addForeignKey('fk-gsmset_orders_products-product_id-product-id', '{{%gsmset_orders_products}}', 'product_id', '{{%gsmset_catalog_products}}', 'id', 'SET NULL');
    }

    public function down()
    {
        $this->dropTable('{{%gsmset_orders_products}}');
        $this->dropTable('{{%gsmset_orders_customers}}');
        $this->dropTable('{{%gsmset_catalog_product_image}}');
        $this->dropTable('{{%gsmset_catalog_products}}');
        $this->dropTable('{{%gsmset_category}}');
    }
}
