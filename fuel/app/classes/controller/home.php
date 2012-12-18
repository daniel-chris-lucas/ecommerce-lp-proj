<?php
/**
 * Conteint la page d'accueil, la page d'erreur 404 et la page de contact
 * Pour eviter d'avoir des adresses comme site.com/home/404, les adresses ont été routés dans le fichier fuel/config/routes.php
 */
class Controller_Home extends Controller_Base
{

	/**
	 * Affiche la page d'accueil du site
	 */
	public function action_index()
	{
		// Affichage de la page d'accueil
		$this->template->title = 'Home &raquo; Index';
		$this->template->content = View::forge( 'home/index' );
	}

	
	/**
	 * Affiche la page d'erreur 404
	 */
	public function action_404()
	{
		// Affichage de la page d'erreur
		$this->template->title = 'Home &raquo; 404';
		return new Response( View::forge( 'home/404' ) );
	}


	/**
	 * Affiche la page de contact
	 */
	public function action_contact()
	{
		// Definition des règles de validation pour le formulaire de contact
		$val = Validation::forge();

		$val->add( 'name', 'Name' )
			->add_rule( 'required' )
			->add_rule( 'min_length', 2 )
			->add_rule( 'max_length', 45 );
		$val->add( 'email', 'Email' )
			->add_rule( 'required' )
			->add_rule( 'valid_email' );
		$val->add( 'message', 'Message' )
			->add_rule( 'required' )
			->add_rule( 'min_length', 10 )
			->add_rule( 'max_length', 1000 );

		// Si le formulaire a été correctement rempli
		if( Input::method() == 'POST' && $val->run() )
		{
			// Creation d'un objet email puis envoi d'un email de confirmation à l'utilisateur
			$email = Email::forge();
			$email->from( $val->validated( 'email' ), $val->validated( 'name' ) );
			$email->to( 'daniel.chris.lucas@gmail.com' );
			$email->subject( 'LPCSD Ecommerce - Contact Form' );
			$email->html_body( View::forge( 'layouts/emails/contact', array(
				'name' => $val->validated( 'name' ),
				'email' => $val->validated( 'email' ),
				'message' => $val->validated( 'message' )
			)));
			try
			{
				$email->send();
				Session::set_flash( 'flash_message', 'Your email has been sent! We will get in touch with you soon.' );
			}
			catch( \EmailSendingFailedException $e )
			{
				Session::set_flash( 'flash_message_error', 'Your email could not be sent. Please try again later.' );
			}
			Response::redirect( Uri::current() );
		}

		// Affichage de la page de contact
		$this->template->title = 'Home &raquo; Contact';
		$this->template->content = View::forge( 'home/contact', array(
			'val' => $val
		));
	}

}