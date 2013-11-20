<div id="content" class="span10">
            <!-- content starts -->
            

            <?php breadcrumb('<a href="'.base_url('franchising.php').'">Franchising</a> <a href="#"> / Student List</a>'); ?>
            
            <div class="row-fluid sortable">        
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-user"></i> Search Form </h2>
                    </div>
                    <div class="box-content">
                        <form method="post">
                        <div class="control-group" style="float:left;">
                            <label class="control-label" for="selectError">Country</label>
                            <div class="controls">
                              <select data-rel="chosen" id="country_select" name="country">
                                <option value="">Please Select Country</option>
                                <?php foreach($country as $countries): ?>
                                <option value="<?php echo $countries['ID'];?>"><?php echo $countries['Description'];?></option>
                                <?php endforeach; ?>
                              </select>
                            </div>
                        </div> 
                        <div class="control-group" style="float:left; margin-left:5px">
                            <label class="control-label" for="selectError">Branch</label>
                            <div class="controls">
                              <select  id="branch_select" name="branch">
                                 <option></option>
                              </select>
                            </div>
                        </div>
                        <div class="control-group" style="float:left; margin-left:5px">
                            <label class="control-label" for="selectError">&nbsp</label>
                            <div class="controls">
                              <input type="submit" id="submit" class="btn btn-success" value="Submit">
                            </div>
                        </div>   
                        <div class="clearfix"></div>  
                        </form>        
                    </div>
                </div><!--/span-->
            
            </div><!--/row-->

            <div class="row-fluid sortable">        
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-user"></i> Student List </h2>
                        <div class="box-icon">
                            <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
                            <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                            <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                        </div>
                    </div>
                    <div class="box-content">
                        <h4><?php echo $country_name->fields['Description']." - ". $branch_name->fields['Description'] ?> <a class="btn btn-info" href="#">More Info</a> </h4>
                        <p>Total Number of Students: <strong><?php echo $customers_count; ?></strong></p>

                        <br />
                        <table class="table table-striped table-bordered bootstrap-datatable datatable">
                          <thead>
                              <tr>
                                    <th>Student ID</th>
                                    <th>Student Name</th>
                                    <th>Level</th>
                                    <th>Action</th>
                              </tr>
                          </thead>
                              <?php foreach($customers as $student): ?>
                               <tr>
                                    <td><?php echo $student['StudentID']; ?></td>
                                    <td><?php echo $student['SurName'];?>, <?php echo $student['FirstName'];?> <?php echo $student['MiddleName'];?></td>
                                    <td><?php echo $model->yourlevel($student['LevelID']); ?></td>
                                    <td><a href="<?php echo base_url('attendance_view.php?student_no='.$student['StudentID']) ?>" class="btn btn-info">Attendance View</a> <a class="btn btn-info" href="<?php echo base_url('manage_invoice.php?CustNo='.$student['CustNo']);?>">Invoice</a></td>
                              </tr> 
                              <?php endforeach; ?>  
                          <tbody>
                            
                        
              
                            
                          </tbody>
                      </table>            
                    </div>
                </div><!--/span-->
            
            </div><!--/row-->
                <!-- content ends -->
            </div><!--/#content.span10-->

            <script>
               $('#country_select').change(function(){
                    countryid = $(this).val(); 
                    alert(countryid);
                    $.ajax({
                        url:'<?php echo base_url("page/ajax/select_branch.php");?>',
                        type:'post',
                        data:{countryid:countryid},
                        dataType:'json',
                        success:function(j){
                            console.log(j);
                            $('#branch_select').html(j.success);

                        }
                    });
               });
            </script>
            

