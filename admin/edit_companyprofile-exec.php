<?php
ob_start();
require('../connection.php');

if(isset($_POST['submit'])) {
	$businessname = $_POST['businessname'];
	$businessaddress = $_POST['businessaddress'];
	$businesscontact = $_POST['businesscontact'];
	$businessemail = $_POST['businessemail'];
	$businessowner = $_POST['businessowner'];
	$tin = $_POST['tin'];
	$ornumber = $_POST['ornumber'];

	$update = "UPDATE business_profile SET BusinessName='$businessname', BusinessAddress='$businessaddress', BusinessContact='$businesscontact', BusinessEmail='$businessemail', BusinessOwner='$businessowner', TIN='$tin', ORNumber='$ornumber'
		WHERE ID=1";

		if($conn->query($update) === TRUE) {
			echo '<script>
			window.alert("Successfully updated.");
			window.location.href="company_profile.php";
			</script>';
		}
		else {
			echo 'ERROR: ' .$update. '<br />'. $conn->error;
		}
	
}

ob_end_flush();
?>