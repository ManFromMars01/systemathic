<?php include('template/header.php') ?>
<?php include('template/myclass.php');?>
<?php 
    if(isset($_GET['RegType'])){
      $where = array('CustType' => $_GET['CustType'] , 'RegType' => $_GET['RegType'] );
    } else{
      $where = array('CustType' => $_GET['CustType']);
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
                        <a class="btn btn-success" href="UpdatetStudentadd.php">Add</a>
                        <br><br >
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
                                <?php if($_GET['CustType'] == 'Assessment' ): ?>
                                <td>
                                  <?php 
                                  $customer_check =$model->select_where('eassessment', array('CustNo'=> $students['CustNo']));
                                  if($customer_check->fields['CustNo'] !=  $students['CustNo']):
                                  ?>
                                  <a class="btn btn-info" href="page/controller/assessment_form.php?CustomerNo=<?php echo $students['CustNo'];?>"><i class="icon-edit icon-white"></i> Assess</a>
                                <?php else: ?>
                                  <a class="btn btn-success" href="UpdatetStudentedit.php?ID1='<?php echo $students['CountryID'] ?>'&amp;ID2='<?php echo $students['BranchID'] ?>'&amp;ID3=<?php echo $students['CustNo'] ?>"></i> Assessed</a>
                                <?php endif; ?>
                                  <a class="btn btn-info" href="UpdatetStudentedit.php?ID1='<?php echo $students['CountryID'] ?>'&amp;ID2='<?php echo $students['BranchID'] ?>'&amp;ID3=<?php echo $students['CustNo'] ?>"><i class="icon-edit icon-white"></i> Edit</a>
                                </td>
                                <?php else: ?>

                                <td>
                                  <a class="btn btn-info" href="UpdatetStudentedit.php?ID1='<?php echo $students['CountryID'] ?>'&amp;ID2='<?php echo $students['BranchID'] ?>'&amp;ID3=<?php echo $students['CustNo'] ?>"><i class="icon-edit icon-white"></i> Edit</a>
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
<?php include('template/footer.php'); ?>         