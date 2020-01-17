<?php 
       session_start();
       include("../../common/lib.php");
	   include("../../lib/class.db.php");
	   include("../../common/config.php");
	   
	    if(empty($_SESSION['adminusers_id'])) 
	   {
	     Header("Location: ../login/login.php");
	   }
	   ini_set('display_errors', '1');
	   $cmd = $_REQUEST['cmd'];
	   switch($cmd)
	   {
         case 'delete': 
				$Id               = $_REQUEST['id'];
				
				$info['table']    = "plugins";
				$info['where']    = "id='$Id'";
				
				if($Id)
				{
					$db->delete($info);
				}
				include("../plugins/plugins_list.php");						   
				break; 
		  case "upload_plugin":
		       /////////////////////////////////
			   ///////////upload zip////////////
			   ////////////////////////////////	
				if($_FILES["zip_file"]["name"]) {
				$filename = $_FILES["zip_file"]["name"];
				$source = $_FILES["zip_file"]["tmp_name"];
				$type = $_FILES["zip_file"]["type"];
				
				$name = explode(".", $filename);
				$accepted_types = array('application/zip', 'application/x-zip-compressed', 'multipart/x-zip', 'application/x-compressed');
				foreach($accepted_types as $mime_type) {
					if($mime_type == $type) {
						$okay = true;
						break;
					} 
				}
				
				$continue = strtolower($name[1]) == 'zip' ? true : false;
				
				if($continue==false) {
					$message = "The file you are trying to upload is not a .zip file. Please try again.";
				}
				
				/* PHP current path */
				$path = dirname(__FILE__).'/install/';  // absolute path to the directory where zipper.php is in
				
				
				$filenoext = basename ($filename, '.zip');  // absolute path to the directory where zipper.php is in (lowercase)
				$filenoext = basename ($filenoext, '.ZIP');  // absolute path to the directory where zipper.php is in (when uppercase)
				
				$targetdir = $path . $filenoext; // target directory
				$targetzip = $path . $filename; // target zip file
				
				/* create directory if not exists', otherwise overwrite */
				/* target directory is same as filename without extension */
				
				if (is_dir($targetdir))  rmdir_recursive ( $targetdir);
				
				mkdir($targetdir, 0777);
				
				
				/* here it is really happening */
				
				if(move_uploaded_file($source, $targetzip)) {
					$zip = new ZipArchive();
					$x = $zip->open($targetzip);  // open the zip file to extract
					if ($x === true) {
						$zip->extractTo($targetdir); // place in the directory with same name  
						$zip->close();
				
						unlink($targetzip);
					}
					$message = "Your .zip file was uploaded and unpacked.";
					$success = 1;
				} else {    
					$message = "There was a problem with the upload. Please try again.";
				}
				}
				
				///////////////////////////////////////
				////////////////save Plugin/////////////////
				///////////////////////////////////////
				if($success == 1)
				{
				  $arr_files = getFilesFromDir($targetdir);
				  
				  $arr_path    = explode("/",$targetdir);
				  $plugin_dir  = $arr_path[count($arr_path)-1];
				  
				  ////////////////save Plugin/////////////////
				 
				  foreach($arr_files[0] as $key=>$file)
				  {
					 $contents = file_get_contents($file);
					 if (preg_match("/(.*)Name:(.*)/i", $contents)&&
						 preg_match("/(.*)Author:(.*)/i", $contents)&&
						 preg_match("/(.*)Version:(.*)/i", $contents)) {
							$plugin = true;
							break;
						} 
				  }
				}
				
				if($plugin == true)
				{
				      preg_match_all("/Name:(.*?)Author:(.*)/is", $contents, $matches);
				      $Name   =  $matches[1][0];   
					  unset($matches);
					  preg_match_all("/Author:(.*?)Version:/is", $contents, $matches);
				      $Author =  $matches[1][0]; 
					  unset($matches);
					  preg_match_all("/Version:(.*?)\*/is", $contents, $matches);
				      $Version =  $matches[1][0];                
					
					  //save 
					    unset($info);
						unset($data);
					  $info["table"] = "plugins";
					  $info["fields"] = array("plugins.*"); 
					  $info["where"]   = "1 AND plugin_name='".trim($Name)."'";
						$arr =  $db->select($info);						
					  if(count($arr)>0)
					  {
					    $Id            = $arr[0]['id'];
					  }
					  
					  $activated_path_arr = explode("/admin",$targetdir);
					     unset($info);
						 unset($data);
					    $info['table']    = "plugins";
						$data['plugin_name']   = trim($Name);
						$data['plugin_description']   = $Author.' '.$Version;
						$data['plugin_status']   = 'activate';
						$data['uploaded_path']   =  trim($targetdir);
						$data['activated_path']  =  trim($activated_path_arr[0]);
						$data['date_installed']   = date("Y-m-d H:i:s");
						$info['data']     =  $data;
						
						if(empty($Id))
						{
							 $db->insert($info);
						}
						else
						{
							$info['where'] = "id=".$Id;
							$db->update($info);
						}
				}		
				////////////////////////////////////////////
				
				
		       include("../plugins/plugins_list.php");						   
				break;
				
		case "activate":
		                unset($info);
						unset($data);
					  $info["table"] = "plugins";
					  $info["fields"] = array("plugins.*"); 
					  $info["where"]   = "1 AND id='".$_REQUEST['id']."'";
						$arr =  $db->select($info);	
						
						
						$uploaded_path   = $arr[0]['uploaded_path']; 
						$activated_path  =  $arr[0]['activated_path']; 
						
					     unset($info);
						 unset($data);
					    $info['table']    = "plugins";
						$data['plugin_status']   = 'activate';
						$info['data']     =  $data;
						$info['where'] = "id=".$_REQUEST['id'];
						$db->update($info);
							
					  $arr_path    = explode("/",$uploaded_path);
					  $plugin_dir  = $arr_path[count($arr_path)-1];
					  $destination = $activated_path.'/'.$plugin_dir;
					  
					 //chmod($activated_path,0777,true); 
					 mkdir($destination, 0777);
					  ////////////////save Plugin/////////////////
					  
					$arr_files = getFilesFromDir($uploaded_path);
					
					
					
					  foreach($arr_files[0] as $key=>$file)
					  {
						 $basename = basename($file);
						 copy($file,$destination.'/'.$basename);
						 
					  }
					
					  
					 /* function getFilesFromDir2($dir,$destination) {
					   $files = array();
						  if ($handle = opendir($dir)) {
							while (false !== ($file = readdir($handle))) {
								if ($file != "." && $file != "..") {
									if(is_dir($dir.'/'.$file)) {
										$dir2 = $dir.'/'.$file;
										getFilesFromDir2($dir2,$destination);
									}
									else {
									  $file2 = basename( $dir.'/'.$file);
									  $source = $dir.'/'.$file;
									  $destination2 = $destination."/".$file2;
									  
									  echo $source;
									  echo $destination2;
									  copy($source,$destination2);
									}
								}
							}
							closedir($handle);
						  }
						} */
					   
					  // getFilesFromDir2($uploaded_path,$destination);
		           include("../plugins/plugins_list.php");						   
				break;
		case "deactive":
		               unset($info);
						unset($data);
					  $info["table"] = "plugins";
					  $info["fields"] = array("plugins.*"); 
					  $info["where"]   = "1 AND id='".$_REQUEST['id']."'";
						$arr =  $db->select($info);	
						
						
						$uploaded_path   = $arr[0]['uploaded_path']; 
						$activated_path  =  $arr[0]['activated_path']; 
						
						$uploaded_path_arr = explode("/",$uploaded_path);
						$module = $uploaded_path_arr[count($uploaded_path_arr)-1];
						
						
					     unset($info);
						 unset($data);
					    $info['table']    = "plugins";
						$data['plugin_status']   = 'deactive';
						$info['data']     =  $data;
						$info['where'] = "id=".$_REQUEST['id'];
						$db->update($info);
							
						$dir = $activated_path."/".$module;
						rmdir_recursive($dir);	
		       include("../plugins/plugins_list.php");						   
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
				include("../plugins/plugins_list.php");
				break; 
        case "search_plugins":
				$_REQUEST['page'] = 1;  
				$_SESSION["search"]="yes";
				$_SESSION['field_name'] = $_REQUEST['field_name'];
				$_SESSION["field_value"] = $_REQUEST['field_value'];
				include("../plugins/plugins_list.php");
				break;  								   
						
	     default :    
		       include("../plugins/plugins_editor.php");		         
	   }

//Protect same image name
function getFilesFromDir($dir) {
	  $files = array();
	  if ($handle = opendir($dir)) {
		while (false !== ($file = readdir($handle))) {
			if ($file != "." && $file != "..") {
				if(is_dir($dir.'/'.$file)) {
					$dir2 = $dir.'/'.$file;
					$files[] = getFilesFromDir($dir2);
				}
				else {
				  $files[] = $dir.'/'.$file;
				}
			}
		}
		closedir($handle);
		return $files;
	  }
	}  	
	
function rmdir_recursive($dir) {
		foreach(scandir($dir) as $file) {
		if ('.' === $file || '..' === $file) continue;
		if (is_dir("$dir/$file")) rmdir_recursive("$dir/$file");
		else unlink("$dir/$file");
		}	
	  rmdir($dir);
	}	 
?>
