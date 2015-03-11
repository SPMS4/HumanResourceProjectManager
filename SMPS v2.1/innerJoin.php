
<form action="innerJoin.php" method="post">
<head>

<script>
    $(function(){
      // turn the element to select2 select style
      $('#select2').select2();
    $(".js-example-basic-multiple").select2();
    });
  </script>

  <style>
  .select2-container-multi {
    width: 200px
}
  </style>

  </head>
  <body>
<?php

require_once 'dbconfig.php';

          $db = new PDO("mysql:host=$host;dbname=$dbname",
                            $username, $password);

//$sql="SELECT UserID FROM usergroup 
//where GroupID = '132'"; 
          $groupId = 132;
$sql="SELECT usergroup.UserID as UserID, users.uName as uName
			from usergroup 
			inner join users 
			on usergroup.UserID = users.UserID
			where GroupID = $groupId" ;

          echo "<select class='js-example-basic-multiple' multiple='multiple' size='2' name='ary[]'' value=''>User Name</option>";
          echo "<select>";
          foreach ($db->query($sql) as $row){
          echo "<option value=$row[UserID]>$row[UserID]</option>"; 
          $UserIdSelected = $row['UserID'];
          if (isset($_POST['submit'])) 
		  {
		    echo "<br/>userId slected = $UserIdSelected";
		  }
          }
          echo "</select>";// Closing of list box
 
      
?>
<input type="submit" class="btn btn-info" name="submit" value="create group" />
</body>
</form>