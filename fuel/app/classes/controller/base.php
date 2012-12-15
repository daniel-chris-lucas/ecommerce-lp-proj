<?php

class Controller_Base extends Controller_Template
{

	public $template = 'layouts/template';

	public function before()
	{
		parent::before();

		$this->moderator_id = Model_Role::find( 'first', array(
			'where' => array(
				array( 'name', 'like', 'moderator' )
			)
		));
		$this->moderator_id = $this->moderator_id['id'];
		$this->admin_id = Model_Role::find( 'first', array(
			'where' => array(
				array( 'name', 'like', 'administrator' )
			)
		));
		$this->admin_id = $this->admin_id['id'];

		$this->main_categories = Model_Category::generate_categories_subcategories();

		$this->newCategories = array();
		foreach( $this->main_categories as $main_category )
		{
		    $this->newCategories[ $main_category['parent_name']][] = array(
		        'child_name' => $main_category['child1_name'],
		        'child_slug' => $main_category['child1_slug'],
		        'parent_slug' => $main_category['parent_slug']
		    );
		}
		
		// get user information
		if( Session::get( 'username' ) )
		{
			$this->current_user = Model_User::find( 'first', array(
				'where' => array(
					array( 'username', 'like', Session::get( 'username' ) )
				)
			));
		}
		else
		{
			$this->current_user = null;
		}

		if( Uri::segment( 1 ) != 'products' || Uri::segment( 2 ) != 'view' )
		{
			$cart_total = 0;
			if( Session::get( 'cart_products' ) )
			{
				foreach( Session::get( 'cart_products' ) as $cart_product )
				{
					$cart_total += ( $cart_product['price'] * $cart_product['quantity'] );
				}
			}
			View::set_global( 'cart_total', $cart_total );
		}

		View::set_global( 'current_user', $this->current_user );
		View::set_global( 'moderator_id', $this->moderator_id );
		View::set_global( 'admin_id', $this->admin_id );
		View::set_global( 'main_categories', $this->newCategories );
	}

}