<?php
 include("../template/header.php");
?>
<script language="javascript" src="events.js"></script>
<script type="text/javascript" src="../../js/jquery.js"></script>
<script	src="../../js/main.js" type="text/javascript"></script>
<link rel="stylesheet" href="../../css/datepicker.css">
<b><?=ucwords(str_replace("_"," ","events"))?></b><br />
<table cellspacing="3" cellpadding="3" border="0" align="center" width="98%" class="bdr">
 <tr>
  <td>  
     <a href="events.php?cmd=list" class="nav3">List</a>
	 <form name="frm_events" method="post"  enctype="multipart/form-data" onSubmit="return checkRequired();">			
		<table cellspacing="3" cellpadding="3" border="0" align="center" class="bodytext" width="100%">  
		 <tr>
							 <td>Users</td>
							 <td><?php
	$info['table']    = "users";
	$info['fields']   = array("*");   	   
	$info['where']    =  "1=1 ORDER BY id DESC";
	$resusers  =  $db->select($info);
?>
<select  name="users_id" id="users_id"   class="textbox">
	<option value="">--Select--</option>
	<?php
	   foreach($resusers as $key=>$each)
	   { 
	?>
	  <option value="<?=$resusers[$key]['id']?>" <?php if($resusers[$key]['id']==$users_id){ echo "selected"; }?>><?=$resusers[$key]['first_name']?> <?=$resusers[$key]['last_name']?></option>
	<?php
	 }
	?> 
</select></td>
					  </tr><tr>
							 <td>Category</td>
							 <td><?php
	$info['table']    = "category";
	$info['fields']   = array("*");   	   
	$info['where']    =  "1=1 ORDER BY id DESC";
	$rescategory  =  $db->select($info);
?>
<select  name="category_id" id="category_id"   class="textbox">
	<option value="">--Select--</option>
	<?php
	   foreach($rescategory as $key=>$each)
	   { 
	?>
	  <option value="<?=$rescategory[$key]['id']?>" <?php if($rescategory[$key]['id']==$category_id){ echo "selected"; }?>><?=$rescategory[$key]['cat_name']?></option>
	<?php
	 }
	?> 
</select></td>
					  </tr><tr>
							 <td>Age</td>
							 <td><?php
	$info['table']    = "age";
	$info['fields']   = array("*");   	   
	$info['where']    =  "1=1 ORDER BY id DESC";
	$resage  =  $db->select($info);
?>
<select  name="age_id" id="age_id"   class="textbox">
	<option value="">--Select--</option>
	<?php
	   foreach($resage as $key=>$each)
	   { 
	?>
	  <option value="<?=$resage[$key]['id']?>" <?php if($resage[$key]['id']==$age_id){ echo "selected"; }?>><?=$resage[$key]['age_name']?></option>
	<?php
	 }
	?> 
</select></td>
					  </tr><tr>
							 <td>Timezone</td>
							 <td><?php
	$info['table']    = "timezone";
	$info['fields']   = array("*");   	   
	$info['where']    =  "1=1 ORDER BY id DESC";
	$restimezone  =  $db->select($info);
?>
<select  name="timezone_id" id="timezone_id"   class="textbox">
	<option value="">--Select--</option>
	<?php
	   foreach($restimezone as $key=>$each)
	   { 
	?>
	  <option value="<?=$restimezone[$key]['id']?>" <?php if($restimezone[$key]['id']==$timezone_id){ echo "selected"; }?>><?=$restimezone[$key]['zone_name']?></option>
	<?php
	 }
	?> 
</select></td>
					  </tr><tr>
						 <td>Ticket Name</td>
						 <td>
						    <input type="text" name="ticket_name" id="ticket_name"  value="<?=$ticket_name?>" class="textbox">
						 </td>
				     </tr><tr>
						 <td>Venue Name</td>
						 <td>
						    <input type="text" name="venue_name" id="venue_name"  value="<?=$venue_name?>" class="textbox">
						 </td>
				     </tr><tr>
						 <td>Venue Post Code</td>
						 <td>
						    <input type="text" name="venue_post_code" id="venue_post_code"  value="<?=$venue_post_code?>" class="textbox">
						 </td>
				     </tr><tr>
						 <td>Start Date</td>
						 <td>
						    <input type="text" name="start_date" id="start_date"  value="<?=$start_date?>" class="textbox">
							<a href="javascript:void(0);" onclick="displayDatePicker('start_date');"><img src="../../images/calendar.gif" width="16" height="16" border="0" /></a>
						 </td>
				     </tr><tr>
						 <td>Start Time Hr</td>
						 <td>
						    <input type="text" name="start_time_hr" id="start_time_hr"  value="<?=$start_time_hr?>" class="textbox">
						 </td>
				     </tr><tr>
						 <td>Start Time Min</td>
						 <td>
						    <input type="text" name="start_time_min" id="start_time_min"  value="<?=$start_time_min?>" class="textbox">
						 </td>
				     </tr><tr>
		           		 <td>Start Am Pm</td>
				   		 <td><?php
	$enumevents = getEnumFieldValues('events','start_am_pm');
?>
<select  name="start_am_pm" id="start_am_pm"   class="textbox">
<?php
   foreach($enumevents as $key=>$value)
   { 
?>
  <option value="<?=$value?>" <?php if($value==$start_am_pm){ echo "selected"; }?>><?=$value?></option>
 <?php
  }
?> 
</select></td>
				  </tr><tr>
						 <td>End Date</td>
						 <td>
						    <input type="text" name="end_date" id="end_date"  value="<?=$end_date?>" class="textbox">
							<a href="javascript:void(0);" onclick="displayDatePicker('end_date');"><img src="../../images/calendar.gif" width="16" height="16" border="0" /></a>
						 </td>
				     </tr><tr>
						 <td>End Time Hr</td>
						 <td>
						    <input type="text" name="end_time_hr" id="end_time_hr"  value="<?=$end_time_hr?>" class="textbox">
						 </td>
				     </tr><tr>
						 <td>End Time Min</td>
						 <td>
						    <input type="text" name="end_time_min" id="end_time_min"  value="<?=$end_time_min?>" class="textbox">
						 </td>
				     </tr><tr>
		           		 <td>End Am Pm</td>
				   		 <td><?php
	$enumevents = getEnumFieldValues('events','end_am_pm');
?>
<select  name="end_am_pm" id="end_am_pm"   class="textbox">
<?php
   foreach($enumevents as $key=>$value)
   { 
?>
  <option value="<?=$value?>" <?php if($value==$end_am_pm){ echo "selected"; }?>><?=$value?></option>
 <?php
  }
?> 
</select></td>
				  </tr>
                  <tr>
						 <td>Price</td>
						 <td>
						    <input type="text" name="price" id="price"  value="<?=$price?>" class="textbox">
						 </td>
				     </tr><tr>
						 <td>Starting Ticket No</td>
						 <td>
						    <input type="text" name="starting_ticket_no" id="starting_ticket_no"  value="<?=$starting_ticket_no?>" class="textbox">
						 </td>
				     </tr><tr>
						 <td>In Stock</td>
						 <td>
						    <input type="text" name="in_stock" id="in_stock"  value="<?=$in_stock?>" class="textbox">
						 </td>
				     </tr><tr>
		           		 <td>Is Security Code</td>
				   		 <td><?php
	$enumevents = getEnumFieldValues('events','is_security_code');
?>
<select  name="is_security_code" id="is_security_code"   class="textbox">
<?php
   foreach($enumevents as $key=>$value)
   { 
?>
  <option value="<?=$value?>" <?php if($value==$is_security_code){ echo "selected"; }?>><?=$value?></option>
 <?php
  }
?> 
</select></td>
				  </tr><tr>
						 <td>Security Code</td>
						 <td>
						    <input type="text" name="security_code" id="security_code"  value="<?=$security_code?>" class="textbox">
						 </td>
				     </tr><tr>
						 <td>File Ticket</td>
						 <td><input type="file" name="file_ticket" id="file_ticket"  value="<?=$file_ticket?>" class="textbox">
						 </td>
				     </tr><tr>
						 <td valign="top">Description</td>
						 <td>
						    <textarea name="description" id="description"  class="textbox" style="width:200px;height:100px;"><?=$description?></textarea>
						 </td>
				     </tr><tr>
						 <td>File Thumb1</td>
						 <td><input type="file" name="file_thumb1" id="file_thumb1"  value="<?=$file_thumb1?>" class="textbox">
						 </td>
				     </tr><tr>
						 <td>File Thumb2</td>
						 <td><input type="file" name="file_thumb2" id="file_thumb2"  value="<?=$file_thumb2?>" class="textbox">
						 </td>
				     </tr><tr>
						 <td>File Thumb3</td>
						 <td><input type="file" name="file_thumb3" id="file_thumb3"  value="<?=$file_thumb3?>" class="textbox">
						 </td>
				     </tr>
                     <tr>
						 <td>Background Color</td>
						 <td>
						    <input type="text" name="background_color" id="background_color"  value="<?=$background_color?>" class="textbox">
						 </td>
				     </tr>
                     <tr>
						 <td>File Backgroundimage</td>
						 <td><input type="file" name="file_backgroundimage" id="file_backgroundimage"  value="<?=$file_backgroundimage?>" class="textbox">
						 </td>
				     </tr>
                     <tr>
		           		 <td>Is Approved</td>
				   		 <td><?php
							$enumevents = getEnumFieldValues('events','is_approved');
						?>
						<select  name="is_approved" id="is_approved"   class="textbox">
						<?php
						   foreach($enumevents as $key=>$value)
						   { 
						?>
						  <option value="<?=$value?>" <?php if($value==$is_approved){ echo "selected"; }?>><?=$value?></option>
						 <?php
						  }
						?> 
						</select>
                    </td>
				  </tr>
        		  <tr>
                                <td>Status</td>
                                <td>
                                    <?php
										$enumadminusers = getEnumFieldValues('adminusers','status');
									?>
									<select  name="status" id="status"   class="textbox">
									<?php
									   foreach($enumadminusers as $key=>$value)
									   { 
									?>
									  <option value="<?=$value?>" <?php if($value==$status){ echo "selected"; }?>><?=$value?></option>
									 <?php
									  }
									?> 
									</select>
                                </td>
                            </tr>                
		      <tr> 
                 <td align="right"></td>
                 <td>
                    <input type="hidden" name="cmd" value="add">
                    <input type="hidden" name="id" value="<?=$Id?>">			
                    <input type="submit" name="btn_submit" id="btn_submit" value="submit" class="button_blue">
                 </td>     
		    </tr>
		</table>
	</form>
  </td>
 </tr>
</table>
<?php
 include("../template/footer.php");
?>

