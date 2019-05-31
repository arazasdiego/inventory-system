<?php
ob_start();
require('../connection.php');
require('../date.php');
require('session.php');


if(isset($_POST['submit'])) {
	$reasonname = ucwords($_POST['reasonname']);

	$check = $conn->query("SELECT * FROM damaged_reason WHERE ReasonName='$reasonname' AND ReasonDelete=0");
	if($check->num_rows > 0) {
		echo '<script>
		window.alert("Reason already exist.");
		window.location.href="damaged_reason.php"
		</script>';
	}

	else {
		//Trail Message
    	$message = 'Added a new reason (' .$reasonname. ').';

		$insert = "INSERT INTO damaged_reason(ReasonName, ReasonDelete)
		VALUES('$reasonname', '0');";

		$insert .= "INSERT INTO trail(UserID, ID, Message, DateCreated)
   	 	VALUES('$_SESSION[userid]', 'reasonid', '$message', '$da')";

		if($conn->multi_query($insert) === TRUE) {
			echo '<script>
			window.alert("Successfully added.");
			window.location.href="damaged_reason.php";
			</script>';
		}
		else {
			echo 'ERROR: ' .$insert. '<br />'. $conn->error;
		}
	}
}

ob_end_flush();
?>