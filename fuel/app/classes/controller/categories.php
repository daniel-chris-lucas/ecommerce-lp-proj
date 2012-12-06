<?php

class Controller_Categories extends Controller_Base
{

	/**
	 * Allow a guest visitor to connect to the site using a username and a password
	 */
	public function action_index()
	{
		$categories = Model_Category::find( 'all', array(
			'where' => array(
				array( 'parent_id', null )
			),
			'order_by' => array( 'name' => 'asc' )
		));
		$this->template->title = 'Categories &raquo; Listing';
		$this->template->content = View::forge('categories/index', array( 'categories' => $categories ) );
	}


	public function action_view( $category_slug )
	{
		$category = Model_Category::find( 'first', array(
			'where' => array(
				array( 'slug', 'like', $category_slug )
			),
		));

		$this->template->title = 'Category &raquo; ' . $category->name;
		$this->template->content = View::forge( 'categories/view', array( 'category' => $category ) );
	}

}
