<?php
ob_start();
require('../connection.php');

if(isset($_POST['submit'])) {
	$qtyname = ucwords($_POST['qtyname']);
	$qtyid = $_POST['qtyid'];

	$check = $conn->query("SELECT * FROM quantity_type WHERE QtyName='$qtyname'");
	if($check->num_rows > 0) {
		echo '<script>
		window.alert("Quantity type name already exist.");
		window.location.href="qtytype.php"
		</script>';
	}

	else {

		$update = "UPDATE quantity_type SET QtyName='$qtyname'
		WHERE QtyID='$qtyid'";

		if($conn->query($update) === TRUE) {
			echo '<script>
			window.alert("Successfully updated.");
			window.location.href="qtytype.php";
			</script>';
		}
		else {
			echo 'ERROR: ' .$update. '<br />'. $conn->error;
		}
	}
}


ob_end_flush();
?>