<?php
ob_start();
require('../connection.php');
require('../date.php');
require('session.php');

$ordersid = $_GET['ordersid'];

$orders_total = $conn->query("SELECT * FROM orders_total WHERE OrdersID='$ordersid'");
$row = $orders_total->fetch_assoc();

if($row['DeliveryStatus'] == 'Delivered' && $row['PaymentStatus'] == 'Paid') {
	$update = $conn->query("UPDATE orders_total SET OrderStatus='Completed', ReturnedStatus=0, DateFinished='$da'
		WHERE OrdersID='$ordersid'");
	
}


	if($row['OrderType'] == 'Online') {
		header('location: online_order2.php?ordersid=' .$ordersid. '');
	}
	else {
		header('location: sales2.php?ordersid=' .$ordersid. '');
	}
	

ob_end_flush();
?>