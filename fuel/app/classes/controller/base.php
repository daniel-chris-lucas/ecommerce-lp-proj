<?php

class Controller_Base extends Controller_Template
{

	public $template = 'layouts/template';

	public function before()
	{
		parent::before();
		
		// get user information
		if( Session::get( 'username' ) )
		{
			$this->current_user = Model_User::find( 'first', array(
				'where' => array(
					array( 'username', 'like', Session::get( 'username' ) )
				),
				'related' => array( 'country' )
			));
		}
		else
		{
			$this->current_user = null;
		}

		View::set_global( 'current_user', $this->current_user );		
	}

}