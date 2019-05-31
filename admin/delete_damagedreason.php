<?php
ob_start();
require('../connection.php');
require('../date.php');
require('session.php');


$reasonid = $_GET['reasonid'];
$reasonname = $_GET['reasonname'];

//Trail Message
$message = 'Removed the reason (' .$reasonname. ').';

$update = "UPDATE damaged_reason SET ReasonDelete=1
	WHERE ReasonID='$reasonid';";

$update .= "INSERT INTO trail(UserID, ID, Message, DateCreated)
    VALUES('$_SESSION[userid]', 'reasonid', '$message', '$da')";

if($conn->multi_query($update) === TRUE) {
	echo '<script>
		window.alert("Successfully removed.");
		window.location.href="damaged_reason.php";
		</script>';
}   
else {
	echo 'Error: ' .$update. '<br />' .$conn->error;
} 	

ob_end_flush();
?>