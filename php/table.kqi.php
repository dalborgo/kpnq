<?php

/*
 * Editor server script for DB table kqi
 * Created by http://editor.datatables.net/generator
 */

// DataTables PHP library and database connection

include( "lib/DataTables.php" );
// Alias Editor classes so they are easy to use
use
	DataTables\Editor,
	DataTables\Editor\Field,
	DataTables\Editor\Format,
	DataTables\Editor\Mjoin,
	DataTables\Editor\Options,
	DataTables\Editor\Upload,
	DataTables\Editor\Validate;

// The following statement can be removed after the first run (i.e. the database
// table has been created). It is a good idea to do this to help improve
// performance.
/*$db->sql( "CREATE TABLE IF NOT EXISTS `kqi` (
	`id` int(10) NOT NULL auto_increment,
	`data` datetime,
	`cliente_id` numeric(9,2),
	`prepagato` numeric(9,2),
	`costo_totale` numeric(9,2),
	PRIMARY KEY( `id` )
);" );*/

// Build our Editor instance and process the data coming from _POST
Editor::inst( $db, 'kqi', 'id' )
	->fields(
		Field::inst( 'data' )
			->validator( 'Validate::notEmpty' )
			->validator( 'Validate::dateFormat', array( 'format'=>'Y-m-d H:i:s' ) )
			->getFormatter( 'Format::datetime', array( 'from'=>'Y-m-d H:i:s', 'to'  =>'Y-m-d H:i:s' ) )
			->setFormatter( 'Format::datetime', array( 'to'  =>'Y-m-d H:i:s', 'from'=>'Y-m-d H:i:s' ) ),
        Field::inst('cliente_id')->setFormatter( function($val, $data, $field) {
           return $_POST["ci"];
        }),
		Field::inst( 'prepagato')->setFormatter( function($val, $data, $field) {
            if ($val == '' || $val == null)
                return null;
            else
                return str_replace ( ',' , '.' , $val );
        }),
		Field::inst( 'costo_totale' )->setFormatter( function($val, $data, $field) {
            if ($val == '' || $val == null)
                return null;
            else
                return str_replace ( ',' , '.' , $val );
        })
	)
    ->where( 'cliente_id', $_POST["ci"])
	->process( $_POST )
	->json();
