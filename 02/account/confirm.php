<?php
	if (isset($_REQUEST['e']) && isset($_REQUEST['pw']))
	{
		include "../config.php";
		$email = $_REQUEST['e'];
		$pw = $_REQUEST['pw'];
        
        //$sql_check = "SELECT userID FROM users WHERE email='$email' AND password='$pw' AND status='Pending'";
        
        $sql_check = "SELECT userID FROM users WHERE email='" . $email . "' AND password='" . $pw . "' AND status='Pending'";

		$result_check = $con->query($sql_check) or die(mysqli_error($con));
		if (mysqli_num_rows($result_check) > 0)
		{
			# update status to Active
			$sql_activate = "UPDATE users SET status='Active', lastModified=NOW() 
							WHERE email='$email' AND status='Pending'";
			$con->query($sql_activate) or die(mysqli_error($con));
			header('location: login.php?activate=yes');
		}
		else
		{
			header('location: login.php');		
		}

	}
	else
	{
		header('location: login.php');
	}
?>