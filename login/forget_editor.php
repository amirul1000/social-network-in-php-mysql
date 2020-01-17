<?php
   include("../template/login_header.php");
?>
<div class="content">     
          <!-- BEGIN FORGOT PASSWORD FORM -->
            <form class="forget-form" action="" method="post" style="display:block;">
                <span align="center"><font color="#FF0000"><?=$message?></font></span>
                <h3>Forget Password ?</h3>
                <p>
                     Enter your e-mail address below to reset your password.
                </p>
                <div class="form-group">
                    <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email"/>
                </div>
                <div class="form-actions">
                    <input type="hidden" name="cmd" value="forget_pass"/>
                    <a href="index.php" class="btn btn-default">Back</a>
                    <button type="submit" class="btn btn-success uppercase pull-right">Submit</button>
                </div>
            </form>
            <!-- END FORGOT PASSWORD FORM -->
</div>             
<?php
   include("../template/login_footer.php");
?>           
         