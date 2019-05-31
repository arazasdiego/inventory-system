<?php
ob_start();
require('../connection.php');

$userid = $_GET['userid'];
$userstatus = $_GET['userstatus'];

if ($userstatus == 'Active') {
	$upd_status = 'Inactive';
}
else {
	$upd_status = 'Active';
}

$update = "UPDATE user SET UserStatus='$upd_status'
	WHERE UserID='$userid'";

if ($conn->query($update) === TRUE) {
	echo '<script>
	window.alert("Successfully updated.");
	window.location.href="customer.php";
	</script>';
}

else {
	echo 'Error: ' .$update. '<br />' .$conn->error;
}


ob_end_flush();	
?>