<?php
ob_start();
require('../connection.php');
require('../date.php');
require('session.php');

if(isset($_POST['submit'])) {
	$id = $_POST['id'];
	$ordersid = $_POST['ordersid'];
	$qty = $_POST['qty'];

	$ctr = 0;


	$orders = $conn->query("SELECT * FROM orders WHERE ID='$id'");
	$res1 = $orders->fetch_assoc();

	$orders_total = $conn->query("SELECT * FROM orders_total WHERE OrdersID='$ordersid'");
	$res2 = $orders_total->fetch_assoc();

	if (filter_var($qty, FILTER_VALIDATE_INT) === 1 || !filter_var($qty, FILTER_VALIDATE_INT) === false) {
   		$ctr ++;
	} 
	else {
    	echo '<script>
			window.alert("Enter a valid number.");
			window.location.href="pickup_update.php?id=' .$id. '";
			</script>';
	}

	if($qty > 0) {
		$ctr ++;
	}

	else {
		echo '<script>
			window.alert("Input a number greater than zero.");
			window.location.href="pickup_update.php?id=' .$id. '";
			</script>';
	}


	if($ctr == 2) {
		//Removing order
		$remove = $conn->query("UPDATE orders_total SET SubAmount=SubAmount-'$res1[TotalPrice]', GrandAmount=GrandAmount-'$res1[TotalPrice]'
				WHERE OrdersID='$ordersid'");

		if($res1['PaymentStatus'] == 'Paid') {

			$removesales = $conn->query("UPDATE inventorylog SET TotalStockSold=TotalStockSold-'$res1[OrderedQty]', TotalSales=TotalSales-'$res1[TotalPrice]'
					WHERE ProductID='$res1[ProductID]'");
		}

		//Updating order
		$totalprice = $qty * $res1['Price'];

		if($qty > $res1['PickedupQty']) {
			$update1 = $conn->query("UPDATE orders SET OrderedQty='$qty', TotalPrice='$totalprice'
					WHERE ID='$id'");
		}
		else {
			$returnstock = $res1['PickedupQty'] - $qty;
			$update1 = $conn->query("UPDATE orders SET OrderedQty='$qty', TotalPrice='$totalprice', WalkinQty='$qty'
					WHERE ID='$id'");
			$update2 = $conn->query("UPDATE product SET Stock=Stock+'$returnstock'
					WHERE ProductID='$res1[ProductID]'");
		}

		$update3 = $conn->query("UPDATE orders_total SET SubAmount=SubAmount+'$totalprice', GrandAmount=GrandAmount+'$totalprice'
				WHERE OrdersID='$ordersid'");


		//Check and update tanks
		$check_tanks = $conn->query("SELECT * FROM tanks 
			WHERE OrdersID='$ordersid' AND ProductID='$res1[ProductID]'");

		if($check_tanks->num_rows > 0) {
			$update_tanks = $conn->query("UPDATE tanks SET Qty='$qty'
					WHERE OrdersID='$ordersid' AND ProductID='$res1[ProductID]'");
		}


		echo ("<script>
					window.alert('Successfully updated.')
					window.location.href='pickup_update-exec2.php?ordersid=" .$ordersid. "&id=" .$id. "';
					</script>");
	}

}
ob_end_flush();
?>