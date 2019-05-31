<?php
ob_start();
require('../connection.php');

$supplierid = $_GET['supplierid'];
$supplierstatus = $_GET['supplierstatus'];

if ($supplierstatus == 'Active') {
	$upd_status = 'Inactive';
}
else {
	$upd_status = 'Active';
}

$update = "UPDATE supplier SET SupplierStatus='$upd_status'
	WHERE SupplierID='$supplierid'";

if ($conn->query($update) === TRUE) {
	echo '<script>
	window.alert("Successfully updated.");
	window.location.href="supplier.php";
	</script>';
}

else {
	echo 'Error: ' .$update. '<br />' .$conn->error;
}

ob_end_flush();
?>