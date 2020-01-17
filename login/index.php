<?php
       /*
		  Name: Login 
		  Author: Amirul Momenin
		  Version: 1.0 
		*/
       session_start();
	   include("../common/lib.php");
	   include("../lib/class.db.php");
	   include("../common/config.php");
	   	   
	   $cmd = $_REQUEST['cmd'];
	 
		switch($cmd)
		{
		
		  case "login":
			$info["table"]     = "users";
			$info["fields"]   = array("*");
			$info["where"]    = " 1=1 AND username  LIKE BINARY '".clean($_REQUEST["username"])."' AND password  LIKE BINARY '".clean($_REQUEST["password"])."' AND status='active'";
			$res  = $db->select($info);
			if($res[0]['verified']=='no')
			{
				$message="Login fail,your account is not verified";
				include("login_editor.php");
				break;
			}
			if(count($res)>0)
			{
				$_SESSION["users_id"]   = $res[0]["id"];
				$_SESSION["username"]   = $res[0]["username"];
				$_SESSION["email"]      = $res[0]["email"];
				$_SESSION["first_name"] = $res[0]["first_name"];
				$_SESSION["last_name"]  = $res[0]["last_name"];
				$_SESSION["city"]       = $res[0]["city"];
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
				
				Header("Location:../home/");
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
				$db->update($info); 
			 }
		   ////////////////////////////////////	
		
		
			session_destroy();
			unset($_SESSION["users_id"]);
			unset($_SESSION["username"]);
			unset($_SESSION["email"]);
			unset($_SESSION["first_name"]);
			unset($_SESSION["last_name"]);
			unset($_SESSION["type"]);
	
			include("login_editor.php");
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
				$first_name    = $res[0]["first_name"];
				$last_name     = $res[0]["last_name"];
				$username         = $res[0]["username"];
				$email         = $res[0]["email"];
				$password      = $res[0]["password"];
				
				$subject = "Recovery Password from http://linkotopia.com/";
				
				$body = "Dear $first_name $last_name,<br>
				        Your Login information is like below:<br> 
						 Email:$username<br> 
						 password:$password<br><br>
						 
						 Thanks,<br>
						 Linkotopia Team";
				//send email
					$headers  = 'MIME-Version: 1.0' . "\r\n";
					$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					$headers .= 'From: Social Network <info@linkotopia.com>' . "\r\n";
					
				mail($_REQUEST["email"], $subject, $body, $headers);
				
				$message ="An email has been sent to your E-mail address";	
				include("login_editor.php"); 
			}
			else
			{
				$message ="No Email is exists with this email";
				include("forget_editor.php");
				break;
			}
			break;
		case "verification_editor":
				include("verification_editor.php");
				break;	   	 	
	    case "resend_code":
			 	$info["table"]     = "users";
				$info["fields"]   = array("*");
				$info["where"]    = " 1=1 AND email  LIKE BINARY '".$_REQUEST["email"]."'";
				$res  = $db->select($info);
				if(count($res)>0)
				{
				    $id                = $res[0]["id"];
					$username             = $res[0]["username"];	   
					$email             = $res[0]["email"];	   	 
					$password          = $res[0]["password"];
					$first_name        = $res[0]["first_name"];	   	
					$last_name         = $res[0]["last_name"];
						   	
					$verification_code =  sha1(time());
					
					
					   unset($info);
					   unset($data);
					 $info["table"]                =  "users"; 
					 $data['verification_code']    = $verification_code;
					 $info['data']                 =  $data;
					 $info['where']                =  "id='".$id."'";
					   $db->update($info);
				
					 //send email
					$headers  = 'MIME-Version: 1.0' . "\r\n";
					$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					
					// Additional headers
					//$headers .= 'To: '.$data['email'].'' . "\r\n";
					$headers .= 'From: http://linkotopia.com/ <info@linkotopia.com>' . "\r\n";
					//$headers .= 'Cc: birthdayarchive@example.com' . "\r\n";
					//$headers .= 'Bcc: birthdaycheck@example.com' . "\r\n";
					
					// Mail it
					$subject = "You requested activation code from Social Network"; 
					$message  = "Dear ".$first_name." ".$last_name." ,<br>
						You have requested resent Verification code at http://linkotopia.com/<br>  
						Please click the link below to make your account activate.<br>
						<a href=\"http://linkotopia.com/login/index.php?cmd=verify&code=$verification_code\">$verification_code</a><br>
						Or copy and paste on address bar the link below
						http://linkotopia.com/login/index.php?cmd=verify&code=$verification_code <br>
						You login info is:<br> 
						Your userid :$username  <br>
						Password    :$password <br>
						Thanks,<br>
						Linkotopia Team<br>";
					
					mail($email, $subject, $message, $headers);
					
					$message = "An email  been sent with your activation code";
					
					include("verification_editor.php");
					break;	
				}
				else
				{
					$message ="No Email is exists with this email";	
					include("verification_editor.php");
					break;	 
				}
				break;		
		case "verify":
		        $info["table"]     = "users";
				$info["fields"]   = array("*");
				$info["where"]    = " 1=1 AND verification_code='".$_REQUEST["code"]."'";
				$res  = $db->select($info);
				if(count($res)>0)
				{
				     unset($info);
					 unset($data);
					$info['table']    = "users";
					$data['verified'] = 'yes';
					$data['status']   = 'active';
					$info['data']     =  $data;
					$info['where'] = "verification_code='".$_REQUEST["code"]."'";
					$db->update($info);
				
				     $message ="You are now verified.Please login now.";
				}    
				else
				{
				     $message ="Verified code mismatch";
				}
				include("login_editor.php");
		       break;			
		default :
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
	//$str = str_replace("-","",$str);
	$str = str_replace(";","",$str);
	$str = str_replace("or 1","",$str);
	$str = str_replace("drop","",$str);
	
	return mysql_real_escape_string($str);
}					
?>