<div id="content" class="span10">
            <!-- content starts -->
            

            <?php breadcrumb('Your Class') ?>
            
            <div class="row-fluid sortable">        
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-user"></i> Your Class Today </h2>
                        <div class="box-icon"></div>
                    </div>
                    <div class="box-content">
                        <table class="table table-striped table-bordered bootstrap-datatable datatable">
                          <thead>
                                <tr>
                                    <th>Date Today</th>
                                    <th>Room</th>
                                    <th>Level</th>
                                    <th>Time</th>
                                    <th>Action</th>
                                </tr>
                          </thead> 
                           
                          <tbody>
                                <?php foreach ($schedlist as $sched):  ?>
                                <tr>
                                    <td><?php echo date('Y-m-d'); ?></td>
                                    <td><?php echo $model->yourroom($sched['RoomID']); ?></td>
                                    <td><?php echo $model->yourlevel($sched['LevelID']); ?></td>
                                    <td><?php echo $sched['TimeFrom']; ?> - <?php echo $sched['TimeTo']; ?> </td>
                                    <td><?php edit_link($base.'page/controller/attendance_student.php?SchedCode='.$sched['SchedCode'],'Manage Attendance '); ?></td>
                                </tr>
                                <?php endforeach; ?>  
                          </tbody>
                      </table>            
                    </div>
                </div><!--/span-->
            
            </div><!--/row-->
                <!-- content ends -->
            </div><!--/#content.span10-->