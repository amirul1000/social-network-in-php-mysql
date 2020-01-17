<?php
 include("../template/header.php");
?>
<script language="javascript" src="adminusers.js"></script>
<script type="text/javascript" src="../../js/jquery.js"></script>
<script	src="../../js/main.js" type="text/javascript"></script>
<link rel="stylesheet" href="../../css/datepicker.css">
<b><?=ucwords(str_replace("_"," ","adminusers"))?></b><br />
<table cellspacing="3" cellpadding="3" border="0" align="center" width="98%" class="bdr">
 <tr>
  <td>  
     <a href="adminusers.php?cmd=list" class="nav3">List</a>
	 <form name="frm_adminusers" method="post"  enctype="multipart/form-data" onSubmit="return checkRequired();">			
		<table cellspacing="3" cellpadding="3" border="0" align="center" class="bodytext" width="100%">  
		 <tr>
						 <td>Email</td>
						 <td>
						    <input type="text" name="email" id="email"  value="<?=$email?>" class="textbox">
						 </td>
				     </tr><tr>
						 <td>Password</td>
						 <td>
						    <input type="text" name="password" id="password"  value="<?=$password?>" class="textbox">
						 </td>
				     </tr><tr>
						 <td>Title</td>
						 <td>
						    <input type="text" name="title" id="title"  value="<?=$title?>" class="textbox">
						 </td>
				     </tr><tr>
						 <td>First Name</td>
						 <td>
						    <input type="text" name="first_name" id="first_name"  value="<?=$first_name?>" class="textbox">
						 </td>
				     </tr><tr>
						 <td>Last Name</td>
						 <td>
						    <input type="text" name="last_name" id="last_name"  value="<?=$last_name?>" class="textbox">
						 </td>
				     </tr><tr>
						 <td>Company</td>
						 <td>
						    <input type="text" name="company" id="company"  value="<?=$company?>" class="textbox">
						 </td>
				     </tr><tr>
						 <td>Address</td>
						 <td>
						    <input type="text" name="address" id="address"  value="<?=$address?>" class="textbox">
						 </td>
				     </tr><tr>
						 <td>City</td>
						 <td>
						    <input type="text" name="city" id="city"  value="<?=$city?>" class="textbox">
						 </td>
				     </tr><tr>
						 <td>State</td>
						 <td>
						    <input type="text" name="state" id="state"  value="<?=$state?>" class="textbox">
						 </td>
				     </tr><tr>
						 <td>Zip</td>
						 <td>
						    <input type="text" name="zip" id="zip"  value="<?=$zip?>" class="textbox">
						 </td>
				     </tr><tr>
							 <td>Country</td>
							 <td><?php
	$info['table']    = "country";
	$info['fields']   = array("*");   	   
	$info['where']    =  "1=1 ORDER BY id DESC";
	$rescountry  =  $db->select($info);
?>
<select  name="country_id" id="country_id"   class="textbox">
	<option value="">--Select--</option>
	<?php
	   foreach($rescountry as $key=>$each)
	   { 
	?>
	  <option value="<?=$rescountry[$key]['id']?>" <?php if($rescountry[$key]['id']==$country_id){ echo "selected"; }?>><?=$rescountry[$key]['country']?></option>
	<?php
	 }
	?> 
</select></td>
					  </tr><tr>
						 <td>Created At</td>
						 <td>
						    <input type="text" name="created_at" id="created_at"  value="<?=$created_at?>" class="textbox">
							<a href="javascript:void(0);" onclick="displayDatePicker('created_at');"><img src="../../images/calendar.gif" width="16" height="16" border="0" /></a>
						 </td>
				     </tr><tr>
						 <td>Updated At</td>
						 <td>
						    <input type="text" name="updated_at" id="updated_at"  value="<?=$updated_at?>" class="textbox">
							<a href="javascript:void(0);" onclick="displayDatePicker('updated_at');"><img src="../../images/calendar.gif" width="16" height="16" border="0" /></a>
						 </td>
				     </tr><tr>
		           		 <td>Type</td>
				   		 <td><?php
	$enumadminusers = getEnumFieldValues('adminusers','type');
?>
<select  name="type" id="type"   class="textbox">
<?php
   foreach($enumadminusers as $key=>$value)
   { 
?>
  <option value="<?=$value?>" <?php if($value==$type){ echo "selected"; }?>><?=$value?></option>
 <?php
  }
?> 
</select></td>
				  </tr><tr>
		           		 <td>Status</td>
				   		 <td><?php
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

