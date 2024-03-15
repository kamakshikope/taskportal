<?php

require_once("../../config/process.php");
$database = new Database();
$db = $database->getConnection();
$publ = new Process();
$userId = $_SESSION['userId'];
$todaydate = date('Y-m-d H:i:s');
$request = json_decode(file_get_contents("php://input", true));
$mastername = trim($request->mastername);
$user_id = $_SESSION['userId'];
if($mastername == "tasks_list")//tasks_list
{
	
	if(!empty($request->tid) && trim($request->tid) > 0)
	{
		$mstQry  = $db->prepare("UPDATE tasks SET start_time = '{$request->start_time}', stop_time = '{$request->stop_time}', notes = '{$request->notes}', description = '{$request->description}' WHERE id = {$request->tid} ");
		try{$mstQry->execute();
		$output['status']  = "1";
		}catch (Exception $err){$publ->internalError($err);$output['status']  = "0";}
		
		
	}
	else
	{
		$mstQry  = $db->prepare("INSERT INTO tasks (start_time, stop_time, notes, description,  created_at, user_id) VALUES('{$request->start_time}', '{$request->stop_time}',  '{$request->notes}',  '{$request->description}',  '$todaydate',  '$user_id')");
		try{$mstQry->execute();
		$output['status']  = "1";
		}catch (Exception $err){$publ->internalError($err);$output['status']  = "0";}
		
	}
	echo json_encode($output);
	
}
else if($mastername == "downloadtasks")
{
	
	$getQry  = $db->prepare("select * from users ");
	$getQry->execute();
	$uarray = $getQry->fetchAll(PDO::FETCH_ASSOC);
	
	$f = fopen('php://output',  "w");
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