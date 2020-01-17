<?php
	session_start();
	include("../common/lib.php");
	include("../common_lib/common_lib.php");
	include("../lib/class.db.php");
	include("../common/config.php");
	   
	  unset($info);
	  unset($data);
    $info["table"] = "friends LEFT OUTER JOIN users ON(friends.users_id=users.id)";
	$info["fields"] = array("users.*"); 
	$info["where"]   = "1 AND friends.users_id='".$_SESSION['users_id']."' AND friends.friend_status='accept'";
	$arr =  $db->select($info);
	
	for($i=0;$i<count($arr);$i++)
	{
	  echo $arr[$i]['first_name'].' '.$arr[$i]['last_name']."<br>";
    }
?>