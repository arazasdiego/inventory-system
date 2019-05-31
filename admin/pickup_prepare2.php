<?php
ob_start();
require('../connection.php');
require('../date.php');
require('session.php');

$ordersid = $_GET['ordersid'];

$orders = $conn->query("SELECT * FROM orders WHERE OrdersID='$ordersid'");
$orders2 = $conn->query("SELECT * FROM orders WHERE OrdersID='$ordersid' AND PickedupStatus='Pickedup'");

$count = $orders->num_rows;
$count2 = $orders2->num_rows;

if($count == $count2) {
	$update = "UPDATE orders_total SET PickedupStatus='Pickedup', OrderStatus='Being Prepared', PreparedBy='$_SESSION[userid]'
		WHERE OrdersID='$ordersid'";

	if($conn->query($update) === TRUE) {
		echo '<script>
					window.alert("Successfully prepared all the items for pickup.");
					window.location.href="pickup_prepare3.php?ordersid=' .$ordersid. '";
					</script>';
	}
	else {
		echo 'Error: ' .$update. '<br />' .$conn->error;
	}	
}

else {
	$update = "UPDATE orders_total SET PickedupStatus='Partially Pickedup', OrderStatus='Being Prepared', PreparedBy='$_SESSION[userid]'
		WHERE OrdersID='$ordersid'";

	if($conn->query($update) === TRUE) {
		echo '<script>
					window.alert("Successfully set the status and partially for pickup. It generates a purchase to supplier. Set the delivery date to on the generated po section.");
					window.location.href="pickup_prepare3.php?ordersid=' .$ordersid. '";
					</script>';
	}
	else {
		echo 'Error: ' .$update. '<br />' .$conn->error;
	}	
}




ob_end_flush();
?>