<?php
ob_start();
require('../connection.php');
require('session.php');
require('../date.php');


if(isset($_POST['submit'])) {
	$ordersid = $_POST['ordersid'];
	$reasonid = $_POST['reasonid'];
	$description = $_POST['description'];

	$delete1= $conn->query("DELETE FROM tanks_total WHERE OrdersID='$ordersid'");
	$delete2= $conn->query("DELETE FROM tanks WHERE OrdersID='$ordersid'");
	$delete3= $conn->query("DELETE FROM returned_orders WHERE OrdersID='$ordersid'");
	$delete4= $conn->query("DELETE FROM returned_orders2 WHERE OrdersID='$ordersid'");


	
	$update1 =  $conn->query("UPDATE orders_total SET OrdersDelete=1, OrderStatus='Cancelled'
	WHERE OrdersID='$ordersid'");

$orders = $conn->query("SELECT * FROM orders WHERE OrdersID='$ordersid'");	

while($row2 = $orders->fetch_assoc()) {
	$updateprod = $conn->query("UPDATE product SET Stock=Stock+'$row2[PickedupQty]'
			WHERE ProductID='$row2[ProductID]'");

	if($row2['PaymentStatus'] == 'Paid') {
		$removesales = $conn->query("UPDATE inventorylog SET TotalStockSold=TotalStockSold-'$row2[OrderedQty]', TotalSales=TotalSales-'$row2[TotalSales]'
			WHERE ProductID='$row2[ProductID]'");
	}
}

	$insertcancel = $conn->query("INSERT INTO cancelled_order(OrdersID, ReasonID, Description, DateCancelled, CancelledBy)
			VALUES('$ordersid', '$reasonid', '$description', '$da', '$_SESSION[userid]')");


	echo '<script>
	window.alert("Successfully cancelled.");
	window.location.href="cancelled_order.php";
	</script>';
}








ob_end_flush();
?>