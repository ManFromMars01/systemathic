


<div id="content" class="span10">
            <!-- content starts -->
            

            <?php breadcrumb('Royalty Table View') ?>

            <h4>Country: <?php $model->country($branchdet->fields['CountryID']);?></h4>
            <h4>Currency: <?php echo $model->currencys($branchdet->fields['CountryID']);?> </h4>
            
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

                        <?php  $check = $model->select_where('tbranch', array('BranchID' => $branch));?>

                        <?php if($check->fields['HQOperation'] == "No"  && $check->fields['HQCenterOperation'] == "No"  ): ?>
                        <table class="table table-striped table-bordered bootstrap-datatable datatable">
                          <thead>
                              <tr>
                                    <th>Year</th>
                                    <th>MOnth</th>
                                    <th>Branch</th>
                                    <th>Royalty Description</th>
                                    <th>For Royalty (FR)</th>
                                    <th>Royalty Percentage (RP)</th>
                                    <th>
                                        Royalty Amount<span style="font-size:10px;"> (= FR X RP)</span>
                                    </th>     
                              </tr>
                          </thead>
                          <tbody>
                               <?php foreach($royalty as $royalties): ?>
                               <tr>
                                    <td><?php echo $royalties['Year'];?></td>
                                    <td><?php echo $royalties['Month'];?></td>
                                    <td><?php $model->branch($royalties['BranchID'])?></td>
                                    <td><?php $model->royaltydesc($royalties['RoyaltyID']) ?></td>           
                                    <td><?php echo $model->currencys($royalties['CountryID']).' '.$royalties['ForRoyaltyAmt']?></td>
                                    <td>%<?php echo $royalties['PercentToHQ']?></td>
                                    <td><?php echo $model->currencys($royalties['CountryID']).' '.$royalties['CtrRoyaltyToHQ']?></td>
                  
                              </tr>
                              <?php endforeach; ?>   
                          </tbody>
                      </table>
                      <?php endif; ?>   

                      <?php if($check->fields['HQOperation'] == "Yes"): ?>
                        <table class="table table-striped table-bordered bootstrap-datatable datatable">
                          <thead>
                              <tr>
                                    <th>Year</th>
                                    <th>MOnth</th>
                                    <th>Branch</th>
                                    <th>Royalty Description</th>
                                    <th>For Royalty HQ <br /> (FRHQ)</th>
                                    <th>For Royalty UF <br />(FRUF)</th>
                                    <th>Royalty Percentage <br /> (RP)</th>
                                    <th>HQ Royalty<br /><span style="font-size:10px;"> (FRHQ X RP)</span></th>
                                    <th>UF Royalty<br /><span style="font-size:10px;">(FRUF X RP X RP)</span></th>
                                    <th>
                                        Total Royalty Amount
                                    </th>     
                              </tr>
                          </thead>
                          <tbody>
                               
                               <?php foreach($royalty as $royalties): ?> 
                               <tr>
                                    <td><?php echo $royalties['Year'];?></td>
                                    <td><?php echo $royalties['Month'];?></td>
                                    <td><?php $model->branch($royalties['BranchID']);?></td>
                                    <td><?php $model->royaltydesc($royalties['RoyaltyID']); ?></td>
                                    <td><?php  echo $model->currencys($royalties['CountryID']).' '.$royalties['ForRoyaltyAmt'];?></td>
                                    <td><?php  echo $model->currencys($royalties['CountryID']).' '.$royalties['ForRoyaltyAmtAllUF'];?></td>
                                    <td><?php echo '%'. $royalties['PercentToMstr'];?></td>
                                    <td><?php echo  $model->currencys($royalties['CountryID']).' '.$royalties['RoyaltyAmtOfHQCtr'];?></td>
                                    <td><?php echo  $model->currencys($royalties['CountryID']).' '.$royalties['CtrRoyaltyToMstr'];?></td>
                                    <?php $sumall = $royalties['RoyaltyAmtOfHQCtr'] +  $royalties['CtrRoyaltyToMstr'];  ?>
                                    <td>
                                        <?php echo $model->currencys($royalties['CountryID']).' '.number_format($sumall,2); ?>
                                    </td>     
                              </tr>
                          <?php endforeach; ?>
                          </tbody>
                      </table>
                      <?php endif; ?> 


                    </div>
                </div><!--/span-->
            
            </div><!--/row-->
                <!-- content ends -->
            </div><!--/#content.span10-->
            
