<style type="text/css">
	.phototable1{
    font-family: 'Lato', sans-serif;
    color: #555;
  }
  
  .phototable2 > tbody > tr > td{
    border: 0 none !important;
    padding: 10px 15px;
    font-size: 14px;
    text-transform: capitalize;
  }
  .phototable2 > tbody > tr:first-child > td{
    background: #010101 none repeat scroll 0 0;
    color: #fff;
    font-size: 15px;
    font-weight: 400;
  }
  .phototable2 > tbody > tr > td:first-child{
    position: relative;

  }
  .phototable2 > tbody > tr > td:last-child a{
    display: inline-block;
    color: #fff;
    background: rgba(26, 179, 148, 0.9);
    text-transform: uppercase;
    font-size: 12px;
    font-weight: 700;
    padding: 6px;
    margin: 0px 1px;
    text-decoration: none;
    border-radius: 2px;
  }
  .phototable2 > tbody > tr:last-child > td{
    position: relative;
  }
  .nav3{
  	background: rgba(26, 179, 148, 0.9) none repeat scroll 0 0;
    color: #fff;
    display: inline-block;
    padding: 8px 25px;
    text-decoration: none;
    font-weight: 700;
    border-radius: 2px;
    margin: 0 0 20px ;
  }
  .div-10{
  	margin-left: -10px;
  	margin-right: -10px;
  }
  .searchkey-text{
  	font-size: 14px;display:inline-block;margin-right: 2px;
  }
  .phselect{
  	width: 300px;height:34px;border-radius: 2px;border:1px solid #ccc;box-shadow:none;
  }
  .searchbox{
  	    position: relative;
    width: 226px;
    margin: 0px;
    border: 1px solid #ccc;
    height: 32px;
  }
  .searchbox .textbox{
  	width: 100%;
    border: 0px !important;
    height: 32px;
    margin: 0px;
    padding: 0 8px;
  }
  .phsearch{
  	background: rgba(26, 179, 148, 0.9) none repeat scroll 0 0;
    height: 34px;
    border: 0px;
    color: #fff;
    padding: 0 16px;
    border-radius: 2px;
    font-size: 14px;
  }
  .width-full{
  	width: 100%;
  	overflow: hidden;
  }
  .photo-add-title{
  	font-size: 18px;
    font-family: 'Lato', sans-serif;
    margin: 20px 0;
  }
</style>
<div class="width-full">
	 <p class="photo-add-title"><b><?=ucwords(str_replace("_"," ","photos"))?></b></p>
  <table cellspacing="0" cellpadding="0" border="0"  width="100%" class="bdr phototable1">
   <tr>
			<td align="center" valign="top">
			  <form name="search_frm" id="search_frm" method="post">
				<table width="100%" border="0"  cellpadding="0" cellspacing="0" class="bodytext">
				  <TR>
					<TD  nowrap="nowrap" class="phselect-td">
					  <?php
						  $hash    =  getTableFieldsName("photos");
						  $hash    = array_diff($hash,array("id"));
					  ?>
					  <span class="searchkey-text">Search Key: </span>
					  <select   name="field_name" id="field_name"  class="textbox phselect">
						<option value="">--Select--</option>
						<?php
						foreach($hash as $key=>$value)
						{
					    ?>
						<option value="<?=$key?>" <?php if($_SESSION['field_name']==$key) echo "selected"; ?>><?=str_replace("_"," ",$value)?></option>
						<?php
					    }
					  ?>
					  </select>
					</TD>
					<TD  nowrap="nowrap" align="right">
						<div class="searchbox">
							<label for="searchbar"></label>
					   		<input type="text" placeholder="Search" name="field_value" id="field_value" value="<?=$_SESSION["field_value"]?>" class="textbox">
						</div>
						
					</TD>
					<td nowrap="nowrap" align="right">
					  <input type="hidden" name="cmd" id="cmd" value="search_photos" >
					  <input type="submit" name="btn_submit" id="btn_submit"  value="Search" class="button phsearch" />
					</td>
				  </TR>
				</table>
			  </form>
			</td>
   </tr>
   <tr>
   <td> 
		<a href="photos.php?cmd=edit" class="nav3">Add a photo</a>
		<div class="div-10">
			<table cellspacing="0" cellpadding="0" border="0" width="100%" class="bodytext phototable2">
			<tr bgcolor="#ABCAE0">
			  <td>Photo Name</td>
			  <td>File Photo</td>
			  <td>Date Created</td>
			  <td>Action</td>
			</tr>
		 <?php
				
				if($_SESSION["search"]=="yes")
				  {
					$whrstr = " AND ".$_SESSION['field_name']." LIKE '%".$_SESSION["field_value"]."%'";
				  }
				  else
				  {
					$whrstr = "";
				  }
				  
				$whrstr .= " AND users_id='".$_SESSION['users_id']."'";
				  
		 
				$rowsPerPage = 10;
				$pageNum = 1;
				if(isset($_REQUEST['page']))
				{
					$pageNum = $_REQUEST['page'];
				}
				$offset = ($pageNum - 1) * $rowsPerPage;  
		 
		 
							  
				$info["table"] = "photos";
				$info["fields"] = array("photos.*"); 
				$info["where"]   = "1   $whrstr ORDER BY id DESC  LIMIT $offset, $rowsPerPage";
									
				
				$arr =  $db->select($info);
				
				for($i=0;$i<count($arr);$i++)
				{
				
				   $rowColor;
		
					if($i % 2 == 0)
					{
						
						$row="#C8C8C8";
					}
					else
					{
						
						$row="#FFFFFF";
					}
				
		 ?>
			<tr bgcolor="<?=$row?>" onmouseover=" this.style.background='#ECF5B6'; " onmouseout=" this.style.background='<?=$row?>'; ">
			  <td><?=$arr[$i]['photo_name']?></td>
			  <td><img src="../<?=$arr[$i]['file_photo']?>" style="width:100px;height:100px;" /></td>
			  <td><?=$arr[$i]['date_created']?></td>
			  <td nowrap >
				  <a href="photos.php?cmd=edit&id=<?=$arr[$i]['id']?>" class="nav">Edit</a> 
				  <a href="photos.php?cmd=delete&id=<?=$arr[$i]['id']?>" class="nav" onClick=" return confirm('Are you sure to delete this item ?');">Delete</a> 
			 </td>
			</tr>
		<?php
				  }
		?>
		
		<tr>
		   <td colspan="10" align="center">
			  <?php              
					  unset($info);
	
					  $info["table"] = "photos";
					  $info["fields"] = array("count(*) as total_rows"); 
					  $info["where"]   = "1  $whrstr ORDER BY id DESC";
					  
					  $res  = $db->select($info);  
	
	
						$numrows = $res[0]['total_rows'];
						$maxPage = ceil($numrows/$rowsPerPage);
						$self = 'photos.php?cmd=list';
						$nav  = '';
						
						$start    = ceil($pageNum/5)*5-5+1;
						$end      = ceil($pageNum/5)*5;
						
						if($maxPage<$end)
						{
						  $end  = $maxPage;
						}
						
						for($page = $start; $page <= $end; $page++)
						//for($page = 1; $page <= $maxPage; $page++)
						{
							if ($page == $pageNum)
							{
								$nav .= " $page "; 
							}
							else
							{
								$nav .= " <a href=\"$self&&page=$page\" class=\"nav\">$page</a> ";
							} 
						}
						if ($pageNum > 1)
						{
							$page  = $pageNum - 1;
							$prev  = " <a href=\"$self&&page=$page\" class=\"nav\">[Prev]</a> ";
					
						   $first = " <a href=\"$self&&page=1\" class=\"nav\">[First Page]</a> ";
						} 
						else
						{
							$prev  = '&nbsp;'; 
							$first = '&nbsp;'; 
						}
					
						if ($pageNum < $maxPage)
						{
							$page = $pageNum + 1;
							$next = " <a href=\"$self&&page=$page\" class=\"nav\">[Next]</a> ";
					
							$last = " <a href=\"$self&&page=$maxPage\" class=\"nav\">[Last Page]</a> ";
						} 
						else
						{
							$next = '&nbsp;'; 
							$last = '&nbsp;'; 
						}
						
						if($numrows>1)
						{
						  echo $first . $prev . $nav . $next . $last;
						}
						
					?>     
		   </td>
		</tr>
		</table>

		</div>
		

</td>
</tr>
</table>
</div>






