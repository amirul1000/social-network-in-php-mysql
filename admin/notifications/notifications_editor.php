<?php
 include("../template/header.php");
?>
<script language="javascript" src="notifications.js"></script>
<script type="text/javascript" src="../../js/jquery.js"></script>
<script	src="../../js/main.js" type="text/javascript"></script>
<link rel="stylesheet" href="../../css/datepicker.css">
<b><?=ucwords(str_replace("_"," ","notifications"))?></b><br />
<table cellspacing="3" cellpadding="3" border="0" align="center" width="98%" class="bdr">
 <tr>
  <td>  
     <a href="notifications.php?cmd=list" class="nav3">List</a>
	 <form name="frm_notifications" method="post"  enctype="multipart/form-data" onSubmit="return checkRequired();">			
		<table cellspacing="3" cellpadding="3" border="0" align="center" class="bodytext" width="100%">  
		  <tr>
							 <td>From Users</td>
							 <td><?php
	$info['table']    = "users";
	$info['fields']   = array("*");   	   
	$info['where']    =  "1=1 ORDER BY id DESC";
	$resusers  =  $db->select($info);
?>
<select  name="from_users_id" id="from_users_id"   class="textbox">
	<option value="">--Select--</option>
	<?php
	   foreach($resusers as $key=>$each)
	   { 
	?>
	  <option value="<?=$resusers[$key]['id']?>" <?php if($resusers[$key]['id']==$from_users_id){ echo "selected"; }?>><?=$resusers[$key]['password']?></option>
	<?php
	 }
	?> 
</select></td>
					  </tr><tr>
							 <td>To Users</td>
							 <td><?php
	$info['table']    = "users";
	$info['fields']   = array("*");   	   
	$info['where']    =  "1=1 ORDER BY id DESC";
	$resusers  =  $db->select($info);
?>
<select  name="to_users_id" id="to_users_id"   class="textbox">
	<option value="">--Select--</option>
	<?php
	   foreach($resusers as $key=>$each)
	   { 
	?>
	  <option value="<?=$resusers[$key]['id']?>" <?php if($resusers[$key]['id']==$to_users_id){ echo "selected"; }?>><?=$resusers[$key]['password']?></option>
	<?php
	 }
	?> 
</select></td>
					  </tr><tr>
						 <td valign="top">Message</td>
						 <td>
						    <textarea name="message" id="message"  class="textbox" style="width:200px;height:100px;"><?=$message?></textarea>
						 </td>
				     </tr><tr>
		           		 <td>Read Status</td>
				   		 <td><?php
	$enumnotifications = getEnumFieldValues('notifications','read_status');
?>
<select  name="read_status" id="read_status"   class="textbox">
<?php
   foreach($enumnotifications as $key=>$value)
   { 
?>
  <option value="<?=$value?>" <?php if($value==$read_status){ echo "selected"; }?>><?=$value?></option>
 <?php
  }
?> 
</select></td>
				  </tr><tr>
						 <td>Date Created</td>
						 <td>
						    <input type="text" name="date_created" id="date_created"  value="<?=$date_created?>" class="textbox">
							<a href="javascript:void(0);" onclick="displayDatePicker('date_created');"><img src="../../images/calendar.gif" width="16" height="16" border="0" /></a>
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

