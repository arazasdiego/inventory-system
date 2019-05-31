<?php
ob_start();
require('../connection.php');

$ordersid = $_GET['ordersid'];

//ORDERS TOTAL
$orders_total = $conn->query("SELECT * FROM orders_total WHERE OrdersID='$ordersid'");
$row = $orders_total->fetch_assoc();



//Orders
$orders = $conn->query("SELECT * FROM orders WHERE OrdersID='$ordersid' AND PaymentStatus !='Paid'");

	

if($row['AmountPaid'] >= $row['AmountPayable']) {
	while($row2 = $orders->fetch_assoc()) {
		$updatesales = $conn->query("UPDATE inventorylog SET TotalStockSold=TotalStockSold+'$row2[OrderedQty]', TotalSales=TotalSales+'$row2[TotalPrice]'
			WHERE ProductID='$row2[ProductID]'");
		
		$updateorder = $conn->query("UPDATE orders SET PaymentStatus='Paid'
				WHERE ProductID='$row2[ProductID]' AND OrdersID='$ordersid'");
	}
}





header('location: deliverorder.php?ordersid=' .$ordersid. '');





ob_end_flush();
?>