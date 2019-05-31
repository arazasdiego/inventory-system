<?php
ob_start();
require('../connection.php');
require('../date.php');
require('session.php');


$productid = $_GET['productid'];
$prodname = $_GET['prodname'];

//Trail Message
$message = 'Removed the product (' .$prodname. ').';

$update = "UPDATE product SET ProductDelete=1
	WHERE ProductID='$productid';";

$update .= "INSERT INTO trail(UserID, ID, Message, DateCreated)
    VALUES('$_SESSION[userid]', '$productid', '$message', '$da')";

if($conn->multi_query($update) === TRUE) {
	echo '<script>
		window.alert("Successfully removed.");
		window.location.href="product.php";
		</script>';
}   
else {
	echo 'Error: ' .$update. '<br />' .$conn->error;
} 	

ob_end_flush();
?>