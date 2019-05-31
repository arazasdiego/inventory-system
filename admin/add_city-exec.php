<?php
require('../connection.php');


if(isset($_POST['submit'])) {
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
			window.alert("Negative number is not valid.");
			window.location.href="city.php";
			</script>';
	}

	if($ctr == 2) {
		$insert = "INSERT INTO city(CityName, CityFee, CityDelete)
			VALUES('$cityname', '$cityfee', '0')";

		if($conn->query($insert) === TRUE) {
			echo '<script>
			window.alert("Successfully added.");
			window.location.href="city.php";
			</script>';
		}
		else {
			echo 'ERROR: ' .$insert. '<br />'. $conn->error;
		}
	}
}

?>