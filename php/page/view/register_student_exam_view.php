<div id="content" class="span10">
            <!-- content starts -->
            

            <?php breadcrumb('Event / Add Event'); ?>


            <?php echo $success; ?>
            
            <div class="row-fluid sortable">
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-edit"></i> Add Event </h2>
                    </div>
                    <div class="box-content">
                        
                        <form class="form-horizontal" method="POST" method="post" >
                            <input type="text" name="event_num" value="<?php echo $exam_desc->fields['EventID']; ?>">
                            <input type="text" name="idnum"  value="<?php echo $customer->fields['StudentID']; ?>">
                         
                            <div class="groupme" style="width:45%; border:1px solid gray; border-radius:5px; padding:15px; margin-bottom:10px;">
                                <h4>Event Info</h4>
                                <div class="control-group">
                                    <label class="control-label">Event Name</label>
                                    <div class="controls">
                                        <textarea name="event_name" readonly><?php echo $exam_desc->fields['Event']; ?></textarea>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Date</label>
                                    <div class="controls">
                                        <input type="text" class="datepicker" name="event_date" value="<?php echo $exam_desc->fields['Date']; ?>" readonly>
                                    </div>
                                </div>

                                <a href="#" id="moreinfo">MOre Info</a>
                                <div class="moreinfo" style="display:none;">
                                    <div class="control-group">
                                        <label class="control-label">Venue</label>
                                        <div class="controls">
                                            <textarea name="venue" readonly><?php echo $exam_desc->fields['Venue']; ?></textarea>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label">Time</label>
                                        <div class="controls">
                                           <input required type="text" name='tfrom' value="<?php echo $exam_desc->fields['TimeFrom']; ?>" readonly> - <input required name="tto" type="text" value="<?php echo $exam_desc->fields['TimeTo']; ?>" readonly> 
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="groupme" style="width:45%; border:1px solid gray; border-radius:5px; padding:15px; margin-bottom:10px;">
                                <h4>Student</h4>
                                <div class="control-group">
                                    <label class="control-label">ID</label>
                                    <div class="controls">
                                         <input type="text" name="student_id" value="<?php echo $_POST['idnum']; ?>" readonly>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Name</label>
                                    <div class="controls">
                                        <input type="text" name="fname" value="<?php echo $customer->fields['SurName']; ?>, <?php echo $customer->fields['FirstName']; ?>, <?php echo $customer->fields['MiddleName']; ?>, " readonly>
                                    </div>
                                </div>
                            </div>


                            <div class="groupme" style="width:45%; border:1px solid gray; border-radius:5px; padding:15px; margin-bottom:10px;">
                                <h4>Exam Category</h4>
                                <div class="control-group">
                                    <label class="control-label"></label>
                                    <div class="controls">
                                         <input type="checkbox" id="ismental"  name="mental" value="1"> Mental
                                         <input type="checkbox" id="isabacus"  name="abacus" value="1"> Abacus
                                         <input type="checkbox" id="isaural"   name="aural" value="1"> Aural 
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Remarks</label>
                                    <div class="controls">
                                        <input type="text" name="remarks" value="">
                                    </div>
                                </div> 
                            </div>



                            <div class="groupme abacus" style="display:none; width:40%; border:1px solid gray; border-radius:5px; padding:15px; margin-bottom:10px;">
                                <h4>Abacus</h4>
                                <div class="control-group">
                                    <label class="control-label">Abacus Fee</label>
                                    <div class="controls">
                                        <input type="text" value="<?php echo $exam_desc->fields['AbaFee'];?>" name="abafee" readonly>
                                    </div>
                                </div> 
                                <div class="control-group">
                                    <label class="control-label">Grade</label>
                                    <div class="controls">
                                        <input type="text" name="grade_aba" value="">
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Teacher</label>
                                    <div class="controls">
                                        <select name="teacher1">
                                            <option value="">Please Select A teacher</option>
                                            <?php $model->teacher(); ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Room</label>
                                    <div class="controls">
                                        <select name="room1">
                                            <option value="">Please Select A Room</option>
                                            <?php $model->rooms(); ?>
                                        </select>
                                    </div>
                                </div>
                                


                            </div>     
 


                            <div class="groupme mental" style="display:none; width:40%; border:1px solid gray; border-radius:5px; padding:15px; margin-bottom:10px;">
                                <h4>Mental</h4>
                                <div class="control-group">
                                    <label class="control-label">Mental Fee</label>
                                    <div class="controls">
                                        <input type="text" value="<?php echo $exam_desc->fields['MenFee'];?>" name="menfee" readonly>
                                    </div>
                                </div> 

                                <div class="control-group">
                                    <label class="control-label">Grade</label>
                                    <div class="controls">
                                        <input type="text" name="grade_men" value=>
                                    </div>
                                </div>
                                

                                <div class="control-group">
                                    <label class="control-label">Teacher</label>
                                    <div class="controls">
                                        <select name="teacher2">
                                            <option value="">Please Select A teacher</option>
                                            <?php $model->teacher(); ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Room</label>
                                    <div class="controls">
                                        <select name="room2">
                                            <option value="">Please Select A Room</option>
                                            <?php $model->rooms(); ?>
                                        </select>
                                    </div>
                                </div>
                                
                            </div>    




                            <div class="groupme aural" style="display:none; width:40%; border:1px solid gray; border-radius:5px; padding:15px; margin-bottom:10px;">
                                <h4>Aural</h4>
                                <div class="control-group">
                                    <label class="control-label">Aural Fee</label>
                                    <div class="controls">
                                        <input type="text" value="<?php echo $exam_desc->fields['AurFee'];?>" name="auralfee" readonly>
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label">Digit</label>
                                    <div class="controls">
                                        <input type="text" name="digit" value="">
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Number</label>
                                    <div class="controls">
                                        <input type="text" name="number" value="">
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Teacher</label>
                                    <div class="controls">
                                        <select name="teacher3">
                                            <option value="">Please Select A teacher</option>
                                            <?php $model->teacher(); ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Room</label>
                                    <div class="controls">
                                        <select name="room3">
                                            <option value="">Please Select A Room</option>
                                            <?php $model->rooms(); ?>
                                        </select>
                                    </div>
                                </div>  

                                      
                            </div>

                            <div class="form-actions">
                              <!--<button type="submit" value="Submit" class="btn btn-primary">Save changes</button>-->
                              <button type="submit" name="submit_reg"  class="btn btn-primary">Save</button>
                              <button type="reset" class="btn">Cancel</button>
                            </div>

                        </form> 
                    </div>
                </div><!--/span-->

            </div><!--/row-->
                    <!-- content ends -->
            </div><!--/#content.span10-->

            <script>
                $('#moreinfo').click(function(){
                    $(".moreinfo").toggle()
                })


                $('#ismental').click(function(){
                    var checked = $(this).attr('checked');
                    if (checked) {
                       $('.mental').show();
                    }else{
                      $('.mental').hide(); 
                    }
                });
                $('#isabacus').click(function(){
                    var checked = $(this).attr('checked');
                    if (checked) {
                       $('.abacus').show();
                    }else{
                      $('.abacus').hide(); 
                    }
                });
                $('#isaural').click(function(){
                    var checked = $(this).attr('checked');
                    if (checked) {
                       $('.aural').show();
                    }else{
                      $('.aural').hide(); 
                    }
                });

            </script>