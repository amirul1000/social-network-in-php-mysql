<?php
   include("../template/header.php");
?>
<script src="../js/jquery.js"></script>


<script language="javascript">

		$( document ).ready(function() {
			
			$('#checkAll').click(function(event) {  //on click 
						if(this.checked) { 
						// check select status
							$('.check').each(function() { //loop through each checkbox
								
								str = "#"+this.id.toString();
								$(str).attr('checked',true);
							});
						}else{
							$('.check').each(function() { //loop through each checkbox
								str = "#"+this.id.toString();
							
								$(str).removeAttr('checked');          
							});         
						}
					});
					
				
			
		});
		
		function submitForm()
		{
				var input = $("<input>")
					   .attr("type", "hidden")
					   .attr("name", "cmd").val("delete_all");
			$('#frm_chk').append($(input));
		
		   $( "#frm_chk" ).submit();
		}
</script>
<div class="page-section">
  <div class="row">
    <div class="col-md-10 col-lg-8 col-md-offset-1 col-lg-offset-2">

      <h4 class="page-section-heading">Notifications</h4>
      <div class="panel panel-default">
<table class="table v-middle">
   <tr>
			<td align="center" valign="top">
			  <form name="search_frm" id="search_frm" method="post">
				<table width="60%" border="0"  cellpadding="0" cellspacing="0" class="bodytext">
				  <TR>
					<TD  nowrap="nowrap">
					  <?php
						  $hash    =  getTableFieldsName("notifications");
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
					  <input type="hidden" name="cmd" id="cmd" value="search_notifications" >
					  <input type="submit" name="btn_submit" id="btn_submit"  value="Search" class="button" />
					</td>
				  </TR>
				</table>
			  </form>
			</td>
   </tr>
   <tr>
   <td> 
		<!--<a href="notifications.php?cmd=edit" class="nav3">Add a notifications</a>-->
		<table class="table v-middle">
			<tr bgcolor="#ABCAE0">
              <th><input type="checkbox" name="checkAll" id="checkAll" /></th>
			  <th>From Users </th>			
			  <th>Message</th>
			  <th>Read Status</th>
			  <th>Date Created</th>
			  <th>Action</th>
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
		        
				$whrstr = " AND to_users_id='".$_SESSION['users_id']."'";
				 
				$rowsPerPage = 10;
				$pageNum = 1;
				if(isset($_REQUEST['page']))
				{
					$pageNum = $_REQUEST['page'];
				}
				$offset = ($pageNum - 1) * $rowsPerPage;  
		 
		 
							  
				$info["table"] = "notifications";
				$info["fields"] = array("notifications.*"); 
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
			   <td>
                  <?php
				      if($i==0)
					  {
					     echo '<form id="frm_chk" action=""  method="post">';
					  }
				  ?>
                  <input type="checkbox" name="check[]" id="check_<?=$i?>" value="<?=$arr[$i]['id']?>"  class="check" />
                   <?php
				      if($i==count($arr)-1)
					  {
					     echo '</form>';
					  }
				  ?>
              </td>
               <td>
					<?php
                        unset($info2);        
                        $info2['table']    = "users";	
                        $info2['fields']   = array("*");	   	   
                        $info2['where']    =  "1 AND id='".$arr[$i]['from_users_id']."' LIMIT 0,1";
                        $res2  =  $db->select($info2);
                         echo $res2[0]['first_name'].' '.$res2[0]['last_name'];	
                    ?>
               </td>
			  <td>
			         <?=substr($arr[$i]['message'],0,100)?>
                                         
                     <a href="notifications.php?cmd=details&id=<?=$arr[$i]['id']?>" > More ...  </a>
              </td>
			  <td><?=$arr[$i]['read_status']?></td>
			  <td><?=$arr[$i]['date_created']?></td>
			  
			  <td nowrap >
				   <a href="notifications.php?cmd=delete&id=<?=$arr[$i]['id']?>" class="btn btn-sm red filter-cancel"  onClick=" return confirm('Are you sure to delete this item ?');"><i class="fa fa-times"></i>Delete</a> 

			 </td>
		
			</tr>
		<?php
				  }
		?>
		<tr>
          <td align="left">
              <a href="javascript:void();" class="btn btn-primary" onclick="submitForm();">Delete All Choices </a>
          </td>
        </tr>
		<tr>
		   <td colspan="10" align="center">
			  <?php              
					  unset($info);
	
					  $info["table"] = "notifications";
					  $info["fields"] = array("count(*) as total_rows"); 
					  $info["where"]   = "1  $whrstr ORDER BY id DESC";
					  
					  $res  = $db->select($info);  
	
	
						$numrows = $res[0]['total_rows'];
						$maxPage = ceil($numrows/$rowsPerPage);
						$self = 'notifications.php?cmd=list';
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
</div>
</div>
</div>
</div>
</div>

<?php
   //include("../template/footer.php");
?> 
<!-- BEGIN FOOTER -->
<div class="page-footer">
	<div class="page-footer-inner">
		 2014 &copy; Metronic by keenthemes. <a href="http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes" title="Purchase Metronic just for 27$ and get lifetime updates for free" target="_blank">Purchase Metronic!</a>
	</div>
	<div class="scroll-to-top">
		<i class="icon-arrow-up"></i>
	</div>
</div>
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="../v4.0.1/theme/assets/global/plugins/respond.min.js"></script>
<script src="../v4.0.1/theme/assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
                     
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="../v4.0.1/theme/assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="../v4.0.1/theme/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../v4.0.1/theme/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="../v4.0.1/theme/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="../v4.0.1/theme/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="../v4.0.1/theme/assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="../v4.0.1/theme/assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="../v4.0.1/theme/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<script src="../v4.0.1/theme/assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="../v4.0.1/theme/assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="../v4.0.1/theme/assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="../v4.0.1/theme/assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script>
      jQuery(document).ready(function() {    
         Metronic.init(); // init metronic core components
Layout.init(); // init current layout
QuickSidebar.init(); // init quick sidebar
Demo.init(); // init demo features
      });
   </script>
<!-- END JAVASCRIPTS -->



<script language="javascript">
       setInterval(function() {
            update_plus_login();
        }, 1000*60*5);
		function update_plus_login()
		{  
		    $.ajax({
					type: "POST",
					url: "../who_is_online/update_plus_login.php",
					data: {
						cmd  : "update_online_offline"
					 },
					success: function(data) {
					}//success
				});//ajax
		}
</script>


</body>
<!-- END BODY -->
</html>