<div id="content" class="span10">
            <!-- content starts -->
            

            <?php breadcrumb('<a href="'.base_url('contact.php').'">Contact</a> <a href="'.base_url('page/controller/communication_log.php').'">/ Communication Log</a> <a href="#">/ Add Log</a>'); ?>

            
            <?php echo $success ;?>
            <div class="row-fluid sortable">
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-edit"></i> Add Log </h2>
                    </div>
                    <div class="box-content">
                        
                        <form class="form-horizontal" id="" method="POST" method="post" >
                            
                         
                            <div class="groupme" style="width:45%; border:1px solid gray; border-radius:5px; padding:15px; margin-bottom:10px;">
                                <h4>Student Information</h4>

                                <div class="control-group">
                                    <label class="control-label" for="selectError">Student</label>
                                    <div class="controls">
                                      <select id="selectError" class="custno" data-placeholder="Select Student Name" data-rel="chosen" name="cust_no">
                                        <?php foreach ($customer as $customers ): ?>
                                                
                                            <option value="<?php echo $customers['CustNo'] ?>"><?php echo $customers['SurName'] ?>, <?php echo $customers['FirstName'];?> <?php echo $customers['MiddleName'] ?></option>
                                        <?php endforeach; ?>
                                      </select>

                                    </div>
                               </div>

                               <div class="control-group">
                                    <label class="control-label" for="selectError">Parent</label>
                                    <div class="controls">
                                      <select name="parentname" id="parentname">
                                        
                                      </select>

                                    </div>
                               </div>


                                <h4>Log Info</h4>
                                

                                <div class="control-group">
                                    <label class="control-label">Type</label>
                                    <div class="controls">
                                        <select name="type_log">
                                            <option value="Phone Call">Phone Call</option>
                                            <option value="Meeting in CMA">Meeting in CMA</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="control-group">
                                    <label class="control-label">Topic</label>
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
                                    <label class="control-label">Time</label>
                                    <div class="controls">
                                        <input type="text" name="time" value="" required>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Steps Parent's Will Take</label>
                                    <div class="controls">
                                        <textarea name="step_parent" required></textarea>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Steps Teacher's Will Take</label>
                                    <div class="controls">
                                        <textarea name="step_teacher" required></textarea>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Additional Notes</label>
                                    <div class="controls">
                                        <textarea name="add_notes" required></textarea>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Teacher</label>
                                    <div class="controls">
                                        <select name="teacher_id">
                                            <?php $model->teacher();?>
                                        </select>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Attestedby</label>
                                    <div class="controls">
                                        <select name="attested_id">
                                            <?php $model->teacher();?>
                                        </select>
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
                $('.custno').change(function(){
                     custno = $(this).val(); 
                     ;   
                    $.ajax({
                        url : '<?php echo base_url("page/ajax/select_parent.php")?>',
                        type : 'post',
                        data :{custno : custno},
                        dataType:'json',
                        success: function(j){
                            $('#parentname').html(j.status)
                        }
                    })
                })
            </script>