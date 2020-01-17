<?php
        /*
		  Name: Messages
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
				$info['table']    = "messages";
				$data['from_users_id']   = $_SESSION['users_id'];
                $data['to_users_id']   = $_REQUEST['to_users_id'];
                $data['subject']   = $_REQUEST['subject'];
                $data['message']   = $_REQUEST['message'];
				$data['read_status']   = 'unread';
                $data['date_created']   = date("Y-m-d");
                
				
				$info['data']     =  $data;
				
				if(empty($_REQUEST['id']))
				{
					 $db->insert($info);
				}
				else
				{
					$Id            = $_REQUEST['id'];
					$info['where'] = "id=".$Id;
					
					$db->update($info);
				}
				
				include("../messages/messages_list.php");						   
				break;    
		case "edit":      
				$Id               = $_REQUEST['id'];
				if( !empty($Id ))
				{
					$info['table']    = "messages";
					$info['fields']   = array("*");   	   
					$info['where']    =  "id=".$Id;
				   
					$res  =  $db->select($info);
				   
					$Id        = $res[0]['id'];  
					$from_users_id    = $res[0]['from_users_id'];
					$to_users_id    = $res[0]['to_users_id'];
					$subject    = $res[0]['subject'];
					$message    = $res[0]['message'];
					$read_status    = 'unread';
					$date_created    = $res[0]['date_created'];
					
				 }
						   
				include("../messages/messages_editor.php");						  
				break;
		 case "details":      
				$Id               = $_REQUEST['id'];
				if( !empty($Id ))
				{
					$info['table']    = "messages";
					$info['fields']   = array("*");   	   
					$info['where']    =  "id='$Id' AND to_users_id='".$_SESSION['users_id']."'";
				   
					$res  =  $db->select($info);
				   
					$Id        = $res[0]['id'];  
					$from_users_id    = $res[0]['from_users_id'];
					$to_users_id    = $res[0]['to_users_id'];
					$subject    = $res[0]['subject'];
					$message    = $res[0]['message'];
					$read_status    = 'unread';
					$date_created    = $res[0]['date_created'];
					
				 }
				
				  unset($info);
				  unset($data);
				$info['table']    = "messages";
				$data['read_status']   = 'read';
				$info['data']     =  $data;
				$info['where'] = "id=".$Id;
					$db->update($info);
					   
				include("../messages/messages_details.php");						  
				break;				   
         case 'delete': 
				$Id               = $_REQUEST['id'];
				
				$info['table']    = "messages";
				$info['where']    = "id='$Id' AND to_users_id='".$_SESSION['users_id']."'";
				
				if($Id)
				{
					$db->delete($info);
				}
				include("../messages/messages_list.php");						   
				break; 
		case "delete_all":
		        foreach($_REQUEST['check'] as $key=>$value)
				{  
					$Id               = $value; 
					
					$info['table']    = "messages";
					$info['where']    = "id='$Id' AND to_users_id='".$_SESSION['users_id']."'";
					
					if($Id)
					{
						$db->delete($info);
					}
				}
				include("../messages/messages_list.php");						   
				break; 
         case "list" :    	 
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
				include("../messages/messages_list.php");
				break; 
        case "search_messages":
				$_REQUEST['page'] = 1;  
				$_SESSION["search"]="yes";
				$_SESSION['field_name'] = $_REQUEST['field_name'];
				$_SESSION["field_value"] = $_REQUEST['field_value'];
				include("../messages/messages_list.php");
				break;  								   
						
	     default :  
		         $to_users_id = $_REQUEST['to_users_id'];  
		       include("../messages/messages_editor.php");		         
	   }

//Protect same image name
 function getMaxId($db)
 {
	   $info['table']    = "messages";
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
?>
