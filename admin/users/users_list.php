<?php
 include("../template/header.php");
?>
<b><?=ucwords(str_replace("_"," ","users"))?></b>
  <table cellspacing="3" cellpadding="3" border="0"  width="100%" class="bdr">
   <tr>
			<td align="center" valign="top">
			  <form name="search_frm" id="search_frm" method="post">
				<table width="60%" border="0"  cellpadding="0" cellspacing="0" class="bodytext">
				  <TR>
					<TD  nowrap="nowrap">
					  <?php
						  $hash    =  getTableFieldsName("users");
						  $hash    = array_diff($hash,array("id"));
					  ?>
					  Search Key:
					  <select   name="field_name" id="field_name"  class="textbox">
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
					<TD  nowrap="nowrap" align="right"><label for="searchbar"><img src="../images/icon_searchbox.png" alt="Search"></label>
					   <input type="text"    name="field_value" id="field_value" value="<?=$_SESSION["field_value"]?>" class="textbox"></TD>
					<td nowrap="nowrap" align="right">
					  <input type="hidden" name="cmd" id="cmd" value="search_users" >
					  <input type="submit" name="btn_submit" id="btn_submit"  value="Search" class="button" />
					</td>
				  </TR>
				</table>
			  </form>
			</td>
   </tr>
   <tr>
   <td> 
		<a href="users.php?cmd=edit" class="nav3">Add a users</a>
		<table cellspacing="1" cellpadding="3" border="0" width="100%" class="bodytext">
			<tr bgcolor="#ABCAE0">
			 <!--<td>Password</td>-->
			  <td>Username</td>
			  <td>Title</td>
			  <td>First Name</td>
			  <td>Last Name</td>
			  <td>Email</td>
			  <td>Phone</td>
			  <td>Company</td>
			  <td>Address</td>
			  <td>City</td>
			  <td>State</td>
			  <td>Zip</td>
			  <td>Date Of Birth</td>
			  <td>Gender</td>
			  <td>Lives In</td>
			  <td>Hobby</td>
			  <td>Occupation</td>
			  <td>Country Id</td>
			  <td>Created At</td>
			  <td>Updated At</td>
			  <td>Verification Code</td>
			  <td>Verified</td>
			  <td>File Picture</td>
			  <td>File Cover</td>
			  <td>Type</td>
			  <td>Status</td>
			  
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
		 
				$rowsPerPage = 10;
				$pageNum = 1;
				if(isset($_REQUEST['page']))
				{
					$pageNum = $_REQUEST['page'];
				}
				$offset = ($pageNum - 1) * $rowsPerPage;  
		 
		 
							  
				$info["table"] = "users";
				$info["fields"] = array("users.*"); 
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
			  <!--<td><?=$arr[$i]['password']?></td>-->
			  <td><?=$arr[$i]['username']?></td>
			  <td><?=$arr[$i]['title']?></td>
			  <td><?=$arr[$i]['first_name']?></td>
			  <td><?=$arr[$i]['last_name']?></td>
			  <td><?=$arr[$i]['email']?></td>
			  <td><?=$arr[$i]['phone']?></td>
			  <td><?=$arr[$i]['company']?></td>
			  <td><?=$arr[$i]['address']?></td>
			  <td><?=$arr[$i]['city']?></td>
			  <td><?=$arr[$i]['state']?></td>
			  <td><?=$arr[$i]['zip']?></td>
			  <td><?=$arr[$i]['date_of_birth']?></td>
			  <td><?=$arr[$i]['gender']?></td>
			  <td><?=$arr[$i]['lives_in']?></td>
			  <td><?=$arr[$i]['hobby']?></td>
			  <td><?=$arr[$i]['occupation']?></td>
			  <td>
					<?php
                        unset($info2);        
                        $info2['table']    = country;	
                        $info2['fields']   = array("country");	   	   
                        $info2['where']    =  "1 AND id='".$arr[$i]['country_id']."' LIMIT 0,1";
                        $res2  =  $db->select($info2);
                        echo $res2[0]['country'];	
                    ?>
               </td>
			  <td><?=$arr[$i]['created_at']?></td>
			  <td><?=$arr[$i]['updated_at']?></td>
			  <td><?=$arr[$i]['verification_code']?></td>
			  <td><?=$arr[$i]['verified']?></td>
			  <td><img src="../../<?=$arr[$i]['file_picture']?>" style="width:50px;height:50px;" /></td>
			  <td><img src="../../<?=$arr[$i]['file_cover']?>" style="width:50px;height:50px;" /></td>
			  <td><?=$arr[$i]['type']?></td>
			  <td><?=$arr[$i]['status']?></td>
			  
			  <td nowrap >
				  <a href="users.php?cmd=edit&id=<?=$arr[$i]['id']?>" class="nav">Edit</a> |
				  <a href="users.php?cmd=delete&id=<?=$arr[$i]['id']?>" class="nav" onClick=" return confirm('Are you sure to delete this item ?');">Delete</a> 
			 </td>
		
			</tr>
		<?php
				  }
		?>
		
		<tr>
		   <td colspan="10" align="center">
			  <?php              
					  unset($info);
	
					  $info["table"] = "users";
					  $info["fields"] = array("count(*) as total_rows"); 
					  $info["where"]   = "1  $whrstr ORDER BY id DESC";
					  
					  $res  = $db->select($info);  
	
	
						$numrows = $res[0]['total_rows'];
						$maxPage = ceil($numrows/$rowsPerPage);
						$self = 'users.php?cmd=list';
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

</td>
</tr>
</table>

<?php
include("../template/footer.php");
?>









