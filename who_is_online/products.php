
<?php
$users_id_list =""; 
for($i=0;$i<count($resproducts);$i++)
	{
	   $products_id_list .= $resproducts[$i]['id'].",";
	   
	}   
	$products_id_list = substr($products_id_list,0,strlen($products_id_list)-1);
	echo "<script  language=\"javascript\">var products_id_list=\"$products_id_list\";</script>";
?>   
    
<script language="javascript">
       setInterval(function() {
            online_status();
        }, 1000*60*1);
		function online_status()
		{  
		    $.ajax({
					type: "POST",
					url: "http://www.0place.com/home/online_offline",
					data: {
					    products_id_list : products_id_list,
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
							  $("#online_offline_"+id).html('<img src="/home/online.gif">');
							}
							if(status=='offline')
							{
							  $("#online_offline_"+id).html('<img src="/home/offline.gif">');
							}
						 }
					}//success
				});//ajax
		}
</script>

    <!-- Sarch Result Frame -->
    <div class="col-lg-4 col-md-4" style="overflow:auto;position:relative;height:700px;">
    	<!-- PHP CODE -->
        <?php 
	for($i=0;$i<count($resproducts);$i++)
	{
?>
        <!-- END OF PHP CODE -->
        <!-- Search Result -->
        
        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12 map-container" style="margin-bottom:10px;">
            <div class="col-1g-12 col-md-12 col-xs-12 col-sm-12">
           		<h4><a href="details/index?cmd=details&id=<?=$resproducts[$i]['id']?>"><?=ucfirst($resproducts[$i]['product_title'])?></a></h2>by <?=strip_tags($resproducts[$i]['company_group'])?></h4><br /><?=number_format($resproducts[$i]['distance'], 2, '.', '')?>KM
            </div>
            <div class="col-lg-3 col-md-3 col-xs-3 col-sm-3 product-img" style="padding:20px;">
                    <img class="img-responsive" alt="Responsive image" src="<?=$resproducts[$i]['company_logo']?>" height="125" width="125"/>
            </div>
            <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4">
                	<ul class="list-unstyled">
                    	<li>Price: <?=$resproducts[$i]['price']?></li>
                        <li>Discount: $<?=$resproducts[$i]['discount']?></li>
                		<li>Net Price: $<?=$resproducts[$i]['net_price']?></li>
                   </ul>
            </div>
            <div class="col-lg-5 col-md-5 col-xs-5 col-sm-5">
                    <!--Online Offline-->
					<?php
					      unset($info);
						  unset($data);
						$info["table"]     = "plus_login";
						$info["fields"]   = array("*");
						$info["where"]    = "1=1 AND users_id='".$resproducts[$i]['users_id']."'";
						$res  = $db->select($info); 
						$status = $res[0]['status'];
						if($status=='online')
						{
						   $status = '<img src="/home/online.gif">';
						}
						else
						{
 						     $status = '<img src="/home/offline.gif">';
						}
					?>
                    <div  id="online_offline_<?=$resproducts[$i]['id']?>"><?=$status?></div>
                	
                    <ul class="list-unstyled">                   	
                        <li><?=strip_tags($resproducts[$i]['business_title'])?></li>
                        <li><?=strip_tags($resproducts[$i]['address'])?>,<?=strip_tags($resproducts[$i]['city'])?>,<?=strip_tags($resproducts[$i]['state'])?>,<?=strip_tags($resproducts[$i]['zip_code'])?>, <?=strip_tags($resproducts[$i]['country'])?></li>
                        <li><?=strip_tags($resproducts[$i]['land_phone'])?></li>
                        <li>Phone: <?=strip_tags($resproducts[$i]['cell_phone'])?></li>
                        <li>Email: <?=strip_tags($resproducts[$i]['email'])?></li>
                        <li><?=strip_tags($resproducts[$i]['latitude'])?></strong><?=strip_tags($resproducts[$i]['longitude'])?></li>
                    </ul>
            </div>
        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
        <button type="button" class="btn btn-primary">
            <a href="#myModal" role="button" data-toggle="modal">
                             Contact Supplier
            </a>
        </button>
        <button type="button" class="btn btn-info">
            <a href="#myModal" role="button" data-toggle="modal" onclick="set_to_users_id('<?=$resproducts[$i]['users_id']?>');">
                  <div id="to_users_id"  value="<?=$resproducts[$i]['users_id']?>">
                                 Leave a Messenger
            </a>
       </button>
        <button type="button" class="btn btn-warning">
        	<a href="#myModal" role="button" data-toggle="modal">
                                 Chat with Seller
            </a>
        </button>
        </div>
            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12 map-container" style="padding:10px;">
            <ul class="list-inline">
              <li><a href="#">Start Order</a></li>
			  <li><a href="#">Added to your Inquiry Cart</a></li>
			  <li><a href="#">Add to My Favorites</a></li>
            </ul>
            </div>
        </div>
<!-- PHP CODE -->
<?
	}
?>
	