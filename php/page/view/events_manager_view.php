<div id="content" class="span10">
            <!-- content starts -->
            

            <?php breadcrumb('Events') ?>
            <p><a  class="btn btn-success" href="<?php echo base_url('page/controller/add_event.php'); ?>">ADD EVENT</a></p>
            <div class="row-fluid sortable">        
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-user"></i> Events </h2>
                        <div class="box-icon"></div>
                    </div>
                    <div class="box-content">
                        <table class="table table-striped table-bordered bootstrap-datatable datatable">
                          <thead>
                                <tr>
                                    <th>Event Name</th>
                                    <th>Venue</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Action</th>
                                </tr>
                          </thead> 
                                <?php foreach($events as $event): ?>
                                <tr>
                                    <td><?php echo $event['Event']; ?></td>
                                    <td><?php echo $event['Venue']; ?></td>
                                    <td><?php echo $event['Date']; ?></td>
                                    <td><?php echo $event['TimeFrom']; ?> - <?php echo $event['TimeTo']; ?></td>
                                    <td>
                                        <a class="btn btn-info" href="<?php echo base_url('page/controller/edit_event.php?event_id='.$event['EventID']); ?>">Edit</a> 
                                        <a class="btn btn-info" href="<?php echo base_url('page/controller/edit_event.php?event_id='.$event['EventID']); ?>">Manage Exampaper</a>
                                        <a alt="<?php echo $event['EventID']; ?>" class="btn btn-success register" href="#">Registration</a>
                                        
                                        <a class="btn btn-info" href="<?php echo base_url('page/controller/examinee_list.php?event_id='.$event['EventID']); ?>">Examinee List</a>
                                        <a class="btn btn-info examcode" alt="<?php echo $event['EventID'] ?>" href="#">Generate Exam Codes</a>
                                    </td>
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

             <div class="modal hide fade" id="myModal100">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h3>Please Provide Student ID</h3>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="eventid" value="" >    
                    <div class="control-group">
                        <label class="control-label">Student ID</label>
                        <div class="controls">
                            <input type="text" class="input-xlarge focused"  id="studentid" value="">
                            <input type="hidden" name="idno" id="idno" value="">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label"></label>
                        <div class="controls">
                            <input class="btn btn-info" type="button" name=""  id="validate" value="Validate">
                        </div>
                    </div>
                    
                    <p style="text-align:center;" class="status_find"></p>
                    <h4 style="text-align:center;" id="studentname"></h4>
                    <div class="button_submit" style="text-align:center;display:none;">
                        <form method="post" action="<?php echo base_url() ?>page/controller/register_student_exam.php">
                        <input type="hidden" name="idnum" id="idnum">
                        <input type="hidden" name="event_num" id="eventnum">    
                        <input type="submit" class="btn btn-success" value="Go Register Form">
                        </form>
                    </div>
            
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn" data-dismiss="modal">Close</a>
                    <!--<a href="BrowseStudentlist.php" class="btn btn-primary">Back To Student List</a>-->
                </div>
            </div>

  <script>
    $('.register').click(function(){
        eventid = $(this).attr('alt');
        $('#eventid').val(eventid); 
        $("#myModal100").modal('show');
        $('#eventnum').val(eventid);

    });

    $('#validate').click(function(){
         studid = $('#studentid').val();
         img = '<img src="<?php echo base_url("template")?>/img/ajax-loaders/ajax-loader-7.gif" title="img/ajax-loaders/ajax-loader-7.gif">';
         $('.status_find').html(img);
        $.ajax({
            url:'<?php echo  base_url();?>page/ajax/getstudinfo.php',
            type:'post',
            data:{studid : studid},
            dataType:'json',
            success:function(j){
                $('.status_find').html(j.status);
                if(j.status=="Valid"){
                    $('#studentname').html(j.fname +" " + j.mname + " " + j.sname );
                    $('#idnum').val(studid);
                    $('.button_submit').show();
                }

            }
        });
    });

    $('.examcode').click(function(){
       event_id = $(this).attr('alt');
       $.ajax({
            url:"<?php echo base_url('page/ajax/generate_examcode.php');?>",
            type:'post',
            data:{event_id:event_id},
            dataType: 'json',
            success:function(j){
                console.log(j);
            }

       })
    });




  </script>     





            
