<?php
require('../connection.php');
require('session.php');

if(isset($_POST['qty']) && is_array($_POST['qty'])) {
	//Update cart item 
	foreach ($_POST['qty'] as $key => $value) {

		if(is_numeric($value) && $value > 0) {
			$sql = $conn->query("SELECT * FROM cart WHERE ProductID='$key' AND UserID='$_SESSION[userid]'");
			$row = $sql->fetch_assoc();
			$total = $row['Price'] * $value;
			
			$update = $conn->query("UPDATE cart SET Qty='$value', Total='$total', Total='$total'
				WHERE ProductID='$key' AND UserID='$_SESSION[userid]'");

		}
		else if(is_numeric($value) && $value < 0) {
				echo '<script>
				window.alert("There are less than zero quatity inputted. If it is positive number, it will be updated.");
				window.location.href="basket.php";
				</script>';	
		}
		
		
	}

}


if(isset($_POST['remove_product']) && is_array($_POST['remove_product'])) {
	foreach ($_POST['remove_product'] as $key) {
		$delete = $conn->query("DELETE FROM cart WHERE ProductID='$key' AND UserID='$_SESSION[userid]'");	
	}

}


echo '<script>
	window.alert("Successfully updated.");
	window.location.href="basket.php";
	</script>';	
?>