<?php
ob_start();
require('../connection.php');
require('session.php');
require('../date.php');

$id = $_GET['id'];

$returned_po = $conn->query("SELECT * FROM returned_po WHERE ID='$id'");
$row = $returned_po->fetch_assoc();

	$poid = $row['POID'];
	$productid = $row['ProductID'];

$update1 = $conn->query("UPDATE product SET Stock=Stock+'$row[Qty]'
	WHERE ProductID='$productid'");

$update2 = $conn->query("UPDATE po SET ReceivedQty=ReceivedQty+'$row[Qty]', ReturnedQty=ReturnedQty-'$row[Qty]'
	WHERE POID='$poid' AND ProductID='$productid'");



$delete1 = $conn->query("DELETE FROM returned_po WHERE ID='$id'");			

header('location: po_cancelreturn2.php?poid=' .$poid. '&productid=' .$productid. '');

ob_end_flush();
?>