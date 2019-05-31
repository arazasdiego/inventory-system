<?php
ob_start();
require('../connection.php');
require('../date.php');
require('session.php');

$ordersid = $_GET['ordersid'];

$orders = $conn->query("SELECT * FROM orders WHERE OrdersID='$ordersid'");
	
while($row = $orders->fetch_assoc()) {

	if($row['OrderedQty'] == $row['WalkinQty']) {
		$update = $conn->query("UPDATE orders SET WalkinStatus='Completed'
			WHERE ProductID='$row[ProductID]' AND OrdersID='$ordersid'");
	}
	else {
		$update = $conn->query("UPDATE orders SET WalkinStatus='Partially Prepared'
			WHERE ProductID='$row[ProductID]' AND OrdersID='$ordersid'");
	}
	
}


header('location: walkin_prepare3.php?ordersid=' .$ordersid. '');	

ob_end_flush();
?>