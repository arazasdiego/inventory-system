<?php
ob_start();
require('../connection.php');
require('../date.php');
require('session.php');

if(isset($_POST['submit'])) {
	$categoryname = ucwords($_POST['categoryname']);

	$categoryreturned = $_POST['categoryreturned'];

	$check = $conn->query("SELECT * FROM category WHERE CategoryName='$categoryname' AND CategoryDelete=0");
	if($check->num_rows > 0) {
		echo '<script>
		window.alert("Category already exist.");
		window.location.href="category.php"
		</script>';
	}

	else {
		//Trail Message
    	$message = 'Added a new category type (' .$categoryname. ').';

		$insert = "INSERT INTO category(CategoryName, CategoryReturned, CategoryDelete)
		VALUES('$categoryname', '$categoryreturned', '0');";

		$insert .= "INSERT INTO trail(UserID, ID, Message, DateCreated)
   	 	VALUES('$_SESSION[userid]', 'categoryid', '$message', '$da')";

		if($conn->multi_query($insert) === TRUE) {
			echo '<script>
			window.alert("Successfully added.");
			window.location.href="category.php";
			</script>';
		}
		else {
			echo 'ERROR: ' .$insert. '<br />'. $conn->error;
		}
	}
}


ob_end_flush();
?>