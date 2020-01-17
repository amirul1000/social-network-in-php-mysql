<?php
session_start();
include("../common/lib.php");
include("../lib/class.db.php");
include("../common/config.php");

$cmd = $_REQUEST['cmd'];
switch($cmd)
{
    case "online_offline":
	
	         ///////////////////update online offlinr if no response in 10 min/////////////////////
			 //////////////////That will be transferred to the cron job in future//////////////////
		       $time = time();
		          unset($info);
				  unset($data);
				$info["table"]     = "plus_login";
				$data['status']    = 'offline';
				$info['data']      = $data;
			    $info["where"]     = "1 AND $time-tm>10*60 AND status ='online'";
				$db->update($info);
		    //////////////////////////////////////////////////////////////////////////////////////////		
	
	        $users_id_list = $_REQUEST['users_id_list'];
			
	          unset($info);
			  unset($data);  
			$info["table"] = "users
							 LEFT JOIN plus_login ON(plus_login.users_id=users.id)";
		    $info["fields"] = array("users.id,
									plus_login.users_id,
									plus_login.tm,
									plus_login.status"); 
		    $info["where"]   = "1  AND users.id in(".$users_id_list.")";
			$res             = $db->select($info);
		    echo json_encode($res);
	        break;
	default:
	        break;
}
?>
