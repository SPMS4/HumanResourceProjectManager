<?php

    require_once 'dbconfig.php';
        //DB Connection
        $db = new PDO("mysql:host=$host;dbname=$dbname",
                            $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        /// Update TASKEVENT--------------------------
          $taskEventID = 63;
          $taskEventTitle ="updated";
          $groupId = 5;
          echo "$taskEventTitle and $groupId";
        $sql = 'CALL UpdateTaskEvent0(:exTitle, :exBacklog, :exStartDate, :exEndDate, :GroupID, :exDesc, :exTaskEventID)';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':exTitle', $taskEventTitle, PDO::PARAM_STR,  50);
        $stmt->bindParam(':exBacklog', $backlog, PDO::PARAM_LOB );
        $stmt->bindParam(':exStartDate', $taskEventStart, PDO::PARAM_LOB);
        $stmt->bindParam(':exEndDate', $taskEventEnd, PDO::PARAM_LOB);
        $stmt->bindParam(':GroupID', $groupId, PDO::PARAM_INT);
        $stmt->bindParam(':exDesc', $taskEventDescription, PDO::PARAM_STR, 1000);
        $stmt->bindParam(':exTaskEventID', $taskEventID, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();

?>