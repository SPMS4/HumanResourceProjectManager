<?php

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
			$db = mysqli_connect("localhost", "root", "")
			or die (mysql_error());
			//connect to database
			mysqli_select_db($db, "prjdatabase");

			//declare vars
			$uName = ($_POST['UsernameTXT']);
			$pass = ($pass1);
			$fName = ($_POST['FirstnameTXT']);
			$lName = ($_POST['SecondnameTXT']);
			$address1 = ($_POST['Address1TXT']);
			$address2 = ($_POST['Address2TXT']);
			$city = ($_POST['CityTownTXT']);
			$county = ($_POST['CountySLCT']);
			$country= ($_POST['CountrySLCT']);
			$email = ($_POST['EmailTXT']);
			$phone = ($_POST['Phone1TXT']);
			$phone2 = ($_POST['Phone2TXT']);
			$college = ($_POST['CollegeSlct']);
			$department = ($_POST['DeparmentSLCT']);
			$course = ($_POST['CourseSLCT']);
			$status = "student";

			//secure pass
			$pass = md5($pass);

			//check username
			$sql = ("SELECT * FROM users  WHERE uName = '".$uName."' ");

			$sql_check = $db->query($sql);

			if ($sql_check->num_rows == 0) 
			{
			//insert 
			$queryInsert ="
			INSERT INTO users  (uName, pass, UserCurrentStatus , fName, sName, Address, Address2, City, county, Country, Email, Phone, Phone2, CollegeName, CourseName) 
			VALUES('".$uName."', '".$pass."', '".$status."', '".$fName."','".$lName."', '".$address1."', '".$address2."', '".$city."', '".$county."', '".$country."', '".$email."', '".$phone."', '".$phone2."', '".$college."', '".$course."')
			";
			//uName pass1 pass2

			//insert query
			$insert_table = $db->query($queryInsert);
			echo "Inserted";
			}

	
			else{
				echo "Name taken";
			}
		}

	}


?>

<form action="regStudent.php" method="post">
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" />

<div>
<div  align="center" class="jumbotron">
	<h3 align="center"><i><b>Choose Login details</b></i></h3>
	<p align="center"><b>Student Number</b>:<br>
	  <input placeholder="studentName" id="Usernametbx" name="UsernameTXT" type="text">
  </p>
	<p align="center"><b>Password</b>:<br>
	  <input placeholder="Password" id="Passwordtbx" name="PasswordTXT" type="text">
  </p>
	<p align="center"><b>Re enter Password</b>:<br>
	  <input placeholder="Password" id="RePasswordtbx" name="RePasswordTXT" type="text">
	  <br>
  </p>
</div>

<div align="center" class="jumbotron">
	
	<h3><i><b>Plersonal Details</b></i></h3>
	
	  <p>
	    <label><b>First Name</b>:</label>
	    <br><input placeholder="First Name" id="FirstNametbx" name="FirstnameTXT" type="text"/>
      </p>
	  <p>
	    <label><b>Last Name</b>: </label>
<br>
<input placeholder="Last Name" id="Secondnametbx" name="SecondnameTXT" type="text">
      </p>
	  <p><b>Address 1</b>:<br>
	    <input placeholder="Address 1" id="Address1tbx" name="Address1TXT" type="text">
      </p>
	  <p><b>Address 2</b>:<br>
	    <input placeholder="Address 2" id="Address2tbx" name="Address2TXT" type="text">
      </p>
	  <p><b>City/Town</b>:<br>
	    <input placeholder="City/town" id="CityTowntbx" name="CityTownTXT" type="text">
      </p>
	  <p><b>County</b>:<br>
	    <select id="Countyslct" name="CountySLCT">
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
      <p><b>country</b>:<br>
	    <select id="Countryslct" name="CountrySLCT">
	      <option value="Ireland">Ireland</option>
	      <option value="Englang">England</option>
	      <option value="France">France</option>
        </select>
      </p>
	  <p>
<label><b>E-Mail</b>:</label>
<br>
<input placeholder="E-Mail" id="Emailtbx" name="EmailTXT" type="text" >
      </p>
	  <p>
        <label><b>Phone</b>: </label>
<br>
	    <input placeholder="Phone" id="Phonetbx" name="Phone1TXT" type="text">
      </p>
	  <p><b>Mobile</b>:<br>
	    <input placeholder="087 1234567" id="Phonetbx" name="Phone2TXT" type="text">
      </p>
      
      <div align="center" class="jumbotron">
      <h2>CollegeDetails</h2>
      <br />
      <p><b>College</b></p>
          <select id="collegeSelect" name="CollegeSlct">
	      <option value="It Sligo">It Sligo</option>
	      <option value="UL">UL</option>
	      <option value="UCD">UCD</option>
	      <option value="DCU">DCU</option>
        </select>
        
        <br />
        <p><b>Deparment</b></p>
          <select id="Deparmentslct" name="DeparmentSLCT">
	      <option value="Science">Science</option>
	      <option value="Computing">Comptuing</option>
	      <option value="Business">Bussiness</option>
	      <option value="Engineering">Enginering</option>
        </select>
        
        <br />
        <p><b>Course</b></p>
        <!-- Will need to population from db depending on deparment-->
          <select id="Courseslct" name="CourseSLCT">
	      <option value="Science">Science</option>
	      <option value="Computing">Comptuing</option>
	      <option value="Business">Bussiness</option>
	      <option value="Engineering">Enginering</option>
        </select>
        <br/>
		<input type="submit" name="submit" value="register" />

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
