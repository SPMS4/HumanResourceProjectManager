	<?php
         require_once 'dbconfig.php';

         $db = new PDO("mysql:host=$host;dbname=$dbname",
		               $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $id=132;
        echo "$id";

        $sql = 'CALL StudentsinGroup0(:exGroupID)';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':exGroupID', $id, PDO::PARAM_INT);     
        $stmt->execute();
       // $stmt->closeCursor();

        $arrVal = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo "<select class='js-example-basic-multiple' multiple='multiple' size='2' name='ary[]'' value=''>User Name</option>";

        foreach ($arrVal as $key => $val) {
            $UserID = $val['UserID'];
            $uName = $val['uName'];
            echo "<br/>$UserID $uName<br/>";

            echo "<option value=$UserID>$uName</option>"; 
        //  $UserIdSelected = $UserID;

    //echo "<br/>userId slected = $UserIdSelected";
  
          }
          echo "</select>";// Closing of list box
        


          ?>