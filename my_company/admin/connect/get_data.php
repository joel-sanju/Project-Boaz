<?php
session_start(); 

session_write_close(); //prevent session locking

$dataz = json_decode(file_get_contents('php://input'), true);

require '../../connect/config.php';

if(isset($_SESSION['admina'])){
	$uid = 	$_SESSION['admina'];
	}
else{
	
	die(die(json_encode(array("error" => 'auttentication error. Please refresh browser and login'))));
	}


/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simple to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 */
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */
 
// DB table to use



if($_REQUEST['table'] == "managers"){
		$is_complex = true;
		$wheres = "level != 9";
		$primaryKey = 'id';
		$table =  "managers";
		$columns = array(
			array( 'db' => 'id', 'dt' => 0 ),
			array( 'db' => 'fname',     'dt' => 1 ),
			array( 'db' => 'lname',     'dt' => 2 ),
			array( 'db' => 'email',     'dt' => 3 ),
			array( 'db' => 'phone',     'dt' => 4 ),	
		);
	
}



elseif($_REQUEST['table'] == "users"){
	$table =  "(SELECT a.*, b.files FROM users a LEFT JOIN (SELECT uid,  GROUP_CONCAT(file separator ',,') AS files FROM user_files GROUP BY uid) b ON a.id = b.uid) temp";
	// Table's primary key
	$primaryKey = 'id';
	$is_complex = false;             
	$columns = array(
		array( 'db' => 'id', 'dt' => 0 ),
		array( 'db' => 'fname',   'dt' => 1 ),
		array( 'db' => 'email',     'dt' => 2 ),
		array( 'db' => 'phone',     'dt' => 3 ),
		array( 'db' => 'files',     'dt' => 4 ),
		
	);

}



 
// SQL server connection information
$sql_details = array(
    'user' => dbuser,
    'pass' => dbpass,
    'db'   => dbname,
    'host' => dbhost
);
 
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */
require( 'ssp_class.php' );
 
 
 if($is_complex){
	echo json_encode(
		SSP::complex( $_GET, $sql_details, $table, $primaryKey, $columns, $whereAll = null, $wheres)
		);	 
	 
 }
 else{
 
	echo json_encode(
		SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns)
	);
 }









