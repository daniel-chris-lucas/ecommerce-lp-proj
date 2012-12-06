<?php

namespace Fuel\Migrations;

class Add_folder_to_images
{
	public function up()
	{
		\DBUtil::add_fields('images', array(
			'folder' => array('constraint' => 50, 'type' => 'varchar'),

		));	
	}

	public function down()
	{
		\DBUtil::drop_fields('images', array(
			'folder'
    
		));
	}
}