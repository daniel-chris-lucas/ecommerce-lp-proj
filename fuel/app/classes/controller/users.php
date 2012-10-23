<?php

class Controller_Users extends Controller_Template
{

	public $template = 'layouts/template';

	public function action_login()
	{
		$this->template->title = "Users &raquo; login";
		$this->template->content = View::forge('users/login');
	}

	public function action_register()
	{
		$this->template->title = "Users &raquo; register";
		$this->template->content = View::forge('users/register');
	}



}


