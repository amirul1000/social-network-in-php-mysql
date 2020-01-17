<!-- BEGIN SIDEBAR -->
	<div class="page-sidebar-wrapper">
		<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
		<!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
		<div class="page-sidebar navbar-collapse collapse">
			<!-- BEGIN SIDEBAR MENU -->
			<!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
			<!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
			<!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
			<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
			<!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
			<!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
			<ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
				<!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
				<li class="sidebar-toggler-wrapper">
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
					<div class="sidebar-toggler">
					</div>
					<!-- END SIDEBAR TOGGLER BUTTON -->
				</li>
				<!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
				<li class="sidebar-search-wrapper">
					<!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
					<!-- DOC: Apply "sidebar-search-bordered" class the below search form to have bordered search box -->
					<!-- DOC: Apply "sidebar-search-bordered sidebar-search-solid" class the below search form to have bordered & solid search box -->
					<form class="sidebar-search " action="../friends/friends.php?cmd=search_view&come=nav" method="POST">
						<a href="javascript:;" class="remove">
						<i class="icon-close"></i>
						</a>
						<div class="input-group">
							<input type="text"  name="SearchText" class="form-control" placeholder="Search...">
							<span class="input-group-btn">
							<a href="javascript:;" class="btn submit"><i class="icon-magnifier"></i></a>
							</span>
						</div>
					</form>
					<!-- END RESPONSIVE QUICK SEARCH FORM -->
				</li>
				<li class="start ">
					<a href="../home">
					<i class="icon-home"></i>
					<span class="title">Home</span>
					</a>
				</li>
				
				<li class="active open">
					<a href="javascript:;">
					<i class="icon-rocket"></i>
					<span class="title">My Menu</span>
					<span class="selected"></span>
					<span class="arrow open"></span>
					</a>
					<ul class="sub-menu">
                          <li class=""><a href="../profile/index.php?username=<?=$_SESSION['username']?>"><i class="icon-user"></i> <span>My Profile</span></a></li>
                          <li class=""><a href="../change_password/"><i class="icon-settings"></i> <span>Change Password</span></a></li>
                          <li class=""><a href="../friends/friends.php?cmd=list"><i class="fa fa-group"></i> <span>My Friends</span></a></li>
                          <li class=""><a href="../event/index.php?cmd=list"><i class="fa fa-group"></i> <span>My Events</span></a></li>
                          <li class=""><a href="../contents/index.php?cmd=list"><i class="fa fa-group"></i> <span>My Contents</span></a></li>
                          <li class=""><a href="../shared/index.php?cmd=list"><i class="fa fa-group"></i> <span>My Shared Content</span></a></li>
                          <li class=""><a href="../messages/messages.php?cmd=list"><i class="icon-briefcase"></i> <span>Messages</span></a></li>
                          <li class=""><a href="../notifications/notifications.php?cmd=list"><i class="icon-briefcase"></i> <span>Notifications</span></a></li>
                          <li class=""><a href="../skin/skin.php?cmd=list"><i class="icon-briefcase"></i> <span>Skin</span></a></li>
                          <li class=""><a href="../feeds/feeds.php?cmd=list"><i class="icon-briefcase"></i> <span>Feeds</span></a></li>
                          <li class=""><a href="../comments/comments.php?cmd=list"><i class="icon-briefcase"></i> <span>Comments</span></a></li>
					</ul>
				</li>
				
			</ul>
			<!-- END SIDEBAR MENU -->
		</div>
	</div>
	<!-- END SIDEBAR -->