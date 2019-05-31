<?php
require('../connection.php');
require('../date.php');
require('session.php');
ob_start();

$categoryid = $_GET['categoryid'];
$categoryname = $_GET['categoryname'];

//Trail Message
$message = 'Removed the category type (' .$categoryname. ').';

$update = "UPDATE category SET CategoryDelete=1
	WHERE CategoryID='$categoryid';";

$update .= "INSERT INTO trail(UserID, ID, Message, DateCreated)
    VALUES('$_SESSION[userid]', 'categoryid', '$message', '$da')";

if($conn->multi_query($update) === TRUE) {
	echo '<script>
		window.alert("Successfully removed.");
		window.location.href="category.php";
		</script>';
}   
else {
	echo 'Error: ' .$update. '<br />' .$conn->error;
} 	

ob_end_flush();
?>