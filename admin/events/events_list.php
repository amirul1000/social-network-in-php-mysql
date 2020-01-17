<?php
 include("../template/header.php");
?>
<b><?=ucwords(str_replace("_"," ","events"))?></b>
  <table cellspacing="3" cellpadding="3" border="0"  width="100%" class="bdr">
   <tr>
			<td align="center" valign="top">
			  <form name="search_frm" id="search_frm" method="post">
				<table width="60%" border="0"  cellpadding="0" cellspacing="0" class="bodytext">
				  <TR>
					<TD  nowrap="nowrap">
					  <?php
						  $hash    =  getTableFieldsName("events");
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
					  <input type="hidden" name="cmd" id="cmd" value="search_events" >
					  <input type="submit" name="btn_submit" id="btn_submit"  value="Search" class="button" />
					</td>
				  </TR>
				</table>
			  </form>
			</td>
   </tr>
   <tr>
   <td> 
		<a href="events.php?cmd=edit" class="nav3">Add a events</a>
		<table cellspacing="1" cellpadding="3" border="0" width="100%" class="bodytext">
          <tr>
           <td>
		 <?php
				
				if($_SESSION["search"]=="yes")
				  {
					$whrstr = " AND ".$_SESSION['field_name']." LIKE '%".$_SESSION["field_value"]."%'";
				  }
				  else
				  {
					$whrstr = "";
				  }
		 
				$rowsPerPage = 100;
				$pageNum = 1;
				if(isset($_REQUEST['page']))
				{
					$pageNum = $_REQUEST['page'];
				}
				$offset = ($pageNum - 1) * $rowsPerPage;  
		 
		 
							  
				$info["table"] = "events";
				$info["fields"] = array("events.*"); 
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
            <table cellspacing="3" cellpadding="3" width="50%">
               <tr>
                   <td width="50%">
                   <b>
                   <?php
				     echo $offset+$i+1;
				   ?>
                   </b>
                   </td>
                   <td  width="50%"></td>
               </tr>
			   <tr><td width="50%">Users </td><td  width="50%">
					<?php
                        unset($info2);        
                        $info2['table']    = "users";	
                        $info2['fields']   = array("*");	   	   
                        $info2['where']    =  "1 AND id='".$arr[$i]['users_id']."' LIMIT 0,1";
                        $res2  =  $db->select($info2);
                        echo $res2[0]['first_name'].' '.$res2[0]['last_name'];	
                    ?>
               </td></tr>
			   <tr><td>Category </td><td>
					<?php
                        unset($info2);        
                        $info2['table']    = "category";	
                        $info2['fields']   = array("cat_name");	   	   
                        $info2['where']    =  "1 AND id='".$arr[$i]['category_id']."' LIMIT 0,1";
                        $res2  =  $db->select($info2);
                        echo $res2[0]['cat_name'];	
                    ?>
               </td></tr>
			  <tr><td>Age </td><td>
					<?php
                        unset($info2);        
                        $info2['table']    = "age";	
                        $info2['fields']   = array("age_name");	   	   
                        $info2['where']    =  "1 AND id='".$arr[$i]['age_id']."' LIMIT 0,1";
                        $res2  =  $db->select($info2);
                        echo $res2[0]['age_name'];	
                    ?>
               </td></tr>
			   <tr><td>Timezone </td><td>
					<?php
                        unset($info2);        
                        $info2['table']    = "timezone";	
                        $info2['fields']   = array("zone_name");	   	   
                        $info2['where']    =  "1 AND id='".$arr[$i]['timezone_id']."' LIMIT 0,1";
                        $res2  =  $db->select($info2);
                        echo $res2[0]['zone_name'];	
                    ?>
               </td></tr>
			  <tr><td>Ticket Name</td><td><?=$arr[$i]['ticket_name']?></td></tr>
			  <tr><td>Venue Name</td><td><?=$arr[$i]['venue_name']?></td></tr>
			  <tr><td>Venue Post Code</td><td><?=$arr[$i]['venue_post_code']?></td></tr>
			  <tr><td>Start Date</td><td><?=$arr[$i]['start_date']?></td></tr>
			  <tr><td>Start Time Hr</td><td><?=$arr[$i]['start_time_hr']?></td></tr>
			  <tr><td>Start Time Min</td><td><?=$arr[$i]['start_time_min']?></td></tr>
			  <tr><td>Start Am Pm</td><td><?=$arr[$i]['start_am_pm']?></td></tr>
			  <tr><td>End Date</td><td><?=$arr[$i]['end_date']?></td></tr>
			  <tr><td>End Time Hr</td><td><?=$arr[$i]['end_time_hr']?></td></tr>
			  <tr><td>End Time Min</td><td><?=$arr[$i]['end_time_min']?></td></tr>
			  <tr><td>End Am Pm</td><td><?=$arr[$i]['end_am_pm']?></td></tr>
			  <tr><td>Price</td><td><?=$arr[$i]['price']?></td></tr>
			  <tr><td>Starting Ticket No</td><td><?=$arr[$i]['starting_ticket_no']?></td></tr>
			  <tr><td>In Stock</td><td><?=$arr[$i]['in_stock']?></td></tr>
			  <tr><td>Is Security Code</td><td><?=$arr[$i]['is_security_code']?></td></tr>
			  <tr><td>Security Code</td><td><?=$arr[$i]['security_code']?></td></tr>
			  <tr><td>File Ticket</td><td>
                   <?php
				    if( is_file('../../'.$arr[$i]['file_ticket']) && file_exists('../../'.$arr[$i]['file_ticket']) )
					{
				   ?>
                   <img src="../../<?=$arr[$i]['file_ticket']?>" style="width:100px;" />
                   <?php
				    }
					else
					{
				  ?>
                  <img src="../../images/no_image.jpg" style="width:100px;" />
                  <?php	
					}
                  ?>
              </td></tr>
			  <tr><td>Description</td><td><?=$arr[$i]['description']?></td></tr>
			  <tr><td>File Thumb1</td><td>
                  <?php
				    if( is_file('../../'.$arr[$i]['file_thumb1']) && file_exists('../../'.$arr[$i]['file_ticket']) )
					{
				   ?>
                      <img src="../../<?=$arr[$i]['file_thumb1']?>" style="width:100px;" />
                   <?php
				    }
					else
					{
				  ?>
                      <img src="../../images/no_image.jpg" style="width:100px;" />
                  <?php	
					}
                  ?>              
              </td></tr>
			  <tr><td>File Thumb2</td><td>
                   <?php
				    if( is_file('../../'.$arr[$i]['file_thumb2']) && file_exists('../../'.$arr[$i]['file_ticket']) )
					{
				   ?>
                      <img src="../../<?=$arr[$i]['file_thumb2']?>" style="width:100px;" />
                   <?php
				    }
					else
					{
				  ?>
                      <img src="../../images/no_image.jpg" style="width:100px;" />
                  <?php	
					}
                  ?>
              </td></tr>
			  <tr><td>File Thumb3</td><td>
                   <?php
				    if( is_file('../../'.$arr[$i]['file_thumb3']) && file_exists('../../'.$arr[$i]['file_ticket']) )
					{
				   ?>
                      <img src="../../<?=$arr[$i]['file_thumb3']?>" style="width:100px;" />
                   <?php
				    }
					else
					{
				  ?>
                      <img src="../../images/no_image.jpg" style="width:100px;" />
                  <?php	
					}
                  ?> 
              
              </td></tr>
              <tr><td>Background color</td><td><?=$arr[$i]['background_color']?></td></tr>
              <tr><td>File Background Image</td><td>
                   <?php
				    if( is_file('../../'.$arr[$i]['file_backgroundimage']) && file_exists('../../'.$arr[$i]['file_backgroundimage']) )
					{
				   ?>
                   <img src="../../<?=$arr[$i]['file_backgroundimage']?>" style="width:100px;" />
                   <?php
				    }
					else
					{
				  ?>
                  <img src="../../images/no_image.jpg" style="width:100px;" />
                  <?php	
					}
                  ?>
              </td></tr>
			  <tr><td>Is Approved</td><td><?=$arr[$i]['is_approved']?></td></tr>
			   <tr><td>Status</td><td><?=$arr[$i]['status']?></td></tr>
			   <tr><td>Action</td><td nowrap >
				  <a href="events.php?cmd=edit&id=<?=$arr[$i]['id']?>" class="nav">Edit</a> |
				  <a href="events.php?cmd=delete&id=<?=$arr[$i]['id']?>" class="nav" onClick=" return confirm('Are you sure to delete this item ?');">Delete</a> 
             </td>
			</tr>
            <tr>
              <hr />
            </tr>
           </table> 
		<?php
				  }
		?>
		</td>
        </tr>
		<tr>
		   <td colspan="10" align="center">
			  <?php              
					  unset($info);
	
					  $info["table"] = "events";
					  $info["fields"] = array("count(*) as total_rows"); 
					  $info["where"]   = "1  $whrstr ORDER BY id DESC";
					  
					  $res  = $db->select($info);  
	
	
						$numrows = $res[0]['total_rows'];
						$maxPage = ceil($numrows/$rowsPerPage);
						$self = 'events.php?cmd=list';
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









