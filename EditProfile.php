<?php

			try {
				//get id of uder logged in
				session_start();
			$Id=$_SESSION["Id"];

        require_once 'dbconfig.php';

			$db = new PDO("mysql:host=$host;dbname=$dbname",
                            $username, $password);


			$sql = "SELECT *
                FROM users 
                where UserID=$Id"; 
                // get all the data from the user that is logged in
			foreach ($db->query($sql) as $data) {
          $Id = $data['UserID'];
          $ufName = $data['fName'];
          $usName = $data['sName'];
          $uAddress=$data['Address'];
          $uAddress2=$data['Address2'];
          $ucity=$data['City'];
          $ucounty=$data['county'];
          $uCountry=$data['Country'];
          $uEmail=$data['Email'];
          $uPhone=$data['Phone'];
          $uPhone2=$data['Phone2'];
          $uColor = $data['Color'];
        }

	if (isset($_POST['submit'])) 
{
			
			//declare vars and get data in the list boxes
			$fName = ($_POST['FirstnameTXT']);
			$lName = ($_POST['SecondnameTXT']);
			$address1 = ($_POST['Address1TXT']);
			$address2 = ($_POST['Address2TXT']);
			$city = ($_POST['CityTownTXT']);
			$county = ($_POST['CountySLCT']);
			$country= ($_POST['CountrySLCT']);
			$phone = ($_POST['Phone1TXT']);
			$phone2 = ($_POST['Phone2TXT']);
			$color = ($_POST['ColorTXT']);
			//UPDATE THE data
		$sql = 'CALL UpdateProfile(:exUserID, :exfName, :exsName, :exAddress, :exAddress2, :exCity, :exCountry, :exCounty, :exPhone, :exPhone2, :exColor)';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':exUserID', $Id, PDO::PARAM_INT);
        $stmt->bindParam(':exfName', $fName, PDO::PARAM_STR, 50);
        $stmt->bindParam(':exsName', $lName, PDO::PARAM_STR,50);
        $stmt->bindParam(':exAddress', $address1, PDO::PARAM_STR,50);
        $stmt->bindParam(':exAddress2', $address2, PDO::PARAM_STR,50);
        $stmt->bindParam(':exCity', $city, PDO::PARAM_STR,50);
        $stmt->bindParam(':exCountry', $country, PDO::PARAM_STR,50);
        $stmt->bindParam(':exCounty', $county, PDO::PARAM_STR,50);
        $stmt->bindParam(':exPhone', $phone, PDO::PARAM_STR,12);
        $stmt->bindParam(':exPhone2', $phone2, PDO::PARAM_STR,12);
        $stmt->bindParam(':exColor', $color, PDO::PARAM_STR,6);
        $stmt->execute();
        $stmt->closeCursor();

        //update tasks/events colour the user has created
        $sql = 'CALL UpdateTaskEventColour(:exUserID, :exColor)';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':exUserID', $Id, PDO::PARAM_INT);
        $stmt->bindParam(':exColor', $color, PDO::PARAM_STR,6);
        $stmt->execute();
        $stmt->closeCursor();

        header('Location: http://localhost/HumanResourceProjectManager/profile.php');
            exit;

			} 
		}
			catch (Exception $e) {
       	echo $e->getMessage();
				
			}


?>
<link href="css/SMPMccs.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jscolor/jscolor.js"></script>

<?php include 'header2.html' ?>
<form action="EditProfile.php" method="post">
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
  <script src="js/jquery-1.11.1.js"></script>
  <script src="js/select2-3.5.2/select2.js"></script>
  <link rel="stylesheet" href="js/select2-3.5.2/select2.css">
  <body class="backgroundColorClass">
<div>

<div align="center">
	
      
      <div class="row ParaHeadFontColor">
    <div class="col-xs-12 col-sm-6 col-md-6 col-sm-offset-2 col-md-offset-3">
		<form role="form">
			<h2 align="center">Edit your profile</h2>
			<hr class="colorgraph">
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-6">
			
				</div>
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
		
					</div>
                   
                    
				</div>
			</div>
			<div class="form-group">
				<input placeholder="First Name" class="form-control"                  id="FirstNametbx" value="<?php echo "$ufName"; ?>" name="FirstnameTXT" type="text" >
			</div>
            <div class="form-group">
				<input placeholder="Last Name" class="form-control" id="Secondnametbx" value="<?php echo "$usName"; ?>" name="SecondnameTXT" type="text" >
			</div>
            <div class="form-group">
				 <input placeholder="Address 1" class="form-control" id="Address1tbx" value="<?php echo "$uAddress"; ?>" name="Address1TXT" type="text">
			</div>
            <div class="form-group">
				<input placeholder="Address 2" class="form-control" id="Address2tbx" value="<?php echo "$uAddress2"; ?>" name="Address2TXT" type="text">
			</div>
            <div class="form-group">
				 <input placeholder="City/town" class="form-control" id="CityTowntbx" value="<?php echo "$ucity"; ?>" name="CityTownTXT" type="text">
			</div>
             <div class="form-group">
				<select class="js-example-basic-single" style="width:655px" id="Countyslct" value="<?php echo "$ucounty"; ?>" name="CountySLCT">
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
			</div>
             <div class="form-group">
				<select class="js-example-basic-single" style="width:655px" value="<?php echo "$country"; ?>" id="Countryslct" name="CountrySLCT">
	      <option value="Ireland">Ireland</option>
	      <option value="Englang">England</option>
	      <option value="France">France</option>
        </select>
			</div>
			<div class="form-group">
			</div>
            	<div class="form-group">
				   <input placeholder="Phone" class="form-control" id="Phonetbx" value="<?php echo "$uPhone"; ?>" name="Phone1TXT" type="text" >
			</div>
            	<div class="form-group">
				<input placeholder="Mobile" class="form-control" id="Phonetbx" value="<?php echo "$uPhone2"; ?>" name="Phone2TXT" type="text">
			</div>
			<div class="form-group">
				  <input  id="Colortbx"  class="form-control color" name="ColorTXT" type="text" value="<?php echo "$uColor"; ?>">
			</div> 
				
				
			<div class="row">
				<div align="center" class="col-xs-4 col-sm-3 col-md-3">
					<span class="button-checkbox">
                    <p align="center">
				 <input type="submit" class="btn btn-lg btn-info" name="submit" value="Update" /></p>
					</span>
				</div>
				
			</div>
   
</form>
</body>

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


