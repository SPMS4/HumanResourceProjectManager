<?php

			session_start();
			$Id=$_SESSION["Id"];

        require_once 'dbconfig.php';

			$db = new PDO("mysql:host=$host;dbname=$dbname",
                            $username, $password);


			$sql = "SELECT *
                FROM users 
                where UserID=$Id"; 

			foreach ($db->query($sql) as $data) {
          $Id = $data['UserID'];
          $name = $data['uName'];
          $fName = $data['fName'];
          $sName = $data['sName'];
          $Address=$data['Address'];
          $Address2=$data['Address2'];
          $city=$data['City'];
          $county=$data['county'];
          $Country=$data['Country'];
          $Email=$data['Email'];
          $Phone=$data['Phone'];
          $Phone2=$data['Phone2'];
          $CollegeName=$data['CollegeName'];
          $CourseName=$data['CourseName'];
        }

	if (isset($_POST['submit'])) 
{
	
			//declare vars
			$fName = ($_POST['FirstnameTXT']);
			$lName = ($_POST['SecondnameTXT']);
			$address1 = ($_POST['Address1TXT']);
			$address2 = ($_POST['Address2TXT']);
			$city = ($_POST['CityTownTXT']);
			$county = ($_POST['CountySLCT']);
			$country= ($_POST['CountrySLCT']);
			//$email = ($_POST['EmailTXT']);
			$phone = ($_POST['Phone1TXT']);
			$phone2 = ($_POST['Phone2TXT']);
			$color = ($_POST['Color']);

			$sql = 'CALL UpdateProfile(:exUserID, :exfName, :exsName, :exAddress, :exAddress2, :exCity, :exCountry, :exCounty, :exPhone, :exPhone2, exColor)';
        	$stmt = $db->prepare($sql);
        	$stmt->bindParam('UserID', $Id, PDO::PARAM_INT);
        	$stmt->bindParam('uName', $uName, PDO::PARAM_STR, 50);
        	$stmt->bindParam('fName', $fName, PDO::PARAM_STR, 50);
        	$stmt->bindParam('sName', $lName, PDO::PARAM_STR, 50);
        	$stmt->bindParam('Address', $address1, PDO::PARAM_STR, 50);
        	$stmt->bindParam('Address2', $address2, PDO::PARAM_STR, 50);
        	$stmt->bindParam('City', $city, PDO::PARAM_STR, 50);
        	$stmt->bindParam('county', $county, PDO::PARAM_STR, 50);
        	$stmt->bindParam('Country', $country, PDO::PARAM_STR, 50);
        	$stmt->bindParam('Phone', $phone, PDO::PARAM_STR, 50);
        	$stmt->bindParam('Phone2', $phone2, PDO::PARAM_STR, 50);
        	$stmt->bindParam('Color', $color, PDO::PARAM_STR, 6);
        	
        	$stmt->execute();
        	$stmt->closeCursor();

		}



	


?>

<form action="regLect.php" method="post">
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
  <script src="js/jquery-1.11.1.js"></script>
  <script src="js/select2-3.5.2/select2.js"></script>
  <link rel="stylesheet" href="js/select2-3.5.2/select2.css">
<div>
<div align="center" class="jumbotron" style="background-color:#FFF;float:left;padding:100px">
	<h3 align="center"><b>Choose Login details</b></h3>
    <div class="input-group">
	<p align="center"><b>LectuerNum</b>:<br>
	  <input placeholder="studentName" id="Usernametbx" name="UsernameTXT" type="text" class="form-control">
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

<div align="center" class="jumbotron" style="background-color:#FFF;float:left;padding:100px">
	
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
      </p>
      </div>
      </div>
      
      
      <div align="center" class="jumbotron" style="background-color:#FFF;float:left;padding:100px">
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
        
        <br/>
        <br/>
		<input type="submit" class="btn btn-lg btn-info" name="submit" value="register" />

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

<?php include 'Footer.html'; ?>
