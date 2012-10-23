<?php

namespace Fuel\Migrations;

class Create_orderproducts
{
	public function up()
	{
		\DBUtil::create_table('orderproducts', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
			'name' => array('constraint' => 255, 'type' => 'varchar'),
			'price' => array('type' => 'float'),
			'order_id' => array('constraint' => 11, 'type' => 'int'),
			'created_at' => array('constraint' => 11, 'type' => 'int'),
			'updated_at' => array('constraint' => 11, 'type' => 'int'),

		), array('id'), true, false, null, array(
			array(
				'constraint' => 'constOrderproductsOrders',
				'key' => 'order_id',
				'reference' => array(
					'table' => 'orders',
					'column' => 'id',
				),
				'on_update' => 'CASCADE',
				'on_delete' => 'RESTRICT'
			),
		));
	}

	public function down()
	{
		\DBUtil::drop_table('orderproducts');
	}
}