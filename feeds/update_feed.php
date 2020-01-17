<?php
		  session_start();
	    include("../common/lib.php");
	    include("../lib/class.db.php");
	    include("../common/config.php");
        include("../common_lib/common_lib.php");
		/*$info['table']    = "feeds";
		$data['users_id']   = base64_decode($_REQUEST['users_id']);
		$data['feedkey']   = base64_decode($_REQUEST['feedkey']);
		$data['file_feed']   = base64_decode($_REQUEST['feedkey'])."feed.xml";
		$info['data']     =  $data;
		
		$Id            = base64_decode($_REQUEST['id']);
		$info['where'] = "id=".$Id;
		
		$db->update($info);*/
		///////////////////////////////////////
		///////////////////////////////////////
		   if(isset($_REQUEST['row']))
			{
				$rowsPerPage = $_REQUEST['row'];
			}
			else
			{
				  $rowsPerPage = 100;
			}
			
			$pageNum = 1;
			if(isset($_REQUEST['page']))
			{
				$pageNum = $_REQUEST['page'];
			}
			$offset = ($pageNum - 1) * $rowsPerPage;  
	 
	 
			  unset($info);
			  unset($data);              
			$info["table"] = "contents LEFT OUTER JOIN users ON(contents.users_id=users.id)";
			$info["fields"] = array("contents.*,users.first_name,users.last_name"); 
			$info["where"]   = "1   $whrstr ORDER BY id DESC  LIMIT $offset, $rowsPerPage";
								
			
			$arr =  $db->select($info);
			$xml="<xml>\n\t\t";
			for($i=0;$i<count($arr);$i++)
			{
				$id            = $arr[$i]['id'];	
				$first_name    = $arr[$i]['first_name'];	
				$last_name     = $arr[$i]['last_name'];
				$content_type  = $arr[$i]['content_type'];						
				$content       = htmlspecialchars($arr[$i]['content']);						
				$date_created  = $arr[$i]['date_created'];
				$date_updated  = $arr[$i]['date_updated'];
				
				
				$xml .="<content>\n\t\t";
				$xml .= "<id>".$id."</id>\n\t\t";
				$xml .= "<first_name>".$first_name."</first_name>\n\t\t";
				$xml .= "<last_name>".$last_name."</last_name>\n\t\t";
				$xml .= "<content_type>".$content_type."</content_type>\n\t\t";
				$xml .= "<content>".$content."</content>\n\t\t";
				$xml .= "<date_created>".$date_created."</date_created>\n\t\t";
				$xml .= "<date_updated>".$date_updated."</date_updated>\n\t\t";
				//get all comments
					  unset($info);
					  unset($data);
					$info["table"] = "comments";
					$info["fields"] = array("comments.*"); 
					$info["where"]   = "1 AND contents_id='".$id."'";
					$arr_comments =  $db->select($info);
					for($m=0;$m<count($arr_comments);$m++)
					{		
					  $id = $arr_comments[$m]['id']; 
					  $name = get_users_name($db,$arr_comments[$m]['users_id']);							  
					  $comment = $arr_comments[$m]['comment']; 
					  $date_time_created = $arr_comments[$m]['date_time_created']; 
									
				$xml .="<comments>\n\t\t";
						$xml .= "<id>".$id."</id>\n\t\t";
						$xml .= "<name>".$name."</name>\n\t\t";
						$xml .= "<comment>".$comment."</comment>\n\t\t";
						$xml .= "<date_time_created>".$date_time_created."</date_time_created>\n\t\t";
				$xml .="</comments>\n\t\t";
					 }
				$xml.="</content>\n\t";
	
	
			 }
			$xml.="</xml>\n\r";
			
			$xmlobj=new SimpleXMLElement($xml);
			touch(base64_decode($_REQUEST['feedkey'])."feed.xml");
			$xmlobj->asXML(base64_decode($_REQUEST['feedkey'])."feed.xml");
			echo "<h3>Executed Successfully</h3>";
?>