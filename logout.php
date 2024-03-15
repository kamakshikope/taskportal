<?php 
require_once("config/process.php");

session_destroy();
header("Location:".BASE_PATH."login.php");
?>