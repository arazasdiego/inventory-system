<?php
ob_start();
require('../connection.php');
require('../date.php');
require('session.php');

$ordersid = $_GET['ordersid'];

$orders = $conn->query("SELECT * FROM orders WHERE OrdersID='$ordersid'");
	
while($row = $orders->fetch_assoc()) {

	if($row['OrderedQty'] == $row['DeliveredQty']) {
		$update = $conn->query("UPDATE orders SET DeliveryStatus='Delivered'
			WHERE ProductID='$row[ProductID]' AND OrdersID='$ordersid'");
	}
	else {
		$update = $conn->query("UPDATE orders SET DeliveryStatus='Partially Delivered'
			WHERE ProductID='$row[ProductID]' AND OrdersID='$ordersid'");
	}
	
}


header('location: deliver_set3.php?ordersid=' .$ordersid. '');	

ob_end_flush();
?>