<div id="content" class="span10">
            
            <div class="row-fluid sortable">
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-edit"></i> Create Schedule </h2>
                        <div class="box-icon">
                            <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
                            <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                            <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                        </div>
                    </div>
                    <div class="box-content">
                        <form class="form-horizontal validateme3" action=""  id="form25" name="form25" method="post" >
                          <fieldset>
                           <input type="hidden" id="MODE" name="MODE" value="1">


                            <div class="control-group">
                                <label class="control-label" for="focusedInput">Country ID:</label>
                                <div class="controls">
                                  <input name="txteattheadCountryID"  type="text" value="<?php echo $student->fields['CountryID'] ?>" readonly>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="focusedInput">Branch ID:</label>
                                <div class="controls">
                                  <input class="input-xlarge focused" name="txteattheadBranchID" id="txteattheadBranchID"  type="text" value="<?php echo $student->fields['BranchID']; ?>" readonly>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="focusedInput">Full name:</label>
                                <div class="controls">
                                  <input class="input-xlarge focused" name="fname"  type="text" value="<?php echo $student->fields['SurName']; ?>, <?php echo $student->fields['FirstName']; ?> <?php echo $student->fields['MiddleName']; ?>" disabled>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="focusedInput">Custo No. </label>
                                <div class="controls">
                                  <input class="input-xlarge focused" name="txteattheadCustNo"  type="text" value="<?php echo $student->fields['CustNo']; ?>" readonly>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label"  for="focusedInput">Level:</label>
                                <div class="controls">
                                  <?php  $level =$model->select_where('tlevel',array('ID' => $student->fields['LevelID'] )); ?>
                                  <input class="input-xlarge focused" name="levelid" type="text" value="<?php echo $level->fields['Description'] ?>" disabled>
                                  <input name="txteattheadLevelID" id="txteattheadLevelID" type="hidden" value="<?php echo $student->fields['LevelID']; ?>">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label"  for="focusedInput">Tier:</label>
                                <div class="controls">
                                  <?php  $tier =$model->select_where('ttier',array('ID' => $student->fields['TierID'] )); ?>
                                  <input class="input-xlarge focused" name="tiername"  type="text" value="<?php echo $tier->fields['Description'] ?>" disabled>
                                  <input  type="hidden" name="txteattheadTierID" value="<?php echo $student->fields['TierID']; ?>">
                                </div>
                            </div>
                            <input class="input-xlarge focused" name="txteattheadAdmitDate"  type="hidden" value="">
                            <div class="control-group">
                                <label class="control-label" for="appendedInput">Total Modules</label>
                                <div class="controls">
                                  <div class="input-append">
                                    <input id="appendedInput" size="16" type="text" name="txteattheadModCount" class="modnum" value="1">
                                  </div>
                                  
                                </div>
                              </div>

                            <div class="control-group">
                                <label class="control-label" for="appendedInput">Total Sessions</label>
                                <div class="controls">
                                  <div class="input-append">
                                    <input id="appendedInput" size="16" type="text" class="sesnum" value="10" name="sesnum" disabled> 
                                </div>
                              </div>
                            </div>  
                                
                           <div class="control-group">
                                <label class="control-label"  for="focusedInput">Days Per Week:</label>
                                <div class="controls">
                                  <input class="" name="perday" id="perday"  type="text" value="">
                                </div>
                            </div>   


                            <div class="control-group">
                                <label class="control-label"  for="focusedInput">Start Date:</label>
                                <div class="controls">
                                  <input class="input-xlarge" name="txteattheadStartDate" id="mydate" type="text"  value="" required>
                                 


                                   <a href="Updateeattheadadd.php" onclick="window.open('class_schedule.php','popup','width=1200,height=1200,scrollbars=no,resizable=no,toolbar=no,directories=no,location=no,menubar=no,status=no,left=200,top=300'); return false">Check Schedule</a>
                                   <!-- <button type="button"  class="btn btn-primary"  id="createschedme">Save changes</button> -->
                                  
                                </div>
                            </div>

                            <!--<div class="control-group">
                                <label class="control-label"  for="focusedInput">End Date:</label>
                                <div class="controls">
                                  <input class="input-xlarge datepicker" name="txteattheadEndDate"  type="text" value="@eattheadEndDate@">
                                </div>
                            </div>-->

                            




                            <div class="control-group">
                                <label class="control-label"  for="focusedInput">Status:</label>
                                <div class="controls">
                                  <select id="txteattheadStatus" name="txteattheadStatus"  onfocus="JAVASCRIPT:setMessage(document.forms[0].txteattheadStatus)" title="">
                                     <option value="Temporary" selected>Temporary</option>          
                                     <option value="Wait List" >Wait List</option>          
                                     <option value="Final">Final</option>          
                                  </select>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label"  for="focusedInput">Class Status:</label>
                                <div class="controls">
                                  <select id="txteattheadClassStatus" name="txteattheadClassStatus"  onfocus="JAVASCRIPT:setMessage(document.forms[0].txteattheadClassStatus)" title="">
                                     <option value="Closed">Closed</option>          
                                     <option value="Open">Open</option>          
                                   </select>
                                </div>
                            </div>


                        <div class="day1 showday1" style="border: 1px solid #ededed; border-radius:5px; padding: 20px; width: 33%; margin:10px;">
                            <h4>Day1</h4><br>
                            <div class="control-group showday1 ">
                                <label class="control-label"  for="focusedInput" >Day:</label>
                                <div class="controls">
                                  
                                  <input type="text" id="txteattheadDay1" name="txteattheadDay1[]"  readonly>
                                     
                                     
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label"  for="focusedInput">Session numbers : </label>
                                <div class="controls">
                                  <input type="text" id="session_number" name="session_number[]" value="1">
                                </div>
                            </div>

                            <div class="groupme sch1">
                                    <div class="control-group">
                                        <label class="control-label"  for="focusedInput">Schedule Available : </label>
                                        <div class="controls">
                                          <select class="select_sched schedid" alt="sch1" name="sched_codes[]">
                                                             
                                           </select>
                                        </div>
                                    </div>
                                    <div class="appendme">
                                        <div class="control-group">
                                            <label class="control-label"  for="focusedInput">From:</label>
                                            <div class="controls">
                                              <input class="input-xlarge txteattheadHrFr1" name="txteattheadHrFr1[]"  type="text" value="">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"  for="focusedInput">To:</label>
                                            <div class="controls">
                                              <input class="input-xlarge txteattheadHrTo1" name="txteattheadHrTo1[]"   type="text" value="">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"  for="focusedInput">Room: </label>
                                            <div class="controls">
                                              <input class="input-xlarge txteattheadRmname" type="text" value="">
                                              <input class="input-xlarge txteattheadRm1" name="txteattheadRm1[]"   type="hidden" value="">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"  for="focusedInput">Teacher: </label>
                                            <div class="controls">
                                              <input class="input-xlarge tcname" name="teachername"  type="text" value="">
                                              <input class="txteattheadTeaID1" name="txteattheadTeaID1[]"  type="hidden" value="">
                                            </div>
                                        </div>



                                    </div>
                              </div>

                              <div class="groupme2 sch2 displaynone">
                                    <div class="control-group">
                                        <label class="control-label"  for="focusedInput">Schedule Available (Session 2) : </label>
                                        <div class="controls">
                                          <select class="select_sched schedid" alt="sch2" name="sched_codes[]">
                                                             
                                           </select>
                                        </div>
                                    </div>
                                     <div class="appendme">
                                        <div class="control-group">
                                            <label class="control-label"  for="focusedInput">From:</label>
                                            <div class="controls">
                                              <input class="input-xlarge txteattheadHrFr1" name="txteattheadHrFr1[]"  type="text" value="">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"  for="focusedInput">To:</label>
                                            <div class="controls">
                                              <input class="input-xlarge txteattheadHrTo1" name="txteattheadHrTo1[]"   type="text" value="">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"  for="focusedInput">Room: </label>
                                            <div class="controls">
                                              <input class="input-xlarge txteattheadRmname" type="text" value="">
                                              <input class="input-xlarge txteattheadRm1" name="txteattheadRm1[]"   type="hidden" value="">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"  for="focusedInput">Teacher: </label>
                                            <div class="controls">
                                              <input class="input-xlarge tcname" name="teachername"  type="text" value="">
                                              <input class="txteattheadTeaID1" name="txteattheadTeaID1[]"  type="hidden" value="">
                                            </div>
                                        </div>
                                    </div>
                              </div> 
                        </div>

                        <div class="day2 showday showday2 displaynone" style="border: 1px solid #ededed; border-radius:5px; padding: 20px; width: 33%; margin:10px;">
                          <h4>Day2</h4><br>
                            <div class="control-group showday1 ">
                                <label class="control-label"  for="focusedInput" >Day:</label>
                                <div class="controls">
                                  <select id="txteattheadDay1" name="txteattheadDay1[]" class="day_day2" title="">
                                     <option value="">Please Select A Day</option>
                                     <option value="Monday">Monday</option>          
                                     <option value="Tuesday">Tuesday</option>          
                                     <option value="Wednesday">Wednesday</option>          
                                     <option value="Thursday">Thursday</option>          
                                     <option value="Friday">Friday</option>          
                                     <option value="Saturday">Saturday</option>          
                                     <option value="Sunday">Sunday</option>            
                                   </select>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label"  for="focusedInput">Session numbers : </label>
                                <div class="controls">
                                  <input type="text" id="session_number2" name="session_number[]" value="1">
                                </div>
                            </div>

                            <div class="groupme2 sch_2_1">
                                    <div class="control-group">
                                        <label class="control-label"  for="focusedInput">Schedule Available : </label>
                                        <div class="controls">
                                          <select class="select_sched2 schedid" alt="sch_2_1" name="sched_codes[]">
                                                             
                                           </select>
                                        </div>
                                    </div>
                                    <div class="appendme">
                                        <div class="control-group">
                                            <label class="control-label"  for="focusedInput">From:</label>
                                            <div class="controls">
                                              <input class="input-xlarge txteattheadHrFr1" name="txteattheadHrFr1[]"  type="text" value="">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"  for="focusedInput">To:</label>
                                            <div class="controls">
                                              <input class="input-xlarge txteattheadHrTo1" name="txteattheadHrTo1[]"   type="text" value="">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"  for="focusedInput">Room: </label>
                                            <div class="controls">
                                              <input class="input-xlarge txteattheadRmname" type="text" value="">
                                              <input class="input-xlarge txteattheadRm1" name="txteattheadRm1[]"   type="hidden" value="">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"  for="focusedInput">Teacher: </label>
                                            <div class="controls">
                                              <input class="input-xlarge tcname" name="teachername"  type="text" value="">
                                              <input class="txteattheadTeaID1" name="txteattheadTeaID1[]"  type="hidden" value="">
                                            </div>
                                        </div>
                                    </div>
                              </div>

                              <div class="groupme2 sch_2_2 displaynone">
                                    <div class="control-group">
                                        <label class="control-label"  for="focusedInput">Schedule Available (Session 2) : </label>
                                        <div class="controls">
                                          <select class="select_sched2 schedid" alt="sch_2_2" name="sched_codes[]">
                                                             
                                           </select>
                                        </div>
                                    </div>
                                     <div class="appendme">
                                        <div class="control-group">
                                            <label class="control-label"  for="focusedInput">From:</label>
                                            <div class="controls">
                                              <input class="input-xlarge txteattheadHrFr1" name="txteattheadHrFr1[]"  type="text" value="">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"  for="focusedInput">To:</label>
                                            <div class="controls">
                                              <input class="input-xlarge txteattheadHrTo1" name="txteattheadHrTo1[]"   type="text" value="">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"  for="focusedInput">Room: </label>
                                            <div class="controls">
                                              <input class="input-xlarge txteattheadRmname" type="text" value="">
                                              <input class="input-xlarge txteattheadRm1" name="txteattheadRm1[]"   type="hidden" value="">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"  for="focusedInput">Teacher: </label>
                                            <div class="controls">
                                              <input class="input-xlarge tcname" name="teachername"  type="text" value="">
                                              <input class="txteattheadTeaID1" name="txteattheadTeaID1[]"  type="hidden" value="">
                                            </div>
                                        </div>
                                    </div>
                              </div>     
                        </div>    

                        <div class="day3 showday showday3 displaynone" style="border: 1px solid #ededed; border-radius:5px; padding: 20px; width: 33%; margin:10px;">
                            <h4>Day3</h4><br>
                            <div class="control-group showday1 ">
                                <label class="control-label"  for="focusedInput" >Day:</label>
                                <div class="controls">
                                  <select id="txteattheadDay1" name="txteattheadDay1[]" class="day_day3"  title="">
                                     <option value="">Please Select A Day</option>
                                     <option value="Monday">Monday</option>          
                                     <option value="Tuesday">Tuesday</option>          
                                     <option value="Wednesday">Wednesday</option>          
                                     <option value="Thursday">Thursday</option>          
                                     <option value="Friday">Friday</option>          
                                     <option value="Saturday">Saturday</option>          
                                     <option value="Sunday">Sunday</option>          
                                   </select>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label"  for="focusedInput">Session numbers : </label>
                                <div class="controls">
                                  <input type="text" id="session_number3" name="session_number[]" value="1">
                                </div>
                            </div>

                            <div class="groupme2 sch_3_1">
                                    <div class="control-group">
                                        <label class="control-label"  for="focusedInput">Schedule Available : </label>
                                        <div class="controls">
                                          <select class="select_sched3 schedid" alt="sch_3_1" name="sched_codes[]">
                                                             
                                           </select>
                                        </div>
                                    </div>
                                    <div class="appendme">
                                        <div class="control-group">
                                            <label class="control-label"  for="focusedInput">From:</label>
                                            <div class="controls">
                                              <input class="input-xlarge txteattheadHrFr1" name="txteattheadHrFr1[]"  type="text" value="">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"  for="focusedInput">To:</label>
                                            <div class="controls">
                                              <input class="input-xlarge txteattheadHrTo1" name="txteattheadHrTo1[]"   type="text" value="">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"  for="focusedInput">Room: </label>
                                            <div class="controls">
                                             <input class="input-xlarge txteattheadRmname" type="text" value="">
                                              <input class="input-xlarge txteattheadRm1" name="txteattheadRm1[]"   type="hidden" value="">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"  for="focusedInput">Teacher: </label>
                                            <div class="controls">
                                              <input class="input-xlarge tcname" name="teachername"  type="text" value="">
                                              <input class="txteattheadTeaID1" name="txteattheadTeaID1[]"  type="hidden" value="">
                                            </div>
                                        </div>
                                    </div>
                              </div>

                              <div class="groupme2 sch_3_2 displaynone">
                                    <div class="control-group">
                                        <label class="control-label"  for="focusedInput">Schedule Available (Session 2) : </label>
                                        <div class="controls">
                                          <select class="select_sched3 schedid" alt="sch_3_2" name="sched_codes[]">
                                                             
                                           </select>
                                        </div>
                                    </div>
                                     <div class="appendme">
                                        <div class="control-group">
                                            <label class="control-label"  for="focusedInput">From:</label>
                                            <div class="controls">
                                              <input class="input-xlarge txteattheadHrFr1" name="txteattheadHrFr1[]"  type="text" value="">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"  for="focusedInput">To:</label>
                                            <div class="controls">
                                              <input class="input-xlarge txteattheadHrTo1" name="txteattheadHrTo1[]"   type="text" value="">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"  for="focusedInput">Room: </label>
                                            <div class="controls">
                                              <input class="input-xlarge txteattheadRmname" type="text" value="">
                                              <input class="input-xlarge txteattheadRm1" name="txteattheadRm1[]"   type="hidden" value="">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"  for="focusedInput">Teacher: </label>
                                            <div class="controls">
                                              <input class="input-xlarge tcname" name="teachername"  type="text" value="">
                                              <input class="txteattheadTeaID1" name="txteattheadTeaID1[]"  type="hidden" value="">
                                            </div>
                                        </div>
                                    </div>
                              </div>   
                            
                        </div>    

                        <div class="day4 showday showday4 displaynone" style="border: 1px solid #ededed; border-radius:5px; padding: 20px; width: 33%; margin:10px;">
                            <h4>Day4</h4><br>
                            <div class="control-group">
                                <label class="control-label"  for="focusedInput" >Day:</label>
                                <div class="controls">
                                  <select id="txteattheadDay1" name="txteattheadDay1[]" class="day_day4"  onfocus="JAVASCRIPT:setMessage(document.forms[0].txteattheadDay1)" title="">
                                     <option value="">Please Select A Day</option>
                                     <option value="Monday">Monday</option>          
                                     <option value="Tuesday">Tuesday</option>          
                                     <option value="Wednesday">Wednesday</option>          
                                     <option value="Thursday">Thursday</option>          
                                     <option value="Friday">Friday</option>          
                                     <option value="Saturday">Saturday</option>          
                                     <option value="Sunday">Sunday</option>     
                                   </select>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label"  for="focusedInput">Session numbers : </label>
                                <div class="controls">
                                  <input type="text" id="session_number4" name="session_number[]" value="1">
                                </div>
                            </div>

                            <div class="groupme2 sch_4_1">
                                    <div class="control-group">
                                        <label class="control-label"  for="focusedInput">Schedule Available : </label>
                                        <div class="controls">
                                          <select class="select_sched4 schedid" alt="sch_4_1" name="sched_codes[]">
                                                             
                                           </select>
                                        </div>
                                    </div>
                                    <div class="appendme">
                                        <div class="control-group">
                                            <label class="control-label"  for="focusedInput">From:</label>
                                            <div class="controls">
                                              <input class="input-xlarge txteattheadHrFr1" name="txteattheadHrFr1[]"  type="text" value="">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"  for="focusedInput">To:</label>
                                            <div class="controls">
                                              <input class="input-xlarge txteattheadHrTo1" name="txteattheadHrTo1[]"   type="text" value="">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"  for="focusedInput">Room: </label>
                                            <div class="controls">
                                              <input class="input-xlarge txteattheadRmname" type="text" value="">
                                              <input class="input-xlarge txteattheadRm1" name="txteattheadRm1[]"   type="hidden" value="">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"  for="focusedInput">Teacher: </label>
                                            <div class="controls">
                                              <input class="input-xlarge tcname" name="teachername"  type="text" value="">
                                              <input class="txteattheadTeaID1" name="txteattheadTeaID1[]"  type="hidden" value="">
                                            </div>
                                        </div>
                                    </div>
                              </div>

                              <div class="groupme2 sch_4_2 displaynone">
                                    <div class="control-group">
                                        <label class="control-label"  for="focusedInput">Schedule Available (Session 2) : </label>
                                        <div class="controls">
                                          <select class="select_sched4 schedid" alt="sch_4_2" name="sched_codes[]">
                                                             
                                           </select>
                                        </div>
                                    </div>
                                     <div class="appendme">
                                        <div class="control-group">
                                            <label class="control-label"  for="focusedInput">From:</label>
                                            <div class="controls">
                                              <input class="input-xlarge txteattheadHrFr1" name="txteattheadHrFr1[]"  type="text" value="">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"  for="focusedInput">To:</label>
                                            <div class="controls">
                                              <input class="input-xlarge txteattheadHrTo1" name="txteattheadHrTo1[]"   type="text" value="">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"  for="focusedInput">Room: </label>
                                            <div class="controls">
                                              <input class="input-xlarge txteattheadRmname" type="text" value="">
                                              <input class="input-xlarge txteattheadRm1" name="txteattheadRm1[]"   type="hidden" value="">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"  for="focusedInput">Teacher: </label>
                                            <div class="controls">
                                              <input class="input-xlarge tcname" name="teachername"  type="text" value="">
                                              <input class="txteattheadTeaID1" name="txteattheadTeaID1[]"  type="hidden" value="">
                                            </div>
                                        </div>
                                    </div>
                              </div>  

                        </div>    

                        <div class="day5 showday showday5 displaynone" style="border: 1px solid #ededed; border-radius:5px; padding: 20px; width: 33%; margin:10px;">
                          <h4>Day5</h4><br>
                            <div class="control-group">
                                <label class="control-label"  for="focusedInput" >Day:</label>
                                <div class="controls">
                                  <select id="txteattheadDay1" name="txteattheadDay1[]" class="day_day5"  onfocus="JAVASCRIPT:setMessage(document.forms[0].txteattheadDay1)" title="">
                                     <option value="">Please Select A Day</option>
                                     <option value="Monday">Monday</option>          
                                     <option value="Tuesday">Tuesday</option>          
                                     <option value="Wednesday">Wednesday</option>          
                                     <option value="Thursday">Thursday</option>          
                                     <option value="Friday">Friday</option>          
                                     <option value="Saturday">Saturday</option>          
                                     <option value="Sunday">Sunday</option>      
                                   </select>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label"  for="focusedInput">Session numbers : </label>
                                <div class="controls">
                                  <input type="text" id="session_number5" value="1" name="session_number[]">
                                </div>
                            </div>

                            <div class="groupme2 sch_5_1">
                                    <div class="control-group">
                                        <label class="control-label"  for="focusedInput">Schedule Available : </label>
                                        <div class="controls">
                                          <select class="select_sched5 schedid" alt="sch_5_1" name="sched_codes[]">
                                                             
                                           </select>
                                        </div>
                                    </div>
                                    <div class="appendme">
                                        <div class="control-group">
                                            <label class="control-label"  for="focusedInput">From:</label>
                                            <div class="controls">
                                              <input class="input-xlarge txteattheadHrFr1" name="txteattheadHrFr1[]"  type="text" value="">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"  for="focusedInput">To:</label>
                                            <div class="controls">
                                              <input class="input-xlarge txteattheadHrTo1" name="txteattheadHrTo1[]"   type="text" value="">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"  for="focusedInput">Room: </label>
                                            <div class="controls">
                                              <input class="input-xlarge txteattheadRmname" type="text" value="">
                                              <input class="input-xlarge txteattheadRm1" name="txteattheadRm1[]"   type="hidden" value="">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"  for="focusedInput">Teacher: </label>
                                            <div class="controls">
                                              <input class="input-xlarge tcname" name="teachername"  type="text" value="">
                                              <input class="txteattheadTeaID1" name="txteattheadTeaID1[]"  type="hidden" value="">
                                            </div>
                                        </div>
                                    </div>
                              </div>

                              <div class="groupme2 sch_5_2 displaynone">
                                    <div class="control-group">
                                        <label class="control-label"  for="focusedInput">Schedule Available (Session 2) : </label>
                                        <div class="controls">
                                          <select class="select_sched5 schedid" alt="sch_5_2" name="sched_codes[]">
                                                             
                                           </select>
                                        </div>
                                    </div>
                                     <div class="appendme">
                                        <div class="control-group">
                                            <label class="control-label"  for="focusedInput">From:</label>
                                            <div class="controls">
                                              <input class="input-xlarge txteattheadHrFr1" name="txteattheadHrFr1[]"  type="text" value="">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"  for="focusedInput">To:</label>
                                            <div class="controls">
                                              <input class="input-xlarge txteattheadHrTo1" name="txteattheadHrTo1[]"   type="text" value="">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"  for="focusedInput">Room: </label>
                                            <div class="controls">
                                              <input class="input-xlarge txteattheadRmname" type="text" value="">
                                              <input class="input-xlarge txteattheadRm1" name="txteattheadRm1[]"   type="hidden" value="">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"  for="focusedInput">Teacher: </label>
                                            <div class="controls">
                                              <input class="input-xlarge tcname" name="teachername"  type="text" value="">
                                              <input class="txteattheadTeaID1" name="txteattheadTeaID1[]"  type="hidden" value="">
                                            </div>
                                        </div>
                                    </div>
                              </div>  
                        </div>    

                        <div class="day6 showday showday6 displaynone" style="border: 1px solid #ededed; border-radius:5px; padding: 20px; width: 33%; margin:10px;">
                           <h4>Day6</h4><br>
                            <div class="control-group">
                                <label class="control-label"  for="focusedInput" >Day:</label>
                                <div class="controls">
                                  <select id="txteattheadDay1" name="txteattheadDay1[]" class="day_day6"  title="">
                                     <option value="">Please Select A Day</option>
                                     <option value="Monday">Monday</option>          
                                     <option value="Tuesday">Tuesday</option>          
                                     <option value="Wednesday">Wednesday</option>          
                                     <option value="Thursday">Thursday</option>          
                                     <option value="Friday">Friday</option>          
                                     <option value="Saturday">Saturday</option>          
                                     <option value="Sunday">Sunday</option>           
                                   </select>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label"  for="focusedInput">Session numbers : </label>
                                <div class="controls">
                                  <input type="text" id="session_number6" value="1" name="session_number[]">
                                </div>
                            </div>

                            <div class="groupme2 sch_6_1">
                                    <div class="control-group">
                                        <label class="control-label"  for="focusedInput">Schedule Available : </label>
                                        <div class="controls">
                                          <select class="select_sched6 schedid" alt="sch_6_1" name="sched_codes[]">
                                                             
                                           </select>
                                        </div>
                                    </div>
                                    <div class="appendme">
                                        <div class="control-group">
                                            <label class="control-label"  for="focusedInput">From:</label>
                                            <div class="controls">
                                              <input class="input-xlarge txteattheadHrFr1" name="txteattheadHrFr1[]"  type="text" value="">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"  for="focusedInput">To:</label>
                                            <div class="controls">
                                              <input class="input-xlarge txteattheadHrTo1" name="txteattheadHrTo1[]"   type="text" value="">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"  for="focusedInput">Room: </label>
                                            <div class="controls">
                                              <input class="input-xlarge txteattheadRmname" type="text" value="">
                                              <input class="input-xlarge txteattheadRm1" name="txteattheadRm1[]"   type="hidden" value="">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"  for="focusedInput">Teacher: </label>
                                            <div class="controls">
                                              <input class="input-xlarge tcname" name="teachername"  type="text" value="">
                                              <input class="txteattheadTeaID1" name="txteattheadTeaID1[]"  type="hidden" value="">
                                            </div>
                                        </div>
                                    </div>
                              </div>

                              <div class="groupme2 sch_6_2 displaynone">
                                    <div class="control-group">
                                        <label class="control-label"  for="focusedInput">Schedule Available (Session 2) : </label>
                                        <div class="controls">
                                          <select class="select_sched6 schedid" alt="sch_6_2" name="sched_codes[]">
                                                             
                                           </select>
                                        </div>
                                    </div>
                                     <div class="appendme">
                                        <div class="control-group">
                                            <label class="control-label"  for="focusedInput">From:</label>
                                            <div class="controls">
                                              <input class="input-xlarge txteattheadHrFr1" name="txteattheadHrFr1[]"  type="text" value="">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"  for="focusedInput">To:</label>
                                            <div class="controls">
                                              <input class="input-xlarge txteattheadHrTo1" name="txteattheadHrTo1[]"   type="text" value="">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"  for="focusedInput">Room: </label>
                                            <div class="controls">
                                              <input class="input-xlarge txteattheadRmname" type="text" value="">
                                              <input class="input-xlarge txteattheadRm1" name="txteattheadRm1[]"   type="hidden" value="">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"  for="focusedInput">Teacher: </label>
                                            <div class="controls">
                                              <input class="input-xlarge tcname" name="teachername"  type="text" value="">
                                              <input class="txteattheadTeaID1" name="txteattheadTeaID1[]"  type="hidden" value="">
                                            </div>
                                        </div>
                                    </div>
                              </div>  
                        </div>    

                        <div class="day7 showday showday7 displaynone" style="border: 1px solid #ededed; border-radius:5px; padding: 20px; width: 33%; margin:10px;">    
                            <h4>Day7</h4><br>
                            <div class="control-group">
                                <label class="control-label"  for="focusedInput" >Day:</label>
                                <div class="controls">
                                  <select id="txteattheadDay1" name="txteattheadDay1[]" class="day_day7"  onfocus="JAVASCRIPT:setMessage(document.forms[0].txteattheadDay1)" title="">
                                     <option value="">Please Select A Day</option>
                                     <option value="Monday">Monday</option>          
                                     <option value="Tuesday">Tuesday</option>          
                                     <option value="Wednesday">Wednesday</option>          
                                     <option value="Thursday">Thursday</option>          
                                     <option value="Friday">Friday</option>          
                                     <option value="Saturday">Saturday</option>          
                                     <option value="Sunday">Sunday</option>       
                                   </select>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label"  for="focusedInput">Session numbers : </label>
                                <div class="controls">
                                  <input type="text" id="session_number7" value="1" name="session_number[]">
                                </div>
                            </div>

                            <div class="groupme2 sch_7_1">
                                    <div class="control-group">
                                        <label class="control-label"  for="focusedInput">Schedule Available : </label>
                                        <div class="controls">
                                          <select class="select_sched7 schedid" alt="sch_7_1" name="sched_codes[]">
                                                             
                                           </select>
                                        </div>
                                    </div>
                                    <div class="appendme">
                                        <div class="control-group">
                                            <label class="control-label"  for="focusedInput">From:</label>
                                            <div class="controls">
                                              <input class="input-xlarge txteattheadHrFr1" name="txteattheadHrFr1[]"  type="text" value="">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"  for="focusedInput">To:</label>
                                            <div class="controls">
                                              <input class="input-xlarge txteattheadHrTo1" name="txteattheadHrTo1[]"   type="text" value="">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"  for="focusedInput">Room: </label>
                                            <div class="controls">
                                              <input class="input-xlarge txteattheadRmname" type="text" value="">
                                              <input class="input-xlarge txteattheadRm1" name="txteattheadRm1[]"   type="hidden" value="">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"  for="focusedInput">Teacher: </label>
                                            <div class="controls">
                                              <input class="input-xlarge tcname" name="teachername"  type="text" value="">
                                              <input class="txteattheadTeaID1" name="txteattheadTeaID1[]"  type="hidden" value="">
                                            </div>
                                        </div>
                                    </div>
                              </div>

                              <div class="groupme2 sch_7_2 displaynone">
                                    <div class="control-group">
                                        <label class="control-label"  for="focusedInput">Schedule Available (Session 2) : </label>
                                        <div class="controls">
                                          <select class="select_sched7 schedid" alt="sch_7_2" name="sched_codes[]">
                                                             
                                           </select>
                                        </div>
                                    </div>
                                     <div class="appendme">
                                        <div class="control-group">
                                            <label class="control-label"  for="focusedInput">From:</label>
                                            <div class="controls">
                                              <input class="input-xlarge txteattheadHrFr1" name="txteattheadHrFr1[]"  type="text" value="">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"  for="focusedInput">To:</label>
                                            <div class="controls">
                                              <input class="input-xlarge txteattheadHrTo1" name="txteattheadHrTo1[]"   type="text" value="">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"  for="focusedInput">Room: </label>
                                            <div class="controls">
                                              <input class="input-xlarge txteattheadRmname" type="text" value="">
                                              <input class="input-xlarge txteattheadRm1" name="txteattheadRm1[]"   type="hidden" value="">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"  for="focusedInput">Teacher: </label>
                                            <div class="controls">
                                              <input class="input-xlarge tcname" name="teachername"  type="text" value="">
                                              <input class="txteattheadTeaID1" name="txteattheadTeaID1[]"  type="hidden" value="">
                                            </div>
                                        </div>
                                    </div>
                              </div>  

                        </div>    

                    

                            
                            <div class="form-actions">
                              <!--<button type="submit" value="Submit" class="btn btn-primary">Save changes</button>-->
                              <button type="button"  class="btn btn-primary"  id="createschedme">Save changes</button>
                              <button type="reset" class="btn">Cancel</button>
                            </div>
                          </fieldset>
                        </form> 
                     

                    </div>
                </div><!--/span-->

            </div><!--/row-->
                    <!-- content ends -->
            </div><!--/#content.span10-->