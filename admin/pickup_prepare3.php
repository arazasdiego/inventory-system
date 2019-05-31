<?php
ob_start();
require('../connection.php');
require('../date.php');
require('session.php');

$ordersid = $_GET['ordersid'];

$orders_total = $conn->query("SELECT * FROM orders_total WHERE OrdersID='$ordersid'");
$row = $orders_total->fetch_assoc();

if($row['PickedupStatus'] == 'Pickedup' && $row['PaymentStatus'] == 'Paid') {
	$update = $conn->query("UPDATE orders_total SET OrderStatus='Completed', ReturnedStatus=0, DateFinished='$da'
		WHERE OrdersID='$ordersid'");
	
}


	
		header('location: pickuporder.php?ordersid=' .$ordersid. '');
	
	

ob_end_flush();
?>