<?php
/**
 * Contient les pages permettant de voir toutes les commandes, et de supprimer des commandes
 */
class Controller_Admin_Orders extends Controller_Admin_Base
{

	/**
	 * Affiche la page permettant de voir toutes les commandes
	 */
	public function action_index()
	{
		// Chercher les commandes dans la BDD
		$orders = Model_Order::find( 'all', array(
			'order_by' => array( 'created_at' => 'desc' )
		));

		// Affichage de la page
		$this->template->title = 'Admin &raquo; Orders';
		$this->template->content = View::forge( 'admin/orders/index', array(
			'orders' => $orders
		));
	}

}