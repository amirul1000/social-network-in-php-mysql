

<div class="page-section">
  <div class="row">
    <div class="col-md-10 col-lg-8 col-md-offset-1 col-lg-offset-2">

      <h4 class="page-section-heading">My Profile</h4>
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
                              $hash    =  getTableFieldsName("users");
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
                          <input type="hidden" name="cmd" id="cmd" value="search_users" >
                          <input type="submit" name="btn_submit" id="btn_submit"  value="Search" class="button" />
                        </td>
                      </TR>
                    </table>
                  </form>
                </td>
       </tr>
       <tr>
       <td> 
            <table class="table v-middle">
                <tr bgcolor="#ABCAE0">
                  <td>Title</td>
                  <td>First Name</td>
                  <td>Last Name</td>
                  <td>Phone</td>
                  <td>Company</td>
                  <td>Address</td>
                  <td>City</td>
                  <td>State</td>
                  <td>Zip</td>
                  <td>Country</td>
                  <td>File Picture</td>
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
                      
                    $whrstr .= " AND id='".$_SESSION['users_id']."'";
                    
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
                  <td><?=$arr[$i]['title']?></td>
                  <td><?=$arr[$i]['first_name']?></td>
                  <td><?=$arr[$i]['last_name']?></td>
                  <td><?=$arr[$i]['phone']?></td>
                  <td><?=$arr[$i]['company']?></td>
                  <td><?=$arr[$i]['address']?></td>
                  <td><?=$arr[$i]['city']?></td>
                  <td><?=$arr[$i]['state']?></td>
                  <td><?=$arr[$i]['zip']?></td>
                  <td>
                    <?php
                        unset($info2);        
                        $info2['table']    = "country";	
                        $info2['fields']   = array("country");	   	   
                        $info2['where']    =  "1 AND id='".$arr[$i]['country_id']."' LIMIT 0,1";
                        $res2  =  $db->select($info2);
                        echo $res2[0]['country'];	
                    ?>
                   </td>
                  <td>
                  <?php
				    if(empty($arr[$i]['file_picture']))
					{
				  ?>
                   <img src="../images/default_man.png" style="width:100px;height:100px;" /> 
                  <?php
				    }
					else
					{
				 ?> 
                  <img src="../<?=$arr[$i]['file_picture']?>" style="width:100px;height:100px;" />
                  <?php
				   }
				  ?> 
                  
                  </td>			 
                  <td nowrap >
                      <a href="index.php?cmd=edit&id=<?=$arr[$i]['id']?>" class="btn default btn-xs purple"><i class="fa fa-edit"></i>Edit</a> 
                      <!--<a href="index.php?cmd=delete&id=<?=$arr[$i]['id']?>" class="btn btn-sm red filter-cancel"  onClick=" return confirm('Are you sure to delete this item ?');"><i class="fa fa-times"></i>Delete</a> -->
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
        
                          $info["table"] = "users";
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
