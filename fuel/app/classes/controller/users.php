<?php
/**
 * Affiche les pages pour la connexion au site, l'inscription, l'activation des comptes, la déconnexion, gérer les comptes,
 * modifier les détails des utilisateurs, et voir les anciens commandes
 */
class Controller_Users extends Controller_Base
{

	/**
	 * Affiche la page de connexion au site. Seulement affiché si l'utilisateur ne peut pas exécuter le javaScript. Sinon la fonction
	 * est seulement utilisé pour vérifier les information fournies.
	 */
	public function action_connect()
	{
		// Définition des règles de validation pour le formulaire de connexion au site.
		$val = Validation::forge();

		$val->add( 'username', 'Username' )
			->add_rule( 'required' )
			->add_rule( 'min_length', 3 )
			->add_rule( 'max_length', 15 );
		$val->add( 'password', 'Password' )
			->add_rule( 'required' )
			->add_rule( 'min_length', 7 )
			->add_rule( 'max_length', 100 );

		// Si les informations de le formulaire sont valides il faut hasher le mot de passe, puis vérifier si un utilisateur existe
		// dans la BDD avec le meme pseudonyme et hash.
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

			// Verifier si un utilisateur existe avec les memes informations et verifier si le compte a été activé
			if( isset( $user ) && $user['activated'] == 1 )
			{
				Session::set( 'username', $user->username );
				Session::set_flash( 'flash_message', "Welcome back {$user->first_name} {$user->last_name}, you have successfully logged in" );
				Input::get( 'red' ) ? Response::redirect( Input::get( 'red' ) ) : Response::redirect( Uri::base() );
			}
			else
			{
				Session::set_flash( 'flash_message_error', 'Login failed. Please try again.' );
				Response::redirect( 'users/connect' );
			}
		}

		// Affichage de la page de connexion.
		$this->template->title = 'Users &raquo; Connect';
		$this->template->content = View::forge('users/connect', array( 'val' => $val ) );
	}


	/**
	 * Affiche la page d'inscription du site
	 */
	public function action_register()
	{
		// Definition des règles de validation du formulaire d'inscription
		$val = Validation::forge();
		// Appel des règles personnels définis dans fuel/app/classes/myrules.php
		$val->add_callable( 'myrules' );

		$val->add( 'first_name', 'First Name' )
			->add_rule( 'required' )
			->add_rule( 'min_length', 2 )
			->add_rule( 'max_length', 25 );
		$val->add( 'last_name', 'Last Name' )
			->add_rule( 'required' )
			->add_rule( 'min_length', 2 )
			->add_rule( 'max_length', 25 );
		$val->add( 'email', 'Email Address' )
			->add_rule( 'unique', 'users.email' )
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
			->add_rule( 'unique', 'users.username' )
			->add_rule( 'min_length', 3 )
			->add_rule( 'max_length', 15 );
		$val->add( 'password', 'Password' )
			->add_rule( 'required' )
			->add_rule( 'min_length', 7 )
			->add_rule( 'max_length', 100 );
		$val->add( 'password_confirm', 'Password Again' )
			->add_rule( 'required' )
			->add_rule( 'match_field', 'password' );

		// Si tous les champs ont été validés il faut hasher le mot de passe, créer un nouveau utilisateur dans la BDD avec un compte non
		// activé, puis envoyer un email de confirmation
		if( Input::method() == 'POST' && $val->run() )
		{
			$salt = 'j1V]hr$bvVL_{lj_~P^(ogTfm$Gie}QyyKZw$zWcWdaR';
			
			$regular_id = Model_Role::find('first', array(
				'where' => array(
					array( 'name', 'regular' )
				)
			))['id'];

			// Creer un nouveau objet utilisateur et passer les informations. Ensuite enregistrer le nouveau utilisateur dans la BDD.
			$user = Model_User::forge();
			$user->first_name = $val->validated( 'first_name' );
			$user->last_name = $val->validated( 'last_name' );
			$user->email = $val->validated( 'email' );
			$user->tel = $val->validated( 'tel' );
			$user->date_of_birth = $val->validated( 'birth_day' ) . '-' . $val->validated( 'birth_month' ) . '-' . $val->validated( 'birth_year' );
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

			// Creer un objet Email puis envoyer l'email de confirmation a l'utilisateur
			$email = Email::forge();
			$email->from( 'daniel.chris.lucas@gmail.com', 'LPCSD Ecommerce' );
			$email->to( $user->email, $user->first_name . ' ' . $user->last_name );
			$email->subject( 'LPCSD Ecommerce - Activate Your Account' );
			$email->html_body( View::forge( 'layouts/emails/activation', array(
				'act_link' => Uri::base() . 'users/activate/' . $user->username . '/' . $user->confirmation_code,
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
				Session::set_flash( 'flash_message_error', 'Your activation email could not be sent. Please try again later.' );
			}
			
			// Rediriger l'utilisateur vers la page d'accueil
			Response::redirect( Uri::base() );
		}


		// Générer les jours, mois et années pour le formulaire d'inscription.
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

		// Chercher la liste des pays dans la BDD pour le formulaire d'inscription
		$countries = Model_Country::find('all', array( 'order_by' => array( 'name' => 'asc' ) ) );

		// Affichage de la page d'inscription
		$this->template->title = 'Users &raquo; Register';
		$this->template->content = View::forge('users/register', array(
			'birth_days'   => $birth_days,
			'birth_months' => $birth_months,
			'birth_years'  => $birth_years,
			'countries'    => $countries,
			'val'          => $val
		));
	}


	/**
	 * La fonction d'activation de compte. Si l'utilisateur et le code de confirmation sont valides, il faut mettre le boolean activated
	 * dans la table USERS a 1.
	 * @param String $username Le nom d'utilisateur
	 * @param String $confirmation_code Le code de confirmation de l'utilisateur
	 */
	public function action_activate( $username, $confirmation_code )
	{
		// Chercher les informations sur l'utilisateur en fonction de son pseudonyme
		$user = Model_User::find( 'first', array(
			'where' => array(
				array( 'username', $username)
			),
		));

		// Si le code de confirmatio est valide il faut mettre activated a 1
		if( $user['confirmation_code'] === $confirmation_code )
		{
			$user->activated = 1;
			$user->save();

			Session::set_flash( 'flash_message', 'Your account has been successfully activated. You may now log in and start buying!' );
		}
		else
		{
			Session::set_flash( 'flash_message_error', 'This confirmation code has expired.' );
		}
		
		// Rediriger l'utilisateur vers la page d'accueil
		Response::redirect( Uri::base() );
	}


	/**
	 * Fonction pour déconnecter l'utilisateur du site
	 */
	public function action_logout()
	{
		// Si l'utilisateur est connecté au site il faut supprimer la session puis rediriger l'utilisateur vers la page d'accueil
		if( Session::get( 'username' ) )
			Session::destroy();
		
		Session::set_flash( 'flash_message', 'You have been logged out' );
		Response::redirect( Uri::base() );
	}


	/**
	 * Affiche la page qui permet aux utilisateurs de vérifier leurs détails et de voir les anciens commandes
	 */
	public function action_account()
	{
		// Chercher les commandes liées à l'utilisateur connecté
		$orders = Model_Order::find( 'all', array(
			'where' => array(
				array( 'user_id', '=', $this->current_user->id )
			)
		));

		// Affichage de la page
		$this->template->title = 'Users &raquo; Account';
		$this->template->content = View::forge( 'users/account', array(
			'orders' => $orders
		));
	}


	/**
	 * Affiche la page d'edition de compte
	 */
	public function action_edit()
	{
		// Definition des règles de validation pour le formulaire de modification de compte
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
			->add_rule( 'min_length', 7 )
			->add_rule( 'max_length', 100 );
		$val->add( 'password_confirm', 'Password Again' )
			->add_rule( 'match_field', 'password' );

		// Si tous les champs dans le formulaire ont été bien renseignés, il faut mettre à jour les informations de l'utilisateur
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
			$user = Model_User::find( $this->current_user->id );
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
			// Seulement modifier le mot de passe si l'utilisateur a mis un nouveau mot de passe
			if( $val->validated( 'password' ) != '' )
				$user->password = Str::truncate( \Crypt::encode( $val->validated( 'password' ), $salt ), 64, '' );
			$user->save();
			
			Session::set_flash( 'flash_message', 'Your account has been successfully updated' );
			Response::redirect( Uri::create( 'users/account' ) );
		}


		// Créer les jours, mois et années pour le formulaire
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

		// Chercher la liste des pays dans la BDD pour le formulaire.
		$countries = Model_Country::find('all', array( 'order_by' => array( 'name' => 'asc' ) ) );

		// Comme les dates dans la BDD sont sous la forme dd-mm-yyyy il faut séparer les informations avec les -
		$dob = explode( '-', $this->current_user->date_of_birth );

		// Affichage de la page de modification
		$this->template->title = 'Users &raquo; Edit Account';
		$this->template->content = View::forge( 'users/edit', array(
			'birth_days'   => $birth_days,
			'birth_months' => $birth_months,
			'birth_years'  => $birth_years,
			'countries'    => $countries,
			'val'          => $val,
			'current_birth_day' => $dob[0],
			'current_birth_month' => $dob[1]-1,
			'current_birth_year' => $dob[2],
		));
	}


	/**
	 * Affiche les détails sur une commande de l'utilisateur
	 * @param String $order_id L'ID de la commande que l'utilisateur souhaite regarder en détail
	 */
	public function action_orders( $order_id )
	{
		$order = Model_Order::find( 'first', array(
			'where' => array(
				array( 'id', '=', $order_id )
			)
		));

		if( !isset( $this->current_user ) || $this->current_user->id != $order->user_id )
			Response::redirect( Uri::base() );

		$this->template->title = 'Users &raquo; Orders';
		$this->template->content = View::forge( 'users/orders', array(
			'order' => $order
		));
	}

}
