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
                      
                      
                        <div class="post-box-hbg">
                            <div class="row">
                                       <?php
											$Id = $_REQUEST['id'];
											if( !empty($Id ))
											{
												$info['table']    = "events";
												$info['fields']   = array("*");   	   
												$info['where']    =  "id='".$Id."'";		
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
										<div style="border:5px solid #6c6c6c;border-radius: 25px;background:#FFF;">
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
										</div>
										<br />
                                        
                                        
                                <!-- /.col-md-6 -->
                            </div>
                        </div>
                        
                        <!-- /.row -->
                        
                      
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

