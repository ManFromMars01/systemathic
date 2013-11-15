$('.datepicker').datepicker({ dateFormat: 'yy-mm-dd' }).val();

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
	            url: 'UpdatetStudentaddx.php',
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



		//Update ScheduleClass

		$('#saveme').click(function(){
			$.ajax({
	            url: 'Updatetclassschededitx.php',
	            type: 'post',
	            data: $('#form2').serialize(),
	            dataType: 'json',
	            success: function (j) {
	               console.log(j);
	               //$('#success').html('Successfully Updated');
	               $('.modal-body').html(j.statusme);
	               $("#myModal").modal('show');
	               
	            }     
        	});
		});

		// Adding Country
		$('#saveme').click(function(){
			$.ajax({
	            url: 'Updatetcountryaddx.php',
	            type: 'post',
	            data: $('#form3').serialize(),
	            dataType: 'json',
	            success: function (j) {
	               console.log(j);
	               //$('#success').html('Successfully Updated');
	               $('.modal-body').html(j.statusme);
	               $("#myModal").modal('show');
	               
	            }     
        	});
		});
		// Adding Country
		$('#savemec').click(function(){
			$.ajax({
	            url: 'Updatetcountryeditx.php',
	            type: 'post',
	            data: $('#form4').serialize(),
	            dataType: 'json',
	            success: function (j) {
	               console.log(j);
	               //$('#success').html('Successfully Updated');
	               $('.modal-body').html(j.statusme);
	               $("#myModal").modal('show');
	               
	            }     
        	});
		});

		//Adding Department
		$('#save_add_dept').click(function(){
			$.ajax({
	            url: 'Updatetdepartmentaddx.php',
	            type: 'post',
	            data: $('#form6').serialize(),
	            dataType: 'json',
	            success: function (j) {
	               console.log(j);
	               //$('#success').html('Successfully Updated');
	               $('.modal-body').html(j.statusme);
	               $("#myModal").modal('show');
	               
	            }     
        	});
		});

		$('#save_upd_dept').click(function(){
			$.ajax({
	            url: 'Updatetdepartmenteditx.php',
	            type: 'post',
	            data: $('#form7').serialize(),
	            dataType: 'json',
	            success: function (j) {
	               console.log(j);
	               //$('#success').html('Successfully Updated');
	               $('.modal-body').html(j.statusme);
	               $("#myModal").modal('show');
	               
	            }     
        	});
		});



		//Adding Category
		$('#save_add_cat').click(function(){
			$.ajax({
	            url: 'Updatetcategoryaddx.php',
	            type: 'post',
	            data: $('#form8').serialize(),
	            dataType: 'json',
	            success: function (j) {
	               console.log(j);
	               //$('#success').html('Successfully Updated');
	               $('.modal-body').html(j.statusme);
	               $("#myModal").modal('show');
	               
	            }     
        	});
		});

		$('#save_upd_cat').click(function(){
			$.ajax({
	            url: 'Updatetcategoryeditx.php',
	            type: 'post',
	            data: $('#form9').serialize(),
	            dataType: 'json',
	            success: function (j) {
	               console.log(j);
	               //$('#success').html('Successfully Updated');
	               $('.modal-body').html(j.statusme);
	               $("#myModal").modal('show');
	               
	            }     
        	});
		});

		
		//Add Unit
		$('#save_add_unit').click(function(){
			$.ajax({
	            url: 'Updatetunitmeasaddx.php',
	            type: 'post',
	            data: $('#form10').serialize(),
	            dataType: 'json',
	            success: function (j) {
	               console.log(j);
	               //$('#success').html('Successfully Updated');
	               $('.modal-body').html(j.statusme);
	               $("#myModal").modal('show');
	               
	            }     
        	});
		});

		$('#save_upd_unit').click(function(){
			$.ajax({
	            url: 'Updatetunitmeaseditx.php',
	            type: 'post',
	            data: $('#form11').serialize(),
	            dataType: 'json',
	            success: function (j) {
	               console.log(j);
	               //$('#success').html('Successfully Updated');
	               $('.modal-body').html(j.statusme);
	               $("#myModal").modal('show');
	               
	            }     
        	});
		});


		//Add Manufacturer
		$('#save_add_manufacturer').click(function(){
			$.ajax({
	            url: 'Updatetmanufactureraddx.php',
	            type: 'post',
	            data: $('#form12').serialize(),
	            dataType: 'json',
	            success: function (j) {
	               console.log(j);
	               //$('#success').html('Successfully Updated');
	               $('.modal-body').html(j.statusme);
	               $("#myModal").modal('show');
	               
	            }     
        	});
		});

		$('#save_upd_manufacturer').click(function(){
			$.ajax({
	            url: 'Updatetmanufacturereditx.php',
	            type: 'post',
	            data: $('#form13').serialize(),
	            dataType: 'json',
	            success: function (j) {
	               console.log(j);
	               //$('#success').html('Successfully Updated');
	               $('.modal-body').html(j.statusme);
	               $("#myModal").modal('show');
	               
	            }     
        	});
		});

		//add Location
		$('#save_add_location').click(function(){
			$.ajax({
	            url: 'Updatetlocationaddx.php',
	            type: 'post',
	            data: $('#form14').serialize(),
	            dataType: 'json',
	            success: function (j) {
	               console.log(j);
	               //$('#success').html('Successfully Updated');
	               $('.modal-body').html(j.statusme);
	               $("#myModal").modal('show');
	               
	            }     
        	});
		});

		$('#save_upd_location').click(function(){
			$.ajax({
	            url: 'Updatetlocationeditx.php',
	            type: 'post',
	            data: $('#form15').serialize(),
	            dataType: 'json',
	            success: function (j) {
	               console.log(j);
	               //$('#success').html('Successfully Updated');
	               $('.modal-body').html(j.statusme);
	               $("#myModal").modal('show');
	               
	            }     
        	});
		});


		//Add Branch

		$('#save_add_branch').click(function(){
			$.ajax({
	            url: 'Updatetbranchaddx.php',
	            type: 'post',
	            data: $('#form16').serialize(),
	            dataType: 'json',
	            success: function (j) {
	               console.log(j);
	               //$('#success').html('Successfully Updated');
	               $('.modal-body').html(j.statusme);
	               $("#myModal").modal('show');
	               
	            }     
        	});
		});

		$('#save_upd_branch').click(function(){
			$.ajax({
	            url: 'Updatetbrancheditx.php',
	            type: 'post',
	            data: $('#form17').serialize(),
	            dataType: 'json',
	            success: function (j) {
	               console.log(j);
	               //$('#success').html('Successfully Updated');
	               $('.modal-body').html(j.statusme);
	               $("#myModal").modal('show');
	               
	            }     
        	});
		});

		

		//add Assesment
		$('#save_add_assessment').click(function(){
			$.ajax({
	            url: 'Updatetassessmentaddx.php',
	            type: 'post',
	            data: $('#form18').serialize(),
	            dataType: 'json',
	            success: function (j) {
	               console.log(j);
	               //$('#success').html('Successfully Updated');
	               $('.modal-body').html(j.statusme);
	               $("#myModal").modal('show');
	               
	            }     
        	});
		});

		$('#save_upd_assessment').click(function(){
			$.ajax({
	            url: 'Updatetassessmenteditx.php',
	            type: 'post',
	            data: $('#form19').serialize(),
	            dataType: 'json',
	            success: function (j) {
	               console.log(j);
	               //$('#success').html('Successfully Updated');
	               $('.modal-body').html(j.statusme);
	               $("#myModal").modal('show');
	               
	            }     
        	});
		});


		//Add level
		$('#save_add_level').click(function(){
			$.ajax({
	            url: 'Updatetleveladdx.php',
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

		$('#save_upd_level').click(function(){
			$.ajax({
	            url: 'Updatetleveleditx.php',
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


		// createsched
		$('#createsched').click(function(){
			$.ajax({
	            url: 'Updateeattheadaddx.php',
	            type: 'post',
	            data: $('#form23').serialize(),
	            dataType: 'json',
	            success: function (j) {
	               console.log(j);
	               //$('#success').html('Successfully Updated');
	               $('.modal-body').html(j.statusme);
	               $("#myModal").modal('show');
	               
	            }     
        	});
		});

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


		//Module Number
		$('.modnum').keyup(function(){
			modnum = $(this).val();
			sesnum = modnum * 10 ;
			$('.sesnum').val(sesnum);	
		});	
		
		//Endmodulenumber

		$('.datepicker').datepicker({ dateFormat: 'yy-mm-dd' }).val();
		$("#mydate").datepicker(
		{
			dateFormat: 'yy-mm-dd',
		    onSelect: function()
		    { 
		        var dateObject = $(this).datepicker('getDate');
		        //alert(dateObject); 
		        var d = dateObject ;
		        var n = d.getDay();
		        var weekday=new Array(7);
				weekday[0]="Sunday";
				weekday[1]="Monday";
				weekday[2]="Tuesday";
				weekday[3]="Wednesday";
				weekday[4]="Thursday";
				weekday[5]="Friday";
				weekday[6]="Saturday";

				var day = weekday[n];
				$('#txteattheadDay1').val(day);
				brachid  = $('#txteattheadBranchID').val();
				level_id = $('#txteattheadLevelID').val();
			

					$.ajax({
		            url: 'template/schedule_variables.php',
		            type: 'post',
		            data: {day_name:day, level_id: level_id},
		            dataType: 'json',
		            success: function (j) {
		               console.log(j);
		               options = j.option;
		               //alert(options);
		               $(".select_sched").html(options);
		               
		               //$('#success').html('Successfully Updated');
		               //$('.modal-body').html(j.timefrom);
		               //$("#myModal").modal('show');
	               
	            	}     
        		});

		    }
		});

		$("#perday").keyup(function(){
			$(".showday").hide();
			var nodays  = $(this).val();
			    nodays  = Number(nodays) + 1;   
			    //alert(nodays);
			for(var i=1 ; i < nodays ; i++){

				$('.showday'+i).show();		
			}
		});

		
		

		//Show day loops

		$("#daysched").keyup(function(){
			var nodays  = $(this).val();
			    nodays  = Number(nodays) + 1;   
			    //alert(nodays);
			for(var i=1 ; i < nodays ; i++){
				$('.showday'+i).show();	
			}
		});


		$('.select_sched').change(function(){
			sched_code =  $(this).val();
			sched_attr =  $(this).attr( "alt" );

			//alert(sched_attr);
			$.ajax({
				url: 'template/schedule_variables.php',
				type: 'post',
				data: { sched_code:sched_code },
				dataType:'json',
				success:function(q){
					console.log(q);	
					$('.' + sched_attr +' .txteattheadHrFr1').val(q.timefrom);
					$('.' + sched_attr +' .txteattheadHrTo1').val(q.timeto);
					$('.' + sched_attr +' .txteattheadRm1').val(q.roomid);
					$('.' + sched_attr +' .txteattheadTeaID1').val(q.teacherid1);
					$('.' + sched_attr +' .tcname').val(q.teacher1);
					$('.' + sched_attr +' .txteattheadRmname').val(q.room_name);

				} 	
			 })
		})


		$('.select_sched2').change(function(){
			sched_code =  $(this).val();
			sched_attr =  $(this).attr( "alt" );

			//alert(sched_attr);
			$.ajax({
				url: 'template/schedule_variables.php',
				type: 'post',
				data: { sched_code:sched_code },
				dataType:'json',
				success:function(q){
					console.log(q);	
					$('.' + sched_attr +' .txteattheadHrFr1').val(q.timefrom);
					$('.' + sched_attr +' .txteattheadHrTo1').val(q.timeto);
					$('.' + sched_attr +' .txteattheadRm1').val(q.roomid);
					$('.' + sched_attr +' .txteattheadTeaID1').val(q.teacherid1);
					$('.' + sched_attr +' .tcname').val(q.teacher1);
					$('.' + sched_attr +' .txteattheadRmname').val(q.room_name);
				} 	
			 })
		})

		$('.select_sched3').change(function(){
			sched_code =  $(this).val();
			sched_attr =  $(this).attr( "alt" );

			//alert(sched_attr);
			$.ajax({
				url: 'template/schedule_variables.php',
				type: 'post',
				data: { sched_code:sched_code },
				dataType:'json',
				success:function(q){
					console.log(q);	
					$('.' + sched_attr +' .txteattheadHrFr1').val(q.timefrom);
					$('.' + sched_attr +' .txteattheadHrTo1').val(q.timeto);
					$('.' + sched_attr +' .txteattheadRm1').val(q.roomid);
					$('.' + sched_attr +' .txteattheadTeaID1').val(q.teacherid1);
					$('.' + sched_attr +' .tcname').val(q.teacher1);
					$('.' + sched_attr +' .txteattheadRmname').val(q.room_name);
				} 	
			 })
		})

		$('.select_sched4').change(function(){
			sched_code =  $(this).val();
			sched_attr =  $(this).attr( "alt" );

			//alert(sched_attr);
			$.ajax({
				url: 'template/schedule_variables.php',
				type: 'post',
				data: { sched_code:sched_code },
				dataType:'json',
				success:function(q){
					console.log(q);	
					$('.' + sched_attr +' .txteattheadHrFr1').val(q.timefrom);
					$('.' + sched_attr +' .txteattheadHrTo1').val(q.timeto);
					$('.' + sched_attr +' .txteattheadRm1').val(q.roomid);
					$('.' + sched_attr +' .txteattheadTeaID1').val(q.teacherid1);
					$('.' + sched_attr +' .tcname').val(q.teacher1);
					$('.' + sched_attr +' .txteattheadRmname').val(q.room_name);
				} 	
			 })
		})

		$('.select_sched5').change(function(){
			sched_code =  $(this).val();
			sched_attr =  $(this).attr( "alt" );

			//alert(sched_attr);
			$.ajax({
				url: 'template/schedule_variables.php',
				type: 'post',
				data: { sched_code:sched_code },
				dataType:'json',
				success:function(q){
					console.log(q);	
					$('.' + sched_attr +' .txteattheadHrFr1').val(q.timefrom);
					$('.' + sched_attr +' .txteattheadHrTo1').val(q.timeto);
					$('.' + sched_attr +' .txteattheadRm1').val(q.roomid);
					$('.' + sched_attr +' .txteattheadTeaID1').val(q.teacherid1);
					$('.' + sched_attr +' .tcname').val(q.teacher1);
					$('.' + sched_attr +' .txteattheadRmname').val(q.room_name);
				} 	
			 })
		})

		$('.select_sched6').change(function(){
			sched_code =  $(this).val();
			sched_attr =  $(this).attr( "alt" );

			//alert(sched_attr);
			$.ajax({
				url: 'template/schedule_variables.php',
				type: 'post',
				data: { sched_code:sched_code },
				dataType:'json',
				success:function(q){
					console.log(q);	
					$('.' + sched_attr +' .txteattheadHrFr1').val(q.timefrom);
					$('.' + sched_attr +' .txteattheadHrTo1').val(q.timeto);
					$('.' + sched_attr +' .txteattheadRm1').val(q.roomid);
					$('.' + sched_attr +' .txteattheadTeaID1').val(q.teacherid1);
					$('.' + sched_attr +' .tcname').val(q.teacher1);
					$('.' + sched_attr +' .txteattheadRmname').val(q.room_name);

				} 	
			 })
		})

		$('.select_sched7').change(function(){
			sched_code =  $(this).val();
			sched_attr =  $(this).attr( "alt" );

			//alert(sched_attr);
			$.ajax({
				url: 'template/schedule_variables.php',
				type: 'post',
				data: { sched_code:sched_code },
				dataType:'json',
				success:function(q){
					console.log(q);	
					$('.' + sched_attr +' .txteattheadHrFr1').val(q.timefrom);
					$('.' + sched_attr +' .txteattheadHrTo1').val(q.timeto);
					$('.' + sched_attr +' .txteattheadRm1').val(q.roomid);
					$('.' + sched_attr +' .txteattheadTeaID1').val(q.teacherid1);
					$('.' + sched_attr +' .tcname').val(q.teacher1);
					$('.' + sched_attr +' .txteattheadRmname').val(q.room_name);
				} 	
			 })
		})


		//
		$('.day_day2').change(function(){
			var day = $(this).val();
			brachid  = $('#txteattheadBranchID').val();
			level_id = $('#txteattheadLevelID').val();
			$.ajax({
			  		url:'template/schedule_variables.php',
			  		type:"post",
			  		data:{ day_name2:day, level_id: level_id }, 
			  		dataType:'json',
			  		success:function(q){
			  			console.log(q);
			  			addoption = "<option value='none'>Please Select Available Time</option>";
			  			$('.select_sched2').html(addoption + q.option);

			  		}
			  	});

		
		});

		$('.day_day3').change(function(){
			var day = $(this).val();
			brachid  = $('#txteattheadBranchID').val();
			level_id = $('#txteattheadLevelID').val();
			$.ajax({
			  		url:'template/schedule_variables.php',
			  		type:"post",
			  		data:{ day_name2:day, level_id: level_id }, 
			  		dataType:'json',
			  		success:function(q){
			  			console.log(q);
			  			addoption = "<option value='none'>Please Select Available Time</option>";
			  			$('.select_sched3').html(addoption + q.option);

			  		}
			  	});
		});


		$('.day_day4').change(function(){
			var day = $(this).val();
			brachid  = $('#txteattheadBranchID').val();
			level_id = $('#txteattheadLevelID').val();
			$.ajax({
			  		url:'template/schedule_variables.php',
			  		type:"post",
			  		data:{ day_name2:day, level_id: level_id }, 
			  		dataType:'json',
			  		success:function(q){
			  			console.log(q);
			  			addoption = "<option value='none'>Please Select Available Time</option>";
			  			$('.select_sched4').html(addoption + q.option);

			  		}
			  	});
		});


		$('.day_day5').change(function(){
			var day = $(this).val();
			brachid  = $('#txteattheadBranchID').val();
			level_id = $('#txteattheadLevelID').val();
			$.ajax({
			  		url:'template/schedule_variables.php',
			  		type:"post",
			  		data:{ day_name2:day, level_id: level_id }, 
			  		dataType:'json',
			  		success:function(q){
			  			console.log(q);
			  			addoption = "<option value='none'>Please Select Available Time</option>";
			  			$('.select_sched5').html(addoption + q.option);

			  		}
			  	});
		});

		$('.day_day6').change(function(){
			var day = $(this).val();
			brachid  = $('#txteattheadBranchID').val();
			level_id = $('#txteattheadLevelID').val();
			$.ajax({
			  		url:'template/schedule_variables.php',
			  		type:"post",
			  		data:{ day_name2:day, level_id: level_id }, 
			  		dataType:'json',
			  		success:function(q){
			  			console.log(q);
			  			addoption = "<option value='none'>Please Select Available Time</option>";
			  			$('.select_sched6').html(addoption + q.option);

			  		}
			  	});
		});

		$('.day_day7').change(function(){
			var day = $(this).val();
			brachid  = $('#txteattheadBranchID').val();
			level_id = $('#txteattheadLevelID').val();
			$.ajax({
			  		url:'template/schedule_variables.php',
			  		type:"post",
			  		data:{ day_name2:day, level_id: level_id }, 
			  		dataType:'json',
			  		success:function(q){
			  			console.log(q);
			  			addoption = "<option value='none'>Please Select Available Time</option>";
			  			$('.select_sched7').html(addoption+ q.option);

			  		}
			  	});
		});


		//Show session loops
		$("#session_number").keyup(function(){
			$('.sch2').hide();
			var noses  = $(this).val();
			    nosession  = Number(noses) + 1;   
			    //alert(nodays);
			for(var i=1 ; i < nosession ; i++){
				$('.sch'+i).show();	
			}
		});

		$("#session_number2").keyup(function(){
			$('.sch_2_2').hide();
			var noses  = $(this).val();
			    nosession  = Number(noses) + 1;   
			    //alert(nodays);
			for(var i=1 ; i < nosession ; i++){
				$('.sch_2_'+i).show();	
			}
		});

		$("#session_number3").keyup(function(){
			$('.sch_3_2').hide();
			var noses  = $(this).val();
			    nosession  = Number(noses) + 1;   
			    //alert(nodays);
			for(var i=1 ; i < nosession ; i++){
				$('.sch_3_'+i).show();	
			}
		});

		$("#session_number4").keyup(function(){
			$('.sch_4_2').hide();
			var noses  = $(this).val();
			    nosession  = Number(noses) + 1;   
			    //alert(nodays);
			for(var i=1 ; i < nosession ; i++){
				$('.sch_4_'+i).show();	
			}
		});

		$("#session_number5").keyup(function(){
			$('.sch_5_2').hide();
			var noses  = $(this).val();
			    nosession  = Number(noses) + 1;   
			    //alert(nodays);
			for(var i=1 ; i < nosession ; i++){
				$('.sch_5_'+i).show();	
			}
		});

		$("#session_number6").keyup(function(){
			$('.sch_6_2').hide();
			var noses  = $(this).val();
			    nosession  = Number(noses) + 1;   
			    //alert(nodays);
			for(var i=1 ; i < nosession ; i++){
				$('.sch_6_'+i).show();	
			}
		});


		$("#session_number7").keyup(function(){
			$('.sch_7_2').hide();
			var noses  = $(this).val();
			    nosession  = Number(noses) + 1;   
			    //alert(nodays);
			for(var i=1 ; i < nosession ; i++){
				$('.sch_7_'+i).show();	
			}
		});


		$('#createschedme').click(function(){
			$('.validateme3').validate();
			if($('.validateme3').valid()){
			$.ajax({
	            url: 'template/schedule_variables2.php',
	            type: 'post',
	            data: $('#form25').serialize(),
	            dataType: 'json',
	            success: function (j) {
	               console.log(j);
	               //$('#success').html('Successfully Updated');
	               $('.modal-body').html(j.statusme);
	               $("#myModal").modal('show');
	               
	            }     
        	});

			} else {

				//alert("Sorry...Something went Wrong.");

			} 

			
		});


		