<?php
require('../connection.php');
$productid = $_GET['productid'];
$qty = $_GET['qty'];
$damagedid = $_GET['damagedid'];

$sql = "UPDATE product SET Stock=Stock + '$qty'
	WHERE ProductID='$productid';";
$sql .= "DELETE FROM damaged_product
	WHERE DamagedID='$damagedid'";

if($conn->multi_query($sql) === TRUE) {
	echo '<script>
	window.alert("Successfully removed.");
	window.location.href="damaged_product.php";
	</script>';

}	
?>