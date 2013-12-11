
<div id="content" class="span10">
            <!-- content starts -->
            <!-- <div>
                <ul class="breadcrumb">
                    <li>
                        <a href="#">Home</a> <span class="divider">/</span>
                    </li>
                    <li>
                        <a href="#">Forms</a>
                    </li>
                </ul>
            </div> -->
            
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
                        <form class="form-horizontal" action="@UpdatetStudentFormAction@"  id="form3" name="form3" method="post" >
                          <fieldset><br />
                            <h4>&nbsp;&nbsp; Information</h4><br />
                            <div class="control-group">
                                <label class="control-label" for="focusedInput">Country:</label>
                                <div class="controls">
                                  <!--<input class="input-xlarge focused" name="txttcountryID" id="focusedInput" type="text" value="@tcountryID@">-->
                                  <select name="countryid" >
                                        <option value="AF">Afghanistan</option>
                                        
                                    </select>  

                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Contact:</label>
                                <div class="controls">
                                  <input name="contact" type="text" value="" />
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