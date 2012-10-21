<?php

class Controller_Home extends Controller_Base
{

	public function action_index()
	{
		$this->template->title = 'Home &raquo; Index';
		$this->template->content = View::forge('home/index');
	}

	
	public function action_404()
	{
		$this->template->title = 'Home &raquo; 404';
		return new Response( View::forge( 'home/404' ) );
	}


	public function action_contact()
	{
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

		if( Input::method() == 'POST' && $val->run() )
		{
			$email = Email::forge();
			$email->from( $val->validated( 'email' ), $val->validated( 'name' ) );
			$email->to( 'daniel.chris.lucas@gmail.com' );
			$email->subject( 'LPCSD Ecommerce - Contact Form' );
			$email->html_body( \View::forge( 'layouts/emails/contact', array(
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
				Session::set_flash( 'flash_message', 'Your email could not be sent. Please try again later.' );
			}
			Response::redirect( Uri::current() );
		}

		$this->template->title = 'Home &raquo; Contact';
		$this->template->content = View::forge( 'home/contact', array(
			'val' => $val
		));
	}

}