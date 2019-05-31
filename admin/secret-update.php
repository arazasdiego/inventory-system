<?php
ob_start();
require('../connection.php');
require('session.php');
require('../date.php');


		

if(isset($_POST['stock']) && is_array($_POST['stock'])) {
	
	foreach ($_POST['stock'] as $key => $value) {
		if(is_numeric($value) && $value > 0) {
		

			$update = $conn->query("UPDATE product SET Stock='$value'
			WHERE ProductID='$key'");
			}
	}

}




	
	header('location: secret.php');







ob_end_flush();
?>