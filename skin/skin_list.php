<?php
   include("../template/header.php");
?>
<div class="page-section">
  <div class="row">
    <div class="col-md-10 col-lg-8 col-md-offset-1 col-lg-offset-2">

      <h4 class="page-section-heading">Skin</h4>
      <div class="panel panel-default">
  <table class="table v-middle">   
   <tr>
   <td> 
		<a href="skin.php?cmd=edit"   class="btn btn-primary">Add a skin</a>
		 <table class="table v-middle">
			<tr bgcolor="#ABCAE0">
			  <td>Users </td>
			  <td>Background Image</td>
			  <td>Status</td>
			  <td>Action</td>
			</tr>
		 <?php
				
				if($_SESSION["search"]=="yes")
				  {
					$whrstr = " AND ".$_SESSION['field_name']." LIKE '%".$_SESSION["field_value"]."%'";
				  }
				  else
				  {
					$whrstr = "";
				  }
				  
		        $whrstr = " AND users_id='".$_SESSION['users_id']."'";
				 
				$rowsPerPage = 10;
				$pageNum = 1;
				if(isset($_REQUEST['page']))
				{
					$pageNum = $_REQUEST['page'];
				}
				$offset = ($pageNum - 1) * $rowsPerPage;  
		 
		 
							  
				$info["table"] = "skin";
				$info["fields"] = array("skin.*"); 
				$info["where"]   = "1   $whrstr ORDER BY id DESC  LIMIT 0, 1";
									
				
				$arr =  $db->select($info);
				
				for($i=0;$i<count($arr);$i++)
				{
				
				   $rowColor;
		
					if($i % 2 == 0)
					{
						
						$row="#C8C8C8";
					}
					else
					{
						
						$row="#FFFFFF";
					}
				
		 ?>
			<tr bgcolor="<?=$row?>" onmouseover=" this.style.background='#ECF5B6'; " onmouseout=" this.style.background='<?=$row?>'; ">
			  <td>
					<?php
                        unset($info2);        
                        $info2['table']    = users;	
                        $info2['fields']   = array("*");	   	   
                        $info2['where']    =  "1 AND id='".$arr[$i]['users_id']."' LIMIT 0,1";
                        $res2  =  $db->select($info2);
                        echo $res2[0]['first_name'].' '.$res2[0]['last_name'];	
                    ?>
               </td>
			  <td> <img src="../<?=$arr[$i]['background_image']?>" style="width:100px;" /></td>
			  <td><?=$arr[$i]['status']?></td>
			  
			  <td nowrap >
                    <a href="skin.php?cmd=edit&id=<?=$arr[$i]['id']?>" class="btn default btn-xs purple"><i class="fa fa-edit"></i>Edit</a> 
                    <a href="skin.php?cmd=delete&id=<?=$arr[$i]['id']?>" class="btn btn-sm red filter-cancel"  onClick=" return confirm('Are you sure to delete this item ?');"><i class="fa fa-times"></i>Delete</a> 
			 </td>
		
			</tr>
		<?php
				  }
		?>
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
