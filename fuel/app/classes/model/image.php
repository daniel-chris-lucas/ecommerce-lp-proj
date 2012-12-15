<?php

class Model_Image extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'name',
		'alt',
		'product_id',
		'folder'
	);


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


	public static function calculate_width( $img_width, $img_height, $wanted_size )
	{
		$division = $img_width / $wanted_size;
		return array( 'width' => $img_width / $division, 'height' => $img_height / $division );
	}


	public static function calculate_height( $img_width, $img_height, $wanted_size )
	{
		$division = $img_height / $wanted_size;
		return array( 'width' => $img_width / $division, 'height' => $img_height / $division );
	}


	public static function get_thumbnail( $img_name )
	{
		$ext = strrchr( $img_name, '.' );
		$img = substr( $img_name, 0, ( strlen( $img_name ) ) - ( strlen( $ext ) ) );
		$img .= '-thumbnail' . $ext;
		return $img;
	}
}
