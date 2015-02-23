<?php

require_once('Smarty-3.1.21/libs.class.php');

$smarty = new smarty();
$smarty->template_dir = 'views';
$smarty->complie_dir = 'tmp';

//-----------------------------
if (isset($_POST['submit'])) {

		//connect to database host
		$db = mysqli_connect("localhost", "root", "")
			or die (mysql_error());
			//connect to database
			mysqli_select_db($db, "prjdatabase");
//-----------------------------

	$uName = ($_POST['LIUsernameTXT']);
	$pass = ($_POST['LIPasswordTXT']);
	//secure pass
	$pass = md5($pass);

	//select
	$querySelect = "SELECT uName, pass
			  		FROM users 
			 	 	WHERE uName='$uName'
			 	 	and pass='$pass'";

	$Select_name = $db->query($querySelect);

	if ($Select_name->num_rows > 0) {
		echo "logged in Success!!!!!!";
	}
	else{
		echo "log in failed";
	}



}

?>

<form action="login.php" method="post">

	<link href="css/bootstrap.css" rel="stylesheet" type="text/css" />

	<div>
	<div  align="center" class="jumbotron">
		<h3 align="center"><i><b>Enter login details</b></i></h3>
		<p align="center"><b>User Name</b>:<br>
		  <input placeholder="UserName" id="LIUsernametbx" name="LIUsernameTXT" type="text">
	  </p>
		<p align="center"><b>Password</b>:<br>
		  <input placeholder="Password" id="LIPasswordtbx" name="LIPasswordTXT" type="text">
	  </p>
		<input type="submit" name="submit" value="register" />
	  
	  </p>
	  <button type="submit" style="btn btn-primay"/>	  
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
</div>
