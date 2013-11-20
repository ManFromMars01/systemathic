<div id="content" class="span10">
            <!-- content starts -->
            

            <?php breadcrumb('Update Class Schedule'); ?>

            
            <?php echo $success ;?>
            <div class="row-fluid sortable">
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-edit"></i> Update Schedule</h2>
                    </div>
                    <div class="box-content">
                        <form class="form-horizontal" method="get" >
                          <fieldset>
                           <input type="hidden" id="MODE" name="schedcode" value="<?php echo $_GET['schedcode'];?>">

                            <div class="control-group">
                                <label class="control-label" for="focusedInput">Country ID:</label>
                                <div class="controls">
                                  <input class="input-xlarge focused" id="txttclassschedCountryID" name="country_id" type="text" value="<?php echo $_SESSION['UserValue1']; ?>" readonly>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="focusedInput">Branch ID:</label>
                                <div class="controls">
                                  <input class="input-xlarge focused" id="txttclassschedBranchID" name="branch_id" type="text" value="<?php echo $_SESSION['UserValue2'];  ?>" readonly>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label"  for="focusedInput">Level Id:</label>
                                <div class="controls">
                                  <select id="txttclassschedLevelID" name="level_id">
                                       <?php foreach($tlevel as $levelme): ?>
                                       
                                       <option <?php if($levelme['ID'] == $sched->fields['LevelID']):  echo "selected "; endif; ?> value="<?php echo $levelme['ID']  ?>"><?php echo $levelme['Description']  ?></option>
                                       <?php endforeach; ?>
                                   </select>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="focusedInput">Teacher Count:</label>
                                <div class="controls">
                                  <input class="input-xlarge focused" id="txttclassschedTeacherCnt" name="teacher_count" type="text" value="<?php echo $sched->fields['TeacherCnt'] ?>">
                                </div>
                            </div>

                            <div class="groupme2 teachergroup">
                                <div class="control-group">
                                    <label class="control-label"  for="focusedInput">Teacher 1:</label>
                                    <div class="controls">
                                      <select id="txttclassschedTeacherID3" name="teacher1">
                                            <?php foreach($tteacher as $teacher): ?>
                                            <?php 
                                                $selected ="";
                                                if($sched->fields['TeacherID1'] == $teacher['ID'] ): $selected = "selected";  endif;
                                            ?>    
                                                
                                                <option <?php echo $selected;?> value="<?php echo $teacher['ID']; ?>"><?php echo $teacher['Name'];?></option>
                                            <?php endforeach; ?>          
                                       </select>
                                    </div>
                                </div>

                                <div class="control-group teacher2 teacherhand displaynone" <?php echo $class; ?> >
                                    <label class="control-label"  for="focusedInput">Teacher 2:</label>
                                    <div class="controls">
                                      <select id="txttclassschedTeacherID3" name="teacher2">
                                            <?php foreach($tteacher as $teacher): ?>
                                            <?php 
                                                $selected ="";
                                                if($sched->fields['TeacherID2'] == $teacher['ID'] ): $selected = "selected";  endif;
                                            ?>
                                                <option <?php echo $selected; ?> value="<?php echo $teacher['ID']; ?>"><?php echo $teacher['Name'];?></option>
                                            <?php endforeach; ?>      
                                       </select>
                                    </div>
                                </div>

                                <div class="control-group teacher3 teacherhand displaynone" <?php echo $class2; ?>>
                                    <label class="control-label"  for="focusedInput">Teacher 3:</label>
                                    <div class="controls">
                                      <select id="txttclassschedTeacherID3" name="teacher3">    
                                          <?php foreach($tteacher as $teacher): ?>
                                          <?php 
                                                $selected ="";
                                                if($sched->fields['TeacherID3'] == $teacher['ID'] ): $selected = "selected";  endif;
                                            ?>
                                                <option <?php echo $selected; ?> value="<?php echo $teacher['ID']; ?>"><?php echo $teacher['Name'];?></option>
                                            <?php endforeach; ?>  
                                       </select>
                                    </div>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label"  for="focusedInput">Day:</label>
                                <div class="controls">
                                  <select id="txttclassschedDay" name="day_sched">
                                     <option <?php if($sched->fields['Day'] == "Monday"): echo "selected"; else: endif; ?> value="Monday">Monday</option>          
                                     <option <?php if($sched->fields['Day'] == "Tuesday"): echo "selected"; else: endif; ?> value="Tuesday">Tuesday</option>          
                                     <option <?php if($sched->fields['Day'] == "Wednesday"): echo "selected"; else: endif; ?> value="Wednesday">Wednesday</option>          
                                     <option <?php if($sched->fields['Day'] == "Thursday"): echo "selected"; else: endif; ?> value="Thursday">Thursday</option>          
                                     <option <?php if($sched->fields['Day'] == "Friday"): echo "selected"; else: endif; ?> value="Friday" >Friday</option>          
                                     <option <?php if($sched->fields['Day'] == "Saturday"): echo "selected"; else: endif; ?> value="Saturday">Saturday</option>          
                                     <option <?php if($sched->fields['Day'] == "Sunday"): echo "selected"; else: endif; ?> value="Sunday">Sunday</option>          
                                   </select>
                                </div>
                            </div>
                            <div class="control-group">
                                    <label class="control-label" >Available Sched</label>
                                    <div class="controls">
                                        <select id="avetime">
                                            <option value="">Please Select New Time</option>
                                            <?php foreach($time as $times): ?>

                                             <option value="<?php echo $times['TimeID']; ?>"><?php echo $times['FromTime']; ?> - <?php echo $times['ToTime']; ?> </option>    
                                             <?php endforeach; ?>     
                                        </select>
                                    </div>
                            </div>
                            
                            <div class="control-group">
                                <label class="control-label" for="focusedInput"><a id="showme" style="text-decoration:underline" alt="enable">Other Sched</a> </label>
                                <div class="controls">
                                </div>
                            </div>

                            <div class="group2 displaynone">
                                <div class="control-group">
                                    <label class="control-label" >From</label>
                                    <div class="controls">
                                          <input type name="timefrom"  id="txttclassschedTimeFrom" value="<?php echo $sched->fields['TimeFrom'] ?>">
                                           
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="focusedInput">To</label>
                                    <div class="controls">
                                      <input class="input-xlarge timeme2" id="txttclassschedTimeTo"  name="timeto" type="text" value="<?php echo $sched->fields['TimeTo'] ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="focusedInput">Room:</label>
                                <div class="controls">
                                  <select id="txttclassschedRoomID" name="roomid">

                                      <?php foreach($room as $rooms): ?>
                                      <option <?php if($rooms['ID'] == $sched->fields['RoomID']):  echo "selected"; endif; ?> value="<?php echo $rooms['ID'];?>"><?php echo $rooms['Description'];?></option>
                                      <?php endforeach; ?>  
                                   </select>
                                </div>
                            </div>

                           


                            <div class="form-actions">
                              <!--<button type="submit" value="Submit" class="btn btn-primary">Save changes</button>-->
                              <input type="submit"  class="btn btn-primary" name="save_class_shed"  id="save_class_shed" value="save">
                            </div>
                          </fieldset>
                        </form> 
                     

                    </div>
                </div><!--/span-->

            </div><!--/row-->
                    <!-- content ends -->
            </div><!--/#content.span10-->


