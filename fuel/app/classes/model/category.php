<?php

class Model_Category extends \Orm\Model
{

	protected static $_properties = array(
		'id',
		'name',
		'parent_id'
	);


	protected static $_belongs_to = array(
	    'parent' => array(
	        'key_from' => 'parent_id',
	        'model_to' => 'Model_Category',
	        'key_to' => 'id',
	        'cascade_save' => true,
	        'cascade_delete' => false,
	    )
	);


	public static function count_categories()
	{
		$result = DB::select( DB::expr( 'COUNT(*) as count' ) )->from( 'categories' )->execute()->current();
		return $result['count'];
	}


	public static function find_children( $parent_id )
	{
		$children = DB::select( 'id' )
						->from( 'categories' )
						->where( 'parent_id', '=', $parent_id )
						->execute()
						->as_array();

		foreach( $children as $child )
		{
			$children_arr[] = $child;
		}

		return $children;
	}

}
