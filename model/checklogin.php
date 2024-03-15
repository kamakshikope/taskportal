<?php

require_once("../config/process.php");
$database = new Database();
$db = $database->getConnection();

$request = json_decode(file_get_contents("php://input", true));
$username = trim($request->username);
$password = trim($request->password);
$password = md5($password);
		
//login
$loginQry  = $db->prepare("SELECT * from users where email='{$username}' and password ='{$password}' limit 1");
try{$loginQry->execute();
}catch (Exception $err){$loginQry->internalError($err);}
$loginArr = $loginQry->fetchAll(PDO::FETCH_ASSOC);
if(!empty($loginArr))
{
	$last_password_change =  $loginArr[0]['last_password_change'];
	$last_password_changevalue = strtotime($last_password_change);
	$current_time = time();
	$password_change_interval = 30 * 24 * 60 * 60;
	
	if (($current_time - $last_password_changevalue) > $password_change_interval) {
		$output['responsepage'] =  '';
		$output['msg'] =  'changepassword';
		$output['status']  = "1"; 
		
	}
	else
	{
		$_SESSION['userId'] =  $loginArr[0]['id'];
		$_SESSION['username'] =  $loginArr[0]['email'];
		$_SESSION['role_id'] =  $loginArr[0]['role_id'];
		
		
		//UPdate Last LOgin
		$lastlogin = date('Y-m-d H:i:s');
		$uploginQry  = $db->prepare("UPDATE users SET last_login = {$lastlogin} where id ='{$loginArr[0]['id']}'");
		$uploginQry->execute();
		
		$output['responsepage'] =  ($loginArr[0]['role_id']==1?'dashboard':'tasks');
		$output['status']  = "1"; 
	}

}
else
{
	$output['status']  = "0"; 
	$output['statusmsg']  = "Invalid Username and Password!"; 
	
	
}
echo json_encode($output);
		
?>