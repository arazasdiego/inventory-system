<?php
ob_start();
require('../connection.php');

if(isset($_POST['submit'])) {
	$discountid = $_POST['discountid'];
	$discountname = $_POST['discountname'];
	$discountvalue = $_POST['discountvalue'];

	$ctr = 0;

	if (filter_var($discountvalue, FILTER_VALIDATE_INT) === 1 || !filter_var($discountvalue, FILTER_VALIDATE_INT) === false) {
   		$ctr ++;
	} 
	else {
    echo '<script>
			window.alert("Enter a valid value.");
			window.location.href="discount.php";
			</script>';
	}

	if($ctr == 1) {
		$update = "UPDATE discount SET DiscountName='$discountname', DiscountValue='$discountvalue'
			WHERE DiscountID='$discountid'";
		if($conn->query($update) === TRUE) {	
			 echo '<script>
			window.alert("Successfully updated.");
			window.location.href="discount.php";
			</script>';
		}
		else {
			echo 'Error: ' .$update. '<br />' .$conn->error;
		}
	}
}
ob_end_flush();
?>