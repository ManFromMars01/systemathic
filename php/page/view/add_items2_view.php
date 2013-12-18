<div id="content" class="span10">

            
            <div class="row-fluid sortable">
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-edit"></i> Add  Item </h2>
                        <div class="box-icon">
                            <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
                            <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                            <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                        </div>
                    </div>
                    <div class="box-content">
                        <form class="form-horizontal" action="#"  id="form31" name="form31" method="post" >
                          <fieldset>
                           <?php if($_SESSION['UserValue1'] == "ADM" ): ?>
                           <div class="control-group">
                                <label class="control-label"  for="focusedInput">Country ID:</label>
                                <div class="controls">
                                  <input  class="" name="txttitemsCountryID" id="" type="text" value="" required>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"  for="focusedInput">Branch ID:</label>
                                <div class="controls">
                                  <input  class="" name="txttitemsBranchID" id="" type="text" value="" required>
                                </div>
                            </div>
                           <?php else: ?>
                            <input class="" name="txttitemsCountryID" type="hidden" value="<?php echo $_SESSION['UserValue1'] ?>" readonly>
                            <input class="" name="txttitemsBranchID" type="hidden" value="<?php echo $_SESSION['UserValue2'] ?>" readonly>
                           <?php endif; ?>
                           
                                <input type="hidden" id="txttitemsIsBook" name="txttitemsIsBook" value="No" >
                              

                            <div class="control-group txttitemsDescription">
                                <label class="control-label"  for="focusedInput">Description:</label>
                                <div class="controls">
                                  <textarea name="txttitemsDescription" required></textarea>
                                </div>
                            </div>


                            <div class="control-group">
                                <label class="control-label"  for="focusedInput">Collection:</label>
                                <div class="controls">
                                  <select name="txttitemsCatID" id="txttitemsCatID" >
                                    <?php echo $option7; ?>
                                  </select>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label"  for="focusedInput">Color:</label>
                                <div class="controls">
                                  <select name="txttitemscolors">
                                    <?php foreach($color as $colors): ?>
                                        <option value="<?php echo $colors['Code'] ?>"><?php echo $colors['Description'];?></option>
                                    <?php endforeach; ?>
                                  </select>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label"  for="focusedInput">Size:</label>
                                <div class="controls">
                                  <select name="txttitemssize">
                                    <?php foreach($size as $sizes): ?>
                                        <option value="<?php echo $sizes['Code'] ?>"><?php echo $sizes['Description'];?></option>
                                    <?php endforeach; ?>    
                                  </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"  for="focusedInput">Vendor:</label>
                                <div class="controls">
                                  <select class="" name="txttitemsLastPurVdrID">
                                    <?php echo $option8; ?>
                                  </select>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label"  for="focusedInput">Unit Cost:</label>
                                <div class="controls">
                                  <input class="" name="txttitemsIssuUntCost" id="" type="text" value="">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label"  for="focusedInput">Selling Price:</label>
                                <div class="controls">
                                  <input class="" name="txttitemsPurUntCost" id="" type="text" value="">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label"  for="focusedInput">Selling Retail Price:</label>
                                <div class="controls">
                                  <input class="" name="txttitemsStdCost" id="" type="text" value="">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label"  for="focusedInput">Stock:</label>
                                <div class="controls">
                                  <input class="" name="txttitemsQtyOnHand" id="" type="text" value="">
                                </div>
                            </div>
                        </div>
                            

                            <div class="form-actions">
                              <!--<button type="submit" value="Submit" class="btn btn-primary">Save changes</button>-->
                              <button type="button"  class="btn btn-primary"  id="add_item_books">Add</button>
                              <button type="reset" class="btn">Cancel</button>
                            </div>
                          </fieldset>
                        </form> 
                    </div>
                </div><!--/span-->

            </div><!--/row-->
                    <!-- content ends -->
            </div><!--/#content.span10-->

            <div class="modal hide fade" id="myModal">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h3></h3>
            </div>
            <div class="modal-body">
                <p>Successfully Updated</p>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn" data-dismiss="modal">Close</a>
                <!--<a href="BrowseStudentlist.php" class="btn btn-primary">Back To Student List</a>-->
            </div>
        </div>