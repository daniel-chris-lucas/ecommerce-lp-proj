<?php

class Controller_Products extends Controller_Base
{

	public function action_view( $product_slug )
	{
		$product = Model_Product::find( 'first', array(
			'where' => array(
				array( 'slug', 'like', $product_slug )
			),
		));

		$val = Validation::forge( 'comments_val' );
		$val->add_callable( 'myrules' );

		$val->add( 'review' )
			->add_rule( 'required' )
			->add_rule( 'min_length', 10 )
			->add_rule( 'max_length', 1000 );
		$val->add( 'rating' )
			->add( 'required' )
			->add_rule( 'numeric_min', 1 )
			->add_rule( 'numeric_max', 5 );

		$val_cart = Validation::forge( 'cart_val' );
		$val_cart->add( 'quantity' )
			->add_rule( 'required' )
			->add_rule( 'numeric_min', 1 )
			->add_rule( 'numeric_max', 10 );

		if( Input::method() == 'POST' && $val->run() )
		{
			if( $this->current_user == null )
			{
				Session::set_flash( 'flash_message_error', 'You must be logged in to leave comments' );
				Response::redirect( Uri::current() );
			}

			$rating = Model_Rating::forge();
			$rating->user_id = $this->current_user->id;
			$rating->product_id = $product->id;
			$rating->note = $val->validated( 'rating' );
			$rating->description = $val->validated( 'review' );
			$rating->save();

			Session::set_flash( 'flash_message', 'Your message has been successfully created' );
			Response::redirect( Uri::current() );
		}

		if( Input::method() == 'POST' && $val_cart->run() )
		{
			if( Session::get( 'cart_products' ) )
			{
				$products = Session::get( 'cart_products' );
				$products[] = array( 'product' => $product->id, 'quantity' => $val_cart->validated( 'quantity' ), 'price' => $product->price );
				Session::set( 'cart_products', $products );
			}
			else
			{
				Session::set( 'cart_products', array( array( 'product' => $product->id, 'quantity' => $val_cart->validated( 'quantity' ), 'price' => $product->price ) ) );
			}

			Session::set_flash( 'flash_message', $product->name . ' has been added to your cart' );
			Response::redirect( Uri::current() );
		}

		$ratings = Model_Rating::find( 'all', array(
			'order_by' => array( 'created_at' => 'desc' )
		));

		$cart_total = 0;
		if( Session::get( 'cart_products' ) )
		{
			foreach( Session::get( 'cart_products' ) as $cart_product )
			{
				$cart_total += ( $cart_product['price'] * $cart_product['quantity'] );
			}
		}
		View::set_global( 'cart_total', $cart_total );
			
		$this->template->title = 'Product &raquo; ' . $product->name;
		$this->template->content = View::forge( 'products/view', array(
			'product' => $product,
			'val' => $val,
			'ratings' => $ratings
		) );
	}


	public function action_shopping_cart()
	{
		$i = 0;
		$val = Validation::forge();

		
		if( Input::method() == 'POST' )
		{
			for( $i = 0; $i < count(Input::post())- 1; $i++ )
			{
				$val->add( "quantity_{$i}" )
					->add_rule( 'required' )
					->add_rule( 'numeric_min', 1 )
					->add_rule( 'numeric_max', 10 );
			}

			if( $val->run() )
			{
				switch( Input::post( 'submit' ) )
				{
					case 'update' :
						echo 'update';
						exit();
						break;
					case 'checkout' :
						$this->current_user != null ? Response::redirect( 'shopping-cart/confirmation' ) : Response::redirect( "users/connect?red=shopping-cart/confirmation");
						break;
				}
			}
		}

		$products = null;
		if( Session::get( 'cart_products' ) )
		{
			foreach( Session::get( 'cart_products' ) as $product )
			{
				$prod = Model_Product::find( 'first', array(
					'where' => array(
						array( 'id', '=', $product['product'] )
					)
				));

				$temp['name'] = $prod->name;
				$temp['item_no'] = $prod->id;
				$temp['quantity'] = $product['quantity'];
				$temp['unit_price'] = $prod->price;
				$temp['image'] = Model_Image::get_thumbnail( reset( $prod->images )->name );
				$temp['img_location'] = '/assets/uploads/' . reset( $prod->images )->folder;
				$products[] = $temp;
			}
		}

		$sub_total = 0;

		$this->template->title = 'Shopping &raquo; Shopping Cart';
		$this->template->content = View::forge( 'products/shopping_cart', array(
			'products' => $products,
			'sub_total' => $sub_total
		));
	}


	public function action_order_confirmation()
	{
		if( empty( $this->current_user ) ) Response::redirect( Uri::base() );

		$products = null;
		if( Session::get( 'cart_products' ) )
		{
			foreach( Session::get( 'cart_products' ) as $product )
			{
				$prod = Model_Product::find( 'first', array(
					'where' => array(
						array( 'id', '=', $product['product'] )
					)
				));

				$temp['name'] = $prod->name;
				$temp['item_no'] = $prod->id;
				$temp['quantity'] = $product['quantity'];
				$temp['unit_price'] = $prod->price;
				$temp['image'] = Model_Image::get_thumbnail( reset( $prod->images )->name );
				$temp['img_location'] = '/assets/uploads/' . reset( $prod->images )->folder;
				$products[] = $temp;
			}
		}

		$sub_total = 0;

		$this->template->title = 'Shopping &raquo; Order Confirmation';
		$this->template->content = View::forge( 'products/order_confirmation', array(
			'products' => $products,
			'sub_total' => $sub_total
		));
	}


	public function action_order_cancel()
	{
		if( empty( $this->current_user ) ) Response::redirect( Uri::base() );

		Session::delete( 'cart_products' );
		Session::set_flash( 'flash_message', 'Your order has been cancelled' );
		Response::redirect( Uri::base() );
	}


	public function action_order_buy()
	{
		if( empty( $this->current_user ) ) Response::redirect( Uri::base() );

		$sub_total = 0;
		foreach( Session::get( 'cart_products' ) as $prod )
		{
			$sub_total += ( $prod['price'] * $prod['quantity'] );
		}

		$order = Model_Order::forge();
		$order->user_id = $this->current_user->id;
		$order->total = $sub_total;
		$order->save();

		$products = null;
		if( Session::get( 'cart_products' ) )
		{
			foreach( Session::get( 'cart_products' ) as $product )
			{
				$prod = Model_Product::find( 'first', array(
					'where' => array(
						array( 'id', '=', $product['product'] )
					)
				));

				$temp['name'] = $prod->name;
				$temp['item_no'] = $prod->id;
				$temp['quantity'] = $product['quantity'];
				$temp['unit_price'] = $prod->price;
				$temp['image'] = Model_Image::get_thumbnail( reset( $prod->images )->name );
				$temp['img_location'] = '/assets/uploads/' . reset( $prod->images )->folder;
				$products[] = $temp;

				$order_product = Model_Orderproduct::forge();
				$order_product->name = $prod->name;
				$order_product->price = $prod->price;
				$order_product->quantity = $product['quantity'];
				$order_product->order_id = $order->id;
				$order_product->save();
			}
		}

		// send invoice email
		$email = Email::forge();
		$email->from( 'daniel.chris.lucas@gmail.com', 'Shopping' );
		$email->to( $this->current_user->email, $this->current_user->first_name . ' ' . $this->current_user->last_name );
		$email->subject( 'Shopping - Invoice, Order #123456' );
		$email->html_body( View::forge( 'layouts/emails/invoice', array(
			'products' => $products,
			'order_id' => $order->id,
			'sub_total' => $sub_total
		)));
		try
		{
			$email->send();
		}
		catch( \EmailSendingFailedException $e )
		{
			Session::set_flash( 'flash_message_error', 'Invoice sending failed. Please contact the store for help.' );
		}

		Session::delete( 'cart_products' );
		
		$this->template->title = 'Shopping &raquo; Checkout';
		$this->template->content = View::forge( 'products/order_buy', array(
		));
	}


	public function action_search( $query = null )
	{
		$val = Validation::forge();
		$query = null;
		$products = null;

		$val->add( 'search' );

		if( Input::method() == 'POST' && $val->run() )
		{
			$query = $val->validated( 'search' );
			$products = Model_Product::find( 'all', array(
				'where' => array(
					array( "name", "like", "%{$query}%")
				)
			));
		}

		$this->template->title = "Shopping &raquo; Search";
		$this->template->content = View::forge( 'products/search', array(
			'query' => $query,
			'products' => $products
		));
	}

}
