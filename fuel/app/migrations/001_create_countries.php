<?php

namespace Fuel\Migrations;

class Create_countries
{
	public function up()
	{
		\DBUtil::create_table('countries', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
			'name' => array('constraint' => 100, 'type' => 'varchar'),
			'iso' => array('constraint' => 2, 'type' => 'char'),
			'iso3' => array('constraint' => 3, 'type' => 'char'),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('countries');
	}
}