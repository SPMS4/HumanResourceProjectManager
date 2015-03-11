<?php
        require_once 'dbconfig.php';
        //DB Connection
        $db = new PDO("mysql:host=$host;dbname=$dbname",
                            $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $groupId=2;
        // ID will come from session!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
     	try {
 
        // execute the stored procedure
        $sql = 'CALL SelectTask(:exGroupID)';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':exGroupID', $groupId, PDO::PARAM_INT);     
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

        }
            //proc for event SelectEvent
        $sql = 'CALL SelectEvent(:exGroupID)';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':exGroupID', $groupId, PDO::PARAM_INT);     
        $stmt->execute();
        //$stmt->closeCursor();
        $arrVal = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($arrVal as $key => $val) {
            $taskId = $val['TaskEventID'];
            $taskBackLog = $val['Backlog'];
            $taskStartDate = $val['StartDate'];
            $taskTitle = $val['Title'];
            echo "<br/>$taskId $taskBackLog $taskEndDate $taskStartDate $taskTitle<br/>";

        }
       }
      catch (PDOException $pe){
        die("<br/>caught Error occurred:" . $pe->getMessage());
      } 
        ?>