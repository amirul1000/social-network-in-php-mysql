<?php
    /*
	  Name: Register
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
	
		case 'add':
		    if(empty($_REQUEST['id']))
			 {
				 if(account_exits($db,$_REQUEST['username']))
				 {
					$message = "This  Username is already used.Please click login and retrive your password";
					include("register_editor.php");
					exit;
				 }
			 }
			$info['table']    = "users";
			$data['username']   = $_REQUEST['username'];
			$data['email']   = $_REQUEST['email'];
			$data['password']   = $_REQUEST['password'];
			$data['title']   = $_REQUEST['title'];
			$data['first_name']   = $_REQUEST['first_name'];
			$data['last_name']   = $_REQUEST['last_name'];
			$data['phone']   = $_REQUEST['phone'];
			$data['company']   = $_REQUEST['company'];
			$data['address']   = $_REQUEST['address'];
			$data['city']   = $_REQUEST['city'];
			$data['state']   = $_REQUEST['state'];
			$data['zip']   = $_REQUEST['zip'];
			$data['country_id']   = $_REQUEST['country_id'];
			$data['created_at']   = date("Y-m-d H:i:s");
			$data['updated_at']   = date("Y-m-d H:i:s");
			if(empty($_REQUEST['id']))
			{
				$data['verification_code']   = sha1(time());
				$data['verified']   = 'no';
			}
			$data['type']   = 'client';
			if(empty($_REQUEST['id']))
			{
				$data['status']   = 'inactive';
			}
			$info['data']     =  $data;
			if(empty($_REQUEST['id']))
			{
				$db->insert($info);
				
				//send email
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				
				// Additional headers
				//$headers .= 'To: '.$data['email'].'' . "\r\n";
				$headers .= 'From: Linkotopia <info@linkotopia.com>' . "\r\n";
				//$headers .= 'Cc: birthdayarchive@example.com' . "\r\n";
				//$headers .= 'Bcc: birthdaycheck@example.com' . "\r\n";
				$verification_code = $data['verification_code']; 
				$username   = $_REQUEST['username'];
				$email   = $_REQUEST['email'];
				$password = $_REQUEST['password'];
				// Mail it
				$subject = "Verification at Linkotopia"; 
				$message  = "Dear ".$_REQUEST['first_name']." ".$_REQUEST['last_name']." ,<br>
						You have successfully registerd at Linkotopia<br>  
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
			   $message = "An email has been sent to your emaill adress.Please verify your email and get back to login";  		 
			   include("register_success.php");					
			}
			else
			{
				$Id            = $_REQUEST['id'];
				$info['where'] = "id=".$Id;
				$db->update($info);
			}
			//include("register_list.php");
			break;
		case "edit":
			if(empty($_SESSION['users_id']))
			{
				Header("Location: ../login/index.php");
			}
			 
			$Id               = $_REQUEST['id'];
			if( !empty($Id ))
			{
				$info['table']    = "users";
				$info['fields']   = array("*");
				$info['where']    =  "id=".$Id;
					
				$res  =  $db->select($info);
					
				$Id        = $res[0]['id'];
				$email    = $res[0]['email'];
				$password    = $res[0]['password'];
				$title    = $res[0]['title'];
				$first_name    = $res[0]['first_name'];
				$last_name    = $res[0]['last_name'];
				$phone    = $res[0]['phone'];
				$company    = $res[0]['company'];
				$address    = $res[0]['address'];
				$city    = $res[0]['city'];
				$state    = $res[0]['state'];
				$zip    = $res[0]['zip'];
				$country_id    = $res[0]['country_id'];
				$created_at    = $res[0]['created_at'];
				$updated_at    = $res[0]['updated_at'];
				$type    = $res[0]['type'];
				$status    = $res[0]['status'];
			}
				
			include("register_editor.php");
			break;
		case "list" :
			if(empty($_SESSION['users_id']))
			{
				Header("Location: ../login/index.php");
			}
			if(!empty($_REQUEST['page'])&&$_SESSION["search"]=="yes")
			{
				$_SESSION["search"]="yes";
			}
			else
			{
				$_SESSION["search"]="no";
				unset($_SESSION["search"]);
				unset($_SESSION['field_name']);
				unset($_SESSION["field_value"]);
			}
			include("register_list.php");
			break;
		default:
				include("register_editor.php");
			 
	}
	
	//Protect same image name
	function getMaxId($db)
	{
		$info['table']    = "registration";
		$info['fields']   = array("max(id) as maxid");
		$info['where']    =  "1=1";
		 
		$resmax  =  $db->select($info);
		if(count($resmax)>0)
		{
			$max = $resmax[0]['maxid']+1;
		}
		else
		{
			$max=0;
		}
		return $max;
	}
	//check email
	function account_exits($db,$username)
	{
		 unset($info);
		$info["table"] = "users";
		$info["fields"] = array("users.*");
		$info["where"]   = "1 AND username='".$username."'";
		$arr =  $db->select($info);	
		if(count($arr)>0)
		{
		 return true;
		}
		return false;
	}
	/*
	  Login
	*/
	/*function login($db,$id)
	{
		  unset($info);
		$info["table"]     = "users";
		$info["fields"]   = array("*");
		$info["where"]    = " 1=1 AND id='".$id."'";
		$res  = $db->select($info);
		if(count($res)>0)
		{
			$_SESSION["users_id"]   = $res[0]["id"];
			$_SESSION["email"]      = $res[0]["email"];
			$_SESSION["first_name"] = $res[0]["first_name"];
			$_SESSION["last_name"]  = $res[0]["last_name"];
			$_SESSION["type"]       = $res[0]["type"];
		}
	}*/
?>
