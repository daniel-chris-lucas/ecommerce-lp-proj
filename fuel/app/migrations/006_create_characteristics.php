<?php

namespace Fuel\Migrations;

class Create_characteristics
{
	public function up()
	{
		\DBUtil::create_table('characteristics', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
			'name' => array('constraint' => 50, 'type' => 'varchar'),
			'value' => array('constraint' => 50, 'type' => 'varchar'),
			'product_id' => array('constraint' => 11, 'type' => 'int'),

		), array('id'), true, false, null, array(
			array(
				'constraint' => 'constCharacteristicsProducts',
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
		\DBUtil::drop_table('characteristics');
	}
}