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
        
        
        <script type="text/javascript" src="../tinybox2/tinybox.js"></script>
        <link rel="stylesheet" type="text/css" href="../tinybox2/style.css" />        
        <script type="text/javascript">
            function popUp(url)
            { 
            
              var parentWindow = window;
              TINY.box.show({iframe:url,closejs:function(){parentWindow.location.reload()},boxid:'frameless',width:850,height:650,fixed:false,maskid:'bluemask',maskopacity:40});
            
            } 
        </script>
        
        <a href="javascript:void();" onclick="popUp('../friends/friends.php?cmd=search_view');" class="btn btn-primary"> Find Friends </a>
        
        
            <table class="table v-middle">
               <tr>
                        <td align="center" valign="top">
                          <form name="search_frm" id="search_frm" method="post">
                            <table width="60%" border="0"  cellpadding="0" cellspacing="0" class="bodytext">
                              <TR>
                                <TD  nowrap="nowrap">
                                  <?php
                                      $hash    =  getTableFieldsName("friends");
                                      $hash    = array_diff($hash,array("id,users_id,friend_users_id"));
                                  ?>
                                  Search Key:
                                  <select   name="field_name" id="field_name"  class="textbox">
                                    <option value="">--Select--</option>
                                    <?php
                                    foreach($hash as $key=>$value)
                                    {
                                    ?>
                                    <option value="<?=$key?>" <?php if($_SESSION['field_name']==$key) echo "selected"; ?>><?=str_replace("_"," ",$value)?></option>
                                    <?php
                                    }
                                  ?>
                                  </select>
                                </TD>
                                <TD  nowrap="nowrap" align="right"><label for="searchbar"><img src="../images/icon_searchbox.png" alt="Search"></label>
                                   <input type="text"    name="field_value" id="field_value" value="<?=$_SESSION["field_value"]?>" class="textbox"></TD>
                                <td nowrap="nowrap" align="right">
                                  <input type="hidden" name="cmd" id="cmd" value="search_friends" >
                                  <input type="submit" name="btn_submit" id="btn_submit"  value="Search" class="button" />
                                </td>
                              </TR>
                            </table>
                          </form>
                        </td>
               </tr>
               <tr>
               <td> 
                    <!--<a href="friends.php?cmd=edit" class="nav3">Add a friends</a>-->
                    <table class="table v-middle">
                        <tr bgcolor="#ABCAE0">
                          <th>Friends</th>
                          <!--<th>Request To</th>-->
                          <th>Friend Status</th>
                          <th>Date Created</th>
                          <th>Action</th>
                        </tr>
                     <?php
                            
                            if($_SESSION["search"]=="yes")
                              {
                                $whrstr = " AND ".$_SESSION['field_name']." LIKE '%".$_SESSION["field_value"]."%'";
                              }
                              else
                              {
                                $whrstr = "";
                              }
							  
                             $whrstr .= " AND users_id='".$_SESSION['users_id']."'";
							 
                            $rowsPerPage = 10;
                            $pageNum = 1;
                            if(isset($_REQUEST['page']))
                            {
                                $pageNum = $_REQUEST['page'];
                            }
                            $offset = ($pageNum - 1) * $rowsPerPage;  
                     
                     
                                          
                            $info["table"] = "friends";
                            $info["fields"] = array("friends.*"); 
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
                          <!-- <td>
                                <?php
                                    unset($info2);        
                                    $info2['table']    = "users";	
                                    $info2['fields']   = array("*");	   	   
                                    $info2['where']    =  "1 AND id='".$arr[$i]['users_id']."' LIMIT 0,1";
                                    $res2  =  $db->select($info2);
                                ?>
                                <a href="../profile/index.php?username=<?=$res2[0]['username']?>"><i class="icon-user-1"></i> <span><?=$res2[0]['first_name']?> <?=$res2[0]['last_name']?> </span></a>
                           </td>-->
                          <td>
                                <?php
                                    unset($info2);        
                                    $info2['table']    = "users";	
                                    $info2['fields']   = array("*");	   	   
                                    $info2['where']    =  "1 AND id='".$arr[$i]['friend_users_id']."' LIMIT 0,1";
                                    $res2  =  $db->select($info2);
                                ?>
                                <a href="../profile/index.php?username=<?=$res2[0]['username']?>"><i class="icon-user-1"></i> <span><?=$res2[0]['first_name']?> <?=$res2[0]['last_name']?> </span></a>
                           </td>
                          <td><?=$arr[$i]['friend_status']?></td>
                          <td><?=$arr[$i]['date_created']?></td>
                          
                          <td nowrap >
                              <?php
							    if($arr[$i]['friend_status']=='pending' && $arr[$i]['friend_users_id']==$_SESSION['users_id'])
								{
							  ?>
                              <a href="friends.php?cmd=accept&id=<?=$arr[$i]['id']?>" class="btn btn-primary">Accept</a> 
                              <?php
							   }
							   else 
							   {
							  ?>
                              <a href="friends.php?cmd=reject&id=<?=$arr[$i]['id']?>" class="btn btn-primary" onClick=" return confirm('Are you sure to reject this freindship ?');">Reject</a> 
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
                
                                  $info["table"] = "friends";
                                  $info["fields"] = array("count(*) as total_rows"); 
                                  $info["where"]   = "1  $whrstr ORDER BY id DESC";
                                  
                                  $res  = $db->select($info);  
                
                
                                    $numrows = $res[0]['total_rows'];
                                    $maxPage = ceil($numrows/$rowsPerPage);
                                    $self = 'friends.php?cmd=list';
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



