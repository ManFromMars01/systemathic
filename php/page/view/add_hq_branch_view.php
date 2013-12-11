
<div id="content" class="span10">
            
            <?php echo $success; ?>

            <div class="row-fluid sortable">
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-edit"></i> Add  HQ Branch - <?php $model->country($countryid); ?>  </h2>
                        <div class="box-icon">
                            <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
                            <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                            <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                        </div>
                    </div>
                    <div class="box-content">
                        <form class="form-horizontal" method="post" >
                          <fieldset><br />
                            
                            <input type="hidden" name="countryid" value="<?php echo $countryid; ?>">
                            
                            <h4>Information</h4>
                            <div class="control-group">
                                <label class="control-label">HQ Branch Code</label>
                                <div class="controls">
                                  <div class="input-prepend input-append">
                                    <span class="add-on"><?php echo $countryid."001"?>-</span><input name="branch_code" style="width:100px;" type="text">
                                  </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Description</label>
                                <div class="controls">
                                  <textarea name="description"></textarea>
                                </div>
                            </div>


                            <div class="control-group">
                                <label class="control-label">Contact Person</label>
                                <div class="controls">
                                  <input name="contact" type="text" value=""  required/>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Gender:</label>
                                <div class="controls">
                                  <select name="gender">
                                      <option value="Male">Male</option>
                                      <option value="Female">Female</option>
                                  </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Skype:</label>
                                <div class="controls">
                                    <input type="text" name="skype">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Phone:</label>
                                <div class="controls">
                                    <input type="text" name="phone">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Address:</label>
                                <div class="controls">
                                    <input type="text" name="address1">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" name="email">Email:</label>
                                <div class="controls">
                                    <input type="text">
                                </div>
                            </div>

                            <h4>Services</h4>
                            <div class="control-group">
                                <label class="control-label"></label>
                                <div class="controls">
                                    <?php foreach($services as $service): ?>
                                    <input type="checkbox" checked name="service[]" value="<?php echo $service['ID'] ?>"> <?php echo $service['Description'];?>
                                    <?php endforeach;    ?>
                                </div>
                            </div>
                            

                            <div class="form-actions">
                              <!--<button type="submit" value="Submit" class="btn btn-primary">Save changes</button>-->
                              <button type="submit" name="save"  class="btn btn-primary"  id="saveme">Add Branch</button>
                              <button type="reset" class="btn">Cancel</button>
                            </div>
                          </fieldset>
                        </form> 
                     

                    </div>
                </div><!--/span-->

            </div><!--/row-->
                    <!-- content ends -->
            </div><!--/#content.span10-->