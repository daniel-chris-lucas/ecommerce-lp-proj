<?php

class Controller_Admin_Products extends Controller_Admin_Base
{

	public function action_index()
	{
		$products = Model_Product::find( 'all' );

		$submenus = array(
			array( 'name' =>'Add New', 'link' => 'admin/products/create', 'class' => 'menu_icons')
		);
		View::set_global( 'submenus', $submenus );

		$this->template->title = 'Admin &raquo; Products';
		$this->template->content = View::forge('admin/products/index', array(
			'products' => $products
		));
	}


	public function action_create()
	{
		$val = Validation::forge();

		$val->add( 'name', 'Name' )
			->add_rule( 'required' )
			->add_rule( 'min_length', 3 )
			->add_rule( 'max_length', 255 );
		$val->add( 'description', 'Description' )
			->add_rule( 'required' )
			->add_rule( 'min_length', 10 )
			->add_rule( 'max_length', 2000 );
		$val->add( 'category', 'Category' )
			->add_rule( 'numeric_min', 1 );
		$val->add( 'price', 'Price' )
			->add( 'numeric_min', 1 );
		for( $i = 0; $i <= 5; $i++ )
		{
			$val->add( "image{$i}", "Image {$i}" );
			$val->add( "image_alt{$i}", "Image {$i} Text" )
				->add_rule( 'min_length', 5 )
				->add_rule( 'max_length', 255 );
		}

		if( Input::method() == 'POST' && $val->run() )
		{
			$product = Model_Product::forge();
			$product->name = $val->validated( 'name' );
			$product->description = $val->validated( 'description' );
			$product->category_id = $val->validated( 'category' );
			$product->price = $val->validated( 'price' );
			$product->save();

			/* start upload images */
			if( count( $product->images ) > 5 )
			{
				Session::set_flash( 'flash_message', '5 images already exist for this product' );
				Response::redirect( Uri::current() );
			}

			$upload_config = array(
			    'path' => DOCROOT.'assets/uploads/'.$product->category->name,
			    'randomize' => true,
			    'ext_whitelist' => array('img', 'jpg', 'jpeg', 'gif', 'png')
			);

			Upload::process($upload_config);

			if( Upload::is_valid() )
			{
				Upload::save();
				$i = 1;

				// When the file is saved save file location to the database
				foreach( Upload::get_files() as $uploaded_file )
				{
					$img = Model_Image::forge();
					$img->name = $product->category->name . DS . $uploaded_file['saved_as'];
					$img->alt = $val->validated( 'image_alt' . $i );
					$img->product_id = $product->id;
					$img->save();

					Image::load( 'assets/uploads/' . $img->name )
						->resize( 60 )
						->save_pa( null, '-thumbnail' );

					/* start check image size */
					$original_image_size = explode( ' ', getimagesize( 'assets/uploads/' . $img->name )[3] );
					list( $image_width, $image_height ) = $original_image_size;
					$image_width = intval( str_replace( '"', '', explode( '=', $image_width )[1] ) );
					$image_height = intval( str_replace( '"', '', explode( '=', $image_height )[1] ) );

					if( $image_width > 800 && $image_width > $image_height )
					{
						Image::load( 'assets/uploads/' . $img->name )
							->resize( 800 )
							->save( 'assets/uploads/' . $img->name );
					}
					if( $image_height > 600 && $image_height > $image_width )
					{
						Image::load( 'assets/uploads/' . $img->name )
							->resize( null, 600 )
							->save( 'assets/uploads/' . $img->name );
					}
					/* end check image size */
					$i++;
				}				
			}
			else
			{
				foreach( Upload::get_errors() as $file_error )
				{
					echo "error";
				}
			}
			/* end upload images */

			Session::set_flash( 'flash_message', 'New product has been successfully added' );
			Response::redirect( 'admin/products' );
		}


		$categories = Model_Category::find( 'all', array(
			'order_by' => array( 'name' => 'asc' )
		));

		$submenus = array(
			array( 'name' =>'Retun to Products', 'link' => 'admin/products', 'class' => 'menu_icons')
		);
		View::set_global( 'submenus', $submenus );

		$this->template->title = 'Admin &raquo; Products &raquo; Create';
		$this->template->content = View::forge('admin/products/create', array(
			'categories' => $categories,
			'val' => $val
		));
	}


	public function action_edit( $product_id )
	{
		$product = Model_Product::find( $product_id );

		$val = Validation::forge();

		$val->add( 'name', 'Name' )
			->add_rule( 'required' )
			->add_rule( 'min_length', 3 )
			->add_rule( 'max_length', 255 );
		$val->add( 'description', 'Description' )
			->add_rule( 'required' )
			->add_rule( 'min_length', 10 )
			->add_rule( 'max_length', 2000 );
		$val->add( 'category', 'Category' )
			->add_rule( 'numeric_min', 1 );
		$val->add( 'price', 'Price' )
			->add( 'numeric_min', 1 );
		for( $i = 0; $i <= 5; $i++ )
		{
			$val->add( "image{$i}", "Image {$i}" );
			$val->add( "image_alt{$i}", "Image {$i} Text" )
				->add_rule( 'min_length', 5 )
				->add_rule( 'max_length', 255 );
		}

		if( Input::method() == 'POST' && $val->run() )
		{
			$product->name = $val->validated( 'name' );
			$product->description = $val->validated( 'description' );
			$product->category_id = $val->validated( 'category' );
			$product->price = $val->validated( 'price' );
			$product->save();

			/* start upload images */
			if( count( $product->images ) > 5 )
			{
				Session::set_flash( 'flash_message_error', '5 images already exist for this product' );
				Response::redirect( Uri::current() );
			}

			$upload_config = array(
			    'path' => DOCROOT.'assets/uploads/'.$product->category->name,
			    'randomize' => true,
			    'ext_whitelist' => array('img', 'jpg', 'jpeg', 'gif', 'png')
			);

			Upload::process($upload_config);

			if( Upload::is_valid() )
			{
				Upload::save();
				$i = 1;

				// When the file is saved save file location to the database
				foreach( Upload::get_files() as $uploaded_file )
				{
					$img = Model_Image::forge();
					$img->name = $product->category->name . DS . $uploaded_file['saved_as'];
					$img->alt = $val->validated( 'image_alt' . $i );
					$img->product_id = $product->id;
					$img->save();

					Image::load( 'assets/uploads/' . $img->name )
						->resize( 60 )
						/* ->save( 'assets/uploads/' . $product->category->name . '/' . basename( $uploaded_file['saved_as'], '.' 
							. $uploaded_file['extension'] ) . '-thumbnail' ); */
						->save_pa( null, '-thumbnail' );

					/* start check image size */
					$original_image_size = explode( ' ', getimagesize( 'assets/uploads/' . $img->name )[3] );
					list( $image_width, $image_height ) = $original_image_size;
					$image_width = intval( str_replace( '"', '', explode( '=', $image_width )[1] ) );
					$image_height = intval( str_replace( '"', '', explode( '=', $image_height )[1] ) );

					if( $image_width > 800 && $image_width > $image_height )
					{
						Image::load( 'assets/uploads/' . $img->name )
							->resize( 800 )
							->save( 'assets/uploads/' . $img->name );
					}
					if( $image_height > 600 && $image_height > $image_width )
					{
						Image::load( 'assets/uploads/' . $img->name )
							->resize( null, 600 )
							->save( 'assets/uploads/' . $img->name );
					}
					/* end check image size */
					$i++;
				}				
			}
			else
			{
				foreach( Upload::get_errors() as $file_error )
				{
					echo "error";
				}
			}
			/* end upload images */

			Session::set_flash( 'flash_message', 'Product has been successfully modified' );
			Response::redirect( 'admin/products' );
		}

		foreach( $product->images as $prodImage )
		{
			$product_images[] = $prodImage;
		}

		$categories = Model_Category::find( 'all', array(
			'order_by' => array( 'name' => 'asc' )
		));

		$this->template->title = 'Admin &raquo; Products &raquo; Create';
		$this->template->content = View::forge('admin/products/edit', array(
			'categories' => $categories,
			'val' => $val,
			'product' => $product,
			'product_images' => isset( $product_images ) ? $product_images : null
		));
	}


	public function action_delete_image( $image_id, $product_id )
	{
		Model_Image::delete_image( $image_id );
		Model_Image::find( $image_id )
			->delete();
		Response::redirect( 'admin/products/edit/' . $product_id );
	}


	public function action_delete( $product_id )
	{
		$product = Model_Product::find( $product_id );

		// delete all images associated with product
		foreach( $product->images as $image )
		{
			Model_Image::delete_image( $image->id );
			Model_Image::find( $image->id )
				->delete();
		}

		$product->delete();
		
		Session::set_flash( 'flash_message', 'Product has been successfully deleted' );
		Response::redirect( 'admin/products' );
	}

}