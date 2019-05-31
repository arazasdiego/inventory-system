<?php
ob_start();
require('../connection.php');

if(isset($_POST['submit'])) {
	$cityid = $_POST['cityid'];
	$cityname = $_POST['cityname'];
	$cityfee = $_POST['cityfee'];

	$ctr = 0;

	if (filter_var($cityfee, FILTER_VALIDATE_INT) === 0 || !filter_var($cityfee, FILTER_VALIDATE_INT) === false) {
   		$ctr ++;
	} 
	else {
    	echo '<script>
			window.alert("Enter a valid price.");
			window.location.href="city.php";
			</script>';
	}

	if($cityfee > -1) {
		$ctr ++;
	}
	else {
		echo '<script>
			window.alert("Negative number is invalid.");
			window.location.href="city.php";
			</script>';
	}

	if($ctr == 2) {
		$update = "UPDATE city SET CityName='$cityname', CityFee='$cityfee'
			WHERE CityID='$cityid'";
		if($conn->query($update) === TRUE) {	
			 echo '<script>
			window.alert("Successfully updated.");
			window.location.href="city.php";
			</script>';
		}
		else {
			echo 'Error: ' .$update. '<br />' .$conn->error;
		}
	}
}

ob_end_flush();
?>