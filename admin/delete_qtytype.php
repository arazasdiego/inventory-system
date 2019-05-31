<?php
ob_start();
require('../connection.php');
require('../date.php');
require('session.php');


$qtyid = $_GET['qtyid'];
$qtyname = $_GET['qtyname'];

//Trail Message
$message = 'Removed the quantity type (' .$qtyname. ').';

$update = "UPDATE quantity_type SET QtyDelete=1
	WHERE QtyID='$qtyid';";

$update .= "INSERT INTO trail(UserID, ID, Message, DateCreated)
    VALUES('$_SESSION[userid]', 'qtyid', '$message', '$da')";

if($conn->multi_query($update) === TRUE) {
	echo '<script>
		window.alert("Successfully removed.");
		window.location.href="qtytype.php";
		</script>';
}   
else {
	echo 'Error: ' .$update. '<br />' .$conn->error;
} 	

ob_end_flush();
?>