<?php

namespace Fuel\Migrations;

class Create_categories
{
	public function up()
	{
		\DBUtil::create_table('categories', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
			'name' => array('constraint' => 25, 'type' => 'varchar'),
			'parent_id' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'), true, false, null, array(
			array(
				'constraint' => 'constCategories',
				'key' => 'parent_id',
				'reference' => array(
					'table' => 'categories',
					'column' => 'id',
				),
				'on_update' => 'CASCADE',
				'on_delete' => 'RESTRICT'
			),
		));
	}

	public function down()
	{
		\DBUtil::drop_table('categories');
	}
}