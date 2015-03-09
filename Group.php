
<?php
        require_once 'dbconfig.php';
        //DB Connection
        $db = new PDO("mysql:host=$host;dbname=$dbname",
                            $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        session_start();
        $Id=$_SESSION["Id"];
        $GroupId=$_SESSION["groupId"];

        $ar = array('Event 1', '2015-02-19', '2015-02-28' );
       json_encode($ar);

        echo "$Id and group is $GroupId<br/>";
        try {
        // execute the stored procedure
        $sql = 'CALL SelectTask(:exGroupID)';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':exGroupID', $GroupId, PDO::PARAM_INT);     
        $stmt->execute();
        //$stmt->closeCursor();
        $arrVal = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // foreach ($arrVal as $key => $val) {
        //    $taskId = $val['TaskEventID'];
        //    $taskBackLog = $val['Backlog'];
        //    $taskEndDate = $val['EndDate'];
        //    $taskStartDate = $val['StartDate'];
        //    $taskTitle = $val['Title'];

            //json_encode($taskTitle);
            //json_encode($taskEndDate);
            //json_encode($taskStartDate);
        //}//end foreach for task
        //json_encode($arrVal);
        //json_encode($taskTitle);
        //json_encode($taskEndDate);
        //json_encode($taskStartDate);
        $jsData = [];
        foreach ($arrVal as $key => $val) {
        $jsData[] = [
        "taskId" => $val["TaskEventID"],
        "taskName" => $val["Title"],
        "taskStart" => $val["StartDate"],
        "taskColor" => $val["color"],
        "taskEnd" => $val["EndDate"]
        ];
        }
        //var_dump($jsData);

            //proc for event SelectEvent
        $sql = 'CALL SelectEvent(:exGroupID)';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':exGroupID', $GroupId, PDO::PARAM_INT);     
        $stmt->execute();
        //$stmt->closeCursor();
        $arrVal1 = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $jsData1 = [];
        foreach ($arrVal1 as $key => $val) {
        $jsData1[] = [
        "eventId" => $val["TaskEventID"],
        "eventName" => $val["Title"],
        "eventStart" => $val["StartDate"],
        "eventColor" => $val["color"],
        "eventEnd" => $val["EndDate"]
        ];
        }
        //foreach ($arrVal1 as $key => $val) {
        //    $eventId = $val['TaskEventID'];
        //    $eventBackLog = $val['Backlog'];
        //    $eventStartDate = $val['StartDate'];
        //    $eventTitle = $val['Title'];
        //    //echo "<br/>$taskId $taskBackLog $taskEndDate $taskStartDate $taskTitle<br/>";
       //}
       //var_dump($arrVal1);


       //project details       
         $sql = 'CALL ProjectDetailsForGroup(:exGroupID)';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':exGroupID', $GroupId, PDO::PARAM_INT);     
        $stmt->execute();
        //$stmt->closeCursor();
        $arrPrj = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($arrPrj as $key => $prj) {
            $prjId = $prj['ProjectID'];
            $prjDesc = $prj['Description'];
            $prjName = $prj['ProjectName'];
         }
           // echo "$prjId and $prjName";

     }
      catch (PDOException $pe){
        die("<br/>caught Error occurred:" . $pe->getMessage());
      } 



if (isset($_POST['acceptbut'])) {
// Start the session
//session_start();
echo "accept";
		//  try {        
         //INSERT SPROC
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
             echo "<br>START DATE : $taskEventStart</br>";
             //$dateToday = date("03-04-2015");
			 $newStartDate = date("Y-m-d", strtotime($taskEventStart));
			 $newEndDate = date("Y-m-d", strtotime($taskEventEnd));
			 echo "$newStartDate<br/>";

        
        	//$color = $color['Color']; //Get colour from users table, column color
        //$Id=$_SESSION["Id"];
        //$num = 2;
        $sqlCol = 'CALL UserColour (:exUserID, @iColor)';
        $stmt = $db->prepare($sqlCol);
        $stmt->bindParam(':exUserID', $Id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor(); 
        $resuCol = $db->query("SELECT @iColor AS col")->fetch(PDO::FETCH_ASSOC);
        if ($resuCol) {
        $color = $resuCol['col'];
        echo "color = $color <br/>";
        }  

        $sql = 'CALL InsertTaskEvent(:exTitle, :exBacklog, :exStartDate, :exEndDate, :GroupID, :exColor, @exNewId)';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':exTitle', $taskEventTitle, PDO::PARAM_STR, 50);
        $stmt->bindParam(':exBacklog', $backlogResult, PDO::PARAM_LOB );
        $stmt->bindParam(':exStartDate', $newStartDate, PDO::PARAM_LOB);
        $stmt->bindParam(':exEndDate', $newEndDate, PDO::PARAM_LOB);
        $stmt->bindParam(':GroupID', $GroupId, PDO::PARAM_INT);
        $stmt->bindParam(':exColor', $color, PDO::PARAM_STR, 6);
        $stmt->execute();
        $stmt->closeCursor();
        $resu = $db->query("SELECT @exNewId AS ID")->fetch(PDO::FETCH_ASSOC);
        if ($resu) {
        $TaskEventId = $resu['ID'];
        echo "id = $TaskEventId <br/>";
        }

         $note = $_POST['Note'];
         $url = $_POST['Link'];

        $sql = 'CALL InsertNoteUrl0(:exTitle, :exTaskEventID, :exNote, :exLink)';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':exTitle', $taskEventTitle, PDO::PARAM_STR,  50);
        $stmt->bindParam(':exTaskEventID', $TaskEventId, PDO::PARAM_INT);
        $stmt->bindParam(':exNote', $note, PDO::PARAM_STR, 100);
        $stmt->bindParam(':exLink', $url, PDO::PARAM_STR, 2083);
        $stmt->execute();
        $stmt->closeCursor();

        header('Location: http://localhost/HumanResourceProjectManager/Group.php');
            exit;

}
if (isset($_POST['acceptbut1'])) {
///update task event-----------------------------------------------------------------------------------------------------
//WE NEED TO EXECUTE THIS SRPOC TO UPDATE A TASKEVENT AFTER AN EVENT IS CLICKED AND POP UP DISPLAYS AND DATA IS CHANGED ABOUT
$upTasktitle = $_POST['upTitle'];
        $backlog = 1;

        $upTaskStart = $_POST['upStartDate'];
        $upTaskEnd = $_POST['upEndDate'];
             echo "<br>START DATE : $upTaskStart</br>";
             //$dateToday = date("03-04-2015");
			 $newStartDate = date("Y-m-d", strtotime($upTaskStart));
			 $newEndDate = date("Y-m-d", strtotime($upTaskEnd));
		$taskEventID = $_POST['upId'];
		$desc = "";
		echo "id";
			 

$sql = 'CALL UpdateTaskEvent0(:exTitle, :exBacklog, :exStartDate, :exEndDate, :GroupID, :exDesc, :exTaskEventID)';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':exTitle', $upTasktitle, PDO::PARAM_STR,  50);
        $stmt->bindParam(':exBacklog', $backlog, PDO::PARAM_LOB );
        $stmt->bindParam(':exStartDate', $newStartDate, PDO::PARAM_LOB);
        $stmt->bindParam(':exEndDate', $newEndDate, PDO::PARAM_LOB);
        $stmt->bindParam(':GroupID', $groupId, PDO::PARAM_INT);
        $stmt->bindParam(':exDesc', $desc, PDO::PARAM_INT);
        $stmt->bindParam(':exTaskEventID', $taskEventID, PDO::PARAM_INT); //get taskeventId for task/event clicked
        $stmt->execute();
        $stmt->closeCursor();

 ///update NOTE URL-----------------------------------------------------------------------------------------------------
//WE NEED TO EXECUTE THIS SRPOC TO UPDATE A NOTEURL AFTER AN EVENT IS CLICKED AND POP UP DISPLAYS AND DATA IS CHANGED ABOUT
//$sql = 'CALL InsertNoteUrl0(:exTaskEventID, :exTitle, :exNote, :exUrl)';
//        $stmt = $db->prepare($sql);
  //      $stmt->bindParam(':exTaskEventID', $TaskEventId, PDO::PARAM_STR,  50);
    //    $stmt->bindParam(':exTitle', $taskEventTitle, PDO::PARAM_STR,  50);
      //  $stmt->bindParam(':exNote', $note, PDO::PARAM_LOB );
        //$stmt->bindParam(':exUrl', $url, PDO::PARAM_LOB);
     //   $stmt->execute();
     //   $stmt->closeCursor();

        header('Location: http://localhost/HumanResourceProjectManager/Group.php');
            exit;
    }

?>
<form id="Group" action="Group.php" method="POST">

<!DOCTYPE html>
<html>
<head>

	<title></title>

<link href="css/SMPMccs.css" rel="stylesheet" type="text/css">
</head>

<body class="backgroundColorClass">
<!--<body onload="addCalanderEvent('myEvent', 2015-02-19, 2015-02-22)">-->
<?php include 'Header.html'; ?>


<div align="center" id='Project Desc' style="ParaHeadFontColor">
	<h1 style="color:#fff"><?php echo "$prjName";?></h1>
	<p style="color:#fff"> <?php echo "$prjDesc";?></p>

</div>

<div id='bodyCal' class="divColorClassCAL">
<div id='wrap'>

		<div id='external-events'>
			<h4>Backlog Events</h4>
			<div class='fc-event'>My Event 1</div>
			<div class='fc-event'>My Event 2</div>
			<div class='fc-event'>My Event 3</div>
			<div class='fc-event'>My Event 4</div>
			<div class='fc-event'>My Event 5</div>
			<p>
				<input hidden type='checkbox' checked id='drop-remove' />
				<label hidden for='drop-remove'>remove after drop</label>
			</p>

		</div>
		<div id='Students' style="color:#000;">

			<h4>students</h4>
				<!--<select name="Students" size="4" style="width: 110px; overflow:hidden;" >-->
			<?php
         require_once 'dbconfig.php';

        // $db = new PDO("mysql:host=$host;dbname=$dbname",
       //            $username, $password);
       // $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        

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
		
    <button type="button" id='Addevent' name='Addevent' class="btn btn-info btn-sm" onclick="EventAdd()"> Add Event 
		<!--<button type="button" id='Addevent' onclick="addCalanderEvent()" name='Addevent' class="btn btn-info btn-sm"> Add Event -->
      <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
    </button> 
    

		<div id='calendar' style="background-color:#fff"></div>

		<div style='clear:both'></div>
		
		<div class="popup" style="color:#000;background-color:#fff">
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
		<aside><input type="text" id="Startdatepicker" name="Startdate"  placeholder="dd/mm/yyyy"></aside>
		<br/>
		<br/>
		<section> End Date: </section>
		<aside><input  type="text" id="Enddatepicker" name="Enddate"  placeholder="dd/mm/yyyy"></aside>	
		<br/>
		<br/>
		<!--<label id="lbstarttime" for="startTimepicker" > Start Time:</label>
		<aside><input  type="text" id="startTimepicker" name="startTimepicker" style="visability:hidden;" placeholder="am/pm"></aside>	
		<br/>
		<br/>
		<label id="lbendtime" for="endTimepicker" > End Time:</label>
		<aside><input  type="text" id="endTimepicker" name="endTimepicker" style="visability:hidden;" placeholder="am/pm"></aside>
-->
			<input type="submit" id="acceptbut" class="btn btn-info" name="acceptbut"  style="" onclick="addCalanderTask()"   value="Accept0" />



		<button><input type="submit" id="cancelbut" class="btn btn-info" name="cancelbut" onclick = "pophide()"style="" value="cancel" /></button>	
		<section id="notecont"> Notes :
		<aside><TEXTAREA id="Note" name="Note" class="form-control"  type="text" rows="3" cols="3" maxlenght="50" wrap="hard" placeholder="Enter text here..........."></TEXTAREA><br></aside></section>
	
		<section id="linkcont"> Relevent Link :
		<aside><input id="Link" name="Link" type="url" class="form-control" placeholder="www.Website.com"></input></aside></section>
       
        
		</form>
		</div>
    
    <div class="popupupdate" style="color:#000">
    <form id="popform" action="Group.php" method="POST">
    <h3 id="eventPop">You clicked then event</h3>
    <!--onchange="eventoption(this.value)" class="js-example-basic-single" -->
    <input type="text" id="upId" name="upId" hidden />

    <section> Event Title: </section>
    <aside><input type="text" id="upTitle" placeholder="Project Title" name="upTitle"></aside>
    <br />
    <br />
    <section> Start Date: </section>
    <aside><input type="text" id="upStartDate" placeholder="dd/mm/yyyy" name="upStartDate"></aside>
    <br/>
    <br/>
    <section id="endname"> End Date: </section>
    <aside><input type="text" id="upEndDate" style="visability:hidden;" name="upEndDate" placeholder="dd/mm/yyyy"></aside> 
    <br/>
    <br/>

    <section id="notecont"> Notes :
    <aside><TEXTAREA id="Note"  type="text" rows="10" maxlenght="1000" name="upNote" wrap="hard" placeholder="Enter text here..........."></TEXTAREA></aside></section>
    
    <section id="linkcont"> Relevent Link :
    <aside><input  id="Link" type="url" placeholder="www.Website.com" name="upLink"></input></aside></section>
			<input type="submit" id="acceptbut" class="btn btn-info" name="acceptbut1"  style="" onclick="addCalanderTask()"   value="Accept" />
    <!--<button type="button" id="acceptbut" onclick = "pophideupdate()" style="">Accept</button>-->
    <button type="button" id="cancelbut" onclick = "pophideupdate()" style="">Cancel</button>

    </form>
    </div>

    <div class="popupdrop" style="color:#000;background-color:#fff">
    <h3>You droped the event</h3>
    <form id="popform">
    <!--onchange="eventoption(this.value)" class="js-example-basic-single" -->
    <input type="checkbox" id="oneday">Is this a Task</input>
    <br />
    <br />
    <section> Event Title: </section>
    <aside><input type="text" id="Title" placeholder="Project Title" ></aside>
    <br />
    <br />
    <section> Start Date: </section>
    <aside><input type="text" id="Startdatepicker" placeholder="dd/mm/yyyy"></aside>
    <br/>
    <br/>
    <section id="endname"> End Date: </section>
    <aside><input type="text" id="Enddatepicker" style="visability:hidden;" placeholder="dd/mm/yyyy"></aside> 
    <br/>
    <br/>

    <section id="notecont"> Notes :
    <aside><TEXTAREA id="Note"  type="text" rows="10" maxlenght="1000" wrap="hard" placeholder="Enter text here..........."></TEXTAREA></aside></section>
    
    <section id="linkcont"> Relevent Link :
    <aside><input  id="Link" type="url" placeholder="www.Website.com"></input></aside></section>
    
    <button type="button" id="acceptbut" onclick="pophidedrop()" style="">Accept</button>
    <button type="button" id="cancelbut" onclick="pophidedrop()" style="">Cancel</button>
    </form>
    </div>

	</div>

</div>




</body>
<meta charset='utf-8' />
<link href="Calender/fullcalendar.css" rel="stylesheet" />
<link href="Calender/fullcalendar.print.css" rel="stylesheet" media="print" />
<link rel="stylesheet" type="text/css" href="js.select2-3.5.2/select2.css"></link>
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" />
<link href="Css/CalCss.css" rel="stylesheet" />
<link href="Css/datepicker.css" rel="stylesheet" />
<link href="bootstrap/css/bootstrap.css" rel="stylesheet" />
<link href="Css/jquery.timepicker.css" rel="stylesheet" />
<script src="lib/moment.min.js"></script>
<script src="lib/jquery.min.js"></script>
<script src='lib/jquery-ui.custom.min.js'></script>
<script src='less/datepicker.less'></script>
<script src='lib/bootstrap-datepicker.js'></script>
<script src="Calender/fullcalendar.min.js"></script>
<script src="bootstrap/js/bootstrap.js"></script>
<script src='Calender/CalCustom.js'></script>
<script src="Calender/jquery.timepicker.js"></script>

<!--<link href="Calender/jquery-ui-Datepicker/jquery-ui.css" rel="stylesheet">-->
<!--<script rel="stylesheet" src="Css/CalCass.Css"></script>-->
<!--<script src="Calender/jquery-ui-Datepicker/external/jquery/jquery.js"></script>
<script src="Calender/jquery-ui-Datepicker/jquery-ui.js"></script>-->
<!--<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>-->
  <script type="text/javascript">
   
  </script>
<script type="text/javascript">
var jsonTest = <?php echo json_encode($ar[0]) ?>;


window.onload = function addCalanderTask( id, title, start, end, color)
{
  var data = <?php echo json_encode($jsData) ?>;

  //you now have to iterate through the data array and do something with the values
  for (var i = 0; i < data.length; i++) {
     alert("the event name is " +data[i].taskName +" start " + data[i].taskId + " end " + data[i].eventEnd);
     var id = data[i].taskId;
     var taskName = data[i].taskName;
     var taskStart = data[i].taskStart;
     var taskEnd = data[i].taskEnd;
     var taskColor = data[i].taskColor;

     var taskObject = {
    title: taskName,
    start: taskStart,
    end: taskEnd,
    id: id,
    color: taskColor
    };

    $('#calendar').fullCalendar('renderEvent', taskObject, true);
  } 

var data = <?php echo json_encode($jsData1) ?>;

  //you now have to iterate through the data array and do something with the values
  for (var i = 0; i < data.length; i++) {
     var eventId = data[i].eventId;
     var eventName = data[i].eventName;
     var eventStart = data[i].eventStart;
     var eventColor = data[i].eventColor;

     var eventObject = {
    title: eventName,
    start: eventStart,
    id: eventId,
    color: eventColor
    };

    $('#calendar').fullCalendar('renderEvent', eventObject, true);
  }   
}
</script>
</html>
</form>