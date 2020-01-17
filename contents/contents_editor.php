<?php
   include("../template/header.php");
?>
<div class="page-section">
  <div class="row">
    <div class="col-md-10 col-lg-8 col-md-offset-1 col-lg-offset-2">

      <h4 class="page-section-heading">Contents</h4>
      <div class="panel panel-default">
        <!-- Progress table -->
        <div class="table-responsive">
            <table class="table">
                <tr>
                <td>  
                <a href="index.php?cmd=list" class="btn btn-primary">List</a>
                <form name="frm_contents" method="post"  enctype="multipart/form-data" onSubmit="return checkRequired();">			
                <table class="table">
                <tr>
                                 <td>Content Type</td>
                                 <td><?php
                                    $enumcontents = getEnumFieldValues('contents','content_type');
                                ?>
                                <select  name="content_type" id="content_type"   class="textbox">
                                <?php
                                   foreach($enumcontents as $key=>$value)
                                   { 
                                ?>
                                  <option value="<?=$value?>" <?php if($value==$content_type){ echo "selected"; }?>><?=$value?></option>
                                 <?php
                                  }
                                ?> 
                                </select>
                                </td>
                          </tr>
                          <tr>
                                 <td valign="top">Content</td>
                                 <td align="left">
                                   <div style="float:left;">
                                    <textarea name="content" id="content"   style="width:200px;height:100px;"><?=$content?></textarea>
                                   </div> 
                                 </td>
                          </tr>
                          <tr>
                                 <td>Status</td>
                                 <td><?php
                                    $enumcontents = getEnumFieldValues('contents','status');
                                ?>
                                <select  name="status" id="status"   class="textbox">
                                <?php
                                   foreach($enumcontents as $key=>$value)
                                   { 
                                ?>
                                  <option value="<?=$value?>" <?php if($value==$status){ echo "selected"; }?>><?=$value?></option>
                                 <?php
                                  }
                                ?> 
                                </select></td>
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
     