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
                            
                         
                            <div class="groupme" style="width:45%; border:1px solid gray; border-radius:5px; padding:15px; margin-bottom:10px;">
                                <h4>Event Info</h4>
                                <div class="control-group">
                                    <label class="control-label">Event Name</label>
                                    <div class="controls">
                                        <textarea name="event_name" required></textarea>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Date</label>
                                    <div class="controls">
                                        <input type="text" class="datepicker" name="event_date" value="" required>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Venue</label>
                                    <div class="controls">
                                        <textarea name="venue" required></textarea>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Time</label>
                                    <div class="controls">
                                       <input required type="text" name='tfrom' value="" placeholder="From"> - <input required name="tto" type="text" value="" placeholder="To"> 
                                    </div>
                                </div>
                            </div>

                            <div class="groupme" style="width:40%; border:1px solid gray; border-radius:5px; padding:15px; margin-bottom:10px;">
                                <h4>Registration Info</h4>
                                
                                <div class="control-group">
                                    <label class="control-label">Open Date</label>
                                    <div class="controls">
                                        <input type="text" name="open_date"  class="datepicker" value="" required>
                                    </div>
                                </div> 

                                <div class="control-group">
                                    <label class="control-label">Close Date</label>
                                    <div class="controls">
                                        <input type="text" name="close_date"  class="datepicker" value="" required>
                                    </div>
                                </div> 

                                <div class="control-group">
                                    <label class="control-label">Submit Date</label>
                                    <div class="controls">
                                        <input type="text" value=""  class="datepicker" name="submit_date" required>
                                    </div>
                                </div>          
                            </div>

                            <div class="groupme" style="width:40%; border:1px solid gray; border-radius:5px; padding:15px; margin-bottom:10px;">
                                <h4>Fees</h4>
                                
                                <div class="control-group">
                                    <label class="control-label">Abacus Fee</label>
                                    <div class="controls">
                                        <input type="text" value="" name="abafee">
                                    </div>
                                </div> 

                                <div class="control-group">
                                    <label class="control-label">Mental Fee</label>
                                    <div class="controls">
                                        <input type="text" value="" name="menfee">
                                    </div>
                                </div> 

                                <div class="control-group">
                                    <label class="control-label">Aural Fee</label>
                                    <div class="controls">
                                        <input type="text" value="" name="auralfee">
                                    </div>
                                </div>          
                            </div>

                            <div class="form-actions">
                              <!--<button type="submit" value="Submit" class="btn btn-primary">Save changes</button>-->
                              <button type="submit" name="submit_event"  class="btn btn-primary">Save</button>
                              <button type="reset" class="btn">Cancel</button>
                            </div>

                        </form> 
                    </div>
                </div><!--/span-->

            </div><!--/row-->
                    <!-- content ends -->
            </div><!--/#content.span10-->