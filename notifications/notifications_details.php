<?php
   include("../template/header.php");
?>
<div class="page-section">
  <div class="row">
    <div class="col-md-10 col-lg-8 col-md-offset-1 col-lg-offset-2">

      <h4 class="page-section-heading">Notifications</h4>
      <div class="panel panel-default">
<table class="table v-middle">
 <tr>
  <td>  
     <a href="notifications.php?cmd=list" class="btn btn-primary">List</a>
		<table class="table v-middle">
                     <tr>
						 <td valign="top">Message</td>
						 <td>
						    <?=$message?>
						 </td>
				     </tr>
                     <tr>
						 <td valign="top">Date</td>
						 <td>
						    <?=$date_created?>
						 </td>
				     </tr>
		</table>
  </td>
 </tr>
</table>
</div>
</div>
</div>
</div>
</div>

<?php
   include("../template/footer.php");
?>                      
