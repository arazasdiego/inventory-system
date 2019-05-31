<?php
ob_start();
require('../connection.php');
require('../date.php');
require('session.php');

if(isset($_POST['submit'])) {
	$qtyname = ucwords($_POST['qtyname']);

	$check = $conn->query("SELECT * FROM quantity_type WHERE QtyName='$qtyname' AND QtyDelete=0");
	if($check->num_rows > 0) {
		echo '<script>
		window.alert("Quantity type already exist.");
		window.location.href="qtytype.php"
		</script>';
	}

	else {
		//Trail Message
    	$message = 'Added a new quantity type (' .$qtyname. ').';

		$insert = "INSERT INTO quantity_type(QtyName, QtyDelete)
		VALUES('$qtyname', '0');";

		$insert .= "INSERT INTO trail(UserID, ID, Message, DateCreated)
   	 	VALUES('$_SESSION[userid]', 'qtyid', '$message', '$da')";



		if($conn->multi_query($insert) === TRUE) {
			echo '<script>
			window.alert("Successfully added.");
			window.location.href="qtytype.php";
			</script>';
		}
		else {
			echo 'ERROR: ' .$insert. '<br />'. $conn->error;
		}
	}
}

ob_end_flush();
?>