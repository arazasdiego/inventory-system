<?php
ob_start();
require('../connection.php');
require('session.php');

if(isset($_POST['save_password'])) {
	$old_password = $_POST['old_password'];
	$new_password = $_POST['new_password'];
	$ctr = 0;

	if(empty($old_password) || empty($new_password)) {
		echo '<script>
			window.alert("Fill up all the fields");
			window.location.href="customer-account.php";
			</script>';
	}
	else {
		$ctr ++;
	}

	if($old_password != $urow['Password']) {
		echo '<script>
			window.alert("Incorrect old password.");
			window.location.href="customer-account.php";
			</script>';
	}
	else {
		$ctr ++;
	}

	if($ctr == 2) {
		$update = "UPDATE user SET Password='$new_password'
			WHERE UserID='$_SESSION[userid]'";
		if($conn->query($update) === TRUE) {
			echo '<script>
				window.alert("Successfully updated.");
				window.location.href="customer-account.php";
				</script>';
		}
		else {
			echo 'Error ' .$update. '<br/>' .$conn->error;
		}	
	}
}




if(isset($_POST['save_detail'])) {
	$fullname = $_POST['fullname'];
	$contact = $_POST['contact'];
	$address = $_POST['address'];

		
	$update = "UPDATE user_info SET Fullname='$fullname', Contact='$contact', Address='$address'
			WHERE UserID='$_SESSION[userid]'";
		if($conn->query($update) === TRUE) {
			echo '<script>
				window.alert("Successfully updated.");
				window.location.href="customer-account.php";
				</script>';
		}
		else {
			echo 'Error ' .$update. '<br/>' .$conn->error;
		}	
	
}
ob_end_flush();
?>