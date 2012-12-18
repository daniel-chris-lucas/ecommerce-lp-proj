<?php
/**
 * Permet de supprimer les fichiers images + les information sur l'image dans la BDD, de redimmensionner les images et de retrouver
 * les petites copies des grandes images
 */
class Model_Image extends \Orm\Model
{
	/**
	 * Definition des propriétés de la modèle: utilisé par l'ORM
	 */
	protected static $_properties = array(
		'id',
		'name',
		'alt',
		'product_id',
		'folder'
	);


	/**
	 * Supprime les informations sur l'image de la BDD puis supprime l'image et sa petite copie
	 * @param Integer $image_id L'ID de l'image à supprimer
	 */
	public static function delete_image( $image_id )
	{
		$img = Model_Image::find( $image_id );

		$thumb = $img->name;
		$ext = strrchr( $thumb, '.' );
		if( $ext !== false ) $thumb = substr( $thumb, 0, -strlen( $ext ) );
		$thumb = $img->folder . DS . $thumb . '-thumbnail' . $ext;

		unlink( 'assets/uploads/' . $img->folder . DS . $img->name );
		unlink( 'assets/uploads/' . $thumb );
	}


	/**
	 * Permet de redimmensionner les images horizontales
	 * @param Integer $img_width Le largeur de l'image
	 * @param Integer $img_height La hauteur de l'image
	 * @param Integer $wanted_size Le largeur souhaité de l'image
	 * @return Array Tableau contenant le nouveau largeur et hauteur de l'image
	 */
	public static function calculate_width( $img_width, $img_height, $wanted_size )
	{
		$division = $img_width / $wanted_size;
		return array( 'width' => $img_width / $division, 'height' => $img_height / $division );
	}


	/**
	 * Permet de redimmensionner les images verticales
	 * @param Integer $img_width Le largeur de l'image
	 * @param Integer $img_height La hauteur de l'image
	 * @param Integer $wanted_size La hauteur souhaité de l'image
	 * @return Array Tableau contenant le nouveau largeur et hauteur de l'image
	 */
	public static function calculate_height( $img_width, $img_height, $wanted_size )
	{
		$division = $img_height / $wanted_size;
		return array( 'width' => $img_width / $division, 'height' => $img_height / $division );
	}


	/**
	 * Retrouve la petite copie de l'image en enlevant l'extension, ajoutant -thumbnail et puis en remettant l'extension à la fin
	 * @param String $img_name Le nom de la grande image
	 * @return String Le nom de la petite image
	 */
	public static function get_thumbnail( $img_name )
	{
		$ext = strrchr( $img_name, '.' );
		$img = substr( $img_name, 0, ( strlen( $img_name ) ) - ( strlen( $ext ) ) );
		$img .= '-thumbnail' . $ext;
		return $img;
	}
}
