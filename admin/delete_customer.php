<?php
ob_start();
require('../connection.php');
require('../date.php');
require('session.php');


$userid = $_GET['userid'];
$fullname = $_GET['fullname'];

//Trail Message
$message = 'Removed this user account (' .$fullname. ').';

$update = "UPDATE user SET UserDelete=1
	WHERE UserID='$userid';";

$update .= "INSERT INTO trail(UserID, ID, Message, DateCreated)
    VALUES('$_SESSION[userid]', '$userid', '$message', '$da')";

if($conn->multi_query($update) === TRUE) {
	echo '<script>
		window.alert("Successfully removed.");
		window.location.href="customer.php";
		</script>';
}   
else {
	echo 'Error: ' .$update. '<br />' .$conn->error;
} 	

ob_end_flush();
?>