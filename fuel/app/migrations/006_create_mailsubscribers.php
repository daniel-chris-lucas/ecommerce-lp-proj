<?php

namespace Fuel\Migrations;

class Create_mailsubscribers
{
	public function up()
	{
		\DBUtil::create_table('mailsubscribers', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
			'user_id' => array('constraint' => 11, 'type' => 'int'),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('mailsubscribers');
	}
}