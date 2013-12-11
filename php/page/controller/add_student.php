<?php 
session_start();
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); // dont use $default variable

//variable and functions here
$referral =   $model->select_where('treferral',array('CountryID' => $_SESSION['UserValue1']));
$level =   $model->select_table('tlevel');
$tier =   $model->select_table('ttier');

include($default->template('header_view'));
include($default->main_view('add_student_view'));
?>
<script>
//Name Keyup

$('#lname').keyup(function(){
	lastname = $(this).val();
	$('#llname').val(lastname);
});

$('#fname').keyup(function(){
	fname = $(this).val();
	$('#lfname').val(fname);
});

$('#mname').keyup(function(){
	mname = $(this).val();
	$('#lmname').val(mname);
});

$('#enableme').click(function(){
	if( $(this).text() == "Change Local Name"){
		$(".disableme").attr("readonly",false);
		$(this).text('Same as Above');
	} else{
		
		lname = $('#lname').val();
		mname = $('#mname').val();
		fname = $('#fname').val();

		$('#lfname').val(fname);
		$('#lmname').val(mname);
		$('#llname').val(lname);
		
		$(".disableme").attr("readonly",true);
		$(this).text('Change Local Name');
	}
});
//End Name Keyup		





$('#savemeus').click(function(){
	$.ajax({
	    url: 'UpdatetStudenteditx.php',
	    type: 'post',
	    data: $('#form1').serialize(),
	    dataType: 'json',
	    success: function (j) {
	       console.log(j);
	       //$('#success').html('Successfully Updated');
	       $('.modal-body').html(j.statusme);
	       $("#myModal").modal('show');
	       
	    }     
	});
	});

	$('#savemes').click(function(){
	$('.validateme').validate();
	if($('.validateme').valid()){ //checks if it's valid
	   $.ajax({
	    url: '<?php echo base_url()?>UpdatetStudentaddx.php',
	    type: 'post',
	    data: $('#form5').serialize(),
	    dataType: 'json',
	    success: function (j) {
	       console.log(j);
	       //$('#success').html('Successfully Updated');
	       $('.modal-body').html(j.statusme);
	       $("#myModal").modal('show');
	       
	    }     
		});
	   }
	   else{
	    alert("not valid");
	   }



	});
</script>


<?php
include($default->template('footer_view'));

?>