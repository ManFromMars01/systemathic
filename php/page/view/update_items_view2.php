<?php  
$countfirst = $model->count_where('titems', array('Sku' => $_GET['sku'], 'BranchID' => $_SESSION['UserValue2']));
if($countfirst == 1){
  $readonly = '';
} else{
  $readonly = 'readonly';
}

function get_vendor($vendor_id){
  $model = new Model;
  $tvendor = $model->select_where('tvendor',array('Code' => $vendor_id));
  echo $tvendor->fields['Name'];
}
function get_collection($collect_id){
  $model = new Model;
  $collect = $model->select_where('tcollection',array('Code' => $collect_id));
  echo $collect->fields['Description'];
}
function get_color($colorid){
  $model = new Model;
  $color = $model->select_where('tcolor',array('Code' => $colorid));
  echo $color->fields['Description'];
}
function get_size($sizeid){
  $model = new Model;
  $size = $model->select_where('tsize',array('Code' => $sizeid));
  echo $size->fields['Description'];
}



?>


<div id="content" class="span10"> 
            <div class="row-fluid sortable">
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-edit"></i> Edit  Item </h2>
                        <div class="box-icon">
                            <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
                            <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                            <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                        </div>
                    </div>
                    <div class="box-content">
                        <form class="form-horizontal" action=""  id="form32" name="form32" method="post" >
                          <fieldset>


                            <div class="control-group">
                                <label class="control-label" for="focusedInput">Sku:</label>
                                <div class="controls">
                                  <input class="" name="sku" type="text" value="<?php echo $cur_items->fields['Sku'];?>" readonly>
                                </div>
                            </div>

                          
                            <div class="control-group">
                                <label class="control-label"  for="focusedInput">Description:</label>
                                <div class="controls">
                                  <textarea name="txttitemsDescription" id="txttitemsDescription" <?php echo $readonly; ?>><?php echo $cur_items->fields['Description'];?></textarea>
                                </div>
                            </div>

                            <div class="control-group" style="width:30%;">
                                <label class="control-label"  for="focusedInput">Details:</label>
                                <div class="controls">
                                  <table class="table table-striped table-bordered bootstrap-datatable">
                                    <tr>
                                        <td>Vendor :</td>                                        
                                        <td><strong><?php get_vendor($cur_items->fields['LastPurVdrID']);?></strong></td>  
                                    </tr>
                                    <tr>
                                        <td>Collection :</td>
                                        <td><strong><?php get_collection($cur_items->fields['CatID']);?></strong></td>  
                                    </tr>
                                    <tr>
                                        <td>Color :</td>
                                        <td><strong><?php get_color($cur_items->fields['Color']);?></strong></td>  
                                    </tr>
                                    <tr>
                                        <td>Size :</td>
                                        <td><strong><?php get_size($cur_items->fields['Sizes']);?></strong></td>  
                                    </tr>
                                  </table>  
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label"  for="focusedInput">Unit Cost:</label>
                                <div class="controls">
                                  <div class="input-prepend">
                                    <span class="add-on"><?php echo $model->currencys($_SESSION['UserValue1']);?></span><input name="txttitemsIssuUntCost" id="prependedInput" size="16" type="text" value="<?php echo $inventory_login->fields['IssuUntCost'] ?>" >
                                  </div>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label"  for="focusedInput">Selling Price:</label>
                                <div class="controls">
                                  <div class="input-prepend">
                                    <span class="add-on"><?php echo $model->currencys($_SESSION['UserValue1']);?></span><input name="txttitemsPurUntCost" id="prependedInput" size="16" type="text" value="<?php echo $inventory_login->fields['PurUntCost'] ?>">
                                  </div>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label"  for="focusedInput">Retail Price:</label>
                                <div class="controls">
                                  <div class="input-prepend">  
                                    <span class="add-on"><?php echo $model->currencys($_SESSION['UserValue1']);?></span><input name="txttitemsStdCost" id="prependedInput" size="16" type="text" value="<?php echo $inventory_login->fields['StdCost']; ?>">
                                  </div>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label"  for="focusedInput">Stock:</label>
                                <div class="controls">
                                  <input class="" style="width:100px;" name="txttitemsQtyOnHand" id="" type="text" value="<?php echo $inventory_login->fields['QtyOnHand']; ?>">
                                </div>
                            </div>        

                        </div>
                            

                            <div class="form-actions">
                              <!--<button type="submit" value="Submit" class="btn btn-primary">Save changes</button>-->
                              <button type="button"  class="btn btn-primary"  id="upd_item_books">Update</button>
                              <button type="reset" class="btn">Cancel</button>
                            </div>
                          </fieldset>
                        </form> 
                     

                    </div>
                </div><!--/span-->

            </div><!--/row-->
                    <!-- content ends -->
            </div><!--/#content.span10-->
