<?php

class Model_Category extends \Orm\Model
{

	protected static $_properties = array(
		'id',
		'name',
		'parent_id',
		'slug'
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

	protected static $_has_many = array( 'products' );


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


	public static function generate_categories_subcategories()
	{
		$result = DB::query('
					  SELECT parent.name AS parent_name, parent.slug AS parent_slug, child1.name AS child1_name, child1.slug AS child1_slug
					  FROM categories AS parent
					  LEFT OUTER JOIN categories AS child1 ON child1.parent_id = parent.id
					  WHERE parent.parent_id IS NULL
					  ORDER BY parent_name, child1_name 
				  ')->execute()
					->as_array();

		return $result;
	}

}
