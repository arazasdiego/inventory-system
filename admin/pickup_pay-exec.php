<?php
ob_start();
require('../connection.php');
require('session.php');
require('../date.php');

if(isset($_POST['submit'])) {
	$ordersid = $_POST['ordersid'];
	$amount = $_POST['amount'];
	$payment_type = $_POST['payment_type'];
	
	$ctr = 0;

	if (filter_var($amount, FILTER_VALIDATE_INT) === 1 || !filter_var($amount, FILTER_VALIDATE_INT) === false) {
   		$ctr ++;
	} 
	else {
   		echo '<script>
			window.alert("Input a valid number.");
			window.location.href="pickup_pay.php?ordersid=' .$ordersid. '";
			</script>';
	}

	if($amount > 0) {
		$ctr ++;
	}
	else {
		echo '<script>
			window.alert("Input a number greater than zero.");
			window.location.href="pickup_pay.php?ordersid=' .$ordersid. '";
			</script>';
	}

	if($ctr == 2) {
		$query = "UPDATE orders_total SET AmountPaid=AmountPaid+'$amount'
			WHERE OrdersID='$ordersid';";


		$query .= "INSERT INTO payment(OrdersID, Amount, PaymentType, DatePaid, ReceivedBy)
			VALUES('$ordersid', '$amount', '$payment_type', '$da', '$_SESSION[userid]')";

		if($conn->multi_query($query) === TRUE) {
			echo '<script>
			window.alert("Payment submitted.");
			window.location.href="pickup_pay-exec2.php?ordersid=' .$ordersid. '";
			</script>';
		}
		else {
			echo 'Error ' .$query. '<br />' .$conn->error;
		}			
	}
	
	
}

ob_end_flush();
?>