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
                    <?=$message?>
                    <table class="table v-middle">
                        <tr bgcolor="#ABCAE0">
                          <td>Friend</td>
                          <td>Action</td>
                        </tr>
                     <?php
                            
                            if($_SESSION["search"]=="yes")
                              {
                                $whrstr =  " AND(  users.username LIKE '%".$_SESSION['SearchText']."%' 
												OR users.first_name LIKE '%".$_SESSION['SearchText']."%' 
												OR users.last_name LIKE '%".$_SESSION['SearchText']."%' 
												OR users.lives_in LIKE '%".$_SESSION['SearchText']."%' 
												OR users.hobby LIKE '%".$_SESSION['SearchText']."%' 
												OR users.occupation LIKE '%".$_SESSION['SearchText']."%' 
												OR users.address LIKE '%".$_SESSION['SearchText']."%' 
												OR users.city LIKE '%".$_SESSION['SearchText']."%' 
												OR users.state LIKE '%".$_SESSION['SearchText']."%' 
												OR users.gender LIKE '%".$_SESSION['SearchText']."%' )";
                              }
                             
                           
						    $whrstr .=  " AND id!='".$_SESSION['users_id']."'";
						   
                            $rowsPerPage = 10;
                            $pageNum = 1;
                            if(isset($_REQUEST['page']))
                            {
                                $pageNum = $_REQUEST['page'];
                            }
                            $offset = ($pageNum - 1) * $rowsPerPage;  
                     
                     
                                          
                            $info["table"] = "users";
                            $info["fields"] = array("users.*"); 
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
                        <tr bgcolor="<?=$row?>" onmouseover=" this.style.background='#ECF5B6'; " onmouseout=" this.style.background='<?=$row?>'; ">
                          <td>
                                <?php
                                    unset($info2);        
                                    $info2['table']    = "users";	
                                    $info2['fields']   = array("*");	   	   
                                    $info2['where']    =  "1 AND id='".$arr[$i]['id']."' LIMIT 0,1";
                                    $res2  =  $db->select($info2);
                                    echo $res2[0]['first_name'].' '.$res2[0]['last_name'];	
                                ?>
                          </td>
                          <td nowrap >
                             <?php
							   if(get_freind_status($db,$arr[$i]['id'])=='accept')
							   {
							  ?>
                               <a href="friends.php?cmd=unfriend&friend_users_id=<?=$arr[$i]['id']?>&come=nav" class="btn btn-primary">Unfreind</a>
                             <?php
							   }
							   else if(get_freind_status($db,$arr[$i]['id'])=='pending')
							   {
							 ?>
                              <a href="friends.php?cmd=friend&friend_users_id=<?=$arr[$i]['id']?>&come=nav" class="btn btn-primary">Resend Friend Request</a> 
                             <?php
							   }else 
							   {
							 ?>
                              <a href="friends.php?cmd=friend&friend_users_id=<?=$arr[$i]['id']?>&come=nav" class="btn btn-primary">Send Friend Request</a> 
                             <?php
							   }
							 ?>
                         </td>
                    
                        </tr>
                    <?php
                              }
                    ?>
                    
                    <tr>
                       <td colspan="10" align="center">
                          <?php              
                                  unset($info);
                
                                  $info["table"] = "users";
                                  $info["fields"] = array("count(*) as total_rows"); 
                                  $info["where"]   = "1  $whrstr ORDER BY id DESC";
                                  
                                  $res  = $db->select($info);  
                
                
                                    $numrows = $res[0]['total_rows'];
                                    $maxPage = ceil($numrows/$rowsPerPage);
                                    $self = 'friends.php?cmd=list&&come=nav';
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

