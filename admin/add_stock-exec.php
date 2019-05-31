<?php
ob_start();
require('../connection.php');
require('session.php');
require('../date.php');

if(isset($_POST['submit'])) {
	$productid = $_POST['productid'];
	$qty = $_POST['qty'];
	$ctr = 0;

	$product = $conn->query("SELECT * FROM product 
		WHERE ProductID='$productid'");
	$prodrow = $product->fetch_assoc();

	if (filter_var($qty, FILTER_VALIDATE_INT) === 1 || !filter_var($qty, FILTER_VALIDATE_INT) === false) {
   		$ctr ++;
	} 
	else {
    echo '<script>
			window.alert("Please enter a valid number.");
			window.location.href="product.php";
			</script>';
	}

	if($qty > 0) {
		$ctr ++;
	}
	else {
		echo '<script>
			window.alert("Input a number greater than zero.");
			window.location.href="product.php";
			</script>';
	}

	if($ctr == 2) {

		$message = 'Added ' .$qty. ' stock. (' .$prodrow['ProdName']. ')';

		$update = "UPDATE product SET Stock='$qty' + Stock
		WHERE ProductID='$productid';";

		$update .= "UPDATE inventorylog SET TotalStock=TotalStock + '$qty'
			WHERE ProductID='$productid';";

		$update .="INSERT INTO trail(ID, Message, DateCreated, UserID)
		VALUES('$productid', '$message', '$da', '$_SESSION[userid]')";

		if($conn->multi_query($update) === TRUE) {
			echo '<script>
			window.alert("Successfully added.");
			window.location.href="product.php";
			</script>';
		}
		else {
			echo 'ERROR: ' .$update. '<br />'. $conn->error;
		}
	}
}

ob_end_flush();
?>