<?php
ob_start();
require('../connection.php');
require('session.php');
require('../date.php');

if(isset($_POST['submit'])) {
	$ordersid = $_POST['ordersid'];
	$deliverydate = $_POST['deliverydate'];
	$ctr = 0;

	$checkauto = $conn->query("SELECT * FROM auto_po WHERE SupplierID='None' AND OrdersID='$ordersid'");
	
	if($checkauto->num_rows > 0) {
		echo '<script>
			window.alert("Please fill up all the supplier");
			window.location.href="pickup_genpo.php?ordersid=' .$ordersid. '";
			</script>';

	}
	else {
		$ctr++;
	}



	if($ctr == 1) {
			$auto_po = $conn->query("SELECT * FROM auto_po WHERE 
		OrdersID='$ordersid'");



	while($autorow = $auto_po->fetch_assoc()) {
		
		//POId
		$sql = $conn->query("SELECT * FROM po_total");
		$count = $sql->num_rows;
		$numbers = rand(10, 100);
		$poid = 'PO-PCKP-' .$numbers. '-' .$count;

	
	$select = $conn->query("SELECT * FROM po_total WHERE SupplierID='$autorow[SupplierID]' AND OrdersID='$ordersid'");
	$selrow = $select->fetch_assoc();

	if($select->num_rows > 0) {
		$updatetotal = $conn->query("UPDATE po_total SET TotalAmount=TotalAmount+'$autorow[Total]'
					WHERE SupplierID='$autorow[SupplierID]' AND OrdersID='$ordersid'");
		
		//Insert purchase order product
		$po_insert1 = $conn->query("INSERT INTO po(POID, ProductID, RequestedQty, Price, TotalPrice, POStatus, ReturnedQty, ReceivedQty)
			VALUES('$selrow[POID]', '$autorow[ProductID]', '$autorow[PendingQty]', '$autorow[Price]', '$autorow[Total]', 'Pending', '0', '0')");
	}

	else{
			$inserttotal = $conn->query("INSERT INTO po_total(POID, SupplierID, TotalAmount, DeliveryDate, OrdersID, DateCreated, Status, UserID)
				VALUES('$poid', '$autorow[SupplierID]', '$autorow[Total]', '$deliverydate', '$ordersid', '$da', 'Pending', '$_SESSION[userid]')");

			//Insert purchase order product
		$po_insert2 = $conn->query("INSERT INTO po(POID, ProductID, RequestedQty, Price, TotalPrice, POStatus, ReturnedQty, ReceivedQty)
			VALUES('$poid', '$autorow[ProductID]', '$autorow[PendingQty]', '$autorow[Price]', '$autorow[Total]', 'Pending', '0', '0')");

	}
	
	
	
			}
		
	
	$delete = $conn->query("DELETE FROM auto_po WHERE OrdersID='$ordersid'");



	
		echo ("<script>
			window.alert('Successfully created the purchase order. Kindly check the PO section.');
			window.location.href='pickuporder.php?ordersid=" .$ordersid. "';
			</script>");
	
	
	}




}
ob_end_flush();
?>