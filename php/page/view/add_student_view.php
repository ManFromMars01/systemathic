<div id="content" class="span10">
            <!-- content starts -->
            <!-- <div>
                <ul class="breadcrumb ">
                    <li>
                        <a href="#" class="breadcolor">Home</a> <span class="divider">/</span>
                    </li>
                    <li>
                        <a href="#" class="breadcolor">Forms</a>
                    </li>
                </ul>
            </div> -->  
            
            <div class="row-fluid sortable">
                <div class="box span12">
                    <div class="box-header well boxheadercolor" data-original-title>
                        <h2><i class="icon-edit"></i> Add  Record </h2>
                        <div class="box-icon">
                            <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
                            <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                            <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                        </div>
                    </div>
                    <div class="box-content">
                        <form class="form-horizontal validateme" action="@UpdatetStudentFormAction@"  id="form5" name="form5" method="post"  >
                          <fieldset>
                            <input type="hidden" id="MODE" name="MODE" value="1">
                            
                            <div class="groupme" style="border: 1px solid #ededed; border-radius:5px; padding: 20px; width: 30%; margin:10px;">
                                <div class="toggleme">
                                <h4 class="h4color">Basic Details</h4> 
                                    <br />
                                <div class="control-group">
                                    <label class="control-label" for="focusedInput">Country ID:</label>
                                    <div class="controls">
                                      <input class="input-xlarge focused" name="txttcustomerCountryID" id="focusedInput" type="text" value="<?php echo $_SESSION['UserValue1'] ;?>" readonly>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="focusedInput">Branch ID:</label>
                                    <div class="controls">
                                      <input class="input-xlarge focused" name="txttcustomerBranchID" id="focusedInput" type="text" value="<?php echo $_SESSION['UserValue2'] ;?>" readonly>
                                    </div>
                                </div>

                                <!--<div class="control-group">
                                    <label class="control-label" for="focusedInput">Cust No:</label>
                                    <div class="controls">
                                      <input class="input-xlarge focused" name="txttcustomerCustNo" id="focusedInput" type="text" value="@tcustomerCustNo@" readonly>
                                    </div>
                                </div>-->

                                <div class="control-group">
                                    <label class="control-label"  for="focusedInput">Student ID:</label>
                                    <div class="controls">
                                      <input class="input-xlarge focused" name="txttcustomerStudentID" id="focusedInput" type="text" value="" readonly>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label"  for="focusedInput">Last Name:</label>
                                    <div class="controls">
                                      <input class="input-xlarge focused" name="txttcustomerSurName"  type="text" id="lname" value="" required>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="focusedInput">First Name: </label>
                                    <div class="controls">
                                      <input class="input-xlarge focused" name="txttcustomerFirstName"  type="text" id="fname" value="" required>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="focusedInput">Middle Name: </label>
                                    <div class="controls">
                                      <input class="input-xlarge focused" name="txttcustomerMiddleName" id="mname" type="text" value="" required>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <p style="cursor:pointer; text-decoration:underline;" id="enableme">Change Local Name</p>
                                    <label class="control-label" for="focusedInput">Local Lastname:</label>
                                    <div class="controls">
                                      <input class="input-xlarge focused disableme" name="txttcustomerLSurname" type="text" id="llname" value=""  readonly>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="focusedInput">Local First Name</label>
                                    <div class="controls">
                                      <input class="input-xlarge focused disableme" name="txttcustomerLFirstName"  type="text" id="lfname" value="" readonly>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="focusedInput">Local Middle Name: </label>
                                    <div class="controls">
                                      <input class="input-xlarge focused disableme" name="txttcustomerLMiddleName"  id="lmname" type="text" value=""  readonly>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="selectError3">Gender</label>
                                    <div class="controls">
                                      <select id="selectError3" Name="txttcustomerGender">
                                        <option value="Male"  @SELECTEDF23_11_1@>Male</option>          
                                        <option value="Female"  @SELECTEDF23_11_2@>Female</option>    
                                      </select>
                                    </div>
                                </div>

                              

                                <div class="control-group">
                                  <label class="control-label" for="date01">Birthday</label>
                                  <div class="controls">
                                    <input type="text" class="input-xlarge datepicker" name="txttcustomerBirthday" id="" value="">
                                  </div>
                                </div>
                              </div>
                            </div>
                            
                            <!--End Basic Info-->

                            
                            <div class="groupme" style="border: 1px solid #ededed; border-radius:5px; padding: 20px; width: 30%; margin:10px;">
                                <h4 class="h4color">Address And Contact Details</h4>
                                <br />
                                <div class="control-group">
                                    <label class="control-label" for="focusedInput">City:</label>
                                    <div class="controls">
                                      <input class="input-xlarge focused" name="txttcustomerCity" id="focusedInput" type="text" value="">
                                    </div>
                                </div>


                                <div class="control-group">
                                    <label class="control-label" for="focusedInput">Zip:</label>
                                    <div class="controls">
                                      <input class="input-xlarge focused" name="txttcustomerZip" id="focusedInput" type="text" value="">
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="focusedInput">Phone:</label>
                                    <div class="controls">
                                      <input class="input-xlarge focused" name="txttcustomerPhone"  id="focusedInput" type="text" value="">
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="focusedInput">Mobile:</label>
                                    <div class="controls">
                                      <input class="input-xlarge focused" name="txttcustomerMobile" id="focusedInput" type="text" value="">
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="focusedInput">Email:</label>
                                    <div class="controls">
                                      <input class="input-xlarge focused" name="txttcustomerEmail" id="focusedInput" type="email" value="" required>
                                    </div>
                                </div>
                            </div>

                            <!-- End Of Address-->

                            

                            <div class="groupme" style="border: 1px solid #ededed; border-radius:5px; padding: 20px; width: 30%; margin:10px;">
                                <h4>Enrollment Status</h4><br>
                                

                                 <div class="control-group">
                                    <label class="control-label" for="selectError3">Level Type</label>
                                    <div class="controls">
                                      <select id="txttcustomerLevelID" name="txttcustomerLevelID" title="">
                                           <?php foreach($level as $levels): ?>
                                              <option value="<?php echo $levels['ID'] ?>"><?php echo $levels['Description'] ?></option>
                                           <?php endforeach; ?>
                                      </select>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="focusedInput">Tier ID:</label>
                                    <div class="controls">
                                      <select name="txttcustomerTierID">
                                           <?php foreach($tier as $tiers): ?>
                                              <option value="<?php echo $tiers['ID'] ?>"><?php echo $tiers['Description'] ?></option>
                                           <?php endforeach; ?>
                                      </select>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="selectError3">Customer Type</label>
                                    <div class="controls">
                                      <select id="txttcustomerCustType" name="txttcustomerCustType"  onfocus="JAVASCRIPT:setMessage(document.forms[0].txttcustomerCustType)" title="">
                                         <option value="Assessment">Assessment</option>          
                                         <option value="Trial Class">Trial Class</option>          
                                         <option value="For Admission">For Admission</option>          
                                         <option value="ReEnrollee">ReEnrollee</option>          
                                         <option value="Continuing">Continuing</option>          
                                       </select>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="selectError3">Reg Type</label>
                                    <div class="controls">
                                      <select id="txttcustomerRegType" name="txttcustomerRegType"  onfocus="JAVASCRIPT:setMessage(document.forms[0].txttcustomerRegType)" title="">
                                       <option value="Waiting">Waiting</option>          
                                       <option value="For Schedule">For Schedule</option>          
                                       <option value="For Payment"  >For Payment</option>          
                                       <option value="For Kit Issuance">For Kit Issuance</option>          
                                       <option value="Admitted">Admitted</option>          
                                       <option value="Stopped">Stopped</option>          
                                       <option value="Graduate">Graduate</option>          
                                     </select>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="focusedInput">School:</label>
                                    <div class="controls">
                                      <input class="input-xlarge focused" name="txttcustomerSchool" type="text" value="">
                                    </div>
                                </div>
                            </div>
                            <!--Enrollment Status-->
                                
                            <div class="groupme" style="border: 1px solid #ededed; border-radius:5px; padding: 20px; width: 30%; margin:10px;">
                                <h4>Mother's Information</h4><br>
                                <div class="control-group">
                                    <label class="control-label" for="focusedInput">Fullname:</label>
                                    <div class="controls">
                                      <input class="input-xlarge focused" name="txttcustomerMother" type="text" value="" required>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="focusedInput">Occupation:</label>
                                    <div class="controls">
                                      <input class="input-xlarge focused" name="txttcustomerMOccupation"  type="text" value="" required>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="focusedInput">Mobile:</label>
                                    <div class="controls">
                                      <input class="input-xlarge focused" name="txttcustomerMMobile" type="text" value="" required>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="focusedInput">Email:</label>
                                    <div class="controls">
                                      <input class="input-xlarge focused" name="txttcustomerMEmail"  type="email" value="" >
                                    </div>
                                </div>
                            </div>        
                            <!--End Mothers Info-->


                             <div class="groupme" style="border: 1px solid #ededed; border-radius:5px; padding: 20px; width: 30%; margin:10px;">
                                <h4>Father's Information</h4><br>
                                <div class="control-group">
                                    <label class="control-label" for="focusedInput">Full Name:</label>
                                    <div class="controls">
                                      <input class="input-xlarge focused" name="txttcustomerFather"  type="text" value="" required>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="focusedInput">Occupation:</label>
                                    <div class="controls">
                                      <input class="input-xlarge focused" name="txttcustomerFOccupation"  type="text" value="" required>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="focusedInput">Mobile:</label>
                                    <div class="controls">
                                      <input class="input-xlarge focused" name="txttcustomerFMobile"  type="text" value="" required>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="focusedInput">Email:</label>
                                    <div class="controls">
                                      <input class="input-xlarge focused" name="txttcustomerFEmail" type="email" value="">
                                    </div>
                                </div>
                            </div>    

                            
                            <div class="groupme" style="border: 1px solid #ededed; border-radius:5px; padding: 20px; width: 30%; margin:10px;">
                                <h4>Status</h4><br>
                                <div class="control-group">
                                    <label class="control-label" for="focusedInput">Status:</label>
                                    <div class="controls">
                                      <input class="input-xlarge focused" name="txttcustomerStatus" id="focusedInput" type="text" value="">
                                    </div>
                                </div>

                                

                                <div class="control-group">
                                    <label class="control-label" for="focusedInput">Refferal ID:</label>
                                    <div class="controls">
                                      <select name="txttcustomerReferralID">
                                           <?php foreach($referral as $referrals ): ?>
                                            <option value="<?php echo $referrals['ID'] ?>"><?php echo $referrals['Description'];?></option>
                                           <?php endforeach; ?>
                                      </select>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="focusedInput">Stopped Date:</label>
                                    <div class="controls">
                                      <input class="input-xlarge datepicker" name="txttcustomerStoppedDate" id="datepicker2" type="text" value="">
                                    </div>
                                </div>
                            </div>




                                     
                           
                            <div class="form-actions">
                              <!--<button type="submit" value="Submit" class="btn btn-primary">Save changes</button>-->
                              <button type="button"  class="btn btn-primary submitme"  id="savemes">Submit</button>
                              <button type="reset" class="btn">Cancel</button>
                            </div>
                          </fieldset>
                        </form>  

                    </div>
                </div><!--/span-->

            </div><!--/row-->
                    <!-- content ends -->
            </div><!--/#content.span10-->
