<?php
ob_start();
require('../connection.php');
require('session.php');
require('../date.php');

$supplierid = $_SESSION['supplierid'];
		

if(isset($_POST['costprice']) && is_array($_POST['costprice'])) {
	
	foreach ($_POST['costprice'] as $key => $value) {
		if(is_numeric($value) && $value > 0) {
			$poc = $conn->query("SELECT * FROM po_cart
				WHERE ProductID='$key' AND UserID='$_SESSION[userid]'");
			$poc_row = $poc->fetch_assoc();

			$prod = $conn->query("SELECT * FROM product WHERE ProductID='$key'");
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
			
			$totalprice = $value * $poc_row['Qty'];

			$update1 = $conn->query("UPDATE product SET CostPrice='$value', RetailPrice='$retailprice2'
			WHERE ProductID='$key'");

			$update2 = $conn->query("UPDATE po_cart SET Price='$value', TotalPrice='$totalprice'
			WHERE ProductID='$key' AND UserID='$_SESSION[userid]' AND SupplierID='$supplierid'");
			}
	}

}




if(isset($_POST['add_product']) && is_array($_POST['add_product'])) {
	
		foreach ($_POST['add_product'] as $key) {
			$select = $conn->query("SELECT * FROM product WHERE ProductID='$key'");
			$row = $select->fetch_assoc();

		

			$insert = $conn->query("INSERT INTO po_cart(ProductID, SupplierID, UserID, Price, Qty, TotalPrice)
				VALUES('$row[ProductID]', '$supplierid', '$_SESSION[userid]', '$row[CostPrice]', '1', '$row[CostPrice]')");
		}

	

}

	
	header('location: po_order.php?supplierid=' .$supplierid. '');







ob_end_flush();
?>