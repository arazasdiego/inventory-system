<?php
ob_start();
require('../connection.php');
$ordersid = $_GET['ordersid'];

$check = $conn->query("SELECT * FROM tanks WHERE OrdersID='$ordersid'");
$count = $check->num_rows;

$tankcheck = $conn->query("SELECT * FROM tanks WHERE OrdersID='$ordersid' AND Status='Completed'");
$tankcount = $tankcheck->num_rows;

if($count == $tankcount) {
	$update = "UPDATE tanks_total SET Status='Completed'
		WHERE OrdersID='$poid'";
		if($conn->query($update) ===TRUE) {
			header('location: view_tank.php?ordersid=' .$ordersid. '');
		}
		else {
			echo 'Error ' .$update. '<br />' .$conn->error;
		}
}
else {
	$update = "UPDATE tanks_total SET Status='Partially Received'
		WHERE OrdersID='$ordersid'";
		if($conn->query($update) ===TRUE) {
			header('location: view_tank.php?ordersid=' .$ordersid. '');
		}
		else {
			echo 'Error ' .$update. '<br />' .$conn->error;
		}
}




ob_end_flush();
?>