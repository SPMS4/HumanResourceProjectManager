<?php
require_once 'dbconfig.php';
        //DB Connection
        $db = new PDO("mysql:host=$host;dbname=$dbname",
                            $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$taskEventID = 7;

$sql = 'CALL DeleteTaskEvent(:exTaskEventID)';
       // $sql = 'CALL InsertTaskEvent(:GroupID, :exTitle, :exStartDate, :exEndDate, exBacklog, :exDesc)';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':exTaskEventID', $taskEventID, PDO::PARAM_STR,  50);        
        $stmt->execute();
        $stmt->closeCursor();

?>