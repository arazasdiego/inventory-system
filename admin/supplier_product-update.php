<?php
ob_start();
require('../connection.php');
require('session.php');
require('../date.php');

$supplierid = $_SESSION['supplierid'];
		

if(isset($_POST['remove_product']) && is_array($_POST['remove_product'])) {
	
		foreach ($_POST['remove_product'] as $key) {
			$delete = $conn->query("DELETE FROM supplier_product WHERE ID='$key'");	
		}

	

}

	
	header('location: supplier_product.php?supplierid=' .$supplierid. '');







ob_end_flush();
?>