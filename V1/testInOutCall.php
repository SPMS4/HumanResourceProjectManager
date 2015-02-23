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
        try{    
        $sql = 'CALL inoutexampleproc(:exUserID, @ifName, @iStatus)';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':exUserID', $id, PDO::PARAM_INT);     
        $stmt->execute();
        $stmt->closeCursor();
        
        $resu = $db->query("SELECT @ifName AS name, @iStatus AS status")->fetch(PDO::FETCH_ASSOC);
        if ($resu) {
        echo sprintf('user name: %s has status of %s<br/>', $resu['name'], $resu['status']);
        $nme = $resu['name'];
        echo "$nme + hi";
    }
      } 
      catch (PDOException $pe){
        die("Error occurred:" . $pe->getMessage());
      } 
      
      
	}catch (PDOException $pe){
        die("Error occurred:" . $pe->getMessage());
    	}
//}

?>