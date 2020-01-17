<?php
   include("../template/header.php");
?>
<script type="text/javascript" src="../../js/jquery.js"></script>
<script language="javascript" src="../../js/wtooltip.js"></script> 
     <!-- content push wrapper -->
    <div class="st-pusher" id="content">

      <!-- sidebar effects INSIDE of st-pusher: -->
      <!-- st-effect-3, st-effect-6, st-effect-7, st-effect-8, st-effect-14 -->

      <!-- this is the wrapper for the content -->
      <div class="st-content">

        <!-- extra div for emulating position:fixed of the menu -->
        <div class="st-content-inner">
        
        
        

          <div class="container-fluid">          
          

            <div class="cover profile">
                 <?php
				    ///get new one
					  unset($info);
					$info["table"] = "contents";
					$info["fields"] = array("contents.*"); 
					$info["where"]   = "1 AND users_id='".$_SESSION['users_id']."' ORDER BY id DESC LIMIT 0,1";
					$arrnew =  $db->select($info);
					
				 
				   //get all including friends
				      $friend_users_id_list =   get_friend_users_id_list($db,$users_id);
					  
					  if(strlen($friend_users_id_list)>0)
					  {
					      $wherefriend =  " OR users_id in ($friend_users_id_list)";
					  }
				      if(count($arrnew)==0)
					  {
						   $new_out = " AND id!='".$arrnew[0]['id']."'";
					  }
					  
					  $wherestr = " AND ( users_id='".$_SESSION['users_id']."'  $wherefriend ) $new_out";
					   $rowsPerPage = 21;
						$pageNum = 1;
						if(isset($_REQUEST['page']))
						{
							$pageNum = $_REQUEST['page'];
						}
						$offset = ($pageNum - 1) * $rowsPerPage;
				         unset($info);
						$info["table"] = "contents";
						$info["fields"] = array("contents.*"); 
						$info["where"]   = "1 $wherestr  ORDER BY id DESC LIMIT $offset, $rowsPerPage";
						$arr =  $db->select($info);
						
						if(count($arrnew)==0)
						{
				 ?>
                 <img src="../images/profile-cover.jpg" width="100%" height="400px" />
                 <?php
					   }
					   else
					   {
					   
					    if($arrnew[0]['content_type'] == "link")
						{
					?>
                       <iframe width="854" height="480" src="<?=$arrnew[0]['content']?>" sandbox="allow-forms allow-scripts"></iframe>
                    <?php	
						
						}
						else
						{
				    ?>	
                     <?=$arrnew[0]['content']?>                 
                 <?php
				        }
				       }
				 ?>              
            </div>
            <div class="row">
             
             
             
             
              <div class="col-xs-12 col-md-6 col-lg-4 item">
                <div class="timeline-block">
                  <div class="panel panel-default share clearfix-xs">
                    <div class="panel-heading panel-heading-gray title">
                      What&acute;s new
                    </div>
                    <div class="panel-body">
                    
                       <form action="" method="post">
                         <table class="table">
                              <tr>
                                     <td valign="top">Content</td>
                                     <td align="left">
                                         <textarea name="content" style="width:100%;height:200px;"></textarea>
                                         <input type="hidden" name="cmd" value="video_add" />
                                         <input type="submit" value="Submit" class="btn btn-primary" />
                                     </td>
				 			 </tr>
                          </table> 
                       </form>

                    </div>
                    
                  </div>
                </div>
              </div>
              
              
              <?php
			     
				   $k=1;
				 
			    if(count($arr)>1)
				  {
				  
				    for($j=1;$j<count($arr);$j++)
					{
					  $k++;
			  ?>
              
              <div class="col-xs-12 col-md-6 col-lg-4 item">
                <div class="timeline-block">
                  <div class="panel panel-default share clearfix-xs">
                    <div class="panel-heading panel-heading-gray title">
                      Published on <?=date("M j, Y",strtotime($arr[$j]['date_created']))?>, <?php  if($arr[$j]['shared_contents_id']>0) { echo "Shared by";} else{  echo "Posted by"; } ?> <?=get_users_name($db,$arr[$j]['users_id'])?> 
                    </div>
                   <div class="panel-body" style="overflow:hidden;height:400px;;">
                     <?php
					    if($arr[$j]['content_type'] == "link")
						{
					?>
                       <iframe style="width:100%;height:100%;" src="<?=$arr[$j]['content']?>" sandbox="allow-forms allow-scripts"></iframe>
                    <?php							
						}
						else
						{
				    ?>	
                     <?=$arr[$j]['content']?>                 
					 <?php
                        }
                     ?>                        
                  </div>
                    
					<!------Like--->
                    <div id="like_list_<?=$arr[$j]['id']?>">
						<?php
                        if(get_likes_users_id($db,$arr[$j]['id']) == 0)
                        {
                        ?>
                        <a href="index.php?cmd=like&contents_id=<?=$arr[$j]['id']?>">Like </a> Likes <?=get_likes_count($db,$arr[$j]['id'])?>
                        <?php
                         }
                         else
                         {
                        ?>
                        <a href="index.php?cmd=unlike&contents_id=<?=$arr[$j]['id']?>">Unlike </a> Likes <?=get_likes_count($db,$arr[$j]['id'])?>
                        <?php
                        }
                        ?>
                    </div>
                    <script language="javascript">
						$("#like_list_<?=$arr[$j]['id']?>").wTooltip({ 
						 ajax: "tooltip_ajax_likes_users_list.php?id=<?=$arr[$j]['id']?>", 
								 fadeIn: 600, 
								 fadeOut: "slow",
								 delay:1000                         
						}); 
					</script>
                    <!-------/Like----->
                    
                    <!------Sahre------->
                    <div style="float:right;">
							<?php
                               $contents_id = $arr[$j]['shared_contents_id']==0? $arr[$j]['id']:$arr[$j]['shared_contents_id'];
                              
                            ?>
                            <div id="shared_list_<?=$arr[$j]['id']?>">
                                   <a href="index.php?cmd=share&contents_id=<?php echo $contents_id;?>">Share </a>
                                    <a href="javascript:void();" class="button">
                                       <?=get_shared_count($db,$contents_id)?>
                                    </a>
                            </div>
							<script language="javascript">
								$("#shared_list_<?=$arr[$j]['id']?>").wTooltip({ 
								 ajax: "tooltip_ajax_shared_users_list.php?id=<?=$contents_id?>", 
										 fadeIn: 600, 
										 fadeOut: "slow",
										 delay:1000                         
								}); 
                            </script>
                    
                    
                    </div>
                    <!------/Sahre---->
                    <!---Comment-->
                    <b>Comments</b><br />    
                    <div style="border:5px solid #6c6c6c;border-radius: 25px;background:#CCCCCC;">
                                          
						   <?php
                             echo get_users_name($db,$_SESSION['users_id']);
                           ?>                       
                           <form action="" method="post">
                              <textarea name="comment" style="width:400px;"></textarea>
                              <input type="hidden" name="cmd" value="add_comment" />
                              <input type="hidden" name="users_id" value="<?=$_SESSION['users_id']?>" />
                              <input type="hidden" name="contents_id" value="<?=$arr[$j]['id']?>" />
                              <br />
                              <input type="submit" value="Submit" />
                           </form> 
                           <?php
						      //get all comments
							  unset($info);
							  unset($data);
							$info["table"] = "comments";
							$info["fields"] = array("comments.*"); 
							$info["where"]   = "1 AND contents_id='".$arr[$j]['id']."'";
							$arr_comments =  $db->select($info);
							for($m=0;$m<count($arr_comments);$m++)
							{
							  echo get_users_name($db,$arr_comments[$m]['users_id']);
							  echo "&nbsp;&nbsp;&nbsp;";  
							  echo $arr_comments[$m]['comment'];  
							  echo "&nbsp;&nbsp;&nbsp;";
							  echo $arr_comments[$m]['date_time_created'];  
							  echo "<br>";
						    }
						   ?>                      
                    </div>
                    <!---Comment----->
                    
                  </div>
                </div>
              </div>
              
                 <?php
				    if($k%3==0)
					{
				 ?>
                    </div><div class="row">
                 <?php	 
					}
				 ?>
              
             
             <?php
			          }
			      }
			 ?>	   
              
              
             
            </div>
            
            

          </div>
          
          
          
          <!----Pagination------>
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
                          $info["where"]   = "1 $wherestr  ORDER BY id DESC";
                          
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
          
          
          <!-------Pagination----->
          
          
          



        </div>
        <!-- /st-content-inner -->

      </div>
      <!-- /st-content -->

    </div>
    <!-- /st-pusher -->


<?php
   include("../template/footer.php");
?>