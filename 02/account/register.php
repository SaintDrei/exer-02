<?php
    include "../config.php";
    require "../libraries/phpmailer/PHPMailerAutoLoad.php";
    require "../libraries/phpmailer/class.smtp.php";
 
    $mail = new PHPMailer;
    $mail->SMTPDebug = false;
    $mail->isSMTP();
    $mail->Debugoutput = 'html';
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPSecure = 'ssl';
    $mail->SMTPAuth = true; 
    
    $mail->Username = "teamblazit@gmail.com";
    $mail->Password = "ecosaisse";
    $mail->FromName = "Full Name";
    $mail->From="teamblazit@gmail.com";

    $mail->SMTPSecure = true;  
    $mail->Port = "465";
 
    $mail->setFrom('teamblazit@gmail.com', 'The Administrator');
    $mail->isHTML(true);
 
 
    if (isset($_POST['register']))
    {
        $sid = mysqli_real_escape_string($con, $_POST['sid']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $pw = hash("sha256", mysqli_real_escape_string($con, $_POST['pw']));
        $fn = mysqli_real_escape_string($con, $_POST['fn']);
        $ln = mysqli_real_escape_string($con, $_POST['ln']);
        $mob = mysqli_real_escape_string($con, $_POST['mob']);
 
        $sql_validate = "SELECT schoolID FROM users
            WHERE schoolID=$sid";
        $result_validate = $con->query($sql_validate) or die(mysqli_error($con));
 
        if (mysqli_num_rows($result_validate) == 0)
        {
            $sql_register = "INSERT INTO users VALUES ('', 1, $sid, '$email',
                                '$pw', '$fn', '$ln', '$mob', 'Pending',
                                NOW())";
            $con->query($sql_register) or die(mysqli_error($con));
 
            $url = "http://localhost:8080/exercises/02/account/confirm.php?e=$email&pw=$pw";
 
            $mail->addAddress($email, $fn . " " . $ln);
            $mail->Subject = "Account Confirmation";
            $mail->Body = "
                    Welcome, $fn $ln ($sid)!<br/>
                    You have successfully registered your account.<br/>
                    Your email address is: $email <br/><br/>
                    Click the confirmation link below:<br/>
                    <a href='$url' target='_blank'>$url</a>
                    <br/><br/>
                    Thank you!<br/>
                    - The Administrator
            ";
 
            if(!$mail->send())
            {
                $mail->SMTPDebug = 3;
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            }
            else
            {
                echo 'Message has been sent';
            }
        }
    }
 
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Student Registration</title>
        <meta name="author" content="Dionylyn Cadiz" />
        <meta name="description" content="WEBDEVT Exercise #2" />
        <meta name="keyword" content="potato, benilde, derp" />
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
            rel="stylesheet" type="text/css" />
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
            rel="stylesheet" type="text/css" />
         <link href="https://bootswatch.com/flatly/bootstrap.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="container">
            <div class="col-lg-offset-3 col-lg-6">
                <h1 class="text-center">
                    <i class="fa fa-user"></i> Student Registration
                </h1>
                <form method="POST" class="form-horizontal well">
                    <?php
                        if (isset($_POST['register']) &&
                            mysqli_num_rows($result_validate) > 0)
                        {
                            echo "
                                <div class='alert alert-danger'>
                                    School ID already taken.
                                </div>
                            ";
                        }
                    ?>
                    <div class="form-group">
                        <label class="control-label col-lg-4">Student Number</label>
                        <div class="col-lg-8">
                            <input name="sid" type="number"
                                class="form-control" maxlength="8" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-4">Email Address</label>
                        <div class="col-lg-8">
                            <input name="email" type="email"
                                class="form-control" maxlength="100" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-4">Password</label>
                        <div class="col-lg-8">
                            <input name="pw" type="password"
                                class="form-control" maxlength="30" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-4">First Name</label>
                        <div class="col-lg-8">
                            <input name="fn" type="text"
                                class="form-control" maxlength="50" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-4">Last Name</label>
                        <div class="col-lg-8">
                            <input name="ln" type="text"
                                class="form-control" maxlength="30" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-4">Mobile Number</label>
                        <div class="col-lg-8">
                            <input name="mob" type="number"
                                class="form-control" maxlength="11" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-offset-4 col-lg-8">
                            <button name="register" class="btn btn-success btn-lg pull-right">
                                <i class="fa fa-plus"></i> Register
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