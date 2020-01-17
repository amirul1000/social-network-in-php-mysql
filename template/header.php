<!doctype html>
<?php
  /////////update online//// 
  if(isset($_SESSION["users_id"]))
  {
	  unset($info);
	  unset($data);
	$info["table"]     = "plus_login";
	$data['ip']        = $_SERVER['REMOTE_ADDR'];
	$data['tm']        = time();
	$data['status']    = 'online';
	
	$info['data'] = $data;
	$info["where"]     = "1 AND users_id='".$_SESSION["users_id"]."'";
	$db->update($info); 
  }	
////////////////////////////////////	
?>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Dashboard page new</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="../v1/apple-touch-icon.png">
    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="../v1/css/normalize.css">
    <link rel="stylesheet" href="../v1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../v1/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Lato:400,300,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="../v1/css/main.css">
    <link rel="stylesheet" href="../v1/css/responsive.css">
    <script src="../v1/js/vendor/modernizr-2.8.3.min.js"></script>
    <script src="http://code.jquery.com/jquery-1.12.1.js" type="text/javascript"></script>
</head>
<body id="dashboard">
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="../v1/http://browsehappy.com/">upgrade
    your browser</a> to improve your experience.</p>
<![endif]-->
<header class="nav-down">
    <nav class="navbar navbar-inverse border-none border-radius custom-navbar-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                        aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../v1/#">Logo</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse" aria-expanded="false" style="height: 1px;">
                <ul class="nav navbar-nav navbar-right">
                    <li class="active"><a href="../home"><i class="fa fa-home"></i> Home</a></li>
                    
                     <?php
						   unset($info);
						   unset($data);
						$info["table"] = "messages RIGHT OUTER JOIN  users ON (messages.from_users_id=users.id)";
						$info["fields"] = array("users.*,messages.*"); 
						$info["where"]   = "1 AND messages.to_users_id='".$_SESSION['users_id']."' AND messages.read_status='unread'";
						$arr =  $db->select($info);
						
						$total = count($arr);
					?>
                    <li class="dropdown"><a href="../messages/messages.php?cmd=list" class="dropdown-toggle" data-toggle="dropdown"><i
                            class="fa fa-envelope-o"></i><span class="badge badge-default"><?=$total?></span> <span class="visible-xs">Messages</span></a>
                        <ul class="dropdown-menu dropdown-messages">
                            <?php
								for($i=0;$i<count($arr);$i++)
								{
							?>
                            <li>
                               <a href="../messages/messages.php?cmd=details&id=<?=$arr[$i]['id']?>">
                                    <div class="dropdown-messages-box">
                                        <div style="float:left;">
											<?=$arr[$i]['first_name']?> <?=$arr[$i]['last_name']?>
                                            <img alt="image" class="img-circle" src="../v1/img/profile-pic-1.jpg">
                                        </div>
                                        <div class="media-body">
                                            <strong><?=$arr[$i]['subject']?></strong>.
                                            <br>
                                            <small class="text-muted"><?=date("F j Y",strtotime($arr[$i]['date_created']))?></small>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <?php
							   }
							?>    
                        </ul>
						<script>
							if ($('ul.dropdown-messages li').length == 0) {
								$('.dropdown-messages').css({'display':'none'});
							}
						</script>
                    </li>
                    
                    <?php
						$whrstr = " AND to_users_id='".$_SESSION['users_id']."'";
						 unset($info);
						$info["table"] = "notifications";
						$info["fields"] = array("notifications.*"); 
						$info["where"]   = "1   $whrstr AND read_status='unread'";
						$arr =  $db->select($info);
				   ?>
                    <li class="dropdown"><a href="../notifications/notifications.php?cmd=list" class="dropdown-toggle" data-toggle="dropdown"><i
                            class="fa fa-bell-o"></i><span class="badge badge-default"><?=count($arr)?></span><span class="visible-xs">Notifications</span></a>
                        <ul class="dropdown-menu dropdown-alerts">
							<?php
								for($i=0;$i<count($arr);$i++)
								{ 
                            ?> 
                            <li>
                                <a href="../notifications/notifications.php?cmd=details&id=<?=$arr[$i]['id']?>">
                                    <div>
                                        <i class="fa fa-envelope fa-fw"></i> <?=substr($arr[$i]['message'],0,100)?>
                                        <span class="pull-right text-muted small"><?=date("F j Y",strtotime($arr[$i]['date_created']))?></span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <?php
							   }
							?>  
                        </ul>
						<script>
							if ($('ul.dropdown-alerts li').length == 0) {
								$('.dropdown-alerts').css({'display':'none'});
							}
						</script>
                    </li>

                    <li class="dropdown">
                        <a href="../profile/index.php?username=<?=$_SESSION['username']?>" class="profile-img-top dropdown-toggle" data-toggle="dropdown">
                            <?php
								$whrstr = " AND id='".$_SESSION['users_id']."'";
								 unset($info);
								$info["table"] = "users";
								$info["fields"] = array("users.*"); 
								$info["where"]   = "1   $whrstr";
								$arr =  $db->select($info);
							?>
							<?php
							if(empty($arr[0]['file_picture']))
								{
						   ?>
							   <img src="../images/default_man.png" width="60" alt="Bill" class="img-responsive img-circle" />  
							<?php
								}
								else
								{
							?> 
							  <img src="../<?=$arr[0]['file_picture']?>" width="60" alt="Bill" class="img-responsive img-circle" /> 
							<?php
							   }
							?>
                            <span class="text-uppercase"><?=$_SESSION['first_name']?> <?=$_SESSION['last_name']?></span>
                            <i class="caret-icon-dropdown-top fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="../login/index.php?cmd=logout">Log Out </a></li>
                            <li><a href="../profile/index.php?username=<?=$_SESSION['username']?>">My Profile</a></li>
                            <li><a href="../change_password/">Change Password</a></li>
                        </ul>
                    </li>
                </ul>
            </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
    </nav>
</header>
<?php
	$whrstr11 = " AND users_id='".$_SESSION['users_id']."'";
	$info["table"] = "skin";
	$info["fields"] = array("skin.*"); 
	$info["where"]   = "1   $whrstr11 ORDER BY id DESC  LIMIT 0, 1";
	$arrskin =  $db->select($info);
	$background_image = $arrskin[0]['background_image'];

?>
<?php
	if(count($arrskin)>0)
	{
	?><div>
	<!--<div style="background-image: url('../<?=$background_image?>');z-index:999;
    background-attachment: fixed;
    background-size: cover;
    background-position: center;">-->
	<?php
	}
?>   
        