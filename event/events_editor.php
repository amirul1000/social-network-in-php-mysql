<?php 
   include("../template/header.php");
?>
<div class="page-section">
  <div class="row">
    <div class="col-md-10 col-lg-8 col-md-offset-1 col-lg-offset-2">

      <h4 class="page-section-heading">Add your new event</h4>
      <div class="panel panel-default">
        <!-- Progress table -->
        <div class="table-responsive">
        
        
                <link rel="stylesheet" href="../datepicker/jquery-ui.css">
                <script src="../datepicker/jquery-1.10.2.js"></script>
                <script src="../datepicker/jquery-ui.js"></script>
                   <a href="index.php?cmd=list" class="btn btn-primary">List</a>
                   <table class="table v-middle">
                     <tr>
                      <td>  
                         <!--<a href="index.php?cmd=list" class="nav3">List</a>-->
                         <form name="frm_events" method="post"  enctype="multipart/form-data" onSubmit="return checkRequired();">			
                            <table class="table v-middle">
                            <tr>
                                <td colspan="2" align="left">
                                   <b>Event Name</b><br />
                                    <input type="text" name="ticket_name" id="ticket_name"  value="<?=$ticket_name?>" class="textbox" style="width:400px;">
                                </td>
                            
                            </tr>
                            <tr>
                                <td colspan="2" align="left">
                                   <b>Price</b><br />
                                    $<input type="text" name="price" id="price"  value="<?=$price?>" class="textbox" style="width:200px;">
                                </td>
                            
                            </tr>
                            <tr>
                                 <td valign="top">
                                      <fieldset>
                                        <legend>When?</legend>
                                        <table>
                                               <tr>
                                                  <td>
                                                   Start Date<br />
                                                    <input type="date" name="start_date" id="start_date"  value="<?=$start_date?>" class="datepicker" required>
                                                  </td>
                                               </tr>
                                               <tr>
                                                  <td nowrap="nowrap">
                                                  	Start Time<br />
                                                    
                                                    <select name="start_time_hr" id="start_time_hr"  value="<?=$start_time_hr?>" class="textbox" style="width:70px;" required>
                                                       <?php
													     for($i=1;$i<=12;$i++)
														 {
													   ?>
                                                         <option value="<?=$i?>" <?php if($i==$start_time_hr){ echo "selected"; } ?>><?=$i?></option>
                                                       <?php
													    }
													   ?>
                                                    </select>
                                                   
                                                    <select name="start_time_min" id="start_time_min"  value="<?=$start_time_min?>" class="textbox"   style="width:70px;" required>
                                                       <option value=""></option>
                                                       <?php
													     for($i=0;$i<=59;$i++)
														 {
													   ?>
                                                         <option value="<?=$i?>" <?php if($i==$start_time_min){ echo "selected"; } ?>><?=$i?></option>
                                                       <?php
													    }
													   ?>
                                                    </select>
                                                    
                                                    <?php
														$enumevents = getEnumFieldValues('events','start_am_pm');
													?>
													<select  name="start_am_pm" id="start_am_pm"   class="textbox"  style="width:70px;" required>
													<?php
													   foreach($enumevents as $key=>$value)
													   { 
													?>
													  <option value="<?=$value?>" <?php if($value==$start_am_pm){ echo "selected"; }?>><?=$value?></option>
													 <?php
													  }
													?> 
													</select>     
                                                    
                                                  </td>
                                               </tr>
                                                <tr>
                                                  <td>
                                                   End Date<br />
                                                    <input type="date" name="end_date" id="end_date"  value="<?=$end_date?>" class="datepicker" required>
                                                  </td>
                                               </tr>
                                               <tr>
                                                  <td>
                                                  	End Time<br />
                                                     <select name="end_time_hr" id="end_time_hr"  value="<?=$end_time_hr?>" class="textbox"  style="width:70px;" required>
                                                       <?php
													     for($i=1;$i<=12;$i++)
														 {
													   ?>
                                                         <option value="<?=$i?>" <?php if($i==$end_time_hr){ echo "selected"; } ?>><?=$i?></option>
                                                       <?php
													    }
													   ?>
                                                    </select>
                                                   
                                                    <select name="end_time_min" id="end_time_min"  value="<?=$end_time_min?>" class="textbox"   style="width:70px;" required>
                                                       <option value=""></option>
                                                       <?php
													     for($i=0;$i<=59;$i++)
														 {
													   ?>
                                                         <option value="<?=$i?>" <?php if($i==$end_time_min){ echo "selected"; } ?>><?=$i?></option>
                                                       <?php
													    }
													   ?>
                                                    </select>
                                                    
                                                    <?php
														$enumevents = getEnumFieldValues('events','end_am_pm');
													?>
													<select  name="end_am_pm" id="end_am_pm"   class="textbox"  style="width:70px;" required>
													<?php
													   foreach($enumevents as $key=>$value)
													   { 
													?>
													  <option value="<?=$value?>" <?php if($value==$end_am_pm){ echo "selected"; }?>><?=$value?></option>
													 <?php
													  }
													?> 
													</select>     
                                                    
                                                  </td>
                                               </tr>
                                                <tr>
                                                 <td>
                                                 Timezone<br />
                                                <?php
													$info['table']    = "timezone";
													$info['fields']   = array("*");   	   
													$info['where']    =  "1=1 ORDER BY id DESC";
													$restimezone  =  $db->select($info);
                                            	?>
                                            <select  name="timezone_id" id="timezone_id"   class="textbox">
                                                <?php
                                                   foreach($restimezone as $key=>$each)
                                                   { 
                                                ?>
                                                  <option value="<?=$restimezone[$key]['id']?>" <?php if($restimezone[$key]['id']==$timezone_id){ echo "selected"; }?>><?=$restimezone[$key]['zone_name']?></option>
                                                <?php
                                                 }
                                                ?> 
                                            </select>
                                            </td>
                                          </tr>
                                 
                                        </table>
                                      </fieldset>
                                        
                                 </td>
                                 
                                 <td valign="top">
                                       <fieldset>
                                        <legend>Where?</legend>
                                        <table>
                                               <tr>
                                                  <td>
                                                  Venue Name<br />
                                                   <input type="text" name="venue_name" id="venue_name"  value="<?=$venue_name?>" class="textbox" required>

                                                  </td>
                                               </tr>
                                               <tr>
                                                  <td>
                                                  Venue	City<br />
                                                     <input type="text" name="venue_city" id="venue_city"  value="<?=$venue_city?>" class="textbox" required>
                                                  </td>
                                               </tr>
                                               <tr>
                                                  <td>
                                                  	Venue Post Code<br />
                                                     <input type="text" name="venue_post_code" id="venue_post_code"  value="<?=$venue_post_code?>" class="textbox" required>
                                                  </td>
                                               </tr>
                                                <tr>
                                                  <td>
                                                   E-ticket Code<br />
                                                  <script language="javascript">
													 function set_security_code()
													 {
														if ( $("#is_security_code_1").is(":checked") == true )
														{
														  $("#div_security_code").show();
														}
														
														if ( $("#is_security_code_2").is(":checked")  == true )
														{
														  $("#div_security_code").hide();
														}
													 } 
												 </script>
												 
												  Yes <input type="radio"  name="is_security_code" id="is_security_code_1"  value="Yes" <?php if('Yes'==$is_security_code){ echo "checked"; }?>  class="textbox" onclick="set_security_code();">
												  No  <input type="radio"  name="is_security_code" id="is_security_code_2"  value="No" <?php if('No'==$is_security_code){ echo "checked"; }?>  class="textbox"  onclick="set_security_code();">
												  <br />
												  
												  <div name="div_security_code" id="div_security_code" style="display:<?php if('Yes'==$is_security_code){ echo "block"; } else { echo "none"; }?>">
													 Security Code
													 <?php
													   $rand = rand(11111,99999);
													   if(empty($security_code))
													   {
														  $security_code = $rand;
													   }
													 ?>
													<input type="text" name="security_code" id="security_code"  value="<?=$security_code?>" class="textbox" readonly="readonly">
												  </div>
                                                  </td>
                                               </tr>
                                               <tr>
                                                  <td>
                                                    How many tickets in stock?<br />
                                                     <input type="text" name="in_stock" id="in_stock"  value="<?=$in_stock?>" class="textbox">
                                                  </td>
                                               </tr>
                                        </table>
                                      </fieldset>
                                 </td>
                            
                            
                             </tr>
                             <tr>
                                  <td> Category<br />
                                                 <?php
                                                    $info['table']    = "category";
                                                    $info['fields']   = array("*");   	   
                                                    $info['where']    =  "1=1 ORDER BY id DESC";
                                                    $rescategory  =  $db->select($info);
                                                ?>
                                                <select  name="category_id" id="category_id"   class="textbox">
                                                    <option value="">--Select--</option>
                                                    <?php
                                                       foreach($rescategory as $key=>$each)
                                                       { 
                                                    ?>
                                                      <option value="<?=$rescategory[$key]['id']?>" <?php if($rescategory[$key]['id']==$category_id){ echo "selected"; }?>><?=$rescategory[$key]['cat_name']?></option>
                                                    <?php
                                                     }
                                                    ?> 
                                                </select>
                                        </td>
                                        <td align="left">Age <br />
                                                      
												<?php
                                                    $info['table']    = "age";
                                                    $info['fields']   = array("*");   	   
                                                    $info['where']    =  "1=1 ORDER BY id DESC";
                                                    $resage  =  $db->select($info);
                                                ?>
                                                <select  name="age_id" id="age_id"   class="textbox">
                                                    <option value="">--Select--</option>
                                                    <?php
                                                       foreach($resage as $key=>$each)
                                                       { 
                                                    ?>
                                                      <option value="<?=$resage[$key]['id']?>" <?php if($resage[$key]['id']==$age_id){ echo "selected"; }?>><?=$resage[$key]['age_name']?></option>
                                                    <?php
                                                     }
                                                    ?> 
                                                </select>
                                         </td>
                             </tr>
                             <tr>
                                 <td colspan="2">
                                   Description<br /> 
                                   <textarea name="description" id="description"  class="textbox" style="width:850px;height:100px;"><?=$description?></textarea>
                                 </td>
                             </tr>
                             <tr>
                                <td colspan="2">
                                     <table>
                                          <tr>
                                              <td>Event Picture</td><td><input type="file" name="file_ticket" id="file_ticket"  value="<?=$file_ticket?>" class="textbox"></td>
                                          </tr>
                                          
                                         <!-- <tr>
                                              <td>File Thumb1</td><td><input type="file" name="file_thumb1" id="file_thumb1"  value="<?=$file_thumb1?>" class="textbox"></td>
                                          </tr>
                                          
                                          <tr>
                                              <td>File Thumb2</td><td><input type="file" name="file_thumb2" id="file_thumb2"  value="<?=$file_thumb2?>" class="textbox"></td>
                                          </tr>
                                          
                                          <tr>
                                              <td>File Thumb3</td><td><input type="file" name="file_thumb3" id="file_thumb3"  value="<?=$file_thumb3?>" class="textbox"></td>
                                          </tr>-->
                                     </table>
                                
                                </td>
                             
                             </tr> 
                            <tr>
                                <td colspan="2">
                                    Status <br />
                                    <?php
										$enumadminusers = getEnumFieldValues('adminusers','status');
									?>
									<select  name="status" id="status"   class="textbox">
									<?php
									   foreach($enumadminusers as $key=>$value)
									   { 
									?>
									  <option value="<?=$value?>" <?php if($value==$status){ echo "selected"; }?>><?=$value?></option>
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
<!--<script>
		$( ".datepicker" ).datepicker({
			dateFormat: "yy-mm-dd", 
			changeYear: true,
			changeMonth: true,
			showOn: 'button',
			buttonText: 'Show Date',
			buttonImageOnly: true,
			buttonImage: '../images/calendar.gif',
		});
</script>-->
<?php 
   include("../template/footer.php");
?>                    