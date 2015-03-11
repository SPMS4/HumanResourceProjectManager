<?php
echo "string";


require_once 'dbconfig.php';
        //DB Connection
        $db = new PDO("mysql:host=$host;dbname=$dbname",
                            $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$num = 2;
        $sqlCol = 'CALL UserColour (:exUserID, @iColor)';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':exUserID', $num, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor(); 
        $resuCol = $db->query("SELECT @iColor AS col")->fetch(PDO::FETCH_ASSOC);
        if ($resuCol) {
        $color = $resuCol['col'];
        echo "color = $color <br/>";
        }  
?>