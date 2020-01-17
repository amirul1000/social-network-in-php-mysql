<link rel="stylesheet" href="../datepicker/jquery-ui.css">
<script src="../datepicker/jquery-1.10.2.js"></script>
<script src="../datepicker/jquery-ui.js"></script>

<div class="page-section">
  <div class="row">
    <div class="col-md-10 col-lg-8 col-md-offset-1 col-lg-offset-2">

      <h4 class="page-section-heading">My Profile</h4>
      <div class="panel panel-default">
        <!-- Progress table -->
        <div class="table-responsive">
            <table class="table v-middle">
             <tr>
              <td>  
                 <a href="index.php?cmd=list" class="btn btn-primary">List</a>
                 <form name="frm_users" method="post"  enctype="multipart/form-data" onSubmit="return checkRequired();">			
                      <table class="table v-middle">		           
                            <tr>
                                 <td>Title</td>
                                 <td>
                                    <input type="text" name="title" id="title"  value="<?=$title?>" class="textbox">
                                 </td>
                            </tr>
                            <tr>
                                 <td>First Name</td>
                                 <td>
                                    <input type="text" name="first_name" id="first_name"  value="<?=$first_name?>" class="textbox">
                                 </td>
                            </tr>
                            <tr>
                                 <td>Last Name</td>
                                 <td>
                                    <input type="text" name="last_name" id="last_name"  value="<?=$last_name?>" class="textbox">
                                 </td>
                            </tr> 
                            <tr>
                                <td>Date Of Birth</td>
                                <td>
                                <input type="text" name="date_of_birth" id="date_of_birth"  value="<?=$date_of_birth?>" class="datepicker">
                                </td>
                            </tr>
                            <tr>
                                <td>Gender</td>
                                <td><?php
                                $enumusers = getEnumFieldValues('users','gender');
                                ?>
                                <select  name="gender" id="gender"   class="textbox">
                                <?php
                                foreach($enumusers as $key=>$value)
                                { 
                                ?>
                                <option value="<?=$value?>" <?php if($value==$gender){ echo "selected"; }?>><?=$value?></option>
                                <?php
                                }
                                ?> 
                                </select></td>
                            </tr>
                            <tr>
                                <td valign="top">Lives In</td>
                                <td>
                                <textarea name="lives_in" id="lives_in"  class="textbox" style="width:200px;height:100px;"><?=$lives_in?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td valign="top">Website</td>
                                <td>
                                <input type="text" name="website" id="website"  value="<?=$website?>" class="textbox">
                                </td>
                            </tr>
                            <tr>
                                <td valign="top">About Me</td>
                                <td>
                                <textarea name="about_me" id="about_me"  class="textbox" style="width:200px;height:100px;"><?=$about_me?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td valign="top">Hobby</td>
                                <td>
                                <textarea name="hobby" id="hobby"  class="textbox" style="width:200px;height:100px;"><?=$hobby?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td valign="top">Occupation</td>
                                <td>
                                <textarea name="occupation" id="occupation"  class="textbox" style="width:200px;height:100px;"><?=$occupation?></textarea>
                                </td>
                            </tr> 
                            <tr>
                                <td valign="top">Works at</td>
                                <td>
                                <textarea name="works_at" id="works_at"  class="textbox" style="width:200px;height:100px;"><?=$works_at?></textarea>
                                </td>
                            </tr> 
                            <tr>
                                <td>Phone</td>
                                <td>
                                <input type="text" name="phone" id="phone"  value="<?=$phone?>" class="textbox">
                                </td>
                            </tr>
                            <tr>
                                <td>Company</td>
                                <td>
                                <input type="text" name="company" id="company"  value="<?=$company?>" class="textbox">
                                </td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td>
                                <input type="text" name="address" id="address"  value="<?=$address?>" class="textbox">
                                </td>
                            </tr>
                            <tr>
                                <td>City</td>
                                <td>
                                <input type="text" name="city" id="city"  value="<?=$city?>" class="textbox">
                                </td>
                            </tr>
                            <tr>
                                <td>State</td>
                                <td>
                                <input type="text" name="state" id="state"  value="<?=$state?>" class="textbox">
                                </td>
                            </tr>
                            <tr>
                                <td>Zip</td>
                                <td>
                                <input type="text" name="zip" id="zip"  value="<?=$zip?>" class="textbox">
                                </td>
                            </tr>
                            <tr>
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
                                </select>
                                </td>
                            </tr>
                            <tr>
                                <td>File Picture</td>
                                <td><input type="file" name="file_picture" id="file_picture"  value="<?=$file_picture?>" class="textbox">
                                </td>
                            </tr>
                            <tr>
                                <td>File Cover</td>
                                <td><input type="file" name="file_cover" id="file_cover"  value="<?=$file_cover?>" class="textbox">
                                </td>
                            </tr>
                            <tr> 
                                <td align="right"></td>
                                <td>
                                <input type="hidden" name="cmd" value="add">
                                <input type="hidden" name="id" value="<?=$Id?>">			
                                <input type="submit" name="btn_submit" id="btn_submit" value="submit" class="btn">
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
