<?php
ob_start();
require('../connection.php');
require('session.php');
require('../date.php');


if(isset($_POST['add_product']) && is_array($_POST['add_product'])) {
	
	foreach ($_POST['add_product'] as $key) {
			$select = $conn->query("SELECT * FROM product WHERE ProductID='$key'");
			$row = $select->fetch_assoc();
			$insert = $conn->query("INSERT INTO sales_cart(ProductID, Price, Qty, TotalPrice, UserID)
				VALUES('$row[ProductID]', '$row[RetailPrice]', '1', '$row[RetailPrice]', '$_SESSION[userid]')");
	}

	

}

	
	header('location: add_sales2.php');







ob_end_flush();
?>