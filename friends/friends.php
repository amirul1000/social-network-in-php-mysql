<?php
       /*
		  Name: Friends
		  Author: Amirul Momenin
		  Version: 1.0 
		*/
       session_start();
       include("../common/lib.php");
	   include("../common_lib/common_lib.php");
	   include("../lib/class.db.php");
	   include("../common/config.php");
	   
	    if(empty($_SESSION['users_id'])) 
	   {
	     Header("Location: ../login/login.php");
	   }
	  
	   $cmd = $_REQUEST['cmd'];
	   switch($cmd)
	   {
	     
		  /*case 'add': 
				$info['table']    = "friends";
				$data['users_id']   = $_REQUEST['users_id'];
                $data['friend_users_id']   = $_REQUEST['friend_users_id'];
                $data['friend_status']   = $_REQUEST['friend_status'];
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
				include("../friends/friends_list.php");						   
				break;    
		case "edit":      
				$Id               = $_REQUEST['id'];
				if( !empty($Id ))
				{
					$info['table']    = "friends";
					$info['fields']   = array("*");   	   
					$info['where']    =  "id=".$Id;
				   
					$res  =  $db->select($info);
				   
					$Id        = $res[0]['id'];  
					$users_id    = $res[0]['users_id'];
					$friend_users_id    = $res[0]['friend_users_id'];
					$friend_status    = $res[0]['friend_status'];
					$date_created    = $res[0]['date_created'];
					
				 }
						   
				include("../friends/friends_editor.php");						  
				break;
						   
         case 'delete': 
				$Id               = $_REQUEST['id'];
				
				$info['table']    = "friends";
				$info['where']    = "id='$Id'";
				
				if($Id)
				{
					$db->delete($info);
				}
				include("../friends/friends_list.php");						   
				break; */
						   
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
				
				
	             if($_REQUEST['come']=="nav")
				 {
	               include("../friends/home_saerch_friends_view.php");
				 }
				 else
				 {
				    include("../friends/friends_list.php");
				 }	 
				
				break; 
		case "search_view":
		      if($_REQUEST['come']=="nav")
				 {
	               include("../friends/home_saerch_friends_view.php");
				 }
				 else
				 {
				    include("../friends/saerch_friends_view.php");
				 }	
			break; 
			
		 case "friends_autocomplete":
			        $q = '';
				if (isset($_REQUEST['q'])) {
					$q = strtolower($_REQUEST['q']);
				}
				if (!$q) {
					return;
				}

                 unset($info);	
				$info["table"] = "users";
				$info["fields"] = array("users.*"); 
				$info["where"]   = "1   OR users.username LIKE '%".$q."%' 
										OR users.first_name LIKE '%".$q."%' 
										OR users.last_name LIKE '%".$q."%' 
										OR users.lives_in LIKE '%".$q."%' 
										OR users.hobby LIKE '%".$q."%' 
										OR users.occupation LIKE '%".$q."%' 
										OR users.address LIKE '%".$q."%' 
										OR users.city LIKE '%".$q."%' 
										OR users.state LIKE '%".$q."%' 
										OR users.gender LIKE '%".$q."%' ";
										
				$arr =  $db->select($info);
				
				
				for($i=0;$i<count($arr);$i++)
				 {
				    $com = "/$q/i";
				    $key   = $arr[$i]['username'];
					$value = $arr[$i]['username'];	
					
					if (preg_match($com,$key))
					{					
						echo "$value|$key\n";
					}
					
					$key   = $arr[$i]['first_name'];
					$value = $arr[$i]['first_name'];	
					if (preg_match($com,$key))
					{										
						echo "$value|$key\n";
					}
					
					$key = $arr[$i]['last_name'];
					$value = $arr[$i]['last_name'];	
					if (preg_match($com,$key))
					{									
						echo "$value|$key\n";
					}
					
					$key = $arr[$i]['lives_in'];
					$value = $arr[$i]['lives_in'];	
					if (preg_match($com,$key))
					{								
						echo "$value|$key\n";
					}
					
					$key = $arr[$i]['hobby'];
					$value = $arr[$i]['hobby'];	
					if (preg_match($com,$key))
					{								
						echo "$value|$key\n";
					}
					
					$key = $arr[$i]['occupation'];
					$value = $arr[$i]['occupation'];	
					if (preg_match($com,$key))
					{									
						echo "$value|$key\n";
					}
					
					$key = $arr[$i]['company'];
					$value = $arr[$i]['company'];	
					if (preg_match($com,$key))
					{									
						echo "$value|$key\n";
					}
					
					$key = $arr[$i]['address'];
					$value = $arr[$i]['address'];	
					if (preg_match($com,$key))
					{									
						echo "$value|$key\n";
					}
					
					$key = $arr[$i]['city'];
					$value = $arr[$i]['city'];	
					if (preg_match($com,$key))
					{									
						echo "$value|$key\n";
					}
					
					$key = $arr[$i]['state'];
					$value = $arr[$i]['state'];	
					if (preg_match($com,$key))
					{									
						echo "$value|$key\n";
					}
					
					$key = $arr[$i]['gender'];
					$value = $arr[$i]['gender'];	
					if (preg_match($com,$key))
					{									
						echo "$value|$key\n";
					}
				}	
			      break;		
			
		case "search_by_keyword":		
		        $_SESSION["search"]     = "yes";
				$_SESSION['SearchText'] = $_REQUEST['SearchText'];   
		        if($_REQUEST['come']=="nav")
				 {
	               include("../friends/home_saerch_friends_view.php");
				 }
				 else
				 {
				    include("../friends/saerch_friends_view.php");
				 }	
			   break; 	  
	   case "friend":
	              $info['table']    = "friends";
				$data['users_id']   = $_SESSION['users_id'];
                $data['friend_users_id']   = $_REQUEST['friend_users_id'];
                $data['friend_status']   = 'pending';
                $data['date_created']   = date("Y-m-d");
				$info['data']     =  $data;
				
				if(get_freind_status($db,$_REQUEST['friend_users_id'])=="")
				{
					 $db->insert($info);
					 $Id = mysql_insert_id();
					 
					 $friend_users_id = $_SESSION['users_id'];
					 
					  unset($info);
					  unset($data);
					$info['table']    = "messages";
					$data['from_users_id']   = $_SESSION['users_id'];
					$data['to_users_id']   = $_REQUEST['friend_users_id'];
					$data['subject']   = 'Friend request from '.get_users_name($db,$_SESSION['users_id']);
					$data['message']   = get_users_name($db,$_SESSION['users_id']).' is interested to make freindship with you.
										  <a href="../friends/friends.php?cmd=accept&id='.$Id.'&friend_users_id='.$friend_users_id.'" class="btn btn-primary">Accept</a> 
										  <a href="../friends/friends.php?cmd=reject&id='.$Id.'" class="btn btn-primary">Reject</a>';
					$data['read_status']   = 'unread';
					$data['date_created']  = date("Y-m-d");
					$info['data']     =  $data;
						 $db->insert($info);
				
					
				}
				else
				{
					/*$info['where'] = "users_id='".$_SESSION['users_id']."' AND friend_users_id='".$_REQUEST['friend_users_id']."'";
					$db->update($info);
					$Id = mysql_insert_id();*/
					
				}
				$message = "Friend request has been sent";
	             if($_REQUEST['come']=="nav")
				 {
	               include("../friends/home_saerch_friends_view.php");
				 }
				 else
				 {
				    include("../friends/saerch_friends_view.php");
				 }	
			   break; 
	  case 'accept': 
				$Id               = $_REQUEST['id'];
				
				$info['table']    = "friends";
				$data['friend_status']   = 'accept';
				$info['data']     =  $data;
				
				if($Id)
				{   
				    $info['where']    = "id='$Id'";
					$db->update($info);
				}
				
				
				
				if(get_freind_status($db,$_REQUEST['friend_users_id'])=="")
				{   
				   //////////oposite///////
					  unset($info);
					  unset($data);
				    $info['table']    = "friends";
					$data['users_id']   = $_SESSION['users_id'];
					$data['friend_users_id']   = $_REQUEST['friend_users_id'];
					$data['friend_status']   = 'accept';
					$data['date_created']   = date("Y-m-d");
					$info['data']     =  $data;
					 $db->insert($info);
					 
						 ///Messages////////
					 unset($info);
					 unset($data);
					$info['table']    = "messages";
					$data['from_users_id']   = $_SESSION['users_id'];
					$data['to_users_id']   = $_REQUEST['friend_users_id'];
					$data['subject']   = "You are now friends with ".get_users_name($db,$_SESSION['users_id']);
					$data['message']   = get_users_name($db,$_SESSION['users_id'])." has been accepted your freind request"; 
					$data['read_status']   = 'unread';
					$data['date_created']  = date("Y-m-d");
					$info['data']     =  $data;
						 $db->insert($info);
				}
				else
				{
					/*$info['where'] = "users_id='".$_REQUEST['friend_users_id']."' AND friend_users_id='".$_SESSION['users_id']."'";
					$db->update($info);*/
				}
				
				Header("Location:../friends/friends.php?cmd=list");						   
				break; 		   		   
	 case 'reject':
	             $Id               = $_REQUEST['id'];
				 
				 $info["table"] = "friends";
				 $info["fields"] = array("friends.*"); 
				 $info["where"]   = "1 AND id='".$Id."'";
				 $arr =  $db->select($info);
				
				 $friend_users_id               = $arr[0]['friend_users_id'];
				 $info['table']    = "friends";				 
				 $info['where']    = "friend_users_id='$friend_users_id' AND users_id='".$_SESSION['users_id']."'";					
				 $db->delete($info);
				 
				 //oposite
				 $info['table']    = "friends";
				 $info['where']    = "friend_users_id='".$_SESSION['users_id']."' AND users_id='".$friend_users_id."'";					
				 $db->delete($info);
				
				if($_REQUEST['come']=="nav")
				 {
	               include("../friends/home_saerch_friends_view.php");
				 }
				 else
				 {
				    include("../friends/saerch_friends_view.php");
				 }						   
				break; 		
	 case "unfriend":
	             $friend_users_id               = $_REQUEST['friend_users_id'];
				 $info['table']    = "friends";				 
				 $info['where']    = "friend_users_id='$friend_users_id' AND users_id='".$_SESSION['users_id']."'";					
				 $db->delete($info);
				 
				 //oposite
				 $info['table']    = "friends";
				 $info['where']    = "friend_users_id='".$_SESSION['users_id']."' AND users_id='".$friend_users_id."'";					
				 $db->delete($info);
				 if($_REQUEST['come']=="nav")
				 {
	               include("../friends/home_saerch_friends_view.php");
				 }
				 else
				 {
				    include("../friends/saerch_friends_view.php");
				 }	
			   break;    			   	   		    
     case "search_friends":
				$_REQUEST['page'] = 1;  
				$_SESSION["search"]="yes";
				$_SESSION['field_name'] = $_REQUEST['field_name'];
				$_SESSION["field_value"] = $_REQUEST['field_value'];
				include("../friends/friends_list.php");
				break;  								   
						
	     default :    
		       Header("Location:../friends/friends.php?cmd=list");				         
	   }
?>
