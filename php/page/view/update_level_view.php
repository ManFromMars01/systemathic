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
            
            <div class="row-fluid sortable">
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-edit"></i> Edit level</h2>
                        <div class="box-icon">
                            <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
                            <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                            <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                        </div>
                    </div>
                    <div class="box-content">
                        <form class="form-horizontal" action=""  id="form22" name="form22" method="post" >
                          <fieldset>
                           <input type="hidden" id="ID1" name="ID1" value="PH">
                            <input type="hidden" id="ID2" name="ID2" value="PH001">
                            <input type="hidden" id="ID3" name="ID3" value="<?php echo $level->fields['ID']; ?>">


                            <div class="control-group">
                                <label class="control-label" for="focusedInput">Description::</label>
                                <div class="controls">
                                  <input class="input-xlarge focused" name="txttlevelDescription"  type="text" value="<?php echo $level->fields['Description']; ?>">
                                </div>
                            </div>


                            <div class="control-group">
                                <label class="control-label"  for="focusedInput">Level Code:</label>
                                <div class="controls">
                                  <input class="input-xlarge focused" name="txttlevelLevelCode" type="text" value="<?php echo $level->fields['LevelCode']; ?>">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label"  for="focusedInput">Color Code:</label>
                                <div class="controls">
                                  <input class="input-xlarge focused" name="txttlevelColor_Code" type="text" value="<?php echo $level->fields['Color_Code']; ?>">
                                </div>
                            </div>

                            
                            <div class="form-actions">
                              <!--<button type="submit" value="Submit" class="btn btn-primary">Save changes</button>-->
                              <button type="button"  class="btn btn-primary"  id="save_upd_level">Save changes</button>
                              <button type="reset" class="btn">Cancel</button>
                            </div>
                          </fieldset>
                        </form> 
                     

                    </div>
                </div><!--/span-->

            </div><!--/row-->
                    <!-- content ends -->
            </div><!--/#content.span10-->