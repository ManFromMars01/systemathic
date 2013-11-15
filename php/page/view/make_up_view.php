<div id="content" class="span10">
            <!-- content starts -->
            

            <?php breadcrumb('Attendance View/Make Up Class') ?>
            
            <div class="row-fluid sortable">
                <div class="box-content">
                        <br>Available Class <br >
                        <table class="table table-striped table-bordered bootstrap-datatable datatable">
                          <thead>
                              <tr>
                                  <th>Room </th>
                                  <th>Day</th>  
                                  <th>Time From - Time To</th>
                                  <th>Enrollee</th>
                                  <th>Actions</th>

                              </tr>
                          </thead>
                           
                          <tbody>
                              <?php 
                                for ($i=1; $i < 7 ; $i++) { 
                                  $date = strtotime("+".$i." day");
                                  //echo date('Y-m-d', $date);
                                 $avail = $model->select_where('tclasssched', array('BranchID' => $_SESSION['UserValue2'], 'LevelID' => $customer->fields['LevelID'], 'Day' => date('l', $date)));
                                 
                                 foreach($avail as $avails):
                                  $yourdate = date('Y-m-d', $date);

                                 $already = $model->count_where('eattdtl', array('CustNo' => $customer->fields['CustNo'], 'Date' => date('Y-m-d', $date), 'SchedCode' => $avails['SchedCode']));   
                                 $countme = $model->count_where('eattdtl', array('SchedCode' => $avails['SchedCode'], 'Date' => $yourdate));

                                if($already >= 1){

                                } else{
                                  $rooms = $model->select_where('troom',array('ID' => $avails['RoomID']));
                              ?> 
                              <tr>
                                <td><?php echo $model->yourroom($avails['RoomID']); ?></td> 
                                <td><?php echo  date('l', $date); ?> (<?php echo  date('Y-m-d', $date); ?>)</td>
                                <td><?php echo $avails['TimeFrom'];?> - <?php echo $avails['TimeTo'];?> </td>
                                <td><?php echo $countme; ?>/ <?php echo $rooms->fields['TotalSeat'];?> </td>
                                <td><a onclick="return confirm('Are You Sure With This Changes?');" href="<?php echo base_url('page/controller/make_up.php?cust_no='.$customer->fields['CustNo'].'&date='.date('Y-m-d', $date).'&sched_code='.$avails['SchedCode'].'&sched_rcode='.$_GET['sched_code'].'&date_recent='.$_GET['date_recent'])?>" class="btn btn-info">Make Up Class</a></td>   
                              </tr>  

                              <?php
                                }      
                                endforeach;
                                }
                              ?>


                               
                          </tbody>
                      </table>            
                    </div>

            </div><!--/row-->
            
                    <!-- content ends -->
            </div><!--/#content.span10-->

            