<?php
ob_start();
require('../connection.php');
require('../date.php');
require('session.php');

$ordersid = $_GET['ordersid'];

$orders = $conn->query("SELECT * FROM orders WHERE OrdersID='$ordersid'");
	

while($row = $orders->fetch_assoc()) {
	$pending_deliver = $row['OrderedQty'] - $row['DeliveredQty'];

	$product = $conn->query("SELECT * FROM product WHERE ProductID='$row[ProductID]'");
	$prodrow = $product->fetch_assoc();
	$stock = $prodrow['Stock'];

	if($pending_deliver > $stock) {
		$update1 = $conn->query("UPDATE product SET Stock=0
				WHERE ProductID='$row[ProductID]'");

		$update2 = $conn->query("UPDATE orders SET DeliveredQty=DeliveredQty+'$stock' WHERE ProductID='$row[ProductID]' AND OrdersID='$ordersid'");
	}

	else {
		$update1 = $conn->query("UPDATE product SET Stock=Stock-'$pending_deliver'
				WHERE ProductID='$row[ProductID]'");

		$update2 = $conn->query("UPDATE orders SET DeliveredQty=DeliveredQty+'$pending_deliver' WHERE ProductID='$row[ProductID]' AND OrdersID='$ordersid'");
	}
}


header('location: deliver_set2.php?ordersid=' .$ordersid. '');	

ob_end_flush();
?>