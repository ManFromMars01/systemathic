<div id="content" class="span10">
            <!-- content starts -->
            

            <?php breadcrumb('<a href="'.base_url('contact.php').'">Contact</a> <a href="'.base_url('page/controller/appointment.php').'">/ Appointment</a> <a href="#">/ Add Appointment</a>'); ?>

            
            <?php echo $success ;?>
            <div class="row-fluid sortable">
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-edit"></i> Add Appointment</h2>
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

                                <h4>Appointment Info</h4>
                                
                                <div class="control-group">
                                    <label class="control-label">Description</label>
                                    <div class="controls">
                                        <textarea name="topic" required></textarea>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Date</label>
                                    <div class="controls">
                                        <input type="text" class="datepicker" name="date" value="" required>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Start Time</label>
                                    <div class="controls">
                                        <input type="text" name="time" value="" required>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Duration</label>
                                    <div class="controls">
                                        <input type="text" name="duration" value="" required>
                                    </div>
                                </div>

                            
                                <div class="control-group">
                                    <label class="control-label">Additional Notes</label>
                                    <div class="controls">
                                        <textarea name="add_notes" required></textarea>
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


            <script>
                $('.save_event').click(function(){
                    $.ajax({
                        url : '<?php echo base_url("page/ajax/edit_event.php")?>',
                        type : 'post',
                        data : $('#editevent').serialize(),
                        dataType:'json',
                        success: function(j){
                            console.log(j);
                            noty({"text":" Successfully Save","layout":"bottomLeft","type":"success"});

                        }
                    })
                })
            </script>