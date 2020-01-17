<?php
 include("../template/header.php");
?>
<script language="javascript" src="likes.js"></script>
<script type="text/javascript" src="../../js/jquery.js"></script>
<script	src="../../js/main.js" type="text/javascript"></script>
<link rel="stylesheet" href="../../css/datepicker.css">
<b><?=ucwords(str_replace("_"," ","likes"))?></b><br />
<table cellspacing="3" cellpadding="3" border="0" align="center" width="98%" class="bdr">
 <tr>
  <td>  
     <a href="likes.php?cmd=list" class="nav3">List</a>
	 <form name="frm_likes" method="post"  enctype="multipart/form-data" onSubmit="return checkRequired();">			
		<table cellspacing="3" cellpadding="3" border="0" align="center" class="bodytext" width="100%">  
		 <tr>
							 <td>Owner Users</td>
							 <td><?php
	$info['table']    = "users";
	$info['fields']   = array("*");   	   
	$info['where']    =  "1=1 ORDER BY id DESC";
	$resusers  =  $db->select($info);
?>
<select  name="owner_users_id" id="owner_users_id"   class="textbox">
	<option value="">--Select--</option>
	<?php
	   foreach($resusers as $key=>$each)
	   { 
	?>
	  <option value="<?=$resusers[$key]['id']?>" <?php if($resusers[$key]['id']==$owner_users_id){ echo "selected"; }?>><?=$resusers[$key]['password']?></option>
	<?php
	 }
	?> 
</select></td>
					  </tr><tr>
							 <td>Likes Users</td>
							 <td><?php
	$info['table']    = "users";
	$info['fields']   = array("*");   	   
	$info['where']    =  "1=1 ORDER BY id DESC";
	$resusers  =  $db->select($info);
?>
<select  name="likes_users_id" id="likes_users_id"   class="textbox">
	<option value="">--Select--</option>
	<?php
	   foreach($resusers as $key=>$each)
	   { 
	?>
	  <option value="<?=$resusers[$key]['id']?>" <?php if($resusers[$key]['id']==$likes_users_id){ echo "selected"; }?>><?=$resusers[$key]['password']?></option>
	<?php
	 }
	?> 
</select></td>
					  </tr><tr>
							 <td>Contents</td>
							 <td><?php
	$info['table']    = "contents";
	$info['fields']   = array("*");   	   
	$info['where']    =  "1=1 ORDER BY id DESC";
	$rescontents  =  $db->select($info);
?>
<select  name="contents_id" id="contents_id"   class="textbox">
	<option value="">--Select--</option>
	<?php
	   foreach($rescontents as $key=>$each)
	   { 
	?>
	  <option value="<?=$rescontents[$key]['id']?>" <?php if($rescontents[$key]['id']==$contents_id){ echo "selected"; }?>><?=$rescontents[$key]['content_type']?></option>
	<?php
	 }
	?> 
</select></td>
					  </tr><tr>
						 <td>Like Count</td>
						 <td>
						    <input type="text" name="like_count" id="like_count"  value="<?=$like_count?>" class="textbox">
						 </td>
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

