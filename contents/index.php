<?php
       /*
		  Name: Contents
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
				$info['table']    = "contents";
				$data['users_id']   = $_SESSION['users_id'];
                $data['content_type']   = $_REQUEST['content_type'];
                $data['content']   = $_REQUEST['content'];
				
				if(empty($_REQUEST['id']))
				{
                	$data['date_created']   = date("Y-m-d");
				}
				else
				{
                	$data['date_updated']   = date("Y-m-d");
				}
				
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
				
				include("../contents/contents_list.php");						   
				break;    
		case "edit":      
				$Id               = $_REQUEST['id'];
				if( !empty($Id ))
				{
					$info['table']    = "contents";
					$info['fields']   = array("*");   	   
					$info['where']    =  "id=".$Id;
				   
					$res  =  $db->select($info);
				   
					$Id        = $res[0]['id'];  
					$users_id    = $res[0]['users_id'];
					$content_type    = $res[0]['content_type'];
					$content    = $res[0]['content'];
					$date_created    = $res[0]['date_created'];
					$date_updated    = $res[0]['date_updated'];
					$status    = $res[0]['status'];
					
				 }
						   
				include("../contents/contents_editor.php");						  
				break;
						   
         case 'delete': 
				$Id               = $_REQUEST['id'];
				
				$info['table']    = "contents";
				$info['where']    = "id='$Id'";
				
				if($Id)
				{
					$db->delete($info);
				
				    //delete all likes
					$info['table']    = "likes";
					$info['where']    = "contents_id='$Id' AND users_id='".$_SESSION['users_id']."'";
					$db->delete($info);
				}
				include("../contents/contents_list.php");						   
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
				include("../contents/contents_list.php");
				break; 
        case "search_contents":
				$_REQUEST['page'] = 1;  
				$_SESSION["search"]="yes";
				$_SESSION['field_name'] = $_REQUEST['field_name'];
				$_SESSION["field_value"] = $_REQUEST['field_value'];
				include("../contents/contents_list.php");
				break;  								   
						
	     default :    
		       include("../contents/contents_editor.php");		         
	   }

//Protect same image name
 function getMaxId($db)
 {
	   $info['table']    = "contents";
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
