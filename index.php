<?php
		session_start();
		if (isset($_SESSION["Id"])) {
			include 'Header2.html';
		}
		else
			include 'Header.html';       	
?>

<!DOCTYPE html>
<html>
<head>
	<title>HRPM</title>
	<!-- Add files href and src here for use in the project -->
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="css/pageposition.css">
	<link rel="stylesheet" type="text/css" href="css/popup.css">
    <link rel="stylesheet" type="text/css" href="css/carosel.css">
     <link rel="stylesheet" type="text/css" href="css/SMPMccs.css">
	<script src="js/jquery-1.11.1.js"></script>
   
</head>
<body class="backgroundColorClass" >
	<!--Header do not add to this div, add any content in the header.html file in the same folder,
	remember this changes all headers 
	<div id="header"></div>-->

	<!-- This is the main body for this page, add content here for this page -->
	
     
    

	<!-- popup for contact div below -->
	<div id="contact" onclick="checkcontact(event)" style="overflow:hidden;"> <!-- Popup Container starts Here -->
		<div id="con"> <!-- Popup starts here -->
			<div id="popupcontent"> <!-- elements in the popup are in here -->
				<form action="#" id="popupform" method="post" name="formcontent">
					<img id="close" src="images/3.png">
					<h2>Contact Us</h2>
					<hr id="hr">
					<input id="name" name="name" placeholder="Name" type="text">
					<br>
					<input id="email" name="email" placeholder="Email" type="text">
					<br>
					<textarea id="msg" name="message" placeholder="Message"></textarea>
					<a href="javascript:%20check_empty()" id="submit">Send</a>
					<p><span id="span">Note :</span> In this demo, we have stopped email sending functionality.</p>
				</form>
			</div> <!-- elements in the popup stop here -->		
		</div> <!-- Popup ends here -->
	</div> <!-- Popup Container ends Here -->


	<!-- popup for reister choice below -->
	<div id="Register" onclick="check(event)" style="overflow:hidden;"> <!-- Popup Container starts Here -->
		<div id="abc"> <!-- Popup starts here -->
			<div id="popupcontent"> <!-- elements in the popup are in here -->
				<form action="#" id="popupform" method="post" name="form">
					<img id="close" src="images/3.png">
					<h2>Register</h2>
					<hr id="hr">
					<br>
					<a href="register.html" id="Business">Business</a>
					<br>
					<a href="register.html" id="Personal">Personal</a>
					<p><span id="span">Note :</span> In this demo, we have stopped email sending functionality.</p>
				</form>
			</div> <!-- elements in the popup stop here -->		
		</div> <!-- Popup ends here -->
	</div> <!-- Popup Container ends Here -->
    
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
  </ol>
 
  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    <div class="item active">
      <img src="img/Image two.jpg" alt="...">
      <div class="carousel-caption">
          <h3>HRPM</h3>
          <p>Making project and people manmage simple</p>
      </div>
    </div>
    <div class="item">
      <img src="img/Image three.jpg" alt="...">
      <div class="carousel-caption">
          <h3>Want to simply your group management?</h3>
          <p>Click Register</p>
      </div>
    </div>
    <div class="item">
      <img src="img/Image one.jpg" alt="...">
      <div class="carousel-caption">
          <h3>Rated 10/10 by snoop dogg</h3>
          <p>"Its ok"</p>
      </div>
    </div>
  </div>
 
  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
  </a>
</div> <!-- Carousel -->

	<!--footer do not add to this div, add any content in the footer.html file in the same folder,
	remember this changes all footers -->
	
    
    <div class="row divColorClass">
        <div class="col-lg-4">
          <h2 align="center">Manage groups painlesssly</h2>
          <p align="center">Using Our studtent project management system,managing project groups has never been simpler.Our system is easy to use and is designed to be accesable to anyone.We hope that you enjoy our system and find it easier to use.Click below to start using SPMS(Must be registered and log in).</p>
         
        </div>
        <div class="col-lg-4">
          <h2 align="center">About us</h2>
          <p align="center">We are a group of four third year programming students that meet during out time at college.We grouped up at the start of the year for the PRJ300 project and decided to create a website to allow lecuter and students to organise there group based project simiply and painlessly </p>
         
       </div>
        <div class="col-lg-4">
          <h2 align="center" >Easy creation of groups</h2>
          <p align="center">As a lectuer you will be able to assign muiltpe groups of students to a custom created project and monitor them as they upadte their progress using our calendar system,making it easy to keep an eye on everyone as well as get everyone grouped up quickly and effortlessly</p>
        
        </div>
      </div>
     <!-- <div id="footer"></div>

      <!-- Site footer -->
      

    </div> <!-- /container -->
</body>

	<!-- Add all scripts below here for functionality and processing for the site -->

	<script type="text/javascript"> // start of create password field
		var x = document.createElement("INPUT");
		x.setAttribute("type", "password");
	</script> <!-- end of create password field -->

	<script> //Call header.html and footer.html to load to page
		$(function(){
  		$("#header").load("header.html"); 
  		$("#footer").load("footer.html"); 
		});
	</script> <!-- end of Call header.html and footer.html to load to page -->

	<script> //start of register popup

		//Function To Display Popup
		function div_show() 
		{
			document.getElementById('abc').style.display = "block";
		}

		//Function To Check Target Element
		function check(e) 
		{
			var target = (e && e.target) || (event && event.srcElement);
			var obj = document.getElementById('abc');
			var obj2 = document.getElementById('popup');
			checkParent2(target) ? obj.style.display = 'none' : null;
			target == obj2 ? obj.style.display = 'block' : null;
		}
		//Function To Check Parent Node And Return Result Accordingly
		function checkParent(t) 
		{
			while (t.parentNode) 
			{
				if (t == document.getElementById('abc')) 
				{
					return false
				} 
				else if (t == document.getElementById('close'))
				{
					return true
				}
				t = t.parentNode
			}
			return true
		}
		</script><!-- end of register popup -->

		<script> //start of contact popup
		function check_empty() 
		{
			if (document.getElementById('name').value == "" || document.getElementById('email').value == "" || document.getElementById('msg').value == "")
			{
			alert("Fill All Fields !");
			} 
			else 
			{
			document.getElementById('formcontent').submit();
			alert("Form Submitted Successfully...");
			}
		}
		//Function To Display Popup
		function div_showcontact() 
		{
			document.getElementById('con').style.display = "block";
		}
		//Function To Check Target Element
		function checkcontact(e) 
		{
			var target = (e && e.target) || (event && event.srcElement);
			var obj = document.getElementById('con');
			var obj2 = document.getElementById('popup');
			checkParent2(target) ? obj.style.display = 'none' : null;
			target == obj2 ? obj.style.display = 'block' : null;
		}
		//Function To Check Parent Node And Return Result Accordingly
		function checkParent2(t) 
		{
			while (t.parentNode) 
			{
				if (t == document.getElementById('con')) 
				{
					return false
				} 
				else if (t == document.getElementById('close'))
				{
					return true
				}
				t = t.parentNode
			}
			return true
		}
		</script><!-- end of contact popup -->
        <script>
    $('.carousel').carousel({
        interval: 500
    })
</script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</html>