
<script language="javascript">
       setInterval(function() {
            update_plus_login();
        }, 1000*60*5);
		function update_plus_login()
		{  
		    $.ajax({
					type: "POST",
					url: "login/update_plus_login",
					data: {
						cmd  : "update_online_offline"
					 },
					success: function(data) {
					}//success
				});//ajax
		}
</script>
