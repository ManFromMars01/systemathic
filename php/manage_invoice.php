<?php 
include('template/header.php');
include('template/myclass.php'); 

$CustNo =  $_GET['CustNo'];

function status_attendance($status){
    $stat_desc = $model->select_where('tastatus', array('ID' => $status));
    $desc = $stat_desc->fields['Description'];
    return $desc;    
}

$invoices = $model->select_where('eorderhdr', array('CustNo' => $CustNo));
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
                        <h2><i class="icon-user"></i>Manage Invoices</h2>
                        <div class="box-icon">
                            <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
                            <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                            <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                        </div>
                    </div>
                    <div class="box-content">
                        <!--<a class="btn btn-success" href="Updatetleveladd.php">Add Level</a>-->
                       
                        <br><br >
                        <table class="table table-striped table-bordered bootstrap-datatable datatable">
                          <thead>
                              <tr>
                                    <th>Date:</th>
                                    <th>Invoice Number:</th>
                                    <th>Name:</th>
                                    <th>Actions:</th>
                                  
                              </tr>

                          </thead>   
                          <tbody>

                            <?php foreach($invoices as $invoice): ?>
                            <tr>
                                <td><?php echo $invoice['Date'];  ?></td>
                                <td><?php echo $invoice['OrderNo'];  ?></td>
                                <td><?php echo $invoice['Name'];  ?></td>
                                <td>
                                <a class="btn btn-info" href="manage_invoice_details.php?CustNo=<?php echo $CustNo?>&amp;InvoiceNo=<?php echo $invoice['OrderNo']?>">Invoice Details</a>
                                </td>
                                
                                
                            </tr>
                            <?php endforeach; ?>
                            
                          </tbody>
                      </table>             
                    </div>
                </div><!--/span-->
            
            </div><!--/row-->
                <!-- content ends -->
            </div><!--/#content.span10-->









<?php 
include('template/footer.php'); 
?>