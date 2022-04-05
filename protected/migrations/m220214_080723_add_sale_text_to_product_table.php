<?php

class m220214_080723_add_sale_text_to_product_table extends CDbMigration
{
	public function up()
	{
		$this->addColumn('product', 'sale_text', 'string AFTER sale');
	}

	public function down()
	{
		$this->dropColumn('product', 'sale_text');
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}