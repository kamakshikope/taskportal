<?php

require_once("../../config/process.php");
$database = new Database();
$db = $database->getConnection();
$sql_details = $database->getConnectionDet();
$uid = trim($_GET['uid']);
	// DB table to use
	$table = <<<EOT
	 (
		SELECT 
		  a.*
		  FROM tasks a where user_id = $uid
		
	) temp
	EOT;
	 
	// Table's primary key
	$primaryKey = 'id';
	
	$columns = array(
    array( 'db' => 'id', 'dt' => 0 ),
    array( 'db' => 'start_time', 'dt' => 1 ),
    array( 'db' => 'stop_time', 'dt' => 2),
    array( 'db' => 'notes', 'dt' => 3),
    array( 'db' => 'description', 'dt' => 4),
    array( 'db' => 'created_at', 'dt' => 5),
  
	
);

require( '../../assets/vendor/ssp.class.join.php' );

	
	
	$output = json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns ));
	echo $output;

?>