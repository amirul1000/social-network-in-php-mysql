<!-- BEGIN TOP NAVIGATION MENU -->
		<div class="top-menu">
			<ul class="nav navbar-nav pull-right">
				<!-- BEGIN NOTIFICATION DROPDOWN -->
				<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                <?php
						$whrstr = " AND to_users_id='".$_SESSION['users_id']."'";
						 unset($info);
						$info["table"] = "notifications";
						$info["fields"] = array("notifications.*"); 
						$info["where"]   = "1   $whrstr AND read_status='unread'";
						$arr =  $db->select($info);
				?>
                
                
				<li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
					<i class="icon-bell"></i>
					<span class="badge badge-default">
					<?=count($arr)?> </span>
					</a>
                    
					<ul class="dropdown-menu">
						<li class="external">
							<h3><span class="bold"><?=count($arr)?> pending</span> notifications</h3>
							<a href="../notifications/notifications.php?cmd=list">view all</a>
						</li>
						<li>
							<ul class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283">
								
                               <?php
							    for($i=0;$i<count($arr);$i++)
				                   { 
                               ?> 
                                <li>
									<a href="../notifications/notifications.php?cmd=details&id=<?=$arr[$i]['id']?>">
									<span class="time"><?=date("F j Y",strtotime($arr[$i]['date_created']))?></span>
									<span class="details">
									<span class="label label-sm label-icon label-success">
									<i class="fa fa-plus"></i>
									</span>
									 <?=substr($arr[$i]['message'],0,100)?> </span>
									</a>
								</li>
								<?php
								  }
								?>  
							</ul>
						</li>
					</ul>
				</li>
				<!-- END NOTIFICATION DROPDOWN -->
				<!-- BEGIN INBOX DROPDOWN -->
				<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
				
                 <?php
			           unset($info);
					$info["table"] = "messages RIGHT OUTER JOIN  users ON (messages.from_users_id=users.id)";
					$info["fields"] = array("users.*,messages.*"); 
					$info["where"]   = "1 AND messages.to_users_id='".$_SESSION['users_id']."' AND messages.read_status='unread'";
					$arr =  $db->select($info);
					
					$total = count($arr);
			    ?>
                <li class="dropdown dropdown-extended dropdown-inbox" id="header_inbox_bar">
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
					<i class="icon-envelope-open"></i>
					<span class="badge badge-default">
					<?=$total?> </span>
					</a>
					<ul class="dropdown-menu">
						<li class="external">
							<h3>You have <span class="bold"><?=$total?> New</span> Messages</h3>
							<a href="../messages/messages.php?cmd=list">view all</a>
						</li>
                       
						<li>
							<ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283">
								<?php
									for($i=0;$i<count($arr);$i++)
									{
								?>
                                <li>
									<a href="../messages/messages.php?cmd=details&id=<?=$arr[$i]['id']?>">
									<!--<span class="photo">
									<img src="../../assets/admin/layout3/img/avatar2.jpg" class="img-circle" alt="">
									</span>-->
                                     <?=$arr[$i]['first_name']?> <?=$arr[$i]['last_name']?>
									<span class="subject">
									<span class="time"><?=date("F j Y",strtotime($arr[$i]['date_created']))?></span>
									</span>
									<span class="message">
										<?=$arr[$i]['subject']?>
                                    </span>
									</a>
								</li>
								<?php
								   }
								?>   
							</ul>
						</li>
					</ul>
				</li>
				<!-- END INBOX DROPDOWN -->
			
                <li class="dropdown dropdown-user">
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
					 <?php
						$whrstr = " AND id='".$_SESSION['users_id']."'";
						$info["table"] = "users";
						$info["fields"] = array("users.*"); 
						$info["where"]   = "1   $whrstr";
						$arr =  $db->select($info);
			        ?>
                    <?php
				    if(empty($arr[0]['file_picture']))
						{
				   ?>
					   <img src="../images/default_man.png" width="60" alt="Bill" class="img-circle" />  
					<?php
						}
						else
						{
					?> 
					  <img src="../<?=$arr[0]['file_picture']?>" width="60" alt="Bill" class="img-circle" /> 
					<?php
					   }
					?> 					
                    
                    <span class="username username-hide-on-mobile">
					<?=$_SESSION['first_name']?> <?=$_SESSION['last_name']?> </span>
					<i class="fa fa-angle-down"></i>
					</a>
					<ul class="dropdown-menu dropdown-menu-default">
						<li>
							<a href="../profile/index.php?username=<?=$_SESSION['username']?>">
							<i class="icon-user"></i> My Profile </a>
						</li>							
						<li>
							<a href="../login/index.php?cmd=logout">
							<i class="icon-key"></i> Log Out </a>
						</li>
					</ul>
				</li>
				<!-- END USER LOGIN DROPDOWN -->
				<!-- BEGIN QUICK SIDEBAR TOGGLER -->
				<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
				<!--<li class="dropdown dropdown-quick-sidebar-toggler">
					<a href="javascript:;" class="dropdown-toggle">
					<i class="icon-logout"></i>
					</a>
				</li>-->
				<!-- END QUICK SIDEBAR TOGGLER -->
			</ul>
		</div>
		<!-- END TOP NAVIGATION MENU -->