
<?php 
session_start();
$myName = $_SESSION["myname"];
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); // dont use $default variable
$teacher_no = $_GET['ID3'];
//variable and functions here
$teachers =   $model->select_where('tteacher',array('CountryID' => 'PH'));
$teacherfile = $model->select_where('tclasssched',array('TeacherID1' => $teacher_no));

include($default->template('header_view'));

?>



<div id="content" class="span10">
      <!-- content starts -->
      
      <div>
        <ul class="breadcrumb">
          <li>
            <a href="#">Home</a> <span class="divider">/</span>
          </li>
          <li>
            <a href="#">Calendar</a>
          </li>
        </ul>
      </div>

      <div class="row-fluid sortable">
        <div class="box span12">
          <div class="box-header well" data-original-title>
            <h2><i class="icon-calendar"></i>Class Schedule</h2>
            <div class="box-icon">
              <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
              <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
              <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
            </div>
          </div>
          <div class="box-content">
           <br />
            
            <div class="external-event badge badge-success" style="float:left; padding:5px;">Foundation - Kindy (FY)</div>
            <div class="external-event badge badge-warning" style="float:left; padding:5px;">Foundation - Kinder (FK)</div>
            <div class="external-event badge badge-important" style="float:left; padding:5px;">Foundation - Primary (FP)</div>
            <div class="external-event badge badge-info" style="float:left; padding:5px;">Grading - Advance (GA)</div>
            <div class="external-event badge badge-inverse" style="float:left; padding:5px;">Grading - Intermediate (GI)</div>
            <div class="external-event badge" style="float:left; padding:5px; margin-bottom:10px;">Dan(DA)</div> 
            <div class="clearfix"></div>
            <div id="calendar"></div>

            <div class="clearfix"></div>
          </div>
        </div>
      </div><!--/row-->
    
          <!-- content ends -->
      </div><!--/#content.span10-->

      <div class="modal hide fade" id="modal-details">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h3 id="yourheader">Details</h3>
      </div>
      <div class="modal-body">
       
      </div>
      <div class="modal-footer">
        <a href="#" class="btn" data-dismiss="modal">Close</a>
      </div>
    </div>




<script>
function openModal(title,datetime,code) {
  $.ajax({
        url: '<?php echo base_url() ?>page/ajax/schedule_ajax.php',
        type:'post',
        data: {title: title, datetime:datetime,code:code},
        dataType:'json',
        success:function(j){
          console.log(j);
          var descriptionss = "<table><tr><td>Teacher:</td><td><strong>"+j.teacher+"</strong> &nbsp;</td> <td>Class:</td><td><strong>"+j.level+"</strong> &nbsp;</td></tr><tr><td>Room:</td><td><strong>"+j.room+"</strong>&nbsp;</td> <td>Date:</td><td><strong>"+j.datetime+"</strong> &nbsp;</td></tr></table>  <br /><strong>Student</strong>  <ul>"+j.student+"</ul>";
          $('.modal-body').html(descriptionss);
          $('#yourheader').html('Detail (' + j.timess +')');

          $("#modal-details").modal('show'); 
        }
  }); 
}

var currentView;



//initialize the external events for calender




$('#external-events div.external-event').each(function() {
  var eventObject = {
    title: $.trim($(this).text()) // use the element's text as the event title
  };
  
  // store the Event Object in the DOM element so we can get to it later
  $(this).data('eventObject', eventObject);
  
  // make the event draggable using jQuery UI
  $(this).draggable({
    zIndex: 999,
    revert: true,      // will cause the event to go back to its
    revertDuration: 0  //  original position after the drag
  });
  
});




  //initialize the calendar
  $('#calendar').fullCalendar({
    header: {
      left: 'prev,next',
      center: 'title',
      right: 'month,agendaWeek,agendaDay'
    },
    events: [
          
          <?php
          foreach ($teacherfile as $tsched): 
          $day_label = $tsched['Day'];         
          $date_day = date('Y-m-d',strtotime('this '.$day_label));
          
          //select level info
          $selectlevel = $model->select_where('tlevel',array('ID' =>$tsched['LevelID']  ));
          $level_code = $selectlevel->fields['LevelCode'];
          $level_desc = $selectlevel->fields['Description'];           
        

          for($x=0; $x <= 4; $x++){
            $y = $x * 7 ;
            $date_day2  =  date('Y-m-d', strtotime( $date_day.' +'.$y.' day')); 
            $sched_count= $model->count_where('eattdtl',array('SchedCode' => $tsched['SchedCode'], 'Date' => $date_day2));
            $class_sched = $model->select_where('tclasssched', array('SchedCode' => $tsched['SchedCode']));
            $room   = $model->select_where('troom', array('ID' => $class_sched->fields['RoomID']));
            
            if($sched_count != 0 ){
              $sched_details = $model->select_where('eattdtl',array('SchedCode' => $tsched['SchedCode'], 'Date' => $date_day2));
              foreach($sched_details as $students):
                 $customer = $model->select_where('tcustomer', array('CustNo' => $students['CustNo']));
                 $fname    .= $customer->fields['FirstName'].", ";
                 $fullname .= $customer->fields['FirstName']." ".$customer->fields['MiddleName']." ".$customer->fields['SurName'].", "; 
              endforeach; 
                 $fname = rtrim($fname,", ");  
                 $fullname = rtrim($fullname,", ");  

            }else{
              $fname = ""; 
              $fullname = "";
            }
          ?>
           {
                  title: '<?php echo $level_code; ?>(<?php echo $tsched['TimeFrom']; ?> -  <?php echo $tsched['TimeTo']; ?>) Student(<?php echo $sched_count; ?>) ',
                  allDay:false,
                  start: '<?php echo $date_day2; ?> <?php echo $tsched['TimeFrom']; ?>',
                  end: '<?php echo $date_day2; ?> <?php echo $tsched['TimeTo']; ?>' ,
                  description: '<strong><?php echo $teachers->fields['Name'] ?></strong><br /> <?php echo $room->fields['Description']; ?> <br /> Enrolled: <?php echo $sched_count; ?><br /> <?php echo $fname; ?>',
                  description2:'<strong><?php echo $teachers->fields['Name'] ?></strong><br /> <?php echo $room->fields['Description']; ?> <br /> Enrolled: <?php echo $sched_count; ?><br /> <?php echo $fullname; ?>',
                  className:'<?php echo str_replace(" ","",$level_desc); ?>',
                  datetime:'<?php echo $date_day2; ?>',
                  schedcode:'<?php echo $tsched['SchedCode']?>' 
                  <?php $fname =""; $fullname=""; ?>
              },  

          <?php } endforeach; ?>
          ], 



          eventRender: function (event, element,view) {
            element.attr('href', 'javascript:void(0);');
            element.attr('onclick', 'openModal("' + event.title + '","' + event.datetime + '","' + event.schedcode +'");');
            
            if ( view.name == 'agendaWeek' )   
              { 
                  element.find( ".fc-event-title" ).html('');
                  element.find( ".fc-event-title" ).html(event.description);
                 
                
                  console.log();
              }
             if (view.name == 'agendaDay' ) 
              { 
                  element.find( ".fc-event-title" ).html('');
                  element.find( ".fc-event-title" ).html(event.description2);
                  console.log("day");
              }
              //You can use it some where else to know what view is active quickly
              currentView = view.name;
    


        },     
    editable: true,
    droppable: true, // this allows things to be dropped onto the calendar !!!
    drop: function(date, allDay) { // this function is called when something is dropped
    
      // retrieve the dropped element's stored Event Object
      var originalEventObject = $(this).data('eventObject');
      
      // we need to copy it, so that multiple events don't have a reference to the same object
      var copiedEventObject = $.extend({}, originalEventObject);
      
      // assign it the date that was reported
      copiedEventObject.start = date;
      copiedEventObject.allDay = allDay;
      
      // render the event on the calendar
      // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
      $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
      
      // is the "remove after drop" checkbox checked?
      if ($('#drop-remove').is(':checked')) {
        // if so, remove the element from the "Draggable Events" list
        $(this).remove();
      }
      
    }
  });

 






</script>       
     

     <?php include($default->template('footer_view'));?>