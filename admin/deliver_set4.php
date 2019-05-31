<?php
ob_start();
require('../connection.php');
require('../date.php');
require('session.php');

$ordersid = $_GET['ordersid'];

$orders_total = $conn->query("SELECT * FROM orders_total WHERE OrdersID='$ordersid'");
$row = $orders_total->fetch_assoc();

if($row['PaymentStatus'] == 'Paid' && $row['DeliveryStatus'] == 'Delivered') {
	$update = $conn->query("UPDATE orders_total SET OrderStatus='Completed'
			WHERE OrdersID='$ordersid'");
}	

header('location: deliverorder.php?ordersid=' .$ordersid. '');	

ob_end_flush();
?>