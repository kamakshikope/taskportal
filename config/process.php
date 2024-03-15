<?php
session_start();
require_once("config.php");
require_once("database.php");

class Process
{
	public $is_authenticated;
	public function getAuth(){
		$this->is_authenticated = null;
		try{
           $this->is_authenticated = (($_SESSION['userId']!='')?$_SESSION['userId']:0);
        }catch(PDOException $exception){
            $this->is_authenticated =  $exception->getMessage();
        } 
        return $this->is_authenticated;
		
    }
	public function internalError($err){
		$output['msg']   	= "Internal server error"; //Internal server error
		$output['err_msg']	= $err;
		return json_encode($output);
	}
	
	public function checkpostdate($dt){
		$database = new Database();
		$db = $database->getConnection();
		$compdet = $db->prepare("select * from period_lock Where ('".$dt."' BETWEEN from_date AND to_date) AND lock_status = 1");
		$compdet->execute();
		$compdetArr = $compdet->fetchAll(PDO::FETCH_ASSOC);
		if(empty($compdetArr))
		{
			$op = 0;//Not Locked
		}
		else
		{
			$op = 1;//Locked
		}
		return $op;
	}
	
	
}
?>
