<?php 
session_start();
include('page/class/systemathic.php');
include('template/myclass.php');
not_login();
include('page/view/template/header_view.php');
 

$CustNo =  $_GET['CustNo'];
$InvoiceNo = $_GET['InvoiceNo'];




function status_attendance($status){
    $stat_desc = $model->select_where('tastatus', array('ID' => $status));
    $desc = $stat_desc->fields['Description'];
    return $desc;    
}




$invoices = $model->select_where('eorderhdr', array('CustNo' => $CustNo));



$inv =$model->select_where('eorderhdr', array('OrderNo' => $InvoiceNo));
    $OrderTotal = $inv->fields['OrderTotal'];
    $RemitAmt = $inv->fields['RemitAmt'];
    $OrderBal = $inv->fields['OrderBal'];
    $ORNumber = $inv->fields['ORNumber'];
    $BankName = $inv->fields['BankName'];
    $Branch = $inv->fields['Branch'];
    $CheckNo = $inv->fields['CheckNo'];
    $CheckDate = $inv->fields['CheckDate'];
    $PayCode = $inv->fields['PayCode'];

foreach ($invoices as $invoice):

    $Total = $invoice['OrderTotal'];
    $Name = $invoice['Name']; 
    //$PayCode = $invoice['PayCode'];
    $PayDate = $invoice['PayDate'];
    


endforeach;


$items = $model->select_where('eorderdtl', array('OrderNo' => $InvoiceNo));



?>
<div id="content" class="span10">
            <!-- content starts -->
            

            <div>
                <ul class="breadcrumb">
                    <li>
                        <a href="index.php">Home</a> <span class="divider">/</span>
                    </li>
                    <li>
                        <a href="#">BookList</a>
                    </li>
                </ul>
            </div>


            <div class="row-fluid sortable">        
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-user"></i>Invoice Details</h2>
                        <div class="box-icon">
                            <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
                            <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                            <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                        </div>
                    </div>
                    <div class="box-content">
                        <!--<a class="btn btn-success" href="Updatetleveladd.php">Add Level</a>-->
                       
                      
                            <div class="control-group">
                                <label class="control-label" for="focusedInput">Invoice No:</label>
                                <div class="controls">
                                   <input  name="invoiceno"   type="text" value="<?php echo $items->fields['OrderNo'] ; ?>" readonly>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="focusedInput">Name:</label>
                                <div class="controls">
                                  <input  name="custname"  style="width: 30%;" type="text" value="<?php echo $Name ; ?>" readonly>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="focusedInput">Mode of Payment:</label>
                                <div class="controls">
                                                                    
                                  <?php
                                   
                                    if ($PayCode == "Cash" ){

                                        //echo "hey";
                                        echo "<input type='text' value='$PayCode' name='pay' readonly>";
                                    }
                                    elseif ($PayCode == "Check") {
                                        //echo "yow";
                                        echo "<input type='text' value='$PayCode' name='pay' readonly> <br> <label>Bank Name: </label><input type='text' value='$BankName' name='bankname' readonly> <br> <label> Branch: </label> <input type='text' value='$Branch' name='branch' readonly> <br> <label> Check Number:</label>  <input type='text' value='$CheckNo' name='checkno' readonly>  <br> <label> Check Date:</label> <input type='text' value='$CheckDate' name='check' readonly>";
                                    }



                                  ?>      

                                  
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="focusedInput">Pay Date:</label>
                                <div class="controls">
                                  <input  name="paydate"   type="text" value="<?php echo $PayDate ; ?>" readonly>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="focusedInput">Official Receipt (OR) Number:</label>
                                <div class="controls">
                                  <input  name="ornumber"   type="text" value="<?php echo $ORNumber ; ?>" readonly>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="focusedInput">Items:</label>
                                <div class="controls">
                                    <table class="table table-striped table-bordered bootstrap-datatable datatable">
                                         <thead>
                                            <tr>
                                                <th>Item Name:</th>  
                                                <th>Quantity:</th>
                                                <th>Price:</th>
                                                <th>Sub Total:</th>
                                                

                                            </tr>
                                        </thead>   
                                        
                                        <tbody>
                           
                                                <?php foreach($items as $item):?>    
                                            <tr>
                                                <td><?php echo $item['ItemNo']?></td>
                                                <td><?php echo $item['Qnty']?></td>
                                                <td><?php echo $item['Price']?></td>
                                                <td><?php echo $item['Amount']?></td>
                                
                                                
                                            </tr>
                                                <?php endforeach; ?>
                            


                                         </tbody>
                                    </table>            

                                

                                </div>
                            </div>


                            <div class="control-group">
                                <label class="control-label" for="focusedInput">Order Total Amount:</label>
                                <div class="controls">
                                  <input  name="ordertotal"   type="text" value="<?php echo $OrderTotal; ?> " readonly>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="focusedInput">Remit Amount:</label>
                                <div class="controls">
                                  <input  name="remitamt"   type="text" value="<?php echo $RemitAmt ; ?>" readonly>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="focusedInput">Balance:</label>
                                <div class="controls">
                                  <input  name="orderbal"   type="text" value="<?php echo $OrderBal ; ?>" readonly>
                                </div>
                            </div>







                    </div>
                </div><!--/span-->
            
            </div><!--/row-->
                <!-- content ends -->
            </div><!--/#content.span10-->









<?php 
include('template/footer.php'); 
?>