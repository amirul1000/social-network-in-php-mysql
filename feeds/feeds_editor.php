	<?php 
       include("../template/header.php");
    ?>
    <div class="page-section">
      <div class="row">
        <div class="col-md-10 col-lg-8 col-md-offset-1 col-lg-offset-2">
    
          <h4 class="page-section-heading">Feed</h4>
          <div class="panel panel-default">
            <!-- Progress table -->
            <div class="table-responsive">
            
            <table class="table v-middle"> 
                 <tr>
                  <td>  
                     <a href="feeds.php?cmd=list"  class="btn btn-primary">List</a>
                     <form name="frm_feeds" method="post"  enctype="multipart/form-data" onSubmit="return checkRequired();">			
                        <table class="table v-middle"> 
                             <tr>
                                 <td>Key</td>
                                 <td>
                                    <input type="text" name="feedkey" id="feedkey"  value="<?=$feedkey?>" class="textbox" required>
                                 </td>
                             </tr>
                             <tr> 
                                 <td align="right"></td>
                                 <td>
                                    <input type="hidden" name="cmd" value="add">
                                    <input type="hidden" name="id" value="<?=$Id?>">			
                                    <input type="submit" name="btn_submit" id="btn_submit" value="submit" class="button_blue">
                                 </td>     
                             </tr>
                        </table>
                    </form>
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
