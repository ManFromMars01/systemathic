
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
            
            <?php echo $success; ?>

            <div class="row-fluid sortable">
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-edit"></i> Edit Country Info </h2>
                    </div>
                    <div class="box-content">
                        <form class="form-horizontal" method="post" >
                          <fieldset><br />
                            <h4>&nbsp;&nbsp; Information</h4><br />
                            
                            <div class="control-group">
                                <label class="control-label" for="focusedInput">Country ID:</label>
                                <div class="controls">
                                    <input id="countryids" name="countryid" type="text" value="<?php echo $country->fields['ID'];?>" readonly>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="focusedInput">Country Name:</label>
                                <div class="controls">
                                    <input id="countryidss" type="text" value="<?php echo $country->fields['Description'];?>" readonly>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Contact Person:</label>
                                <div class="controls">
                                  <input name="contact" type="text" value="<?php echo $country->fields['Contact'];?>" required />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Phone:</label>
                                <div class="controls">
                                  <input name="phone"  type="text" value="<?php echo $country->fields['Phone'];?>" required />
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Email:</label>
                                <div class="controls">
                                  <input  name="email"  type="text"  value="<?php echo $country->fields['Email'];?>" required />
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Address1:</label>
                                <div class="controls">
                                  <textarea name="address1" required><?php echo $country->fields['Address1'];?></textarea>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Address2:</label>
                                <div class="controls">
                                  <textarea name="address2"><?php echo $country->fields['Address2'];?></textarea>
                                </div>
                            </div>
                              
                            <h4>&nbsp;&nbsp; Discount Setup</h4><br />
                            <div class="control-group">
                                <label class="control-label">Discount Type:</label>
                                <div class="controls">
                                    <select name="disc_type">
                                       <option>Please Select A Discount Type</option>
                                       <option <?php if($country->fields['DiscountType'] == '0' ): echo 'selected'; endif; ?> Value="0">Fixed</option>
                                       <option <?php if($country->fields['DiscountType'] == '1' ): echo 'selected'; endif; ?> value="1">Percentage</option> 
                                    </select>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Discount Group A :</label>
                                <div class="controls">
                                  <input name="groupa" type="text" value="<?php echo $country->fields['ItemDiscRateA'];?>">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Discount Group B :</label>
                                <div class="controls">
                                  <input name="groupb" type="text" value="<?php echo $country->fields['ItemDiscRateB'];?>">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Discount Group C :</label>
                                <div class="controls">
                                  <input name="groupc" type="text" value="<?php echo $country->fields['ItemDiscRateC'];?>">
                                </div>
                            </div>




                            <div class="form-actions">
                              <!--<button type="submit" value="Submit" class="btn btn-primary">Save changes</button>-->
                              <button type="submit" name="save"  class="btn btn-primary"  id="saveme">Update Country</button>
                              <button type="reset" class="btn">Cancel</button>
                            </div>
                          </fieldset>
                        </form> 
                     

                    </div>
                </div><!--/span-->

            </div><!--/row-->
                    <!-- content ends -->
            </div><!--/#content.span10-->