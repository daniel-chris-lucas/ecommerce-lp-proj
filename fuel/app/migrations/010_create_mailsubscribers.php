<?php

namespace Fuel\Migrations;

class Create_mailsubscribers
{
	public function up()
	{
		\DBUtil::create_table('mailsubscribers', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
			'user_id' => array('constraint' => 11, 'type' => 'int'),

		), array('id'), true, false, null, array(
			array(
				'constraint' => 'constSubscribersUsers',
				'key' => 'user_id',
				'reference' => array(
					'table' => 'users',
					'column' => 'id',
				),
				'on_update' => 'CASCADE',
				'on_delete' => 'RESTRICT'
			),
		));
	}

	public function down()
	{
		\DBUtil::drop_table('mailsubscribers');
	}
}