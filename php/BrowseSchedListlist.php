<?php include('template/header.php') ?>
<?php include('template/myclass.php');?>
<?php 
 $schedule = $model->select_where('tclasssched', array('LevelID' =>$_GET['ID3']));
 $leveldesc = $model->select_where('tlevel',array('ID' => $_GET['ID3']));   
?>
<div id="content" class="span10">
            <!-- content starts -->
            
            <div>
                <ul class="breadcrumb">
                    <li>
                        <a href="index.php">Level List</a> <span class="divider">/</span>
                    </li>
                    <li>
                        <a href="#">Browse Schedule </a>
                    </li>
                </ul>
            </div>
            <?php echo $success; ?>
            <div class="row-fluid sortable">        
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-user"></i> <?php echo $leveldesc->fields['Description'] ?></h2>
                        <div class="box-icon">
                            <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
                            <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                            <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                        </div>
                    </div>
                    <div class="box-content">
                      <a class="btn btn-success" href="Updatetclassschedadd.php">Add Class Schedule</a>
                        
                        <div class="clearfix"></div>
                        <br>
                        <table class="table table-striped table-bordered bootstrap-datatable datatable">
                          <thead>
                              <tr>
                                  <th>Day</th>
                                  <th>Time From</th>
                                  <th>Time To</th>
                                  <th>Teacher Name</th>
                                  <th>Action</th>

                              </tr>
                          </thead>   
                            <tbody>
                              <?php foreach($schedule as $schedules): ?>
                              <?php  $teacher = $model->select_where('tteacher',array('ID' => $schedules['TeacherID1'])) ?>
                              <?php  
                                    $linkedit = "Updatetclassschededit.php?ID1='".$schedules['CountryID']."'&ID2='".$schedules['BranchID']."'&ID3='".$schedules['Day']."'&ID4=".$schedules['TimeFrom'];   
                                     $timefrom = date("h:i a", strtotime($schedules['TimeFrom'])); 
                                     $timeto = date("h:i a", strtotime($schedules['TimeTo'])); 
                              ?>
                              <tr>
                                  <td><?php echo $schedules['Day'];?></td>
                                  <td><?php echo $timefrom;?></td>
                                  <td><?php echo $timeto;?></td>
                                  <td><?php echo $teacher->fields['Name']; ?></td>


                                  <td>
                                    <a href="<?php echo base_url('page/controller/update_tclass.php?schedcode='.$schedules['SchedCode']);?>" class="btn btn-info">Edit</a>
                                    <a onclick="return confirm('Are You Sure yount to remoce this schedule?');" href="<?php echo base_url('page/ajax/delete_tclass.php?schedcode='.$schedules['SchedCode'].'&id3='.$schedules['LevelID'])?>" class="btn btn-danger">Delete</a>
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

            <script>
                
            </script>
<?php include('template/footer.php'); ?>         