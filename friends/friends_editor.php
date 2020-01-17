<?php
   include("../template/header.php");
?>
<div class="page-section">
  <div class="row">
    <div class="col-md-10 col-lg-8 col-md-offset-1 col-lg-offset-2">

      <h4 class="page-section-heading">Friends</h4>
      <div class="panel panel-default">
        <!-- Progress table -->
        <div class="table-responsive">
            <table class="table v-middle">
             <tr>
              <td>  
                 <a href="friends.php?cmd=list" class="nav3">List</a>
                 <form name="frm_friends" method="post"  enctype="multipart/form-data" onSubmit="return checkRequired();">			
                         <table class="table v-middle">
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
                                                  <option value="<?=$resusers[$key]['id']?>" <?php if($resusers[$key]['id']==$users_id){ echo "selected"; }?>><?=$resusers[$key]['password']?></option>
                                                <?php
                                                 }
                                                ?> 
                                            </select>
                                            </td>
                                  </tr>
                                  <tr>
                                         <td>Friend Users</td>
                                         <td><?php
                                                $info['table']    = "users";
                                                $info['fields']   = array("*");   	   
                                                $info['where']    =  "1=1 ORDER BY id DESC";
                                                $resusers  =  $db->select($info);
                                            ?>
                                            <select  name="friend_users_id" id="friend_users_id"   class="textbox">
                                                <option value="">--Select--</option>
                                                <?php
                                                   foreach($resusers as $key=>$each)
                                                   { 
                                                ?>
                                                  <option value="<?=$resusers[$key]['id']?>" <?php if($resusers[$key]['id']==$friend_users_id){ echo "selected"; }?>><?=$resusers[$key]['password']?></option>
                                                <?php
                                                 }
                                                ?> 
                                            </select>
                                            </td>
                                  </tr>
                                  <tr>
                                     <td>Friend Status</td>
                                     <td><?php
                                            $enumfriends = getEnumFieldValues('friends','friend_status');
                                        ?>
                                        <select  name="friend_status" id="friend_status"   class="textbox">
                                        <?php
                                           foreach($enumfriends as $key=>$value)
                                           { 
                                        ?>
                                          <option value="<?=$value?>" <?php if($value==$friend_status){ echo "selected"; }?>><?=$value?></option>
                                         <?php
                                          }
                                        ?> 
                                        </select>
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
            
</div>
</div>
</div>
</div>
</div>

<?php
   include("../template/footer.php");
?>                      
