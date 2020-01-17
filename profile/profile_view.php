<?php
   include("../template/header.php");
?>
<script type="text/javascript" src="../js/jquery.js"></script>
<script language="javascript" src="../js/wtooltip.js"></script> 

<script type="text/javascript" src="../tinybox2/tinybox.js"></script>
<link rel="stylesheet" type="text/css" href="../tinybox2/style.css" />

<script type="text/javascript">
	function popUp(url)
	{ 
	  var parentWindow = window;
	  TINY.box.show({iframe:url,closejs:function(){parentWindow.location.reload()},boxid:'frameless',width:850,height:650,fixed:false,maskid:'bluemask',maskopacity:40});
	} 
</script>


<?php
$users_id_list = get_friend_users_id_list($db,$_SESSION['users_id']); 
	echo "<script  language=\"javascript\">var users_id_list=\"$users_id_list\";</script>";
?>   
    
<script language="javascript">
       setInterval(function() {
            online_status();
        }, 1000*60*1);
		function online_status()
		{ 
		    $.ajax({
					type: "POST",
					url: "../who_is_online/online_offline.php",
					data: {
					    users_id_list : users_id_list,
						cmd           : "online_offline"
					 },
					success: function(data) {
						 var obj = JSON.parse(data);

						 for(var i=0;i<obj.length;i++)
						 {
						    id = obj[i].id;
							status   = obj[i].status;
							
							if(status=='online')
							{
							  $("#online_offline_"+id).html('<img src="../who_is_online/online.gif" style="width:20px;">');
							}
							if(status=='offline')
							{
							  $("#online_offline_"+id).html('<img src="../who_is_online/offline.gif" style="width:20px;">');
							}
						 }
					}//success
				});//ajax
		}
</script>
<?php
	   unset($info);
	$info["table"] = "users LEFT OUTER JOIN contents ON(contents.users_id=users.id)";
	$info["fields"] = array("users.*,contents.*,users.id as users_id"); 
	$info["where"]   = "1 AND users.username='".$_REQUEST['username']."' ORDER BY contents.id DESC LIMIT 0,1";
	$arr =  $db->select($info);
	
	$users_id = $arr[0]['users_id'];
	$city = $arr[0]['city'];
	add_views($db,$users_id);
	
	if(empty($arr[0]['file_cover']))
	{
		$cover = "../images/profile-cover.jpg";	
	}
	else
	{
		$cover = "../".$arr[0]['file_cover'];	
	}
?>
 <style>
	  .top-area .profile-area {
		  background-image: url('<?=$cover?>');
		  background-repeat: no-repeat;
		  background-size: cover;
		  height: 350px;
		  position: relative;
		  padding-top: 7%;
		  padding-left: 5%;
		}
 </style>
  <section class="top-area">
    <div class="width-full">
	<div class="profile-agr">
        <div class="row">
            <div class="col-md-3">
			<div class="profile-img">
			<img src="<?php echo get_file_picture($db,$users_id); ?>" alt="" class="img-responsive img-circle">
			<h2 class="name"><?=$arr[0]['first_name']?> <?=$arr[0]['last_name']?></h2>
			<p>Project Manager at Tech Cental Solution</p>
			<div class="flrty">
                <a href="#" class="change-skin-btn btn btn-primary pull-right follow-btn">Follow</a>
				<a href="../skin/skin.php?cmd=list" class="change-skin-btn btn btn-primary pull-right">Set Skin</a>
				<a href="../messages/messages.php?cmd=edit" class="change-skin-btn btn btn-primary pull-right">Message</a>
			    <a href="../event/index.php?cmd=edit" class="change-skin-btn btn btn-primary pull-right">Event</a>
            </div>
			</div>
			</div>
			
			<div class="col-md-6">
			<div class="profile-vidoes">
			<iframe width="560" height="315" src="" frameborder="0" allowfullscreen></iframe>
			<!--<img class="resposnive" src="v1/img/vidoes.png">-->
			</div>
			</div>
			<div class="col-md-3">
			<div class="profile-name">
			<div id="graph-wrapper">
	<div class="graph-info">
		<a href="javascript:void(0)" class="visitors">Visitors</a>
		<a href="javascript:void(0)" class="returning">Returning Visitors</a>

		<a href="#" id="bars"><span></span></a>
		<a href="#" id="lines" class="active"><span></span></a>
	</div>

	<div class="graph-container">
		<div id="graph-lines"></div>
		<div id="graph-bars"></div>
	</div>
</div>
			</div>
			</div>
			</div>
			<div class="profile">
                               
                                
                                <div class="profile-menu">
                                    <ul class="list-inline nav nav-tabs">
                                        <li class=""><a data-toggle="tab" href="#about"><i class="fa fa-user"></i> About Me</a>
                                        </li>
                                        <li><a data-toggle="tab" href="#photo"><i class="fa fa-picture-o"></i> Photo</a>
                                        </li>
                                        <li><a data-toggle="tab" href="#friends"><i class="fa fa-users"></i> Friends</a>
                                        </li>
                                        <li><a data-toggle="tab" href="#bookmark"><i class="fa fa-bookmark-o"></i> Bookmarks</a>
                                        </li>
                                        <li><a data-toggle="tab" href="#views"><i class="fa fa-eye"></i> Views</a></li>
                                    </ul>
                                </div>
                                
                            </div>
							</div>
			</div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</section>
<!-- /.<section class="top-area"> -->

<section>
    <div class="container">
        <div class="tab-content positionr">
            <div id="about" class="tab-pane fade in ">
                <div class="col-md-6">
                    <div class="about-box">
                        <div class="heading">
                            <h2>About</h2>
                        </div>
                        <div class="body">
                            <ul>
                              <li> <?=$arr[0]['first_name']?> <?=$arr[0]['last_name']?> </li>
                              <li> <i class="fa fa-graduation-cap"></i> Date of Birth:<?=$arr[0]['date_of_birth']?></li>
                              <li> <i class="fa fa-graduation-cap"></i> Email:<?=$arr[0]['email']?></li>
                              <li> <i class="fa fa-graduation-cap"></i> Phone:<?=$arr[0]['phone']?></li>
                              <li> <i class="fa fa-graduation-cap"></i> Gender:<?=$arr[0]['gender']?></li>
                              <li> <i class="fa fa-home"></i>Hobby:<?=$arr[0]['hobby']?></li>
                              <li> <i class="fa fa-briefcase"></i>Works at:<?=$arr[0]['works_at']?></li>
                              <li> <i class="fa fa-briefcase"></i>Occupation:<?=$arr[0]['occupation']?></li>
                              <li> <i class="fa fa-map-marker"></i>Lives in:<?=$arr[0]['lives_in']?></li>
                              <li> <i class="fa fa-map-marker"></i>City:<?=$arr[0]['city']?></li> 
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <p>
                    <?=$arr[0]['about_me']?><br>
                    <?=$arr[0]['works_at']?><br>
                    </p>
                    <?php
						if($users_id==$_SESSION['users_id'])
						{
					 ?>
						 <a href="javascript:void();" onclick="popUp('../editprofile/index.php?cmd=edit&id=<?=$_SESSION['users_id']?>');" class="btn btn-primary tabbtn"> Edit </a>
					 <?php
						}
					 ?>
                </div>
            </div>
            <div id="photo" class="tab-pane fade in ">
                <div class="row">
                    <div class="col-md-12">
                        <div class="heading">
                            <h3>Photo</h3>
                        </div>
                    </div>
                </div>
                <div class="body">
                     <?php
							  unset($info);               
							$info["table"] = "photos";
							$info["fields"] = array("photos.*"); 
							$info["where"]   = "1   AND users_id='".$users_id."' ORDER BY id DESC ";
							$arrphoto =  $db->select($info);
                    ?>
                    <div class="row rowself-5">
                    <?php
							for($i=0;$i<count($arrphoto);$i++)
							{
                     ?>
                    <div class="col-md-2 colself-5 colself-5-img">
                        <img style="background-image:url(../<?=$arrphoto[$i]['file_photo']?>);" class="img-same img-responsive">
                    </div>
                    <?php
							}
                    ?>
                    </div>
					 <?php
                        if($arr[0]['users_id']==$_SESSION['users_id'])
                        {
                      ?>
                          <a href="javascript:void();" onclick="popUp('../photos/photos.php?cmd=list');" class="btn btn-primary tabbtn"> Add/Remove Photos </a>
                      <?php
                        }
                      ?>
                </div>
            </div>
            <div id="friends" class="tab-pane fade in ">
                <div class="row">
                    <div class="col-md-12">
                        <div class="heading">
                            <h3>Friends</h3>
                        </div>
                    </div>
                </div>
                <div class="body">
                    <div class="row">
                        <?php
                             
                                   unset($info);
								   unset($data);          
                                $info["table"] = "friends LEFT OUTER JOIN users ON(friends.friend_users_id=users.id)";
                                $info["fields"] = array("friends.*,users.*"); 
                                $info["where"]   = "1   AND friends.users_id='".$users_id."'
								                        AND friends.friend_status='accept'  ORDER BY friends.id DESC ";
                                $arrfriend =  $db->select($info);
                                
                                for($i=0;$i<count($arrfriend);$i++)
                                {
									  unset($info);
									  unset($data);
									$info["table"]     = "plus_login";
									$info["fields"]   = array("*");
									$info["where"]    = "1=1 AND users_id='".$arrfriend[$i]['friend_users_id']."'";
									$res  = $db->select($info); 
									$status = $res[0]['status'];
									if($status=='online')
									{
									   $status = '<img src="../who_is_online/online.gif" style="width:20px;">';
									}
									else
									{
										 $status = '<img src="../who_is_online/offline.gif" style="width:20px;">';
									}
						?>
                                  <div class="col-md-3">
                                    <div class="friend-profile">
                                        <div class="pro-box img make-crl">
                                            <img src="<?php echo get_file_picture($db,$arrfriend[$i]['id']); ?>" alt="" class="responsive  img-circle">
                                        </div>
                                        <div class="pro-box text">
                                            <h4>
                                                <a class="friendname-a" href="../profile/index.php?username=<?=$arrfriend[$i]['username']?>">
                                                  <?=$arrfriend[$i]['first_name']?> <?=$arrfriend[$i]['last_name']?> 
                                                  <div  id="online_offline_<?=$arrfriend[$i]['id']?>"><?=$status?></div>
                                                </a> 
                                            </h4>
                                            <p>Location <?=$arrfriend[$i]['city']?></p>
                                            <a href="../messages/messages.php?to_users_id=<?=$arrfriend[$i]['id']?>" class="btn btn-primary send-msg">Send Message</a>
                                        </div>
                                    </div>
                                    <!-- /.friend-profile -->
                                </div>
                                <!-- /.col-md-4 -->
                            
                        <?php
                                  }
                        ?>
                         
                    </div>
                    <?php
                            if($users_id==$_SESSION['users_id'])
                            {
                          ?>
                              <a href="javascript:void();" onclick="popUp('../friends/friends.php?cmd=search_view');" class="btn btn-primary tabbtn"> Find Friends </a>
                          <?php
                            }
                          ?> 
                </div>
            </div>
            <div id="bookmark" class="tab-pane fade in ">
                <div class="row">
                    <div class="col-md-12">
                        <div class="heading">
                            <h3>Bookmark</h3>
                        </div>
                    </div>
                </div>
                <div class="body">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci cumque dicta doloremque dolorum eligendi facere fugit ipsam ipsum libero maxime nisi non omnis quia quo quos repellendus unde voluptate, voluptates!</p>
                </div>
            </div>
            <div id="events" class="tab-pane fade in ">
                <div class="row">
                    <div class="col-md-12">
                        <div class="heading">
                            <h3>Events</h3>
                        </div>
                    </div>
                </div>
                <div class="body">
                    <p>
                     
                      Upcoming Events in  <?=$city?> <br> 
                      <a href="../event/index.php?cmd=list" class="btn btn-primary">Manage Events</a> <br>
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
                                $Id = $arrevents[$i]['id'];
                                ob_start();
                                include("event_template.php");
                                $content = ob_get_clean();
                                echo $content;
                              }
                        }
                      ?>
                    </p>
                </div>
            </div>
            <div id="views" class="tab-pane fade in ">
                <div class="row">
                    <div class="col-md-12">
                        <div class="heading">
                            <h3>Views</h3>
                        </div>
                    </div>
                </div>
                <div class="body">
                    <div>
                        <p class="viewp1"><?php echo get_views_count($db,$users_id);?> </p>
                       <?php
							  unset($info);	
							  unset($data);	
						  $info["table"] = "views LEFT OUTER JOIN users ON(views.users_id=users.id)";
						  $info["fields"] = array("views.*"); 
						  $info["where"]   = "1 AND users_id='".$users_id."'";
						  $res  = $db->select($info);  
						   for($i=0;$i<count($res);$i++)
						   {
                        ?>    
							<p class="viewp2"> <?php  echo get_users_name($db,$res[$i]['viwers_users_id']); ?></p>
							  
						<?php
                           }
					   ?>
                    </div>
                </div>
            </div>
            
            <div id="weights" class="tab-pane fade in ">
                <div class="row">
                    <div class="col-md-12">
                        <div class="heading">
                            <h3>Weight</h3>
                        </div>
                    </div>
                </div>
                <div class="body">
                    <p>
                      <?php echo get_page_weights($db,$users_id);?>
                    </p>
                </div>
            </div>
            
        </div>
    </div>
</section>

<section class="main-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="send-post-area">
                    <form action="" class="message-form" role="form" method="post">
                        <div class="heading">
                            <h3 class="active">Post</h3>

                            <h3>Photo / Post</h3>
                        </div>
                        <div class="form-group">
                            <textarea name="content" id="content" class="form-control"
                                      placeholder="What's your mind..."></textarea>
                        </div>     
                        <input type="hidden" name="cmd" value="video_add" />  
                        <input type="submit" value="Submit" class="btn btn-default btn-lg" />
                        <div class="clearfix"></div>
                    </form>
                    <div class="clearfix"></div>
                </div>
                <!-- /.send-post-area -->
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</section>

<section class="new-feed-area">
    <div class="container">
       <?php
	    $rowsPerPage = 21;
		$pageNum = 1;
		if(isset($_REQUEST['page']))
		{
			$pageNum = $_REQUEST['page'];
		}
		$offset = ($pageNum - 1) * $rowsPerPage;
			unset($info);
		$info["table"] = "users LEFT OUTER JOIN contents ON(contents.users_id=users.id)";
		$info["fields"] = array("users.*,contents.*,users.id as users_id"); 
		$info["where"]   = "1 AND users.username='".$_REQUEST['username']."' ORDER BY contents.id DESC  LIMIT $offset, $rowsPerPage";
		$arr =  $db->select($info);
	    for($i=0;$i<count($arr);$i++)
		 {
	   ?>
        <div class="row margin-bottom makedash">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-7 padding-right-0">
                        <div class="post-box-heading">
                            <h3><?=get_users_name($db,$arr[$i]['users_id'])?></h3>
                        </div>
                    </div>
                    <div class="col-md-5 text-right padding-left-0">
                        <div class="post-box-heading">
                            <ul class="list-inline margin-0">
                                <li>
                                    <!-- delete -->
                                    <div style="float: right;">
                                        <?php                                      
                                           if(get_content_owner_id($db,$arr[$i]['id'])==$_SESSION['users_id'])
                                           {
                                          ?>
                                           <a href="index.php?cmd=delete&id=<?=$arr[$i]['id']?>&username=<?=$_REQUEST['username']?>">Delete</a>
                                          <?php
                                           }
                                          ?>  
                                    </div>
                                </li>
                                <li>
                                       <!-- ----Like- -->
                                        <div id="like_list_<?=$arr[$i]['id']?>" style="float: right;">
                                            <?php
                                            if(get_likes_users_id($db,$arr[$i]['id']) == 0)
                                            {
                                            ?>
                                            <a href="index.php?cmd=like&contents_id=<?=$arr[$i]['id']?>&username=<?=$_REQUEST['username']?>">Like <?=get_likes_count($db,$arr[$i]['id'])?> </a>  
                                            <?php
                                             }
                                             else
                                             {
                                            ?>
                                            <a href="index.php?cmd=unlike&contents_id=<?=$arr[$i]['id']?>&username=<?=$_REQUEST['username']?>">Unlike <?=get_likes_count($db,$arr[$i]['id'])?> </a> 
                                            <?php
                                            }
                                            ?>
                                        </div>
                                        <script language="javascript">
                                            $("#like_list_<?=$arr[$i]['id']?>").wTooltip({ 
                                             ajax: "../home/tooltip_ajax_likes_users_list.php?id=<?=$arr[$i]['id']?>", 
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
                                                       <a href="index.php?cmd=share&contents_id=<?php echo $contents_id;?>&username=<?=$_REQUEST['username']?>">Share </a>
                                                        <a href="javascript:void();" class="button">
                                                           <?=get_shared_count($db,$contents_id)?>
                                                        </a>
                                                </div>
                                                <script language="javascript">
                                                    $("#shared_list_<?=$arr[$i]['id']?>").wTooltip({ 
                                                     ajax: "../home/tooltip_ajax_shared_users_list.php?id=<?=$contents_id?>", 
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
                                                     ajax: "../home/tooltip_ajax_comments_users_list.php?id=<?=$contents_id?>", 
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
                <div class="row post-box">
                    <div class="col-md-2 padding-0 status-pic">
                        <a href="../profile/index.php?username=<?=get_username($db,$arr[$i]['users_id'])?>">
                            <div class="img">
                                <img src="<?php echo get_file_picture($db,$arr[$i]['users_id']); ?>" alt="img" class="img-responsive">
                                <br>
                               <p class="nameuser"> <?php echo get_users_name($db,$arr[$i]['users_id']);?> </p>
                            </div>
                         </a> 
                    </div>
                    <!-- /.col-md-2 -->
                    <div class="col-md-10 post-status">
                        <div class="post-text post-img">                           
                            <div class="statusbox">
                                <div class="vi-name">
                                     <?php
                                         echo get_users_name($db,$_SESSION['users_id']);
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
                                </div>
                                    
                            </div>
                                
                                 
                                       
                            
                            <!-- /.col-md-5 -->

                                                 
								
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
						                <?php echo get_users_name($db,$arr_comments[$m]['users_id']); ?>
                                    </div> 
                                    <div class="vi-date">
                                        <?php echo $arr_comments[$m]['date_time_created'];  ?>

                                    </div>
                                    <div class="vi-comment">
                                        <?php echo $arr_comments[$m]['comment'];  ?>
                                    </div>
                                    <?php
								        if(get_content_owner_id($db,$arr[$i]['id'])==$_SESSION['users_id']  
									            || $arr_comments[$m]['users_id']==$_SESSION['users_id'] )
									       {
										 
										      echo '<a class="vi-delete" href="index.php?cmd=delete_comments&id='.$arr_comments[$m]['id'].'&username='.$_REQUEST['username'].'">Delete</a>';
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
            </div>
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
						unset($info);
					$info["table"] = "users LEFT OUTER JOIN contents ON(contents.users_id=users.id)";
					$info["fields"] = array("count(*) as total_rows"); 
					$info["where"]   = "1 AND users.username='".$_REQUEST['username']."' ORDER BY contents.id DESC";
					$res  = $db->select($info);
                   
                    $numrows = $res[0]['total_rows'];
                    $maxPage = ceil($numrows/$rowsPerPage);
                    $self = 'index.php?cmd=list&username='.$_REQUEST['username'];
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
</section>
<!-- /.new-feed-area -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script src="jquery.flot.min.js"></script>
<script>
$(document).ready(function () {

	// Graph Data ##############################################
	var graphData = [{
			// Visits
			data: [ [6, 1300], [7, 1600], [8, 1900], [9, 2100], [10, 2500], [11, 2200], [12, 2000], [13, 1950], [14, 1900], [15, 2000] ],
			color: '#71c73e'
		}, {
			// Returning Visits
			data: [ [6, 500], [7, 600], [8, 550], [9, 600], [10, 800], [11, 900], [12, 800], [13, 850], [14, 830], [15, 1000] ],
			color: '#77b7c5',
			points: { radius: 4, fillColor: '#77b7c5' }
		}
	];

	// Lines Graph #############################################
	$.plot($('#graph-lines'), graphData, {
		series: {
			points: {
				show: true,
				radius: 5
			},
			lines: {
				show: true
			},
			shadowSize: 0
		},
		grid: {
			color: '#646464',
			borderColor: 'transparent',
			borderWidth: 20,
			hoverable: true
		},
		xaxis: {
			tickColor: 'transparent',
			tickDecimals: 2
		},
		yaxis: {
			tickSize: 1000
		}
	});

	// Bars Graph ##############################################
	$.plot($('#graph-bars'), graphData, {
		series: {
			bars: {
				show: true,
				barWidth: .9,
				align: 'center'
			},
			shadowSize: 0
		},
		grid: {
			color: '#646464',
			borderColor: 'transparent',
			borderWidth: 20,
			hoverable: true
		},
		xaxis: {
			tickColor: 'transparent',
			tickDecimals: 2
		},
		yaxis: {
			tickSize: 1000
		}
	});

	// Graph Toggle ############################################
	$('#graph-bars').hide();

	$('#lines').on('click', function (e) {
		$('#bars').removeClass('active');
		$('#graph-bars').fadeOut();
		$(this).addClass('active');
		$('#graph-lines').fadeIn();
		e.preventDefault();
	});

	$('#bars').on('click', function (e) {
		$('#lines').removeClass('active');
		$('#graph-lines').fadeOut();
		$(this).addClass('active');
		$('#graph-bars').fadeIn().removeClass('hidden');
		e.preventDefault();
	});

	// Tooltip #################################################
	function showTooltip(x, y, contents) {
		$('<div id="tooltip">' + contents + '</div>').css({
			top: y - 16,
			left: x + 20
		}).appendTo('body').fadeIn();
	}

	var previousPoint = null;

	$('#graph-lines, #graph-bars').bind('plothover', function (event, pos, item) {
		if (item) {
			if (previousPoint != item.dataIndex) {
				previousPoint = item.dataIndex;
				$('#tooltip').remove();
				var x = item.datapoint[0],
					y = item.datapoint[1];
					showTooltip(item.pageX, item.pageY, y + ' visitors at ' + x + '.00h');
			}
		} else {
			$('#tooltip').remove();
			previousPoint = null;
		}
	});

});
</script>
<?php   
   include("../template/footer.php");
?>                      

