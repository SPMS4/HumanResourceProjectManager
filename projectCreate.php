<?php
session_start();
  $Id=$_SESSION["Id"];
    require_once 'dbconfig.php';

if (isset($_POST['submit'])) 
{ 
  try {
        //DB Connection
        $db = new PDO("mysql:host=$host;dbname=$dbname",
                            $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	 	  //declare vars
    	$projectName = $_POST['ProjectName'];
		  $projectStart = $_POST['startDate'];
		  $projectEnd = $_POST['endDate'];
		  $projectDesc = $_POST['projectDescription'];
      echo "$projectName";
      try{    
        $sql = 'CALL InsertProject(:proName, :proStart, :proEnd, :proDescription)';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':proName', $projectName, PDO::PARAM_STR, 50);
        $stmt->bindParam(':proStart', $projectStart, PDO::PARAM_LOB );
        $stmt->bindParam(':proEnd', $projectEnd, PDO::PARAM_LOB );
        $stmt->bindParam(':proDescription', $projectDesc, PDO::PARAM_STR, 2000);
        $stmt->execute();
        $stmt->closeCursor();

             header('Location: http://localhost/HumanResourceProjectManager/profile.php');
            exit;
        
      } 
      catch (PDOException $pe){
        die("Error occurred:" . $pe->getMessage());
      } 
    }
    catch (PDOException $pe){
        die("Error occurred:" . $pe->getMessage());
      } 
    
}
include 'Header2.html'; 

?>

<form action="projectCreate.php" method="post">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" type="text/css" href="css/pageposition.css">
  <link href="css/Borders.css" rel="stylesheet" type="text/css">
  <link href="../css/Sidebar.css" rel="stylesheet" type="text/css">
  <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/Sidebar.css" rel="stylesheet" type="text/css">
  <script src="js/jquery-1.11.1.js"></script>
      <script src="js/select2-3.5.2/select2.js"></script>
    <link rel="stylesheet" href="js/select2-3.5.2/select2.css">

  
     
            <div class="jumbotron" style="background-color:#FFF">
                 <h2 align="center">Project Details</h2>
                 <form>
             <div class="row">
  <div class="col-lg-6" align="center">
  Name of Project
    <div class="input-group">
      <input type="text" name="ProjectName" class="form-control" aria-label="...">
    </div><!-- /input-group -->
    
  </div><!-- /.col-lg-6 -->
  
     <div align="center">
             <div class="row">
  <div class="col-lg-6">
  Start Date:
    <div class="input-group">
      <input type="date" name="startDate" class="form-control" aria-label="...">
    </div><!-- /input-group -->
    End Date
    <div class="input-group">
      <input type="date" name="endDate" class="form-control" aria-label="...">
    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 -->
  </div>
      </div>
      <br>
      <br>
           <div align="center">
           <div class="form-group">
    <label for="name">Project Description</label>
    <textarea class="form-control" name="projectDescription" style="width:70%" rows="3"></textarea>
           </div>      
          <input type="submit" class="btn btn-info" name="submit" value="Submit" />
        </div>
        
        
        
          <script> 
    $(function(){
      $("#header").load("header.html"); 
      $("#footer").load("footer.html"); 
    });
  </script> 
</form>