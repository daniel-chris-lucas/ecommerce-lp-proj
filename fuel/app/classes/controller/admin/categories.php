<?php

class Controller_Admin_Categories extends Controller_Admin_Base
{

	public function action_index()
	{
		$num_categories = Model_Category::count_categories();

		$config = array(
			'pagination_url' => Uri::create( 'admin/categories/index' ),
			'total_items' => $num_categories,
			'per_page' => 8,
			'uri_segment' => 4,
			'template' => array(
				'wrapper_start' => '<div class="pagination pagination-right"><ul>',
				'wrapper_end' => '</ul></div>',
				'page_start' => '',
				'page_end' => '',
				'regular_start' => '<li>',
				'regular_end' => '</li>',
				'active_start' => '<li class="active">',
				'active_end' => '</li>',
				'previous_start' => '<li>',
				'previous_end' => '</li>',
				'next_start' => '<li>',
				'next_end' => '</li>',
				'previous_inactive_start' => '<li class="disabled">',
				'previous_inactive_end' => '</li>',
				'next_inactive_start' => '<li class="disabled">',
				'next_inactive_end' => '</li>'
			),
		);

		Pagination::set_config( $config );
		$categories = Model_Category::find()
						->limit( Pagination::$per_page )
						->offset( Pagination::$offset )
						->order_by( 'name', 'asc' )
						->get();

		$submenus = array(
			array( 'name' =>'Add New', 'link' => 'admin/categories/create', 'class' => 'menu_icons')
		);
		View::set_global( 'submenus', $submenus );

		$this->template->title = 'Admin &raquo; Categories';
		$this->template->content = View::forge( 'admin/categories/index', array(
			'categories' => $categories
		));
	}


	public function action_create()
	{
		$val = Validation::forge();

		$val->add( 'name', 'Name' )
			->add_rule( 'required' )
			->add_rule( 'min_length', 3 )
			->add_rule( 'max_length', 25 );
		$val->add( 'parent', 'Parent Category' )
			->add_rule( 'numeric_min', 1 )
			->add_rule( 'numeric_max', 1000 );

		if( Input::method() == 'POST' && $val->run() )
		{
			$category = Model_Category::forge();
			$category->name = $val->validated('name');
			$category->parent_id = $val->validated( 'parent' ) ? $val->validated( 'parent' ) : null;
			$category->save();

			Session::set_flash( 'flash_message', 'New category has been successfully created' );
			Response::redirect( 'admin/categories' );
		}

		$categories = Model_Category::find( 'all' );

		$this->template->title = 'Admin &raquo; Categories &raquo; Create';
		$this->template->content = View::forge( 'admin/categories/create', array(
			'categories' => $categories,
			'val' => $val
		));
	}


	public function action_edit( $category_id )
	{
		$category = Model_Category::find( $category_id );
		$val = Validation::forge();

		$val->add( 'name', 'Name' )
			->add_rule( 'required' )
			->add_rule( 'min_length', 3 )
			->add_rule( 'max_length', 25 );
		$val->add( 'parent', 'Parent Category' )
			->add_rule( 'numeric_min', 1 )
			->add_rule( 'numeric_max', 1000 );

		if( Input::method() == 'POST' && $val->run() )
		{
			$category->name = $val->validated('name');
			$category->parent_id = $val->validated( 'parent' ) ? $val->validated( 'parent' ) : null;
			$category->save();

			Session::set_flash( 'flash_message', 'Category has been successfully updated' );
			Response::redirect( 'admin/categories' );
		}

		$categories = Model_Category::find( 'all' );

		$this->template->title = 'Admin &raquo; Categories &raquo; Edit';
		$this->template->content = View::forge( 'admin/categories/edit', array(
			'category' => $category,
			'categories' => $categories,
			'val' => $val
		));
	}


	public function action_delete( $category_id )
	{
		$category = Model_Category::find( $category_id );

		// find the id's of the children to check if the current category can be deleted
		$children_categories = Model_Category::find_children( $category_id );
		if( count( $children_categories ) == 0 )
		{
			$category->delete();
			Session::set_flash( 'flssh_message', 'Category has been deleted' );
		}
		else
			Session::set_flash( 'flash_message', 'Category has children. It can not be deleted.' );

		Response::redirect( 'admin/categories' );
	}

}