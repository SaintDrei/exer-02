<?php
include "../config.php";

if (isset($_POST['register'])){
    $sid = mysqli_real_escape_string($con, $_POST['sid']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $pw = hash("sha256", mysqli_real_escape_string($con, $_POST['pw']));
    $fn = mysqli_real_escape_string($con, $_POST['fn']);
    $ln = mysqli_real_escape_string($con, $_POST['ln']);
    $mob = mysqli_real_escape_string($con, $_POST['mob']);
    
    $sql_register = "INSERT INTO users VALUES ('', 1, $sid, '$email', '$pw', 
    '$fn', '$ln', '$mob', 'Pending', NOW())";
    
    $con->query($sql_register);
    
//    $con->query($sql_register) or die echo (mysqli_error($con));
    header('location: login.php');
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Student Registration</title>
         <meta name="author" content="Andrei Mishael Santos" />
        <meta name="description" content="WEBDEVT Exercise #2" />
        <meta name="keyword" content="potato, benilde, derp" />
        <link href="https://bootswatch.com/flatly/bootstrap.min.css"
            rel="stylesheet" type="text/css" />
        <link href="https://bootswatch.com/flatly/bootstrap.css" rel="stylesheet" type="text/css">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
            rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div class="container">
            <div class="col-lg-offset-3 col-lg-6">
                <h1 class="text-center">
                <i class="fa fa-user"></i> Student Registration
                </h1>
                <form method="post" class="form-horizontal well">
                    <div class="form-group">
                        <label class="control-label col-lg-4">Student Number</label>
                        <div class="col-lg-8">
                            <input name="sid" class="form-control" type="number" maxlength="8" required>
                       
                      </div>
                    </div> <div class="form-group">
                        <label class="control-label col-lg-4">Email Address</label>
                        <div class="col-lg-8">
                            <input name="email" class="form-control" type="email"  required>
                       
                      </div>
                    </div> <div class="form-group">
                        <label class="control-label col-lg-4">Password</label>
                        <div class="col-lg-8">
                            <input name="pw" class="form-control" type="password" required>
                       
                      </div>
                    </div> <div class="form-group">
                        <label class="control-label col-lg-4">First Name</label>
                        <div class="col-lg-8">
                            <input name="fn" class="form-control" type="text" required>
                       
                      </div>
                    </div> <div class="form-group">
                        <label class="control-label col-lg-4">Last Name</label>
                        <div class="col-lg-8">
                            <input name="ln" class="form-control" type="text"  required>
                       
                      </div>
                    </div> <div class="form-group">
                        <label class="control-label col-lg-4">Mobile Number</label>
                        <div class="col-lg-8">
                            <input name="mob" class="form-control" type="number" maxlength="11" required>
                       
                      </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-offset-4 col-lg-8">
                        <button name="register" class="btn btn-success btn-lg pull-right"><i class="fa fa-plus"></i>Register</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" type="text/javascript"></script>
        
    </body>
</html>