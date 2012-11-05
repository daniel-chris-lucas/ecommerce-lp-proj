<?php

class Controller_Admin_Countries extends Controller_Admin_Base
{

	public function action_index()
	{
		$num_countries = Model_Country::count_countries();

		$config = array(
			'pagination_url' => Uri::create( 'admin/countries/index' ),
			'total_items' => $num_countries,
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

		$countries = Model_Country::find()
						->limit( Pagination::$per_page )
						->offset( Pagination::$offset )
						->order_by( 'name', 'asc' )
						->get();

		$submenus = array(
			array( 'name' =>'Add New', 'link' => 'admin/countries/create', 'class' => 'menu_icons')
		);
		View::set_global( 'submenus', $submenus );

		$this->template->title = 'Admin &raquo; Countries';
		$this->template->content = View::forge( 'admin/countries/index', array(
			'countries' => $countries
		));
	}


	public function action_edit( $country_id )
	{
		$country = Model_Country::find( $country_id );

		$val = Validation::forge();

		$val->add( 'name', 'Name' )
			->add_rule( 'required' )
			->add_rule( 'min_length', 3 );
		$val->add( 'iso', 'ISO' )
			->add_rule( 'required' )
			->add_rule( 'min_length', 2 )
			->add_rule( 'max_length', 2 );
		$val->add( 'iso3', 'ISO3' )
			->add_rule( 'required' )
			->add_rule( 'min_length', 3 )
			->add_rule( 'max_length', 3 );

		if( Input::method() == 'POST' && $val->run() )
		{
			$country->name = $val->validated( 'name' );
			$country->iso = $val->validated( 'iso' );
			$country->iso3 = $val->validated( 'iso3' );
			$country->save();

			Session::set_flash( 'flash_message', 'Country has been successfully updated' );
			Response::redirect( 'admin/countries' );
		}

		$this->template->title = 'Admin &raquo; Countries &raquo; Edit';
		$this->template->content = View::forge( 'admin/countries/edit', array(
			'country' => $country,
			'val' => $val
		));
	}


	public function action_create()
	{
		$val = Validation::forge();

		$val->add( 'name', 'Name' )
			->add_rule( 'required' )
			->add_rule( 'min_length', 3 );
		$val->add( 'iso', 'ISO' )
			->add_rule( 'required' )
			->add_rule( 'min_length', 2 )
			->add_rule( 'max_length', 2 );
		$val->add( 'iso3', 'ISO3' )
			->add_rule( 'required' )
			->add_rule( 'min_length', 3 )
			->add_rule( 'max_length', 3 );

		if( Input::method() == 'POST' && $val->run() )
		{
			$country = Model_Country::forge();
			$country->name = $val->validated( 'name' );
			$country->iso = $val->validated( 'iso' );
			$country->iso3 = $val->validated( 'iso3' );
			$country->save();

			Session::set_flash( 'flash_message', 'New country has been successfully created' );
			Response::redirect( 'admin/categories' );
		}

		$this->template->title = 'Admin &raquo; Countries &raquo; Create';
		$this->template->content = View::forge( 'admin/countries/create', array(
			'val' => $val
		));
	}

}