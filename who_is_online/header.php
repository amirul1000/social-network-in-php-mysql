<?php
  /////////update online//// 
  if(isset($_SESSION["users_id"]))
  {
	  unset($info);
	  unset($data);
	$info["table"]     = "plus_login";
	$data['ip']        = $_SERVER['REMOTE_ADDR'];
	$data['tm']        = time();
	$data['status']    = 'online';
	
	$info['data'] = $data;
	$info["where"]     = "1 AND users_id='".$_SESSION["users_id"]."'";
	$info["debug"]     = true;
	$db->update($info); 
  }	
////////////////////////////////////	
?>