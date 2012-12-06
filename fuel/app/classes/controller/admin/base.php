<?php

class Controller_Admin_Base extends Controller_Template
{

	public $template = 'layouts/admin-template';

	public function before()
	{
		parent::before();

		$moderator_id = Model_Role::find( 'first', array(
			'where' => array(
				array( 'name', 'like', 'moderator' )
			)
		))['id'];
		$admin_id = Model_Role::find( 'first', array(
			'where' => array(
				array( 'name', 'like', 'administrator' )
			)
		))['id'];

		$menu_items = array(
	        'Dashboard' => 'admin/dashboard',
	        'Users' => 'admin/users',
	        'Categories' => 'admin/categories',
	        'Products' => 'admin/products',
	        'Countries' => 'admin/countries',
	        'Orders' => 'admin/orders'
		);
		
		// get user information
		if( Session::get( 'username' ) )
		{
			$this->current_user = Model_User::find( 'first', array(
				'where' => array(
					array( 'username', 'like', Session::get( 'username' ) )
				)
			));

			// check if the user has admin priviledges
			if( $this->current_user->role_id != $moderator_id && $this->current_user->role_id != $admin_id )
			{
				Response::redirect( Uri::base() );
			}
		}
		else
		{
			Response::redirect( Uri::base() );
		}

		View::set_global( 'current_user', $this->current_user );
		View::set_global( 'menu_items', $menu_items );		
	}

}