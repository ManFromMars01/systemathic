<?php 
session_set_cookie_params(500);
session_start();
$PageLevel = 0;
$PageLevel = 1;
include_once('systemathicappdata.php');
include_once('ConnInfo.php');

$objConn1 = &ADONewConnection($Driver1);
$objConn1->debug = $DebugMode;
$objConn1->PConnect($Server1,$User1,$Password1,$db1);



include_once('utils.php');
include('login.php');
if (isset($_GET['custno'])){
       
$selectsched = "SELECT *  FROM eattdtl  WHERE  eattdtl.CustNo='".$_GET['custno']."'";
$selectsched = $objConn1->Execute($selectsched);

$id = $selectsched->fields['CustNo'];

$student= "SELECT *  FROM tcustomer  WHERE  tcustomer.CustNo='".$_GET['custno']."'";
$student = $objConn1->Execute($student);


$CountryID = $student->fields['CountryID'];
$BranchID = $student->fields['BranchID'];
$lname = $student->fields['SurName'];
$fname = $student->fields['FirstName'];
$mname = $student->fields['MiddleName'];

$cust = $student->fields['CustNo'];



}





?>






<?php include('template/header.php') ?>	



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


					<li> &nbsp &nbsp -- <?php echo $lname .",". $fname ." " . $mname ; ?>
					</li>

				</ul>


			</div>



			<div class="row-fluid sortable">
				<div class="box span12">
				  <div class="box-header well" data-original-title>
					  <h2><i class="icon-calendar"></i>Calendar</h2>
					  <div class="box-icon">
						  <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
						  <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						  <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
				  </div>
				  <div class="box-content">
					<div id="external-events" class="well">
						<h4>Draggable Events</h4>
						<div class="external-event badge">Default</div>
						<div class="external-event badge badge-success">Completed</div>
						<div class="external-event badge badge-warning">Warning</div>
						<div class="external-event badge badge-important">Important</div>
						<div class="external-event badge badge-info">Info</div>
						<div class="external-event badge badge-inverse">Other</div>
						<p>
						<label for="drop-remove"><input type="checkbox" id="drop-remove" /> remove after drop</label>
						</p>
						 
						  <a class="btn btn-info" href="Updateeattheadadd.php?ID=<?php echo $id ?>"><i class="icon-edit icon-white"></i> Edit Schedule</a>
						  <!--<a class="btn btn-info" href="BrowseCreateSchedulelist1.php?ID1='<?php echo $students['CountryID'] ?>'&amp;ID2='<?php echo $students['BranchID'] ?>'&amp;ID3=<?php echo $students['CustNo'] ?>"><i class="icon-edit icon-white"></i> Edit Schedule</a>
					  	  -->
												
					</div>



						<div id="calendar"></div>

						<div class="clearfix"></div>
					</div>
				</div>--->
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
					<?php foreach ($selectsched as $selectclasses): ?>
			        {
			            title: 'Session Number <?php echo $selectclasses['SessionNo']; ?> (<?php echo $selectclasses['TimeFrom']; ?> - <?php echo $selectclasses['TimeTo']; ?>) ',
			            allDay:false,
			            start: '<?php echo $selectclasses['Date']; ?> <?php echo $selectclasses['TimeFrom']; ?>',
			            end: '<?php echo $selectclasses['Date']; ?> <?php echo $selectclasses['TimeTo']; ?>' ,
			            description: '<?php echo $selectclasses['TimeFrom']; ?> - <?php echo $selectclasses['TimeTo']; ?>',
			            className: 'Foundation-Kindy'
			        },
			        <?php endforeach; ?>
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
<?php include('template/footer.php') ?>
	