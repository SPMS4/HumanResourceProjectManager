<?php

require_once 'dbconfig.php';


  
        //DB Connection
        $db = new PDO("mysql:host=$host;dbname=$dbname",
                            $username, $password);

        $groupName = "Wow";

        $sql = 'CALL CountGroups(:exgroupname, @groups)';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':exgroupname', $groupName, PDO::PARAM_STR, 50);
        $stmt->execute();
        $stmt->closeCursor();
        echo "$groupName <br/>";
        $resu = $db->query("SELECT @groups AS name")->fetch(PDO::FETCH_ASSOC);
        if ($resu) {
        echo sprintf('group name name: %s', $resu['name']);
        $nme = $resu['name'];
    }


?>