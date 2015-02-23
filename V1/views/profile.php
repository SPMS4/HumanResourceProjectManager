<?php
//connect to database host
    $db = mysqli_connect("localhost", "root", "")
      or die (mysql_error());
      //connect to database
      mysqli_select_db($db, "prjdatabase");


     // $nameQuery = "SELECT uName, 
     //          FROM users 
    //           WHERE UserID=2";
      
    //  $Select_name = $db->query($nameQuery);


        $query = mysqli_query($db,"SELECT * 
                                FROM users 
                                where UserID=13");

          while($data = mysqli_fetch_array($query))
          { 
          $name=$data['uName'];
          $CourseName=$data['CourseName'];
          $UserCurrentStatus=$data['UserCurrentStatus'];
          $Address=$data['Address'];
          $Email=$data['Email'];
          $county=$data['county'];
          }
               
      //$course
     // $status
     // $address
     // $email
     // $county
?>

<!DOCTYPE html>
<html>
<head>
  <title>HRPM</title>

  <!-- Add files href and src here for use in the project -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" type="text/css" href="css/pageposition.css">
  <link href="css/Borders.css" rel="stylesheet" type="text/css">
  <script src="js/jquery-1.11.1.js"></script>

</head>
<body>
  <!--Header do not add to this div, add any content in the header.html file in the same folder,
  remember this changes all headers -->
  <div id="header"></div>

  <!-- This is the main body for this page, add content here for this page -->
    <div class="container">
      <div class="row">
    
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
   
   
          <div class="panel panel-info">
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
                <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-user-information">
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
                        <td>Date of Birth</td>
                        <td>01/24/1988</td>
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
                  
                  <a href="groupmanage.html" class="btn btn-primary">Current Project</a>
                  <a href="groupcreate.html" class="btn btn-primary">Create a group</a>
                </div>
              </div>
            </div>
                
                    </div>
            
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
  <div id="footer"></div>
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