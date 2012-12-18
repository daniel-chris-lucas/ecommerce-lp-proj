<?php
/**
 * Contient les pages permettant de voir tous les produits, de créer des produits, de modifier des produits, et de supprimer
 * des produits
 */
class Controller_Admin_Products extends Controller_Admin_Base
{

	/**
	 * Affiche la page qui permet de voir tous les produits qui existent sur le site
	 */
	public function action_index()
	{
		// Chercher les produits dans la BDD
		$products = Model_Product::find( 'all' );

		// Creation du sous menu Add New Product
		$submenus = array(
			array( 'name' =>'Add New', 'link' => 'admin/products/create', 'class' => 'menu_icons')
		);
		// Comme submenus est dans la partie template il faut la declarer en tant que variable globale
		View::set_global( 'submenus', $submenus );

		// Affichage de la page
		$this->template->title = 'Admin &raquo; Products';
		$this->template->content = View::forge('admin/products/index', array(
			'products' => $products
		));
	}


	/**
	 * Affiche la page permettant de créer de nouveaux produits
	 */
	public function action_create()
	{
		// Définition des règles de validation pour le formulaire de création
		$val = Validation::forge();
		$val->add( 'name', 'Name' )
			->add_rule( 'required' )
			->add_rule( 'min_length', 3 )
			->add_rule( 'max_length', 255 );
		$val->add( 'slug', 'Slug' )
			->add_rule( 'min_length', 3 )
			->add_rule( 'max_length', 100);
		$val->add( 'description', 'Description' )
			->add_rule( 'required' )
			->add_rule( 'min_length', 10 )
			->add_rule( 'max_length', 2000 );
		$val->add( 'category', 'Category' )
			->add_rule( 'numeric_min', 1 );
		$val->add( 'price', 'Price' )
			->add( 'numeric_min', 1 );
		// L'admin peut ajouter 5 images pour un produit donc il faut vérifier chaque image
		for( $i = 0; $i <= 5; $i++ )
		{
			$val->add( "image{$i}", "Image {$i}" );
			$val->add( "image_alt{$i}", "Image {$i} Text" )
				->add_rule( 'min_length', 5 )
				->add_rule( 'max_length', 255 );
		}

		// Si tous le champs sont correctement remplis on peut créer le produit
		if( Input::method() == 'POST' && $val->run() )
		{
			$product = Model_Product::forge();
			$product->name = $val->validated( 'name' );
			$product->description = $val->validated( 'description' );
			$product->category_id = $val->validated( 'category' );
			$product->price = $val->validated( 'price' );
			$product->slug = $val->validated( 'slug' );
			$product->save();

			/*-----------------------------------------------------------------*
			| START UPLOAD IMAGES                                              |
			*-----------------------------------------------------------------*/
			// s'il y a déjà 5 images pour le produit il faut que l'admin supprime des images
			if( count( $product->images ) > 5 )
			{
				Session::set_flash( 'flash_message', '5 images already exist for this product' );
				Response::redirect( Uri::current() );
			}

			// Specification du dossier où il faut placer les images, dire qu'il faut remplacer le nom de l'image par une chaine 
			// de caractères aléatoire puis quels formats de fichiers peuvent être acceptés
			$upload_config = array(
			    'path' => DOCROOT.'assets/uploads/'.$product->category->name,
			    'randomize' => true,
			    'ext_whitelist' => array('img', 'jpg', 'jpeg', 'gif', 'png')
			);

			// Mettre les fichiers dans une espace temporaire et vérifier que les fichiers sont valides
			Upload::process($upload_config);

			// Si les fichiers sont valides il faut les mettre dans le bon dossier, enregistrer les images dans la BDD et dire a quel
			// produit ils appartiennent.
			if( Upload::is_valid() )
			{
				// Mettre les images dans le bon dossier
				Upload::save();
				$i = 1;

				// Enregistrer chaque image dans la BDD
				foreach( Upload::get_files() as $uploaded_file )
				{
					// Enregistrement dans la BDD des informations de chaque image
					$img = Model_Image::forge();
					$img->name =  $uploaded_file['saved_as'];
					$img->alt = $val->validated( 'image_alt' . $i );
					$img->product_id = $product->id;
					$img->folder = $product->category->name;
					$img->save();


					/* Si l'image est trop grande on la redimensionne avec un maximum de 800px de large ou 600px de haut */
					$original_image_size = explode( ' ', getimagesize( 'assets/uploads/' . $img->folder . DS . $img->name )[3] );
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
					/* Fin du redimmensionnement des images*/


					// Enregistrer une nouvelle copie de l'image avec l'extension -thumbnail pour des images plus petits
					Image::load( 'assets/uploads/' . $img->folder . DS . $img->name )
						// Mettre le largeur de l'image à 60px
						->resize( 60 )
						->save_pa( null, '-thumbnail' );

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
			/*-----------------------------------------------------------------*
			| END UPLOAD IMAGES                                              |
			*-----------------------------------------------------------------*/

			// Rediriger l'admin vers la page de vue de tous les produits
			Session::set_flash( 'flash_message', 'New product has been successfully added' );
			Response::redirect( 'admin/products' );
		}

		// Chercher toutes les catégories pour la sélection de la catégorie à laquelle le produit appartient
		$categories = Model_Category::find( 'all', array(
			'order_by' => array( 'name' => 'asc' )
		));

		// Creation du sous menu Return to Products
		$submenus = array(
			array( 'name' =>'Retun to Products', 'link' => 'admin/products', 'class' => 'menu_icons')
		);
		// Comme submenus est dans la partie template il faut la declarer en tant que variable globale
		View::set_global( 'submenus', $submenus );

		// Affichage de la page
		$this->template->title = 'Admin &raquo; Products &raquo; Create';
		$this->template->content = View::forge('admin/products/create', array(
			'categories' => $categories,
			'val' => $val
		));
	}


	/**
	 * Affiche la page de modification de produits
	 * @param Integer $product_id L'ID du produit à modifier
	 */
	public function action_edit( $product_id )
	{
		// Chercher les informations sur le produit dans la BDD
		$product = Model_Product::find( $product_id );

		// Définition des règles de validation
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

		// Si tous les champs sont correctement remplis on peut modifier les informations du produit
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

		// Chercher toutes les images appartenant au produit
		foreach( $product->images as $prodImage )
		{
			$product_images[] = $prodImage;
		}

		// Chercher toutes les catégories pour la sélection des catégories à laquelle appartient le produit
		$categories = Model_Category::find( 'all', array(
			'order_by' => array( 'name' => 'asc' )
		));

		// Affichage de la page de modification
		$this->template->title = 'Admin &raquo; Products &raquo; Create';
		$this->template->content = View::forge('admin/products/edit', array(
			'categories' => $categories,
			'val' => $val,
			'product' => $product,
			'product_images' => isset( $product_images ) ? $product_images : null
		));
	}


	/**
	 * La fonction permet de supprimer une image
	 * @param Integer $image_id L'ID de l'image à supprimer
	 * @param Integer $product_id L'ID du produit auquel appartient l'image
	 */
	public function action_delete_image( $image_id, $product_id )
	{
		// Supprimer le fichier de l'image
		Model_Image::delete_image( $image_id );
		// Supprimer les informations de l'image dans la BDD
		Model_Image::find( $image_id )
			->delete();
		// Rediriger l'admin vers la page de modification de produit sur lequel il était
		Response::redirect( 'admin/products/edit/' . $product_id );
	}


	/**
	 * La fonction permet de supprimer un produit
	 * @param Integer $product_id L'ID du produit à supprimer
	 */
	public function action_delete( $product_id )
	{
		// Chercher le produit a supprimer dans la BDD
		$product = Model_Product::find( $product_id );

		// Supprimer toutes les images liées au produit
		foreach( $product->images as $image )
		{
			Model_Image::delete_image( $image->id );
			Model_Image::find( $image->id )
				->delete();
		}

		// Supprimer le produit de la BDD
		$product->delete();
		
		// Rediriger l'admin vers la liste des produits
		Session::set_flash( 'flash_message', 'Product has been successfully deleted' );
		Response::redirect( 'admin/products' );
	}

}