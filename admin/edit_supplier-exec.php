<?php
ob_start();
require('../connection.php');

if(isset($_POST['submit'])) {
	$suppliername = ucwords($_POST['suppliername']);
	$supplierid = $_POST['supplierid'];
	$contact = $_POST['contact'];
	$email = $_POST['email'];


	

	

		$update = "UPDATE supplier SET SupplierName='$suppliername', Email='$email', Contact='$contact'
		WHERE SupplierID='$supplierid'";

		if($conn->query($update) === TRUE) {
			echo '<script>
			window.alert("Successfully updated.");
			window.location.href="supplier.php";
			</script>';
		}
		else {
			echo 'ERROR: ' .$update. '<br />'. $conn->error;
		}
	
}

ob_end_flush();
?>