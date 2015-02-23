<?php
//---------------------------------------------------
//TO DO!!!!!!
//
//put in code so that you cannot
//use the same groupname twice
//
//---------------------------------------------------
session_start();
  $Id=$_SESSION["Id"];
  echo "$Id";

    require_once 'dbconfig.php';

    $db = new PDO("mysql:host=$host;dbname=$dbname",
                            $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "SELECT UserCurrentStatus
            FROM users 
            where UserID=$Id"; 

    foreach ($db->query($sql) as $status) {
    $stat = $status['UserCurrentStatus'];
    echo "$stat";}
    

if ($stat == "lecturer") {

  if (isset($_POST['submit'])) 
  {

    $groupName = $_POST['groupName'];
    echo "<br/>$groupName<br/>";
    $groupProject = $_POST['projectName'];
    echo "$groupProject";


    
        $sqlCheck = 'CALL CountGroups(:exgroupname, @groups)';
        $stmtCheck = $db->prepare($sqlCheck);
        $stmtCheck->bindParam(':exgroupname', $groupName, PDO::PARAM_STR, 50);
        $stmtCheck->execute();
        $stmtCheck->closeCursor();
        echo "$groupName <br/>";
        $resu = $db->query("SELECT @groups AS name")->fetch(PDO::FETCH_ASSOC);
        if ($resu) {
        echo sprintf('amt od groups: %s <br/>', $resu['name']);
        $nme = $resu['name'];
      }

    if($nme==0)
    {
      //not taken
      try{    
        $sql = 'CALL InsertGroup(:exgroupname, :exprojectID, :exUserID)';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':exgroupname', $groupName, PDO::PARAM_STR, 50);
        //$stmt->bindParam(':exprojectname', $groupProject, PDO::PARAM_STR, 50);
        $stmt->bindParam(':exprojectID', $groupProject, PDO::PARAM_INT);
        $stmt->bindParam(':exUserID', $Id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();

        $students = $_POST['ary'];
              //  foreach ($students as $a) 
               //  {
               //      echo $a;
               //   }
          if (is_array($students)) {
            while (list($key, $UId)=each($students)) {

              //get groupID where groupName = The groupName Entered
              //------------------------------------------------------------------
               // echo "<br/>ID = $UId <br/>";
              $getGroup = "SELECT GroupID
                      FROM groups 
                      where GroupName='".$groupName."'"; 

            foreach ($db->query($getGroup) as $id) {
            $GId = $id['GroupID'];
            }

             $queryInsert = "
             INSERT INTO usergroup (GroupID, UserID)
                            VALUES ('".$GId."', '".$UId."')
                            ";
                $insert_table = $db->query($queryInsert);
             
              
                    } 
                    //set groupID a calander
            $calanderInsert = "
             INSERT INTO calendar (GroupID)
                            VALUES ('".$GId."')
                            ";
                $calendar_table = $db->query($calanderInsert);  
             }
             header('Location: http://localhost/updatedPrj300/profile.php');
            exit;
      } 
      catch (PDOException $pe){
        die("Error occurred:" . $pe->getMessage());
      } 
           
           }
           else{
            echo "<br/>Wrong";
          }
      }
  }
  else{
    echo "you are student";
    header('Location: http://localhost/updatedPrj300/profile.php');
            exit;
  }

?>


<!DOCTYPE html>
<form action="groupcreate.php" method="post">
<head>
  <title>HRPM</title>

  <!-- Add files href and src here for use in the project -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" type="text/css" href="css/pageposition.css">
  <link href="css/Borders.css" rel="stylesheet" type="text/css">
  <link href="../css/Sidebar.css" rel="stylesheet" type="text/css">
  <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/Sidebar.css" rel="stylesheet" type="text/css">
  <link href="css/poscre.css" rel="stylesheet" type="text/css">
  <script src="js/jquery-1.11.1.js"></script>
    <script src="js/select2-3.5.2/select2.js"></script>
    <link rel="stylesheet" href="js/select2-3.5.2/select2.css">
    
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
  <!--Header do not add to this div, add any content in the header.html file in the same folder,
  remember this changes all headers -->
  <div id="header"></div>

  <!-- This is the main body for this page, add content here for this page -->

 
        
            <div id="grouppos" class="jumbotron" style="text-align:center">
                 <h2 align="center">Group Details</h2>
                 <form>
             <div class="row" style="text-align:center">
  <div class="col-lg-6" align="center">
    <div class="input-group" align="center">
      Select a Project<br>
      <?php
         require_once 'dbconfig.php';

          $db = new PDO("mysql:host=$host;dbname=$dbname",
                            $username, $password);
          $sql="SELECT ProjectName,ProjectID FROM project order by ProjectName"; 
          echo "<select name=projectName value=''>Project Name</option>";
         // echo "<select>";
          foreach ($db->query($sql) as $row){
          echo "<option value=$row[ProjectID]>$row[ProjectName]</option>"; 
          }
          echo "</select>";// Closing of list box
          ?>
    </div>
    
  <div align="center">
  select Students <br/>
    <?php
         require_once 'dbconfig.php';

          $db = new PDO("mysql:host=$host;dbname=$dbname",
                            $username, $password);
          $sql="SELECT uName, UserID FROM users order by uName"; 
          echo "<select class='js-example-basic-multiple' multiple='multiple' size='2' name='ary[]'' value=''>User Name</option>";
         // echo "<select>";
          foreach ($db->query($sql) as $row){
          echo "<option value=$row[UserID]>$row[uName]</option>"; 
          $UserIdSelected = $row['UserID'];
          if (isset($_POST['submit'])) 
  {
    echo "<br/>userId slected = $UserIdSelected";
  }
          }
          echo "</select>";// Closing of list box
          if (isset($_POST['submit'])) 
  {echo "<br/>userId slected = $UserIdSelected";
  }
          ?>
    </div>
    
    </div><!-- /input-group -->
    
  </div><!-- /.col-lg-6 -->
  
     <div align="center">
             <div class="row" align="center">
  <div class="col-lg-6">
  Group Name:
  <div class="input-group" align="center">
      <input type="text" name="groupName" class="form-control" aria-label="..."/>
      <div align="center">
      <br><br>
      <input type="submit" class="btn btn-info" name="submit" value="create group" />
      </div>
    </div><!-- /input-group -->
      
    
   
      </div>
      <br>
      <br>
           

            <footer class="footer"></footer>
            
             
    
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

</form>