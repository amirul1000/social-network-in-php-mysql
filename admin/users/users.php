<?php
       session_start();
       include("../../common/lib.php");
	   include("../../lib/class.db.php");
	   include("../../common/config.php");
	   
	    if(empty($_SESSION['adminusers_id'])) 
	   {
	     Header("Location: ../login/login.php");
	   }
	  
	   $cmd = $_REQUEST['cmd'];
	   switch($cmd)
	   {
	     
		  case 'add': 
				$info['table']    = "users";
				$data['password']   = $_REQUEST['password'];
                $data['username']   = $_REQUEST['username'];
                $data['title']   = $_REQUEST['title'];
                $data['first_name']   = $_REQUEST['first_name'];
                $data['last_name']   = $_REQUEST['last_name'];
                $data['email']   = $_REQUEST['email'];
                $data['phone']   = $_REQUEST['phone'];
                $data['company']   = $_REQUEST['company'];
                $data['address']   = $_REQUEST['address'];
                $data['city']   = $_REQUEST['city'];
                $data['state']   = $_REQUEST['state'];
                $data['zip']   = $_REQUEST['zip'];
                $data['date_of_birth']   = $_REQUEST['date_of_birth'];
                $data['gender']   = $_REQUEST['gender'];
                $data['lives_in']   = $_REQUEST['lives_in'];
                $data['hobby']   = $_REQUEST['hobby'];
                $data['occupation']   = $_REQUEST['occupation'];
                $data['country_id']   = $_REQUEST['country_id'];
                $data['created_at']   = $_REQUEST['created_at'];
                $data['updated_at']   = $_REQUEST['updated_at'];
                $data['verification_code']   = $_REQUEST['verification_code'];
                $data['verified']   = $_REQUEST['verified'];
                     
				if(strlen($_FILES['file_picture']['name'])>0 && $_FILES['file_picture']['size']>0)
				{
					
					if(!file_exists("../../users_images"))
					{ 
					   mkdir("../../users_images",0755);	
					}
					if(empty($_REQUEST['id']))
					{
					  $file=getMaxId($db)."_".str_replace(" ","_",strtolower(trim($_FILES['file_picture']['name'])));
					}
					else
					{
					  $file=trim($_REQUEST['id'])."_".str_replace(" ","_",strtolower(trim($_FILES['file_picture']['name'])));
					}
					$filePath="../../users_images/".$file;
					move_uploaded_file($_FILES['file_picture']['tmp_name'],$filePath);
					$data['file_picture']="users_images/".trim($file);
				}
                     
				if(strlen($_FILES['file_cover']['name'])>0 && $_FILES['file_cover']['size']>0)
				{
					
					if(!file_exists("../../users_images"))
					{ 
					   mkdir("../../users_images",0755);	
					}
					if(empty($_REQUEST['id']))
					{
					  $file=getMaxId($db)."_".str_replace(" ","_",strtolower(trim($_FILES['file_cover']['name'])));
					}
					else
					{
					  $file=trim($_REQUEST['id'])."_".str_replace(" ","_",strtolower(trim($_FILES['file_cover']['name'])));
					}
					$filePath="../../users_images/".$file;
					move_uploaded_file($_FILES['file_cover']['tmp_name'],$filePath);
					$data['file_cover']="users_images/".trim($file);
				}
                $data['type']   = $_REQUEST['type'];
                $data['status']   = $_REQUEST['status'];
                
				
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
				
				include("../users/users_list.php");						   
				break;    
		case "edit":      
				$Id               = $_REQUEST['id'];
				if( !empty($Id ))
				{
					$info['table']    = "users";
					$info['fields']   = array("*");   	   
					$info['where']    =  "id=".$Id;
				   
					$res  =  $db->select($info);
				   
					$Id        = $res[0]['id'];  
					$password    = $res[0]['password'];
					$username    = $res[0]['username'];
					$title    = $res[0]['title'];
					$first_name    = $res[0]['first_name'];
					$last_name    = $res[0]['last_name'];
					$email    = $res[0]['email'];
					$phone    = $res[0]['phone'];
					$company    = $res[0]['company'];
					$address    = $res[0]['address'];
					$city    = $res[0]['city'];
					$state    = $res[0]['state'];
					$zip    = $res[0]['zip'];
					$date_of_birth    = $res[0]['date_of_birth'];
					$gender    = $res[0]['gender'];
					$lives_in    = $res[0]['lives_in'];
					$hobby    = $res[0]['hobby'];
					$occupation    = $res[0]['occupation'];
					$country_id    = $res[0]['country_id'];
					$created_at    = $res[0]['created_at'];
					$updated_at    = $res[0]['updated_at'];
					$verification_code    = $res[0]['verification_code'];
					$verified    = $res[0]['verified'];
					$file_picture    = $res[0]['file_picture'];
					$file_cover    = $res[0]['file_cover'];
					$type    = $res[0]['type'];
					$status    = $res[0]['status'];
					
				 }
						   
				include("../users/users_editor.php");						  
				break;
						   
         case 'delete': 
				$Id               = $_REQUEST['id'];
				
				$info['table']    = "users";
				$info['where']    = "id='$Id'";
				
				if($Id)
				{
					$db->delete($info);
				}
				include("../users/users_list.php");						   
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
				include("../users/users_list.php");
				break; 
        case "search_users":
				$_REQUEST['page'] = 1;  
				$_SESSION["search"]="yes";
				$_SESSION['field_name'] = $_REQUEST['field_name'];
				$_SESSION["field_value"] = $_REQUEST['field_value'];
				include("../users/users_list.php");
				break;  								   
						
	     default :    
		       include("../users/users_editor.php");		         
	   }

//Protect same image name
 function getMaxId($db)
 {
	   $info['table']    = "users";
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
