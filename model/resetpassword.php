<?php

require_once("../config/process.php");
$database = new Database();
$db = $database->getConnection();

$request = json_decode(file_get_contents("php://input", true));
$username = trim($request->username);
$password = trim($request->password);
$cyourPassword = trim($request->cyourPassword);
$hashedpassword = md5($password);
		
//login
$loginQry  = $db->prepare("SELECT * from users where email='{$username}' limit 1");
try{$loginQry->execute();
}catch (Exception $err){$loginQry->internalError($err);}
$loginArr = $loginQry->fetchAll(PDO::FETCH_ASSOC);
if(!empty($loginArr))
{
	if($cyourPassword == $password)
	{
		
		//UPdate Last LOgin & Password
		$last_password_change = date('Y-m-d H:i:s');
		$uploginQry  = $db->prepare("UPDATE users SET password = '{$hashedpassword}' , last_password_change = '{$last_password_change}' where id ='{$loginArr[0]['id']}'");
		$uploginQry->execute();
		
		$output['msg'] =  'success';
	}
	else
	{
		$output['msg'] = 'failure';
	}
	$output['status']  = "1"; 

}
else
{
	$output['status']  = "0"; 
	$output['statusmsg']  = "Invalid Username and Password!"; 
	
	
}
echo json_encode($output);
		
?>