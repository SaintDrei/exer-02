<?php
    session_start();
    if(isset($_SESSION['uid']))
    {
        include '../config.php';
        $uid = $_SESSION['uid'];
        $sql_profile = "SELECT schoolID, email, firstName, lastName, mobile FROM users WHERE userID=$uid";
        $result_profile = $con->query($sql_profile) or die(mysqli_error($con));
        while ($row = mysqli_fetch_array($result_profile)){
            $sid = $row['schoolID']; $row[0];
            $email = $row['email'];
            $fn = $row['firstName'];
            $ln = $row['lastName'];
            $mob = $row['mobile'];
        }
        if (isset($_POST['update']))
        {
        $sid = mysqli_real_escape_string($con, $_POST['sid']);
		$email = mysqli_real_escape_string($con, $_POST['email']);
        $pw = mysqli_real_escape_string($con, $_POST['pw']);
        $pw = $pw == "" ? "" : hash("sha256", $pw);    
		
		$fn = mysqli_real_escape_string($con, $_POST['fn']);
		$ln = mysqli_real_escape_string($con, $_POST['ln']);
		$mob = mysqli_real_escape_string($con, $_POST['mob']);
            
        $sql_update = $pw == "" ? 
        "UPDATE users SET email='$email', firstName='$fn', 
        lastName='$ln', mobile='$mob', lastModified=NOW() WHERE userID=$uid" :
        "UPDATE users SET email='$email', password='$pw', firstName='$fn', 
        lastName='$ln', mobile='$mob', lastModified=NOW() WHERE userID=$uid";
            
        $con->query($sql_update) or di(mysqli_error($con));
        header('index.php?updated=yes');
            
        }
    }
    else{
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
                    <i class="fa fa-user"></i> My Profile
                </h1>
                <form method="POST" class="form-horizontal well">
                    <?php
                       if (isset($_REQUEST['updated']))
                       {
                           echo "
                           <div class='alert alert-success'> Profile Updated. </div>";
                       }
                    ?>
                    <div class="form-group">
                        <label class="control-label col-lg-4">Student Number</label>
                        <div class="col-lg-8">
                            <input name="sid" value='<?php echo $sid; ?>' type="number"
                                class="form-control" maxlength="8" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-4">Email Address</label>
                        <div class="col-lg-8">
                            <input name="email" type="email" value='<?php echo $email; ?>'
                                class="form-control" maxlength="100" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-4">Password</label>
                        <div class="col-lg-8">
                            <input name="pw" type="password"
                                class="form-control" maxlength="30">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-4">First Name</label>
                        <div class="col-lg-8">
                            <input name="fn" type="text" value='<?php echo $fn; ?>'
                                class="form-control" maxlength="50" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-4">Last Name</label>
                        <div class="col-lg-8">
                            <input name="ln" type="text" value='<?php echo $ln; ?>'
                                class="form-control" maxlength="30" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-4">Mobile Number</label>
                        <div class="col-lg-8">
                            <input name="mob" type="number" value='<?php echo $mob; ?>'
                                class="form-control" maxlength="11" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-offset-4 col-lg-8">
                            <button name="update" class="btn btn-success btn-lg pull-right">
                                <i class="fa fa-refresh"></i> Update Profile
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        type="text/javascript"></script>
    </body>
</html>