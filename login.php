<?php
        require_once 'dbconfig.php';
echo "hi";
//-----------------------------
if (isset($_POST['submit'])) {
// Start the session
session_start();
		  try {
        //DB Connection
        $db = new PDO("mysql:host=$host;dbname=$dbname",
                            $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        echo "Connected to Database<br/>";
        
        $USERNAME = $_POST['LIUsernameTXT'];
        $PASSWORD = md5($_POST['LIPasswordTXT']);
        
        $sql = "SELECT UserID, uName, pass
        		FROM users 
        		WHERE uName='$USERNAME' and pass='$PASSWORD'";
       
        $log = $db->query($sql);

        if($log->rowCount() == 1)
        {
        	//$query = mysqli_query($db,"SELECT * 
           //                     FROM users 
           //                     where uName='$USERNAME');
        	foreach ($db->query($sql) as $data) {
          		$Id = $data['UserID'];
      		}
            $_SESSION["Id"] = "$Id";
            echo "$Id";

            header('Location: http://localhost/HumanResourceProjectManager/profile.php');
                        exit;
        }
        else
            echo "wrong";

        //Close Connection
        $db = null;

    } catch(PDOException $e) {
        echo $e->getMessage();
    }



}

?>
<?php include 'Header.html'; ?>
<body class="backgroundColorClass" >
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
<link href="css/SMPMccs.css" rel="stylesheet" type="text/css" />
<form action="login.php" method="post">

	
    <div class="container ">    
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
            <div class="panel divColorClass" >
                    <div class="panel-heading">
                        <div class="panel-title">Sign In</div>
                        <div style="float:right; font-size: 80%; position: relative; top:-10px">
                    </div>     

                    <div style="padding-top:30px" class="panel-body" >

                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                            
                                    
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                       <input class="form-control" placeholder="UserName" id="LIUsernametbx" name="LIUsernameTXT" type="text">                                        
                                    </div>
                                
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input class="form-control" placeholder="Password" id="LIPasswordtbx" name="LIPasswordTXT" type="password">
                                    </div>
              
                            <div class="input-group">
                                      <div class="checkbox">
                                        <label>
                                          <input id="login-remember" type="checkbox" name="remember" value="1"> Remember me
                                        </label>
                                      </div>
                                    </div>


                                <div style="margin-top:10px" class="form-group">
                                    <!-- Button -->

                                    <div class="col-sm-12 controls">
                                     <input class="btn btn-lg btn-info" type="submit" name="submit" value="Login" />
                               

                                    </div>
                                </div>


                               
                                    </div>
                                </div>    
                         
<!--<div>

	<div align="center" class="jumbotron" style="background-color:#FFF">
		<h3 align="center"><b>Enter login details</b></h3>
        <div class="input-group">
		<p align="center"><b>User Name</b>:<br>
		  <input class="form-control" placeholder="UserName" id="LIUsernametbx" name="LIUsernameTXT" type="text">
	  </p>
		<p align="center"><b>Password</b>:<br>
		  <input class="form-control" placeholder="Password" id="LIPasswordtbx" name="LIPasswordTXT" type="password">
	  </p><br /><br />
      <p align="center">
		<input class="btn btn-lg btn-info" type="submit" name="submit" value="register" />
	  </p>
	  <!--<button type="submit" style="btn btn-primay"/>	 --> 
      <!--<br />
	  <h5><i>Not registered?,click the link on top to register!</i></h5>
	</div>
    </div>
    </div> -->
    </body>
</form>


