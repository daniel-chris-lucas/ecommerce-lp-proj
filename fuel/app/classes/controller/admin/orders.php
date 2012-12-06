<?php

class Controller_Admin_Orders extends Controller_Admin_Base
{

	public function action_index()
	{
		$orders = Model_Order::find( 'all', array(
			'order_by' => array( 'created_at' => 'desc' )
		));

		$this->template->title = 'Admin &raquo; Orders';
		$this->template->content = View::forge( 'admin/orders/index', array(
			'orders' => $orders
		));
	}

}