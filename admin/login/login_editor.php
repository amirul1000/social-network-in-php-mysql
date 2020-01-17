<?php
include("../template/login_header.php");
?>
<link
	rel="stylesheet" href="../../css/admin_style.css">
<form method="post">
	<table align="center" cellspacing="3" cellpadding="3" align="center">
		<tr>
			<td colspan="2"><span align="center"><font color="#FF0000"><?=$message?>
				</font> </span>
			</td>
		</tr>

		<tr>
			<td>Userid(Email)</td>
			<td><input type="text" name="email" id="email" value=""
				class="textbox" /></td>
		</tr>
		<tr>
			<td>Password</td>
			<td><input type="password" name="password" id="password" value=""
				class="textbox" /></td>
		</tr>
		<tr>
			<td></td>

			<td><input type="hidden" name="cmd" value="login" /> <input
				type="submit" name="submit" value="submit" />
			</td>
		</tr>
	</table>
</form>
<?php
include("../template/footer.php");
?>