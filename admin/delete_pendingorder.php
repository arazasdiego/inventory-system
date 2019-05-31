<?php
ob_start();
require('..connection.php');
require('../date.php');
require('session.php');

$ordersid = $_GET['ordersid'];

$update = "DELETE FROM orders_total WHERE OrdersID='$ordersid';";

$update .= "DELETE FROM orders WHERE OrdersID='$ordersid';";

$update .= "DELETE FROM billing_detail WHERE OrdersID='$ordersid';";

$update .= "DELETE FROM payment_slip WHERE OrdersID='$ordersid';";


if($conn->multi_query($update) === TRUE) {
	echo '<script>
		window.alert("Successfully deleted");
		window.location.href="online_order.php";
		</script>';
}	
else {
	echo 'Error: ' .$update. '<br />' .$conn->errror;
}

ob_end_flush();
?>