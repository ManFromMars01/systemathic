<?php 
session_start();
$myName = $_SESSION["myname"];
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); // dont use $default variable



include($default->template('header_view'));
include($default->main_view('add_level_view'));?>
<script>
//Add level
$('#save_add_level').click(function(){
	$.ajax({
        url: '<?php echo base_url();?>Updatetleveladdx.php',
        type: 'post',
        data: $('#form21').serialize(),
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