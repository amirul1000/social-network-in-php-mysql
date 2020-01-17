<?php
 include("../template/header.php");
?>
<script language="javascript" src="plugins.js"></script>
<script type="text/javascript" src="../../js/jquery.js"></script>
<script	src="../../js/main.js" type="text/javascript"></script>
<link rel="stylesheet" href="../../css/datepicker.css">
<b><?=ucwords(str_replace("_"," ","plugins"))?></b><br />
<table cellspacing="3" cellpadding="3" border="0" align="center" width="98%" class="bdr">
 <tr>
  <td>  
     <a href="plugins.php?cmd=list" class="nav3">List</a>
	 <form name="frm_plugins" method="post"  enctype="multipart/form-data" onSubmit="return checkRequired();">			
		<table cellspacing="3" cellpadding="3" border="0" align="center" class="bodytext" width="100%">  
            <tr>
                 <td>Plugin Name</td>
                 <td>
                    <input type="text" name="plugin_name" id="plugin_name"  value="<?=$plugin_name?>" class="textbox">
                 </td>
             </tr>
             <tr>
                 <td valign="top">Plugin Description</td>
                 <td>
                    <textarea name="plugin_description" id="plugin_description"  class="textbox" style="width:200px;height:100px;"><?=$plugin_description?></textarea>
                 </td>
             </tr>
             <tr>
                 <td>Plugin Status</td>
                 <td><?php
                        $enumplugins = getEnumFieldValues('plugins','plugin_status');
                    ?>
                    <select  name="plugin_status" id="plugin_status"   class="textbox">
                    <?php
                       foreach($enumplugins as $key=>$value)
                       { 
                    ?>
                      <option value="<?=$value?>" <?php if($value==$plugin_status){ echo "selected"; }?>><?=$value?></option>
                     <?php
                      }
                    ?> 
                    </select>
                    </td>
            </tr>
            <tr>
                 <td>Uploaded Path</td>
                 <td>
                    <input type="text" name="uploaded_path" id="uploaded_path"  value="<?=$uploaded_path?>" class="textbox">
                 </td>
             </tr>
             <tr>
                 <td>Date Installed</td>
                 <td>
                    <input type="text" name="date_installed" id="date_installed"  value="<?=$date_installed?>" class="textbox">
                    <a href="javascript:void(0);" onclick="displayDatePicker('date_installed');"><img src="../../images/calendar.gif" width="16" height="16" border="0" /></a>
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

