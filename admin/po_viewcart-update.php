<?php
ob_start();
require('../connection.php');
require('session.php');
require('../date.php');

$supplierid = $_SESSION['supplierid'];
		

if(isset($_POST['qty']) && is_array($_POST['qty'])) {
	
	foreach ($_POST['qty'] as $key => $value) {
		if(is_numeric($value) && $value > 0) {
			$poc = $conn->query("SELECT * FROM po_cart
				WHERE ID='$key'");
			$poc_row = $poc->fetch_assoc();
			
			$totalprice = $value * $poc_row['Price'];

			$update1 = $conn->query("UPDATE po_cart SET Qty='$value', TotalPrice='$totalprice'
			WHERE ID='$key'");
			}
	}

}




if(isset($_POST['remove_product']) && is_array($_POST['remove_product'])) {
	
		foreach ($_POST['remove_product'] as $key) {
			$delete = $conn->query("DELETE FROM po_cart WHERE ID='$key'");	
		}

	

}

	
	header('location: po_viewcart.php?supplierid=' .$supplierid. '');







ob_end_flush();
?>