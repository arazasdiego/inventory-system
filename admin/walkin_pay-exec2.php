<?php
ob_start();
require('../connection.php');
require('session.php');

$ordersid = $_GET['ordersid'];

//ORDERS TOTAL
$orders_total = $conn->query("SELECT * FROM orders_total WHERE OrdersID='$ordersid'");
$row = $orders_total->fetch_assoc();



if($row['AmountPaid'] >= $row['AmountPayable']) {
	$amountchange = $row['AmountPaid'] - $row['AmountPayable'];
	$update = $conn->query("UPDATE orders_total SET PaymentStatus='Paid', AmountChange='$amountchange', OrderStatus='Being Prepared', PreparedBy='$_SESSION[userid]'
		WHERE OrdersID='$ordersid'");

	$orders = $conn->query("SELECT * FROM orders WHERE OrdersID='$ordersid' AND PaymentStatus != 'Paid'");
	
	while($obj = $orders->fetch_assoc()) {

		$query = $conn->query("UPDATE orders SET PaymentStatus='Paid'
			WHERE OrdersID='$ordersid'");

		$query2 = $conn->query("UPDATE inventorylog SET TotalSales=TotalSales+'$obj[TotalPrice]', TotalStockSold=TotalStockSold+'$obj[OrderedQty]'
			WHERE ProductID='$obj[ProductID]'");
	}
	
}


else {
	$update = $conn->query("UPDATE orders_total SET PaymentStatus='Partially Paid', OrderStatus='Prepared', PreparedBy='$_SESSION[userid]'
		WHERE OrdersID='$ordersid'");

}

header('location: walkin_pay-exec3.php?ordersid=' .$ordersid. '');




ob_end_flush();
?>