<?php
   include("../template/login_header.php");
?>
            
          
				<script src="../js/jquery.min.js"></script>
                <script src="../js/jquery.inputmask.bundle.js"></script>
                <script language="javascript">
                    $(window).load(function()
                    {
                       var phones = [{ "mask": "(###) ###-####"}, { "mask": "(###) ###-####"}];
                        $('#phone').inputmask({ 
                            mask: phones, 
                            greedy: false, 
                            definitions: { '#': { validator: "[0-9]", cardinality: 1}} });
                            
                        var zip = [{ "mask": "A9A9A9"}, { "mask": "A9A9A9"}];
                        $('#zip').inputmask({ 
                            mask: zip, 
                            greedy: false, 
                            definitions: { '#': { validator: "[0-9]", cardinality: 1}} });	
                            
                    });
                </script>
                
                   <script language="javascript">
                      function checkRequired()
                      {
                        email        =  document.getElementById("email").value;
                        if(email=="")
                        {
                           alert("Please enter valid E-mail address");
                           return false;
                          
                        }
                        
                        password        =  document.getElementById("password").value;
                        if(password=="")
                        {
                            alert("Please enter Password");
                           return false;
                          
                        }
                        
                        first_name   =  document.getElementById("first_name").value;
                        if(first_name=="")
                        {
                           alert("Please enter First Name");
                           return false;
                           
                        }
                        
                        last_name    =  document.getElementById("last_name").value;
                        if(last_name=="")
                        {
                            alert("Please enter Last Name");
                           return false;
                          
                        }
                        
                        phone        =  document.getElementById("phone").value;
                        if(phone=="")
                        {
                            alert("Please enter Phone");
                           return false;
                          
                        }
                        
                        address      =  document.getElementById("address").value;
                        if(address=="")
                        {
                           alert("Please enter Address");
                           return false;
                           
                        }
                        
                        city         =  document.getElementById("city").value;
                        if(city=="")
                        {
                            alert("Please enter City");
                           return false;
                          
                        }
                        
                        state        =  document.getElementById("state").value;
                        if(state=="")
                        {
                            alert("Please enter Provience");
                           return false;
                          
                        }
                        
                        zip         =  document.getElementById("zip").value;
                        if(zip=="")
                        {
                            alert("Please enter Postal Code");
                           return false;
                          
                        }
                        
                        country_id  =  document.getElementById("country_id").value;
                        if(country_id=="")
                        {
                           alert("Please enter Country");
                           return false;
                           
                        }
                        
                        
                      
                      
                        is_true = false; 
                        password         =  document.getElementById("password").value;
                        
                        is_upper = false;
                        is_upper = hasUpperCase(password);
                        
                        if(is_upper==true)
                        {
                          is_true = true;
                        }
                        else
                        { 
                            is_true = false;
                            alert("Password must have an UpperCase Character(A-Z)");
                        }
                        
                        is_lower = false;
                        is_lower = hasLowerCase(password);
                        
                        if(is_lower==true)
                        {
                          is_true = true;
                        }
                        else
                        { 
                            is_true = false;
                            alert("Password must have a LowerCase Character(a-z) ");
                        }
                    
                        
                        is_number = false;
                        is_number = hasNumber(password);
                        
                        if(is_number==true)
                        {
                          is_true = true;
                        }
                        else
                        { 
                            is_true = false;
                            alert("Password must have a Number Character(0-9) ");
                        }
                        
                        is_special = false;
                        is_special = hasSpecial(password);
                        if(is_special==true)
                        {
                          is_true = true;
                        }
                        else
                        { 
                            is_true = false;
                            alert("Password must have a Special Character(-!$%^&*()_+|~=\\#{}\[\]:;'<>?,.\/)");
                        }
                         
                        if( is_upper==false || is_lower==false || is_number==false || is_special==false)
                        {
                           is_true = false;
                           return false;
                        }
                         
                         
                        if(is_true == true)
                        {
                           return true;
                        }
              
                         
                         return false;
                      }
                      
                      function hasUpperCase(str) {
                        return (/[A-Z]/.test(str));
                      }
                      function hasNumber(str) {
                        return (/[0-9]/.test(str));
                      }
                      function hasLowerCase(str) {
                        return (/[a-z]/.test(str));
                      }
                      function hasSpecial(str) {
                        return (/[-!$%^&*()_+|~=`\\#{}\[\]:";'<>?,.\/]/.test(str));
                      }
                 </script>
                
                
               
                              
                              <style>
							   .text-center {
										text-align: left !important;
									}
							  </style>
                              
                          <div class="content">

                            <h1>Registration</h1>
                             <code><font color="#FF0000">* is a required</font></code><br />
                             <span align="center"><font color="#FF0000"><?=$message?></font></span>                           
                            <form class="register-form" name="frm_users" method="post"  style="display:block;"  enctype="multipart/form-data"  onSubmit="return checkRequired();">			
                                <h3>Sign Up</h3>
                                    <p class="hint">
                                         Enter your personal details below:
                                    </p>
                                    <div class="form-group">
                                        <label class="control-label visible-ie8 visible-ie9">Username <font color="#FF0000">*</font></label>
                                        <input class="form-control placeholder-no-fix" type="text" name="username" id="username" placeholder="Username"  value="<?=$username?>" class="form-control placeholder-no-fix" required>
                                     </div>
                                     <div class="form-group">           
                                         <label class="control-label visible-ie8 visible-ie9">Password <font color="#FF0000">*</font></label>
                                               
                                                    <input type="password" name="password" id="password"  placeholder="Password"  pattern=".{9,15}"  title="9 to 15 characters long" value="<?=$password?>" class="form-control placeholder-no-fix" required><br />
                                                    <code><font color="#FF0000">Your password must contain atleast one  upper case, one lower case, one number and one of the special characters @, $, &, !, #)</font></code>
                                    </div>
                                     <div class="form-group">         
                                          <label class="control-label visible-ie8 visible-ie9">Title</label>
                                                    <select  name="title" id="title"   class="form-control placeholder-no-fix">
                                                      <option value="Mr." <?php if($title=='Mr.'){ echo "selected";}?>>Mr.</option>
                                                      <option value="Mrs." <?php if($title=='Mrs.'){ echo "selected";}?>>Mrs.</option>
                                                      <option value="Ms." <?php if($title=='Ms.'){ echo "selected";}?>>Ms.</option>
                                                      <option value="Dr."<?php if($title=='Dr.'){ echo "selected";}?>>Dr.</option>
                                                    </select>
                                    </div>
                                     <div class="form-group">           
                                          <label class="control-label visible-ie8 visible-ie9">First Name <font color="#FF0000">*</font></label>
                                                
                                                    <input type="text" name="first_name" id="first_name"  placeholder="First Name" value="<?=$first_name?>" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control placeholder-no-fix" required>
                                     </div>
                                     <div class="form-group">            
                                            <label class="control-label visible-ie8 visible-ie9">Last Name <font color="#FF0000">*</font></label>
                                                 
                                                    <input type="text" name="last_name" id="last_name" placeholder="Last Name"  value="<?=$last_name?>" onkeyup="javascript:this.value=this.value.toUpperCase();"  class="form-control placeholder-no-fix" required>
                                     </div>
                                      <div class="form-group">          
                                            <label class="control-label visible-ie8 visible-ie9">Email <font color="#FF0000">*</font></label>
                                                
                                                    <input type="email" name="email" id="email"  placeholder="Email" value="<?=$email?>" class="form-control placeholder-no-fix" required>
                                      </div>
                                       <div class="form-group">          
                                           <label class="control-label visible-ie8 visible-ie9">Phone <font color="#FF0000">*</font></label>
                                                 
                                                    <input type="text" name="phone_pre" id="phone_pre"  value="+1" readonly="readonly" style="width:30px;display:none;">
                                                    <input type="text" name="phone" id="phone" placeholder="Phone" value="<?=$phone?>" placeholder="" class="form-control placeholder-no-fix" required>
                                        </div>
                                        <div class="form-group">        
                                             <label class="control-label visible-ie8 visible-ie9">Company</label>
                                                
                                                    <input type="text" name="company" id="company" placeholder="Company" value="<?=$company?>" class="form-control placeholder-no-fix">
                                       </div>
                                        <div class="form-group">         
                                             <label class="control-label visible-ie8 visible-ie9">Address <font color="#FF0000">*</font></label>
                                                 
                                                    <input type="text" name="address" id="address" placeholder="Address" value="<?=$address?>" class="form-control placeholder-no-fix" required>
                                        </div>
                                        <div class="form-group">         
                                             <label class="control-label visible-ie8 visible-ie9">City <font color="#FF0000">*</font></label>
                                                 
                                                    <input type="text" name="city" id="city" placeholder="City"  value="<?=$city?>" class="form-control placeholder-no-fix" required>
                                        </div>
                                        <div class="form-group">         
                                            <label class="control-label visible-ie8 visible-ie9">Province <font color="#FF0000">*</font></label>
                                                
                                                    <input type="text" name="state" id="state" placeholder="State"  value="<?=$state?>" class="form-control placeholder-no-fix" required>
                                        </div>
                                        <div class="form-group">         
                                             <label class="control-label visible-ie8 visible-ie9">Postal Code <font color="#FF0000">*</font></label>
                                                 
                                                    <input type="text" name="zip" id="zip" placeholder="Zip" value="<?=$zip?>" class="form-control placeholder-no-fix" placeholder="A#A#A#"  required>
                                       </div>
                                        <div class="form-group">         
                                              <label class="control-label visible-ie8 visible-ie9">Country <font color="#FF0000">*</font></label>
                                                 <?php
                                                            $info['table']    = "country";
                                                            $info['fields']   = array("*");   	   
                                                            $info['where']    =  "1=1 ORDER BY country  ASC";
                                                            $rescountry  =  $db->select($info);
                                                        ?>
                                                        <select  name="country_id" id="country_id"   class="form-control" style="width:150px;" required>
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
                                         </div>
                                         <div class="form-group">             
                                            <input type="hidden" name="cmd" value="add">
                                            <input type="hidden" name="id" value="<?=$Id?>">			
                                            <input type="submit" name="btn_submit" id="btn_submit" value="submit"  class="btn btn-success uppercase">
                                         </div> 
                            </form>
                            
                       <a href="../login/index.php" class="forgot-password">Login</a>
              </div>         
             
<?php
   include("../template/login_footer.php");
?>           
         








