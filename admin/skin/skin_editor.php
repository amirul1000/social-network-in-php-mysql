<?php
 include("../template/header.php");
?>
<script language="javascript" src="skin.js"></script>
<script type="text/javascript" src="../../js/jquery.js"></script>
<script	src="../../js/main.js" type="text/javascript"></script>
<link rel="stylesheet" href="../../css/datepicker.css">
<b><?=ucwords(str_replace("_"," ","skin"))?></b><br />
<table cellspacing="3" cellpadding="3" border="0" align="center" width="98%" class="bdr">
 <tr>
  <td>  
     <a href="skin.php?cmd=list" class="nav3">List</a>
	 <form name="frm_skin" method="post"  enctype="multipart/form-data" onSubmit="return checkRequired();">			
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
							</select>
                            </td>
					  </tr>
                      <tr>
						 <td>Background Image</td>
						 <td>
						    <input type="text" name="background_image" id="background_image"  value="<?=$background_image?>" class="textbox">
						 </td>
				     </tr><tr>
		           		 <td>Status</td>
				   		 <td><?php
	$enumskin = getEnumFieldValues('skin','status');
?>
<select  name="status" id="status"   class="textbox">
<?php
   foreach($enumskin as $key=>$value)
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

