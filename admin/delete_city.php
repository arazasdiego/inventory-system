<?php
ob_start();
require('../connection.php');
require('../date.php');
require('session.php');


$cityid = $_GET['cityid'];
$cityname = $_GET['cityname'];

//Trail Message
$message = 'Removed the city (' .$cityname. ').';

$update = "UPDATE city SET CityDelete=1
	WHERE CityID='$cityid';";

$update .= "INSERT INTO trail(UserID, ID, Message, DateCreated)
    VALUES('$_SESSION[userid]', 'cityid', '$message', '$da')";

if($conn->multi_query($update) === TRUE) {
	echo '<script>
		window.alert("Successfully removed.");
		window.location.href="city.php";
		</script>';
}   
else {
	echo 'Error: ' .$update. '<br />' .$conn->error;
} 	

ob_end_flush();
?>