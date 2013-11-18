
<?php 
session_start();
$myName = $_SESSION["myname"];
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); // dont use $default variable

//$teacher_no = $_GET['ID3'];
$room_no = $_GET['ID3'];

//variable and functions here
$teachers =   $model->select_where('tteacher',array('CountryID' => 'PH'));


$roomfile = $model->select_where('tclasssched',array('RoomID' => $room_no));


include($default->template('header_view'));
//include($default->main_view('teacher_schedule_view'));

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
            <h2><i class="icon-calendar"></i>Room Schedule</h2>
            <div class="box-icon">
              <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
              <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
              <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
            </div>
          </div>
          <div class="box-content">
          <div id="external-events" class="well">
            <h4>Legend (Levels)</h4>
            <div class="external-event badge badge-success">Foundation - Kindy (FY)</div>
            <div class="external-event badge badge-warning">Foundation - Kinder (FK)</div>
            <div class="external-event badge badge-important">Foundation - Primary (FP)</div>
            <div class="external-event badge badge-info">Grading - Advance (GA)</div>
            <div class="external-event badge badge-inverse">Grading - Intermediate (GI)</div>
            <div class="external-event badge">Dan(DA)</div>
            <p>
            <label for="drop-remove"><input type="checkbox" id="drop-remove" /> remove after drop</label>
            </p>
          </div>

            <div id="calendar"></div>

            <div class="clearfix"></div>
          </div>
        </div>
      </div><!--/row-->
    
          <!-- content ends -->
      </div><!--/#content.span10-->
<script>
//initialize the external events for calender

  $('#external-events div.external-event').each(function() {

    // it doesn't need to have a start or end
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
      left: 'prev,next today',
      center: 'title',
      right: 'month,agendaWeek,agendaDay'
    },
    events: [
          /*

          <?php
          foreach ($selectsched as $selectclasses): 
          $day_label = $selectclasses['Day']; 
          $date_day = date('Y-m-d',strtotime('this '.$day_label));
          $selectlevel = "SELECT *  FROM tlevel  WHERE  tlevel.ID='".$selectclasses['LevelID']."'";
          $selectlevel = $objConn1->Execute($selectlevel);
          
          //Level Description
          foreach ($selectlevel as $selectlevels) {
            $level_code = $selectlevels['LevelCode'];
            $level_desc = $selectlevels['Description'];           
          }         
          //Level Description End 




          for($x=0; $x <= 51; $x++){
            $y = $x * 7 ;
            $date_day2  =  date('Y-m-d', strtotime( $date_day.' +'.$y.' day')); 
            //echo $x; 
          ?>
           {
                  title: ' <?php echo $level_code; ?>(<?php echo $selectclasses['TimeFrom']; ?> -  <?php echo $selectclasses['TimeTo']; ?>)  ',
                  allDay:false,
                  start: '<?php echo $date_day2; ?> <?php echo $selectclasses['TimeFrom']; ?>',
                  end: '<?php echo $date_day2; ?> <?php echo $selectclasses['TimeTo']; ?>' ,
                  description: '<?php echo $selectclasses['TimeFrom']; ?> - <?php echo $selectclasses['TimeTo']; ?>',
                  className:'<?php echo str_replace(" ","",$level_desc); ?>'
              },  

          <?php 
          }
  
          endforeach; 
          ?>  
          */

          <?php
          foreach ($roomfile as $rsched): 
          $day_label = $rsched['Day']; 
          $date_day = date('Y-m-d',strtotime('this '.$day_label));
          $selectlevel = $model->select_where('tlevel',array('ID' =>$rsched['LevelID']  ));
          
          
          //Level Description
          foreach ($selectlevel as $selectlevels) {
            $level_code = $selectlevels['LevelCode'];
            $level_desc = $selectlevels['Description'];           
          }         
          //Level Description End 




          for($x=0; $x <= 51; $x++){
            $y = $x * 7 ;
            $date_day2  =  date('Y-m-d', strtotime( $date_day.' +'.$y.' day')); 
            //echo $x; 
          ?>
           {
                  title: ' <?php echo $level_code; ?>(<?php echo $rsched['TimeFrom']; ?> -  <?php echo $rsched['TimeTo']; ?>)  ',
                  allDay:false,
                  start: '<?php echo $date_day2; ?> <?php echo $rsched['TimeFrom']; ?>',
                  end: '<?php echo $date_day2; ?> <?php echo $rsched['TimeTo']; ?>' ,
                  description: '<?php echo $rsched['TimeFrom']; ?> - <?php echo $rsched['TimeTo']; ?>',
                  className:'<?php echo str_replace(" ","",$level_desc); ?>'
              },  

          <?php 
          }
  
          endforeach; 
          ?>  






          
          ],      
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