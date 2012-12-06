<?php

namespace Fuel\Migrations;

class Add_slug_to_categories
{
	public function up()
	{
		\DBUtil::add_fields('categories', array(
			'slug' => array('constraint' => 30, 'type' => 'varchar'),

		));	
	}

	public function down()
	{
		\DBUtil::drop_fields('categories', array(
			'slug'
    
		));
	}
}