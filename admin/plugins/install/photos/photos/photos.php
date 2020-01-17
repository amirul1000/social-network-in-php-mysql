<?php
       /*
		  Name: Photos
		  Author: Amirul Momenin
		  Version: 1.0 
		*/
       session_start();
       include("../common/lib.php");
	   include("../lib/class.db.php");
	   include("../common/config.php");
	   
	    if(empty($_SESSION['users_id'])) 
	   {
	     Header("Location: ../login/login.php");
	   }
	  
	   $cmd = $_REQUEST['cmd'];
	   switch($cmd)
	   {
	     
		  case 'add': 
				$info['table']    = "photos";
				$data['users_id']   = $_SESSION['users_id'];
                $data['photo_name']   = $_REQUEST['photo_name'];
                     
				if(strlen($_FILES['file_photo']['name'])>0 && $_FILES['file_photo']['size']>0)
				{
					
					if(!file_exists("../photos_images"))
					{ 
					   mkdir("../photos_images",0755);	
					}
					if(empty($_REQUEST['id']))
					{
					  $file=getMaxId($db)."_".str_replace(" ","_",strtolower(trim($_FILES['file_photo']['name'])));
					}
					else
					{
					  $file=trim($_REQUEST['id'])."_".str_replace(" ","_",strtolower(trim($_FILES['file_photo']['name'])));
					}
					$filePath="../photos_images/".$file;
					move_uploaded_file($_FILES['file_photo']['tmp_name'],$filePath);
					$data['file_photo']="photos_images/".trim($file);
				}
                $data['date_created']   = $_REQUEST['date_created'];
                
				
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
				
				include("../photos/photos_list.php");						   
				break;    
		case "edit":      
				$Id               = $_REQUEST['id'];
				if( !empty($Id ))
				{
					$info['table']    = "photos";
					$info['fields']   = array("*");   	   
					$info['where']    =  "id=".$Id;
				   
					$res  =  $db->select($info);
				   
					$Id        = $res[0]['id'];  
					$users_id    = $res[0]['users_id'];
					$photo_name    = $res[0]['photo_name'];
					$file_photo    = $res[0]['file_photo'];
					$date_created    = $res[0]['date_created'];
					
				 }
						   
				include("../photos/photos_editor.php");						  
				break;
						   
         case 'delete': 
				$Id               = $_REQUEST['id'];
				
				$info['table']    = "photos";
				$info['where']    = "id='$Id' AND users_id='".$_SESSION['users_id']."'";
				
				if($Id)
				{
					$db->delete($info);
				}
				include("../photos/photos_list.php");						   
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
				include("../photos/photos_list.php");
				break; 
        case "search_photos":
				$_REQUEST['page'] = 1;  
				$_SESSION["search"]="yes";
				$_SESSION['field_name'] = $_REQUEST['field_name'];
				$_SESSION["field_value"] = $_REQUEST['field_value'];
				include("../photos/photos_list.php");
				break;  								   
						
	     default :    
		       include("../photos/photos_editor.php");		         
	   }

//Protect same image name
 function getMaxId($db)
 {
	   $info['table']    = "photos";
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
