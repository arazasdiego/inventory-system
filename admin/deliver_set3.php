<?php
ob_start();
require('../connection.php');
require('../date.php');
require('session.php');

$ordersid = $_GET['ordersid'];

$orders1 = $conn->query("SELECT * FROM orders WHERE OrdersID='$ordersid'");

$orders2 = 	$conn->query("SELECT * FROM orders WHERE OrdersID='$ordersid' AND DeliveryStatus='Delivered'");

$count1 = $orders1->num_rows;
$count2 = $orders2->num_rows;

if($count1 == $count2) {
	$update = $conn->query("UPDATE orders_total SET DeliveryStatus='Delivered'
			WHERE OrdersID='$ordersid'");
}
else {
	$update = $conn->query("UPDATE orders_total SET DeliveryStatus='Partially Delivered'
			WHERE OrdersID='$ordersid'");
}



header('location: deliver_set4.php?ordersid=' .$ordersid. '');	

ob_end_flush();
?>