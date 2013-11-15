<div id="content" class="span10">
            <!-- content starts -->
            

            <div>
                <ul class="breadcrumb">
                    <li>
                        <a href="index.php">Home</a> <span class="divider">/</span>
                    </li>
                    <li>
                        <a href="#">Online Practice List</a>
                    </li>
                </ul>
            </div>
            
            <div class="row-fluid sortable">        
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-user"></i> Online Practice </h2>
                        <div class="box-icon">
                            <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
                            <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                            <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                        </div>
                    </div>
                    <div class="box-content">
                        <a class="btn btn-success" href="UpdatetStudentadd.php">Add Student </a>
                        <br><br >
                        <table class="table table-striped table-bordered bootstrap-datatable datatable">
                          <thead>
                              <tr>
                                    <th>Student ID</th>
                                    <th>Student Name</th>
                                    <th>Level</th>
                                    <th>Date</th>
                                    <th>Edit Record</th>
                              </tr>
                          </thead>   
                          <tbody>
                            <?php foreach($onlinelist as $onlinelists): 
                               $yourcustomer = $model->select_where('tcustomer',  array('CustNo'=>$onlinelists['CustNo']));
                            ?>
                            <tr>
                                <td><?php echo $yourcustomer->fields['StudentID']; ?></td>
                                <td><?php echo  $yourcustomer->fields['SurName']; ?>, <?php echo  $yourcustomer->fields['FirstName']; ?> <?php echo $yourcustomer->fields['MiddleName']; ?></td>
                                <td><?php echo  $model->yourlevel($yourcustomer->fields['LevelID'],0); ?></td>
                                <td><?php echo  $onlinelists['Date']; ?></td>
                                <td>Edit Record</td>
                            </tr>
                            <?php endforeach ?>
              
                            
                          </tbody>
                      </table>            
                    </div>
                </div><!--/span-->
            
            </div><!--/row-->
                <!-- content ends -->
            </div><!--/#content.span10-->