<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>

<body>

<?php include 'Header.html'; ?>

<div id='Project Desc'>
	<h1>Project Title</h1>
	<p> Description : Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff
	 Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff 
	 Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff 
	 Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff
	 Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff 
	 Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff 
	 Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff Stuff 
	 </p>

</div>

<div id='bodyCal'>
<div id='wrap'>

		<div id='external-events'>
			<h4>Draggable Events</h4>
			<div class='fc-event'>My Event 1</div>
			<div class='fc-event'>My Event 2</div>
			<div class='fc-event'>My Event 3</div>
			<div class='fc-event'>My Event 4</div>
			<div class='fc-event'>My Event 5</div>
			<p>
				<input type='checkbox' id='drop-remove' />
				<label for='drop-remove'>remove after drop</label>
			</p>

		</div>
		<div id='Students'>

			<h4>students</h4>
			<select name="Students" size="4" style="width: 110px; overflow:hidden;" >
  			<option id="stu1">text1<span class="glyphicon glyphicon-trash"></span></option>
  			<option id="stu2">text2</option>
  			<option id="stu3">text3</option>
  			<option id="stu4">text4</option>
		</select>
		</div>
		
		<button type="button" id='Addevent' class="btn btn-info btn-sm" onclick="EventAdd()"> Add Event 
  		<span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
		</button> 

		<div id='calendar'></div>

		<div style='clear:both'></div>
		
		<div class="popup">
		<h3>Add to the Calander</h3>
		<form id="popform">
		<select id="selectevent" name="selectevent" onchange="eventoption(this.value)" >
  			<option value="0" selected disabled >Please Select One</option>
  			<option disabled>---------------------</option>
  			<option value="1">All Day Event</option>
  			<option value="2">Dated Event </option>
  			<option value="3">Time event</option>
		</select>
		<br />
		<br />
		<input type="checkbox" id="backlog">is this back log??</input>
		<br />
		<br />
		<section> Event Title: </section>
		<aside><input type="text" id="Title" placeholder="Project Title" ></aside>
		<br />
		<br />
		<section> Start Date: </section>
		<aside><input type="text" id="Startdatepicker" readonly placeholder="dd/mm/yyyy"></aside>
		<br/>
		<br/>
		<section> End Date: </section>
		<aside><input  type="text" id="Enddatepicker" readonly style="visability:hidden;" placeholder="dd/mm/yyyy"></aside>	
		<br/>
		<br/>
		<label id="lbstarttime" for="startTimepicker" > Start Time:</label>
		<aside><input  type="text" id="startTimepicker" style="visability:hidden;" placeholder="am/pm"></aside>	
		<br/>
		<br/>
		<label id="lbendtime" for="endTimepicker" > End Time:</label>
		<aside><input  type="text" id="endTimepicker" style="visability:hidden;" placeholder="am/pm"></aside>	
		
		<button type="button" id="acceptbut" onclick = "pophide()" style="">Accept</button>
		<button type="button" id="cancelbut" onclick = "pophide()" style="">Cancel</button>
		
		
		<section id="notecont"> Notes :
		<aside><TEXTAREA id="Note"  type="text" rows="10" maxlenght="1000" wrap="hard" placeholder="Enter text here..........."></TEXTAREA></aside></section>
		
		<section id="linkcont"> Relevent Link :
		<aside><input  id="Link" type="url" placeholder="www.Website.com"></input></aside></section>

		</form>
		</div>

	</div>

</div>

<?php include 'Footer.html'; ?>

</body>
<meta charset='utf-8' />
<link href="Calender/fullcalendar.css" rel="stylesheet" />
<link href="Calender/fullcalen	dar.print.css" rel="stylesheet" media="print" />
<!--<link href="Calender/jquery-ui-Datepicker/jquery-ui.css" rel="stylesheet">-->
<!--<script rel="stylesheet" src="Css/CalCass.Css"></script>-->
<script src="lib/moment.min.js"></script>
<script src="lib/jquery.min.js"></script>
<script src='lib/jquery-ui.custom.min.js'></script>
<script src='less/datepicker.less'></script>
<script src='lib/bootstrap-datepicker.js'></script>
<script src="Calender/fullcalendar.min.js"></script>
<link href="bootstrap/css/bootstrap.css" rel="stylesheet" />
<script src="bootstrap/js/bootstrap.js"></script>
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" />
<link href="Css/CalCss.css" rel="stylesheet" />
<link href="Css/datepicker.css" rel="stylesheet" />
<script src='Calender/CalCustom.js'></script>
<link href="Css/jquery.timepicker.css" rel="stylesheet" />
<script src="Calender/jquery.timepicker.js"></script>

<!--<script src="Calender/jquery-ui-Datepicker/external/jquery/jquery.js"></script>
<script src="Calender/jquery-ui-Datepicker/jquery-ui.js"></script>-->

<!--<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>-->

<script>
$(document).ready(function() {
	
	
		/* initialize the external events
		-----------------------------------------------------------------*/
	
		$('#external-events .fc-event').each(function() {
		
			// create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
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
	
	
		/* initialize the calendar
		-----------------------------------------------------------------*/
		
		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			editable: true,
			eventLimit: true, // allow "more" link when too many events
			droppable: true, // this allows things to be dropped onto the calendar !!!
			drop: function(date) { // this function is called when something is dropped
			
				// retrieve the dropped element's stored Event Object
				var originalEventObject = $(this).data('eventObject');
				
				// we need to copy it, so that multiple events don't have a reference to the same object
				var copiedEventObject = $.extend({}, originalEventObject);
				
				// assign it the date that was reported
				copiedEventObject.start = date;
				
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
		
		
	});
	
</script>
<script>
  $(function() {
    $( "#Startdatepicker" ).datepicker({
        dateFormat: "dd-mm-yy",
        minDate: 0,
        onSelect: function (date) {
            var date2 = $('#Startdatepicker').datepicker('getDate');
            date2.setDate(date2.getDate() + 1);
            $('#Enddatepicker').datepicker('setDate', date2);
            //sets minDate to dt1 date + 1
            $('#Enddatepicker').datepicker('option', 'minDate', date2);
        }
    });
    $( "#Enddatepicker" ).datepicker({
        dateFormat: "dd-mm-yy",
        onClose: function () {
            var dt1 = $('#Startdatepicker').datepicker('getDate');
            var dt2 = $('#Enddatepicker').datepicker('getDate');
            //check to prevent a user from entering a date below date of dt1
            if (dt2 <= dt1) {
                var minDate = $('#Enddatepicker').datepicker('option', 'minDate');
                $('#Enddatepicker').datepicker('setDate', minDate);
                $('#Enddatepicker').datepicker('setDate', minDate);
            }
        }
    });
    //$('#startTimepicker').timepicker();
    //$('#endTimepicker').timepicker();
    
	});
  //$(function() {
  //  $( "#Startdatepicker" ).datepicker();
  //});
  
  /*$(function formenabler(venabe){
  	if (venabe == "1" ){
  	document.getElementById('Title').disabled=false;
  	document.getElementById('Startdatepicker').disabled=false;
  	document.getElementById('Enddatepicker').disabled=true;
  	document.getElementById('Note').disabled=false;
  	document.getElementById('Link').disabled=false;
  	}
  	else if (venabe == "2"){
  	document.getElementById('Title').disabled=false;
  	document.getElementById('Startdatepicker').disabled=false;
  	document.getElementById('Enddatepicker').disabled=false;
  	document.getElementById('Note').disabled=false;
  	document.getElementById('Link').disabled=false;
  	}
  	else (venabe == "3"){
  	document.getElementById('Title').disabled=false;
  	document.getElementById('Startdatepicker').disabled=false;
  	document.getElementById('Enddatepicker').disabled=false;
  	document.getElementById('Note').disabled=false;
  	document.getElementById('Link').disabled=false;
  	}



  		});*/
  	

  </script>

</html>