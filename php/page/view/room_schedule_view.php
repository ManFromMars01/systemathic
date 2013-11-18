
<div id="content" class="span10">
            <!-- content starts -->
            

            <?php breadcrumb('Assessment / Assessment Form') ?>
            
            <div class="row-fluid sortable">        
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-user"></i>List of Rooms Schedule </h2>
                        <div class="box-icon">
                            <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
                            <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                            <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                        </div>
                    </div>
                    <div class="box-content">
                        <!-- <a class="btn btn-success" href="UpdatetStudentadd.php">Add</a> -->
                        <br>
                        <table class="table table-striped table-bordered bootstrap-datatable datatable">
                          <thead>
                              <tr>
                                  <th>Room Id</th>  
                                  <th>Room Name</th>
                                  <th>Total Seats</th>
                                  <th>Actions</th>

                              </tr>
                          </thead>   
                          <tbody>
                           
                            <?php foreach($rooms as $room):?>    
                            <tr>
                                <td><?php echo $room['ID'];?> </td>
                                <td><?php echo $room['Description']?></td>
                                <td><?php echo $room['TotalSeat']?></td>
                            
                                <td>

                                  <a class="btn btn-info" href="room_schedule_details.php?ID1='<?php echo $room['CountryID'] ?>'&amp;ID2='<?php echo $room['BranchID'] ?>'&amp;ID3=<?php echo $room['ID'] ?>"><i class="icon-edit icon-white"></i> View</a>
                                
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
     