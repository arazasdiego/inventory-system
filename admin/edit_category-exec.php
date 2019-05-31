<?php
ob_start();
require('../connection.php');

if(isset($_POST['submit'])) {
	$categoryname = ucwords($_POST['categoryname']);
	$categoryid = $_POST['categoryid'];
	$categoryreturned = $_POST['categoryreturned'];
	

	
	

		$update = "UPDATE category SET CategoryName='$categoryname', CategoryReturned='$categoryreturned'
			WHERE CategoryID='$categoryid'";

		if($conn->query($update) === TRUE) {
			echo '<script>
			window.alert("Successfully updated.");
			window.location.href="category.php";
			</script>';
		}
		else {
			echo 'ERROR: ' .$update. '<br />'. $conn->error;
		}
	
}

ob_end_flush();
?>