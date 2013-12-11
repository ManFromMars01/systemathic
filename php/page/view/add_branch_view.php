
<div id="content" class="span10">
            
            <?php echo $success; ?>

            <div class="row-fluid sortable">
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-edit"></i> Edit  Branch  </h2>
                        <div class="box-icon">
                            <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
                            <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                            <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                        </div>
                    </div>
                    <div class="box-content">
                        <form class="form-horizontal" method="post" >
                          <fieldset><br />
                            
                            <input type="hidden" name="countryid" value="<?php echo $countryid; ?>">
                            
                            <h4>Person Information</h4>
                           

                            <div class="control-group">
                                <label class="control-label">Student ID:</label>
                                <div class="controls">
                                   <select id="student_id" name="student_id" data-rel="chosen" data-placeholder="Please Select StudentID">
                                  <?php foreach($tcustomer as $customers): ?>
                                    <option value="<?php echo $customers['StudentID'] ?>"><?php echo $customers['StudentID'] ?></option>
                                    <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Name (Local):</label>
                                <div class="controls">
                                  <input name="contact" type="text" value=""  required/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Name (Chinese):</label>
                                <div class="controls">
                                  <input name="contact" type="text" value=""  required/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Date:</label>
                                <div class="controls">
                                  <input type="text"  name="dob" class="datepicker">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Gender:</label>
                                <div class="controls">
                                  <select name="gender">
                                      <option value="Male">Male</option>
                                      <option value="Female">Female</option>
                                  </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Skype:</label>
                                <div class="controls">
                                    <input type="text" name="skype">
                                </div>
                            </div>

                            <br />


                            
                            <h4>Cost and Fees</h4><br />
                            <div class="control-group">
                                <label class="control-label">Training Fee:</label>
                                <div class="controls">
                                  <input type="text"  name="training_fee" >
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Franchise Fee:</label>
                                <div class="controls">
                                  <input type="text"  name="franchise_fee" >
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Franchise Cost:</label>
                                <div class="controls">
                                  <input type="text"  name="franchise_cost" >
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Commision:</label>
                                <div class="controls">
                                  <input type="text"  name="commision" >
                                </div>
                            </div>

                            




                            


 

                            <h4>Center Information</h4>
                            <div class="control-group">
                                <label class="control-label">Center Code:</label>
                                <div class="controls">
                                  <input name="branch_code" type="text" value="" required />
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Branch Name:</label>
                                <div class="controls">
                                  <input name="branch_name" type="text" value="" required />
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Phone:</label>
                                <div class="controls">
                                  <input name="phone"  type="text" value="" required />
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Email:</label>
                                <div class="controls">
                                  <input  name="email"  type="text"  value="" required />
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Address1:</label>
                                <div class="controls">
                                  <textarea name="address1" required></textarea>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Address2:</label>
                                <div class="controls">
                                  <textarea name="address2"></textarea>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">HQ Operation:</label>
                                <div class="controls">
                                  <select name="hq">
                                        <option>No</option>
                                       <option>Yes</option>                                 
                                  </select>
                                </div>
                            </div>

                            <div class="form-actions">
                              <!--<button type="submit" value="Submit" class="btn btn-primary">Save changes</button>-->
                              <button type="submit" name="save"  class="btn btn-primary"  id="saveme">Add Branch</button>
                              <button type="reset" class="btn">Cancel</button>
                            </div>
                          </fieldset>
                        </form> 
                     

                    </div>
                </div><!--/span-->

            </div><!--/row-->
                    <!-- content ends -->
            </div><!--/#content.span10-->