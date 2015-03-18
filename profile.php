<?php
try {
	require_once 'dbconfig.php';
    $db = new PDO("mysql:host=$host;dbname=$dbname",
                            $username, $password);

        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

       	 session_start();
        $Id=$_SESSION["Id"];
        
        $sql = "SELECT *
                FROM users 
                where UserID=$Id"; 
       
        foreach ($db->query($sql) as $data) {
          $Id = $data['UserID'];
          $name = $data['uName'];
          $CourseName=$data['CourseName'];
          $UserCurrentStatus=$data['UserCurrentStatus'];
          $Address=$data['Address'];
          $Email=$data['Email'];
          $county=$data['county'];
        }
                      //send lecturer to lecturer page
                      if ($UserCurrentStatus == "lecturer") {
          header('Location: http://localhost/HumanResourceProjectManager/profileLECUTER.php');
            exit;
        }

        //get all the groups the user is in
        $sql = 'CALL SelectGroupsByUser(:exUserID)';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':exUserID', $Id, PDO::PARAM_INT);     
        $stmt->execute();

        $arrVal = $stmt->fetchAll(PDO::FETCH_ASSOC);

        //to view a group calendar
         if (isset($_POST['submit'])) 
          {
            //get the group selected in the listbox
            $selected = $_POST['groupLst'];
            //remove the previous group from the sessions
            unset($_SESSION['groupId']);
            //then add new session and redirect
            $_SESSION["groupId"] = "$selected";
            header('Location: http://localhost/HumanResourceProjectManager/Group.php');
            exit; 
          }

          //to log out
        if (isset($_POST['logOut'])) 
          {
            //kill session and redirect
            unset($_SESSION['Id']);
            header('Location: http://localhost/HumanResourceProjectManager/login.php');
            exit; 
          }
        
include 'Header2.html'; 
       } catch (Exception $e) {
          header('Location: http://localhost/HumanResourceProjectManager/login.php');
       	echo $e->getMessage();
       }

?>
<form id="popform" action="profile.php" method="POST">

<!DOCTYPE html>
<html>
<head>
  <title>HRPM</title>

  <!-- Add files href and src here for use in the project -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" type="text/css" href="css/pageposition.css">
  <link href="css/Borders.css" rel="stylesheet" type="text/css">
  <link href="css/SMPMccs.css" rel="stylesheet" type="text/css">
  
  <script src="js/jquery-1.11.1.js"></script>

</head>

<body class="backgroundColorClass">
  <!--Header do not add to this div, add any content in the header.html file in the same folder,
  remember this changes all headers -->
  

  <!-- This is the main body for this page, add content here for this page -->
    <div class="container">
      <div class="row">
    
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
   
   
          <div class="panel divColorClass">
            <div class="panel-heading">
              <h3 class="panel-title" name="name"><?php echo $name ?></h3>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=100" class="img-circle"> </div>
                
                <!--<div class="col-xs-10 col-sm-10 hidden-md hidden-lg"> <br>
                  <dl>
                    <dt>DEPARTMENT:</dt>
                    <dd>Administrator</dd>
                    <dt>HIRE DATE</dt>
                    <dd>11/12/2013</dd>
                    <dt>DATE OF BIRTH</dt>
                       <dd>11/12/2013</dd>
                    <dt>GENDER</dt>
                    <dd>Male</dd>
                  </dl>
                </div>-->
                <div class=" col-md-9 col-lg-9"> 
                  <table class="table table-user-information ParaHeadFontColor">
                    <tbody>
                      <tr>
                        <td>Course:</td>
                        <td name="course"><?php echo $CourseName ?></td>
                      </tr>
                      <tr>
                        <td>Status</td>
                        <td name="status"><?php echo $UserCurrentStatus ?></td>
                      </tr>
                   
                         <tr>
                             <tr>
                        <td>Address</td>
                        <td name="address"><?php echo $Address ?></td>
                      </tr>
                        <tr>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr>
                        <td>Email</td>
                        <td><a name="email"><?php echo $Email ?></a></td>
                      </tr>
                        <td>County</td>
                        <td name="county"> <?php echo $county ?></td>
                           
                      </tr>
                     
                    </tbody>
                  </table>
         <!--<input type="submit" name="groupCreate" value="Create a Group" />       -->         </div>
              </div>
            </div>
            <div class="profileLstBx" style="float:left">
              <h4>Groups</h4>
<?php
try {
       //display the listbox and poplate in php
    echo "<select class='form-control profilepageLstWidth' name='groupLst' size='5'></option>";
        foreach ($arrVal as $key => $val) {
            $GroupID = $val['GroupID'];
            $GroupName = $val['GroupName'];
            echo "<option value=$GroupID>$GroupName</option>"; 
          }
          echo "</select>";// Closing of list box  
        } catch (Exception $e) {
       	echo $e->getMessage();
        }        

?>

<!--<div clas="profileLstBx" style="float:left;">
<h4>Projects</h4>

</div>-->
      
            </div>          
      <input type="submit" class="btn btn-info" name="submit" value="view group" />
      <input type="submit" class="btn btn-info" name="logOut" value="log out" />
     

      
       <p class="btn btn-info">
       <a style="color:#000" href="EditProfile.php">Edit</a> 
       </p>     
          </div>
        </div>
      </div>
    </div>
  <!--<div class="bordersDIV">
<div id="profileINFO" class="profileDetailsDIV">
    Name: 
    <br>
    <label> Name FIller Filler</label>
    <br>
    <br> 
    Profile Picture:
    <br>
    <img src="img/Empty Profile IMG.jpg" width="90" height="90">
    <br>
    <br>
    Deparment:
    <br>
    <label>DeparmentFiller</label>
    <br>
    <br>
    Course:
    <br>
    <label>Course Filler</label>
    <br>
    <br>
    Status:
    <br>
    <label>Status Filler</label>
    <br>
    <br>
    DOB:
    <br>
    <label>DOB Filler</label>
    </div>
    <div id="miscDetails" class="miscprofileDetailsDIV">
    </div>
    <p>&nbsp;</p>
    
  </div> -->

  <!--footer do not add to this div, add any content in the footer.html file in the same folder,
  remember this changes all footers -->
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
</form>