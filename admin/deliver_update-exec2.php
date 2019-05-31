<?php
ob_start();
require('../connection.php');
require('../date.php');
require('session.php');

$ordersid = $_GET['ordersid'];
$id = $_GET['id'];


$orders = $conn->query("SELECT * FROM orders WHERE ID='$id'");
$obj = $orders->fetch_assoc();


$orders_total = $conn->query("SELECT * FROM orders_total WHERE OrdersID='$ordersid'");
$row = $orders_total->fetch_assoc();

$discounttbl = $conn->query("SELECT * FROM discount WHERE DiscountID='$row[DiscountID]'");
$dscntrow = $discounttbl->fetch_assoc();

if(empty($row['DiscountID'])) {
	$discountedamount = 0;
}

else {
	$discountedamount = ($dscntrow['DiscountValue'] / 100) * $row['GrandAmount'];
}

$amountpayable = $row['GrandAmount'] - $discountedamount;

if($row['AmountPaid'] >= $amountpayable) {
	$amountchange = $row['AmountPaid'] - $amountpayable;
	$update = $conn->query("UPDATE orders_total SET AmountPayable='$amountpayable', DiscountedAmount='$discountedamount', AmountChange='$amountchange', PaymentStatus='Paid'
			WHERE OrdersID='$ordersid'");

	$insertsales = $conn->query("UPDATE inventorylog SET TotalStockSold=TotalStockSold+'$obj[OrderedQty]', TotalSales=TotalSales+'$obj[TotalPrice]'
			WHERE ProductID='$obj[ProductID]'");

	$updateorderstatuspaid = $conn->query("UPDATE orders SET PaymentStatus='Paid'
		WHERE ID='$id'");

	
}

else {

	$updateorderstatus = $conn->query("UPDATE orders SET PaymentStatus='Partially Paid'
		WHERE ID='$id'");



	$update = $conn->query("UPDATE orders_total SET AmountPayable='$amountpayable', AmountChange=0, DiscountedAmount='$discountedamount', PaymentStatus='Partially Paid'
			WHERE OrdersID='$ordersid'");
}

header('location: deliver_update-exec3.php?ordersid=' .$ordersid. '');

ob_end_flush();
?>