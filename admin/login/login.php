<?php
session_start();
include("../../common/lib.php");
include("../../lib/class.db.php");
include("../../common/config.php");

$cmd = $_REQUEST['cmd'];
switch($cmd)
{

	case "login":
		$info["table"]     = "adminusers";
		$info["fields"]   = array("*");
		$info["where"]    = " 1=1 AND email='".clean($_REQUEST["email"])."' AND password='".clean($_REQUEST["password"])."'";
		$res  = $db->select($info);
			
		if(count($res)>0)
		{
			$_SESSION["adminusers_id"] = $res[0]["id"];
			$_SESSION["email"]      = $res[0]["email"];
			$_SESSION["first_name"] = $res[0]["first_name"];
			$_SESSION["last_name"]  = $res[0]["last_name"];
			$_SESSION["type"]       = $res[0]["type"];
			Header("Location: ../login/login_enter.php");

		}
		else
		{
			$message="Login fail,Please verify your userid or password";
			include("login_editor.php");
		}
		break;
	case "logout":
		session_destroy();
		unset($_SESSION["adminusers_id"]);
		unset($_SESSION["email"]);
		unset($_SESSION["first_name"]);
		unset($_SESSION["last_name"]);
		unset($_SESSION["type"]);

		include("login_editor.php");
		break;
	default :
		session_destroy();
		unset($_SESSION["adminusers_id"]);
		unset($_SESSION["email"]);
		unset($_SESSION["first_name"]);
		unset($_SESSION["last_name"]);
		unset($_SESSION["type"]);
			
		include("login_editor.php");
}
function clean($str) {
	$str = @trim($str);
	if(get_magic_quotes_gpc()) {
		$str = stripslashes($str);
	}
	$str = stripslashes($str);
	$str = str_replace("'","",$str);
	$str = str_replace('"',"",$str);
	$str = str_replace("-","",$str);
	$str = str_replace(";","",$str);
	$str = str_replace("or 1","",$str);
	$str = str_replace("drop","",$str);
	
	return mysql_real_escape_string($str);
}					
?>