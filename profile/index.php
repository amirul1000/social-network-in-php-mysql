<?php
       /*
		  Name: Profile
		  Author: Amirul Momenin
		  Version: 1.0 
		*/
       session_start();
	   error_reporting(0);
       include("../common/lib.php");
	   include("../common_lib/common_lib.php");
	   include("../lib/class.db.php");
	   include("../common/config.php");
	   
	   /* if(empty($_SESSION['users_id'])) 
	   {
	     Header("Location: ../login");
	   }*/
	  
	   $cmd = $_REQUEST['cmd'];
	   switch($cmd)
	   {
	      case "like":
		            $info['table']    = "likes";
					$data['owner_users_id']   = get_likes_owner_users_id($db,$_REQUEST['contents_id']);
					$data['likes_users_id']   = $_SESSION['users_id'];
					$data['contents_id']      = $_REQUEST['contents_id'];
					$data['like_count']       = 1;
					$data['date_created']     = $_REQUEST['date_created'];
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
					
				 //Notifications
				     unset($info);
					 unset($data);
					$info['table']    = "notifications";
					$data['from_users_id']   = $_SESSION['users_id'];
					$data['to_users_id']   = get_likes_owner_users_id($db,$_REQUEST['contents_id']);
					$data['message']   = get_users_name($db,$_SESSION['users_id'])." has liked your content"; 
					$data['read_status']   = 'unread';
					$data['date_created']  = date("Y-m-d");
					$info['data']     =  $data;
						 $db->insert($info);	
					
		         Header("Location:index.php?username=".$_REQUEST['username']);
				break;
		   case "unlike":
		            $info['table']    = "likes";
					$info['where'] = "contents_id='".$_REQUEST['contents_id']."' AND likes_users_id='".$_SESSION['users_id']."'";
					$db->delete($info);
		          Header("Location:index.php?username=".$_REQUEST['username']);
				break;
		   case "video_add":	
				  if(strlen(trim($_REQUEST['content']))>0)
				  { 
					   unset($info);
					   unset($data);			
					$info['table']    = "contents";
					$data['users_id']   = $_SESSION['users_id'];
					$data['content_type']   = get_content_type($_REQUEST['content']);
					$data['content']   = $_REQUEST['content'];
					$data['date_created']   = date("Y-m-d");
					$data['date_updated']   = "";
					$data['status']   = 'active';							
					$info['data']     =  $data;
					$db->insert($info);
				  }
			     Header("Location:index.php?username=".$_REQUEST['username']);
				break;
			case "share":	
			      unset($info);
				  unset($data);
				$info["table"] = "shared";
				$info["fields"] = array("shared.*"); 
				$info["where"]   = "1 AND contents_id='".$_REQUEST['contents_id']."' AND shared_users_id='".$_SESSION['users_id']."'";
				$arr =  $db->select($info);
				if(count($arr)==0)
				{
				    //save share
				     unset($info);
					 unset($data);
				    $info['table']    = "shared";
					$data['owner_users_id']   = get_content_owner_id($db,$_REQUEST['contents_id']);
					$data['shared_users_id']   = $_SESSION['users_id'];
					$data['contents_id']   = $_REQUEST['contents_id'];
					$data['date_created']   = date("Y-m-d H:i:s");
					$info['data']     =  $data;
						 $db->insert($info);
						 
					//Notifications
				     unset($info);
					 unset($data);
					$info['table']    = "notifications";
					$data['from_users_id']   = $_SESSION['users_id'];
					$data['to_users_id']   = get_content_owner_id($db,$_REQUEST['contents_id']);
					$data['message']   = get_users_name($db,$_SESSION['users_id'])." has shared your content"; 
					$data['read_status']   = 'unread';
					$data['date_created']  = date("Y-m-d");
					$info['data']     =  $data;
						 $db->insert($info);
					
					//get content & save this to new user
					  unset($info);
					  unset($data);
					$info["table"] = "contents";
					$info["fields"] = array("contents.*"); 
					$info["where"]   = "1 AND id='".$_REQUEST['contents_id']."'";
					$arr =  $db->select($info);
					
					  unset($info);
					  unset($data);
					$info['table']    = "contents";
					$data['users_id']   = $_SESSION['users_id'];
					$data['content_type']   = $arr[0]['content_type'];
					$data['content']   = $arr[0]['content'];
					$data['shared_contents_id']  = $arr[0]['shared_contents_id']==0? $_REQUEST['contents_id']:$arr[0]['shared_contents_id'];
					$data['date_created']   = $arr[0]['date_created'];
					$data['status']   = $arr[0]['status'];
					$info['data']     =  $data;
						 $db->insert($info);
				}
				 Header("Location:index.php?username=".$_REQUEST['username']);
				break;
			case "add_comment":
			        $info['table']    = "comments";
					$data['users_id']   = $_SESSION['users_id'];
					$data['contents_id']   = $_REQUEST['contents_id'];
					$data['comment']   = $_REQUEST['comment'];
					$data['date_time_created']   = date("Y-m-d H:i:s");
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
			    	Header("Location:index.php?username=".$_REQUEST['username']);
				break;
	      case 'delete': 
				$Id               = $_REQUEST['id'];
				
				$info['table']    = "contents";
				$info['where']    = "id='$Id' AND users_id='".$_SESSION['users_id']."'";
				if($Id)
				{
					$result = $db->delete($info);
					if($result==true)
					{
						 //delete all likes
						$info['table']    = "likes";
						$info['where']    = "contents_id='$Id'";
						$db->delete($info);
						
						//delete all comments
						$info['table']    = "comments";
						$info['where']    = "contents_id='$Id'";
							$db->delete($info);
					}
				}	
	          	Header("Location:index.php?username=".$_REQUEST['username']);
				break;
		 case "delete_comments":
				$Id               = $_REQUEST['id'];				    
				$info['table']    = "comments";
				$info['where']    = "id='$Id'";
				$db->delete($info);
				Header("Location:index.php?username=".$_REQUEST['username']);
				break;		
	     default:    
		       include("profile_view.php");		         
	   }

function get_content_type($content)
{	
    $regex = "((https?|ftp)\:\/\/)?"; // SCHEME 
    $regex .= "([a-z0-9+!*(),;?&=\$_.-]+(\:[a-z0-9+!*(),;?&=\$_.-]+)?@)?"; // User and Pass 
    $regex .= "([a-z0-9-.]*)\.([a-z]{2,3})"; // Host or IP 
    $regex .= "(\:[0-9]{2,5})?"; // Port 
    $regex .= "(\/([a-z0-9+\$_-]\.?)+)*\/?"; // Path 
    $regex .= "(\?[a-z+&\$_.-][a-z0-9;:@&%=+\/\$_.-]*)?"; // GET Query 
    $regex .= "(#[a-z_.-][a-z0-9+\$_.-]*)?"; // Anchor 
	
  if(preg_match("/^$regex$/", trim($content))) 
    { 
     return "link";
	}
	else
	{
	  return "text/html";
	}
}

?>
