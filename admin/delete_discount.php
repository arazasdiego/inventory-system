<?php
ob_start();
require('../connection.php');
require('../date.php');
require('session.php');


$discountid = $_GET['discountid'];
$discountname = $_GET['discountname'];

//Trail Message
$message = 'Removed the discount type (' .$discountname. ').';

$update = "UPDATE discount SET DiscountDelete=1
	WHERE DiscountID='$discountid';";

$update .= "INSERT INTO trail(UserID, ID, Message, DateCreated)
    VALUES('$_SESSION[userid]', 'discountid', '$message', '$da')";

if($conn->multi_query($update) === TRUE) {
	echo '<script>
		window.alert("Successfully removed.");
		window.location.href="discount.php";
		</script>';
}   
else {
	echo 'Error: ' .$update. '<br />' .$conn->error;
} 	

ob_end_flush();
?>