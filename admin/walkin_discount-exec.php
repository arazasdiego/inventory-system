<?php
ob_start();
require('../connection.php');
require('../date.php');
require('session.php');

if(isset($_POST['submit'])) {
	$ordersid = $_POST['ordersid'];
	$discountid =$_POST['discountid'];

	$sql = $conn->query("SELECT * FROM discount WHERE DiscountID='$discountid'");
	$row = $sql->fetch_assoc();

	$sql2 = $conn->query("SELECT * FROM orders_total WHERE OrdersID='$ordersid'");
	$row2 = $sql2->fetch_assoc();
	//Discounted Amount
	$discountedamount = ($row['DiscountValue'] / 100) * $row2['GrandAmount'];

	//Amount Payable
	$amountpayable = $row2['GrandAmount'] - $discountedamount;


	$update = $conn->query("UPDATE orders_total SET DiscountedAmount='$discountedamount', DiscountID='$discountid', AmountPayable='$amountpayable'
		WHERE OrdersID='$ordersid'");

	
	
		echo '<script>
			window.alert("Successsfully updated discount");
			window.location.href="sales2.php?ordersid=' .$ordersid. '";
			</script>';
	
		

}


ob_end_flush();
?>