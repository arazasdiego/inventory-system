<?php
ob_start();
require('../connection.php');
require('../date.php');
require('session.php');

$id = $_GET['id'];
$returned_orders = $conn->query("SELECT * FROM returned_orders WHERE ID='$id'");
$row = $returned_orders->fetch_assoc();

$ordersid = $row['OrdersID'];

$update1 = $conn->query("UPDATE product SET Stock=Stock+'$row[Qty]'
		WHERE ProductID='$row[ProductID]'");

$update2 = $conn->query("UPDATE returned_orders SET Status='Returned to inventory'
		WHERE ID='$id'");

echo '<script>
	window.alert("Successfully return to inventory.");
	window.location.href="walkin_returnlist.php?ordersid=' .$ordersid. '";
	</script>';

ob_end_flush();
?>