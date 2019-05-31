<?php
ob_start();
require('../connection.php');
require('../date.php');
require('session.php');

if(isset($_POST['submit'])) {
	
	$ordersid = $_POST['ordersid'];
	$id = $_POST['id'];
	$pending = $_POST['pending'];
	$qty = $_POST['qty'];

	$ctr = 0;

	if (filter_var($qty, FILTER_VALIDATE_INT) === 1 || !filter_var($qty, FILTER_VALIDATE_INT) === false) {
   		$ctr ++;
	} 
	else {
    echo '<script>
			window.alert("Input a valid number.");
			window.location.href="tank_receive.php?id=' .$id. '";
			</script>';
	}

	if($qty > $pending) {
		echo '<script>
			window.alert("The inputted qty exceed on the pending qty.");
			window.location.href="tank_receive.php?id=' .$id. '";
			</script>';
	}

	else {
		$ctr ++;
	}


	if($qty > 0) {
		$ctr ++;
	}
	else {
		echo '<script>
			window.alert("Input a number greater than zero.");
			window.location.href="tank_receive.php?id=' .$id. '";
			</script>';
	}


	if($ctr == 3) {

		if($qty == $pending) {
			
			$update ="UPDATE tanks SET ReturnedQty=ReturnedQty+ '$qty', Status='Completed'
			WHERE ID='$id'";

			if($conn->query($update) === TRUE) {
			echo '<script>
			window.alert("Received.");
			window.location.href="tank_receive-exec2.php?ordersid=' .$ordersid. '";
			</script>';
			}
			else {
			echo 'ERROR: ' .$update. '<br />'. $conn->error;
			}
		}


		else {
			$update ="UPDATE tanks SET ReturnedQty=ReturnedQty+ '$qty', Status='Partially Received'
			WHERE ID='$id'";


			if($conn->query($update) === TRUE) {
			echo '<script>
			window.alert("Partially received.");
			window.location.href="tank_receive-exec2.php?ordersid=' .$ordersid. '";
			</script>';
			}
			else {
			echo 'ERROR: ' .$update. '<br />'. $conn->error;
			}
		}

		
	}
}


ob_end_flush();
?>