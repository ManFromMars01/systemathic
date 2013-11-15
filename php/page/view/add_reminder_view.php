<div id="content" class="span10">
            <!-- content starts -->
            

            <?php breadcrumb('<a href="'.base_url('contact.php').'">Contact</a> <a href="'.base_url('page/controller/reminder.php').'">/ Reminder</a> <a href="#">/ Add Reminder</a>'); ?>

            
            <?php echo $success ;?>
            <div class="row-fluid sortable">
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-edit"></i> Add Reminder</h2>
                    </div>
                    <div class="box-content">
                        
                        <form class="form-horizontal" id="" method="POST" method="post" >
                            
                         
                            <div class="groupme" style="width:45%; border:1px solid gray; border-radius:5px; padding:15px; margin-bottom:10px;">
                                <h4>Teacher</h4>

                                <div class="control-group">
                                    <label class="control-label" for="selectError">Teacher</label>
                                    <div class="controls">
                                      <select id="selectError" data-rel="chosen" name="teacher_id">
                                        <?php echo $model->teacher(); ?>
                                      </select>
                                    </div>
                               </div>


                                <h4>Reminder Info</h4>
                                
                                <div class="control-group">
                                    <label class="control-label">Reminder</label>
                                    <div class="controls">
                                        <textarea name="reminder" required></textarea>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Date</label>
                                    <div class="controls">
                                        <input type="text" class="datepicker" name="date" value="" required>
                                    </div>
                                </div>

                                


                            <div class="form-actions">
                              <!--<button type="submit" value="Submit" class="btn btn-primary">Save changes</button>-->
                              <button type="submit" name="save_event"  class="btn btn-primary save_event">Save</button>
                              <button type="reset" class="btn">Cancel</button>
                            </div>

                        </form> 
                    </div>
                </div><!--/span-->

            </div><!--/row-->
                    <!-- content ends -->
            </div><!--/#content.span10-->


            