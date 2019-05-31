<?php
ob_start();
require('../connection.php');
require('../date.php');
require('session.php');

$ordersid = $_GET['ordersid'];

$orders = $conn->query("SELECT o.ProductID, o.OrderedQty, o.DeliveredQty,

	p.CostPrice, p.Stock, p.SupplierID, p.CategoryID,

	c.CategoryReturned

	FROM orders AS o
	INNER JOIN product AS p ON o.ProductID=p.ProductID
	INNER JOIN category AS c ON p.CategoryID=c.CategoryID
	AND o.OrdersID='$ordersid'");

//orders
while($row = $orders->fetch_assoc()) {
	//Check product
	

	if($row['OrderedQty'] > $row['Stock']) {
		$requestedqty = $row['OrderedQty'] - $row['Stock'];
		$total = $row['CostPrice'] * $requestedqty; 
			
		$po_insert = $conn->query("INSERT INTO auto_po(OrdersID, ProductID, PendingQty, DateAdded, SupplierID, Price, Total)
			VALUES('$ordersid', '$row[ProductID]', '$requestedqty', '$da', '$row[SupplierID]', '$row[CostPrice]', '$total')");

			
		$update1 = $conn->query("UPDATE product SET Stock=0
				WHERE ProductID='$row[ProductID]'");

		$update2 = $conn->query("UPDATE orders SET DeliveredQty=DeliveredQty+'$row[Stock]', DeliveryStatus='Partially Delivered'
				WHERE ProductID='$row[ProductID]' AND OrdersID='$ordersid'");	
	}

	//ELSE update product
		else {
			
			$update1 = $conn->query("UPDATE product SET Stock=Stock-'$row[OrderedQty]'
				WHERE ProductID='$row[ProductID]'");

			$update2 = $conn->query("UPDATE orders SET DeliveredQty=DeliveredQty+'$row[OrderedQty]', DeliveryStatus='Delivered'
				WHERE ProductID='$row[ProductID]' AND OrdersID='$ordersid'");	
	}


			
		
		//END ELSE

	//tanks insert
	if($row['CategoryReturned'] == 1) {

		$tankscheck = $conn->query("SELECT * FROM tanks 
			WHERE OrdersID='$ordersid' AND ProductID='$row[ProductID]'");
		if($tankscheck->num_rows > 0) {
			$update_tanks = $conn->query("UPDATE tanks SET Qty='$row[OrderedQty]'
					WHERE OrdersID='$ordersid' AND ProductID='$row[ProductID]'");
		}
		else {
			$tank_insert = $conn->query("INSERT INTO tanks(OrdersID, ProductID, Qty, ReturnedStatus)
					VALUES('$ordersid', '$row[ProductID]', '$row[OrderedQty]', 'Pending')");
		}
	}




}
//END WHILE

$tanks_total = $conn->query("INSERT INTO tanks_total(OrdersID, DateAdded, Status)
		VALUES('$ordersid', '$da', 'Pending')");

header('location: prepare_order2.php?ordersid='.$ordersid. '');


ob_end_flush();
?>