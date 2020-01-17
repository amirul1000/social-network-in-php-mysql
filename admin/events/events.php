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
				$info['table']    = "events";
				$data['users_id']   = $_REQUEST['users_id'];
                $data['category_id']   = $_REQUEST['category_id'];
                $data['age_id']   = $_REQUEST['age_id'];
                //$data['events_id']   = $_REQUEST['events_id'];
                $data['ticket_name']   = $_REQUEST['ticket_name'];
                $data['venue_name']   = $_REQUEST['venue_name'];
                $data['venue_post_code']   = $_REQUEST['venue_post_code'];
                $data['start_date']   = $_REQUEST['start_date'];
                $data['start_time_hr']   = $_REQUEST['start_time_hr'];
                $data['start_time_min']   = $_REQUEST['start_time_min'];
                $data['start_am_pm']   = $_REQUEST['start_am_pm'];
                $data['end_date']   = $_REQUEST['end_date'];
                $data['end_time_hr']   = $_REQUEST['end_time_hr'];
                $data['end_time_min']   = $_REQUEST['end_time_min'];
                $data['end_am_pm']   = $_REQUEST['end_am_pm'];
                $data['price']   = $_REQUEST['price'];
                $data['starting_ticket_no']   = $_REQUEST['starting_ticket_no'];
                $data['in_stock']   = $_REQUEST['in_stock'];
                $data['is_security_code']   = $_REQUEST['is_security_code'];
                $data['security_code']   = $_REQUEST['security_code'];
                     
				if(strlen($_FILES['file_ticket']['name'])>0 && $_FILES['file_ticket']['size']>0)
				{
					
					if(!file_exists("../../events_images"))
					{ 
					   mkdir("../../events_images",0755);	
					}
					if(empty($_REQUEST['id']))
					{
					  $file=getMaxId($db)."_".str_replace(" ","_",strtolower(trim($_FILES['file_ticket']['name'])));
					}
					else
					{
					  $file=trim($_REQUEST['id'])."_".str_replace(" ","_",strtolower(trim($_FILES['file_ticket']['name'])));
					}
					$filePath="../../events_images/".$file;
					move_uploaded_file($_FILES['file_ticket']['tmp_name'],$filePath);
					$data['file_ticket']="events_images/".trim($file);
				}
                $data['description']   = $_REQUEST['description'];
                     
				if(strlen($_FILES['file_thumb1']['name'])>0 && $_FILES['file_thumb1']['size']>0)
				{
					
					if(!file_exists("../../events_images"))
					{ 
					   mkdir("../../events_images",0755);	
					}
					if(empty($_REQUEST['id']))
					{
					  $file=getMaxId($db)."_".str_replace(" ","_",strtolower(trim($_FILES['file_thumb1']['name'])));
					}
					else
					{
					  $file=trim($_REQUEST['id'])."_".str_replace(" ","_",strtolower(trim($_FILES['file_thumb1']['name'])));
					}
					$filePath="../../events_images/".$file;
					move_uploaded_file($_FILES['file_thumb1']['tmp_name'],$filePath);
					$data['file_thumb1']="events_images/".trim($file);
				}
                     
				if(strlen($_FILES['file_thumb2']['name'])>0 && $_FILES['file_thumb2']['size']>0)
				{
					
					if(!file_exists("../../events_images"))
					{ 
					   mkdir("../../events_images",0755);	
					}
					if(empty($_REQUEST['id']))
					{
					  $file=getMaxId($db)."_".str_replace(" ","_",strtolower(trim($_FILES['file_thumb2']['name'])));
					}
					else
					{
					  $file=trim($_REQUEST['id'])."_".str_replace(" ","_",strtolower(trim($_FILES['file_thumb2']['name'])));
					}
					$filePath="../../events_images/".$file;
					move_uploaded_file($_FILES['file_thumb2']['tmp_name'],$filePath);
					$data['file_thumb2']="events_images/".trim($file);
				}
                     
				if(strlen($_FILES['file_thumb3']['name'])>0 && $_FILES['file_thumb3']['size']>0)
				{
					
					if(!file_exists("../../events_images"))
					{ 
					   mkdir("../../events_images",0755);	
					}
					if(empty($_REQUEST['id']))
					{
					  $file=getMaxId($db)."_".str_replace(" ","_",strtolower(trim($_FILES['file_thumb3']['name'])));
					}
					else
					{
					  $file=trim($_REQUEST['id'])."_".str_replace(" ","_",strtolower(trim($_FILES['file_thumb3']['name'])));
					}
					$filePath="../../events_images/".$file;
					move_uploaded_file($_FILES['file_thumb3']['tmp_name'],$filePath);
					$data['file_thumb3']="events_images/".trim($file);
				}
				$data['background_color']   = $_REQUEST['background_color'];
				if(strlen($_FILES['file_backgroundimage']['name'])>0 && $_FILES['file_backgroundimage']['size']>0)
				{
					
					if(!file_exists("../../events_images"))
					{ 
					   mkdir("../../events_images",0755);	
					}
					if(empty($_REQUEST['id']))
					{
					  $file=getMaxId($db)."_".str_replace(" ","_",strtolower(trim($_FILES['file_backgroundimage']['name'])));
					}
					else
					{
					  $file=trim($_REQUEST['id'])."_".str_replace(" ","_",strtolower(trim($_FILES['file_backgroundimage']['name'])));
					}
					$filePath="../../events_images/".$file;
					move_uploaded_file($_FILES['file_backgroundimage']['tmp_name'],$filePath);
					$data['file_backgroundimage']="events_images/".trim($file);
				}
                $data['is_approved']   = $_REQUEST['is_approved'];
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
				
				include("../events/events_list.php");						   
				break;    
		case "edit":      
				$Id               = $_REQUEST['id'];
				if( !empty($Id ))
				{
					$info['table']    = "events";
					$info['fields']   = array("*");   	   
					$info['where']    =  "id=".$Id;
				   
					$res  =  $db->select($info);
				   
					$Id        = $res[0]['id'];  
					$users_id    = $res[0]['users_id'];
					$category_id    = $res[0]['category_id'];
					$age_id    = $res[0]['age_id'];
					$events_id    = $res[0]['events_id'];
					$ticket_name    = $res[0]['ticket_name'];
					$venue_name    = $res[0]['venue_name'];
					$venue_post_code    = $res[0]['venue_post_code'];
					$start_date    = $res[0]['start_date'];
					$start_time_hr    = $res[0]['start_time_hr'];
					$start_time_min    = $res[0]['start_time_min'];
					$start_am_pm    = $res[0]['start_am_pm'];
					$end_date    = $res[0]['end_date'];
					$end_time_hr    = $res[0]['end_time_hr'];
					$end_time_min    = $res[0]['end_time_min'];
					$end_am_pm    = $res[0]['end_am_pm'];
					$price    = $res[0]['price'];
					$starting_ticket_no    = $res[0]['starting_ticket_no'];
					$in_stock    = $res[0]['in_stock'];
					$is_security_code    = $res[0]['is_security_code'];
					$security_code    = $res[0]['security_code'];
					$file_ticket    = $res[0]['file_ticket'];
					$description    = $res[0]['description'];
					$file_thumb1    = $res[0]['file_thumb1'];
					$file_thumb2    = $res[0]['file_thumb2'];
					$file_thumb3    = $res[0]['file_thumb3'];
					$background_color   = $res[0]['background_color'];
					$file_backgroundimage    = $res[0]['file_backgroundimage'];
					$is_approved    = $res[0]['is_approved'];
					$status         = $res[0]['status'];
				 }
						   
				include("../events/events_editor.php");						  
				break;
						   
         case 'delete': 
				$Id               = $_REQUEST['id'];
				
				$info['table']    = "events";
				$info['where']    = "id='$Id'";
				
				if($Id)
				{
					$db->delete($info);
				}
				include("../events/events_list.php");						   
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
				include("../events/events_list.php");
				break; 
        case "search_events":
				$_REQUEST['page'] = 1;  
				$_SESSION["search"]="yes";
				$_SESSION['field_name'] = $_REQUEST['field_name'];
				$_SESSION["field_value"] = $_REQUEST['field_value'];
				include("../events/events_list.php");
				break;  								   
						
	     default :    
		       include("../events/events_editor.php");		         
	   }

//Protect same image name
 function getMaxId($db)
 {
	   $info['table']    = "events";
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
