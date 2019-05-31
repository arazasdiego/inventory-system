<?php
ob_start();
require('../connection.php');

$productid = $_GET['productid'];
$prodstatus = $_GET['prodstatus'];

if ($prodstatus == 'Active') {
	$upd_status = 'Inactive';
}
else {
	$upd_status = 'Active';
}

$update = "UPDATE product SET ProdStatus='$upd_status'
	WHERE ProductID='$productid'";

if ($conn->query($update) === TRUE) {
	echo '<script>
	window.alert("Successfully updated.");
	window.location.href="product.php";
	</script>';
}

else {
	echo 'Error: ' .$update. '<br />' .$conn->error;
}


ob_end_flush();	
?>