<?php

namespace Fuel\Migrations;

class Add_quantity_to_orderproducts
{
	public function up()
	{
		\DBUtil::add_fields('orderproducts', array(
			'quantity' => array('constraint' => 2, 'type' => 'int'),

		));	
	}

	public function down()
	{
		\DBUtil::drop_fields('orderproducts', array(
			'quantity'
    
		));
	}
}