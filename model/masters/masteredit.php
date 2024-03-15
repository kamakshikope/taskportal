<?php

require_once("../../config/process.php");
$database = new Database();
$db = $database->getConnection();
$publ = new Process();
$userId = $_SESSION['userId'];
$todaydate = date('Y-m-d H:i:s');
$request = json_decode(file_get_contents("php://input", true));
$mastername = trim($request->mastername);

if($mastername == "total_users")//Total Usrs
{
	$getcntQry  = $db->prepare("select count(*) as cnt from users ");
	$getcntQry->execute();
	$uarray = $getcntQry->fetchAll(PDO::FETCH_ASSOC);
	if(!empty($uarray))
	{
		$noofusers = $uarray[0]['cnt'];
	}
	else
	{
		$noofusers = 0;
	}
	$output['status']  = "1";
	$output['totalusers']  = $noofusers;
	echo json_encode($output);
}
else if($mastername == "user_master")//user Master
{
	if($request->autopassword == true)
	{
		$strongpass = randomPassword();
		$strongpass = md5($strongpass);
	}
	else
	{
		$strongpass = md5($request->password);
	}
		
	if(!empty($request->uid) && trim($request->uid) > 0)
	{
		$mstQry  = $db->prepare("UPDATE users SET first_name = '{$request->first_name}', last_name = '{$request->last_name}', phone = '{$request->phone}', email = '{$request->email}', password = '{$strongpass}' WHERE id = {$request->uid} ");
		try{$mstQry->execute();
		$output['status']  = "1";
		}catch (Exception $err){$publ->internalError($err);$output['status']  = "0";}
		
		
	}
	else
	{
		$mstQry  = $db->prepare("INSERT INTO users (first_name, last_name, phone, email, password, registered_at, role_id) VALUES('{$request->first_name}', '{$request->last_name}',  '{$request->phone}',  '{$request->email}',  '{$strongpass}', '$todaydate', 2)");
		try{$mstQry->execute();
		$output['status']  = "1";
		}catch (Exception $err){$publ->internalError($err);$output['status']  = "0";}
		
	}
	echo json_encode($output);
	
}
else if($mastername == "downloadtasks")
{
	
	$getQry  = $db->prepare("select start_time, stop_time, notes, description, created_at from tasks where user_id = $request->uid ");
	$getQry->execute();
	$uarray = $getQry->fetchAll(PDO::FETCH_ASSOC);
	$csv_fields1 = array('Tasks List');
	$csv_fields2 = array('Start Time', 'Stop Time', 'Notes', 'Description', 'Created');
	$f = fopen('php://output',  "w");
	fputcsv($f, $csv_fields1);
	fputcsv($f, $csv_fields2);
	foreach ($uarray as $line) {
		fputcsv($f, $line);
	}
	 fclose( $f );
	 exit;
}
	

function randomPassword() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}


		
?>