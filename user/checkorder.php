<?php
ob_start();
require('../connection.php');
require('session.php');
require('../format_money.php');



$limit_orders = $conn->query("SELECT * FROM limit_orders WHERE ID=1");
$row = $limit_orders->fetch_assoc();

$checkorder = $conn->query("SELECT * FROM orders_total WHERE OrderBy='$_SESSION[userid]' AND PaymentStatus != 'Paid' AND OrdersDelete=0");

if($checkorder->num_rows > $row['Value']) {
	echo '<script>
		window.alert("Settle first your transactions.");
		window.location.href="customer_orders.php";
		</script>';
}
else {
	header('location: checkout1-type.php');
}
ob_end_flush();
?>