<?php

namespace Fuel\Migrations;

class Create_users
{
	public function up()
	{
		\DBUtil::create_table('users', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
			'username' => array('constraint' => 15, 'type' => 'varchar'),
			'password' => array('constraint' => 100, 'type' => 'varchar'),
			'first_name' => array('constraint' => 25, 'type' => 'varchar'),
			'last_name' => array('constraint' => 25, 'type' => 'varchar'),
			'date_of_birth' => array('constraint' => 10, 'type' => 'varchar'),
			'street' => array('constraint' => 50, 'type' => 'varchar'),
			'street_number' => array('constraint' => 3, 'type' => 'int', 'null' => true),
			'town' => array('constraint' => 50, 'type' => 'varchar'),
			'country_id' => array('constraint' => 3, 'type' => 'int'),
			'tel' => array('constraint' => 20, 'type' => 'varchar', 'null' => true),
			'email' => array('constraint' => 45, 'type' => 'varchar'),
			'role_id' => array('constraint' => 2, 'type' => 'int', 'default' => 1),
			'confirmation_code' => array('constraint' => 16, 'type' => 'varchar'),
			'activated' => array('type' => 'boolean', 'null', true, 'default' => 0),
			'created_at' => array('constraint' => 11, 'type' => 'int'),
			'updated_at' => array('constraint' => 11, 'type' => 'int'),

		), array('id'), true, false, null, array(
			array(
				'constraint' => 'constUsersCountries',
				'key' => 'country_id',
				'reference' => array(
					'table' => 'countries',
					'column' => 'id',
				),
				'on_update' => 'CASCADE',
				'on_delete' => 'RESTRICT'
			),
			array(
				'constraint' => 'constUsersRoles',
				'key' => 'role_id',
				'reference' => array(
					'table' => 'roles',
					'column' => 'id',
				),
				'on_update' => 'CASCADE',
				'on_delete' => 'RESTRICT'
			),
		));
	}

	public function down()
	{
		\DBUtil::drop_table('users');
	}
}