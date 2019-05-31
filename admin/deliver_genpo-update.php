<?php
ob_start();
require('../connection.php');
require('session.php');
require('../date.php');

$ordersid = $_SESSION['ordersid'];
		

if(isset($_POST['qty']) && is_array($_POST['qty'])) {
	foreach ($_POST['qty'] as $key => $value) {
		if(is_numeric($value) && $value > 0) {
			$auto_po = $conn->query("SELECT * FROM auto_po WHERE ID='$key'");
			$row = $auto_po->fetch_assoc();
			$total = $row['Price'] * $value;
			$update1 = $conn->query("UPDATE auto_po SET PendingQty='$value', Total='$total'
				WHERE ID='$key'");
		}
	}
}



if(isset($_POST['price']) && is_array($_POST['price'])) {
	foreach ($_POST['price'] as $key => $value) {
		if(is_numeric($value) && $value > 0) {
			$auto_po = $conn->query("SELECT * FROM auto_po WHERE ID='$key'");
			$row = $auto_po->fetch_assoc();
			$total = $row['PendingQty'] * $value;
			$productid = $row['ProductID'];

			$prod = $conn->query("SELECT * FROM product WHERE ProductID='$productid'");
			$prod_row = $prod->fetch_assoc();

			//FORMULA FOR MARKUP
    		$MarkUpTemp1 = $prod_row['MarkUp'] / 100;
    		$MarkUpTemp2 = $value * $MarkUpTemp1;
    		$retailprice = $value + $MarkUpTemp2;

			//VAT
    		$vat = $conn->query("SELECT * FROM vat WHERE ID=1");
    		$vatrow = $vat->fetch_assoc();

    		$vatable = ($vatrow['Value'] / 100) + 1;
    		$vatable_sales = $retailprice / $vatable;
    		$vat = ($vatrow['Value'] / 100) * $vatable_sales; 

    		$retailprice2 = $retailprice + $vat;

			 
			$update1 = $conn->query("UPDATE auto_po SET Price='$value', Total='$total'
				WHERE ID='$key'");

			$update2 = $conn->query("UPDATE product SET CostPrice='$value', RetailPrice='$retailprice2'
				WHERE ProductID='$productid'");
		}
	}
}



if(isset($_POST['supplierid']) && is_array($_POST['supplierid'])) {
	foreach ($_POST['supplierid'] as $key => $value) {
		
			$update112 = $conn->query("UPDATE auto_po SET SupplierID='$value'
				WHERE ID='$key'");

			
		
	}
}




	
	header('location: deliver_genpo.php?ordersid=' .$ordersid. '');







ob_end_flush();
?>