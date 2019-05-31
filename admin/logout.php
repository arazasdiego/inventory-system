<?php
ob_start();
session_start();
require('../connection.php');

$delete = "DELETE FROM po_cart WHERE UserID='$_SESSION[userid]';";

$delete .= "DELETE FROM sales_cart WHERE UserID='$_SESSION[userid]'";

if($conn->multi_query($delete) === TRUE) {
	header('location: ../index.php');
}
else{
	echo 'ERROR: ' .$delete. $conn->error;
}



session_unset(); 

ob_end_flush();
?>