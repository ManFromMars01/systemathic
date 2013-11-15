<div id="content" class="span10">
            <!-- content starts -->
            

            <?php breadcrumb('Assessment / Assessment Form') ?>
            
            <div class="row-fluid sortable">
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-edit"></i> Student Detail </h2>
                    </div>
                    <div class="box-content">
                        <form class="form-horizontal" action="@UpdatetStudentFormAction@"  id="form3" name="form3" method="post" >
                          <fieldset>
                           <input type="hidden" id="MODE" name="MODE" value="1">


                            <div class="control-group">
                                <label class="control-label" for="focusedInput">Full Name</label>
                                <div class="controls">
                                  <input class="input-xlarge focused" type="text" value="<?php echo $customer->fields['SurName']; ?>, <?php echo $customer->fields['FirstName']; ?>  <?php echo $customer->fields['MiddleName']; ?>" readonly>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="focusedInput">Level: </label>
                                <div class="controls">
                                  <input class="" name="txttcountryMaster" id="focusedInput" type="text" value="<?php echo $model->yourlevel($customer->fields['CustNo']); ?>">
                                </div>
                            </div>
                          </fieldset>
                        </form> 
                     

                    </div>
                </div><!--/span-->

            </div><!--/row-->
            <div class="row-fluid sortable">
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-edit"></i> Assessment Question </h2>
                    </div>
                    <div class="box-content">
                        
                        <form class="form-horizontal" method="POST" action="<?php echo base_url('page/controller/assessment_form.php?CustomerNo='.$_GET['CustomerNo'])?>" method="post" >
                            <input type="hidden" name="custno" value="<?php echo $_GET['CustomerNo']; ?>">
                            <?php  
                            $x = 0;
                            foreach($assessment as $assess): 

                            ?>

                            <div class="control-group">
                                <label class="control-label" style="width:20%; text-align:left;" ><?php echo $x = $x + 1; ?>) <?php echo $assess['Description']; ?></label>
                                <div class="controls">
                                    <select name="assessment<?php echo $assess['ID']; ?>">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                            </div>
                        <?php endforeach; ?>

                            <div class="control-group" style="border:1px solid gray; border-radius:5px; width: 30%; padding:10px;">
                                <label class="control-label" style="width:20%; text-align:left;" >Overall Assesment</label>
                                <div class="controls">
                                    <select name="assessment_ov">
                                        <option value="PASSED">Passed</option>
                                        <option value="FAILED">Failed</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-actions">
                              <!--<button type="submit" value="Submit" class="btn btn-primary">Save changes</button>-->
                              <button type="submit" name="submit_assess"  class="btn btn-primary">Assess</button>
                              <button type="reset" class="btn">Cancel</button>
                            </div>

                        </form> 
                     

                    </div>
                </div><!--/span-->

            </div><!--/row-->
                    <!-- content ends -->
            </div><!--/#content.span10-->