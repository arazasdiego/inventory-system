<?php
ob_start();
require('../connection.php');
require('../date.php');
require('session.php');


$supplierid = $_GET['supplierid'];
$suppliername = $_GET['suppliername'];

//Trail Message
$message = 'Removed the supplier (' .$suppliername. ').';

$update = "UPDATE supplier SET SupplierDelete=1
	WHERE SupplierID='$supplierid';";

$update .= "INSERT INTO trail(UserID, ID, Message, DateCreated)
    VALUES('$_SESSION[userid]', '$supplierid', '$message', '$da')";

if($conn->multi_query($update) === TRUE) {
	echo '<script>
		window.alert("Successfully removed.");
		window.location.href="supplier.php";
		</script>';
}   
else {
	echo 'Error: ' .$update. '<br />' .$conn->error;
} 	

ob_end_flush();
?>