<?php
	if( !empty($Id ))
	{
		$info['table']    = "events";
		$info['fields']   = array("*");   	   
		$info['where']    =  "id='".$Id."' AND users_id='".$_SESSION['users_id']."'";
	   
		$res  =  $db->select($info);
	   
		$Id        = $res[0]['id'];  
		$users_id    = $res[0]['users_id'];
		$category_id    = $res[0]['category_id'];
		$age_id    = $res[0]['age_id'];
		$timezone_id    = $res[0]['timezone_id'];
		$ticket_name    = $res[0]['ticket_name'];
		$venue_name    = $res[0]['venue_name'];
		$venue_post_code    = $res[0]['venue_post_code'];
		$start_date    = $res[0]['start_date'];
		$start_time_hr    = $res[0]['start_time_hr'];
		$start_time_min    = $res[0]['start_time_min'];
		$start_am_pm    = $res[0]['start_am_pm'];
		$end_date    = $res[0]['end_date'];
		$end_time_hr    = $res[0]['end_time_hr'];
		$end_time_min    = $res[0]['end_time_min'];
		$end_am_pm    = $res[0]['end_am_pm'];
		$price    = $res[0]['price'];
		$in_stock    = $res[0]['in_stock'];
		$is_security_code    = $res[0]['is_security_code'];
		$security_code    = $res[0]['security_code'];
		$file_ticket    = $res[0]['file_ticket'];
		$description    = $res[0]['description'];
		$file_thumb1    = $res[0]['file_thumb1'];
		$file_thumb2    = $res[0]['file_thumb2'];
		$file_thumb3    = $res[0]['file_thumb3'];
		$is_approved    = $res[0]['is_approved'];
		$status         = $res[0]['status'];
	 }
						   

?>  
   <table class="table v-middle">
        <tr>
            <td colspan="2" align="left">
               <b>Event Name</b><br />
                <?=$ticket_name?>
            </td>
        
        </tr>
        <tr>
            <td colspan="2" align="left">
               <b>Price</b><br />
                <?=$price?>
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
                                <?=$start_date?>
                              </td>
                           </tr>
                           <tr>
                              <td nowrap="nowrap">
                                Start Time<br />
                                
                                <?=$start_time_hr?>:<?=$start_time_min?> <?=$start_am_pm?>
                                
                              </td>
                           </tr>
                            <tr>
                              <td>
                               End Date<br />
                                <?=$end_date?> 
                              </td>
                           </tr>
                           <tr>
                              <td nowrap="nowrap">
                                End Time<br />
                                
                               <?=$end_time_hr?>:<?=$end_time_min?> <?=$end_am_pm?>
                                
                              </td>
                           </tr>
                            <tr>
                             <td>
                             Timezone<br />
                            <?php
                                $info['table']    = "timezone";
                                $info['fields']   = array("*");   	   
                                $info['where']    =  "1=1 AND id='".$timezone_id."' ORDER BY id DESC";
                                $restimezone  =  $db->select($info);
                            ?>
                            <?=$restimezone[0]['zone_name']?>
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
                               <?=$venue_name?>

                              </td>
                           </tr>
                           <tr>
                              <td>
                                Venue Post Code<br />
                                <?=$venue_post_code?>
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
                                $info['where']    =  "1=1 AND id='".$category_id."' ORDER BY id DESC";
                                $rescategory  =  $db->select($info);
                            ?>
                             <?=$rescategory[0]['cat_name']?>
                            
                    </td>
                    <td align="left">Age <br />
                                  
                            <?php
                                $info['table']    = "age";
                                $info['fields']   = array("*");   	   
                                $info['where']    =  "1=1 AND id='".$age_id."' ORDER BY id DESC";
                                $resage  =  $db->select($info);
                            ?>
                            <?=$resage[0]['age_name']?>
                      </td>      
         </tr>
         <tr>
             <td colspan="2">
               Description<br /> 
               <?=$description?>
             </td>
         </tr>
         <tr>
            <td colspan="2">
                 <table>
                      <tr>
                          <td>Event Picture</td><td> 
                          <?php
                            if( is_file('../'.$file_ticket) && file_exists('../'.$file_ticket) )
                            {
                           ?>
                              <img src="../<?=$file_ticket?>" style="width:100px;" />
                           <?php
                            }
                            else
                            {
                          ?>
                              <img src="../images/no_image.jpg" style="width:100px;" />
                          <?php	
                            }
                          ?>
                          </td>
                      </tr>
                   </table>
            </td>
         
         </tr> 
        
  </td>
 </tr>
</table>