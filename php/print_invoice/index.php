<?php 
include('../template/myclass.php');

$myheader = $model->select_where2('eorderhdr',array('OrderNo' => $_GET['orderno']));
$mydetail = $model->select_where2('eorderdtl',array('OrderNo' => $_GET['orderno']));
$mycustomer = $model->select_where2('tcustomer',array('CustNo' => $myheader->fields['CustNo']));
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	
	<title>Editable Invoice</title>
	
	<link rel='stylesheet' type='text/css' href='css/style.css' />
	<link rel='stylesheet' type='text/css' href='css/print.css' media="print" />
	<script type='text/javascript' src='js/jquery-1.3.2.min.js'></script>
	<script type='text/javascript' src='js/example.js'></script>

</head>

<body>

	<div id="page-wrap">

		<textarea id="header">INVOICE</textarea>
		
		<div id="identity">
		
            <textarea id="address"><?php echo $myheader->fields['Name']; ?>
<?php echo $mycustomer->fields['Address'];?>

Phone: <?php echo $mycustomer->fields['Phone'];?></textarea>

            <div id="logo">

              <div id="logoctr">
                <a href="javascript:;" id="change-logo" title="Change logo">Change Logo</a>
                <a href="javascript:;" id="save-logo" title="Save changes">Save</a>
                |
                <a href="javascript:;" id="delete-logo" title="Delete logo">Delete Logo</a>
                <a href="javascript:;" id="cancel-logo" title="Cancel changes">Cancel</a>
              </div>

              <div id="logohelp">
                <input id="imageloc" type="text" size="50" value="" /><br />
                (max width: 540px, max height: 100px)
              </div>
              <img id="image" src="images/logo.png" alt="logo" />
            </div>
		
		</div>
		
		<div style="clear:both"></div>
		
		<div id="customer">

            <textarea id="customer-title"><?php echo $myheader->fields['Name']; ?></textarea>

            <table id="meta">
                <tr>
                    <td class="meta-head">Invoice #</td>
                    <td><textarea>000123</textarea></td>
                </tr>
                <tr>

                    <td class="meta-head">Date</td>
                    <td><textarea id="date"><?php echo date('M d, y',$myheader->fields['Date']); ?></textarea></td>
                </tr>
                <tr>
                    <td class="meta-head">Amount Due</td>
                    <td><div class="due"><?php echo $myheader->fields['OrderBal'] ?></div></td>
                </tr>

            </table>
		
		</div>
		
		<table id="items">
		
		  <tr>
		      <th>Item</th>
		      <th>Description</th>
		      <th>Unit Cost</th>
		      <th>Quantity</th>
		      <th>Price</th>
		      
		  </tr>
		  
		  
		  <?php foreach($mydetail as $mydetails): ?>
		  <tr class="item-row">
		      <td class="item-name"><div class="delete-wpr"><textarea><?php echo $mydetails['ItemNo']?></textarea><a class="delete" href="javascript:;" title="Remove row">X</a></div></td>
		      
		      <?php $itemdet = $model->select_where2('titems',array('ItemNo'=> $mydetails['ItemNo'])); ?>
		      <td class="description"><textarea><?php echo $itemdet->fields['Description'];?></textarea></td>
		      <td><textarea class="cost"><?php echo $mydetails['Price'] ?></textarea></td>
		      <td><textarea class="qty"><?php echo $mydetails['Qnty'] ?></textarea></td>
		      <td><textarea class="price"><?php echo $mydetails['Amount'] ?></textarea></td>
		  </tr>
		<?php endforeach; ?>
		  
		
		  
		  <tr id="hiderow">
		    <td colspan="5"><a id="addrow" href="javascript:;" title="Add a row">Add a row</a></td>
		  </tr>
		  
		  <tr>
		      <td colspan="2" class="blank"> </td>
		      <td colspan="2" class="total-line">Subtotal</td>
		      <td class="total-value"><div id="subtotal"><?php echo $myheader->fields['ItemTotal'] ?></div></td>
		  </tr>
		  <tr>
		      <td colspan="2" class="blank"> </td>
		      <td colspan="2" class="total-line">Total Tax</td>
		      <td class="total-value"><div id="total"><?php echo $myheader->fields['SalesTaxAmt'] ?></div></td>
		  </tr>
		  <tr>
		      <td colspan="2" class="blank"> </td>
		      <td colspan="2" class="total-line">Total Discount</td>
		      <td class="total-value"><div id="total"><?php echo $myheader->fields['DiscAmount'] ?></div></td>
		  </tr>
		  <tr>

		      <td colspan="2" class="blank"> </td>
		      <td colspan="2" class="total-line">Total</td>
		      <td class="total-value"><div id="total"><?php echo $myheader->fields['OrderTotal'] ?></div></td>
		  </tr>
		  <tr>
		      <td colspan="2" class="blank"> </td>
		      <td colspan="2" class="total-line">Amount Paid</td>

		      <td class="total-value"><textarea id="paid"><?php echo $myheader->fields['RemitAmt'] ?></textarea></td>
		  </tr>
		  <tr>
		      <td colspan="2" class="blank"> </td>
		      <td colspan="2" class="total-line balance">Balance Due</td>
		      <td class="total-value balance"><div class="due"><?php echo $myheader->fields['OrderBal'] ?></div></td>
		  </tr>
		
		</table>
		
		<div id="terms">
		  <h5>Terms</h5>
		  <textarea>NET 30 Days. Finance Charge of 1.5% will be made on unpaid balances after 30 days.</textarea>
		</div>
	
	</div>
	
</body>

</html>