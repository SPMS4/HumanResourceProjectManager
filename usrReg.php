<?php
require_once 'dbconfig.php';
	$db = new PDO("mysql:host=$host;dbname=$dbname",
                            $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        	$uName = "userNme";
			$pass = "abc";
			$fName = "corm";
			$lName = "hall";
			$email = "ch@ymail.com";
			$status = "students";

			$sql = 'CALL RegisterUser(:exUserName, :exPass, :exFName, :exSName, :exEmail, :exStatus)';
        	$stmt = $db->prepare($sql);
        	$stmt->bindParam(':exUserName', $uName, PDO::PARAM_STR, 50);
        	$stmt->bindParam(':exPass', $pass, PDO::PARAM_STR, 50 );
        	$stmt->bindParam(':exFName', $fName, PDO::PARAM_STR, 50 );
        	$stmt->bindParam(':exSName', $lName, PDO::PARAM_STR, 50);
        	$stmt->bindParam(':exEmail', $email, PDO::PARAM_STR, 254);
        	$stmt->bindParam(':exStatus', $status, PDO::PARAM_STR, 50);
        	$stmt->execute();
        	$stmt->closeCursor();
?>