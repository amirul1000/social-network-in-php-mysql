<?php 
   $server = 1;

   if($server == 1)
   {
	   $host     = "localhost"; 
	   $database = "linkotopia";
	   $user     = "root";
	   $password = "secret";
   }
   else
   {
       $host     = "localhost"; 
	   $database = "soft_social";
	   $user     = "soft_social";
	   $password = "123456";
   
   }
   
   $db  = new Db($host,$user,$password,$database);

?>
