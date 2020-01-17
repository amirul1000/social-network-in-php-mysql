<?php
session_start();
error_reporting(0);
include("../common/lib.php");
include("../lib/class.db.php");
include("../common/config.php");

$cmd = $_REQUEST['cmd'];

switch($cmd)
{

	case "login":
		$info["table"]     = "users";
		$info["fields"]   = array("*");
		$info["where"]    = "1=1 AND email  LIKE BINARY '".clean($_REQUEST["email"])."' AND password  LIKE BINARY '".clean($_REQUEST["password"])."' AND type='entrepreneur'";
		$res  = $db->select($info);

		if(count($res)>0)
		{
			$_SESSION["users_id"]   = $res[0]["id"];
			$_SESSION["email"]      = $res[0]["email"];
			$_SESSION["first_name"] = $res[0]["first_name"];
			$_SESSION["last_name"]  = $res[0]["last_name"];
			$_SESSION["cell_no"]  = $res[0]["cell_no"];
			$_SESSION["type"]       = $res[0]["type"];
			
			/////////set online offline////
			  unset($info);
			  unset($data);
			$info["table"]     = "plus_login";
			$info["fields"]   = array("*");
			$info["where"]    = "1=1 AND users_id='".$_SESSION["users_id"]."'";
			$res  = $db->select($info); 
			
			if(count($res)==0)
			{
			      unset($info);
				  unset($data);
				$info["table"]     = "plus_login";
				$data['users_id']  = $_SESSION["users_id"];
				$data['ip']        = $_SERVER['REMOTE_ADDR'];
				$data['tm']        = time();
				$data['status']    = 'online';				
				$info['data'] = $data;
				  $db->insert($info);
			}
			else
			{
			      unset($info);
				  unset($data);
				$info["table"]     = "plus_login";
				$data['ip']        = $_SERVER['REMOTE_ADDR'];
				$data['tm']        = time();
				$data['status']    = 'online';
				$info['data'] = $data;
			    $info["where"]     = "1 AND users_id='".$_SESSION["users_id"]."'";
			    $db->update($info);
			}
			////////////////////////////////////
			
			if(!is_company_record($db))
			{
				Header("Location: ../company/index?cmd=edit");
			}
			else
			{
				Header("Location: /company/index?cmd=list");
			}
		}
		else
		{
			$message="Login fail,Please verify your userid or password";
			include("login_editor.php");
		}
		break;
	case "logout":
	    /////////set online offline//// 
		 if(isset($_SESSION["users_id"]))
         {
			  unset($info);
			  unset($data);
			$info["table"]     = "plus_login";
			$data['ip']        = $_SERVER['REMOTE_ADDR'];
			$data['tm']        = time();
			$data['status']    = 'offline';
			
			$info['data'] = $data;
			$info["where"]     = "1 AND users_id='".$_SESSION["users_id"]."'";
			$info["debug"]     = true;
			$db->update($info); 
		 }
	   ////////////////////////////////////	
		
		session_destroy();
		unset($_SESSION["users_id"]);
		unset($_SESSION["email"]);
		unset($_SESSION["first_name"]);
		unset($_SESSION["last_name"]);
		unset($_SESSION["type"]);
		Header("Location: /");
		break;
	case "forget_editor":
		include("forget_editor.php");
		break;
	case "forget_pass":
		$info["table"]     = "users";
		$info["fields"]   = array("*");
		$info["where"]    = " 1=1 AND email  LIKE BINARY '".$_REQUEST["email"]."'";
		$res  = $db->select($info);
		if(count($res)>0)
		{
			$email      = $res[0]["email"];
			$password      = $res[0]["password"];
			$cell_no      = $res[0]["cell_no"];
			//send email
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				
			// Additional headers
			//$headers .= 'To: '.$data['email'].'' . "\r\n";
			$headers .= 'From: 0Place <0Place@info.com>' . "\r\n";
			//$headers .= 'Cc: birthdayarchive@example.com' . "\r\n";
			//$headers .= 'Bcc: birthdaycheck@example.com' . "\r\n";
				
			// Mail it
			$subject = "Forget Password from DOE Automation";
			$message_body  = get_forget_pass_email_message($email ,$password);
			$message = "An email or SMS has been sent with your login information";
			mail($email, $subject, $message_body, $headers);
				
			include("login_editor.php");
			break;
		}
		else
		{
			$message ="No Email is exists with this email";
			include("forget_editor.php");
			break;
		}
	default :
		session_destroy();
		unset($_SESSION["users_id"]);
		unset($_SESSION["email"]);
		unset($_SESSION["first_name"]);
		unset($_SESSION["last_name"]);
		unset($_SESSION["type"]);
			
		include("login_editor.php");
}
function is_company_record($db)
{
	$info["table"] = "company";
	$info["fields"] = array("company.*");
	$info["where"]   = "1 AND users_id='".$_SESSION['user_id']."'";
	$arr =  $db->select($info);
	if(count($arr)>0)
	{
		return true;
	}
	return false;
}
//message 
function get_forget_pass_email_message($userid ,$password)
{
   $str = "Dear Entrepreneur,<br>	        
	        You login info is:<br> 
	        Your userid :$userid  <br>
			Password    :$password <br>
			Thanks,<br>
			Department of Environment<br>";    
	    
		return $str;
}
function clean($str) {
	$str = @trim($str);
	if(get_magic_quotes_gpc()) {
		$str = stripslashes($str);
	}
	return mysql_real_escape_string($str);
}
?>