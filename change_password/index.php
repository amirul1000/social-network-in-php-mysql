<?php
		/*
		  Name: Change Password 
		  Author: Amirul Momenin
		  Version: 1.0 
		*/
		session_start();
		include("../common/lib.php");
		include("../lib/class.db.php");
		include("../common/config.php");
		if(empty($_SESSION['users_id']))
			{
				Header("Location: ../login/");
			}
				 
		$cmd = $_REQUEST['cmd'];
		switch($cmd)
		{
		
			case 'add':
				$info['table']    = "users";				
				$data['username']   = $_REQUEST['username'];
				$data['password']   = $_REQUEST['password'];
				$info['data']     =  $data;
		
				if(!empty($_SESSION['users_id']))
				{
				   if(get_password($db,$_REQUEST['old_password'])==true)
				   {
						$Id            = $_SESSION['users_id'];
						$info['where'] =  "id='".$_SESSION['users_id']."'";				
						$db->update($info);
						$message = "password has been changed successfully";
				   }	
				   else
				   {
					  $message = "Old  password is not correct";
				   }
				}
				
				$Id               = $_SESSION['users_id'];
				if( !empty($Id ))
				{
					$info['table']    = "users";
					$info['fields']   = array("*");
					$info['where']    =  "id='".$_SESSION['users_id']."'";
						
					$res  =  $db->select($info);
						
					$Id        = $res[0]['id'];
					$username    = $res[0]['username'];
					$password    = $res[0]['password'];
					
				}
				
				include("change_password_editor.php");
				break;
			case "edit":
				$Id               = $_SESSION['users_id'];
				if( !empty($Id ))
				{
					$info['table']    = "users";
					$info['fields']   = array("*");
					$info['where']    =  "id='".$_SESSION['users_id']."'";
						
					$res  =  $db->select($info);
						
					$Id        = $res[0]['id'];
					$username    = $res[0]['username'];
					$password    = $res[0]['password'];			
				}
					
				include("change_password_editor.php");
				break;
			default:
				   $Id               = $_SESSION['users_id'];
					if( !empty($Id ))
					{
						$info['table']    = "users";
						$info['fields']   = array("*");
						$info['where']    =  "id='".$_SESSION['users_id']."'";
							
						$res  =  $db->select($info);
							
						$Id        = $res[0]['id'];
						$username    = $res[0]['username'];
						$password    = $res[0]['password'];
						
					}
				  include("change_password_editor.php");
				
		}		
		/*
		*
		*/
		function get_password($db,$password)
		{
			  unset($info);
			$info['table']    = "users";
			$info['fields']   = array("*");
			$info['where']    =  " 1 AND id='".$_SESSION['users_id']."' AND password='".$password."'";
			$info['debug']    = true;
			$res  =  $db->select($info);			
			if(count($res))
			{
			  return true;
			}
			return false;
		}
?>
