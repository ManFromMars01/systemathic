<script type="text/javascript">
    // select file function only for styling up input[type="file"]
    function select_file(){
      document.getElementById('image').click();
      return false;
    }
  </script>


<div id="content" class="span10">
            <!-- content starts -->
            

            <?php breadcrumb('Royalty Table View') ?>

            
            
            <div class="row-fluid sortable">        
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-user"></i> Royalty  </h2>
                    </div>
                    <div class="box-content">
                        
                        <h4 style="float:left;">Country: <?php $model->country($branchdet->fields['CountryID']);?></h4>
                        <h4 style="float:right;">Currency: <?php echo $model->currencys($branchdet->fields['CountryID']);?> </h4>

                        <div class="clearfix"></div>
                        <br />
                        <?php  $check = $model->select_where('tbranch', array('BranchID' => $branch));?>

                        <?php if($check->fields['HQOperation'] == "Yes" ): ?>
                        <table class="table table-striped table-bordered bootstrap-datatable ">
                          <thead>
                              <tr>
                                    <th>Year</th>
                                    <th>MOnth</th>
                                    <th>Branch</th>
                                    <th>Royalty Description</th>
                                    <th>For Royalty HQ (FRHQ)</th>
                                    <th>For Royalty UF (FRUF)</th>
                                    <th>Royalty Percentage (RP)</th>
                                    <th>Royalty HQ(RHQ)</th>
                                    <th>Royalty UF (RUF)</th>
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
                                    <td><?php echo $model->currencys($royalties['CountryID']).' '.$royalties['ForRoyaltyAmtAllUF']?></td>
                                    <td>%<?php echo $royalties['PercentToMstr']?></td>
                                    <td><?php echo $model->currencys($royalties['CountryID']).' '.$royalties['RoyaltyAmtOfHQCtr']?></td>
                                    <td><?php echo $model->currencys($royalties['CountryID']).' '.$royalties['CtrRoyaltyToMstr']?></td>

                                    <?php $total = $royalties['RoyaltyAmtOfHQCtr'] +  $royalties['CtrRoyaltyToMstr']; ?>
                                    <td><?php echo $model->currencys($royalties['CountryID']).' '.$total?></td>
                  
                              </tr>
                              <?php  $supertotal = $supertotal  +  $total;  ?>
                              <?php endforeach; ?> 
                              <tr>
                                  <td colspan="9" style="text-align:right; background:#7dc5ff; color:white;"><strong>Total Payment:</strong></td>
                                  <td  style="background:#7dc5ff; color:white;"><strong><?php echo  $model->currencys($branchdet->fields['CountryID'])." ".number_format($supertotal,2); ?></strong></td>
                              <tr>
                              <tr>
                                  <td colspan="9" style="text-align:right; background:#7dc5ff; color:white;"><strong>Balance:</strong></td>
                                  <td  style="background:#7dc5ff; color:white;"><strong><?php echo  $model->currencys($branchdet->fields['CountryID'])." ".number_format($supertotal,2); ?></strong></td>
                              <tr>  
                              <tr>
                                  <td colspan="10"  style="text-align:center;">
                                    <a href="#" class="btn btn-primary"  id="paymentform">Payment</a>

                                    <div id="formme" style="border:1px solid blue; border-radius:5px; margin:10px auto; width:30%; display:none;">
                                        <div class="status"></div>

                                       <form  id="pure-form" class="pure-form" action="<?php echo base_url('page/ajax/uploadjs.php'); ?>" enctype="multipart/form-data" method="post">

                                          <div class="control-group">
                                            <input type ="hidden" name="bilid" value="<?php echo $yourinv->fields['BillingID'] ?>">
                                              <br />
                                                <label class="control-label" for="selectError">Payment Type</label>
                                                <div class="controls">
                                                  <select name="payment_type">
                                                    <?php foreach($paytype as $paytypes): ?>
                                                      <option value="<?php echo $paytypes['PayType'];?>"><?php echo $paytypes['Description'];  ?></option>
                                                    <?php endforeach; ?>  
                                                  </select>
                                                </div>
                                           </div>
                                           <div class="control-group">
                                                <label class="control-label" for="selectError">Date: </label>
                                                <div class="controls">
                                                    <input type="text" name="date_rel" class="datepicker">
                                                </div>
                                           </div>
                                           <div class="control-group">
                                                <label class="control-label" for="selectError">Amount: </label>
                                                <input type="hidden" name="currency" value="<?php echo $model->currencys($branchdet->fields['CountryID']);?>">
                                                <div class="controls">
                                                    <input type="text" name="amount" >
                                                </div>
                                           </div>



                                           <div class="control-group">
                                                <label class="control-label" for="selectError">Proof:</label>
                                                <div class="controls">
                                                  <input class="input-file uniform_on" id="fileInput" name="image" type="file">
                                                  <input class="pure-button pure-button-primary" type="submit" value="Upload!">      
                                                </div>

                                                <br />
                                                <div class="progress" style="width:70%; margin:0 auto; display:none;">
                                                    <div class="bar"></div >
                                                    <div class="percent">0%</div >
                                                </div>
                                                <br />
                                                <div style="width:80%; margin:0 auto;">
                                                <img id="img_preview" src="" style="display:none;">
                                                </div>
                                                <br />
                                                <input type="hidden" id="image_name" name="image_name">
                                                <button id="saveme" class="btn-primary btn">Save Payment</button>

                                           </div>

                                        </form>
                                    </div>  

                                  </td>
                              </tr>   
                          </tbody>
                      </table>
                      <?php endif; ?>   

                      

                    </div>
                </div><!--/span-->
            
            </div><!--/row-->
                <!-- content ends -->




            <div class="row-fluid sortable">        
                <div class="box span12">
                    <div class="box-header well payment" data-original-title>
                        <h2><i class="icon-user"></i> Your Payment</h2>
                    </div>
                    <div class="box-content hide payments" >
                        <table class="table table-striped table-bordered bootstrap-datatable datatable">
                          <thead>
                              <tr>
                                    <th>Pay date</th>
                                    <th>Type</th>
                                    <th>Amount</th>
                                    <th>Proof</th>
                                    <th>Status</th>
                              </tr>
                          </thead>
                           
                          <tbody class="appendme">
                              <?php foreach($payment as $payments): ?>
                              <tr>
                                    <td><?php echo $payments['PayDate']; ?></td>
                                    <td><?php echo $model->paytype($payments['PayType']) ?></td>
                                    <td><?php echo  $model->currencys($branchdet->fields['CountryID'])." ".number_format($payments['RemitAmt'],2); ?></td>
                                    <td><a href="<?php echo base_url('page/ajax/'.$payments['DocReference'])?>" target="__blank"  class="btn-info btn viewme" alt="">View </button></td>
                                    <td><span class="btn btn-info">For Validation</span></td>
                              </tr>
                            <?php endforeach; ?>
                          </tbody>
                      </table>            
                    </div>
                </div><!--/span-->
            
            </div><!--/row-->    

            <div class="row-fluid sortable">        
                <div class="box span12">
                    <div class="box-header well collection" data-original-title>
                        <h2><i class="icon-user"></i> Collection</h2>
                    </div>
                    <div class="box-content hide collections" >
                        <table class="table table-striped table-bordered bootstrap-datatable datatable">
                          <thead>
                              <tr>
                                    <th>Branch</th>
                                    <th>Invoice No.</th>
                                    <th>Pay date</th>
                                    
                                    <th>Type</th>
                                    <th>Amount</th>
                                    <th>Proof of Payment</th>
                                    <th>Status</th>
                              </tr>
                          </thead>
                           
                          <tbody class="appendme2">
                              <?php foreach($billing as $billings): ?>
                                    <?php  $branchpayments= $model->select_where('eroyaltypayment',array('BillingID' => $billings['BillingID'], 'PaymentStatus'=> '0')); ?>  
                                    <?php foreach($branchpayments as $branchpayment): ?>
                                    <tr class="pay<?php echo $branchpayment['PaymentID'] ?>">
                                        <td><?php $model->branch($billings['BranchID']);?></td>
                                        <td><?php echo $billings['BillingID'] ?> <a href="<?php echo base_url('page/controller/royalty_billing.php?branchid=PH003') ?>">View Details</a></td>
                                        <td><?php echo $branchpayment['PayDate']; ?></td>
                                        
                                        <td><?php echo $model->paytype($branchpayment['PayType']) ?></td>
                                        <td><?php echo  $model->currencys($branchdet->fields['CountryID'])." ".number_format($branchpayment['RemitAmt'],2); ?></td>
                                        <td><a href="<?php echo base_url('page/ajax/'.$branchpayment['DocReference'])?>" target="__blank"  class="btn-info btn viewme" alt="">View </button></td>
                                        <td class="status-validate<?php echo $branchpayment['PaymentID'] ?>">
                                          <span class="btn btn-info valid"   alt="<?php echo $branchpayment['PaymentID'] ?>">Valid</span>
                                          <span class="btn btn-danger invalid" alt ="<?php echo $branchpayment['PaymentID'] ?>"  >Invalid</span>  
                                        </td>
                                    </tr> 
                                  <?php endforeach; ?>
                              <?php endforeach; ?>
                          </tbody>
                      </table>            
                    </div>
                </div><!--/span-->
            
            </div><!--/row-->    

            <div class="row-fluid sortable">        
                <div class="box span12">
                    <div class="box-header well collected" data-original-title>
                        <h2><i class="icon-user"></i> Collected</h2>
                    </div>
                    <div class="box-content hide collecteds" >
                        <table class="table table-striped table-bordered bootstrap-datatable datatable">
                          <thead>
                              <tr>
                                    <th>Branch</th>
                                    <th>Invoice No.</th>
                                    <th>Pay date</th>
                                    
                                    <th>Type</th>
                                    <th>Amount</th>
                                    <th>Proof of Payment</th>
                                    <th>Status</th>
                              </tr>
                          </thead>
                           
                          <tbody class="appendme">
                              <?php foreach($billing as $billings): ?>
                                    <?php  $branchpayments= $model->select_where('eroyaltypayment',array('BillingID' => $billings['BillingID'], 'PaymentStatus' => '1')); ?>  
                                    <?php foreach($branchpayments as $branchpayment): ?>
                                    <tr>
                                        <td><?php $model->branch($billings['BranchID']);?></td>
                                        <td><?php echo $billings['BillingID'] ?> <a href="<?php echo base_url('page/controller/royalty_billing.php?branchid=PH003') ?>">View Details</a></td>
                                        <td><?php echo $branchpayment['PayDate']; ?></td>
                                        
                                        <td><?php echo $model->paytype($branchpayment['PayType']) ?></td>
                                        <td><?php echo  $model->currencys($branchdet->fields['CountryID'])." ".number_format($branchpayment['RemitAmt'],2); ?></td>
                                        <td><a href="<?php echo base_url('page/ajax/'.$branchpayment['DocReference'])?>" target="__blank"  class="btn-info btn viewme" alt="">View </button></td>
                                    </tr> 
                                  <?php endforeach; ?>
                              <?php endforeach; ?>
                          </tbody>
                      </table>            
                    </div>
                </div><!--/span-->
            
            </div><!--/row-->

            </div><!--/#content.span10-->






            <div class="modal hide fade" id="myModalimg">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h3></h3>
              </div>
              <div class="modal-body">
                <p>Successfully Updated</p>
              </div>
              <div class="modal-footer">
                <a href="#" class="btn" data-dismiss="modal">Close</a>
                <!--<a href="BrowseStudentlist.php" class="btn btn-primary">Back To Student List</a>-->
              </div>
            </div>

            

            
            <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
            <script type="text/javascript" src="<?php echo base_url('page/ajax/jquery.form.min.js') ?>"></script>

           <script>
                $(document).ready(function() {
                      /* variables */
                      var preview = $('img');
                      var status = $('.status');
                      var percent = $('.percent');
                      var bar = $('.bar');
                      var imagename =  $('#image_name');
                      var image_prev =  $('#img_preview');
                      var progress = $('.progress');

                      $('.payment').click(function(){
                         $('.payments').toggle("slow");

                      });

                      $('.collection').click(function(){
                         $('.collections').toggle("slow");

                      });

                      $('.collected').click(function(){
                         $('.collecteds').toggle("slow");

                      });



                      $('.valid').click(function(){
                         paymentid =  $(this).attr('alt');
                         if (confirm('Are you sure with this action?')) {
                             $.ajax({
                                url:'<?php echo base_url('page/ajax/validate_payment.php'); ?>',
                                type:'post',
                                data:{paymentid:paymentid, valid:"valid"},
                                dataType:'json',
                                success:function(j){
                                    console.log(j);
                                    alert('Transaction Complete!! Details Move to Collected Table!!');
                                    $('.pay'+paymentid).remove();
                                }
                             });    
                          
                         }                         
                      });


                      $('.invalid').click(function(){
                         paymentid =  $(this).attr('alt');
                         if (confirm('Are you sure with this action?')) {
                             $.ajax({
                                url:'<?php echo base_url('page/ajax/validate_payment.php'); ?>',
                                type:'post',
                                data:{paymentid:paymentid, valid:'invalid'},
                                dataType:'json',
                                success:function(j){
                                    console.log(j);
                                    $('.status-validate'+paymentid).html('Invalid');
                                    alert('Transaction Complete');
                                    
                                }
                             });    
                          
                         }
                                                
                      });




                      /* only for image preview */
                      $("#image").change(function(){
                        preview.fadeOut();

                        /* html FileRender Api */
                        var oFReader = new FileReader();
                        oFReader.readAsDataURL(document.getElementById("image").files[0]);

                        oFReader.onload = function (oFREvent) {
                          preview.attr('src', oFREvent.target.result).fadeIn();
                        };
                      });

                      /* submit form with ajax request */
                      $('form').ajaxForm({

                        /* set data type json */
                        dataType:  'json',
                        type: 'post',
                        //data: $('#pure-form').serialize();
                        /* reset before submitting */
                        beforeSend: function() {
                          status.fadeOut();
                          bar.width('0%');
                          percent.html('0%');
                        },

                        /* progress bar call back*/
                        uploadProgress: function(event, position, total, percentComplete) {
                          progress.show();
                          var pVel = percentComplete + '%';
                          bar.width(pVel);
                          percent.html(pVel);
                        },

                        /* complete call back */
                        complete: function(data) {
                          //preview.fadeOut(800);
                          imagename.val(data.responseJSON.image_name);
                          image_prev.fadeIn();
                          progress.fadeOut(800);
                          image_prev.attr('src','<?php echo base_url("page/ajax/"); ?>' + data.responseJSON.image_name)

                        }

                      });

                      $('#saveme').click(function(){
                        $.ajax({
                            url:'<?php echo base_url('page/ajax/save_payment.php');?>',
                            type: 'post',
                            data: $('#pure-form').serialize(),
                            dataType:'json',
                            success:function(j){
                              console.log(j);
                              $('.appendme').prepend(j.yourhtml);
                              $("#formme :input").each(function(){ $(this).val("")});
                              $('#img_preview').hide();
                              $('#formme').toggle("slow");
                              alert('Transaction Complete');




                           }

                        });



                      });


                      $('#paymentform').click(function(){
                        $('#formme').toggle("slow");
                      });

                      $('.viewme').click(function(){
                         imageme = $(this).attr('alt');
                         $('#myModalimg .modal-body').html('<img src="<?php echo base_url('page/ajax/')?>'+imageme +'"/>');
                         $('#myModalimg').modal('show');




                      });



                    });
            </script>