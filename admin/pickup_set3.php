<?php
ob_start();
require('../connection.php');
require('../date.php');
require('session.php');

$ordersid = $_GET['ordersid'];

$orders1 = $conn->query("SELECT * FROM orders WHERE OrdersID='$ordersid'");

$orders2 = 	$conn->query("SELECT * FROM orders WHERE OrdersID='$ordersid' AND PickedupStatus='Pickedup'");

$count1 = $orders1->num_rows;
$count2 = $orders2->num_rows;

if($count1 == $count2) {
	$update = $conn->query("UPDATE orders_total SET PickedupStatus='Pickedup'
			WHERE OrdersID='$ordersid'");
}
else {
	$update = $conn->query("UPDATE orders_total SET PickedupStatus='Partially Pickedup'
			WHERE OrdersID='$ordersid'");
}



header('location: pickup_set4.php?ordersid=' .$ordersid. '');	

ob_end_flush();
?>