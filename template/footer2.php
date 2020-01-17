</div>
</div>
</div>
</div>
</div>
<!-- BEGIN FOOTER -->
<div class="page-footer">
	<div class="page-footer-inner">
		 2014 &copy; Metronic by keenthemes. <a href="http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes" title="Purchase Metronic just for 27$ and get lifetime updates for free" target="_blank">Purchase Metronic!</a>
	</div>
	<div class="scroll-to-top">
		<i class="icon-arrow-up"></i>
	</div>
</div>
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="../v4.0.1/theme/assets/global/plugins/respond.min.js"></script>
<script src="../v4.0.1/theme/assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="../v4.0.1/theme/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="../v4.0.1/theme/assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="../v4.0.1/theme/assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="../v4.0.1/theme/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../v4.0.1/theme/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="../v4.0.1/theme/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="../v4.0.1/theme/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="../v4.0.1/theme/assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="../v4.0.1/theme/assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="../v4.0.1/theme/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<script src="../v4.0.1/theme/assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="../v4.0.1/theme/assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="../v4.0.1/theme/assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="../v4.0.1/theme/assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script>
      jQuery(document).ready(function() {    
         Metronic.init(); // init metronic core components
Layout.init(); // init current layout
QuickSidebar.init(); // init quick sidebar
Demo.init(); // init demo features
      });
   </script>
<!-- END JAVASCRIPTS -->



<script language="javascript">
       setInterval(function() {
            update_plus_login();
        }, 1000*60*5);
		function update_plus_login()
		{  
		    $.ajax({
					type: "POST",
					url: "../who_is_online/update_plus_login.php",
					data: {
						cmd  : "update_online_offline"
					 },
					success: function(data) {
					}//success
				});//ajax
		}
</script>


</body>
<!-- END BODY -->
</html>