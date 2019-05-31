<?php
ob_start();
require('../connection.php');
require('../date.php');
require('session.php');

$productid = $_GET['productid'];
$poid = $_GET['poid'];

$sql = $conn->query("SELECT * FROM po WHERE ProductID='$productid' AND POID='$poid'");
$row = $sql->fetch_assoc();

if($row['ReceivedQty'] == $row['RequestedQty']) {
	$update = "UPDATE po SET POStatus='Completed'
		WHERE ProductID='$productid' AND POID='$poid'";

	if($conn->query($update) === TRUE) {
	header('location: po_damage-exec3.php?poid=' .$poid. '');
	}
	else {
	echo 'Error :' .$update. '<br />' .$conn->error;
	}	
}

else{
	header('location: po_view2.php?poid=' .$poid. '');
}

ob_end_flush();
?>