<?php

session_start();
 
    require_once 'dbconfig.php';
        //DB Connection
        $db = new PDO("mysql:host=$host;dbname=$dbname",
                            $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        /// INSERT TASKEVENT--------------------------
          $groupId=2;
          echo "$groupId";
          $taskEventTitle = "new";
          $taskEventStart = "2015-01-29";
          $taskEventEnd = "2015-01-30";
          $backlog = "1";
          $taskEventDescription = "nn ihg v igv igv";
        
     
        $sql = 'CALL InsertTaskEvent0(:exTitle, :exBacklog, :exStartDate, :exEndDate, :GroupID, :exDesc)';
       // $sql = 'CALL InsertTaskEvent(:GroupID, :exTitle, :exStartDate, :exEndDate, exBacklog, :exDesc)';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':exTitle', $taskEventTitle, PDO::PARAM_STR,  50);
        $stmt->bindParam(':exBacklog', $backlog, PDO::PARAM_LOB );
        $stmt->bindParam(':exStartDate', $taskEventStart, PDO::PARAM_LOB);
        $stmt->bindParam(':exEndDate', $taskEventEnd, PDO::PARAM_LOB);
        $stmt->bindParam(':GroupID', $groupId, PDO::PARAM_INT);
        $stmt->bindParam(':exDesc', $taskEventDescription, PDO::PARAM_STR, 1000);
        $stmt->execute();
        $stmt->closeCursor();
        echo "inserted";


?>