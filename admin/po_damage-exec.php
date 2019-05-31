<?php
ob_start();
require('../connection.php');
require('../date.php');
require('session.php');

$damagedid = $_GET['damagedid'];
$poid = $_GET['poid'];

$sql = $conn->query("SELECT * FROM damaged_product WHERE DamagedID='$damagedid'");
$row = $sql->fetch_assoc();

$productid = $row['ProductID'];

$update = "UPDATE product SET Stock=Stock+'$row[Qty]'
	WHERE ProductID='$row[ProductID]';";



$update .= "UPDATE po SET ReceivedQty=ReceivedQty+'$row[Qty]', ReturnedQty=ReturnedQty-'$row[Qty]'
	
	WHERE POID='$poid' AND ProductID='$row[ProductID]';";


$update .= "DELETE FROM damaged_product 
	WHERE DamagedID='$damagedid'";

			
if($conn->multi_query($update) === TRUE) {
	header('location: po_damage-exec2.php?poid=' .$poid. '&productid=' .$productid. '');
}
else {
	echo 'Error :' .$update. '<br />' .$conn->error;
}


ob_end_flush();
?>