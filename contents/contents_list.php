<?php
   include("../template/header.php");
?>
<div class="page-section">
  <div class="row">
    <div class="col-md-10 col-lg-8 col-md-offset-1 col-lg-offset-2">

      <h4 class="page-section-heading">Contents</h4>
      <div class="panel panel-default">
        <!-- Progress table -->
        <div class="table-responsive">
     	 <table class="table v-middle">
       <tr>
                <td align="center" valign="top">
                  <form name="search_frm" id="search_frm" method="post">
                    <table class="table v-middle">
                      <TR>
                        <TD  nowrap="nowrap">
                          <?php
                              $hash    =  getTableFieldsName("contents");
                              $hash    = array_diff($hash,array("id"));
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
                          <input type="hidden" name="cmd" id="cmd" value="search_contents" >
                          <input type="submit" name="btn_submit" id="btn_submit"  value="Search" class="button" />
                        </td>
                      </TR>
                    </table>
                  </form>
                </td>
       </tr>
       <tr>
       <td> 
            <a href="index.php?cmd=edit" class="btn btn-primary">Add a content</a>
            <table class="table v-middle">
                <tr bgcolor="#ABCAE0">
                  <th>Content Type</th>
                  <th>Content</th>
                  <th>Date Created</th>
                  <th>Date Updated</th>
                  <th>Status</th>
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
             
             
                                  
                    $info["table"] = "contents";
                    $info["fields"] = array("contents.*"); 
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
                  <td><?=$arr[$i]['content_type']?></td>
                  <td>
				      <?=htmlspecialchars($arr[$i]['content'])?>
                  </td>
                  <td><?=$arr[$i]['date_created']?></td>
                  <td><?=$arr[$i]['date_updated']?></td>
                  <td><?=$arr[$i]['status']?></td>			  
                  <td nowrap >
                      <a href="index.php?cmd=edit&id=<?=$arr[$i]['id']?>" class="btn default btn-xs purple"><i class="fa fa-edit"></i>Edit</a> 
                      <a href="index.php?cmd=delete&id=<?=$arr[$i]['id']?>" class="btn btn-sm red filter-cancel"  onClick=" return confirm('Are you sure to delete this item ?');"><i class="fa fa-times"></i>Delete</a> 
                     </td>
                 </td>
            
                </tr>
            <?php
                      }
            ?>
            
            <tr>
               <td colspan="10" align="center">
                  <style>
                    #navlist li
                    {
                        float:left;
                        display: inline;
                        list-style-type: none;
                        padding-right: 20px;
                    }
                </style>
    
                  <?php              
                          unset($info);
        
                          $info["table"] = "contents";
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
                                    $nav .= "<li>$page</li>"; 
                                }
                                else
                                {
                                    $nav .= "<li><a href=\"$self&&page=$page\" class=\"nav\">$page</a></li>";
                                } 
                            }
                            if ($pageNum > 1)
                            {
                                $page  = $pageNum - 1;
                                $prev  = "<li><a href=\"$self&&page=$page\" class=\"nav\">[Prev]</a></li>";
                        
                               $first = "<li><a href=\"$self&&page=1\" class=\"nav\">[First Page]</a></li>";
                            } 
                            else
                            {
                                $prev  = '<li>&nbsp;</li>'; 
                                $first = '<li>&nbsp;</li>'; 
                            }
                        
                            if ($pageNum < $maxPage)
                            {
                                $page = $pageNum + 1;
                                $next = "<li><a href=\"$self&&page=$page\" class=\"nav\">[Next]</a></li>";
                        
                                $last = "<li><a href=\"$self&&page=$maxPage\" class=\"nav\">[Last Page]</a></li>";
                            } 
                            else
                            {
                                $next = '<li>&nbsp;</li>'; 
                                $last = '<li>&nbsp;</li>'; 
                            }
                            
                            if($numrows>1)
                            {
                              echo '<ul id="navlist">';
                               echo $first . $prev . $nav . $next . $last;
                              echo '</ul>';
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
     





