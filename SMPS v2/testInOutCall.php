<?php

    require_once 'dbconfig.php';

//if (isset($_POST['submit'])) 
//{ 
  try {
        //DB Connection
        $db = new PDO("mysql:host=$host;dbname=$dbname",
                            $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $id = 23;
    
        echo "$id <br/>";
  
        $sql = 'CALL inoutexampleproc(:exUserID, @ifName, @iStatus)';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':exUserID', $id, PDO::PARAM_INT);     
        $stmt->execute();
        $stmt->closeCursor();
        
        $resu = $db->query("SELECT @ifName AS name, @iStatus AS status")->fetch(PDO::FETCH_ASSOC);
        if ($resu) {
        echo sprintf('user name: %s has status of %s<br/>', $resu['name'], $resu['status']);
        $nme = $resu['name'];
        echo "$nme + hi<br/>";
    

        $taskEventTitle = "TskEvnt";
        $backlogResult = 1;
        $taskEventStart = "2015-03-1";
        $taskEventEnd = "2015-03-3";
        $GroupID = "2";

        $sql = 'CALL InsertTaskEvent(:exTitle, :exBacklog, :exStartDate, :exEndDate, :GroupID, @exNewId)';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':exTitle', $taskEventTitle, PDO::PARAM_STR,  50);
        $stmt->bindParam(':exBacklog', $backlogResult, PDO::PARAM_LOB );
        $stmt->bindParam(':exStartDate', $taskEventStart, PDO::PARAM_LOB);
        $stmt->bindParam(':exEndDate', $taskEventEnd, PDO::PARAM_LOB);
        $stmt->bindParam(':GroupID', $GroupID, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
        $resu = $db->query("SELECT @exNewId AS ID")->fetch(PDO::FETCH_ASSOC);
        if ($resu) {
        $TaskEventId = $resu['ID'];
        echo "$TaskEventId <br/>";
        }

         $note = "First Note";
         $url = "";

        $sql = 'CALL InsertNoteUrl0(:exTaskEventID, :exTitle, :exNote, :exUrl)';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':exTaskEventID', $TaskEventId, PDO::PARAM_STR,  50);
        $stmt->bindParam(':exTitle', $taskEventTitle, PDO::PARAM_STR,  50);
        $stmt->bindParam(':exNote', $note, PDO::PARAM_LOB );
        $stmt->bindParam(':exUrl', $url, PDO::PARAM_LOB);
        $stmt->execute();
        $stmt->closeCursor();



      } 
      
      
      
	}catch (PDOException $pe){
        die("Error occurred:" . $pe->getMessage());
    	}
//}

?>