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
}
