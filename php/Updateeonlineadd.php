<?php include('template/header.php'); ?>
<?php include('template/myclass.php'); ?>

<div id="content" class="span10">
            <!-- content starts -->
            <div>
                <ul class="breadcrumb">
                    <li>
                        <a href="#">Home</a> <span class="divider">/</span>
                    </li>
                    <li>
                        <a href="#">Forms</a>
                    </li>
                </ul>
            </div>
            
            <div class="row-fluid sortable">
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-edit"></i> Add  Student to Online Practices </h2>
                        <div class="box-icon">
                            <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
                            <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                            <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                        </div>
                    </div>
                    <div class="box-content">
                        <form class="form-horizontal" action="@UpdatetStudentFormAction@"  id="form3" name="form3" method="post" >
                          <fieldset>
                           <input type="hidden" id="MODE" name="MODE" value="1">

                            
                            <div class="control-group">
                                <label class="control-label" for="focusedInput">ID Number</label>
                                <div class="controls">
                                  <input type="text" id="idnum" value="">
                                  <input class="" name="txteonlineCustNo"type="text" value="">

                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="focusedInput">Fullname</label>
                                <div class="controls">
                                  <input class="input-xlarge"  id="fullname" type="text" value="" readonly>
                                </div>
                            </div>


                            <div class="control-group">
                                <label class="control-label" for="focusedInput">Password</label>
                                <div class="controls">
                                  <input class="input-xlarge" name="txteonlinePassword" type="text" value="">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="focusedInput">Date</label>
                                <div class="controls">
                                  <input class="input-xlarge" name="txteonlineDate" type="text" value="">
                                </div>
                            </div>


                            

                            <input type="hidden" value="<?php echo $_SESSION['UserValue1'] ?>" name="txteonlineCountryID">
                            <input type="hidden" value="<?php echo $_SESSION['UserValue2'] ?>" name="txteonlineBranchID">


                            
                            <div class="form-actions">
                              <!--<button type="submit" value="Submit" class="btn btn-primary">Save changes</button>-->
                              <button type="button"  class="btn btn-primary"  id="">Save changes</button>
                              <button type="reset" class="btn">Cancel</button>
                            </div>
                          </fieldset>
                        </form> 
                     

                    </div>
                </div><!--/span-->

            </div><!--/row-->
                    <!-- content ends -->
            </div><!--/#content.span10-->

<script>
    $('#idnum').keyup(function(){
       idnum  = $(this).val();
       $.ajax({
            url:'template/online_ajax.php',
            type:'post',
            data:{ custno: idnum },
            dataType:'json',
            success: function(x){
                console.log(x);
                $('#fullname').val(j.fname);
            }

        });
    });

</script>            
<?php include('template/footer.php'); ?>            
