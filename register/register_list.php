        <?php 
		    include("../template/login_header.php");
		?>
		 <div class="content">
			<div class="container">
				<div class="row">

                    <div class="slide_section">
                    
                    
                          <div id="home-list"><br />
                        <h1>Profile</h1>
                        <a href="../change_password/index.php">Change Password</a> | <a href="index.php?cmd=edit&id=<?=$_SESSION['users_id']?>">Edit Profile</a>
                              <?php
                                   unset($info);
                                $info["table"]     = "users";
                                $info["fields"]   = array("*");
                                $info["where"]    = " 1=1 AND id='".$_SESSION['users_id']."'";
                                $res  = $db->select($info);
                                if(count($res)>0)
                                {
                                    $email    = $res[0]['email'];
                                    $password    = $res[0]['password'];
                                    $title    = $res[0]['title'];
                                    $first_name    = $res[0]['first_name'];
                                    $last_name    = $res[0]['last_name'];
									$phone       = $res[0]['phone'];
                                    $company    = $res[0]['company'];
                                    $address    = $res[0]['address'];
                                    $city    = $res[0]['city'];
                                    $state    = $res[0]['state'];
                                    $zip    = $res[0]['zip'];
                                    $country_id    = $res[0]['country_id'];
                                }		
                              ?>
                               <table cellspacing="3" cellpadding="3" border="0" align="center" class="bodytext" width="100%">  
                                       <tr>
                                             <td>Email</td>
                                             <td>
                                                <?=$email?>
                                             </td>
                                         </tr>                     
                                         <tr>
                                             <td>Title</td>
                                             <td>
                                                <?=$title?>
                                             </td>
                                         </tr>
                                         <tr>
                                             <td>First Name</td>
                                             <td>
                                                <?=$first_name?>
                                             </td>
                                         </tr>
                                         <tr>
                                             <td>Last Name</td>
                                             <td>
                                                <?=$last_name?>
                                             </td>
                                         </tr>
                                         <tr>
                                             <td>Phone</td>
                                             <td>
                                                <?=$phone?>
                                             </td>
                                         </tr>
                                         <tr>
                                             <td>Company</td>
                                             <td>
                                                <?=$company?>
                                             </td>
                                         </tr>
                                         <tr>
                                             <td>Address</td>
                                             <td>
                                               <?=$address?>
                                             </td>
                                         </tr>
                                         <tr>
                                             <td>City</td>
                                             <td>
                                                <?=$city?>
                                             </td>
                                         </tr>
                                         <tr>
                                             <td>State</td>
                                             <td>
                                                <?=$state?>
                                             </td>
                                         </tr>
                                         <tr>
                                             <td>Zip</td>
                                             <td>
                                                <?=$zip?>
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
                                                  
                                                        <?php
                                                           foreach($rescountry as $key=>$each)
                                                           { 
                                                        ?>
                                                           <?php if($rescountry[$key]['id']==$country_id){ ?><?=$rescountry[$key]['country']?><? }?>
                                                        <?php
                                                           }
                                                        ?> 
                                                    
                                                   </td>
                                          </tr>
                                      </table>
                     <span class="stretch"></span>
                          </div>
                    
                    </div>
                    <div class="clear"></div>


              </div>
			</div>
		</div>
        <?php 
		   include("../template/login_footer.php");
		?>                    