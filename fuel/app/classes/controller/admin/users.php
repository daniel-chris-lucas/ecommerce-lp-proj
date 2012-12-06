<?php

class Controller_Admin_Users extends Controller_Admin_Base
{

	public function action_index()
	{
		$num_users = Model_User::count_users();

		$config = array(
			'pagination_url' => Uri::create( 'admin/users/index' ),
			'total_items' => $num_users,
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

		$users = Model_User::find()
						->limit( Pagination::$per_page )
						->offset( Pagination::$offset )
						->order_by( 'id', 'asc' )
						->get();

		$this->template->title = 'Admin &raquo; Users';
		$this->template->content = View::forge( 'admin/users/index', array(
			'users' => $users
		));
	}


	public function action_view( $user_id )
	{
		$user = Model_User::find( $user_id );

		$this->template->title = 'Admin &raquo; Users &raquo; View';
		$this->template->content = View::forge( 'admin/users/view', array(
			'user' => $user
		));
	}


	public function action_edit( $user_id )
	{
		$user = Model_User::find( $user_id );

		// form validation
		$val = Validation::forge();

		$val->add( 'first_name', 'First Name' )
			->add_rule( 'required' )
			->add_rule( 'min_length', 2 )
			->add_rule( 'max_length', 25 );
		$val->add( 'last_name', 'Last Name' )
			->add_rule( 'required' )
			->add_rule( 'min_length', 2 )
			->add_rule( 'max_length', 25 );
		$val->add( 'email', 'Email Address' )
			->add_rule( 'required' )
			->add_rule( 'valid_email' )
			->add_rule( 'unique', 'users.email', $user->email );;
		$val->add( 'tel', 'Telephone' )
			->add_rule( 'match_pattern', '/^([1]-)?[0-9]{3}-[0-9]{3}-[0-9]{4}$/i' );
		$val->add( 'birth_day' )
			->add_rule( 'required' )
			->add_rule( 'numeric_min', 1 )
			->add_rule( 'numeric_max', 31 );
		$val->add( 'birth_month' )
			->add_rule( 'required' )
			->add_rule( 'numeric_min', 1 )
			->add_rule( 'numeric_max', 12 );
		$val->add( 'birth_year' )
			->add_rule( 'required' )
			->add_rule( 'numeric_min', date('Y')-100 )
			->add_rule( 'numeric_max', date( 'Y')-12 );

		$val->add( 'street', 'Street Name' )
			->add_rule( 'required' )
			->add_rule( 'min_length', 2 )
			->add_rule( 'max_length', 50 );
		$val->add( 'street_number', 'Street Number' )
			->add_rule( 'numeric_min', 1 )
			->add_rule( 'numeric_max', 999 );
		$val->add( 'town', 'Town' )
			->add_rule( 'required' )
			->add_rule( 'min_length', 2 )
			->add_rule( 'max_length', 50 );
		$val->add( 'country', 'Country' )
			->add_rule( 'required' )
			->add_rule( 'numeric_min', 1 )
			->add_rule( 'numeric_max', 300 );

		$val->add( 'username', 'Username' )
			->add_rule( 'required' )
			->add_rule( 'min_length', 3 )
			->add_rule( 'max_length', 15 )
			->add_rule( 'unique', 'users.username', $user->username );
		$val->add( 'password', 'Password' )
			->add_rule( 'min_length', 7 )
			->add_rule( 'max_length', 100 );
		$val->add( 'password_confirm', 'Password Again' )
			->add_rule( 'match_field', 'password' );
		$val->add( 'role', 'Role' )
			->add_rule( 'required' )
			->add_rule( 'numeric_min', 1 )
			->add_rule( 'numeric_max', 5 );

		// if eveything in the form is correct save the information
		if( Input::method() == 'POST' && $val->run() )
		{
			$salt = 'j1V]hr$bvVL_{lj_~P^(ogTfm$Gie}QyyKZw$zWcWdaR';

			// save the user's information
			$user->first_name = $val->validated( 'first_name' );
			$user->last_name = $val->validated( 'last_name' );
			$user->email = $val->validated( 'email' );
			$user->tel = $val->validated( 'tel' );
			$user->date_of_birth = $val->validated( 'birth_day' ) . '-' . ($val->validated( 'birth_month' ) + 1) . '-' . $val->validated( 'birth_year' );
			$user->street = $val->validated( 'street' );
			$user->street_number = $val->validated( 'street_number' ) ? $val->validated( 'street_number' ) : null;
			$user->town = $val->validated( 'town' );
			$user->country_id = $val->validated( 'country' );
			$user->username = $val->validated( 'username' );
			if( $val->validated( 'password' ) != '' )
				$user->password = Str::truncate( \Crypt::encode( $val->validated( 'password' ), $salt ), 64, '' );
			// stop moderator's and admin's from changing their own priviledges
			if( $this->current_user->id != $user->id )
				$user->role = $val->validated( 'role' );
			$user->save();
			
			Session::set_flash( 'flash_message', 'User has been successfully updated' );
			Response::redirect( Uri::create( 'admin/users' ) );
		}

		// generate information for date of birth
		for( $i = 1; $i <= 31; $i++ )
		{
			$birth_days[] = $i;
		}
		$months = 'January, February, March, April, May, June, July, August, September, October, November, December';
		$birth_months = explode( ', ', $months);
		for( $i = date('Y')-12; $i >= date('Y')-100; $i-- )
		{
			$birth_years[] = $i;
		}

		// fetch list of countries from the database
		$countries = Model_Country::find('all', array( 'order_by' => array( 'name' => 'asc' ) ) );

		// fetch list of roles from the database
		$roles = Model_Role::find( 'all', array( 'order_by' => array( 'name' => 'asc' ) ) );

		// split stored date of birth
		$dob = explode( '-', $user->date_of_birth );


		$this->template->title = 'Admin &raquo; Users &raquo; Edit';
		$this->template->content = View::forge( 'admin/users/edit', array(
			'user' => $user,
			'birth_days'   => $birth_days,
			'birth_months' => $birth_months,
			'birth_years'  => $birth_years,
			'countries'    => $countries,
			'roles'        => $roles,
			'val'          => $val,
			'current_birth_day' => $dob[0],
			'current_birth_month' => $dob[1]-1,
			'current_birth_year' => $dob[2],
		));
	}


	public function action_delete( $user_id )
	{
		$user = Model_User::find( $user_id );

		if( $user->role->name === 'administrator' || $user->role->name === 'moderator' )
			Session::set_flash( 'flash_message_error', 'User could not be deleted. Please remove user privileges to delete' );
		else
		{
			$user->delete();
			Session::set_flash( 'flash_message', 'User has been successfully deleted' );
		}
			
			
		Response::redirect( Uri::create( 'admin/users' ) );
	}

}