<?php
/*
*get_users_name
*/
function get_users_name($db,$users_id)
{

    $info2['table']    = "users";	
	$info2['fields']   = array("*");	   	   
	$info2['where']    =  "1 AND id='".$users_id."' LIMIT 0,1";
	$res2  =  $db->select($info2);
	return $res2[0]['first_name'].' '.$res2[0]['last_name'];	
}

function get_username($db,$users_id)
{

    $info2['table']    = "users";	
	$info2['fields']   = array("*");	   	   
	$info2['where']    =  "1 AND id='".$users_id."' LIMIT 0,1";
	$res2  =  $db->select($info2);
	return $res2[0]['username'];	
}
/*
*get_file_picture
*/
function get_file_picture($db,$users_id)
{

    $info2['table']    = "users";	
	$info2['fields']   = array("*");	   	   
	$info2['where']    =  "1 AND id='".$users_id."' LIMIT 0,1";
	$res2  =  $db->select($info2);
	
	$image = "../".$res2[0]['file_picture'];
	if(!(file_exists($image) && is_file($image)))
	{
	  $image = "../images/no_image.jpg";	
	  return $image;  
	}
	return $image;
}
/*
*get_freind_status
*/
function get_freind_status($db,$users_id)
{
        $info["table"] = "friends";
		$info["fields"] = array("friends.*"); 
		$info["where"]   = "1 AND users_id='".$_SESSION['users_id']."'
		                      AND friend_users_id='".$users_id."'";
		$arr =  $db->select($info);
		
		return $arr[0]['friend_status'];
}
/*
*get_friend_users_id_list
*/
function get_friend_users_id_list($db,$users_id)
{
   
        $info["table"] = "friends";
		$info["fields"] = array("friends.*"); 
		$info["where"]   = "1 AND users_id='".$_SESSION['users_id']."' AND friend_status='accept'";
		$arr =  $db->select($info);

        for($i=0;$i<count($arr);$i++)
		{
		   $arr_friend_users_id[] = $arr[$i]['friend_users_id'];
		}
         
        if(count($arr_friend_users_id)>0)
	    {
	      $str = implode(",",$arr_friend_users_id);
	      return   substr($str,0,strlen($str));
	    }
}

/*
*get_friend_users_id_list
*/
function get_friend_count($db,$users_id)
{
   
        $info["table"] = "friends";
		$info["fields"] = array("count(*) as total_rows"); 
		$info["where"]   = "1 AND users_id='".$_SESSION['users_id']."' AND friend_status='accept'";
		$arr =  $db->select($info);

        return $arr[0]['total_rows'];
}
/*
*get_likes_count
*/
function get_likes_count($db,$contents_id)
{
        unset($info);	
	  $info["table"] = "likes";
	  $info["fields"] = array("count(*) as total_rows"); 
	  $info["where"]   = "1  AND contents_id='".$contents_id."'";
      $res  = $db->select($info);  
      $numrows = $res[0]['total_rows'];
	  
	  return $numrows;
}
/*
*get_likes_users_id
*/
function get_likes_users_id($db,$contents_id)
{
        unset($info);	
	 	$info["table"] = "likes";
		$info["fields"] = array("likes.*"); 
		$info["where"]   = "1  AND likes_users_id='".$_SESSION['users_id']."' 
		                       AND contents_id='".$contents_id."'";
		
		$arr =  $db->select($info);
		
		return count($arr);
		
}
/*
*get_likes_owner_users_id
*/
function get_likes_owner_users_id($db,$contents_id)
{
       unset($info);	               
	$info["table"] = "contents";
	$info["fields"] = array("contents.*"); 
	$info["where"]   = "1 AND id='".$contents_id."'";
	$arr =  $db->select($info);
	
	return $arr[0]['users_id'];
}
/*
*add_views
*/
function add_views($db,$users_id)
{
    
	if($_SESSION['users_id']==$users_id)
	{
	  return;
	}
	else if(empty($_SESSION['users_id']))
	{
	  return; 
	}
	
	$info["table"] = "views";
	$info["fields"] = array("views.*"); 
	$info["where"]   = "1 AND users_id='".$users_id."'  AND viwers_users_id='". $_SESSION['users_id']."'";
	$arr =  $db->select($info);
	
	$Id = $arr[0]['id'];
	
	  unset($info);
	  unset($data);
	$info['table']    = "views";
	$data['users_id']   = $users_id;
	$data['viwers_users_id']   = $_SESSION['users_id'];
	$data['date_time']   = date("Y-m-d H:i:s");
	$info['data']     =  $data;
	
	if(empty($Id))
	{
		 $db->insert($info);
	}
}
/*
*get_views_count
*/
function get_views_count($db,$users_id)
{
       	 unset($info);	
		 unset($info);	
	  $info["table"] = "views";
	  $info["fields"] = array("count(*) as total_rows"); 
	  $info["where"]   = "1 AND users_id='".$users_id."'";
	  $res  = $db->select($info);  
	  
	 $numrows = $res[0]['total_rows'];
	 
	 return $numrows;;
}
/*
*get_page_weights
*/
function get_page_weights($db,$users_id)
{
   
        unset($info);	
	  $info["table"] = "contents";
	  $info["fields"] = array("count(*) as total_rows"); 
	  $info["where"]   = "1  AND users_id='".$users_id."' ORDER BY id DESC";
	   $res  = $db->select($info);  
      $total_contents = $res[0]['total_rows'];
   
   
        unset($info);	
	  $info["table"] = "likes";
	  $info["fields"] = array("count(*) as total_rows"); 
	  $info["where"]   = "1    AND owner_users_id='".$users_id."' ORDER BY id DESC";
	  $res  = $db->select($info);  
	    $total_likes = $res[0]['total_rows'];
		   
   
      return ceil($total_likes/$total_contents);  
}
/*
  get content owner id
*/
function get_content_owner_id($db,$id)
{
    $info["table"] = "contents";
	$info["fields"] = array("contents.*"); 
	$info["where"]   = "1 AND id='".$id."'";
	$arr =  $db->select($info); 
	
	return $arr[0]['users_id'];
}
/*
  check shared
*/
function shared($db,$id)
{
    $info["table"] = "shared";
	$info["fields"] = array("shared.*"); 
	$info["where"]   = "1  AND id='".$id."' AND shared_users_id='".$_SESSION['users_id']."'";
	$arr =  $db->select($info);
	
	if(count($arr)>0)
	{
	  return true;
	}
   return false;
}

function get_shared_count($db,$id)
{
  $info["table"] = "shared";
  $info["fields"] = array("count(*) as total_rows"); 
  $info["where"]   = "1 AND contents_id='".$id."'";
  $res  = $db->select($info);  
	$numrows = $res[0]['total_rows'];
  
  return $numrows;
}

function get_comments_count($db,$id)
{
  $info["table"] = "comments";
  $info["fields"] = array("count(*) as total_rows"); 
  $info["where"]   = "1 AND contents_id='".$id."'";
  $res  = $db->select($info);  
	$numrows = $res[0]['total_rows'];
  
  return $numrows;
}


?>