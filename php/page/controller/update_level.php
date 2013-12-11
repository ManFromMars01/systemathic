<?php 
session_start();
$myName = $_SESSION["myname"];
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); // dont use $default variable

$level = $model->select_where('tlevel',array('ID' => $_GET['level_id']));



include($default->template('header_view'));
include($default->main_view('update_level_view'));?>
<script>
$('#save_upd_level').click(function(){
			$.ajax({
	            url: '<?php echo base_url()?>Updatetleveleditx.php',
	            type: 'post',
	            data: $('#form22').serialize(),
	            dataType: 'json',
	            success: function (j) {
	               console.log(j);
	               //$('#success').html('Successfully Updated');
	               $('.modal-body').html(j.statusme);
	               $("#myModal").modal('show');
	               
	            }     
        	});
		});

</script>



<?php include($default->template('footer_view'));?>