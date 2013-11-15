<div id="content" class="span10">
            <!-- content starts -->
            

            <?php breadcrumb('Event / Edit Event'); ?>

            
            
            <div class="row-fluid sortable">
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-edit"></i> Edit Event </h2>
                    </div>
                    <div class="box-content">
                        
                        <form class="form-horizontal" id="editevent" method="POST" method="post" >
                            
                         
                            <div class="groupme" style="width:45%; border:1px solid gray; border-radius:5px; padding:15px; margin-bottom:10px;">
                                <h4>Event Info</h4>
                                <div class="control-group">
                                    <label class="control-label">Event Name</label>
                                    <div class="controls">
                                        <textarea name="event_name" required><?php echo $event->fields['Event']; ?></textarea>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Date</label>
                                    <div class="controls">
                                        <input type="text" class="datepicker" name="event_date" value="<?php echo $event->fields['Date']; ?>" required>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Venue</label>
                                    <div class="controls">
                                        <textarea name="venue" required><?php echo $event->fields['Venue']; ?></textarea>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Time</label>
                                    <div class="controls">
                                       <input required type="text" name='tfrom' value="<?php echo $event->fields['TimeFrom']; ?>" placeholder="From"> - <input required name="tto" type="text" value="<?php echo $event->fields['TimeTo']; ?>" placeholder="To"> 
                                    </div>
                                </div>
                            </div>

                            <div class="groupme" style="width:40%; border:1px solid gray; border-radius:5px; padding:15px; margin-bottom:10px;">
                                <h4>Registration Info</h4>
                                
                                <div class="control-group">
                                    <label class="control-label">Open Date</label>
                                    <div class="controls">
                                        <input type="text" name="open_date"  class="datepicker" value="<?php echo $event->fields['OpenDate']; ?>" required>
                                    </div>
                                </div> 

                                <div class="control-group">
                                    <label class="control-label">Close Date</label>
                                    <div class="controls">
                                        <input type="text" name="close_date"  class="datepicker" value="<?php echo $event->fields['CloseDate']; ?>" required>
                                    </div>
                                </div> 

                                <div class="control-group">
                                    <label class="control-label">Submit Date</label>
                                    <div class="controls">
                                        <input type="text" value="<?php echo $event->fields['SubmitDate']; ?>"  class="datepicker" name="submit_date" required>
                                    </div>
                                </div>          
                            </div>

                            <div class="groupme" style="width:40%; border:1px solid gray; border-radius:5px; padding:15px; margin-bottom:10px;">
                                <h4>Fees</h4>
                                
                                <div class="control-group">
                                    <label class="control-label">Abacus Fee</label>
                                    <div class="controls">
                                        <input type="text" value="<?php echo $event->fields['AbaFee']; ?>" name="abafee">
                                    </div>
                                </div> 

                                <div class="control-group">
                                    <label class="control-label">Mental Fee</label>
                                    <div class="controls">
                                        <input type="text" value="<?php echo $event->fields['MenFee']; ?>" name="menfee">
                                    </div>
                                </div> 

                                <div class="control-group">
                                    <label class="control-label">Aural Fee</label>
                                    <div class="controls">
                                        <input type="text" value="<?php echo $event->fields['AurFee']; ?>" name="auralfee">
                                    </div>
                                </div>          
                            </div>
                            <input type="hidden" value="<?php echo $_GET['event_id'];?>" name="event_id">

                            <div class="form-actions">
                              <!--<button type="submit" value="Submit" class="btn btn-primary">Save changes</button>-->
                              <button type="button" name="save_event"  class="btn btn-primary save_event">Save</button>
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