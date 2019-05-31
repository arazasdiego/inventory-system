<?php
ob_start();
require('../connection.php');

$ordersid = $_GET['ordersid'];

//ORDERS TOTAL
$orders_total = $conn->query("SELECT * FROM orders_total WHERE OrdersID='$ordersid'");
$row = $orders_total->fetch_assoc();

if($row['PaymentStatus'] == 'Paid' && $row['DeliveryStatus'] == 'Delivered') {
	$update = $conn->query("UPDATE orders_total SET OrderStatus='Completed', ReturnedStatus=0, DateFinished='$da'
		WHERE OrdersID='$ordersid'");
	
}


	header('location: deliver_update-exec4.php?ordersid=' .$ordersid. '');





ob_end_flush();
?>