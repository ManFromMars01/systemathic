<?php 
session_start();
include('page/class/systemathic.php');
include('template/myclass.php');
not_login();
include('page/view/template/header_view.php');
$where = array('RegType' => $_GET['RegType'], 'CountryID' => $_SESSION['UserValue1'], 'BranchID' => $_SESSION['UserValue2']);
$student = $model->select_where('tcustomer', $where );
?>
<div id="content" class="span10">
            <!-- content starts -->
            <div>
                <ul class="breadcrumb">
                    <li>
                        <a href="index.php">Admission</a> <span class="divider">/</span>
                    </li>
                    <li>
                        <a href="#">Students</a>
                    </li>
                </ul>
            </div>
            
            <div class="row-fluid sortable">        
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-user"></i> Students - <?php echo $_GET['RegType'] ?></h2>
                        <div class="box-icon">
                            <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
                            <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                            <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                        </div>
                    </div>
                    <div class="box-content">
                        <!--<a class="btn btn-success" href="UpdatetStudentadd.php">Add</a>-->
                        <table class="table table-striped table-bordered bootstrap-datatable datatable">
                          <thead>
                              <tr>
                                  <th>Student Id</th>  
                                  <th>Student Name</th>
                                  <th>Level</th>
                                  <th>Tier</th>
                                  <th>Actions</th>

                              </tr>
                          </thead>   
                          <tbody>
                           
                            <?php foreach($student as $students):?>    
                            <tr>
                                <td><?php echo $students['StudentID']?></td>
                                <td><?php echo $students['SurName']. ", ". $students['FirstName']. " ".$students['MiddleName'] ?></td>
                                
                                <?php 
                                    $level = $model->select_where('tlevel', array('ID' => $students['LevelID'] ));
                                    $tier =  $model->select_where('ttier', array('ID' => $students['TierID'] ));
                                ?>
                                <td><?php echo $level->fields['Description'];?></td>
                                
                                <td><?php echo $tier->fields['Description'];?></td>
                                <td>
                                  <?php if($_GET['RegType'] =="For Schedule"): ?>  
                                  <a class="btn btn-info" href="<?php echo base_url('page/controller/create_schedule.php')?>?ID=<?php echo $students['CustNo'] ?>"><i class="icon-edit icon-white"></i> Manage Schedule</a>


                                  <?php elseif($_GET['RegType'] == "For Kit Issuance"): ?>
                                  <a class="btn btn-info" href="kitissuance.php?ID1='<?php echo $students['CountryID'] ?>'&amp;ID2='<?php echo $students['BranchID'] ?>'&amp;ID3=<?php echo $students['CustNo'] ?>"><i class="icon-edit icon-white"></i> Kit Issuance</a>
                                  
                                  <?php elseif($_GET['RegType'] == "Admitted"): ?>
                                  <a class="btn btn-info" href="<?php echo base_url('page/controller/edit_student.php?ID3='.$students['CustNo']);?>"><i class="icon-edit icon-white"></i> Edit</a>
                                  <a class="btn btn-info" href="return_books.php?student_no=<?php echo $students['StudentID'] ?>"><i class="icon-edit icon-white"></i> Manage Books</a>
                                  <a class="btn btn-info" href="manage_invoice.php?CustNo=<?php echo $students['CustNo'] ?>"><i class="icon-edit icon-white"></i> Manage Invoices</a>
                                  <a class="btn btn-info" href="attendance_view.php?student_no=<?php echo $students['StudentID'] ?>"><i class="icon-edit icon-white"></i> Attendance</a>

                                  <?php elseif($_GET['RegType'] == "For Payment"):?>
                                  <a class="btn btn-info" href="create_invoice.php?CustNo=<?php echo $students['CustNo'] ?>"><i class="icon-edit icon-white"></i> Create Invoice</a>
                                  <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                            
                          </tbody>
                      </table>            
                    </div>
                </div><!--/span-->
            
            </div><!--/row-->
                <!-- content ends -->
            </div><!--/#content.span10-->
<?php include('template/footer.php'); ?>         