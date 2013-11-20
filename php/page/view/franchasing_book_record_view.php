<div id="content" class="span10">
            <!-- content starts -->
            

            <?php breadcrumb('<a href="'.base_url('franchising.php').'">Franchising</a> / <a href="#">Master Franchisor</a>'); ?>
            
            <div class="row-fluid sortable">        
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-user"></i> Search Form </h2>
                    </div>
                    <div class="box-content">
                        <form method="get">
                        <div class="control-group" style="float:left;">
                            <label class="control-label" for="selectError">Country</label>
                            <div class="controls">
                              <select data-rel="chosen" id="country_select" name="country">
                                <option value="">Please Select Country</option>
                                <?php foreach($country as $countries): ?>
                                <option value="<?php echo $countries['ID'];?>"><?php echo $countries['Description'];?></option>
                                <?php endforeach; ?>
                              </select>
                            </div>
                        </div> 
                        <div class="control-group" style="float:left; margin-left:5px">
                            <label class="control-label" for="selectError">Branch</label>
                            <div class="controls">
                              <select  id="branch_select" name="branch">
                                 <option></option>
                              </select>
                            </div>
                        </div>
                        <div class="control-group" style="float:left; margin-left:5px">
                            <label class="control-label" for="selectError">&nbsp</label>
                            <div class="controls">
                              <input type="submit" id="submit" class="btn btn-success" value="Submit">
                            </div>
                        </div>   
                        <div class="clearfix"></div>  
                        </form>        
                    </div>
                </div><!--/span-->
            
            </div><!--/row-->


            <div class="row-fluid sortable">        
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-user"></i> Booklist <?php echo $breadcrumbs ?> </h2>
                        <div class="box-icon">
                            <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
                            <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                            <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                        </div>
                    </div>
                    <div class="box-content">
                        <table class="table table-striped table-bordered bootstrap-datatable datatable">
                          <thead>
                              <tr>
                                    <th>Item No.</th>
                                    <th>Description</th>
                                    <th>Stock</th>
                                    <th>Current</th>
                                    <th>Returned</th>
                                    <th>Total</th>
                              </tr>
                          </thead>
                           
                          <tbody>
                            <?php foreach($items as $item): ?>        
                            
                            <?php if($_GET['branch'] != "Overall"): ?>
                            <tr>
                                <td><?php echo $item['ItemNo']; ?></td>
                                <td><?php echo $item['Description'];?></td>
                                <?php 
                                    $countitem1  = $model->count_where('ebooks', array('ItemNo' => $item['ItemNo'], 'Status' => 'Current', 'BranchID' => $_GET['branch'] ));
                                    $countitem2  = $model->count_where('ebooks', array('ItemNo' => $item['ItemNo'], 'BranchID' => $_GET['branch'], 'Status' => 'Returned'));
                                ?>
                                <td>0</td>
                                <td><?php echo $countitem1; ?></td>
                                <td><?php echo $countitem2; ?></td>
                                <td><?php echo $total = $countitem1 + $countitem2 ?></td>       
                            </tr>
                        
                        <?php elseif($_GET['branch'] == "Overall"): ?>    
                              <tr>
                                <td><?php echo $item['ItemNo']; ?></td>
                                <td><?php echo $item['Description'];?></td>
                                <?php 
                                    $countitem1  = $model->count_where('ebooks', array('ItemNo' => $item['ItemNo'], 'Status' => 'Current', 'CountryID' => $_GET['country'] ));
                                    $countitem2  = $model->count_where('ebooks', array('ItemNo' => $item['ItemNo'], 'CountryID' => $_GET['country'], 'Status' => 'Returned'));
                                ?>
                                <td><?php echo $countitem1; ?></td>
                                <td><?php echo $countitem2; ?></td>
                                <td><?php echo $total = $countitem1 + $countitem2 ?></td>       
                            </tr>  


                        <?php endif; ?>


                        <?php endforeach; ?>
                        
              
                            
                          </tbody>
                      </table>            
                    </div>
                </div><!--/span-->
            
            </div><!--/row-->
                <!-- content ends -->
            </div><!--/#content.span10-->
            

<script>
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
</script>