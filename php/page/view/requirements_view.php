<div id="content" class="span10">
            <!-- content starts -->
            

            <?php breadcrumb('Branch Requirements'); ?>
            
            <div class="row-fluid sortable">        
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-user"></i> Requirements </h2>
                    </div>
                    
                    <div class="box-content">
                        <table class="table table-striped table-bordered bootstrap-datatable">
                          <tr>
                                <th>Description</th>
                                <th>Fields</th>
                                <th>Action</th>
                          </tr> 
                          <?php foreach($checklist as $checklists): ?>
                          <tr> 
                            <td><?php description_check($checklists['ReqID']) ?></td>
                            <?php if(fieldtype_checker($checklists['ReqID']) == "text"): ?>
                            <td>
                                <form name="check<?php echo $checklists['ReqID'];?>" id="check<?php echo $checklists['ReqID']; ?>">
                                    <input type="<?php fieldtype_check($checklists['ReqID']);?>" id="column<?php echo $checklists['ReqID']; ?>" name="columnname"  value="<?php echo $checklists['DocPath'];?>" >
                                    <input type="hidden" name="fieldname"  value="<?php description_check($checklists['ReqID']) ?>">
                                    <input type="hidden" name="branchid"  value="<?php echo $checklists['BranchID'];?>">
                                    <input type="hidden" name="reqid"  value="<?php echo $checklists['ReqID'];?>">
                                    <input type="button" id="save<?php echo $checklists['ReqID'];?>" value="save">
                                </form>
                            </td>
                            <?php else: ?>
                            <td>
                                <form name="check<?php echo $checklists['ReqID'];?>" id="check<?php echo $checklists['ReqID']; ?>">
                                    <?php if($checklists['DocPath'] == "" ): ?>
                                        <p id="linkup<?php echo $checklists['ReqID'];?>">No Files Uploaded Yet.</p>
                                    <?php else: ?>
                                        <p id="linkup<?php echo $checklists['ReqID'];?>"><a href='<?php echo base_url('page/ajax/'.$checklists['DocPath']);?>' target='__blank'>View/Download File</a></p>
                                    <?php endif; ?>
                                    <input type="<?php fieldtype_check($checklists['ReqID']);?>" id="column<?php echo $checklists['ReqID']; ?>" name="columnname"  value="" >
                                    <input type="hidden" name="fieldname"  value="<?php description_check($checklists['ReqID']) ?>">
                                    <input type="hidden" name="branchid"  value="<?php echo $checklists['BranchID'];?>">
                                    <input type="hidden" name="reqid"  value="<?php echo $checklists['ReqID'];?>">

                                </form>
                                <div style="margin-top:10px;" id="progress<?php echo $checklists['ReqID']; ?>" class="progress progress-success progress-striped">
                                        <div class="bar"></div>
                                </div>
                            </td>
                            <?php endif; ?>
                            <td><input <?php if($checklists['Status'] == '1'):  echo "checked" ; endif;  ?>  type="checkbox" class="checkme" name="checklist[]" value="<?php echo $checklists['ReqID'];?>"></td>
                          </tr>
                           <?php endforeach; ?>  
                        </table>            
                    </div>
                </div><!--/span-->
            
            </div><!--/row-->
                <!-- content ends -->
            </div><!--/#content.span10-->
            <script src="<?php echo base_url('page/ajax/widget.js') ?>"></script>
            <script src="<?php echo base_url('page/ajax/jquery-iframe.js') ?>"></script>
            <script src="<?php echo base_url('page/ajax/jquery.fileupload.js') ?>"></script>
            <script>
                $('.checkme').on('change', function() {
                   var chk_stat = $(this).attr('checked');
                   var varx     = $(this).val(); 
                    if(chk_stat == "checked"){
                        $.ajax({
                            url:"<?php echo base_url('page/ajax/checkme.php')?>",
                            type:'post',
                            data:{reqid:varx,st:'1',branchid:'<?php echo $_GET['id'] ?>'},
                            dataType:'json',
                            success:function(j){
                                noty({"text":"You Approve a Requirement","layout":"bottomLeft","type":"success"});
                            }
                        });
                    }else{
                        $.ajax({
                            url:"<?php echo base_url('page/ajax/checkme.php')?>",
                            type:'post',
                            data:{reqid:varx,st:'0',branchid:'<?php echo $_GET['id'] ?>'},
                            dataType:'json',
                            success:function(j){
                                noty({"text":"You Uncheck a  Requirement","layout":"bottomLeft","type":"error"});
                            }
                        });
                    }
                });


               <?php foreach($checklist as $checklists): ?>
               <?php if(fieldtype_checker($checklists['ReqID']) == "text"): ?>
               $('#save<?php echo $checklists['ReqID'] ?>').click(function(){
                   $.ajax({
                        url:"<?php echo base_url('page/ajax/save_requirements.php');?>",
                        type:'post',
                        data:$('#check<?php echo $checklists['ReqID']?>').serialize(),
                        dataType:'json',
                        success:function(j){
                            console.log(j);
                            noty({"text":"Changes Saved","layout":"bottomLeft","type":"success"});
                        },
                        error: function(xhr, status, error) {
                          alert(xhr.responseText);
                        }
                   }); 
               });
               <?php else: ?>

                // When the server is ready...
                $(function () {
                    'use strict';
                    
                    // Define the url to send the image data to
                    var url = "<?php echo base_url('page/ajax/upload_requirements.php');?>";
                    
                    // Call the fileupload widget and set some parameters
                    $('#column<?php echo $checklists['ReqID'] ?>').fileupload({
                        url: url,
                        formData: $('#check<?php echo $checklists['ReqID'];?>').serializeArray(),
                        dataType: 'json',
                        done: function (e, data) {
                            console.log(data.result);
                            var image_uploaded = data.result.image_name;
                            var status         = data.result.status;

                            if(status == "Successfully uploaded!"  ){
                                $("#linkup<?php echo $checklists['ReqID'];?>").remove();
                                $("#check<?php echo $checklists['ReqID'];?>").prepend("<p id='linkup<?php echo $checklists['ReqID'];?>'><a href='<?php echo base_url('page/ajax/');?>"+ image_uploaded +"' target='__blank'>View/Download File</a></p>");
                                //alert(image_uploaded);
                                noty({text: status, type: 'success'});
                            } else{
                                $('#progress').fadeOut(1600);
                                //$('#progress .bar').css('width','0%');
                                noty({text: status, type: 'danger'});
                            }
                            // Add each uploaded file name to the #files list
                           
                        },
                        progressall: function (e, data) {
                            // Update the progress bar while files are being uploaded
                            var progress = parseInt(data.loaded / data.total * 100, 10);
                            $('#progress<?php echo $checklists['ReqID']; ?>').fadeIn();
                            $('#progress<?php echo $checklists['ReqID']; ?> .bar').css(
                                'width',
                                progress + '%'
                            );
                        }
                    });
                });

               <?php endif; ?> 
               <?php endforeach; ?>

              

            </script>
            