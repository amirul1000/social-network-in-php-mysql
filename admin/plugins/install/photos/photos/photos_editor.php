<link rel="stylesheet" href="../datepicker/jquery-ui.css">
<script src="../datepicker/jquery-1.10.2.js"></script>
<script src="../datepicker/jquery-ui.js"></script>

<b><?=ucwords(str_replace("_"," ","photos"))?></b><br />
<table cellspacing="3" cellpadding="3" border="0" align="center" width="98%" class="bdr">
 <tr>
  <td>  
     <a href="photos.php?cmd=list" class="nav3">List</a>
	 <form name="frm_photos" method="post"  enctype="multipart/form-data" onSubmit="return checkRequired();">			
		<table cellspacing="3" cellpadding="3" border="0" align="center" class="bodytext" width="100%">  
            <tr>
                 <td>Photo Name</td>
                 <td>
                    <input type="text" name="photo_name" id="photo_name"  value="<?=$photo_name?>" class="textbox">
                 </td>
             </tr>
             <tr>
                 <td>File Photo</td>
                 <td><input type="file" name="file_photo" id="file_photo"  value="<?=$file_photo?>" class="textbox">
                 </td>
             </tr>
             <tr>
                 <td>Date Created</td>
                 <td>
                    <input type="text" name="date_created" id="date_created"  value="<?=$date_created?>" class="datepicker">
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
<script>
		$( ".datepicker" ).datepicker({
			dateFormat: "yy-mm-dd", 
			changeYear: true,
			changeMonth: true,
			showOn: 'button',
			buttonText: 'Show Date',
			buttonImageOnly: true,
			buttonImage: '../images/calendar.gif',
		});
</script>
