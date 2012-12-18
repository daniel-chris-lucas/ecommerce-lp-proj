<?php
/**
 * Contient la page d'accueil de la partie admin
 */
class Controller_Admin_Dashboard extends Controller_Admin_Base
{
	/**
	 * Affiche la page d'accueil de la partie admin
	 */
	public function action_index()
	{
		// Affichage de la page d'accueil
		$this->template->title = 'Admin &raquo; Dashboard';
		$this->template->content = View::forge('admin/dashboard/index');
	}

}