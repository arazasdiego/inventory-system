<?php
ob_start();
require('../connection.php');
require('../date.php');
require('session.php');

$ordersid = $_GET['ordersid'];

$orders1 = $conn->query("SELECT * FROM orders WHERE OrdersID='$ordersid'");

$orders2 = 	$conn->query("SELECT * FROM orders WHERE OrdersID='$ordersid' AND WalkinStatus='Completed'");

$count1 = $orders1->num_rows;
$count2 = $orders2->num_rows;

if($count1 == $count2) {
	$update = $conn->query("UPDATE orders_total SET WalkinStatus='Completed'
			WHERE OrdersID='$ordersid'");
}
else {
	$update = $conn->query("UPDATE orders_total SET WalkinStatus='Partially Prepared'
			WHERE OrdersID='$ordersid'");
}



header('location: walkin_prepare4.php?ordersid=' .$ordersid. '');	

ob_end_flush();
?>