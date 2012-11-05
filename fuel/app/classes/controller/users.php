<?php

class Controller_Users extends Controller_Template
{

	public $template = 'layouts/template';

	public function action_login()
	{
		$val =Validation::forge();
		$val->add("username", "Username")
			->add_rule("required")
			->add_rule("min_lenght",2)
			->add_rule("max_length",15);
		$val->add("password", "Password")
			->add_rule("required")
			->add_rule("min_lenght",7)
			->add_rule("max_length",100);

		if ( Input::method() == 'POST' && $val->run() )
		{
			$salt = 'j1V]hr$bvVL_{lj_~P^(ogTfm$Gie}QyyKZw$zWcWdaR';
			$hash = Str::truncate( \Crypt( $val->validated("password"), $salt ),64,'' );

			$user = Model_User::find('first', array(
				'where' => array(
					array( 'username', $val->validated('username') ),
					array( 'password', $hash )
				)
			));

			if ( isset($user) && $user['activated']==1) {
				Session::set('username', $user-> username);
				Session::set_flash('flash_message', "Welcome back $user->first_name $user->last_name, you have succesfully logged in!");
				Response::redirect( Uri::base() );
			}
			else{
				Session::set_flash('flash_message', "login failed, please try again!");
				Response::redirect( 'users/login' );
			}
		}


		$this->template->title = "Users &raquo; login";
		$this->template->content = View::forge('users/login');
	}

	public function action_register()
	{

		$val = Validation::forge();
		$val->add("first_name", "First Name") //pour le champ
			//pour les règles de validation
			->add_rule("required") // obligatoire
			->add_rule("min_length",2)
			->add_rule("max_length",25);

		$val->add("last_name", "Last Name") //pour le champ
			//pour les règles de validation
			->add_rule("required")
			->add_rule("min_length",2)
			->add_rule("max_length",25);

		$val->add("email", "E-Mail Adress") //pour le champ
			//pour les règles de validation
			->add_rule("required")
			->add_rule("valid_email")
			->add_rule("max_length",45);

		$val->add("tel", "Telephone") //pour le champ
			//pour les règles de validation
			->add_rule("match_pattern", "/^([1]-)?[0-9]{3}-[0-9]{3}-[0-9]{4}$/i");

		$val->add("birth_day", "Birth Day") //pour le champ
			//pour les règles de validation
			->add_rule("required")
			->add_rule("numeric_min",1)
			->add_rule("numeric_max",31);

		$val->add("birth_month", "Birth Month") //pour le champ
			//pour les règles de validation
			->add_rule("required")
			->add_rule("numeric_min",0)
			->add_rule("numeric_max",11);

		$val->add("birth_year", "Birth Year") //pour le champ
			//pour les règles de validation
			->add_rule("required")
			->add_rule("numeric_min",date("Y")-100)
			->add_rule("numeric_max",date("Y")-12);

		$val->add("street", "Street Name") //pour le champ
			//pour les règles de validation
			->add_rule("required")
			->add_rule("min_length",2)
			->add_rule("max_length",50);

		$val->add("street_number", "Street Number") //pour le champ
			//pour les règles de validation
			->add_rule("numeric_min",1)
			->add_rule("numeric_max",999);

		$val->add("town", "Town") //pour le champ
			//pour les règles de validation
			->add_rule("required")
			->add_rule("min_length",2)
			->add_rule("max_length",50);

		$val->add("country", "Country") //pour le champ
			//pour les règles de validation
			->add_rule("required")
			->add_rule("numeric_min",1)
			->add_rule("numeric_max",300);

		$val->add("username", "Username") //pour le champ
			//pour les règles de validation
			->add_rule("required")
			->add_rule("min_lenght",2)
			->add_rule("max_length",15);

		$val->add("password", "Password") //pour le champ
			//pour les règles de validation
			->add_rule("required")
			->add_rule("min_length",7)
			->add_rule("max_lenght",100);

		$val->add("password_confirm", "Password Confirm") //pour le champ
			//pour les règles de validation
			->add_rule("required")
			->add_rule("match_field", "password");

		if ( Input::method() == "POST" && $val->run() ) {
			$salt = 'j1V]hr$bvVL_{lj_~P^(ogTfm$Gie}QyyKZw$zWcWdaR';
			
			$regular_id = Model_Role::find("first", array(
					"where" => array(
							array( "name", "regular" )
					)
			))/*['id']*/;
			$regular_id = $regular_id['id'];
			//rentre dans la table role cherche le name qui correspond à regular

			$user = Model_User::forge();
			$user->first_name = $val->validated("first_name");
			$user->last_name = $val->validated("last_name");
			$user->email = $val->validated("email");
			$user->tel = $val->validated("tel");
			$user->date_of_birth = $val->validated("birth_day") .'-' . ($val->validated("birth_month")+1) . '-' . $val->validated("birth_year");
			$user->street = $val->validated("street");
			$user->street_number = $val->validated("street_number") ? $val->validated("street_number") : null ;
			$user->town = $val->validated("town");
			$user->country_id = $val->validated("country");
			$user->username = $val->validated("username");
			$user->password = Str::truncate( \Crypt( $val->validated("password"), $salt ),64,'' );
			$user->role_id = $regular_id;
			$user->confirmation_code = Str::random( 'alnum', 16 );
			$user->activated = 0;
			$user->save();

			$email = Email::forge();
			$email->from('daniel.chris.lucas@gmail.com', 'LPCSD ecommerce'); /* celui qui envoie le mail , sous quoi on veut le voir apparaître */
			$email->to( $user->email, $user->first_name . ' ' . $user->last_name );
			$email->subject( 'LPCSD ecommerce - Activate your account!' );
			$email->html_body( View::forge( 'layouts/emails/activation', array(
					'act_link' => Uri::base() . 'users/activate/' . $user->username . '/' . $user->confirmation_code,
					'first_name' => ucfirst( $user->first_name ) /*première lettre de la chaîne en majuscule*/ ,
					'last_name' => strtoupper($user->last_name) /*tout en majuscule*/,
				)
			));

			try {
				$email->send();
				Session::set_flash( 'flash_message', 'Your account has been created. Please check your email to activate your account.' );
			} catch ( \EmailSendingFailedException $e ) {
				Session::set_flash( 'flash_message', 'Your activation email could not be sent. Please try again later.' );
			}

			Response::redirect( Uri::base() ); /*redirige vers la page de base quoiqu'il arrive*/

		}


		for ($i=1; $i <= 31; $i++) { 
			$birth_days[] = $i;
		}

		$months = "January, February, March, April, May, June, July, August, September, October, November, December";
		$birth_months = explode(", ", $months);

		for ($i=date("Y")-12; $i >= date("Y")-100; $i--) { 
			$birth_years[] = $i;
		}

		$countries = Model_Country::find('all');

		$this->template->title = "Users &raquo; register";
		$this->template->content = View::forge('users/register', array(
			"birth_days" => $birth_days,
			"birth_months" => $birth_months,
			"birth_years" => $birth_years,
			"countries" => $countries,
			"val" => $val
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

}


