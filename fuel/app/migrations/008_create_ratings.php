<?php

namespace Fuel\Migrations;

class Create_ratings
{
	public function up()
	{
		\DBUtil::create_table('ratings', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
			'user_id' => array('constraint' => 11, 'type' => 'int'),
			'product_id' => array('constraint' => 11, 'type' => 'int'),
			'note' => array('constraint' => 2, 'type' => 'int'),
			'description' => array('type' => 'text'),
			'created_at' => array('constraint' => 11, 'type' => 'int'),
			'updated_at' => array('constraint' => 11, 'type' => 'int'),

		), array('id'), true, false, null, array(
			array(
				'constraint' => 'constRatingsUsers',
				'key' => 'user_id',
				'reference' => array(
					'table' => 'users',
					'column' => 'id',
				),
				'on_update' => 'CASCADE',
				'on_delete' => 'RESTRICT'
			),
			array(
				'constraint' => 'constRatingsProducts',
				'key' => 'product_id',
				'reference' => array(
					'table' => 'products',
					'column' => 'id',
				),
				'on_update' => 'CASCADE',
				'on_delete' => 'RESTRICT'
			),
		));
	}

	public function down()
	{
		\DBUtil::drop_table('ratings');
	}
}