<?php
ob_start();
require('../connection.php');
require('session.php');
require('../date.php');

$poid = $_GET['poid'];

$po = $conn->query("SELECT * FROM po WHERE POID='$poid'");
$pocount = $po->num_rows;

$comp = $conn->query("SELECT * FROM po WHERE POID='$poid' AND POStatus='Completed'");
$compcount = $comp->num_rows;

if($pocount == $compcount) {
	$update1 = $conn->query("UPDATE po_total SET Status='Completed'
			WHERE POID='$poid'");
}



header('location: po_returnlist.php?poid=' .$poid. '');

ob_end_flush();
?>