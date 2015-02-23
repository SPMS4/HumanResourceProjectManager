



<?php
        require_once 'dbconfig.php';
        //DB Connection
        $db = new PDO("mysql:host=$host;dbname=$dbname",
                            $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        session_start();
        $Id=$_SESSION["Id"];
        $GroupId=$_SESSION["groupId"];
        
        echo "$Id and group is $GroupId";
      //  $groupId=132;
        try {
        $gId = 2;
        // execute the stored procedure
        $sql = 'CALL SelectTask(:exGroupID)';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':exGroupID', $gId, PDO::PARAM_INT);     
        $stmt->execute();
        //$stmt->closeCursor();
        $arrVal = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($arrVal as $key => $val) {
            $taskId = $val['TaskEventID'];
            $taskBackLog = $val['Backlog'];
            $taskEndDate = $val['EndDate'];
            $taskStartDate = $val['StartDate'];
            $taskTitle = $val['Title'];
            echo "<br/>$taskId $taskBackLog $taskEndDate $taskStartDate $taskTitle<br/>";

        }//end foreach for task
            //proc for event SelectEvent
        $sql = 'CALL SelectEvent(:exGroupID)';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':exGroupID', $gId, PDO::PARAM_INT);     
        $stmt->execute();
        //$stmt->closeCursor();
        $arrVal = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($arrVal as $key => $val) {
            $taskId = $val['TaskEventID'];
            $taskBackLog = $val['Backlog'];
            $taskStartDate = $val['StartDate'];
            $taskTitle = $val['Title'];
            echo "<br/>$taskId $taskBackLog $taskEndDate $taskStartDate $taskTitle<br/>";
        }//end foreach for event
       }
      catch (PDOException $pe){
        die("<br/>caught Error occurred:" . $pe->getMessage());
      } 
        // ID will come from session!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
     //	try {
 
        // execute the stored procedure
       // $sql = 'CALL SelectTask0(:exGroupID,@iTaskEventID,@iEndDate,@iStartDate,@iDescription,@iTitle,@iBacklog';
     //   $stmt = $db->prepare($sql);
      //  $stmt->bindParam(':exGroupID', $groupId, PDO::PARAM_INT);
     //   $stmt->execute();
     //   $stmt->closeCursor();
     //   $sql = 'CALL inoutexampleproc(:exUserID, @ifName, @iStatus)';
        
 
        // execute the second query to get values from OUT parameter
      //  $resu = $db->query("SELECT @ifName AS name, @iStatus AS status")->fetch(PDO::FETCH_ASSOC);
     //   $r = $db->query("SELECT @iTaskEventID as TaskEventID,@iEndDate,@iStartDate,@iDescription,@iTitle,@iBacklog")->fetch(PDO::FETCH_ASSOC);
     //   while ($r >= 0) {
      //      printf('ID: %d, start: %d, end: %d, isescription: %d,title: %d, backlog %d',
      //          $r['@TaskEventID'],
      //          $r['@iEndDate'],
      //          $r['@iStartDate'],
      //          $r['@iDescription'],
       //         $r['@iTitle'],
       //         $r['@iBacklog']);
       // }
       // while($row = mysql_fetch_array($result)){
	//echo $row['name']. " - ". $row['age'];
	//echo "<br />";

  //  } catch (PDOException $pe) {
   //     die("Error occurred:" . $pe->getMessage());
   // }
			  
		//	  foreach ($db->query($sql) as $data) {
          
        //}
       //echo "$taskId and $taskStartDate";

if (isset($_POST['acceptbut'])) {
// Start the session
session_start();
echo "accept";
		//  try {        
         //INSERT SPROC
        $groupId=2;
        //$selectevent = $_POST['selectevent'];
        $taskEventTitle = $_POST['Title'];

        $backlog = $_POST['backlog'];
        if ($backlog == null) {
        	$backlogResult = 0;
        	echo "not backlog";
        }
        else{
        	$backlogResult = 1;
        }

        $taskEventStart = $_POST['Startdate'];
        $taskEventEnd = $_POST['Enddate'];
        //$taskEventTime = $_POST['endTimepicker'];
        $taskEventDescription = $_POST['Note'];
           
        $sql = 'CALL InsertTaskEvent0(:exTitle, :exBacklog, :exStartDate, :exEndDate, :GroupID, :exDesc)';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':exTitle', $taskEventTitle, PDO::PARAM_STR,  50);
        $stmt->bindParam(':exBacklog', $backlogResult, PDO::PARAM_LOB );
        $stmt->bindParam(':exStartDate', $taskEventStart, PDO::PARAM_LOB);
        $stmt->bindParam(':exEndDate', $taskEventEnd, PDO::PARAM_LOB);
        $stmt->bindParam(':GroupID', $groupId, PDO::PARAM_INT);
        $stmt->bindParam(':exDesc', $taskEventDescription, PDO::PARAM_STR, 1000);
        $stmt->execute();
        $stmt->closeCursor();
        echo "inserted";

        
        $Note = $_POST['Note'];//
        $Link = $_POST['Link'];//

        $sql = 'CALL InsertNoteURL(:exNote, :exLink, :exGroupID)';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':exNote', $taskEventTitle, PDO::PARAM_STR,  50);
        $stmt->bindParam(':exLink', $backlogResult, PDO::PARAM_LOB );
		$stmt->bindParam(':GroupID', $groupId, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();

  //  }
  //  catch(PDOException $e) {
//echo $e->getMessage();
  //  }



}
?>



<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>

<body>


<div id='Project Desc' align="center" class="jumbotron" style="background-color:#FFF">	
	<h3>Project Title</h1>
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
		<div id='Students' style="margin-top:10px;">
			
		<!	<?php
      //   require_once 'dbconfig.php';

       //  $db = new PDO("mysql:host=$host;dbname=$dbname",
		//               $username, $password);
       //  $sql="SELECT uName, UserID FROM users WHERE UserCurrentStatus = 'students'  order by uName"; 
       //   echo "<select class='js-example-basic-multiple' multiple='multiple' size='2' name='ary[]'' value=''>User Name</option>";
       // echo "<select>";
       //   foreach ($db->query($sql) as $row){
       //   echo "<option value=$row[UserID]>$row[uName]</option>"; 
       //   $UserIdSelected = $row['UserID'];
      //}

          ?>
          <h4>students</h4>
			<!--<select name="Students" size="4" style="width: 110px; overflow:hidden;" >-->
			<?php
         require_once 'dbconfig.php';

        // $db = new PDO("mysql:host=$host;dbname=$dbname",
       //            $username, $password);
       // $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $gid=132;

        $sql = 'CALL StudentsinGroup0(:exGroupID)';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':exGroupID', $GroupId, PDO::PARAM_INT);     
        $stmt->execute();
       // $stmt->closeCursor();

        $arrVal = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "<select name='Students' size='4' style='width: 110px; overflow:hidden;'></option>";

        foreach ($arrVal as $key => $val) {
            $UserID = $val['UserID'];
            $uName = $val['uName'];
            echo "<option value=$UserID>$uName</option>"; 
          }
          echo "</select>";// Closing of list box
        


          ?>
		</div>
		
		<button type="button" id='Addevent' class="btn btn-info btn-sm" onclick="EventAdd()"> Add Event 
  		<span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
		</button> 

		<div id='calendar'></div>

		<div style='clear:both'></div>
		
		<div class="popup">
		<h3>Add to the Calander</h3>
		<form id="popform" action="Group.php" method="POST">
		<select id="selectevent" name="selectevent" onchange="eventoption(this.value)" >
  			<option value="0" selected disabled >Please Select One</option>
  			<option disabled>---------------------</option>
  			<option value="1">All Day Event</option>
  			<option value="2">Dated Event </option>
  			<option value="3">Time event</option>
		</select>
		<br />
		<br />
		<input type="checkbox" id="backlog" name="backlog">is this back log??</input>
		<br />
		<br />
		<section> Event Title: </section>
		<aside>
        <div class="form-group">
        <input type="text" class="control" id="Title" name="Title" placeholder="Project Title"  >
      </div>
        </aside>
		<br />
		<br />
		<section> Start Date: </section>
		<aside><input type="text" id="Startdatepicker" name="Startdate" readonly placeholder="dd/mm/yyyy"></aside>
		<br/>
		<br/>
		<section> End Date: </section>
		<aside><input  type="text" id="Enddatepicker" name="Enddate" readonly style="visability:hidden;" placeholder="dd/mm/yyyy"></aside>	
		<br/>
		<br/>
		<label id="lbstarttime" for="startTimepicker" > Start Time:</label>
		<aside><input  type="text" id="startTimepicker" name="startTimepicker" style="visability:hidden;" placeholder="am/pm"></aside>	
		<br/>
		<br/>
		<label id="lbendtime" for="endTimepicker" > End Time:</label>
		<aside><input  type="text" id="endTimepicker" name="endTimepicker" style="visability:hidden;" placeholder="am/pm"></aside>	
			<input type="submit" id="acceptbut" class="btn btn-info" name="acceptbut"  style="" value="Accept0" />
		<button><input type="submit" id="cancelbut" class="btn btn-info" name="cancelbut" onclick = "pophide()"style="" value="cancel" /></button>	
		<section id="notecont"> Notes :
		<aside><TEXTAREA id="Note" name="Note" class="form-control"  type="text" rows="8" maxlenght="100" wrap="hard" placeholder="Enter text here..........."></TEXTAREA><br></aside></section>
		
		<section id="linkcont"> Relevent Link :
		<aside><input id="Link" type="url" class="form-control" placeholder="www.Website.com"></input></aside></section>
         </div>
		</form>
		</div>

	</div>

</div>



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
  	


</html>