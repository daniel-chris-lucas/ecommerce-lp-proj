<?php

namespace Fuel\Migrations;

class Create_images
{
	public function up()
	{
		\DBUtil::create_table('images', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
			'name' => array('constraint' => 255, 'type' => 'varchar'),
			'alt' => array('constraint' => 255, 'type' => 'varchar'),
			'product_id' => array('constraint' => 11, 'type' => 'int'),

		), array('id'), true, false, null, array(
			array(
				'constraint' => 'constImagesProducts',
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
		\DBUtil::drop_table('images');
	}
}