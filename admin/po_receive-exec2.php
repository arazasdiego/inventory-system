<?php
ob_start();
require('../connection.php');

$id = $_GET['id'];
$poid = $_GET['poid'];

$po = $conn->query("SELECT * FROM po WHERE ID='$id'");
$row = $po->fetch_assoc();

if($row['ReceivedQty'] > $row['RequestedQty']) {

	$totalprice = $row['ReceivedQty'] * $row['Price'];

	$updateqty = $conn->query("UPDATE po SET RequestedQty='$row[ReceivedQty]', TotalPrice='$totalprice'
		WHERE ID='$id'");

	$removeold = $conn->query("UPDATE po_total SET TotalAmount=TotalAmount-'$row[TotalPrice]'
			WHERE POID='$poid'");

	$updatenew = $conn->query("UPDATE po_total SET TotalAmount=TotalAmount+'$totalprice'
			WHERE POID='$poid'");
}




$check = $conn->query("SELECT * FROM po WHERE POID='$poid'");
$count = $check->num_rows;

$pocheck = $conn->query("SELECT * FROM po WHERE POID='$poid' AND POStatus='Completed'");
$pocount = $pocheck->num_rows;



if($count == $pocount) {
	$updatestatus = $conn->query("UPDATE po_total SET Status='Completed'
		WHERE POID='$poid'");
}
else {
	$updatestatus = $conn->query("UPDATE po_total SET Status='Partially Received'
		WHERE POID='$poid'");
}


if($row['POStatus'] == 'Completed') {
	header('location: po_view2.php?poid=' .$poid. '');
}


else {
	header('location: po_receive.php?id=' .$id. '');
}



ob_end_flush();
?>