<?php

namespace Fuel\Migrations;

class Add_slug_to_products
{
	public function up()
	{
		\DBUtil::add_fields('products', array(
			'slug' => array('constraint' => 100, 'type' => 'varchar'),

		));	
	}

	public function down()
	{
		\DBUtil::drop_fields('products', array(
			'slug'
    
		));
	}
}