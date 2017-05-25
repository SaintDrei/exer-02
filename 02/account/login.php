<?php
	if (isset($_POST['login']))
	{
		include "../config.php";
		$email = mysqli_real_escape_string($con, $_POST['email']);
		$pw = hash('sha256', mysqli_real_escape_string($con, $_POST['pw']));

		$sql_login = "SELECT userID, typeID FROM users
			WHERE email='$email' AND password='$pw'
			AND status='Active'";
		$result_login = $con->query($sql_login) or die(mysqli_error($con));

		if (mysqli_num_rows($result_login) > 0)
		{
			session_start();
			while ($row = mysqli_fetch_array($result_login))
			{
				$uid = $row['userID'];
				$typeID = $row['typeID'];

				$_SESSION['uid'] = $uid;
				$_SESSION['typeID']= $typeID;
				header('location: index.php');
			}
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Student Login</title>
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
					<i class="fa fa-user"></i> Student Login 
				</h1>
				<form method="POST" class="form-horizontal well">
					<?php
						if (isset($_REQUEST['activate']))
						{
							echo "
								<div class='alert alert-success'>
									Account activated. You may now log in.
								</div>";
						}

						if (isset($_POST['login']) && 
							mysqli_num_rows($result_login) == 0)
						{
							echo "
								<div class='alert alert-danger'>
									Email or password did not match.
								</div>
							";
						}
					?>
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
						<div class="col-lg-offset-4 col-lg-8">
							<button name="login" class="btn btn-success btn-lg">
								<i class="fa fa-key"></i> Login
							</button>
							<a class="pull-right" href="register.php">I don't have an account...</a>
						</div>
					</div>
				</form>
			</div>
		</div>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" 
		type="text/javascript"></script>
	</body>
</html>