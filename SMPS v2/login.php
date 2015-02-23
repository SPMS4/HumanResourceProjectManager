<?php
        require_once 'dbconfig.php';

//-----------------------------
if (isset($_POST['submit'])) {
// Start the session
session_start();
		  try {
        //DB Connection
        $db = new PDO("mysql:host=$host;dbname=$dbname",
                            $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        echo "Connected to Database<br/>";
        
        $USERNAME = $_POST['LIUsernameTXT'];
        $PASSWORD = md5($_POST['LIPasswordTXT']);
        
        $sql = "SELECT UserID, uName, pass
        		FROM users 
        		WHERE uName='$USERNAME' and pass='$PASSWORD'";
       
        $log = $db->query($sql);


        if($log->rowCount() == 1)
        {
        	//$query = mysqli_query($db,"SELECT * 
           //                     FROM users 
           //                     where uName='$USERNAME');
        	foreach ($db->query($sql) as $data) {
          		$Id = $data['UserID'];
      		}
            $_SESSION["Id"] = "$Id";
            echo "$Id";

            header('Location: http://localhost/updatedPrj300/profile.php');
            exit;
        }
        else
            echo "wrong";

        //Close Connection
        $db = null;

    } catch(PDOException $e) {
        echo $e->getMessage();
    }



}

?>
<?php include 'Header.html'; ?>
<form action="login.php" method="post">

	<link href="css/bootstrap.css" rel="stylesheet" type="text/css" />

	<div>
	<div  align="center" class="jumbotron">
		<h3 align="center"><i><b>Enter login details</b></i></h3>
		<p align="center"><b>User Name</b>:<br>
		  <input placeholder="UserName" id="LIUsernametbx" name="LIUsernameTXT" type="text">
	  </p>
		<p align="center"><b>Password</b>:<br>
		  <input placeholder="Password" id="LIPasswordtbx" name="LIPasswordTXT" type="password">
	  </p>
		<input type="submit" name="submit" value="register" />
	  
	  </p>
	  <!--<button type="submit" style="btn btn-primay"/>	 --> 
	  <h5><i>Not registered?,click the link on top to register!</i></h5>
	</div>

</form>

</div>
<!--
<div class="jumbotron">
	<h3>Skill Selection</h3>
	<br>
	<select id="skillselect"></select>
	<br>
	<select size="7" id="skilllist"></select>
</div>
-->
<?php include 'Footer.html'; ?>
