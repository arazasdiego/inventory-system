<?php
ob_start();
require('../connection.php');

if(isset($_POST['submit'])) {
	$reasonname = ucwords($_POST['reasonname']);
	$reasonid = $_POST['reasonid'];

	$check = $conn->query("SELECT * FROM damaged_reason WHERE ReasonName='$reasonname'");
	if($check->num_rows > 0) {
		echo '<script>
		window.alert("Damaged reson already exist.");
		window.location.href="damaged_reason.php"
		</script>';
	}

	else {

		$update = "UPDATE damaged_reason SET ReasonName='$reasonname'
		WHERE ReasonID='$reasonid'";

		if($conn->query($update) === TRUE) {
			echo '<script>
			window.alert("Successfully updated.");
			window.location.href="damaged_reason.php";
			</script>';
		}
		else {
			echo 'ERROR: ' .$update. '<br />'. $conn->error;
		}
	}
}




ob_end_flush();
?>