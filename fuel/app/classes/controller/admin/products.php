<?php

class Controller_Admin_Products extends Controller_Admin_Base
{

	public function action_index()
	{
		$products = Model_Product::find( 'all' );

		$submenus = array(
			array( 'name' =>'Add New', 'link' => 'admin/products/create', 'class' => 'menu_icons')
		);
		View::set_global( 'submenus', $submenus );

		$this->template->title = 'Admin &raquo; Products';
		$this->template->content = View::forge('admin/products/index', array(
			'products' => $products
		));
	}


	public function action_create()
	{
		$val = Validation::forge();

		$val->add( 'name', 'Name' )
			->add_rule( 'required' )
			->add_rule( 'min_length', 3 )
			->add_rule( 'max_length', 255 );
		$val->add( 'description', 'Description' )
			->add_rule( 'required' )
			->add_rule( 'min_length', 10 )
			->add_rule( 'max_length', 1000 );
		$val->add( 'category', 'Category' )
			->add_rule( 'numeric_min', 1 );
		$val->add( 'price', 'Price' )
			->add( 'numeric_min', 1 );

		if( Input::method() == 'POST' && $val->run() )
		{
			$product = Model_Product::forge();
			$product->name = $val->validated( 'name' );
			$product->description = $val->validated( 'description' );
			$product->category_id = $val->validated( 'category' );
			$product->price = $val->validated( 'price' );
			$product->save();

			Session::set_flash( 'flash_message', 'New product has been successfully added' );
			Response::redirect( 'admin/products' );
		}


		$categories = Model_Category::find( 'all', array(
			'order_by' => array( 'name' => 'asc' )
		));

		$this->template->title = 'Admin &raquo; Products &raquo; Create';
		$this->template->content = View::forge('admin/products/create', array(
			'categories' => $categories
		));
	}

}