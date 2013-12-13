
<div id="content" class="span10">
           
            <?php echo $success; ?>

            <div class="row-fluid sortable">
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-edit"></i> Add  Country </h2>
                        <div class="box-icon">
                            <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
                            <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                            <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                        </div>
                    </div>
                    <div class="box-content">
                        <form class="form-horizontal" method="post" >
                          <fieldset><br />
                            <h4>&nbsp;&nbsp; Country</h4><br />
                            <div class="control-group">
                                <label class="control-label" for="focusedInput">Country:</label>
                                <div class="controls">
                                  <!--<input class="input-xlarge focused" name="txttcountryID" id="focusedInput" type="text" value="@tcountryID@">-->
                                  <select name="countryid" id="countryid" data-rel="chosen" data-placeholder="Please Select A Country">
                                        <option value=""></option>
                                        <?php foreach($country as $countries): ?>
                                        <option value="<?php echo $countries['id'] ?>"><?php echo $countries['name'] ?></option>                                        
                                        <?php endforeach; ?>
                                    </select>  

                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="focusedInput">Country ID:</label>
                                <div class="controls">
                                    <input id="countryids" type="text" value="" readonly>
                                </div>
                            </div>

                            <h4>Person Information</h4>
                            <div class="control-group">
                                <label class="control-label" for="selectError">Student ID:</label>
                                <div class="controls">
                                  <select id="student_id" name="student_id" data-rel="chosen" data-placeholder="Please Select StudentID">
                                    <option></option>
                                    <?php foreach($tcustomer as $customers): ?>
                                    <option value="<?php echo $customers['StudentID'] ?>"><?php echo $customers['StudentID'] ?></option>
                                    <?php endforeach; ?>
                                  </select>
                                </div>
                              </div>
                            <div class="control-group">
                                <label class="control-label">Name (Local):</label>
                                <div class="controls">
                                  <input name="contact" id="name_local" type="text" value=""  required/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Name (Chinese):</label>
                                <div class="controls">
                                  <input name="contact" id="name_chinese" type="text" value=""  required/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Birth Day:</label>
                                <div class="controls">
                                  <input type="text" id="dob"  name="dob" class="datepicker">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Gender:</label>
                                <div class="controls">
                                  <input type="text" name="gender" id="gender" value="">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Phone:</label>
                                <div class="controls">
                                  <input name="phone" id="phone"  type="text" value="" required />
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Email:</label>
                                <div class="controls">
                                  <input  name="email" id="email" type="text"  value="" required />
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Address1:</label>
                                <div class="controls">
                                  <textarea name="address1" id="address1" required></textarea>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Address2:</label>
                                <div class="controls">
                                  <textarea name="address2" id="address2"></textarea>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Skype:</label>
                                <div class="controls">
                                    <input type="text" name="skype">
                                </div>
                            </div>

                            
                              
                            <h4>&nbsp;&nbsp; Discount Setup</h4><br />
                            <div class="control-group">
                                <label class="control-label">Discount Type:</label>
                                <div class="controls">
                                    <select name="disc_type">
                                       <option Value="0">Fixed</option>
                                       <option value="1">Percentage</option> 
                                    </select>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Discount Group A :</label>
                                <div class="controls">
                                  <input name="groupa" type="text" value="">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Discount Group B :</label>
                                <div class="controls">
                                  <input name="groupb" type="text" value="">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Discount Group C :</label>
                                <div class="controls">
                                  <input name="groupc" type="text" value="">
                                </div>
                            </div>


                             <h4>Main Branch Information</h4>
                            <div class="control-group">
                                <label class="control-label">Center Code:</label>
                                <div class="controls">
                                  <input name="branch_code" id="branch_code" type="text" value="" required />
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
                                  <input name="phone2"  type="text" value="" required />
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Email:</label>
                                <div class="controls">
                                  <input  name="email2"  type="text"  value="" required />
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Address1:</label>
                                <div class="controls">
                                  <textarea name="address1_new" required></textarea>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Address2:</label>
                                <div class="controls">
                                  <textarea name="address2_new"></textarea>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">HQ Operation:</label>
                                <div class="controls">
                                  <select name="hq">
                                        <option value="No">No</option>
                                       <option  value="Yes">Yes</option>                                 
                                  </select>
                                </div>
                            </div>
                            <div class="form-actions">
                              <!--<button type="submit" value="Submit" class="btn btn-primary">Save changes</button>-->
                              <button type="submit" name="save"  class="btn btn-primary"  id="saveme">Add Country</button>
                              <button type="reset" class="btn">Cancel</button>
                            </div>
                          </fieldset>
                        </form> 
                     

                    </div>
                </div><!--/span-->

            </div><!--/row-->
                    <!-- content ends -->
            </div><!--/#content.span10-->