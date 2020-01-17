<div class="clr"></div>
</div>
<footer class="text-center">
    <div class="container">
        <p><strong>Copyright</strong> <a href="">XXXX</a> &copy; 2015;</p>
    </div>
    <!-- /.container -->
</footer>

<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
<script>window.jQuery || document.write('<script src="../v1/js/vendor/jquery-1.12.0.min.js"><\/script>')</script>
<script src="../v1/js/plugins.js"></script>
<script src="../v1/js/bootstrap.min.js"></script>
<script src="../v1/js/tabulous.min.js"></script>
<script src="../v1/js/main.js"></script>

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
</html>

