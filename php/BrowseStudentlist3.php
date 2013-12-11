<?php 
session_start();
include('page/class/systemathic.php');
include('template/myclass.php');
not_login();
include('page/view/template/header_view.php');
?>

<?php 
    $success = "";
    if(isset($_GET['RegType'])){
      $where = array('CustType' => $_GET['CustType'] , 'RegType' => $_GET['RegType'], 'CountryID'=> $_SESSION['UserValue1'], 'BranchID'=> $_SESSION['UserValue2'] );
    } else{
      $where = array('CustType' => $_GET['CustType'], 'CountryID'=> $_SESSION['UserValue1'], 'BranchID'=> $_SESSION['UserValue2'] );
    }


    if(isset($_GET['Success'])){
      $success = '<div class="alert alert-success">
              <button type="button" class="close" data-dismiss="alert">×</button>
              <strong>Well Done!!</strong> You Successfully Move A Student to Addmission List.. <a href="BrowseStudentlist3.php?CustType=For Admission&RegType=Waiting">Go To Admission List</a>
            </div>';
    }
    
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
            <?php echo $success; ?>
            <div class="row-fluid sortable">        
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-user"></i> Students - <?php echo $_GET['CustType'] ?></h2>
                        <div class="box-icon">
                            <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
                            <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                            <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                        </div>
                    </div>
                    <div class="box-content">
                        <a class="btn btn-success" href="<?php echo base_url('page/controller/add_student.php');?>">Add Customer</a> <a id="showlegend" class="btn btn-info">Show Legend</a>
                        

                        <div id="mylegend" style="display:none; margin-top:5px; padding:10px; border:1px solid gray; border-radius:5px;" class="groupme">
                          <h4>Legend</h4>
                          <br />                          
                          <ul>
                              <li style="margin-bottom:10px; display:block; float:left; margin-right:15px;"><a href="" class="btn btn-danger">Assessed</a> -  Assessment FAILED</li>
                              <li style="margin-bottom:10px; display:block; float:left;"><a href="" class="btn btn-success">Assessed</a> - Assessment PASSED</li>
                          </ul>
                          <div class="clearfix"></div>  
                        </div>
                        
                        <div class="clearfix"></div>
                        <br>
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
                                
                                <!------Start ASSesment Action------>
                                <?php if($_GET['CustType'] == 'Assessment' ): ?>
                                <td>
                                  <?php 
                                  $customer_check =$model->select_where('eassessment', array('CustNo'=> $students['CustNo']));
                                  if($customer_check->fields['CustNo'] !=  $students['CustNo']):
                                  ?>

                                  <a class="btn btn-info" href="page/controller/assessment_form.php?CustomerNo=<?php echo $students['CustNo'];?>"><i class="icon-edit icon-white"></i> Assess</a>
                                  <?php else: ?>
                                  <?php if($customer_check->fields['Status'] == "PASSED"): ?>  
                                  <a class="btn btn-success" href="UpdatetStudentedit.php?ID1='<?php echo $students['CountryID'] ?>'&amp;ID2='<?php echo $students['BranchID'] ?>'&amp;ID3=<?php echo $students['CustNo'] ?>"></i> Assessed</a>
                                  <a class="btn btn-success" href="<?php echo base_url('page/ajax/move_student.php?custno='.$students['CustNo'].'&moveto=admission');?>" onclick="return confirm('Are you sure you want to move this student in Admission List ?')">Move to Admission</a>
                                  <?php elseif($customer_check->fields['Status'] == "FAILED"): ?>  
                                  <a class="btn btn-danger">Assessed</a>
                                  <?php endif; endif; ?>
                                 <a class="btn btn-info" href="<?php echo base_url('page/controller/edit_student.php?ID3='.$students['CustNo']);?>"><i class="icon-edit icon-white"></i> Edit</a>
                                </td>
                                <!------Ending ASSesment Action------>

                                <!-----For Admission Action------>
                                <?php elseif($_GET['CustType'] == 'For Admission' ): ?>
                                <td>
                                   <a class="btn btn-info" href="<?php echo base_url('page/controller/edit_student.php?ID3='.$students['CustNo']);?>"><i class="icon-edit icon-white"></i> Edit</a>
                                   <a class="btn btn-success" href="<?php echo base_url('page/ajax/move_student.php?custno='.$students['CustNo'].'&moveto=schedule');?>" onclick="return confirm('Note:  This student will move To For Schedule List')">Create Schedule</a>
                                </td> 

                                <?php else: ?>
                                <td>
                                  <a class="btn btn-info" href="<?php echo base_url('page/controller/edit_student.php?ID3='.$students['CustNo']);?>"><i class="icon-edit icon-white"></i> Edit</a>
                                </td>
                               <?php endif; ?> 
                            </tr>
                        <?php endforeach; ?>
                            
                          </tbody>
                      </table>            
                    </div>
                </div><!--/span-->
            
            </div><!--/row-->
                <!-- content ends -->
            </div><!--/#content.span10-->

            <script>
                  

                  $( "#showlegend" ).click(function() {
                    $( "#mylegend" ).toggle( "slow", function() {
                      // Animation complete.
                    });
                  });
            </script>
<?php include('template/footer.php'); ?>         