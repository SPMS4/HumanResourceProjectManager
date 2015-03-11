<?php
		session_start();
        $Id=$_SESSION["Id"];
        
        if ($Id == null) {
		include 'Header.html'; 
        	
        }
        else
		include 'Header2.html'; 
        	
?>

<!DOCTYPE html>
<html>
<head>
	<title>SPMS</title>

	<!-- Add files href and src here for use in the project -->
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="css/pageposition.css">
	<link href="css/Borders.css" rel="stylesheet" type="text/css">
	<link href="css/navbar.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="css/SMPMccs.css">
	<script src="js/jquery-1.11.1.js"></script>

</head>
<body class="backgroundColorClass">
	<!--Header do not add to this div, add any content in the header.html file in the same folder,
	remember this changes all headers 
	<div id="header"></div>-->

	<!-- This is the main body for this page, add content here for this page -->
   
         <div class="row divColorClass" style="margin-top:145px;">
        <div class="col-lg-4" align="center">
          <img class="img-circle aboutImgCricle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" style="width: 140px; height: 140px;">
          <h2>The Idea</h2>
          <p>As students,we found that it could be hard to keep track of projects and what needed to be done in regards to it,we pulled together an idea to help simpilfy this and allow lectuers and students to streamline the process.</p>
        
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4" align="center">
          <img class="img-circle aboutImgCricle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" style="width: 140px; height: 140px;">
          <h2>The Product,"SPMS"</h2>
          <p>SPMS is a tool to allow both lectuers and students alike to steamline the process of creating and managing groups for projects and assigments.Our tool is simple to use and provides a useful and intuitive way to keep track of your progress and workload for your groups.</p>
      
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4" align="center">
          <img class="img-circle aboutImgCricle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" style="width: 140px; height: 140px;">
          <h2>The Team</h2>
          <p>Our team is made up of four third year software devolpement students.John is leading our front up,Greg is heading up the design and style,Tomas is handling the database and Cormac is working on the php.Together we hope to create a tool that will aid both lectuer and students alike</p>
       
        </div>
      </div>

	<!--footer do not add to this div, add any content in the footer.html file in the same folder,
	remember this changes all footers -->
	<!--<div id="footer"></div>
</body>

	<!-- Add all scripts below here for functionality and processing for the site -->
<script type="text/javascript">
		var x = document.createElement("INPUT");
		x.setAttribute("type", "password");
	</script>

	<script> 
		$(function(){
  		$("#header").load("header.html"); 
  		$("#footer").load("footer.html"); 
		});
	</script> 

</html>