	<?php 
       include("../template/header.php");
    ?>
   <div class="page-section">
    <div class="row">
    <div class="col-md-10 col-lg-8 col-md-offset-1 col-lg-offset-2">

      <h4 class="page-section-heading">Feed</h4>
      <div class="panel panel-default">
        <!-- Progress table -->
        <div class="table-responsive">
        
        <table class="table v-middle"> 
           <tr>
                    <td align="center" valign="top">
                      <form name="search_frm" id="search_frm" method="post">
                        <table width="60%" border="0"  cellpadding="0" cellspacing="0" class="bodytext">
                          <TR>
                            <TD  nowrap="nowrap">
                              <?php
                                  $hash    =  getTableFieldsName("feeds");
                                  $hash    = array_diff($hash,array("id","users_id"));
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
                              <input type="hidden" name="cmd" id="cmd" value="search_feeds" >
                              <input type="submit" name="btn_submit" id="btn_submit"  value="Search" class="button" />
                            </td>
                          </TR>
                        </table>
                      </form>
                    </td>
           </tr>
           <tr>
           <td> 
                <a href="feeds.php?cmd=edit"  class="btn btn-primary">Add a feed</a>
                <table class="table v-middle"> 
                    <tr bgcolor="#ABCAE0">
                      <td>Key</td>
                      <td>File Feed</td>
                      <td>To Get Updated Feed Execute the Link By curl or manually</td>
                      <td>Action</td>
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
                 
                 
                                      
                        $info["table"] = "feeds";
                        $info["fields"] = array("feeds.*"); 
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
                      <td><?=$arr[$i]['feedkey']?></td>
                      <td>
                          <a href="<?=$arr[$i]['file_feed']?>"  target="_blank">
					       <?=$arr[$i]['file_feed']?>
                          </a> 
                      </td>
                      <td>
                          <a href="update_feed.php?id=<?=base64_encode($arr[$i]['id'])?>&users_id=<?=base64_encode($arr[$i]['users_id'])?>&feedkey=<?=base64_encode($arr[$i]['feedkey'])?>" target="_blank">
					       update_feed.php?id=<?=base64_encode($arr[$i]['id'])?>&users_id=<?=base64_encode($arr[$i]['users_id'])?>&feedkey=<?=base64_encode($arr[$i]['feedkey'])?>
                          </a> 
                      </td>
                      <td nowrap >
                          <a href="feeds.php?cmd=edit&id=<?=$arr[$i]['id']?>" class="btn default btn-xs purple"><i class="fa fa-edit"></i>Edit</a> 
                          <a href="feeds.php?cmd=delete&id=<?=$arr[$i]['id']?>" class="btn btn-sm red filter-cancel"  onClick=" return confirm('Are you sure to delete this item ?');"><i class="fa fa-times"></i>Delete</a> 

                     </td>
                
                    </tr>
                <?php
                          }
                ?>
                
                <tr>
                   <td colspan="10" align="center">
                      <?php              
                              unset($info);
            
                              $info["table"] = "feeds";
                              $info["fields"] = array("count(*) as total_rows"); 
                              $info["where"]   = "1  $whrstr ORDER BY id DESC";
                              
                              $res  = $db->select($info);  
            
            
                                $numrows = $res[0]['total_rows'];
                                $maxPage = ceil($numrows/$rowsPerPage);
                                $self = 'feeds.php?cmd=list';
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
