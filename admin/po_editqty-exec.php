<?php
ob_start();
require('../connection.php');
require('session.php');

if(isset($_POST['submit'])) {
	$id = $_POST['id'];
	$supplierid = $_POST['supplierid'];
	$qty = $_POST['qty'];
	$price = $_POST['price'];
	
	$ctr = 0;

	if (filter_var($qty, FILTER_VALIDATE_INT) === 1 || !filter_var($qty, FILTER_VALIDATE_INT) === false) {
   		$ctr ++;
	} 
	else {
    	echo '<script>
			window.alert("Input a valid number.");
			window.location.href="po_viewcart.php?supplierid=' .$supplierid. '";
			</script>';
	}

	if($qty > 0) {
		$ctr ++;
	}
	else {
		echo '<script>
			window.alert("Input a number greater than zero.");
			window.location.href="po_viewcart.php?supplierid=' .$supplierid. '";
			</script>';
	}


	if($ctr == 2) {
		$totalprice = $price * $qty;

		$update = "UPDATE po_cart SET Qty='$qty', TotalPrice='$totalprice'
		WHERE ID='$id'";

		if($conn->query($update) === TRUE) {
			echo '<script>
			window.alert("Successfully updated.");
			window.location.href="po_viewcart.php?supplierid=' .$supplierid. '";
			</script>';
		}

		else {
			echo 'ERROR: ' .$update. '<br />' .$conn->error;
		}
		
	}

}

ob_end_flush();
?>