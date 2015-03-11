<?php
require_once 'dbconfig.php';
	$db = new PDO("mysql:host=$host;dbname=$dbname",
                            $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	if (isset($_POST['submit'])) 
{
        

		//verification of passwords
		//PasswordTXT RePasswordTXT
		$pass1 = $_POST['PasswordTXT'];
		$pass2 = $_POST['RePasswordTXT'];

		//if passwords match
		if ($pass1 == $pass2) 
		{
			//passwords correct
			//connect to database host
			//$db = mysqli_connect("localhost", "root", "")
			//or die (mysql_error());
			//connect to database
			//mysqli_select_db($db, "prjdatabase");

			$db = new PDO("mysql:host=$host;dbname=$dbname",
                            $username, $password);
			//declare vars
			$uName = ($_POST['UsernameTXT']);
			$pass = ($pass1);
			$fName = ($_POST['FirstnameTXT']);
			$lName = ($_POST['SecondnameTXT']);
			$email = ($_POST['EmailTXT']);

			$status = "students";

			//secure pass
			$pass = md5($pass);

			//check username
			$sql = 'CALL CountUserNames(:exUserName, @Names)';
        	$stmt = $db->prepare($sql);
        	$stmt->bindParam(':exUserName', $uName, PDO::PARAM_STR, 50);
        	$stmt->execute();
        	$stmt->closeCursor();
        	$resu = $db->query("SELECT @Names AS names")->fetch(PDO::FETCH_ASSOC);

			if ($resu) {
        	$nme = $resu['names'];
        }
        //start IF
        if ($nme == 0) {
			//insert 
			//$queryInsert ="
			//INSERT INTO users  (uName, pass, UserCurrentStatus , fName, sName, Email) 
			//VALUES('".$uName."', '".$pass."', '".$status."', '".$fName."','".$lName."', '".$email."')
			//";
			//uName pass1 pass2
			//insert query
			//$insert_table = $db->query($queryInsert);

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

			//get UserID, username is unique
			$sql = "SELECT UserID
        			FROM users 
        			WHERE uName='$uName'";
        			foreach ($db->query($sql) as $data) {
        				$Id = $data['UserID'];}

        	echo "<br/>id is $Id.<br/>";
			// Start the session
			session_start();
			$_SESSION["Id"] = "$Id";

			header('Location: http://localhost/HumanResourceProjectManager/profile.php');
            exit;
			}
			
	
			else{
				echo "Name taken";
			}
		}
}
		



?>

<?php include 'Header.html'; ?>
<body class="backgroundColorClass ParaHeadFontColor">
<form action="regStudent.php" method="post">
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
  <script src="js/jquery-1.11.1.js"></script>
   <script src="bootstrap/js/bootstrap.min.js"></script>
  <script src="js/select2-3.5.2/select2.js"></script>
  <link rel="stylesheet" href="js/select2-3.5.2/select2.css">
  <link href="css/SMPMccs.css" rel="stylesheet" type="text/css" />
<title>SPMS</title>

<!--<div>
<div align="center" class="regpageDivAlign regpageDivAlignHegiht" >
	<h3 align="center"><b>Choose Login details</b></h3>
    <div class="input-group">
	<p align="center"><b>UserName</b>:<br>
	  <input placeholder="Username" id="Usernametbx" name="UsernameTXT" type="text" class="form-control">
  </p>
	<p align="center"><b>Password</b>:<br>
	  <input placeholder="Password" id="Passwordtbx" name="PasswordTXT" type="text" class="form-control">
  </p>
	<p align="center"><b>Re enter Password</b>:<br>
	  <input placeholder="Password" id="RePasswordtbx" name="RePasswordTXT" type="text" class="form-control">
	  <br>
  </p>
</div>
</div>
</div>

<div align="center"  class="regpageDivAlign">
	
	<h3><b>Personal Details</b></h3>
	<div class="input-group">
	  <p align="center">
	    <label><b>First Name</b>:</label>
	    <br><input placeholder="First Name" id="FirstNametbx" name="FirstnameTXT" type="text" class="form-control">
      </p>
	  <p align="center">
	    <label><b>Last Name</b>: </label>
<br>
<input placeholder="Last Name" id="Secondnametbx" name="SecondnameTXT" type="text" class="form-control">
      </p>
	  <p align="center"><b>Address 1</b>:<br>
	    <input placeholder="Address 1" id="Address1tbx" name="Address1TXT" type="text" class="form-control">
      </p>
	  <p align="center"><b>Address 2</b>:<br>
	    <input placeholder="Address 2" id="Address2tbx" name="Address2TXT" type="text" class="form-control">
      </p>
	  <p align="center"><b>City/Town</b>:<br>
	    <input placeholder="City/town" id="CityTowntbx" name="CityTownTXT" type="text" class="form-control">
      </p>
	  <p align="center"><b>County</b>:<br>
	    <select class="js-example-basic-single" id="Countyslct" name="CountySLCT">
	      <option value="Antrim">Antrim</option>
	      <option value="Armagh">Armagh</option>
	      <option value="Carlow">Carlow</option>
	      <option value="Cavan">Cavan</option>
	      <option value="Clare">Clare</option>
	      <option value="Cork">Cork</option>
	      <option value="Derry">Derry</option>
	      <option value="Donegal">Donegal</option>
	      <option value="Down">Down</option>
	      <option value="Dublin">Dublin</option>
	      <option value="Fermanagh">Fermanagh</option>
	      <option value="Galway">Galway</option>
	      <option value="Kerry" >Kerry</option>
	      <option value="Kildare" >Kildare</option>
	      <option value="Kilkenny" >Kilkenny</option>
	      <option value="Laois" >Laois</option>
	      <option value="Leitrim" >Leitrim</option>
	      <option value="Limerick" >Limerick</option>
	      <option value="Longford" >Longford</option>
	      <option value="Louth" >Louth</option>
	      <option value="Mayo" >Mayo</option>
	      <option value="Meath" >Meath</option>
	      <option value="Monaghan" >Monaghan</option>
	      <option value="Offaly" >Offaly</option>
	      <option value="Roscommon" >Roscommon</option>
	      <option value="Sligo" >Sligo</option>
	      <option value="Tipperary" >Tipperary</option>
	      <option value="Tyrone" >Tyrone</option>
	      <option value="Waterford" >Waterford</option>
	      <option value="Westmeath" >Westmeath</option>
	      <option value="Wexford" >Wexford</option>
	      <option value="Wicklow" >Wicklow</option>
        </select>
      </p>
      <p align="center"><b>country</b>:<br>
	    <select class="js-example-basic-single" id="Countryslct" name="CountrySLCT">
	      <option value="Ireland">Ireland</option>
	      <option value="Englang">England</option>
	      <option value="France">France</option>
        </select>
      </p>
	  <p align="center">
<label><b>E-Mail</b>:</label>
<br>
<input placeholder="E-Mail" id="Emailtbx" name="EmailTXT" type="text" class="form-control" >
      </p>
	  <p align="center">
        <label><b>Phone</b>: </label>
<br>
	    <input placeholder="Phone" id="Phonetbx" name="Phone1TXT" type="text" class="form-control">
      </p>
	  <p align="center"><b>Mobile</b>:<br>
	    <input placeholder="087 1234567" id="Phonetbx" name="Phone2TXT" type="text" class="form-control">
        <br />
        <br />
        <input type="submit" class="btn btn-lg btn-info" name="submit" value="register" />
      </p>
      
      </div>
      </div>
      
      
      <div align="center"  class="regpageDivAlign regpageDivAlignHegiht">
      <h3><b>College Details</b></h3>
      <p align="center"><b>College</b></p>
          <select class="js-example-basic-single" id="collegeSelect" name="CollegeSlct">
	      <option value="It Sligo">It Sligo</option>
	      <option value="UL">UL</option>
	      <option value="UCD">UCD</option>
	      <option value="DCU">DCU</option>
        </select>
        
        <br />
        <p align="center"><b>Deparment</b></p>
          <select class="js-example-basic-single" id="Deparmentslct" name="DeparmentSLCT">
	      <option value="Science">Science</option>
	      <option value="Computing">Comptuing</option>
	      <option value="Business">Bussiness</option>
	      <option value="Engineering">Enginering</option>
        </select>
        
        <br />
        <p align="center"><b>Course</b></p>
         Will need to population from db depending on deparment
          <select class="js-example-basic-single" id="Courseslct" name="CourseSLCT">
	      <option value="Science">Science</option>
	      <option value="Computing">Comptuing</option>
	      <option value="Business">Bussiness</option>
	      <option value="Engineering">Enginering</option>
        </select>
        <br/>
        <br/>
		

      </div> -->
   	<div class="container">

<div class="row">
    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
		<form role="form">
			<h2 align="center">Sign Up Here</h2>
			<hr class="colorgraph">
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
                          <input placeholder="Username" id="Usernametbx" name="UsernameTXT" type="text" class="form-control" required>
					</div>
                    <div class="form-group">
                        <input placeholder="Password" id="Passwordtbx" name="PasswordTXT" type="password" class="form-control" pattern=".{6,}" title="Password must have atleast 6 characters" required>
					</div>
                    <div class="form-group">
                        
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-6">
					
                   <input placeholder="Re-Password" id="RePasswordtbx" name="RePasswordTXT" type="password" class="form-control" required>
                   
				</div>
			</div>
			<div class="form-group">
				<input placeholder="First Name" id="FirstNametbx" name="FirstnameTXT" type="text" class="form-control"  title="please enter a vaild name" required>
			</div>
            <div class="form-group">
				<input placeholder="Last Name" id="Secondnametbx" name="SecondnameTXT" type="text" class="form-control"  title="please enter a vaild name" required>
			</div>
            <div class="form-group">
				
			</div>
            <div class="form-group">
				
			</div>
            <div class="form-group">
			
			</div>
             <div class="form-group">
				
			</div>
             <div class="form-group">
		
			<div class="form-group">
				<input placeholder="E-Mail" id="Emailtbx" name="EmailTXT" type="email" class="form-control">
			</div>
            	<div class="form-group">
			
			</div>
            	<div class="form-group">
			
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
					
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
				
					</div>
				</div>
			</div>
			<div class="row">
				<div align="center" class="col-xs-4 col-sm-3 col-md-3">
					<span class="button-checkbox">
				 <input type="submit" class="btn btn-lg btn-info" name="submit" value="register" />
					</span>
				</div>
				
			</div>
			
    
      </form>
			

<!--
<div class="jumbotron">
	<h3>Skill Selection</h3>
	<br>
	<select id="skillselect"></select>
	<br>
	<select size="7" id="skilllist"></select>
</div>
-->
    <script>
  $(document).ready(function() {
  $(".js-example-basic-single").select2();
});	</script>



