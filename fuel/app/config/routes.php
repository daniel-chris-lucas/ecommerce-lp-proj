<?php
return array(
	'_root_'  => 'home/index',  // The default route
	'_404_'   => 'home/404',    // The main 404 route
	
	// 'hello(/:name)?' => array('welcome/hello', 'name' => 'hello'),
	
	'admin' => 'admin/dashboard',
	'categories' => 'categories/index',
	'shopping-cart' => 'products/shopping_cart',
	'shopping-cart/confirmation' => 'products/order_confirmation',
	'shopping-cart/cancel' => 'products/order_cancel',
	'shopping-cart/buy' => 'products/order_buy',
	'search' => 'products/search'
);