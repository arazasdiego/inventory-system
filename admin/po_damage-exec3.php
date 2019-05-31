<?php
ob_start();
require('../connection.php');
require('../date.php');
require('session.php');

$poid = $_GET['poid'];

$sql = $conn->query("SELECT * FROM po WHERE POID='$poid'");
$po_count = $sql->num_rows;

$sql2 = $conn->query("SELECT * FROM po WHERE POID='$poid' AND POStatus='Completed'");
$po_count2 = $sql2->num_rows;

if($po_count == $po_count2) {
	$update = "UPDATE po_total SET Status='Completed'
		WHERE POID='$poid'";
	if($conn->query($update) === TRUE) {
	header('location: po_view2.php?poid=' .$poid. '');
	}
	else {
	echo 'Error :' .$update. '<br />' .$conn->error;
	}	
}
else {
	header('location: po_view2.php?poid=' .$poid. '');
}


ob_end_flush();
?>