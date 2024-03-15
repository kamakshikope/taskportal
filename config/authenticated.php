<?php
require_once("process.php");
$process = new Process();
$auth = $process->getAuth();

//Current Page URL
if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
	 $url = "https://";   
else  
	 $url = "http://";   
// Append the host(domain name, ip) to the URL.   
$url.= $_SERVER['HTTP_HOST'];   

// Append the requested resource location to the URL   
$url.= $_SERVER['REQUEST_URI'];    

$roleid = $_SESSION['role_id'];
	
//Case 1
if($auth ==0 )
	header("Location:".BASE_PATH."login.php");
//Case 2
else if(BASE_PATH == $url)
	header("Location:".BASE_PATH."views/dashboard.php");

?>