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

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('characteristics');
	}
}