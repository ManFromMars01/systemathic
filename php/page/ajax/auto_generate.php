<?php 
session_start();
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); // dont use $model variable

$branchid = $_SESSION['UserValue2'];

$branch = $model->select_where('thitems', array('BranchID' => $branchid));

foreach($branch as $branch_item):
	if($branch_item['QtyOnHand'] <= $branch_item['ReOrderPT']):
		$itemno  = $branch_item['ItemNo'];
		$desc  = $model->select_where('titems', array('ItemNo' => $itemno));
		$description =   $desc->fields['Description'];
		$itemcost = $branch_item['StdCost'];
		$qty  = $branch_item['ReOrderQty'];


		$appendthis  .=<<<EOT
<tr>
	    <td><input type="text" name="item_code[]" style="width:30px;"  value=$itemno readonly /></td>
	   	<td>$description</td>
	    <td><input style="width:30px;" type="text" alt="$itemno" class="qty" name="qty[]" value="$qty"></td>
	    <td><input style="width:80px;" type="text" class="price" name="price[]" value=$itemcost></td>
	   	<td><input style="width:40px;" type="text" name="discount[]"></td>
    </tr>
EOT;

	$_SESSION['cart'][] = array("id" => $itemno,"quantity" => $quantity, "price" => $itemcost );} // add items to cart
	endif; 

endforeach;


foreach($_SESSION['cart']  as $key => $item):	 
	 $total = $total  + ($item['quantity'] * $item["price"]);
	 $quantitys = $quantitys + $item['quantity'];  			
endforeach; 
$success = array('appendthis' => $appendthis, 'status' => 1, 'total' => number_format($total,2), 'quantity' => $quantitys );	
echo json_encode($success);	




?>