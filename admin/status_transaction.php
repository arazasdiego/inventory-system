<?php
ob_start();
require('../connection.php');

$id = $_GET['id'];
$status = $_GET['status'];

if ($status == 1) {
	$upd_status = 0;
}
else {
	$upd_status = 1;
}

$update = "UPDATE transaction_setting SET Status='$upd_status'
	WHERE ID='$id'";

if ($conn->query($update) === TRUE) {
	echo '<script>
	window.alert("Successfully updated.");
	window.location.href="transaction_setting.php";
	</script>';
}

else {
	echo 'Error: ' .$update. '<br />' .$conn->error;
}

ob_end_flush();
?>