<?php
ob_start();
require('../connection.php');
require('session.php');
require('../date.php');


		

if(isset($_POST['qty']) && is_array($_POST['qty'])) {
	
	foreach ($_POST['qty'] as $key => $value) {
		if(is_numeric($value) && $value > 0) {
			$sc = $conn->query("SELECT * FROM sales_cart
				WHERE ID='$key'");
			$scrow = $sc->fetch_assoc();
				
			$prod = $conn->query("SELECT * FROM product
				WHERE ProductID='$scrow[ProductID]'");
			$prodrow = $prod->fetch_assoc();

			if($value <= $prodrow['Stock']) {
				$totalprice = $value * $scrow['Price'];
				$update1 = $conn->query("UPDATE sales_cart SET Qty='$value', TotalPrice='$totalprice'
					WHERE ID='$key'");
			}
			
			}
	}

}




if(isset($_POST['remove_product']) && is_array($_POST['remove_product'])) {
	
		foreach ($_POST['remove_product'] as $key) {
			$delete = $conn->query("DELETE FROM sales_cart WHERE ID='$key'");	
		}

	

}

	
	header('location: salescart.php');







ob_end_flush();
?>