<?php
require('../connection.php');
require('../date.php');
require('session.php');
ob_start();

$bankid = $_GET['bankid'];
$bankname = $_GET['bankname'];

//Trail Message
$message = 'Removed the bank account (' .$bankname. ').';

$update = "UPDATE bank SET BankDelete=1
	WHERE BankID='$bankid';";

$update .= "INSERT INTO trail(UserID, ID, Message, DateCreated)
    VALUES('$_SESSION[userid]', 'bankid', '$message', '$da')";

if($conn->multi_query($update) === TRUE) {
	echo '<script>
		window.alert("Successfully removed.");
		window.location.href="bank.php";
		</script>';
}   
else {
	echo 'Error: ' .$update. '<br />' .$conn->error;
} 	

ob_end_flush();
?>