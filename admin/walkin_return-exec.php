<?php
ob_start();
require('../connection.php');
require('../date.php');
require('session.php');

if(isset($_POST['submit'])) {
	$id = $_POST['id'];
	$reasonid = $_POST['reasonid'];
	$qty = $_POST['qty'];

	$ctr = 0;


	$orders = $conn->query("SELECT * FROM orders WHERE ID='$id'");
	$res1 = $orders->fetch_assoc();
	$ordersid = $res1['OrdersID'];

	$orders_total = $conn->query("SELECT * FROM orders_total WHERE OrdersID='$ordersid'");
	$res2 = $orders_total->fetch_assoc();

	if (filter_var($qty, FILTER_VALIDATE_INT) === 1 || !filter_var($qty, FILTER_VALIDATE_INT) === false) {
   		$ctr ++;
	} 
	else {
    	echo '<script>
			window.alert("Enter a valid number.");
			window.location.href="walkin_return.php?id=' .$id. '";
			</script>';
	}

	if($qty > 0) {
		$ctr ++;
	}

	else {
		echo '<script>
			window.alert("Input a number greater than zero.");
			window.location.href="walkin_return.php?id=' .$id. '";
			</script>';
	}


	if($qty > $res1['WalkinQty']) {
		echo '<script>
			window.alert("The return item is higher than to customer received.");
			window.location.href="walkin_return.php?id=' .$id. '";
			</script>';
	}
	else {
		$ctr ++;
	}

	if($ctr == 3) {
		
		$update1 = $conn->query("UPDATE orders SET ReturnedQty=ReturnedQty+'$qty', WalkinQty=WalkinQty-'$qty'
			WHERE ID='$id'");

		$ccc = $conn->query("SELECT * FROM returned_orders2 WHERE OrdersID='$ordersid'");

		if($ccc->num_rows == 0) {
			$insertord = $conn->query("INSERT INTO returned_orders2(OrdersID, DateAdded)
				VALUES('$ordersid', '$da')");
		}

		$insert1 = $conn->query("INSERT INTO returned_orders(ProductID, OrdersID, Qty, ReasonID, DateAdded, Received, Status)
			VALUES('$res1[ProductID]', '$res1[OrdersID]', '$qty', '$reasonid', '$da', '$_SESSION[userid]', 'Pending')");


		$update2 = $conn->query("UPDATE orders_total SET OrderStatus='Prepared/Item Returned'
				WHERE OrdersID='$ordersid'");

		echo '<script>
			window.alert("Successfully returned.");
			window.location.href="sales2.php?ordersid=' .$ordersid. '";
			</script>';

	}

}
ob_end_flush();
?>