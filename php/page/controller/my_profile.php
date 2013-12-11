<?php 
session_start();
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); // dont use $default variable

$roleid = array(6);
$cfranchisor = array(5); 

$reminder = $model->select_where('ereminder',array('TeacherID' => $_SESSION['UserID']));
$reminder_count = $model->count_where('ereminder',array('TeacherID' => $_SESSION['UserID']));

$tteacher = $model->select_where('tteacher', array('ID' => $_SESSION['UserID'] ));

include($default->template('header_view'));
include($default->main_view('my_profile_view'));
?>

<script>
  
$(document).ready(function() { 
$('#change_info').validate();
  
  $('#save_info').click(function(){
        if($('#change_info').valid()){
           $.ajax({
              url:"<?php echo base_url('page/ajax/update_user.php'); ?>",
              type:"post",
              data: $('#change_info').serialize(),
              dataType:"json",
              success:function(j){
                console.log(j);
                noty({text: 'You Successfully Update Your Info', type: 'success'});
              }
           });
        }
  });
    
});

</script>


<?php include($default->template('footer_view'));?>