<div id="content" class="span10">
            <!-- content starts -->
            

            <?php breadcrumb('Your Class Today / List of Student') ?>
            
            <div class="row-fluid sortable">        
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-user"></i> List of Student </h2>
                        <div class="box-icon"></div>
                    </div>
                    <div class="box-content">
                        <table class="table table-striped table-bordered bootstrap-datatable datatable">
                          <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Fullname</th>
                                    <th>Date Today</th>
                                    <th>Status</th>
                                </tr>
                          </thead> 
                           
                          <tbody>
                                <?php foreach($student as $students): ?>
                                <?php 
                                $tcustomer = $model->select_where('tcustomer', array('CustNo' => $students['CustNo'] )); 
                                $tattendance = $model->select_where('eattdtl', array('SchedCode'=>$_GET['SchedCode'],'Date'=>date('Y-m-d'),'CustNo'=>$students['CustNo']));
                                 ?>   
                                <tr>
                                    <td><?php echo $tcustomer->fields['StudentID']; ?></td>
                                    <td><?php echo $tcustomer->fields['SurName']; ?>, <?php echo $tcustomer->fields['FirstName']; ?> <?php echo $tcustomer->fields['MiddleName']; ?></td>
                                    <td><?php echo date('Y-m-d') ?></td>
                                    
                                    <?php if($tattendance->fields['StatusID'] == '1'): ?>
                                    <td>
                                        <div id="<?php echo $tcustomer->fields['StudentID']; ?>">
                                            <a class="btn btn-success present noty" data-noty-options='{"text":"<?php echo $tcustomer->fields['SurName']; ?>, <?php echo $tcustomer->fields['FirstName']; ?> <?php echo $tcustomer->fields['MiddleName']; ?> Status Save","layout":"bottomLeft","type":"success"}' href="#" alt="<?php echo $tcustomer->fields['StudentID']; ?>"> Present</a> 
                                            
                                            
                                            <a class="btn btn-danger absent noty" href="#" id="absent" alt="<?php echo $tcustomer->fields['StudentID']; ?>" data-noty-options='{"text":"<?php echo $tcustomer->fields['SurName']; ?>, <?php echo $tcustomer->fields['FirstName']; ?> <?php echo $tcustomer->fields['MiddleName']; ?> Status Save","layout":"bottomLeft","type":"success"}'>Absent</a>
                                            <form id="schedcode_form2<?php echo $tcustomer->fields['StudentID']; ?>">
                                                <input type="hidden" name="schedcode" value="<?php  echo $_GET['SchedCode'];?>">
                                                <input type="hidden" name="date_today" value="<?php echo date('Y-m-d');?>">
                                                <input type="hidden" name="custno" value="<?php echo $students['CustNo']; ?>">
                                                <input type="hidden" name="type_att" value="Absent">
                                            </form>
                                            <form id="schedcode_form<?php echo $tcustomer->fields['StudentID']; ?>">
                                                <input type="hidden" name="schedcode" value="<?php  echo $_GET['SchedCode'];?>">
                                                <input type="hidden" name="date_today" value="<?php echo date('Y-m-d');?>">
                                                <input type="hidden" name="custno" value="<?php echo $students['CustNo']; ?>">
                                                <input type="hidden" name="type_att" value="Present">
                                            </form>

                                        </div>
                                        <p id="statuses<?php echo $tcustomer->fields['StudentID']; ?>" style="display:none;"> </p>
                                    </td>
                                <?php else:?>
                                    <td class="test">
                                        <p id="statuses"><?php  $model->att_stat($tattendance->fields['StatusID']);?></p>
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
    $('.present').click(function(){
        idno = $(this).attr('alt');
        $.ajax({
            url:'<?php echo base_url()?>page/ajax/attendance.php',
            type:'post',
            data: $('#schedcode_form'+idno).serialize(),
            dataType:'json',
            success:function(j){
                console.log(j);
                if(j.status == "Present"){
                    $('#'+idno).fadeOut();
                    $('#statuses'+idno).html(j.status);
                    $('#statuses'+idno).fadeIn();        
                }
            }
        }); 
    });

    $('.absent').click(function(){
        idno = $(this).attr('alt');
        $.ajax({
            url:'<?php echo base_url()?>page/ajax/attendance.php',
            type:'post',
            data: $('#schedcode_form2'+idno).serialize(),
            dataType:'json',
            success:function(j){
                console.log(j);
                if(j.status == "Absent"){
                    $('#'+idno).fadeOut();
                    $('#statuses'+idno).html(j.status);
                    $('#statuses'+idno).fadeIn();        
                }
            }
        }); 
    }); 





</script>