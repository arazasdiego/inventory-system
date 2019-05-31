<?php
ob_start();
require('../connection.php');
require('../date.php');
require('session.php');

if(isset($_POST['submit'])) {
	$delivery_date = $_POST['delivery_date'];
	$supplierid = $_POST['supplierid'];
	$totalamount = $_POST['totalamount'];

	//POId
	$sql = $conn->query("SELECT * FROM po_total");
	$count = $sql->num_rows;
	$numbers = rand(10, 100);
	$poid = 'PO-' .$numbers. '-' .$count;

	$message = 'Added a purchase order (' .$poid. ').';

	$select = $conn->query("SELECT * FROM po_cart
		WHERE SupplierID='$supplierid' AND UserID='$_SESSION[userid]'");

	//INSERT PO
	while($row = $select->fetch_assoc()) {



		$insert = "INSERT INTO po(POID, ProductID, Price, RequestedQty, TotalPrice, POStatus, ReturnedQty, ReceivedQty)
		VALUES('$poid', '$row[ProductID]', '$row[Price]', '$row[Qty]', '$row[TotalPrice]', 'Pending', '0', '0')";
		



		if($conn->query($insert) === FALSE) {
			echo 'ERROR: ' .$insert. '<br />' .$conn->error;
		}
	}
	

	$sql2 = "INSERT INTO po_total(POID, SupplierID, TotalAmount, DeliveryDate, DateCreated, Status, UserID, OrdersID)
		VALUES('$poid', '$supplierid', '$totalamount', '$delivery_date', '$da', 'Pending', '$_SESSION[userid]', 'Null');";

	$sql2 .= "INSERT INTO trail(ID, Message, UserID, DateCreated)
		VALUES('$poid', '$message', '$_SESSION[userid]', '$da');";

	$sql2 .= "DELETE FROM po_cart
		WHERE SupplierID='$supplierid' AND UserID='$_SESSION[userid]'";

	if($conn->multi_query($sql2) === TRUE) {
		echo ("<script>
			window.alert('Successfully added ($poid).');
			window.location.href='po.php';
			</script>");
	}

	else {
		echo 'ERROR: ' .$sql2. '<br />' .$conn->error;
	}

}
ob_end_flush();
?>