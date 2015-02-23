<?php

session_start();
  $Id=$_SESSION["Id"];
  echo "$Id";
    require_once 'dbconfig.php';

if (isset($_POST['submit'])) 
{ 
  try {
        //DB Connection
        $db = new PDO("mysql:host=$host;dbname=$dbname",
                            $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        InsertTaskEvent
        /// INSERT TASKEVENT--------------------------
          $taskEventTitle = $_POST['ProjectName'];
          $taskEventStart = $_POST['startDate'];
          $taskEventEnd = $_POST['projectDescription'];
          $backlog = $_POST['projectDescription'];
          $taskEventDescription = $_POST['endDate'];
        
     
        $sql = 'CALL InsertTaskEvent(:GroupID, :exTitle, :exBacklog, :exStartDate, :exEndDate, :exDesc)';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':GroupID', $Id, PDO::PARAM_INT);
        $stmt->bindParam(':exTitle', $taskEventTitle, PDO::PARAM_STR,  50);
        $stmt->bindParam(':exStartDate', $startDate, PDO::PARAM_DATETIME);
        $stmt->bindParam(':exEndDate', $projectDesc, PDO::PARAM_DATETIME);
        $stmt->bindParam(':exBacklog', $backlog, PDO::PARAM_LOB );
        $stmt->bindParam(':exDesc', $taskEventDescription, PDO::PARAM_STR, 2000);

        $stmt->execute();
        $stmt->closeCursor();


        /// Update TASKEVENT--------------------------
          $taskEventTitle = $_POST['ProjectName'];
          $startDate = $_POST['startDate'];
          $taskEventDescription = $_POST['endDate'];
          $eventTime = $_POST['projectDescription'];
          $location = $_POST['projectDescription'];
      
     
        $sql = 'CALL InsertTaskEvent(:GroupID, :exTitle, :exBacklog, :exStartDate, :exEndDate, :exDesc)';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':GroupID', $Id, PDO::PARAM_INT);
        $stmt->bindParam(':exTitle', $taskEventTitle, PDO::PARAM_STR,  50);
        $stmt->bindParam(':exStartDate', $startDate, PDO::PARAM_DATETIME);
        $stmt->bindParam(':exEndDate', $projectDesc, PDO::PARAM_DATETIME);
        $stmt->bindParam(':exBacklog', $backlog, PDO::PARAM_LOB );
        $stmt->bindParam(':exDesc', $taskEventDescription, PDO::PARAM_STR, 2000);
        $stmt->execute();
        $stmt->closeCursor();



        /// Update TASKEVENT--------------------------
        $taskEventId = $_POST['ProjectName'];
        
        $sql = 'CALL InsertTaskEvent(:GroupID)';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':GroupID', $Id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();














        /// INSERT EVENT--------------------------
          $eventName = $_POST['ProjectName'];
          $eventDate = $_POST['startDate'];
          $noteDescription = $_POST['endDate'];
          $eventTime = $_POST['projectDescription'];
          $location = $_POST['projectDescription'];
      
     
        $sql = 'CALL InsertEvent(:userId, :exEventName, :exEventDate, :exNoteDescription, :exEventTime, :exLocation)';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':userId', $Id, PDO::PARAM_INT);
        $stmt->bindParam(':exEventName', $projectStart, PDO::PARAM_LOB );
        $stmt->bindParam(':exEventDate', $projectEnd, PDO::PARAM_LOB );
        $stmt->bindParam(':exNoteDescription', $projectDesc, PDO::PARAM_STR, 2000);
        $stmt->bindParam(':exEventTime', $projectDesc, PDO::PARAM_DATETIME);
        $stmt->bindParam(':exLocation', $projectDesc, PDO::PARAM_STR, 25);
        $stmt->execute();
        $stmt->closeCursor();

        //INSERT PROJECT---------------------------
        $proName = $_POST['ProjectName'];
		$proStart = $_POST['startDate'];
	    $proEnd = $_POST['endDate'];
	    $proDesc = $_POST['projectDescription'];
      
     
        $sql = 'CALL InsertEvent(:proName, :proStart, :proEnd, :proDesc)';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':proName', $proName, PDO::PARAM_STR, 50);
        $stmt->bindParam(':proStart', $proStart, PDO::PARAM_LOB );
        $stmt->bindParam(':proEnd', $proEnd, PDO::PARAM_LOB );
        $stmt->bindParam(':proDesc', $proDesc, PDO::PARAM_STR, 2000);
        $stmt->execute();
        $stmt->closeCursor();


        //INSERT LINK---------------------------
        $LinkName = $_POST['ProjectName'];
        $Link = $_POST['startDate'];
        $LinkDate = $_POST['endDate'];
      
     
        $sql = 'CALL InsertEvent(:exLinkName, :exLinkText, :exLinkDate)';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':exLinkName', $LinkName, PDO::PARAM_STR, 50);
        $stmt->bindParam(':exLinkText', $Link, PDO::PARAM_STR, 2083 );
        $stmt->bindParam(':exLinkDate', $linkDate, PDO::PARAM_LOB );
        $stmt->execute();
        $stmt->closeCursor();

        //INSERT NOTE---------------------------
        $NoteName = $_POST['ProjectName'];
        $NoteDate = $_POST['startDate'];
        $NoteDescription = $_POST['endDate'];
      
     
        $sql = 'CALL InsertEvent(:exNoteName, :exNoteDate, :exNoteDescription)';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':exNoteName', $NoteName, PDO::PARAM_STR, 50);
        $stmt->bindParam(':exNoteDate', $linkDate, PDO::PARAM_LOB );
        $stmt->bindParam(':exNoteDescription', $NoteDescription, PDO::PARAM_STR, 2000 );
        $stmt->execute();
        $stmt->closeCursor();


?>