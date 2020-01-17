<?php
 include("../template/header.php");
?>
<script language="javascript" src="contents.js"></script>
<script type="text/javascript" src="../../js/jquery.js"></script>
<script	src="../../js/main.js" type="text/javascript"></script>
<link rel="stylesheet" href="../../css/datepicker.css">
<b><?=ucwords(str_replace("_"," ","contents"))?></b><br />
<table cellspacing="3" cellpadding="3" border="0" align="center" width="98%" class="bdr">
 <tr>
  <td>  
     <a href="contents.php?cmd=list" class="nav3">List</a>
	 <form name="frm_contents" method="post"  enctype="multipart/form-data" onSubmit="return checkRequired();">			
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
		           		 <td>Content Type</td>
				   		 <td><?php
	$enumcontents = getEnumFieldValues('contents','content_type');
?>
<select  name="content_type" id="content_type"   class="textbox">
<?php
   foreach($enumcontents as $key=>$value)
   { 
?>
  <option value="<?=$value?>" <?php if($value==$content_type){ echo "selected"; }?>><?=$value?></option>
 <?php
  }
?> 
</select></td>
				  </tr><tr>
						 <td valign="top">Content</td>
						 <td>
						    <textarea name="content" id="content"  class="textbox" style="width:200px;height:100px;"><?=$content?></textarea>
						 </td>
				     </tr><tr>
						 <td>Date Created</td>
						 <td>
						    <input type="text" name="date_created" id="date_created"  value="<?=$date_created?>" class="textbox">
							<a href="javascript:void(0);" onclick="displayDatePicker('date_created');"><img src="../../images/calendar.gif" width="16" height="16" border="0" /></a>
						 </td>
				     </tr><tr>
						 <td>Date Updated</td>
						 <td>
						    <input type="text" name="date_updated" id="date_updated"  value="<?=$date_updated?>" class="textbox">
							<a href="javascript:void(0);" onclick="displayDatePicker('date_updated');"><img src="../../images/calendar.gif" width="16" height="16" border="0" /></a>
						 </td>
				     </tr><tr>
		           		 <td>Status</td>
				   		 <td><?php
	$enumcontents = getEnumFieldValues('contents','status');
?>
<select  name="status" id="status"   class="textbox">
<?php
   foreach($enumcontents as $key=>$value)
   { 
?>
  <option value="<?=$value?>" <?php if($value==$status){ echo "selected"; }?>><?=$value?></option>
 <?php
  }
?> 
</select></td>
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

