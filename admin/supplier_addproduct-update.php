<?php
ob_start();
require('../connection.php');
require('session.php');
require('../date.php');

$supplierid = $_SESSION['supplierid'];
		
if(isset($_POST['add_product']) && is_array($_POST['add_product'])) {
	
		foreach ($_POST['add_product'] as $key) {
			$select = $conn->query("SELECT * FROM product WHERE ProductID='$key'");
			$row = $select->fetch_assoc();
			
			$insert = $conn->query("INSERT INTO supplier_product(ProductID, SupplierID)
				VALUES('$row[ProductID]', '$supplierid')");
		}

	

}

	
	header('location: supplier_addproduct.php?supplierid=' .$supplierid. '');







ob_end_flush();
?>