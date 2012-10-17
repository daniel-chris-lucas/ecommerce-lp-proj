<?php

namespace Fuel\Migrations;

class Create_options
{
	public function up()
	{
		\DBUtil::create_table('options', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
			'name' => array('constraint' => 45, 'type' => 'varchar'),
			'value' => array('constraint' => 2, 'type' => 'int'),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('options');
	}
}