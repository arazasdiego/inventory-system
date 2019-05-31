<?php
ob_start();
require('connection.php');

if(isset($_POST['login'])) {
	$username = $conn->real_escape_string($_POST['username']);
	$password = $conn->real_escape_string($_POST['password']);

	$query = $conn->query("SELECT * FROM user WHERE Username='$username' AND Password='$password' AND UserDelete=0");

	if($query->num_rows > 0 ) {
		$row = $query->fetch_assoc();
		$userstatus = $row['UserStatus'];
		$role = $row['Role'];
		
		if ($userstatus == 'Inactive') {
			echo '<script>
			window.alert("This account is deactivated. Please contact the administrator.");
			window.location.href="index.php";
			</script>';
		}
		else {
			session_start();
			$_SESSION['userid'] = $row['UserID'];
			$_SESSION['role'] = $row['Role'];

			$user_info = $conn->query("SELECT * FROM user_info WHERE UserID='$row[UserID]'");
			$row2 = $user_info->fetch_assoc();
			$fullname = $row2['Fullname'];

			if ($role == 'Superadmin') {
				echo ("<script>
					window.alert('Welcome $fullname.')
					window.location.href='admin/dashboard.php';
					</script>");
			}
			else if ($role == 'Admin') {
				echo ("<script>
					window.alert('Welcome $fullname.')
					window.location.href='admin/dashboard.php';
					</script>");
			}
			else {
				echo ("<script>
					window.alert('Welcome $fullname.')
					window.location.href='user/customer_orders.php';
					</script>");
			}
		}
	}
	else {
		echo ("<script>
				window.alert('Login failed. Please check your username and password.')
				window.location.href='index.php';
			</script>");
	}
	
}


ob_end_flush();
?>