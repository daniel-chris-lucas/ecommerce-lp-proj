<?php

class Controller_Users extends Controller_Base
{

	/**
	 * Allow a guest visitor to connect to the site using a username and a password
	 */
	public function action_connect()
	{
		// form validation
		$val = Validation::forge();

		$val->add( 'username', 'Username' )
			->add_rule( 'required' )
			->add_rule( 'min_length', 3 )
			->add_rule( 'max_length', 15 );
		$val->add( 'password', 'Password' )
			->add_rule( 'required' )
			->add_rule( 'min_length', 7 )
			->add_rule( 'max_length', 100 );

		if( Input::method() == 'POST' && $val->run() )
		{
			$salt = 'j1V]hr$bvVL_{lj_~P^(ogTfm$Gie}QyyKZw$zWcWdaR';
			$hash = Str::truncate( \Crypt::encode( $val->validated( 'password' ), $salt ), 64, '' );

			$user = Model_User::find( 'first', array(
				'where' => array(
					array( 'username', $val->validated( 'username' ) ),
					array( 'password', $hash )
				)
			));

			if( isset( $user ) && $user['activated'] == 1 )
			{
				Session::set( 'username', $user->username );
				Session::set_flash( 'flash_message', "Welcome back {$user->first_name} {$user->last_name}, you have successfully logged in" );
			}
			else
			{
				Session::set_flash( 'flash_message', 'Login failed. Please try again.' );
			}
			Response::redirect( Uri::base() );
		}

		$this->template->title = 'Users &raquo; Connect';
		$this->template->content = View::forge('users/connect', array( 'val' => $val ) );
	}


	public function action_register()
	{
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
			->add_rule( 'valid_email' );
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
			->add_rule( 'max_length', 15 );
		$val->add( 'password', 'Password' )
			->add_rule( 'required' )
			->add_rule( 'min_length', 7 )
			->add_rule( 'max_length', 100 );
		$val->add( 'password_confirm', 'Password Again' )
			->add_rule( 'required' )
			->add_rule( 'match_field', 'password' );

		// if eveything in the form is correct save the information
		if( Input::method() == 'POST' && $val->run() )
		{
			$salt = 'j1V]hr$bvVL_{lj_~P^(ogTfm$Gie}QyyKZw$zWcWdaR';
			
			$regular_id = Model_Role::find('first', array(
				'where' => array(
					array( 'name', 'regular' )
				),
				'limit' => 1
			))['id'];

			// save the user's information
			$user = Model_User::forge();
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
			$user->password = Str::truncate( \Crypt::encode( $val->validated( 'password' ), $salt ), 64, '' );
			$user->role_id = $regular_id;
			$user->confirmation_code = Str::random( 'alnum', 16 );
			$user->activated = 0;
			$user->save();

			// send the activation email
			$email = Email::forge();
			$email->from( 'daniel.chris.lucas@gmail.com', 'LPCSD Ecommerce' );
			$email->to( $val->validated( 'email' ), $user->first_name . ' ' . $user->last_name );
			$email->subject( 'LPCSD Ecommerce - Activate Your Account' );
			$email->html_body( \View::forge( 'layouts/emails/activation', array(
				'act_link' => Uri::base() . 'users/activate/' . $val->validated( 'username' ) . '/' . $user->confirmation_code,
				'first_name' => ucfirst( $user->first_name ),
				'last_name' => strtoupper( $user->last_name ),
			)));
			try
			{
				$email->send();
				Session::set_flash( 'flash_message', 'Your account has been created. Please check your email to activate your account.' );
			}
			catch( \EmailSendingFailedException $e )
			{
				Session::set_flash( 'flash_message', 'Your activation email could not be sent. Please try again later.' );
			}
			
			Response::redirect( Uri::base() );
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


		$this->template->title = 'Users &raquo; Register';
		$this->template->content = View::forge('users/register', array(
			'birth_days'   => $birth_days,
			'birth_months' => $birth_months,
			'birth_years'  => $birth_years,
			'countries'    => $countries,
			'val'          => $val
		));
	}


	public function action_activate( $username, $confirmation_code )
	{
		$user = Model_User::find( 'first', array(
			'where' => array(
				array( 'username', $username)
			),
		));

		if( $user['confirmation_code'] === $confirmation_code )
		{
			$user->activated = 1;
			$user->save();

			Session::set_flash( 'flash_message', 'Your account has been succesfully activated. You may now log in and start buying!' );
		}
		else
		{
			Session::set_flash( 'flash_message', 'This confirmation code has expired.' );
		}
		
		Response::redirect( Uri::base() );
	}


	public function action_logout()
	{
		if( Session::get( 'username' ) )
			Session::destroy();
		
		Session::set_flash( 'flash_message', 'You have been logged out' );
		Response::redirect( Uri::base() );
	}


	public function action_account()
	{
		$this->template->title = 'Users &raquo; Account';
		$this->template->content = View::forge('users/account');
	}

}
