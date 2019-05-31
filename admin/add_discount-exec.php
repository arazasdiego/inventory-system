<?php
require('../connection.php');
require('../date.php');
require('session.php');


if(isset($_POST['submit'])) {
	$discountname = $_POST['discountname'];
	$discountvalue = $_POST['discountvalue'];
	$ctr = 0;

	//Trail Message
    $message = 'Added a new discount type (' .$discountname. ').';

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

		$insert = "INSERT INTO discount(DiscountName, DiscountValue, DiscountDelete)
			VALUES('$discountname', '$discountvalue', '0');";

		 $insert .= "INSERT INTO trail(UserID, ID, Message, DateCreated)
   			VALUES('$_SESSION[userid]', 'DiscountID', '$message', '$da')";

		if($conn->multi_query($insert) === TRUE) {
			echo '<script>
			window.alert("Successfully added.");
			window.location.href="discount.php";
			</script>';
		}
		else {
			echo 'ERROR: ' .$insert. '<br />'. $conn->error;
		}
	}
}

?>