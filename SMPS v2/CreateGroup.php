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
        echo "string";

       $sqlCheck = "SELECT * 
            FROM groups 
            where user_name = $groupName";
      $res = mysql_query($sqlCheck);

    if($res && mysql_num_rows($res=0){
        echo "string";
    //check if username taken
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
      } 
      catch (PDOException $pe){
        die("Error occurred:" . $pe->getMessage());
      } 
           $values = $_POST['ary'];
                foreach ($values as $a) 
                 {
                     echo $a;
                  }
          if (is_array($values)) {
            while (list($key, $val)=each($values)) {
              //get groupID where groupName = The groupName Entered
              //------------------------------------------------------------------
                echo "<br/>ID = $val <br/>";
              $sql0 = "SELECT GroupID
                      FROM groups 
                      where GroupName='".$groupName."'"; 

            foreach ($db->query($sql0) as $id) {
            $GId = $id['GroupID'];
            }
              $queryInsert ="
                 UPDATE users   
                 SET GroupID = $GId
                  WHERE $val = UserID
                  ";

                //insert query
                $insert_table = $db->query($queryInsert);
                    
                    }  
             }
           }
           else{echo "Wrong";}
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

</head>
<body>
  <!--Header do not add to this div, add any content in the header.html file in the same folder,
  remember this changes all headers -->
  <div id="header"></div>

  <!-- This is the main body for this page, add content here for this page -->

 <div id="wrapper" style="background-color:#999">

        <!-- Sidebar -->
        <div id="sidebar-wrapper" style="background-color:#999">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                 Course:<br>
  <div>
    <select id="source">
      <optgroup label="Computing">
        <option value="SW">Software Devolpment</option>
        <option value="SYS">Systems and Netorking</option>
        <option value="WEB">Web Design</option>
        <option value="GME">Games</option>
      </optgroup>
        <optgroup label="Science">
        <option value="BM">BioMed</option>
        <option value="PH">Phriosicnes</option>
        <option value="HS">Health Saftey</option>
        <option value="PHRMA">Pharama</option>
      </optgroup>
    
    </select>
    </div>
    
    <div>
<select class="js-example-basic-multiple" multiple="multiple" size="10">
  <option value="AL">Tim</option>
  <option value="WY">Bob</option>
</select>
    </div>
   
                 
                </li>
              <br/><br/><br/><br/><br/><br/><br/><br/>
              <li>
      <button type="button" id="AddBTN" class="btn btn-info btn-lg">Add</button>
                </li> 
              
            </ul>
        </div>
        <!--/span-->
        
            <div class="jumbotron">
                 <h2 align="center">Group Details</h2>
                 <form>
             <div class="row">
  <div class="col-lg-6" align="center">
  Name of Project
    <div class="input-group">
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
    </div><!-- /input-group -->
    
  </div><!-- /.col-lg-6 -->
  
     <div align="center">
             <div class="row">
  <div class="col-lg-6">
  Group Name:
    <div class="input-group">
      <input type="text" name="groupName" class="form-control" aria-label="...">
    </div><!-- /input-group -->
   
      </div>
      <br>
      <br>
           
          
        
        
          
            <div class="jumbotron" style="margin-top:10px">
                 <h2>Members Assign</h2>
                 <p>List Box - Single Select<br>
                <select name="ary[]" multiple="multiple" size="3">
                <option value="1">S00129359</option>
                <option value="2">Option 2</option>
                <option value="3">Option 3</option>
                <option value="4">Option 4</option>
                <option value="5">Option 5</option>
                </select>
                </p>
          </div>
          <input type="submit" name="submit" value="create" />
          <div class="jumbotron" style="margin-top:10px">
              <table class="table table-striped">
      <thead>
        <tr>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Course</th>
          <th>Status</th>
          <th>StudentID</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Mark</td>
          <td>Otto</td>
          <td>Software</td>
          <td>Avabile</td>
          <td>s00123</td>
          <td><button class="btn btn-info" onClick="">Remove</button></td>
        </tr>
        <tr>
          <td>Mark</td>
          <td>Otto</td>
          <td>Software</td>
          <td>Avabile</td>
          <td>123</td>
          <td><button class="btn btn-info" onClick="">Remove</button></td>
        </tr>

      </tbody>
    </table>
       </div>
            <footer class="footer">
        <p>&copy; Company 2014</p>
      </footer>
            
             
    
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