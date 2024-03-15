<?php

require_once("../config/process.php");
$database = new Database();
$db = $database->getConnection();

$request = json_decode(file_get_contents("php://input", true));
$username = trim($request->username);
		
//login
$loginQry  = $db->prepare("SELECT * from users where email='{$username}' limit 1");
try{$loginQry->execute();
}catch (Exception $err){$loginQry->internalError($err);}
$loginArr = $loginQry->fetchAll(PDO::FETCH_ASSOC);
if(!empty($loginArr))
{
	$last_change = $loginArr[0]['last_password_change'];
	if($last_change == '' || $last_change == null)
		$output['msg'] =  'firstlogin';
	else
		$output['msg'] =  'not';
	$output['status']  = "1"; 

}
else
{
	$output['status']  = "0"; 
	$output['statusmsg']  = "Username is not Found"; 
	
	
}
echo json_encode($output);
		
?>