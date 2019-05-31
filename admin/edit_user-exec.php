<?php
ob_start();
require('../connection.php');
require('session.php');
require('../date.php');

if(isset($_POST['submit'])) {
	$fullname = $_POST['fullname'];
	$contact = $_POST['contact'];
	$address = $_POST['address'];
	$email = $_POST['email'];
	$username = $_POST['username'];
	$userid = $_POST['userid'];


	$ctr = 0;
	

	if(!isset($_POST['inventory'])) {
		$inventory = 0;
	}	
	else {										
		$inventory = 1;
	}


	if(!isset($_POST['po'])) {
		$po = 0;
	}	
	else {										
		$po = 1;
	}


	if(!isset($_POST['orders'])) {
		$orders = 0;
	}	
	else {										
		$orders = 1;
	}

	if(!isset($_POST['reports'])) {
		$reports = 0;
	}	
	else {										
		$reports = 1;
	}


	if(!isset($_POST['settings'])) {
		$settings = 0;
	}	
	else {										
		$settings = 1;
	}


	if(empty($username) || empty($fullname) || empty($contact) || empty($email) || empty($address)) {
		echo '<script>
			window.alert("All fields cannot be empty.");
			</script>';
	}
	else {
		$ctr ++;
	}

	if($ctr == 1) {
		$update = "UPDATE user SET Username='$username'
			WHERE UserID='$userid';";

		$update .= "UPDATE user_info SET Fullname='$fullname', Contact='$contact', Email='$email', Address='$address'
			WHERE UserID='$userid';";	


		$update .= "UPDATE user_access SET Inventory='$inventory', PO='$po', Orders='$orders', Reports='$reports', Settings='$settings'
			WHERE UserID='$userid'";	

		if($conn->multi_query($update) === TRUE) {
    		echo '<script>
			window.alert("Successfully updated.");
			window.location.href="user.php";
			</script>';
    	}
    	else {
    		echo 'Error: ' .$update. '<br />' .$conn->error;
    	}
	}


	

	

}

ob_end_flush();
?>