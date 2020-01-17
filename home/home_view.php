<?php
   include("../template/header.php");
?>
<script type="text/javascript" src="../js/jquery.js"></script>
<script language="javascript" src="../js/wtooltip.js"></script> 
</div>
<section class="main-section padd-lr-0">
    <div class="width-full sm-705">
        <div class="row">
            <div class="col-md-12 dashboard-width">
                <div class="row">
                    <div class="col-md-3 dashboard-left">
                        <div class="left-box">
                            <div class="profile-left text-center">
                                 <?php
                                    $whrstr = " AND id='".$_SESSION['users_id']."'";
                                     unset($info);
                                    $info["table"] = "users";
                                    $info["fields"] = array("users.*"); 
                                    $info["where"]   = "1   $whrstr";
                                    $arr =  $db->select($info);
                                    
                                    $users_id = $arr[0]['users_id'];
                                    $city = $arr[0]['city'];
                                ?>
                                <?php
                                $image = "../".$arr[0]['file_picture'];
                                if(file_exists($image) && is_file($image))
                                 {
                               ?>
                                    <img src="<?php echo $image; ?>" alt="" class="img-responsive img-circle">
                               <?php
                                 }
                                else
                                 {
                                ?> 
                                     <img src="../images/no_image.jpg" alt="" class="img-responsive img-circle">
                                <?php
                                 }
                                ?>
                                <h4 class="name"><?=$arr[0]['first_name']?> <?=$arr[0]['last_name']?></h4>

                                <p><?=$arr[0]['about_me']?></p>
                            </div>
                            <div class="text-center">
                                <a href="<?=$arr[0]['website']?>" class="website-link"><i class="fa fa-link"></i> <?=$arr[0]['website']?></a>
                                <script type="text/javascript" src="../tinybox2/tinybox.js"></script>
                                <link rel="stylesheet" type="text/css" href="../tinybox2/style.css" />
                                <script type="text/javascript">
                                    function popUp(url)
                                    { 
                                      var parentWindow = window;
                                      TINY.box.show({iframe:url,closejs:function(){parentWindow.location.reload()},boxid:'frameless',width:850,height:650,fixed:false,maskid:'bluemask',maskopacity:40});
                                    } 
                                </script>
                                
                            </div>
                            <div class="photo">
                                <h4>Photo</h4>
                                <ul class="list-inline text-center">
                                    <?php
                                      unset($info);               
                                    $info["table"] = "photos";
                                    $info["fields"] = array("photos.*"); 
                                    $info["where"]   = "1   AND users_id='".$_SESSION['users_id']."' ORDER BY id DESC ";
                                    $arrphoto =  $db->select($info);
                                    for($i=0;$i<count($arrphoto);$i++)
                                    {
                                   ?>                                
                                    <li><a href="#"><img style="background:url(../<?=$arrphoto[$i]['file_photo']?>);" alt="" class="img-responsive"></a>
                                    </li>
                                   <?php
                                    }
                                   ?> 
                                </ul>
                                <!-- /.list-inline -->
                            </div>
                            <!-- /.photo -->
                            <div class="about">
                                <h4>About</h4>

                                <div class="about-body">
                                    <p><i class="fa fa-plus"></i> Followed by <span>10 peoples</span></p>

                                    <p><i class="fa fa-user"></i> Friends <span>
                                    
                                    <span id="friend_list">
                                        <a href="javascript:void();" class="button">
                                           <?=get_friend_count($db,$_SESSION['users_id'])?>
                                        </a>
                                    </span>
                                    <script language="javascript">
                                        $("#friend_list").wTooltip({ 
                                         ajax: "tooltip_ajax_friend_list.php?id=<?=$_SESSION['users_id']?>", 
                                                 fadeIn: 600, 
                                                 fadeOut: "slow",
                                                 delay:1000                         
                                        }); 
                                    </script>
                                    </span></p>

                                    <p><i class="fa fa-map-marker"></i> Lives in <span><?=$arr[0]['lives_in']?></span></p>

                                    <p><i class="fa fa-briefcase"></i> Work at <span><?=$arr[0]['works_at']?></span></p>
                                </div>
                            </div>
                            <!-- /.about -->
                        </div>
                        <!-- /.left-box -->
                    </div>
                    <!-- /.col-md-3 -->
                    <div class="col-md-6 dashboard-main-content">
                        <div class="message-box">
                            <form action="" class="message-form" role="form" method="post">
                                <div class="form-group">
                                    <textarea name="content" id="content" cols="30" rows="3" class="form-control" placeholder="Send message..."></textarea>
                                </div>
                                <div class="message-box-bottom">
                                    <ul class="list-inline">
                                        <li><a href="#"><i class="fa fa-camera"></i></a></li>
                                        <li><a href="#"><i class="fa fa-video-camera"></i></a></li>
                                    </ul>
                                    <input type="hidden" name="cmd" value="video_add" />  
                                    <input type="submit" value="Submit" class="btn btn-primary btn-lg pull-right" />
                                </div>
                            </form>
                        </div>
                        <!-- /.message-box -->
                        
                        <?php
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
                            
                            for($i=0;$i<count($arr);$i++)
                                {
                       ?>  
                        <div class="post-box-hbg">
                            <div class="row">
                                <div class="col-md-6 padding-right-0">
                                    <div class="post-box-heading">
                                        <h3>                      
                                        Published on <?=date("M j, Y",strtotime($arr[$i]['date_created']))?>, 
                                        <?php  if($arr[$i]['shared_contents_id']>0) 
                                              { echo "Shared by";} else{  echo "Posted by"; }
                                         ?>
                                         <?=get_users_name($db,$arr[$i]['users_id'])?> 
                                        </h3>
                                    </div>
                                </div>
                                <div class="col-md-6 text-right padding-left-0">
                                    <div class="post-box-heading">
                                        <ul class="list-inline margin-0">
                                            <!--  -->
                                            <li>
                                               <!-- ---- delete - -->
                                                <div id="like_list_<?=$arr[$i]['id']?>" style="float:right;">
                                                    <a href="index.php?cmd=delete&id=<?=$arr[$i]['id']?>">Delete</a>
                                                </div>
                                                
                                            </li>
                                             
                                            <li>
                                               <!-- ---- Like - -->
                                                <div id="like_list_<?=$arr[$i]['id']?>" style="float:right;">
                                                    <?php
                                                    if(get_likes_users_id($db,$arr[$i]['id']) == 0)
                                                    {
                                                    ?>
                                                    <a href="index.php?cmd=like&contents_id=<?=$arr[$i]['id']?>">Like <?=get_likes_count($db,$arr[$i]['id'])?> </a> 
                                                    <?php
                                                     }
                                                     else
                                                     {
                                                    ?>
                                                    <a href="index.php?cmd=unlike&contents_id=<?=$arr[$i]['id']?>">Unlike </a> Likes <?=get_likes_count($db,$arr[$i]['id'])?>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                                <script language="javascript">
                                                    $("#like_list_<?=$arr[$i]['id']?>").wTooltip({ 
                                                     ajax: "tooltip_ajax_likes_users_list.php?id=<?=$arr[$i]['id']?>", 
                                                             fadeIn: 600, 
                                                             fadeOut: "slow",
                                                             delay:1000                         
                                                    }); 
                                                </script>
                                              <!-- -----/Like--- -->
                                            </li>
                                            <li>
                                                <!-- ----Share----- -->
                                                 <div style="float:right;">
                                                        <?php
                                                           $contents_id = $arr[$i]['shared_contents_id']==0? $arr[$i]['id']:$arr[$i]['shared_contents_id'];
                                                        ?>
                                                        <div id="shared_list_<?=$arr[$i]['id']?>">
                                                               <a href="index.php?cmd=share&contents_id=<?php echo $contents_id;?>">Share </a>
                                                                <a href="javascript:void();" class="button">
                                                                   <?=get_shared_count($db,$contents_id)?>
                                                                </a>
                                                        </div>
                                                        <script language="javascript">
                                                            $("#shared_list_<?=$arr[$i]['id']?>").wTooltip({ 
                                                             ajax: "tooltip_ajax_shared_users_list.php?id=<?=$contents_id?>", 
                                                                     fadeIn: 600, 
                                                                     fadeOut: "slow",
                                                                     delay:1000                         
                                                            }); 
                                                        </script>
                                                
                                                </div>
                                               <!-- ----/Share-- -->
                                            </li>
                                            <li>
                                               <!-- ----Comment----- -->
                                                 <div style="float:right;">
                                                        
                                                        <?php
                                                           $contents_id = $arr[$i]['id'];
                                                          
                                                        ?>
                                                        <div id="comments_list_<?=$arr[$i]['id']?>">
                                                                <a href="javascript:void();" class="button">
                                                                   Comments <?=get_comments_count($db,$contents_id)?>
                                                                </a>
                                                        </div>
                                                        <script language="javascript">
                                                            $("#comments_list_<?=$arr[$i]['id']?>").wTooltip({ 
                                                             ajax: "tooltip_ajax_comments_users_list.php?id=<?=$contents_id?>", 
                                                                     fadeIn: 600, 
                                                                     fadeOut: "slow",
                                                                     delay:1000                         
                                                            }); 
                                                        </script>
                                                
                                                
                                                </div>
                                               <!-- ----/Comment-- -->                                        
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- /.col-md-6 -->
                            </div>
                        </div>
                            
                        <div class="row post-box">
                            <div class="col-md-2 padding-0 status-pic">
                               <a href="../profile/index.php?username=<?=get_username($db,$arr[$i]['users_id'])?>">
                                <div class="img">
                                    <img src="<?php echo get_file_picture($db,$arr[$i]['users_id']); ?>" alt="img" class="img-responsive">
                                    <br>
                                    <span class="nameuser"><?php echo get_users_name($db,$arr[$i]['users_id']);?></span>
                                  
                                </div>
                               </a>   
                            </div>
                            <!-- /.col-md-2 -->
                            <div class="col-md-10 post-status">
                                <div class="post-text post-img">
                                 <div class="statusbox">
                                      <div class="vi-name">
                                    <?php
                                        echo get_users_name($db,$arr[$i]['users_id']);
                                    ?> 
                                    </div>  
                                    <div>
                                         <?php
                                         $url = trim($arr[$i]['content']);//'https://www.youtube.com/watch?v=qfUcKIfTtwM';
									    if(preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match))
										{
											$id = $match[1];
										
										$width = '800px';
										$height = '450px';
										 ?>
                                         <iframe id="ytplayer" type="text/html" width="<?php echo $width ?>" height="<?php echo $height ?>"
                                        src="https://www.youtube.com/embed/<?php echo $id ?>?rel=0&showinfo=0&color=white&iv_load_policy=3"
                                        frameborder="0" allowfullscreen></iframe> 

                                         <?php		
											}
											elseif($arr[$i]['content_type'] == "link")
                                            {
                                        ?>
                                           <iframe style="width:100%;height:100%;" src="<?=$arr[$i]['content']?>" sandbox="allow-forms allow-scripts"></iframe>
                                        <?php                           
                                            }
                                            else
                                            {
                                        ?>  
                                         <?=$arr[$i]['content']?>                 
                                         <?php
                                            }
                                         ?>
                                       
                                         
                                     <?php                                     
                                       if(get_content_owner_id($db,$arr[$i]['id'])==$_SESSION['users_id'])
                                       {
                                     ?>
                                       
                                     <?php
                                       }
                                     ?>
                                   </div>                   
                                  </div>
                                 
                                                      
                                   
                                   <?php
                                      //get all comments
                                      unset($info);
                                      unset($data);
                                    $info["table"] = "comments";
                                    $info["fields"] = array("comments.*"); 
                                    $info["where"]   = "1 AND contents_id='".$arr[$i]['id']."' ORDER BY id DESC";
                                    $arr_comments =  $db->select($info);
                                    for($m=0;$m<count($arr_comments);$m++)
                                    {
                                        ?>
                                    <div class="vi-comment-box">
                                     <div class="vi-name">
                                       <span class="comment-img"><img src="<?php echo get_file_picture($db,$arr_comments[$m]['users_id']); ?>" alt="" class="img-responsive"></span>  <?php echo get_users_name($db,$arr_comments[$m]['users_id']); ?>
                                     </div>   
                                     
                                     <div class="vi-date">
                                         <?php echo $arr_comments[$m]['date_time_created']; ?>
                                     </div>
                                     <div class="vi-comment">
                                         <?php echo $arr_comments[$m]['comment']; ?>
                                     </div>
                                     <?php                                      
                                       if(get_content_owner_id($db,$arr[$i]['id'])==$_SESSION['users_id']  
                                                || $arr_comments[$m]['users_id']==$_SESSION['users_id'] )
                                       {
                                         
                                          echo '<a class="vi-delete" href="index.php?cmd=delete_comments&id='.$arr_comments[$m]['id'].'">Delete</a>';
                                          echo "<br>";
                                       }
                                       ?>
                                    </div>
                                      
                                        
                                        
                                    
                                    <?php
                                    }
                                   ?>
                                   <div class="bdr-top1">
                                       <form action="" class="col-lg-12 padding-left-0  comment-box" method="post">
                                      
                                      <span class="form-group">
                                            <textarea name="comment" id="" placeholder="Comments"
                                                      class="form-control"></textarea>
                                            <span class="image-up">
                                                <a href="#"><i class="fa fa-camera"></i></a>
                                            </span>
                                            <!-- /.image-up -->
                                        </span>
                                        <!-- /.form-group -->
                                      
                                      <input type="hidden" name="cmd" value="add_comment" />
                                      <input type="hidden" name="users_id" value="<?=$_SESSION['users_id']?>" />
                                      <input type="hidden" name="contents_id" value="<?=$arr[$i]['id']?>" />
                                      <br />
                                      <input type="submit" class="btn btn-default btn-lg" value="Send">
                                   </form> 
                                   </div>
                                    
                                </div>
                                <!-- /.post-text -->
                            </div>
                            <!-- /.col-md-10 -->
                        </div>
                        <!-- /.row -->
                        <?php
                            }
                        ?>
                        
                         <!-- --Pagination---- -->
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
                      <!-- -----Pagination--- -->
                       
                    </div>
                    <div class="col-md-3 dashboard-right">
                       <form class="search-bar " role="search">
                        <input type="text" class="form-control" placeholder="Search">             
  						<button type="submit" class="btn btn-default search-but">Search</button>
                       </form>
                            <!-- <div class="event-box">
                                <div class="heading">
                                    <h3>Events</h3>
                                </div>
                                <div class="body">
                                    <div class="row">
                                        <div class="col-md-8">
                                           Events in  <?=$_SESSION['city']?><br>
                                         <?php
                                              unset($info);
                                              unset($data);
                                            $info["table"] = "events";
                                            $info["fields"] = array("events.*"); 
                                            $info["where"]   = "1 AND venue_city='".$city."' AND end_date='".date("Y-m-d")."'";
                                            $arrevents =  $db->select($info);
                                            if(count($arrevents)>0)
                                              {
                                         
                                                  for($i=0;$i<count($arrevents);$i++)
                                                  {
                                                    $Id = $arrevents[$i]['id'];
                                                    ob_start();
                                                    include("../profile/event_template.php");
                                                    $content = ob_get_clean();
                                                    echo $content;
                                                  }
                                            }
                                          ?>
                                        </div>
                                    </div>
                                </div>
                            </div> -->



                            <!-- /.event-box-->

                            <div class="event-box">
                                
                                <div class="body">
                                    <div class="row">                                       
                                        <div class="col-md-12 bdr-hidden">
                                           <p class="event-city-name">Upcoming Events in  <?=$_SESSION['city']?></p>

                                              <!-- ---------Start------- -->
                                               <div class="event-bar">
											   <div class="heading">
                                    <h3>Events</h3>
                                </div>
                                 <?php
										  unset($info);
										  unset($data);
										$info["table"] = "events";
										$info["fields"] = array("events.*"); 
										$info["where"]   = "1 AND venue_city='".$city."' AND end_date>='".date("Y-m-d")."'";
										$arrevents =  $db->select($info);
										if(count($arrevents)>0)
										  {
											  for($i=0;$i<count($arrevents);$i++)
											  {
												$id                 = $arrevents[$i]['id'];  
												$ticket_name        = $arrevents[$i]['ticket_name'];
												$venue_name         = $arrevents[$i]['venue_name'];
												$venue_post_code    = $arrevents[$i]['venue_post_code'];
												$start_date         = $arrevents[$i]['start_date'];
												$start_time_hr      = $arrevents[$i]['start_time_hr'];
												$start_time_min     = $arrevents[$i]['start_time_min'];
												$start_am_pm        = $arrevents[$i]['start_am_pm'];
												$end_date           = $arrevents[$i]['end_date'];
												$end_time_hr        = $arrevents[$i]['end_time_hr']; 
												?>
												<div class="event-list">
													<span class="event-date"><?=$start_date?> <?=$start_time_hr?>:<?=$start_time_min?> <?=$start_am_pm?> <br> set</span>
													<span class="event-name"> <b><?=$ticket_name?></b><?=$venue_name?><br></span>
													<a class="goonevent" href="../home?cmd=event_details&id=<?=$id?>">>></a>
												</div>
												<?php
											  }
										}
                                  ?>
                                 <!-- ---------End----------- -->
                                        </div>
                                    </div>
                                </div>
                                <!-- /.body -->
                            </div>
                            <!-- /.event-box-->
                            <div class="add-sec">
                                <img src="../v1/img/ads-img-1.jpg" alt="" class="img-responsive">
                            </div>
                            <div class="add-sec">
                                <img src="../v1/img/ads-img-2.jpg" alt="" class="img-responsive">
                            </div>
                        </div>
                        <!-- /.right-box -->
                    </div>
                    <!-- /.col-md-3 -->
                </div>
                <!-- /.row -->
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</section>
<div>
<?php
   include("../template/footer.php");
?>

