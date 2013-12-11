<?php 
session_start();
//echo $_SESSION['OrderHQ'];
$myName = $_SESSION["myname"];
$quantitys = 0;
$total = 0;
$discounta = 0;
$discountb = 0;
$discountc = 0;
$groupa = 0;
$groupb = 0;
$groupc = 0;
$totalga = 0;
$totalgb = 0;
$totalgc = 0;
$supertotal = 0;
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); // dont use $default variable

$discount_country= $model->select_where('tcountry',array('ID' => $_SESSION['UserValue1']));
if($discount_country->fields['DiscountType'] == 1){
	$groupa = $discount_country->fields['ItemDiscRateA'];
	$groupb = $discount_country->fields['ItemDiscRateB'];
	$groupc = $discount_country->fields['ItemDiscRateC'];
}

//variable and functions here

include($default->template('header_view'));
include($default->main_view('order_view'));
?>
<script>
	$(document).ready(function(){
		$('#itemcode').focus();
		$('#itemcode').change(function(){
		$.ajax({
			url:'<?php echo base_url('page/ajax/select_item.php') ?>',
		   type:'post',
		   data:$('#cart').serialize(),
		   dataType:'json',
		   success: function(j){
		   		console.log(j);
		   		if(j.status == 1){
		   			$('.orders').append(j.appendthis);
		   			$('.subtotal').html(j.total);
		   			$('.nocart').html(j.quantity);
		   			$('.forda').html(j.fora);
		   			$('.fordb').html(j.forb);
		   			$('.fordc').html(j.forc);
		   			$('.disca').html(j.pricea);
		   			$('.discb').html(j.priceb);
		   			$('.discc').html(j.pricec);
		   			$('#total').html(j.supertotal);
		   			$('#itemcode').val('');
		   			$('#itemcode').focus();

		   		} else if(j.status == 0){
		   			alert('Product not Exist');
		   			$('#itemcode').val('');
		   			$('#itemcode').focus();
		   		} else if(j.status == 2){
		   			alert('Out of Stock');
		   			$('#itemcode').val('');
		   			$('#itemcode').focus();
		   		}
		   		else if(j.status == 3){
		   			alert('Already In Cart');
		   			$('#itemcode').val('');
		   			$('#itemcode').focus();
		   		}
			   }, 
			   error: function(xhr, status, error) {
                          alert(xhr.responseText);
               }




			});
		});
		
		$('.qty').live("change",function(){
			item_id = $(this).attr('alt');
			newqty  = $(this).val();

			$.ajax({
				url:'<?php echo base_url('page/ajax/update_cart_item.php') ?>',
			   type:'post',
			   data:{item_id:item_id,qty:newqty},
			   dataType:'json',
			   success: function(j){
			   		console.log(j);
			   		$('.subtotal').html(j.total);
			   		$('.nocart').html(j.quantity);
			   		$('.forda').html(j.fora);
		   			$('.fordb').html(j.forb);
		   			$('.fordc').html(j.forc);
		   			$('.disca').html(j.pricea);
		   			$('.discb').html(j.priceb);
		   			$('.discc').html(j.pricec);
		   			$('#total').html(j.supertotal);
			   		$('#itemcode').focus();

			   },error: function(xhr, status, error) {
                          alert(xhr.responseText);
               }

			});
		});


		$('.auto_generate').click(function(){
			$.ajax({
				url:"<?php echo base_url('page/ajax/auto_generate.php');?>",
				type:"post",
				dataType:"json",
				success:function(j){
					if(j.status == 1){
			   			$('.orders').append(j.appendthis);
			   			$('.subtotal').html(j.total);
			   			$('.nocart').html(j.quantity);
			   			$('#itemcode').val('');
			   			$('#itemcode').focus();
		   			}
				},error: function(xhr, status, error) {
                          alert(xhr.responseText);
               }

			});

		});
	});
	


</script>
<?php
include($default->template('footer_view'));
?>