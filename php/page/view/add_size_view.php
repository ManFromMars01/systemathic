<div id="content" class="span10">
            <!-- content starts -->
            <div>
                <ul class="breadcrumb">
                    <li>
                        <a href="#">Home</a> <span class="divider">/</span>
                    </li>
                    <li>
                        <a href="#">Forms</a>
                    </li>
                </ul>
            </div>
            
            <?php echo $success ?>
            <div class="row-fluid sortable">
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-edit"></i>Add Size</h2>
                        <div class="box-icon">
                            <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
                            <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                            <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                        </div>
                    </div>
                    <div class="box-content">
                        <form class="form-horizontal" action=""  id="form22" name="form22" method="post" >
                          <fieldset>
                            <div class="control-group">
                                <label class="control-label" for="focusedInput">Description:</label>
                                <div class="controls">
                                    <textarea name="description" id="description" required></textarea>
                                </div>
                            </div>


                            <div class="control-group">
                                <label class="control-label"  for="focusedInput">Size Code:</label>
                                <div class="controls">
                                  <input name="code" type="text" id="code" value="" required>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label"  for="focusedInput">Category:</label>
                                <div class="controls">
                                    <select name="category" id="category">
                                        <option value=""></option>
                                        <?php foreach ($category as $categorys): ?>
                                            <option value="<?php echo $categorys['ID'];?>"><?php echo $categorys['Description'];?></option>    
                                        <?php endforeach ?>
                                    </select>    
                                </div>
                            </div>

                            
                            <div class="form-actions">
                              <button type="submit"  class="btn btn-primary" name="save" id="save_upd_level">Save changes</button>
                              <button type="reset" class="btn">Cancel</button>
                            </div>
                          </fieldset>
                        </form> 
                    </div>
                </div><!--/span-->

            </div><!--/row-->
                    <!-- content ends -->
            </div><!--/#content.span10-->