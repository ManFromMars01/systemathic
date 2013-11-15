<?php 
include('template/header.php');
include('template/myclass.php'); 
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
                        <a href="#">Create Invoice</a>
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
                        
                        <form name="add_inv_tr" method="post" action="template/inv_transact.php">
                         
                         <div class="control-group" style="float:left; margin-right:10px">
                              <label class="control-label" for="focusedInput">Customer No:</label>
                              <div class="controls">
                                <input  name="custno"  style="width: 75px" type="text" value="<?php echo $custno; ?>" readonly>
                              </div>
                          </div>

                          <div class="control-group" style="float:left; margin-right:10px">
                              <label class="control-label" for="focusedInput">Name:</label>
                              <div class="controls">
                                <input class="input-xlarge focused" type="text" name="fname">
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





                          <a href="#" id="payment">Proceed Payment</a>
                          
                          <div class="payment_container" style="display:none;">
                            
                            Payment Type  <select id="ptype"><option value="Cash">Cash</option><option value="Check">Check</option></select>
                            Remit Amount <input type="text" name="remit"> <br />
                            <label class="ischeck" style="display:none;">BankName:</label> <input class="ischeck" style="display:none;" name="bankname" type="text" value="" >
                            <label class="ischeck" style="display:none;">Branch Name</label> <input class="ischeck" style="display:none;" name="branchname"  type="text" value="" ><br />
                            <label class="ischeck" style="display:none;">Check No:</label> <input class="ischeck" style="display:none;"  name="CheckNo" type="text" value="">
                            <label class="ischeck" style="display:none;">Check Date:</label> <input class="ischeck" style="display:none;" name="CheckDate"  type="text" value="">
                          </div>

                          <div class="allitems">
                              
                          </div>
                          <input type="submit">
                          <br />
                        </form> 
                        <form id="itemcode_form">
                            <div class="control-group">
                                <label class="control-label" for="focusedInput">Item Code:</label>
                                <div class="controls">
                                  <input type="text" name="itemcode" >
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="focusedInput">Taxable:</label>
                                <div class="controls">
                                  <select name="taxable">
                                       <option value="No">No</option>
                                       <option value="Yes">Yes</option> 
                                  </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="focusedInput">Qty:</label>
                                <div class="controls">
                                  <input type="text" name="qty" value="">
                                  <button type="button"  class="btn btn-primary"  id="add_entry_inv">Add Item</button>
                                </div>
                            </div>
                            
                        </form>  
                        <table class="table table-striped table-bordered bootstrap-datatable">
                          <thead>
                              <tr>
                                    <th>Item No</th>
                                    <th>Description</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                    <th>Taxable</th>
                                    <th>Actions</th>
                              </tr>

                          </thead>   
                          <tbody class="insertrow">
                                
                          </tbody>
                      </table>
                      <div style="float:right; padding: 20px;" >Total Price: <input type="text" id="totalprice" value=""></div>  
                      
                      <div>

                      </div>   
                    </div>
                </div><!--/span-->
            
            </div><!--/row-->
                <!-- content ends -->
            </div><!--/#content.span10-->




<script>
    $('#add_entry_inv').click(function(){
        $.ajax({
           url:'template/create_invoice_ajax.php', 
           type:'post',
           data:$('#itemcode_form').serialize(), 
           dataType:'json',
           success: function(j){
                console.log(j);
                //$('#inv_entry_table').dataTable().fnAddData( [j.ItemNo,j.Description,j.Qty, j.Price,'<a class="remove_class" alt="'+j.ItemNo +'" href="#">Remove</a>'] );
                $('.insertrow').append(
                    "<tr class='itemno"+j.ItemNo+"'><td>"+j.ItemNo+"</td><td>"+j.Description+"</td><td>"+j.Qty+"</td><td>"+j.Price+"</td><td>"+j.taxable+"</td><td><a class='remove_class' alt='"+j.ItemNo +"' href='#''>Remove</a></td></tr>" 
                    );
                $('.allitems').append(                      
                    '<div class="itemno'+j.ItemNo+'"><input type="text" name="itemno_inv[]" class="itemno_inv" value="'+ j.ItemNo +'"><input type="text" name="itemno_qty[]" class="itemno_qty" value="'+j.Qty+ '" ><input type="text" name="item_price[]" class="item_price" value="'+j.Price +'"> <input type="text" name="item_taxable[]" class="item_price" value="'+j.taxable +'"></div>'
                );
           }
        });
    });


    $(".remove_class").live( "click", function() {
        test = $(this).attr('alt');
        $('.itemno'+test).remove();
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




</script>



<?php 
include('template/footer.php'); 
?>