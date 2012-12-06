<?php
class MyRules
{

	public static function _validation_unique( $val, $options, $name = null )
	{
		list( $table, $field ) = explode( '.', $options );

		$res = \DB::select( "LOWER (\"$field\")" )
					->where( $field, '=', Str::lower( $val ) )
					->from( $table )
					->execute();

		if( $name != null ) {
			if( ( $res->count() > 0 ) )
			{
				if( Str::lower( $name ) == Str::lower( $val ) )
				{
					return true;
				}
			}
		}

		return ! ( $res->count() > 0 );
	}

}