	<?php 
       include("../template/header.php");
    ?>
   <div class="page-section">
  <div class="row">
    <div class="col-md-10 col-lg-8 col-md-offset-1 col-lg-offset-2">

      <h4 class="page-section-heading">Event</h4>
      <div class="panel panel-default">
        <!-- Progress table -->
        <div class="table-responsive">
        
        <table class="table v-middle"> 
               <a href="index.php?cmd=edit"  class="btn btn-primary">Add an event</a>			
               <tr>
               <td> 
                  
                     <table class="table v-middle"> 
                        <tr bgcolor="#ABCAE0">
                          <th>Category </th>
                          <th>Age </th>
                          <th>Timezone </th>
                          <th>Ticket Name</th>
                          <th>Venue Name</th>
                          <th>Venue City</th>
                          <th>Venue Post Code</th>
                          <th>Start Date</th>
                          <th>End Date</th>
                          <th>Price</th>			
                          <th>File Thumb1</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                     <?php
                        
                             $whrstr = " AND users_id='".$_SESSION['users_id']."'";
                                 
                            $rowsPerPage = 10;
                            $pageNum = 1;
                            if(isset($_REQUEST['page']))
                            {
                                $pageNum = $_REQUEST['page'];
                            }
                            $offset = ($pageNum - 1) * $rowsPerPage;  
                     
                     
                                          
                            $info["table"] = "events";
                            $info["fields"] = array("events.*"); 
                            $info["where"]   = "1   $whrstr ORDER BY id DESC  LIMIT $offset, $rowsPerPage";
                                                
                            
                            $arr =  $db->select($info);
                            
                            for($i=0;$i<count($arr);$i++)
                            {
                            
                               $rowColor;
                    
                                if($i % 2 == 0)
                                {
                                    
                                    $row="#C8C8C8";
                                }
                                else
                                {
                                    
                                    $row="#FFFFFF";
                                }
                            
                     ?>
                        <tr>			 
                          <td>
                                <?php
                                    unset($info2);        
                                    $info2['table']    = "category";	
                                    $info2['fields']   = array("cat_name");	   	   
                                    $info2['where']    =  "1 AND id='".$arr[$i]['category_id']."' LIMIT 0,1";
                                    $res2  =  $db->select($info2);
                                    echo $res2[0]['cat_name'];	
                                ?>
                           </td>
                          <td>
                                <?php
                                    unset($info2);        
                                    $info2['table']    = "age";	
                                    $info2['fields']   = array("age_name");	   	   
                                    $info2['where']    =  "1 AND id='".$arr[$i]['age_id']."' LIMIT 0,1";
                                    $res2  =  $db->select($info2);
                                    echo $res2[0]['age_name'];	
                                ?>
                           </td>
                          <td>
                                <?php
                                    unset($info2);        
                                    $info2['table']    = "timezone";	
                                    $info2['fields']   = array("zone_name");	   	   
                                    $info2['where']    =  "1 AND id='".$arr[$i]['timezone_id']."' LIMIT 0,1";
                                    $res2  =  $db->select($info2);
                                    echo $res2[0]['zone_name'];	
                                ?>
                           </td>
                          <td><?=$arr[$i]['ticket_name']?></td>
                          <td><?=$arr[$i]['venue_name']?></td>
                          <td><?=$arr[$i]['venue_city']?></td>
                          <td><?=$arr[$i]['venue_post_code']?></td>
                          <td><?=$arr[$i]['start_date']?> <?=$arr[$i]['start_time_hr']?> <?=$arr[$i]['start_time_min']?> <?=$arr[$i]['start_am_pm']?></td>
                          <td><?=$arr[$i]['end_date']?> <?=$arr[$i]['end_time_hr']?> <?=$arr[$i]['end_time_min']?> <?=$arr[$i]['end_am_pm']?></td>
                          <td><?=$arr[$i]['price']?></td>
                          <td>
                              <?php
                                if( is_file('../'.$arr[$i]['file_ticket']) && file_exists('../'.$arr[$i]['file_ticket']) )
                                {
                               ?>
                                  <img src="../<?=$arr[$i]['file_ticket']?>" style="width:100px;" />
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
                          <td><?=$arr[$i]['status']?></td>
                         <td nowrap >
                          <a href="index.php?cmd=edit&id=<?=$arr[$i]['id']?>" class="btn default btn-xs purple"><i class="fa fa-edit"></i>Edit</a> 
                          <a href="index.php?cmd=delete&id=<?=$arr[$i]['id']?>" class="btn btn-sm red filter-cancel"  onClick=" return confirm('Are you sure to delete this item ?');"><i class="fa fa-times"></i>Delete</a> 
                         </td>
                        </tr>
                    <?php
                              }
                    ?>
                    
                    <tr>
                       <td colspan="10" align="center">
                          <?php              
                                  unset($info);
                
                                  $info["table"] = "events";
                                  $info["fields"] = array("count(*) as total_rows"); 
                                  $info["where"]   = "1  $whrstr ORDER BY id DESC";
                                  
                                  $res  = $db->select($info);  
                
                
                                    $numrows = $res[0]['total_rows'];
                                    $maxPage = ceil($numrows/$rowsPerPage);
                                    $self = 'index.php?cmd=list';
                                    $nav  = '';
                                    
                                    $start    = ceil($pageNum/5)*5-5+1;
                                    $end      = ceil($pageNum/5)*5;
                                    
                                    if($maxPage<$end)
                                    {
                                      $end  = $maxPage;
                                    }
                                    
                                    for($page = $start; $page <= $end; $page++)
                                    //for($page = 1; $page <= $maxPage; $page++)
                                    {
                                        if ($page == $pageNum)
                                        {
                                            $nav .= " $page "; 
                                        }
                                        else
                                        {
                                            $nav .= " <a href=\"$self&&page=$page\" class=\"nav\">$page</a> ";
                                        } 
                                    }
                                    if ($pageNum > 1)
                                    {
                                        $page  = $pageNum - 1;
                                        $prev  = " <a href=\"$self&&page=$page\" class=\"nav\">[Prev]</a> ";
                                
                                       $first = " <a href=\"$self&&page=1\" class=\"nav\">[First Page]</a> ";
                                    } 
                                    else
                                    {
                                        $prev  = '&nbsp;'; 
                                        $first = '&nbsp;'; 
                                    }
                                
                                    if ($pageNum < $maxPage)
                                    {
                                        $page = $pageNum + 1;
                                        $next = " <a href=\"$self&&page=$page\" class=\"nav\">[Next]</a> ";
                                
                                        $last = " <a href=\"$self&&page=$maxPage\" class=\"nav\">[Last Page]</a> ";
                                    } 
                                    else
                                    {
                                        $next = '&nbsp;'; 
                                        $last = '&nbsp;'; 
                                    }
                                    
                                    if($numrows>1)
                                    {
                                      echo $first . $prev . $nav . $next . $last;
                                    }
                                    
                                ?>     
                       </td>
                    </tr>
                    </table>
            
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
