<?php
ob_start();
require('../connection.php');
require('session.php');
require('../date.php');

if(isset($_POST['submit'])) {
	$productid = $_POST['productid'];
	$product_qty = $_POST['product_qty'];
	$price = $_POST['price'];
	$ctr = 0;

	$check = $conn->query("SELECT * FROM cart WHERE ProductID='$productid' AND UserID='$_SESSION[userid]'");

	$totalprice = $product_qty * $price;
	if($check->num_rows > 0) {
		header('location: shop.php');

	}
	else {
		$insert = "INSERT INTO cart(ProductID, Qty, Price, Total, UserID, DateCreated)
			VALUES('$productid', '$product_qty', '$price', '$totalprice', '$_SESSION[userid]', '$da')";
		if($conn->query($insert) === TRUE) {
			echo '<script>
				window.alert("Successfully added");
				window.location.href="shop.php";
				</script>';
		}
		else{
			echo 'Error ' .$insert. '<br />' .$conn->error;
		}	
	} 	


}
ob_end_flush();
?>