


<div id="content" class="span10">
            <!-- content starts -->
            

            <?php breadcrumb('Royalty Table View') ?>
            
            <div class="row-fluid sortable">        
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-user"></i> Royalty  </h2>
                        <div class="box-icon">
                            <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
                            <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                            <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                        </div>
                    </div>
                    <div class="box-content">
                        <div class="control-group" style="float:left;">
                            <div class="controls">
                                <select name="month" style="width:100px;">
                                    <option value="01">January</option>
                                    <option value="02">February</option>
                                    <option value="03">March</option>
                                    <option value="04">April</option>
                                    <option value="05">May</option>
                                    <option value="06">June</option>
                                    <option value="07">July</option>
                                    <option value="08">August</option>
                                    <option value="09">September</option>
                                    <option value="10">October</option>
                                    <option selected value="11">November</option>
                                    <option value="12">December</option>
                                </select>
                                <input type="text" name="year"  style="width:100px;" value="<?php echo date('Y'); ?>">
                                <button class="btn btn-info">Show Royalty </button>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <table class="table table-striped table-bordered bootstrap-datatable datatable">
                          <thead>
                              <tr>
                                    <th>Year</th>
                                    <th>MOnth</th>
                                    <th>Country</th>
                                    <!--<th>Head Office</th>-->
                                    <th>Royalty</th>
                                    <th>Due Date</th>
                                    <th>Status</th>
                                    <th>Action</th>     

                              </tr>
                          </thead>
                           
                            

                          <tbody>
                                <?php foreach($branches as $branch): ?>
                                <?php $countfirst = $model->count_where('ehroyalty',array('BranchID' => $branch['BranchID'], 'CountryID' => $branch['CountryID'], 'AppMonth' => $month, 'Year' => $year )); ?>
                               
                                <?php if($countfirst == 0): ?>
                                <tr>
                                    <td><?php echo $year;?></td>
                                    <td><?php echo $month;?></td>
                                    <td><?php $model->country($branch['CountryID']);?></td>
                                    <!--<td><?php $model->branch($$branch['BranchID']);?></td>-->
                                    <td><?php echo "Not Set";?></td>
                                    <td><?php echo "Not Set"; ?></td>
                                    
                                    <td>
                                        <?php echo "Not Set"; ?>
                                    </td>
                                    

                                    <td><a href="#" class="btn btn-info">Notify Head Office</a></td>
                                </tr>

                                <?php else: ?>
                                <?php $royalty_country = $model->select_where('ehroyalty',array('BranchID' => $branch['BranchID'], 'CountryID' => $branch['CountryID'], 'AppMonth' => $month, 'Year' => $year )); ?>

                                <tr>
                                    <td><?php echo $royalty_country->fields['Year'];?></td>
                                    <td><?php echo $royalty_country->fields['AppMonth'];?></td>
                                    <td><?php $model->country($royalty_country->fields['CountryID']);?></td>
                                    <!--<td><?php $model->branch($royalty_country->fields['BranchID']);?></td>-->
                                    <td><?php echo $model->currencys($royalty_country->fields['CountryID'])." ".$royalty_country->fields['TotalAmount'];?></td>
                                    <td><?php echo $royalty_country->fields['DueDate'];?></td>
                                    
                                    <td>
                                        <?php if($royalty_country->fields['Status'] == 5): 
                                            echo "Billed";
                                        ?>

                                        <?php endif ?>
                                    </td>
                                    

                                    <td>
                                        <a href="<?php echo base_url('page/controller/franchisee_royalty.php?countryid='.$royalty_country->fields['CountryID']) ?>" class="btn btn-info">View Franchisee's Info</a>
                                    </td>
                                </tr>
                                <?php endif; ?>  

                                <?php  endforeach; ?>     
                          </tbody>
                      </table>            
                    </div>
                </div><!--/span-->
            
            </div><!--/row-->
                <!-- content ends -->
            </div><!--/#content.span10-->
            

<script>
    $('.remove').click(function(){
        custno = $(this).attr('alt');
        $("#myModal100").modal('show');
        $("#y").attr('alt',custno );
    });

    $('#y').click(function(){
        custno = $(this).attr('alt');
        $.ajax({
            url:'<?php echo base_url();?>page/ajax/online.php',
            type:'post',
            data:{custno:custno},
            dataType:'json',
            success:function(j){
                console.log(j);
                $('#myModal100').modal('hide');
                $('#'+custno).remove();
                noty({"text":" Successfully Remove","layout":"bottomLeft","type":"error"});

            }

        });        
    });

</script>            