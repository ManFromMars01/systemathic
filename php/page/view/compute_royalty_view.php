<div id="content" class="span10">
            <!-- content starts -->
            <?php breadcrumb('<a href="'.base_url('franchising.php').'">Franchising</a><a href="#">/ Compute Royalty</a>'); ?>

            <?php echo $success ;?>
            <div class="row-fluid sortable">
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-edit"></i> Compute Royalty</h2>
                    </div>
                    


                    <div class="box-content">
                        
                        <form  class="form-horizontal" id="" method="POST" action="<?php echo base_url('page/controller/compute_royalty_resultx.php') ?>" >
                            
                         
                            <div class="groupme" style="width:45%; border:1px solid gray; border-radius:5px; padding:15px; margin-bottom:10px;">

                               <!--<div class="control-group">
                                <label class="control-label"><h4>Compute</h4></label>
                                <div class="controls">
                                  <div style="clear:both"></div>    
                                  <label class="radio"><input type="radio" name=""  value="option1"> All</label>
                                  
                                  <label class="radio"><input type="radio" name=""  value="option2">Per Country</label>
                                  
                                  <label class="radio"><input type="radio" name=""  value="option2">Per Center</label>  
                                  <div style="clear:both"></div>  
                                </div>
                              </div>-->


                              <div class="control-group" style="float:left;">
                                    <label class="control-label" for="selectError">Country</label>
                                    <div class="controls">
                                      <?php $countryme = $model->select_where('tcountry', array('ID' => $_SESSION['UserValue1'] ));?>  
                                      <input type="text" value="<?php echo $countryme->fields['Description']; ?>" readonly>
                                      <input type="hidden" name="country"  value="<?php echo $_SESSION['UserValue1']; ?>">

                                    </div>
                                </div> 
                                <div class="control-group" style="float:left; margin-left:5px">
                                    <label class="control-label" for="selectError">Branch</label>
                                    <div class="controls">
                                      <select name="branch">
                                         <?php foreach($branches_country as  $branches): ?>
                                            <option value="<?php echo $branches['BranchID']; ?>"><?php echo $branches['Description']; ?></option>
                                         <?php endforeach;  ?>
                                            <option value="overall">Overall</option>
                                      </select>
                                    </div>
                                </div>
                                <div class="clearfix"></div>    
                                

                                <div class="control-group" style="float:left;">
                                    <label class="control-label">Month - Year</label>
                                    <div class="controls">
                                        <select name="month" style="width:100px;">
                                            <option value="01">Jan</option>
                                            <option value="02">Feb</option>
                                            <option value="03">Mar</option>
                                            <option value="04">Apr</option>
                                            <option value="05">May</option>
                                            <option value="06">Jun</option>
                                            <option value="07">Jul</option>
                                            <option value="08">Aug</option>
                                            <option value="09">Sep</option>
                                            <option value="10">Oct</option>
                                            <option value="11">Nov</option>
                                            <option value="12">Dec</option>
                                        </select>
                                        <input type="text" name="year"  style="width:100px;" value="<?php echo date('Y'); ?>">
                                    </div>
                                </div>
                                <div class="clearfix"></div>

                                


                            <div class="form-actions">
                              <!--<button type="submit" value="Submit" class="btn btn-primary">Save changes</button>-->
                              <button type="submit" name="save_event"  class="btn btn-primary save_event">Compute</button>
                            </div>

                        </form> 
                    </div>
                </div><!--/span-->

            </div><!--/row-->
                    <!-- content ends -->
            </div><!--/#content.span10-->


           <!-- <script>
                function convert(curfrom,curto){
                    linkimg = '<img src="<?php echo base_url("template/img/ajax-loaders/ajax-loader-6.gif")?>"/>';
                    $('#loadingme').html(linkimg);
                    alert(curfrom);
                    $.ajax({
                        url:'<?php echo base_url("page/ajax/convert.php")?>',
                        type:'post',
                        data:{currencyfrom:curfrom, currencyto:curto},
                        dataType:'json',
                        success:function(j){
                              console.log(j);
                              $('#loadingme').html('<input type="text" name="rate" value="'+j.success+'">');
                        }
                    });

                }

                $('#currencyfrom').change(function(){
                    xfrom = $(this).val();
                    xto   = $('#currencyto').val();
                    convert(xfrom,xto);
                });

                $('#currencyto').change(function(){
                    xfrom = $('#currencyfrom').val();
                    xto   = $(this).val();
                    convert(xfrom,xto);   
                })


                
               $('#country_select').change(function(){
                    countryid = $(this).val(); 
                    alert(countryid);
                    $.ajax({
                        url:'<?php echo base_url("page/ajax/select_branch.php");?>',
                        type:'post',
                        data:{countryid:countryid},
                        dataType:'json',
                        success:function(j){
                            console.log(j);
                            $('#branch_select').html(j.success);

                        }
                    });
               });

            </script>-->