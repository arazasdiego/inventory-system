<?php
ob_start();
require('../connection.php');
require('../date.php');
require('session.php');

$ordersid = $_GET['ordersid'];

$orders = $conn->query("SELECT * FROM orders WHERE OrdersID='$ordersid'");
	
while($row = $orders->fetch_assoc()) {

	if($row['OrderedQty'] == $row['PickedupQty']) {
		$update = $conn->query("UPDATE orders SET PickedupStatus='Pickedup'
			WHERE ProductID='$row[ProductID]' AND OrdersID='$ordersid'");
	}
	else {
		$update = $conn->query("UPDATE orders SET PickedupStatus='Partially Pickedup'
			WHERE ProductID='$row[ProductID]' AND OrdersID='$ordersid'");
	}
	
}


header('location: pickup_set3.php?ordersid=' .$ordersid. '');	

ob_end_flush();
?>