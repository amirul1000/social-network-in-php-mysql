<?php
   include("../template/header.php");
?>

  <div class="row">
    <div class="col-md-10 col-lg-8 col-md-offset-1 col-lg-offset-2">

      <h4 class="page-section-heading">My Profile</h4>
      <div class="panel panel-default">
        <!-- Progress table -->
       
            
                     <span style="color:#FF0000;"><?php
                       if(isset($message ))
                       {
                        echo $message; 
                       }
                     ?></span>
                     <div class="table-responsive">
                       <table class="table v-middle">
                        <tr>
                            <td>                          
                                <form name="frm_users" method="post" enctype="multipart/form-data"
                                    onSubmit="return checkRequired();">
                                    <table class="table v-middle">
                                        <tr>
                                            <td colspan="2" align="center" class="registration_title">Account
                                                Info</td>
                                        </tr>
                                        <tr>
                                        <tr>
                                            <td>Username<span>*</span>
                                            </td>
                                            <td><input type="text" name="username" id="username"
                                                value="<?=$username?>" class="textbox" readonly="readonly" required>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Old Password<span>*</span>
                                            </td>
                                            <td><input type="password" name="old_password" id="old_password"
                                                value="<?=$_REQUEST['old_password']?>" class="textbox" required>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>New Password<span>*</span>
                                            </td>
                                            <td><input type="password" name="password" id="password"
                                                value="<?=$_REQUEST['password']?>" class="textbox" required>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                            <input type="hidden" name="cmd" value="add"> 
                                            <input type="hidden" name="id" value="<?=$Id?>"> 
                                            <input type="submit" name="btn_submit" id="btn_submit" value="submit"  class="btn"> 
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

<?php
   include("../template/footer.php");
?>                      
                      
              