<?php 
session_start();
include('page/class/systemathic.php');
include('template/myclass.php');
not_login();
include('page/view/template/header_view.php');
include('template/create_invoice_var.php');

?>
<div id="content" class="span10">
            <!-- content starts -->
            

            <div>
                <ul class="breadcrumb">
                    <li>
                        <a href="index.php">Home</a> <span class="divider">/</span>
                    </li>
                    <li>
                        <a href="#" id="add_entry_inv_default">Create Invoice</a>
                    </li>
                </ul>
            </div>
            


            <div class="row-fluid sortable">        
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-user"></i>Entry</h2>
                        <div class="box-icon">
                            <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
                            <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                            <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                        </div>
                    </div>
                    <div class="box-content">
                        
                        <form name="add_inv_tr" method="post" id="add_inv_tr" action="template/inv_transact.php">
                         
                         <div class="control-group" style="float:left; margin-right:10px">
                              <label class="control-label" for="focusedInput">Customer No:</label>
                              <div class="controls">
                                <input  name="custno"  style="width: 75px" type="text" value="<?php echo $custno; ?>" readonly>
                              </div>
                          </div>

                          <div class="control-group" style="float:left; margin-right:10px">
                              <label class="control-label" for="focusedInput">Name:</label>
                              <div class="controls">
                                <input class="input-xlarge focused" type="text" name="fname" value="<?php echo $customer->fields['SurName'].", ".$customer->fields['FirstName']." ".$customer->fields['MiddleName']; ?>">
                              </div>
                          </div>


                          <div class="control-group" style="float:left; margin-right:10px">
                                <label class="control-label"  for="focusedInput">Due Date:</label>
                                <div class="controls">
                                  <input class="input-xlarge" name="paydate" id="dateme" type="text" required>
                                </div>
                          </div>

                          <div class="control-group" style="float:left; margin-right:10px">
                                <label class="control-label"  for="focusedInput">Tax  Type</label>
                                <div class="controls">
                                  <select name="taxtid"><option value="">Please Select A Tax Id</option><?php echo $options ?></select>
                                </div>
                          </div>
                          <div class="clearfix"></div>
                          <div class="allitems">
                              
                          </div>
                          
                          <br />
                        
                          <div class="group_items" style="width:90%; padding:15px; border:1px solid gray; border-radius:5px;">
                              <div class="control-group" style=" float:left; margin-right:10px">
                                  <label class="control-label" for="focusedInput">Item Code:</label>
                                  <div class="controls">
                                    <input type="text" name="itemcode" id="item_add_code" style="width:75px;" >
                                  </div>
                              </div>
                              <div class="control-group" style=" float:left; margin-right:10px">
                                  <label class="control-label" for="focusedInput">Taxable:</label>
                                  <div class="controls">
                                    <select name="taxable" id="item_add_taxable">
                                         <option value="No">No</option>
                                         <option value="Yes">Yes</option> 
                                    </select>
                                  </div>
                              </div>

                              <div class="control-group" style=" float:left; margin-right:10px">
                                  <label class="control-label" for="focusedInput">Discount:</label>
                                  <div class="controls">
                                    <select name="discount_add" id="discount_add">
                                         <option value="no">Select Discount</option>
                                         <?php echo  $optionsdis; ?> 
                                    </select>
                                    
                                  </div>
                              </div>

                              <div class="control-group" style=" float:left; margin-right:10px">
                                  <label class="control-label" for="focusedInput">Qty:</label>
                                  <div class="controls">
                                    <input type="text" name="qty" id="item_add_qty" value="1" style="width:75px;">
                                    <button type="button"  class="btn btn-primary"  id="add_entry_inv">Add Item</button>
                                  </div>
                              </div>



                              
                              

                              <div class="clearfix"></div>
                                
                          
                            <table class="table table-striped table-bordered bootstrap-datatable">
                              <thead>
                                  <tr>
                                        <th>Item No</th>
                                        <th>Description</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                        <th>Taxable</th>
                                        <th>Discount</th>
                                        <th>Actions</th>
                                  </tr>

                              </thead>   
                              <tbody class="insertrow">
                                    
                              </tbody>
                          </table>
                          


                          <div style="float:right;  width:20%;  padding: 20px;" >
                            <table class="table table-striped table-bordered bootstrap-datatable">
                            <tr><td>Sub-Total:</td><td><p id="totalprice"></p></td><tr>
                              <tr><td>Discount:</td><td><p id="discountme"></p></td><tr>
                            <tr><td>Tax:</td><td><p id="taxamt"></p></td><tr>
                            <tr><td>Total:</td><td><p id="totalsprice"></p></td><tr>
                            </table> 
                          </div>  
                          <div class="clearfix"></div>
                          
                          
                      </div>



                      <div id="payment_transaction" style="width:50%;  padding:15px; border:1px solid gray; border-radius:5px; margin-top: 20px; margin-bottom:5px;">
                          <p><a href="#" id="payment" style="text-decoration:underline;">Proceed To  Payment</a></p>
                          
                          <div class="payment_container" style="display:none;">
                            <label>Payment Type </label>
                            <select id="ptype" name="ptype"><option value="Cash">Cash</option><option value="Check">Check</option></select>
                            
                            <label>Pay Date : </label> 
                            <input type="text" class="datepicker" id="mydate" name="paydate">
                            
                            <label>OR Number: </label>
                            <input type="text" name="ORNumber"> <br />
                            
                            <label>Remit Amount </label>  
                            <input type="text" name="remit"> <br />
                            <label class="ischeck" style="display:none;">BankName:</label> <input class="ischeck" style="display:none;" name="bankname" type="text" value="" >
                            <label class="ischeck" style="display:none;">Branch Name</label> <input class="ischeck" style="display:none;" name="branchname"  type="text" value="" ><br />
                            <label class="ischeck" style="display:none;">Check No:</label> <input class="ischeck" style="display:none;"  name="CheckNo" type="text" value="">
                            <label class="ischeck" style="display:none;">Check Date:</label> <input class="ischeck" style="display:none;" name="CheckDate"  type="text" value="">
                          </div> 
                      </div>     
                      
                      <div>
                        <input type="button" id="create_invoice_activate" value="Submit">
                        </form> 
                      </div>   
                    </div>
                </div><!--/span-->
            
            </div><!--/row-->
                <!-- content ends -->
            </div><!--/#content.span10-->




<script>
$( document ).ready(function() {
      <?php 
         $itemcode = array('MODFEE','BOOKFEE','REGFEE');
         $itempricess  = 0;
         foreach($itemcode as $itemcodes):
         $items= $model->select_where('titems',array('ItemNo' => $itemcodes )); 
      ?>

      itemno = "<?php echo $items->fields['ItemNo'];?>";  
      itemdesc = "<?php echo $items->fields['Description'];?>";
      itemprices = "<?php echo $items->fields['StdCost'];?>"; 
      
      $('.insertrow').append(
                    "<tr class='itemno"+itemno+"'><td>"+itemno+"</td><td>"+itemdesc+"</td><td>1</td><td>"+itemprices+"</td><td></td><td></td><td><a class='remove_class' alt='"+itemno+"' href='#''>Remove</a></td></tr>" 
                    );
      $('.allitems').append(                      
          '<div class="itemno'+itemno+'"><input type="hidden" name="itemno_inv[]" class="itemno_inv" value="'+ itemno +'"><input type="hidden" name="itemno_qty[]" class="itemno_qty" value="1" ><input type="hidden" name="item_price[]" class="item_price" value="'+itemprices+'"> <input type="hidden" name="item_taxable[]" class="item_price" value=""><input type="hidden" name="item_discount[]" class="item_discount" value=""><input type="hidden" name="discount_id[]" class="discount_id" value=""></div>'
      );

     <?php 
      $itempricess =  $itempricess +  $items->fields['StdCost'];
     endforeach; 
     ?>

     $('#totalprice').html('<?php echo $itempricess;?>');
     $('#totalsprice').html('<?php echo $itempricess;?>');
     $('#totaltaxable').val('');
     $('#taxamt').html('');
     $('#discountme').html("");   

    });


    $('#add_entry_inv').click(function(){
      item_add_code = $('#item_add_code').val();
      item_add_taxable = $('#item_add_taxable').val();
      item_add_qty     = $('#item_add_qty').val(); 
      discount_add     = $('#discount_add').val(); 
        $.ajax({
           url:'template/create_invoice_ajax.php', 
           type:'post',
           data: $('#add_inv_tr').serialize() + '&itemcode=' + item_add_code + '&taxable=' + item_add_taxable + '&qty =' + item_add_qty + '&discount='+discount_add , 
           dataType:'json',
           success: function(j){
                console.log(j);
                //$('#inv_entry_table').dataTable().fnAddData( [j.ItemNo,j.Description,j.Qty, j.Price,'<a class="remove_class" alt="'+j.ItemNo +'" href="#">Remove</a>'] );
                $('.insertrow').append(
                    "<tr class='itemno"+j.ItemNo+"'><td>"+j.ItemNo+"</td><td>"+j.Description+"</td><td>"+j.Qty+"</td><td>"+j.Price+"</td><td>"+j.taxable+"</td><td>"+j.discount+"</td><td><a class='remove_class' alt='"+j.ItemNo +"' href='#''>Remove</a></td></tr>" 
                    );
                $('.allitems').append(                      
                    '<div class="itemno'+j.ItemNo+'"><input type="hidden" name="itemno_inv[]" class="itemno_inv" value="'+ j.ItemNo +'"><input type="hidden" name="itemno_qty[]" class="itemno_qty" value="'+j.Qty+ '" ><input type="hidden" name="item_price[]" class="item_price" value="'+j.Price +'"> <input type="hidden" name="item_taxable[]" class="item_price" value="'+j.taxable +'"><input type="hidden" name="item_discount[]" class="item_discount" value="'+j.discount_deci +'"><input type="hidden" name="discount_id[]" class="discount_id" value="'+j.discount_id +'"></div>'
                );

                $('#totalprice').html(j.totalcost);
                $('#totalsprice').html(j.super_tot);
                //$('#totaltaxable').val(j.totaltaxble);
                $('#taxamt').html(j.taxamt);
                $('#discountme').html(j.totaldiscount);
           }
        });
    });

  

    



             





    $(".remove_class").live( "click", function() {
        test = $(this).attr('alt');
        $('.itemno'+test).remove();
        $.ajax({
           url:'template/create_invoice_ajax2.php', 
           type:'post',
           data: $('#add_inv_tr').serialize() + '&itemcode=' + item_add_code + '&taxable=' + item_add_taxable + '&qty =' + item_add_qty , 
           dataType:'json',
           success: function(j){
                console.log(j);
                $('#totalprice').html(j.totalcost);
                $('#totalsprice').html(j.super_tot);
                //$('#totaltaxable').val(j.totaltaxble);
                $('#taxamt').html(j.taxamt);
                $('#discountme').html(j.totaldiscount);


           }
        });


    });

    $('#payment').click(function(){
        $('.payment_container').show();
    });

    $('#ptype').change(function(){
        ptype = $(this).val();
        if(ptype == 'Check'){
            $('.ischeck').show();
        }else{
            $('.ischeck').hide();
        }
    });


    $("#dateme").datepicker();


    $('#create_invoice_activate').live("click", function() {
        $.ajax({
            url:'template/inv_transact.php',
            type:'post',
            data:$('#add_inv_tr').serialize(),
            dataType:'json',
            success: function(j){
                console.log(j);
                $('.modal-body').html(j.success);
                $("#myModal").modal('show'); 
           }

        });
    });






</script>



<?php 
include('template/footer.php'); 
?>