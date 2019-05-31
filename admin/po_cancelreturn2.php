<?php
ob_start();
require('../connection.php');
require('session.php');
require('../date.php');

$poid = $_GET['poid'];
$productid = $_GET['productid'];

$returned_po = $conn->query("SELECT * FROM returned_po WHERE POID='$poid'");

$po = $conn->query("SELECT * FROM po WHERE POID='$poid' AND ProductID='$productid'");
$row = $po->fetch_assoc();

if($row['ReceivedQty'] >= $row['RequestedQty']) {
	$totalprice = $row['ReceivedQty'] * $row['Price'];

	$updateqty = $conn->query("UPDATE po SET RequestedQty='$row[ReceivedQty]', TotalPrice='$totalprice', POStatus='Completed'
		WHERE POID='$poid' AND ProductID='$productid'");
}

if($returned_po->num_rows == 0){
	$delete1 = $conn->query("DELETE FROM returned_po2 WHERE POID='$poid'");		
}

	



header('location: po_cancelreturn3.php?poid=' .$poid. '');

ob_end_flush();
?>