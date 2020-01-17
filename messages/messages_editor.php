<?php
   include("../template/header.php");
?>
<div class="page-section marg-top66 width-full">
  <div class="row">
    <div class="col-md-10 col-lg-8 col-md-offset-1 col-lg-offset-2">

      <h4 class="page-section-heading messaget">Messages</h4>
      <div class="panel panel-default">
<table class="table v-middle">
 <tr>
  <td>  
     <a href="messages.php?cmd=list" class="btn btn-primary">List</a>
	 <form name="frm_messages" method="post"  enctype="multipart/form-data" onSubmit="return checkRequired();">			
		<table class="table v-middle">
                      <tr>
							 <td>To Users</td>
							 <td><?php
									$info['table']    = "users";
									$info['fields']   = array("*");   	   
									$info['where']    =  "1=1 ORDER BY id DESC";
									$resusers  =  $db->select($info);
								?>
								<select  name="to_users_id" id="to_users_id"   class="textbox btselect">
									<option value="">--Select--</option>
									<?php
									   foreach($resusers as $key=>$each)
									   { 
									?>
									  <option value="<?=$resusers[$key]['id']?>" <?php if($resusers[$key]['id']==$to_users_id){ echo "selected"; }?>><?=$resusers[$key]['first_name']?> <?=$resusers[$key]['last_name']?></option>
									<?php
									 }
									?> 
								</select>
                            </td>
					  </tr>
                      <tr>
						 <td>Subject</td>
						 <td>
						    <input type="text" name="subject" id="subject"  value="<?=$subject?>" class="form-control" style="width:400px;">
						 </td>
				     </tr>
                     <tr>
						 <td valign="top">Message</td>
						 <td>
						    <textarea name="message" id="message"  class="form-control" style="width:400px;height:200px;"><?=$message?></textarea>
						 </td>
				     </tr>
                     <tr> 
                         <td align="right"></td>
                         <td>
                            <input type="hidden" name="cmd" value="add">
                            <input type="hidden" name="id" value="<?=$Id?>">			
                            <input type="submit" name="btn_submit" id="btn_submit" value="Submit" class="btn msgsubmit">
                         </td>     
                     </tr>
		</table>
	</form>
  </td>
 </tr>
</table>
</div>
</div>
</div>
</div>
</div>

<?php
   include("../template/footer.php");
?>                      
