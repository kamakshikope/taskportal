<?php

require_once("../../config/process.php");
$database = new Database();
$db = $database->getConnection();
$sql_details = $database->getConnectionDet();


$request = json_decode(file_get_contents("php://input", true));

	// DB table to use
	//$table = 'user_master';
	$table = <<<EOT
	 (
		SELECT 
		  a.*
		  FROM users a
		
	) temp
	EOT;
	 
	// Table's primary key
	$primaryKey = 'id';
	
	$columns = array(
    array( 'db' => 'id', 'dt' => 0 ),
    array( 'db' => 'first_name', 'dt' => 1 ),
    array( 'db' => 'last_name', 'dt' => 2),
    array( 'db' => 'email', 'dt' => 4),
    array( 'db' => 'phone', 'dt' => 3),
    array( 'db' => 'last_login', 'dt' => 5),
    array( 'db' => 'last_password_change', 'dt' => 6),
    array( 'db' => 'registered_at', 'dt' => 7),
    array( 'db' => 'password', 'dt' => 8),
	
);

require( '../../assets/vendor/ssp.class.join.php' );

	
	
	$output = json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns ));
	echo $output;

?>